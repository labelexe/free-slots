<?php
/*REGISTER MY SESSION*/
function register_my_session(){
	if(!session_id()){
		session_start();
	}
}
add_action('init', 'register_my_session');

add_action('init', function (){
    delete_transient('wpml_st_upgrade_in_progress');
});

/*REMOVE HREFLANG*/
function custom_lang_code($hreflang_items){
	foreach($hreflang_items as $hreflang_item_key => $hreflang_item_value){
		//Change 'pt-pt' hreflang to 'pt'
		if($hreflang_item_key == 'pt-pt'){
			$hreflang_items['pt'] = $hreflang_items[$hreflang_item_key];
			unset($hreflang_items[$hreflang_item_key]);
		}else{
			$hreflang_items[$hreflang_item_key] = $hreflang_item_value;
		}
	}
	return $hreflang_items;
}
add_filter('wpml_hreflangs', 'custom_lang_code', 10, 1);
/*DISABLE AUTOMATIC WORDPRESS REDIRECTS*/
remove_action('template_redirect', 'wp_old_slug_redirect');
/*YOAST SEO REMOVE LOCALE PRESENTER*/
function remove_locale_presenter($presenters){
	return array_map(function($presenter){if(!$presenter instanceof Yoast\WP\SEO\Presenters\Open_Graph\Locale_Presenter){return $presenter;}}, $presenters);
}
add_action('wpseo_frontend_presenters', 'remove_locale_presenter');
/*YOAST SEO DISABLE INDEXATION*/
add_filter('wpseo_should_save_indexable', '__return_false');
add_filter('wpseo_indexing_data', '__return_false');
/*SITE LANG ID*/
load_theme_textdomain('websitelangid', get_template_directory().'/languages');
/*REMOVE JSON LINKS FROM HEAD TAG*/
remove_action('wp_head', 'rest_output_link_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('template_redirect', 'rest_output_link_header', 11);
/*ADMIN STYLES*/
function custon_admin_style_init(){echo '
<style>
#edittag{max-width:100%!important;}
.wp-block{max-width:inherit!important;margin-left:28px!important;margin-right:28px!important;min-width:inherit!important;}
</style>';
}
add_action('admin_head', 'custon_admin_style_init');
/*OPTIONS PAGE*/
if(function_exists('acf_add_options_page')){$option_page = acf_add_options_page(array('page_title'=>__('Options', 'websitelangid'), 'menu_slug'=>'theme-options'));}
/*ENQUEUE SCRIPTS*/
function load_scripts(){
	wp_deregister_script('jquery');
	wp_register_script('jquery', get_template_directory_uri().'/js/jquery-3-6-0.min.js');
	wp_enqueue_script('jquery');
	wp_enqueue_script('owl-carousel-script', get_template_directory_uri().'/js/owl.carousel.min.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'load_scripts');
/*ENQUEUE STYLES*/
//Head
function load_styles(){
	wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'load_styles');
//Footer
function load_styles_footer(){
	wp_deregister_style('font-awesome');
	//https://use.fontawesome.com/releases/v5.15.3/fontawesome-free-5.15.3-web.zip
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/all.min.css');
	wp_enqueue_style('owl-carousel', get_template_directory_uri().'/css/owl.carousel.min.css');
};
add_action('get_footer', 'load_styles_footer');
/*ADD THUMBNAILS SUPPORT*/
add_theme_support('post-thumbnails');
/*CROP LARGE & MEDIUM SIZE IMAGES*/
if(false === get_option("medium_crop")){add_option("medium_crop", "1");}
else{update_option("medium_crop", "1");}
if(false === get_option("large_crop")){add_option("large_crop", "1");}
else{update_option("large_crop", "1");}
/*DISABLE STANDART IMAGE SIZES*/
function disable_generating_image_sizes($sizes){
	unset($sizes['medium_large']);
	unset($sizes['1536x1536']);
	unset($sizes['2048x2048']);
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'disable_generating_image_sizes');
function remove_scrset_image_sizes(){
	remove_image_size('1536x1536');
	remove_image_size('2048x2048');
}
add_filter('init', 'remove_scrset_image_sizes');
add_filter('big_image_size_threshold', '__return_false');
/*USE ATTACHMENT NAME AS ALT AND TITLE ATTRIBUTE*/
function image_alt_n_titles($attr,$img){
	$img_title = trim(strip_tags($img->post_title));
	if(empty($attr['alt'])){$attr['alt'] = $img_title;}else{$attr['alt'] = $attr['alt'];}
	return $attr;
}
add_filter('wp_get_attachment_image_attributes','image_alt_n_titles',10,2);
/*REGISTER MENUS*/
if(function_exists('register_nav_menus')){
	register_nav_menus(
		array(
			'main_menu'=>__('Main Menu', 'websitelangid'),
			'footer_menu'=>__('Footer Menu', 'websitelangid'),
		)
	);
}
/*REGISTER WIDGETS*/
function my_register_sidebars(){
	register_sidebar(
		array(
			'id'=>'footer',
			'name'=>__('Footer', 'websitelangid'),
			'description'=>__('Widgets in this block will be displayed in footer of the website.', 'websitelangid'),
			'before_widget'=>'<aside id="%1$s" class="%2$s">',
			'after_widget'=>'</aside>',
			'before_title'=>'<h6>',
			'after_title'=>'</h6>'
		)
	);
}
add_action('widgets_init', 'my_register_sidebars');
/*ENABLE HTML5*/
add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'));
/*SHORTCODE SUPPORT FOR TAXONOMIES*/
add_filter('term_description', 'do_shortcode');
add_filter('category_description', 'do_shortcode');
add_filter('post_tag_description', 'do_shortcode');
/*ENABLE HTML FOR TAXONOMIES*/
function disable_kses_if_allowed(){
	if(current_user_can('unfiltered_html')){
		foreach(array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description') as $filter){
			remove_filter($filter, 'wp_filter_kses');
		}
	}
	foreach(array('term_description', 'link_description', 'link_notes', 'user_description') as $filter){
		remove_filter($filter, 'wp_kses_data');
	}
}
add_action('init','disable_kses_if_allowed');
/*PAGES LIMIT FOR SITEMAPS*/
function max_entries_per_sitemap(){return 250;}
add_filter('wpseo_sitemap_entries_per_page', 'max_entries_per_sitemap');
add_filter('wpseo_enable_xml_sitemap_transient_caching', '__return_false');
/*DISABLE WEBSITE FILED IN COMMENTS FORM*/
function crunchify_disable_comment_url($fields){unset($fields['url']); return $fields;}
add_filter('comment_form_default_fields','crunchify_disable_comment_url');
/*REORDER FIELDS IN COMMENTS FORM*/
function wpb_move_comment_field_to_bottom($fields){$comment_field = $fields['comment']; unset($fields['comment']); $fields['comment'] = $comment_field; return $fields;}
add_filter('comment_form_fields', 'wpb_move_comment_field_to_bottom');
/*REMOVE LINKS FROM COMMENTS*/
function strip_comment_links($content){global $allowedtags; $tags = $allowedtags; unset($tags['a']); $content = wp_kses(stripslashes($content), $tags); return $content;}
add_filter('comment_text', 'strip_comment_links');
/*WPML REMOVE COMMENTS CLAUSES*/
global $sitepress;
remove_filter('comments_clauses', array($sitepress, 'comments_clauses'), 10, 2);
/*DISABLE ACF CSS ON FRONT-END*/
function my_deregister_styles(){
	wp_deregister_style('acf');
	wp_deregister_style('acf-field-group');
	wp_deregister_style('acf-global');
	wp_deregister_style('acf-input');
	wp_deregister_style('acf-datepicker');
}
add_action('wp_print_styles', 'my_deregister_styles', 100);
/*COUNT POST VIEWS*/
function wpb_set_post_views($postID){
	$count_key = 'wpb_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
/*GUTENBERG BLOCKS*/
function acf_gutenberg_blocks_init(){
	if(function_exists('acf_register_block')){
		acf_register_block(array(
			'name'=>'pros_cons_list',
			'title'=>__('Pros Cons List', 'websitelangid'),
			'description'=>__('Add Pros Cons List Block to Your Content.', 'websitelangid'),
			'render_callback'=>'pros_cons_list_acf_block_render_callback',
			'category'=>'formatting',
			'icon'=>'menu',
			'mode'=>'edit',
			'keywords'=>array('pros cons'),
		));
		acf_register_block(array(
			'name'=>'iconic_steps_list',
			'title'=>__('Iconic Steps List', 'websitelangid'),
			'description'=>__('Add Iconic Steps List Block to Your Content.', 'websitelangid'),
			'render_callback'=>'iconic_steps_list_acf_block_render_callback',
			'category'=>'formatting',
			'icon'=>'menu',
			'mode'=>'edit',
			'keywords'=>array('iconic steps'),
		));
	}
}
add_action('acf/init', 'acf_gutenberg_blocks_init');
/*PROS CONS LIST BLOCK*/
function pros_cons_list_acf_block_render_callback($block){
	echo '<div class="pros-cons-list">';
	
	if(have_rows('pros_list_items')):
		echo '<ul>';
			while(have_rows('pros_list_items')):the_row();
			echo '<li><i class="fas fa-check"></i>'.get_sub_field('pros_list_item').'</li>';
			endwhile;
		echo '</ul>';
	endif;
	
	if(have_rows('cons_list_items')):
		echo '<ul>';
			while(have_rows('cons_list_items')):the_row();
			echo '<li><i class="fas fa-times"></i>'.get_sub_field('cons_list_item').'</li>';
			endwhile;
		echo '</ul>';
	endif;
	
	echo '</div>';
}
/*ICONIC STEPS LIST BLOCK*/
function iconic_steps_list_acf_block_render_callback($block){
	if(have_rows('iconic_steps_list_items')):
	echo '<ul class="iconic-steps-list">';
		$iconic_steps_count = 1;
		while(have_rows('iconic_steps_list_items')):the_row();
		echo '<li><div class="iconic-step-icon">'.get_sub_field('iconic_step_item_icon').'</div><div class="iconic-step-content"><p><strong>'.__('Step', 'websitelangid').' '.$iconic_steps_count.'</strong><br>'.get_sub_field('iconic_step_item_description').'</p></div></li>';
		$iconic_steps_count++;
		endwhile;
	echo '</ul>';
	endif;
}
/*SLOTS POST TYPE*/
function cptui_register_my_cpts_slots() {
	/**
	 * Post Type: Slots.
	 */
	$labels = [
		"name" => __( "Slots", "websitelangid" ),
		"singular_name" => __( "Slot", "websitelangid" ),
	];
	$args = [
		"label" => __( "Slots", "websitelangid" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "slots", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "custom-fields", "author" ],
		"taxonomies" => [ "slots_providers", "slots_types", "slots_themes", "slots_features", "slots_tags" ],
		"show_in_graphql" => false,
	];
	register_post_type( "slots", $args );
}
add_action( 'init', 'cptui_register_my_cpts_slots' );
/*SLOTS PROVIDERS TAXONOMY*/
function cptui_register_my_taxes_slots_providers() {
	/**
	 * Taxonomy: Slots Providers.
	 */
	$labels = [
		"name" => __( "Slots Providers", "websitelangid" ),
		"singular_name" => __( "Slots Provider", "websitelangid" ),
	];
	$args = [
		"label" => __( "Slots Providers", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'providers', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "slots_providers",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "slots_providers", [ "slots" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_slots_providers' );
/*SLOTS TYPES TAXONOMY*/
function cptui_register_my_taxes_slots_types() {
	/**
	 * Taxonomy: Slots Types.
	 */
	$labels = [
		"name" => __( "Slots Types", "websitelangid" ),
		"singular_name" => __( "Slots Type", "websitelangid" ),
	];
	$args = [
		"label" => __( "Slots Types", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'slots-types', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "slots_types",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "slots_types", [ "slots" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_slots_types' );
/*SLOTS THEMES TAXONOMY*/
function cptui_register_my_taxes_slots_themes() {
	/**
	 * Taxonomy: Slots Themes.
	 */
	$labels = [
		"name" => __( "Slots Themes", "websitelangid" ),
		"singular_name" => __( "Slots Theme", "websitelangid" ),
	];
	$args = [
		"label" => __( "Slots Themes", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'slots-themes', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "slots_themes",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "slots_themes", [ "slots" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_slots_themes' );
/*SLOTS FEATURES TAXONOMY*/
function cptui_register_my_taxes_slots_features() {
	/**
	 * Taxonomy: Slots Features.
	 */
	$labels = [
		"name" => __( "Slots Features", "websitelangid" ),
		"singular_name" => __( "Slots Feature", "websitelangid" ),
	];
	$args = [
		"label" => __( "Slots Features", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'slots-features', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "slots_features",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "slots_features", [ "slots" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_slots_features' );
/*SLOTS TAGS TAXONOMY*/
function cptui_register_my_taxes_slots_tags() {
	/**
	 * Taxonomy: Slots Tags.
	 */
	$labels = [
		"name" => __( "Slots Tags", "websitelangid" ),
		"singular_name" => __( "Slots Tag", "websitelangid" ),
	];
	$args = [
		"label" => __( "Slots Tags", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'slot', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "slots_tags",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "slots_tags", [ "slots" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_slots_tags' );
/*CASINOS POST TYPE*/
function cptui_register_my_cpts_casinos() {
	/**
	 * Post Type: Casinos.
	 */
	$labels = [
		"name" => __( "Casinos", "websitelangid" ),
		"singular_name" => __( "Casino", "websitelangid" ),
	];
	$args = [
		"label" => __( "Casinos", "websitelangid" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "casinos", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "custom-fields", "comments", "author" ],
		"taxonomies" => [ "casinos_countries", "casinos_deposits", "casinos_withdrawals", "casinos_types", "casinos_currencies", "casinos_languages", "casinos_licenses", "casinos_categories" ],
		"show_in_graphql" => false,
	];
	register_post_type( "casinos", $args );
}
add_action( 'init', 'cptui_register_my_cpts_casinos' );
/*CASINOS CATEGORIES TAXONOMY*/
function cptui_register_my_taxes_casinos_categories() {
	/**
	 * Taxonomy: Casinos Categories.
	 */
	$labels = [
		"name" => __( "Casinos Categories", "websitelangid" ),
		"singular_name" => __( "Casinos Category", "websitelangid" ),
	];
	$args = [
		"label" => __( "Casinos Categories", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'casino', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "casinos_categories",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "casinos_categories", [ "casinos" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_casinos_categories' );
/*CASINOS COUNTRIES TAXONOMY*/
function cptui_register_my_taxes_casinos_countries() {
	/**
	 * Taxonomy: Casinos Countries.
	 */
	$labels = [
		"name" => __( "Casinos Countries", "websitelangid" ),
		"singular_name" => __( "Casinos Country", "websitelangid" ),
	];
	$args = [
		"label" => __( "Casinos Countries", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'casinos-countries', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "casinos_countries",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "casinos_countries", [ "casinos" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_casinos_countries' );
/*CASINOS DEPOSITS TAXONOMY*/
function cptui_register_my_taxes_casinos_deposits() {
	/**
	 * Taxonomy: Casinos Deposits.
	 */
	$labels = [
		"name" => __( "Casinos Deposits", "websitelangid" ),
		"singular_name" => __( "Casinos Deposit", "websitelangid" ),
	];
	$args = [
		"label" => __( "Casinos Deposits", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'deposits-method', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "casinos_deposits",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "casinos_deposits", [ "casinos" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_casinos_deposits' );
/*CASINOS WITHDRAWALS TAXONOMY*/
function cptui_register_my_taxes_casinos_withdrawals() {
	/**
	 * Taxonomy: Casinos Withdrawals.
	 */
	$labels = [
		"name" => __( "Casinos Withdrawals", "websitelangid" ),
		"singular_name" => __( "Casinos Withdrawal", "websitelangid" ),
	];
	$args = [
		"label" => __( "Casinos Withdrawals", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'casinos-withdrawals', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "casinos_withdrawals",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "casinos_withdrawals", [ "casinos" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_casinos_withdrawals' );
/*CASINOS TYPES TAXONOMY*/
function cptui_register_my_taxes_casinos_types() {
	/**
	 * Taxonomy: Casinos Types.
	 */
	$labels = [
		"name" => __( "Casinos Types", "websitelangid" ),
		"singular_name" => __( "Casinos Type", "websitelangid" ),
	];
	$args = [
		"label" => __( "Casinos Types", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'casino-types', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "casinos_types",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "casinos_types", [ "casinos" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_casinos_types' );
/*CASINOS CURRENCIES TAXONOMY*/
function cptui_register_my_taxes_casinos_currencies() {
	/**
	 * Taxonomy: Casinos Currencies.
	 */
	$labels = [
		"name" => __( "Casinos Currencies", "websitelangid" ),
		"singular_name" => __( "Casinos Currency", "websitelangid" ),
	];
	$args = [
		"label" => __( "Casinos Currencies", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'casino-currencies', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "casinos_currencies",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "casinos_currencies", [ "casinos" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_casinos_currencies' );
/*CASINOS LANGUAGES TAXONOMY*/
function cptui_register_my_taxes_casinos_languages() {
	/**
	 * Taxonomy: Casinos Languages.
	 */
	$labels = [
		"name" => __( "Casinos Languages", "websitelangid" ),
		"singular_name" => __( "Casinos Language", "websitelangid" ),
	];
	$args = [
		"label" => __( "Casinos Languages", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'casino-languages', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "casinos_languages",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "casinos_languages", [ "casinos" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_casinos_languages' );
/*CASINOS LICENSES TAXONOMY*/
function cptui_register_my_taxes_casinos_licenses() {
	/**
	 * Taxonomy: Casinos Licenses.
	 */
	$labels = [
		"name" => __( "Casinos Licenses", "websitelangid" ),
		"singular_name" => __( "Casinos License", "websitelangid" ),
	];
	$args = [
		"label" => __( "Casinos Licenses", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'casinos-licenses', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "casinos_licenses",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "casinos_licenses", [ "casinos" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_casinos_licenses' );
/*BONUSES POST TYPE*/
function cptui_register_my_cpts_bonuses() {
	/**
	 * Post Type: Bonuses.
	 */
	$labels = [
		"name" => __( "Bonuses", "websitelangid" ),
		"singular_name" => __( "Bonus", "websitelangid" ),
	];
	$args = [
		"label" => __( "Bonuses", "websitelangid" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "bonuses", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "custom-fields" ],
		"taxonomies" => [ "bonuses_types" , "bonuses_countries" ],
		"show_in_graphql" => false,
	];
	register_post_type( "bonuses", $args );
}
add_action( 'init', 'cptui_register_my_cpts_bonuses' );
/*BONUSES TYPES TAXONOMY*/
function cptui_register_my_taxes_bonuses_types() {
	/**
	 * Taxonomy: Bonuses Types.
	 */
	$labels = [
		"name" => __( "Bonuses Types", "websitelangid" ),
		"singular_name" => __( "Bonuses Type", "websitelangid" ),
	];
	$args = [
		"label" => __( "Bonuses Types", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'bonus', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "bonuses_types",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "bonuses_types", [ "bonuses" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_bonuses_types' );
/*BONUSES COUNTRIES TAXONOMY*/
function cptui_register_my_taxes_bonuses_countries() {
	/**
	 * Taxonomy: Bonuses Countries.
	 */
	$labels = [
		"name" => __( "Bonuses Countries", "websitelangid" ),
		"singular_name" => __( "Bonuses Country", "websitelangid" ),
	];
	$args = [
		"label" => __( "Bonuses Countries", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'bonuses-countries', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "bonuses_countries",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "bonuses_countries", [ "bonuses" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_bonuses_countries' );
/*TABLE GAMES POST TYPE*/
function cptui_register_my_cpts_table_games() {
	/**
	 * Post Type: Table Games.
	 */
	$labels = [
		"name" => __( "Table Games", "websitelangid" ),
		"singular_name" => __( "Table Game", "websitelangid" ),
	];
	$args = [
		"label" => __( "Table Games", "websitelangid" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "table-games", "with_front" => true ],
		"query_var" => true,
		"supports" => [ "title", "editor", "thumbnail", "custom-fields", "author" ],
		"taxonomies" => [ "table_games_categories" ],
		"show_in_graphql" => false,
	];
	register_post_type( "table_games", $args );
}
add_action( 'init', 'cptui_register_my_cpts_table_games' );
/*TABLE GAMES CATEGORIES TAXONOMY*/
function cptui_register_my_taxes_table_games_categories() {
	/**
	 * Taxonomy: Table Games Categories.
	 */
	$labels = [
		"name" => __( "Table Games Categories", "websitelangid" ),
		"singular_name" => __( "Table Games Category", "websitelangid" ),
	];
	$args = [
		"label" => __( "Table Games Categories", "websitelangid" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'table-games-categories', 'with_front' => true, ],
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "table_games_categories",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		"show_in_graphql" => false,
	];
	register_taxonomy( "table_games_categories", [ "table_games" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_table_games_categories' );
/*PRE GET POSTS ARGUMENTS*/
function custom_pre_get_posts_args($query){
	if(!is_admin()){
		//Slots
		if($query->is_post_type_archive('slots')){
			set_query_var('posts_per_page', 36);
		}
		if($query->is_tax('slots_providers') or $query->is_tax('slots_types') or $query->is_tax('slots_themes') or $query->is_tax('slots_features') or $query->is_tax('slots_tags')){
			set_query_var('posts_per_page', 36);
		}
		//Casinos
		if($query->is_post_type_archive('casinos')){
			set_query_var('posts_per_page', 37);
		}
		if($query->is_tax('casinos_countries') or $query->is_tax('casinos_deposits') or $query->is_tax('casinos_withdrawals') or $query->is_tax('casinos_types') or $query->is_tax('casinos_currencies') or $query->is_tax('casinos_languages') or $query->is_tax('casinos_licenses') or $query->is_tax('casinos_categories')){
			set_query_var('posts_per_page', 37);
		}
		//Bonuses
		if($query->is_post_type_archive('bonuses')){
			set_query_var('posts_per_page', 40);
		}
		if($query->is_tax('bonuses_types') or $query->is_tax('bonuses_countries')){
			set_query_var('posts_per_page', 40);
		}
		//Table Games
		if($query->is_post_type_archive('table_games')){
			set_query_var('posts_per_page', 36);
		}
		if($query->is_tax('table_games_categories')){
			set_query_var('posts_per_page', 36);
		}
	}
}
add_action('pre_get_posts', 'custom_pre_get_posts_args');
/*AUTOMATICALLY OPEN COMMENTS FOR CASINOS POST TYPE*/
function escorts_default_comments_on($data){
	if($data['post_type'] == 'casinos'){$data['comment_status'] = 'open';}
	return $data;
}
/*ORIGINAL CANONICAL FOR PAGINATED PAGES*/
function yoast_seo_canonical_paginated($canonical){
	if(is_paged()){
		return get_pagenum_link();
	}else{
		return $canonical;
	}
}
add_filter('wpseo_canonical', 'yoast_seo_canonical_paginated', 10, 1);
/*POST TYPE NAME IN SEARCH RESULTS*/
function asp_show_the_post_type_title($results){
	foreach($results as $k=>&$r){
		if(isset($r->post_type)){
			$post_type_obj = get_post_type_object($r->post_type);
			if($post_type_obj->labels->singular_name == __('Slot', 'websitelangid')){
				$get_slots_providers = wp_get_post_terms($r->id, 'slots_providers');
				if($get_slots_providers){$slot_postfix = $get_slots_providers[0]->name;}else{$slot_postfix = __('Free', 'websitelangid').' '.$post_type_obj->labels->singular_name;}
				$r->title = $r->title.'<br><span class="post-type-in-search">'.$slot_postfix.'</span><div class="decorative-button">'.__('Play Free', 'websitelangid').'</div>';
			}elseif($post_type_obj->labels->singular_name == __('Table Game', 'websitelangid')){
				$r->title = $r->title.'<br><span class="post-type-in-search">'.__('Free', 'websitelangid').' '.$post_type_obj->labels->singular_name.'</span><div class="decorative-button">'.__('Play Free', 'websitelangid').'</div>';
			}elseif($post_type_obj->labels->singular_name == __('Casino', 'websitelangid')){
				$r->title = $r->title.'<br><span class="post-type-in-search">'.$post_type_obj->labels->singular_name.' '.__('Review', 'websitelangid').'</span><div class="decorative-button">'.__('Read Review', 'websitelangid').'</div>';
			}elseif($post_type_obj->labels->singular_name == __('Bonus', 'websitelangid')){
				$bonus_claim_link = get_field('bonus_claim_link', $r->id);
				if($bonus_claim_link){
					$r->title = $r->title.'<br><span class="post-type-in-search">'.$post_type_obj->labels->singular_name.'</span><span class="overlap"></span><div class="decorative-button">'.__('Read Review', 'websitelangid').'</div></a><a class="bonus-button" href="'.rtrim(home_url(), '/').'/go/?type=bonus_page&go_to_id='.$r->id.'" rel="nofollow" target="_blank">'.__('Claim Bonus', 'websitelangid');
				}else{
					$r->title = $r->title.'<br><span class="post-type-in-search">'.$post_type_obj->labels->singular_name.'</span><div class="decorative-button">'.__('More Information', 'websitelangid').'</div>';
				}
				
				$casino_bonuses_relationship = get_field('casino_bonuses_relationship', $r->id);
				if($casino_bonuses_relationship){
					$casino_permalink = get_permalink($casino_bonuses_relationship[0]->ID);
					$r->link = $casino_permalink;
					
					$casino_post_thumbnail_url = get_the_post_thumbnail_url($casino_bonuses_relationship[0]->ID, 'thumbnail');
					if($casino_post_thumbnail_url){
						$casino_post_thumbnail_sizes = array('width'=>150, 'height'=>150, 'crop'=>true);
						$r->image = bfi_thumb($casino_post_thumbnail_url, $casino_post_thumbnail_sizes);
					}
				}
			}else{
				$r->title = $r->title.'<br><span class="post-type-in-search">'.$post_type_obj->labels->singular_name.'</span><div class="decorative-button">'.__('More Information', 'websitelangid').'</div>';
			}
		}
		if(isset($r->taxonomy)){
			if($r->taxonomy == 'slots_providers'){
				$r->title = $r->title.'<br><span class="post-type-in-search">'.__('Provider', 'websitelangid').'</span><div class="decorative-button">'.__('Explore Games', 'websitelangid').'</div>';
			}
		}
	}
	return $results;
}
add_filter('asp_results', 'asp_show_the_post_type_title', 10, 1);
/*FILTER COUNTRIES SINGLE_TERM_TITLE*/
function custom_countries_single_term_title($term_name){
	if(is_tax(array('casinos_countries', 'bonuses_countries'))){
		$queried_object = get_queried_object();
		$taxonomy = $queried_object->taxonomy;
		$term_id = $queried_object->term_id;
		$country_term_name = get_field('country_native_name', $taxonomy.'_'.$term_id);
		if($country_term_name){
			$term_name = $country_term_name;
		}
	}
	return $term_name;
}
add_action('single_term_title', 'custom_countries_single_term_title');
/*FILTER CURRENT ELEMENT IN BREADCRUMBS*/
function custom_breadcrumbs_last_item_title($link_info, $index, $crumbs){
	//CASINOS & BONUSES COUNTRIES
	if(is_tax(array('casinos_countries', 'bonuses_countries'))){
		$last_key = array_key_last($crumbs);
		if($index == $last_key){
			$queried_object = get_queried_object();
			$taxonomy = $queried_object->taxonomy;
			$term_id = $queried_object->term_id;
			$country_term_name = get_field('country_native_name', $taxonomy.'_'.$term_id);
			if($country_term_name){
				$link_info['text'] = $country_term_name;
			}
		}
	}
	return $link_info;
}
add_filter('wpseo_breadcrumb_single_link_info', 'custom_breadcrumbs_last_item_title', 10, 3);
/*TEMPLATE OG AND SEO TITLE*/
function custom_title($title){
	//Archives: Slots
	if(is_post_type_archive('slots') and !is_admin()){
		$title = sprintf(__('Best Online Slots in %s: Top Slots with the Highest Payout Percentage', 'websitelangid'), date('Y'));
		//SPANISH: Las mejores tragamonedas en línea en %s: las tragamonedas con el porcentaje de pago más alto
	}
	//Archives: Casinos
	if(is_post_type_archive('casinos') and !is_admin()){
		$title = sprintf(__('Best Online Casinos in %s | Top Casino Sites Lists and Ratings', 'websitelangid'), date('Y'));
		//SPANISH: Mejores Casinos Online %s | Lee Listas y Clasificaciones
	}
	//Archives: Bonuses
	if(is_post_type_archive('bonuses') and !is_admin()){
		$title = __('Best Online Casino Bonuses: Choose, Try and Claim for Best Casino Offers', 'websitelangid');
		//SPANISH: Los mejores bonos de casino en línea: elije y reclama tu mejor oferta
	}
	//Archives: Table Games
	if(is_post_type_archive('table_games') and !is_admin()){
		$title = __('Casino Table Games: Best Places to Play | Rules, Game, Basic Tactics', 'websitelangid');
		//SPANISH: Juegos de mesa de casino y todo lo que debes saber sobre ellos
	}

	//Post Type: Slots
	if(is_singular('slots')){
		$get_yoast_wpseo_title = get_post_meta(get_the_ID(), '_yoast_wpseo_title', true);
		if(empty($get_yoast_wpseo_title)){
			$title = sprintf(__('%s Online Slot: Know Your Game and Play for Fun', 'websitelangid'), get_the_title());
			//SPANISH: %s – Slot: Conoce Tu Juego y Juega por Diversión
		}
	}
	//Post Type: Casinos
	if(is_singular('casinos')){
		$get_yoast_wpseo_title = get_post_meta(get_the_ID(), '_yoast_wpseo_title', true);
		if(empty($get_yoast_wpseo_title)){
			$title = sprintf(__('%s Review: Features, Bonuses and Overall Experience', 'websitelangid'), get_the_title());
			//SPANISH: %s: Reseña de Funciones, Bonos y Experiencia General
		}
	}
	//Post Type: Table Games
	if(is_singular('table_games')){
		$get_yoast_wpseo_title = get_post_meta(get_the_ID(), '_yoast_wpseo_title', true);
		if(empty($get_yoast_wpseo_title)){
			$title = sprintf(__('%s: Enjoy Fair Gameplay for Free or for Real Money', 'websitelangid'), get_the_title());
			//SPANISH: %s: Disfruta de Juego Limpio Gratis o con Dinero Real
		}
	}
	
	//Tax: Slots Providers
	if(is_tax('slots_providers')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('%s Slot Provider: Top-Quality Casino Games and Online Slots', 'websitelangid'), $queried_object->name);
			//SPANISH: %s: Proveedor de Mejores Juegos de Casino y Slots en Línea
		}
	}
	//Tax: Slots Types
	if(is_tax('slots_types')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('%s Online Slots: Find and Play Your Favorite Free Game', 'websitelangid'), $queried_object->name);
			//SPANISH: Tragamonedas en línea %s: Encuentra y juega tu juego favorito
		}
	}
	//Tax: Slots Themes
	if(is_tax('slots_themes')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('%s Slot Machines - Popular Online Games You Need', 'websitelangid'), $queried_object->name);
			//SPANISH: Máquinas tragamonedas del tema %s - Juegos online que necesitas
		}
	}
	//Tax: Slots Features
	if(is_tax('slots_features')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('%s Online Slots: Play Classic Slots Online for Free or Money', 'websitelangid'), $queried_object->name);
			//SPANISH: Tragamonedas con %s: Juega en las tragamonedas clásicas en línea gratis
		}
	}
	//Tax: Slots Tags
	if(is_tax('slots_tags')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = vsprintf(__('Best %s in %s - Play for Free on Your Tablet or Phone', 'websitelangid'), array($queried_object->name, date('Y')));
			//SPANISH: Mejores %s - Juega gratis en tu tableta o teléfono %s
		}
	}

	//Tax: Casinos Categories
	if(is_tax('casinos_categories')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('%s: List of Top-Rated Casinos for Dedicated Players', 'websitelangid'), $queried_object->name);
			//SPANISH: %s: Lista de Mejores Casinos para Jugadores Dedicados
		}
	}
	//Tax: Casinos Countries
	if(is_tax('casinos_countries')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		$country_term_name = get_field('country_native_name', $taxonomy.'_'.$term_id); if($country_term_name){$detect_country_term_name = $country_term_name;}else{$detect_country_term_name = get_term($term_id)->name;}
		if(empty($get_wpseo_title)){
			$title = vsprintf(__('%s Online Casinos. Best Places to Bet in %s - Full List', 'websitelangid'), array($detect_country_term_name, $detect_country_term_name));
			//SPANISH: Reseñas de casinos en línea de %s. Mejores lugares para apostar en %s
		}
	}
	//Tax: Casinos Deposits
	if(is_tax('casinos_deposits')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('%s Deposit - Casinos to Play for Free or Real Money - Choose at SlotoGate.com', 'websitelangid'), $queried_object->name);
			//SPANISH: Depósito %s - Casinos para jugar gratis o por dinero real - SlotoGate.com
		}
	}
	//Tax: Casinos Withdrawals
	if(is_tax('casinos_withdrawals')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('%s Withdrawal Methods at Best Online Casinos - Fast and Secure', 'websitelangid'), $queried_object->name);
			//SPANISH: Retiradas %s en casinos en línea - Rápido y seguro
		}
	}
	//Tax: Casinos Types
	if(is_tax('casinos_types')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('%s Portable Casinos with the Maximum and Minimum Bids - SlotoGate.com', 'websitelangid'), $queried_object->name);
			//SPANISH: Casinos %s portables con las pujas máximas y mínimas - SlotoGate.com
		}
	}
	//Tax: Casinos Currencies
	if(is_tax('casinos_currencies')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('%s Online Casinos - Play with Local Currency any Online Casino', 'websitelangid'), $queried_object->name);
			//SPANISH: Casinos en línea con %s - Jugar en casinos con la moneda local
		}
	}
	//Tax: Casinos Languages
	if(is_tax('casinos_languages')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('Best %s Casinos - Discover New Trusted Casinos Online Here', 'websitelangid'), $queried_object->name);
			//SPANISH: Sitio de casino %s - Descubra nuevos casinos de confianza en línea
		}
	}
	//Tax: Casinos Licenses
	if(is_tax('casinos_licenses')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('%s Casino License - Gambling Laws and Regulations - Advantages', 'websitelangid'), $queried_object->name);
			//SPANISH: Autorización de sitios web de casinos %s - Ventajas de la autorización
		}
	}

	//Tax: Bonuses Types
	if(is_tax('bonuses_types')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('Best %s Casinos - Play for Free or Real Money Online. Great Offers!', 'websitelangid'), $queried_object->name);
			//SPANISH: Los mejores casinos con %s - Juega gratis o por dinero real
		}
	}
	//Tax: Bonuses Countries
	if(is_tax('bonuses_countries')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		$country_term_name = get_field('country_native_name', $taxonomy.'_'.$term_id); if($country_term_name){$detect_country_term_name = $country_term_name;}else{$detect_country_term_name = get_term($term_id)->name;}
		if(empty($get_wpseo_title)){
			$title = sprintf(__('Best Casino Bonuses in %s - Real Money Websites - Gaming Platforms', 'websitelangid'), $detect_country_term_name);
			//SPANISH: Mejores bonos de casino en %s - Sitios web con dinero real - Plataformas de juego
		}
	}

	//Tax: Table Games Categories
	if(is_tax('table_games_categories')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_title = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_title'];
		if(empty($get_wpseo_title)){
			$title = sprintf(__('%s Free or Real Money: Table Games in Online Casinos - Choose and Play', 'websitelangid'), $queried_object->name);
			//SPANISH: %s gratis o por dinero real: Casinos en línea - Elige y juega
		}
	}

	return $title;
}
add_filter('wpseo_title','custom_title');
add_filter('wpseo_opengraph_title', 'custom_title');
/*TEMPLATE OG AND SEO DESCRIPTION*/
function custom_meta($desc){
	//Archives: Slots
	if(is_post_type_archive('slots') and !is_admin()){
		$desc = sprintf(__('Find the best %s slots with the Highest Payout Percentage. Check out our complete guide from true experts! The list of casino slot machine games with the highest RTP and bonuses!', 'websitelangid'), date('Y'));
		//SPANISH: Las mejores tragamonedas en línea en %s: encuentra la tragamonedas con el porcentaje de pago más alto. ¡Consulta nuestra guía completa de verdaderos expertos!
	}
	//Archives: Casinos
	if(is_post_type_archive('casinos') and !is_admin()){
		$desc = __('Top legal casinos in your region. We provide the ultimate updated list of best online casinos with country-specific ratings and in-depth reviews. Only trusted casino sites', 'websitelangid');
		//SPANISH: Mejores casinos legales de tu región. Brindamos la lista actualizada de los casinos en línea confiables con calificaciones de cada país y reseñas detalladas
	}
	//Archives: Bonuses
	if(is_post_type_archive('bonuses') and !is_admin()){
		$desc = __('Comprehensive list of excellent online casino bonuses and offers! We have prepared a detailed review that is useful for both novice and advanced players', 'websitelangid');
		//SPANISH: ¡Mira la gran lista de excelentes bonos de casino en línea! Hemos preparado una reseña detallada que sea útil tanto para jugadores novatos como avanzados
	}
	//Archives: Table Games
	if(is_post_type_archive('table_games') and !is_admin()){
		$desc = __('The important information about casino table games: description of the most popular games, a few words about strategy, bonuses, pros and cons and answers to frequently asked questions', 'websitelangid');
		//SPANISH: La información importante sobre los juegos de mesa de casino: descripción de los juegos más populares, algunas palabras sobre estrategia, bonos, pros y contras y respuestas a las preguntas frecuentes.
	}

	//Post Type: Slots
	if(is_singular('slots')){
		$get_yoast_wpseo_metadesc = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
		if(empty($get_yoast_wpseo_metadesc)){
			$desc = vsprintf(__('Find all necessary information you didn’t know about %s slot. Explore the rules, try new bonuses and learn %s slot winning strategy', 'websitelangid'), array(get_the_title(), get_the_title()));
			//SPANISH: Encuentra todos los datos necesarios sobre la tragamonedas %s. Explora las reglas, prueba nuevos bonos y aprenda la estrategia ganadora de slot %s
		}
	}
	//Post Type: Casinos
	if(is_singular('casinos')){
		$get_yoast_wpseo_metadesc = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
		if(empty($get_yoast_wpseo_metadesc)){
			$desc = vsprintf(__('Detailed analysis of %s gaming experience. Save your time and explore all advantages and disadvantages of %s below', 'websitelangid'), array(get_the_title(), get_the_title()));
			//SPANISH: Análisis detallado de la experiencia de juego en %s. Ahorra tiempo y explora todas las ventajas y desventajas de %s a continuación
		}
	}
	//Post Type: Table Games
	if(is_singular('table_games')){
		$get_yoast_wpseo_metadesc = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
		if(empty($get_yoast_wpseo_metadesc)){
			$desc = vsprintf(__('Never played %s for fun and excitement? Afraid to lose your money or just fail? Try your hand at this table game and find out that %s is not just for expert players', 'websitelangid'), array(get_the_title(), get_the_title()));
			//SPANISH: ¿Nunca has jugado %s por diversión? Prueba tu suerte en este juego de mesa y descubre que %s no es solo para jugadores expertos
		}
	}

	//Tax: Slots Providers
	if(is_tax('slots_providers')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('%s is a casino games provider delivering high-quality products. Check the wide range of online slots from %s and learn more about what it has to offer', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: %s es un proveedor de juegos de casino de alta calidad. Consulta la amplia gama de tragamonedas en línea por %s y obtén más información sobre lo que ofrece
		}
	}
	//Tax: Slots Types
	if(is_tax('slots_types')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('All kinds of %s slots machines featured at SlotoGate.com - Free and for real money, no download slot games. Get ready to play authentic %s slots online', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: Todo tipo de tragamonedas %s presentadas en SlotoGate.com - Juegos de tragamonedas gratis y por dinero sin descarga. Prepárate para jugar en las auténticas tragamonedas %s en línea
		}
	}
	//Tax: Slots Themes
	if(is_tax('slots_themes')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('The best slot developers with their %s slots online! Enjoy new trends, new themes, and new interactivity. SlotoGate.com features popular %s slots online for your gaming pleasure', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: ¡Los mejores desarrolladores de tragamonedas con sus tragamonedas de %s en línea! Disfruta de nuevas tendencias, nuevos temas y nueva interactividad. SlotoGate.com presenta populares tragamonedas de %s en línea para que disfrutes el juego.
		}
	}
	//Tax: Slots Features
	if(is_tax('slots_features')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('Find slot games with %s at SlotoGate.com - No download or deposit required - No registration. Win top prize on %s slots', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: Encuentra los juegos de tragamonedas con %s en SlotoGate.com - No se requiere una descarga o depósito - Tragamonedas en línea clásicas y a la vieja escuela gratis. Gana el premio máximo en las tragamonedas con la función %s
		}
	}
	//Tax: Slots Tags
	if(is_tax('slots_tags')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('Most popular %s slot games for mobile or desktop. SlotoGate.com and valued software providers of %s will delight you with a selection of great games', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: Más queridos juegos de tragamonedas %s para móviles u ordenadores. SlotoGate.com y valorados proveedores de software de %s te deleitarán con una selección de los juegos geniales
		}
	}

	//Tax: Casinos Categoires
	if(is_tax('casinos_categories')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = sprintf(__('Find the information about all %s and pick the one that suits your requirements and preferences. Choose only responsible gaming experience', 'websitelangid'), $queried_object->name);
			//SPANISH: Entérate sobre todos los %s y elije el que te guste. Disfruta de la experiencia de juego responsable
		}
	}
	//Tax: Casinos Countries
	if(is_tax('casinos_countries')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		$country_term_name = get_field('country_native_name', $taxonomy.'_'.$term_id); if($country_term_name){$detect_country_term_name = $country_term_name;}else{$detect_country_term_name = get_term($term_id)->name;}
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('Casino bonuses and incentives, exclusive offers in %s right here. SlotoGate.com suggests reading reviews and choosing from the best online casinos available in %s', 'websitelangid'), array($detect_country_term_name, $detect_country_term_name));
			//SPANISH: Bonos e incentivos de casino, ofertas exclusivas en %s aquí mismo. SlotoGate.com propone leer reseñas y elegir entre los mejores casinos en línea disponibles en %s
		}
	}
	//Tax: Casinos Deposits
	if(is_tax('casinos_deposits')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('Choose from all the best online %s deposit casinos available in your country. Play for free or for real money - Full and trusted reviews of casinos with %s', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: Elige entre todos los mejores online casinos con depósito %s disponible en tu país. Juega gratis o por dinero real - Reseñas de casinos con %s
		}
	}
	//Tax: Casinos Withdrawals
	if(is_tax('casinos_withdrawals')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('Looking for the best online casino where %s withdrawals are quick and easy? Online casinos offer instant %s payouts with a single click. We prepared the list', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: ¿Buscas el mejor casino en línea donde las retiradas %s sean rápidos y fáciles? Casinos en línea proponen pagos de %s instantáneos con un solo clic
		}
	}
	//Tax: Casinos Types
	if(is_tax('casinos_types')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('Easy to make a deposit, simple verification. Best and trusted %s online casino providers. %s casinos - no difficulties with withdrawal. Play for free or real money', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: Fácil de hacer un depósito, verificación simple. Bonos de casinos %s de los mejores proveedores de casinos en línea. Casinos %s - sin dificultades con la retirada de dinero
		}
	}
	//Tax: Casinos Currencies
	if(is_tax('casinos_currencies')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('Most convenient payment gateways for each country. Find the list of the best betting sites with %s supported by your local currency. Play at casinos with %s', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: Pasarelas de pago más convenientes para cada país. Encuentra la lista de los mejores sitios de apuesta con %s apoyado por tu moneda local. Juega en casinos con %s
		}
	}
	//Tax: Casinos Languages
	if(is_tax('casinos_languages')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('The best online casinos for players from %s. SlotoGate.com contains a list of the safest and most trusted casino sites for the whole world. Find your favorite casino games from %s', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: Los mejores casinos en línea para los jugadores %s. SlotoGate.com contiene una lista de los sitios de casinos más seguros y confiables para todo el mundo. Encuentra tus favoritos juegos de casino %s
		}
	}
	//Tax: Casinos Licenses
	if(is_tax('casinos_licenses')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('Casinos - Flexible, profitable, and easy setup process with lots of benefits. Online casinos authorized by %s. Gambling laws and regulations with %s license', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: Casinos autorizados por %s: el proceso de configuración flexible, rentable y sencillo con un montón de ventajas. Casinos en línea autorizados por %s
		}
	}

	//Tax: Bonuses Types
	if(is_tax('bonuses_types')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('The best casino games with %s for mobile or desktop. SlotoGate.com and popular casinos with %s will delight you with a selection of great games', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: Los mejores juegos de casino con %s para móviles u ordenadores. SlotoGate.com y populares casinos con %s te deleitarán con una selección de los juegos geniales
		}
	}
	//Tax: Bonuses Countries
	if(is_tax('bonuses_countries')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		$country_term_name = get_field('country_native_name', $taxonomy.'_'.$term_id); if($country_term_name){$detect_country_term_name = $country_term_name;}else{$detect_country_term_name = get_term($term_id)->name;}
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('The highest paying online casinos in %s with big bonuses. Licensed Casinos, Fast Payouts - SlotoGate.com features online betting in %s', 'websitelangid'), array($detect_country_term_name, $detect_country_term_name));
			//SPANISH: Los casinos en línea que pagan más en %s con bonos grandes. Casinos autorizados, pagos rápidos - SlotoGate.com presenta apuestas en línea en %s
		}
	}

	//Tax: Tables Games Categories
	if(is_tax('table_games_categories')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$get_wpseo_taxonomy_meta = get_option('wpseo_taxonomy_meta'); $get_wpseo_desc = $get_wpseo_taxonomy_meta[$taxonomy][$term_id]['wpseo_desc'];
		if(empty($get_wpseo_desc)){
			$desc = vsprintf(__('Find the most popular online %s games here. Play for free or for real money - keep scrolling SlotoGate.com to find our list of the best %s casinos. Play now!', 'websitelangid'), array($queried_object->name, $queried_object->name));
			//SPANISH: Encuentra aquí %s más populares en línea. Juega gratis o por dinero real: sigue desplazándose SlotoGate.com para encontrar nuestra lista de los mejores casinos de %s. Obtén ofertas de bonos de bienvenida
		}
	}

	return $desc;
}
add_filter('wpseo_metadesc','custom_meta');
add_filter('wpseo_opengraph_desc', 'custom_meta');
/*FILTER YOAST SCHEMA*/
function filter_wpseo_schema_collectionpage($data){
	//Archives: Slots
	if(is_post_type_archive('slots') and !is_admin()){
		if(isset($data['name'])){
			$data['name'] = sprintf(__('Best Online Slots in %s: Top Slots with the Highest Payout Percentage', 'websitelangid'), date('Y'));
		}
		if(isset($data['description'])){
			$data['description'] = sprintf(__('Find the best %s slots with the Highest Payout Percentage. Check out our complete guide from true experts! The list of casino slot machine games with the highest RTP and bonuses!', 'websitelangid'), date('Y'));
		}
	}
	//Archives: Casinos
	if(is_post_type_archive('casinos') and !is_admin()){
		if(isset($data['name'])){
			$data['name'] = sprintf(__('Best Online Casinos in %s | Top Casino Sites Lists and Ratings', 'websitelangid'), date('Y'));
		}
		if(isset($data['description'])){
			$data['description'] = __('Top legal casinos in your region. We provide the ultimate updated list of best online casinos with country-specific ratings and in-depth reviews. Only trusted casino sites', 'websitelangid');
		}
	}
	//Archives: Bonuses
	if(is_post_type_archive('bonuses') and !is_admin()){
		if(isset($data['name'])){
			$data['name'] = __('Best Online Casino Bonuses: Choose, Try and Claim for Best Casino Offers', 'websitelangid');
		}
		if(isset($data['description'])){
			$data['description'] = __('Comprehensive list of excellent online casino bonuses and offers! We have prepared a detailed review that is useful for both novice and advanced players', 'websitelangid');
		}
	}
	//Archives: Table Games
	if(is_post_type_archive('table_games') and !is_admin()){
		if(isset($data['name'])){
			$data['name'] = __('Casino Table Games: Best Places to Play | Rules, Game, Basic Tactics', 'websitelangid');
		}
		if(isset($data['description'])){
			$data['description'] = __('The important information about casino table games: description of the most popular games, a few words about strategy, bonuses, pros and cons and answers to frequently asked questions', 'websitelangid');
		}
	}

	//Post Type: Slots
	if(is_singular('slots')){
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s Online Slot: Know Your Game and Play for Fun', 'websitelangid'), get_the_title());
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('Find all necessary information you didn’t know about %s slot. Explore the rules, try new bonuses and learn %s slot winning strategy', 'websitelangid'), array(get_the_title(), get_the_title()));
		}
	}
	//Post Type: Casinos
	if(is_singular('casinos')){
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s Review: Features, Bonuses and Overall Experience', 'websitelangid'), get_the_title());
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('Detailed analysis of %s gaming experience. Save your time and explore all advantages and disadvantages of %s below', 'websitelangid'), array(get_the_title(), get_the_title()));
		}
	}
	//Post Type: Table Games
	if(is_singular('table_games')){
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s: Enjoy Fair Gameplay for Free or for Real Money', 'websitelangid'), get_the_title());
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('Never played %s for fun and excitement? Afraid to lose your money or just fail? Try your hand at this table game and find out that %s is not just for expert players', 'websitelangid'), array(get_the_title(), get_the_title()));
		}
	}

	//Tax: Slots Providers
	if(is_tax('slots_providers')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s Slot Provider: Top-Quality Casino Games and Online Slots', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('%s is a casino games provider delivering high-quality products. Check the wide range of online slots from %s and learn more about what it has to offer', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}
	//Tax: Slots Types
	if(is_tax('slots_types')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s Online Slots: Find and Play Your Favorite Free Game', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('All kinds of %s slots machines featured at SlotoGate.com - Free and for real money, no download slot games. Get ready to play authentic %s slots online', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}
	//Tax: Slots Themes
	if(is_tax('slots_themes')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s Slot Machines - Popular Online Games You Need', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('The best slot developers with their %s slots online! Enjoy new trends, new themes, and new interactivity. SlotoGate.com features popular %s slots online for your gaming pleasure', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}
	//Tax: Slots Features
	if(is_tax('slots_features')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s Online Slots: Play Classic Slots Online for Free or Money', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('Find slot games with %s at SlotoGate.com - No download or deposit required - No registration. Win top prize on %s slots', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}
	//Tax: Slots Tags
	if(is_tax('slots_tags')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = vsprintf(__('Best %s in %s - Play for Free on Your Tablet or Phone', 'websitelangid'), array($queried_object->name, date('Y')));
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('Most popular %s slot games for mobile or desktop. SlotoGate.com and valued software providers of %s will delight you with a selection of great games', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}

	//Tax: Casinos Categories
	if(is_tax('casinos_categories')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s: List of Top-Rated Casinos for Dedicated Players', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = sprintf(__('Find the information about all %s and pick the one that suits your requirements and preferences. Choose only responsible gaming experience', 'websitelangid'), $queried_object->name);
		}
	}
	//Tax: Casinos Countries
	if(is_tax('casinos_countries')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$country_term_name = get_field('country_native_name', $taxonomy.'_'.$term_id); if($country_term_name){$detect_country_term_name = $country_term_name;}else{$detect_country_term_name = get_term($term_id)->name;}
		if(isset($data['name'])){
			$data['name'] = vsprintf(__('%s Online Casinos. Best Places to Bet in %s - Full List', 'websitelangid'), array($detect_country_term_name, $detect_country_term_name));
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('Casino bonuses and incentives, exclusive offers in %s right here. SlotoGate.com suggests reading reviews and choosing from the best online casinos available in %s', 'websitelangid'), array($detect_country_term_name, $detect_country_term_name));
		}
	}
	//Tax: Casinos Deposits
	if(is_tax('casinos_deposits')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s Deposit - Casinos to Play for Free or Real Money - Choose at SlotoGate.com', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('Choose from all the best online %s deposit casinos available in your country. Play for free or for real money - Full and trusted reviews of casinos with %s', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}
	//Tax: Casinos Withdrawals
	if(is_tax('casinos_withdrawals')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s Withdrawal Methods at Best Online Casinos - Fast and Secure', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('Looking for the best online casino where %s withdrawals are quick and easy? Online casinos offer instant %s payouts with a single click. We prepared the list', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}
	//Tax: Casinos Types
	if(is_tax('casinos_types')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s Portable Casinos with the Maximum and Minimum Bids - SlotoGate.com', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('Easy to make a deposit, simple verification. Best and trusted %s online casino providers. %s casinos - no difficulties with withdrawal. Play for free or real money', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}
	//Tax: Casinos Currencies
	if(is_tax('casinos_currencies')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s Online Casinos - Play with Local Currency any Online Casino', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('Most convenient payment gateways for each country. Find the list of the best betting sites with %s supported by your local currency. Play at casinos with %s', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}
	//Tax: Casinos Languages
	if(is_tax('casinos_languages')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('Best %s Casinos - Discover New Trusted Casinos Online Here', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('The best online casinos for players from %s. SlotoGate.com contains a list of the safest and most trusted casino sites for the whole world. Find your favorite casino games from %s', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}
	//Tax: Casinos Licenses
	if(is_tax('casinos_licenses')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s Casino License - Gambling Laws and Regulations - Advantages', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('Casinos - Flexible, profitable, and easy setup process with lots of benefits. Online casinos authorized by %s. Gambling laws and regulations with %s license', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}

	//Tax: Bonuses Types
	if(is_tax('bonuses_types')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('Best %s Casinos - Play for Free or Real Money Online. Great Offers!', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('The best casino games with %s for mobile or desktop. SlotoGate.com and popular casinos with %s will delight you with a selection of great games', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}
	//Tax: Bonuses Countries
	if(is_tax('bonuses_countries')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		$country_term_name = get_field('country_native_name', $taxonomy.'_'.$term_id); if($country_term_name){$detect_country_term_name = $country_term_name;}else{$detect_country_term_name = get_term($term_id)->name;}
		if(isset($data['name'])){
			$data['name'] = sprintf(__('Best Casino Bonuses in %s - Real Money Websites - Gaming Platforms', 'websitelangid'), $detect_country_term_name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('The highest paying online casinos in %s with big bonuses. Licensed Casinos, Fast Payouts - SlotoGate.com features online betting in %s', 'websitelangid'), array($detect_country_term_name, $detect_country_term_name));
		}
	}

	//Tax: Table Games Categories
	if(is_tax('table_games_categories')){
		$queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;
		if(isset($data['name'])){
			$data['name'] = sprintf(__('%s Free or Real Money: Table Games in Online Casinos - Choose and Play', 'websitelangid'), $queried_object->name);
		}
		if(isset($data['description'])){
			$data['description'] = vsprintf(__('Find the most popular online %s games here. Play for free or for real money - keep scrolling SlotoGate.com to find our list of the best %s casinos. Play now!', 'websitelangid'), array($queried_object->name, $queried_object->name));
		}
	}

	return $data;
}
add_filter('wpseo_schema_collectionpage', 'filter_wpseo_schema_collectionpage');
?>