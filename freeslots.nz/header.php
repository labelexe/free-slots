<?php
if($_GET['type'] != '' and $_GET['go_to_id'] != ''){
	if($_GET['type'] == 'casino_page'){
		wp_redirect(rtrim(home_url(), '/').'/go/?redirect_type=casino_page&redirect_go_to_id='.$_GET['go_to_id']);
		exit;
	}elseif($_GET['type'] == 'bonus_page'){
		wp_redirect(rtrim(home_url(), '/').'/go/?redirect_type=bonus_page&redirect_go_to_id='.$_GET['go_to_id']);
		exit;
	}
}
if($_GET['redirect_type'] != '' and $_GET['redirect_go_to_id'] != ''){
	if($_GET['redirect_type'] == 'casino_page'){
		$get_redirection_link = get_field('casino_website_link', $_GET['redirect_go_to_id']);
	}elseif($_GET['redirect_type'] == 'bonus_page'){
		$get_redirection_link = get_field('bonus_claim_link', $_GET['redirect_go_to_id']);
	}else{
		$get_redirection_link = null;
	}
	
	if($get_redirection_link){
		header("Location: ".$get_redirection_link);
		die;
	}
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width" />
<link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="<?php bloginfo( 'template_url' ); ?>/assets/img/favikon.png"
    />
<?php
### Title and meta generation for product pages
$listing_slot_id_original = apply_filters('wpml_object_id', get_the_ID(), 'slots', true, 'en');
	$slot_id_original = apply_filters('wpml_object_id', $slot_id, 'slots', true, 'en');
	$slots_providers = wp_get_post_terms(get_the_ID(), 'slots_providers');
	$meta_providers = $slots_providers[0]->name;
	$meta_title = get_the_title();
if( strpos($_SERVER['REQUEST_URI'], '/slots/') !== FALSE) {
    echo "<title> $meta_title Slot - Play Free Online Slot by $meta_providers No Registration </title>";
    
}

?>

<?php
### Title and meta generation for product pages
$slots_return_to_player = get_field('slots_return_to_player');
if( strpos($_SERVER['REQUEST_URI'], '/slots/') !== FALSE) {
    echo "<meta name='description' content='$meta_title slot for free online with the option to change for real money. The game has been designed and developed by $meta_providers gaming and has high RTP $slots_return_to_player
' />";
    
}

?>

<link rel="preload" href="<?php wp_enqueue_style( 'fonts', get_template_directory_uri() .'/assets/font/fonts.css' ); ?>" as="font" type="font/woff2" crossorigin>

<?php
  wp_register_style('fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap', false, null);
  wp_enqueue_style('fonts');
?>

<?php wp_head();?>
	<?php $url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0]; ?>
<link rel="alternate" hreflang="en_ZA" href="https://free-slots.co.za<?php echo $url; ?>"/>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-232414357-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-232414357-1');
</script>

</head>

  <body>
    <header class="container js-page-header">
      <nav>
	      <a href="<?php bloginfo('url');?>" class="logo" >
          <span>FREE</span>SLOTS.NZ
        </a>
        <!-- <?php the_custom_logo( $blog_id ); ?> -->

        <div class="menu-container">
          <div id="nav__burger-menu" class="nav__burger-menu">
            <div class="burger-menu_button">
              <span class="burger-menu_lines"></span>
            </div>
          </div>
  
          <div id="burger-menu_nav" class="burger-menu_nav">
            <label class="menu_nav-label" for="">
              <?php echo do_shortcode('[wd_asp id=2]');?>
            </label>
            <ul>
              <li>
              <?php wp_nav_menu(array('theme_location'=>'main_menu'));?>
              </li>
              <li class="burger-menu_link providers">
                <div class="other_games"><?php the_field('other_games_text', 'option');?>
                  <svg class="burger-menu_link-svg">
                    <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Icon"></use>
                  </svg>
                 
                </div>
                 <div class="menu-link__subitem">
                  <ul class="menu-link__subitem-item">

                  <?php while(have_rows('other_games', 'option')):the_row();?>
                    <li class="subitem__list">
                      <a href="<?php the_sub_field('games_link');?>" class="subitem__list-link"><?php the_sub_field('games_text');?></a>
                    </li>
                  <?php endwhile;?>
                 
                  </ul>
                </div>
              </li>
              </ul>
                </div>
          </div>
          <div class="site-lang">
					
					<div id="language__menu" class="language__menu">
          <div class="language__menu-button">
						<?php do_action('wpml_add_language_selector');?>
          </div>
          </div>
<script>
jQuery('.top-line .site-lang nav div > ul > li > a .wpml-ls-native').text('<?php echo ICL_LANGUAGE_CODE;?>');
	 $(document).ready(function() {
        $("a[href='https://free-slots.co.za/home']").prop("href", "https://free-slots.co.za/");
});
</script>	
        </div>
      </nav>
    </header>
<main>
<?php if(!is_front_page()){if(function_exists('yoast_breadcrumb')){?>
	<div class="breadcrumbs-line float container">
		<div class="align">
			<nav>
				<?php yoast_breadcrumb('<p id="breadcrumbs">','</p>');?>
			</nav>
		</div>
	</div>
	<?php }}?>