<?php get_header();?>
<?php $queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id; $term_name = $queried_object->name;?>
<?php $term_id_original = apply_filters('wpml_object_id', $term_id, $taxonomy, true, 'en');?>
<?php
$country_detect = do_shortcode('[useriploc type="country"]');
$tax_slots_ordering = get_field('tax_slots_ordering', $taxonomy.'_'.$term_id);
?>
<?php
if(have_rows('flexible_blocks_top', $taxonomy.'_'.$term_id)):while(have_rows('flexible_blocks_top', $taxonomy.'_'.$term_id)):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
		<div class="content-zone float">
			<div class="align">
				<section>
					<div class="taxonomy-archive-intro taxonomy-archive-intro-align-top">
						<div class="taxonomy-archive-content">
							<?php if(term_description()){?>
								<?php echo term_description();?>
							<?php }else{?>
								<?php echo vsprintf(__('<h2>%s Slot Machine Games</h2><p>%s slot machine games have become one of the most widespread themes due to its simplicity and great winning potential. It won’t take much time and effort to figure out %s slot machine games. You will see how fun they can be! Just try one of the %s slot machine games now!</p>', 'websitelangid'), array($term_name, $term_name, $term_name, $term_name));?>
							<?php }?>
						</div>
						<div class="taxonomy-archive-image">
							<?php if($country_detect){$casinos_slides = get_posts(array('suppress_filters'=>false, 'numberposts'=>3, 'post_type'=>'casinos', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'meta_key'=>'overall_reviews_rating', 'tax_query'=>array(array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect)))); if($casinos_slides){?>
							<aside class="provider-slots-archive-slider">
								<header>
									<h5><?php echo __('Best Online Casinos with Real Money Slots', 'websitelangid');?></h5>
								</header>
								<div class="owl-carousel">
									<?php foreach($casinos_slides as $post){setup_postdata($post);?>
									<?php
									$loop_casino_website_link = get_field('casino_website_link');
									$loop_casino_pros = get_field('casino_pros');
									$loop_casino_bonuses_relationship = get_field('casino_bonuses_relationship');
									?>
									<div>
										<?php if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="150" height="150" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>
										<div class="provider-slide-casino-desc"><?php echo __('Welcome Bonus', 'websitelangid');?>:<br>
											<div><img width="16" height="16" src="<?php bloginfo('template_url');?>/images/icons/bonus-icon.svg" alt="Bonus Icon" loading="lazy"/>
											<?php
											if($loop_casino_bonuses_relationship){
												foreach($loop_casino_bonuses_relationship as $loop_casino_bonuses_relationship_item){
													$loop_bonuses_types = wp_get_post_terms($loop_casino_bonuses_relationship_item->ID, 'bonuses_types');
													if($loop_bonuses_types[0]->name = 'Welcome Bonus'){
														$loop_bonus_description = get_field('bonus_description', $loop_casino_bonuses_relationship_item->ID);
														$loop_bonus_country_descriptions = get_field('bonus_country_descriptions', $loop_casino_bonuses_relationship_item->ID);
														if($country_detect and $loop_bonus_country_descriptions){
															foreach($loop_bonus_country_descriptions as $loop_bonus_country_description){
																if($loop_bonus_country_description['bonus_country_select']->name == $country_detect){
																	$loop_bonus_country_detected_desc = $loop_bonus_country_description['bonus_country_description'];
																	break;
																}else{
																	$loop_bonus_country_detected_desc = '';
																}
															}
															if($loop_bonus_country_detected_desc != ''){
																echo $loop_bonus_country_detected_desc;
															}else{
																if($loop_bonus_description){echo $loop_bonus_description;}else{echo '-';}
															}
														}else{
															if($loop_bonus_description){echo $loop_bonus_description;}else{echo '-';}
														}
														break;
													}
												}
											}else{echo '-';}
											?>
											</div>
										</div>
										<?php if($loop_casino_pros){?>
										<div class="provider-slide-casino-pros">
											<?php $casino_pros_count = 1; foreach($loop_casino_pros as $loop_casino_pros_item){?>
											<div><mark><i class="fas fa-check"></i><?php echo $loop_casino_pros_item['pros_name'];?></mark></div>
											<?php if($casino_pros_count == 3){break;}?>
											<?php $casino_pros_count++;}?>
										</div>
										<?php }?>
										<div class="provider-slide-casino-cta">
											<?php if($loop_casino_website_link){?><a class="provider-slide-casino-cta-featured" href="<?php echo rtrim(home_url(), '/');?>/go/?type=casino_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Play Now', 'websitelangid');?></a><?php }?>
											<a href="<?php the_permalink();?>"><?php echo __('Read Review', 'websitelangid');?></a>
										</div>
									</div>
									<?php } wp_reset_postdata();?>
								</div>
								<?php $bonus_offers_link = get_field('bonus_offers_link', 'option'); if($bonus_offers_link){?>
								<footer>
									<a href="<?php echo $bonus_offers_link;?>"><?php echo __('More Bonus Offers', 'websitelangid');?></a>
								</footer>
								<?php }?>
							</aside>
<script>
jQuery(window).on('load', function(){
	var owl_id_provider_slots_archive_slider = jQuery('.provider-slots-archive-slider .owl-carousel');
	owl_id_provider_slots_archive_slider.owlCarousel({
		stageElement:'ul',
		itemElement:'li',
		items:1,
		loop:true,
		mouseDrag:false,
		nav:true,
		rewind:false,
		navText:['<i class="fas fa-long-arrow-alt-left"></i>','<i class="fas fa-long-arrow-alt-right"></i>'],
		autoplay:true,
		autoplayTimeout:8000,
		autoplaySpeed:500,
	});
});
</script>
							<?php }}?>
						</div>
					</div>
				</section>
			</div>
		</div>
		<div class="content-zone archive-listings float">
			<div class="align">
				<section>
					<header>
						<h1><?php echo sprintf(__('%s Slot Machine Games', 'websitelangid'), $queried_object->name);?></h1>
						<p><?php echo __('Please Rate this Collection', 'websitelangid');?></p>
						<?php echo do_shortcode('[gdrts_stars_rating type="terms.slots_themes" id="'.$term_id_original.'"]');?>
					</header>
					<?php
					if(is_paged()){
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							$_SESSION['provider'] = $_POST['provider'];
							$_SESSION['type'] = $_POST['type'];
							$_SESSION['feature'] = $_POST['feature'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_provider = $_SESSION['provider'];
							$FilterSessionSave_type = $_SESSION['type'];
							$FilterSessionSave_feature = $_SESSION['feature'];
						}else{
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_provider = $_SESSION['provider'];
							$FilterSessionSave_type = $_SESSION['type'];
							$FilterSessionSave_feature = $_SESSION['feature'];
						}
					}else{
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							$_SESSION['provider'] = $_POST['provider'];
							$_SESSION['type'] = $_POST['type'];
							$_SESSION['feature'] = $_POST['feature'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_provider = $_SESSION['provider'];
							$FilterSessionSave_type = $_SESSION['type'];
							$FilterSessionSave_feature = $_SESSION['feature'];
						}else{
							$_SESSION['orderby'] = '';
							$_SESSION['provider'] = '';
							$_SESSION['type'] = '';
							$_SESSION['feature'] = '';
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_provider = $_SESSION['provider'];
							$FilterSessionSave_type = $_SESSION['type'];
							$FilterSessionSave_feature = $_SESSION['feature'];
						}
					}
					?>
					<button id="ToggleFiltersButton"><span class="show-filters-text"><?php echo __('Show filters', 'websitelangid');?></span><span class="hide-filters-text"><?php echo __('Hide filters', 'websitelangid');?></span><i class="fas fa-chevron-down"></i></button>
					<form id="ToggleFiltersContent" class="filter-form slots-filter" method="post">
<script>
jQuery('#ToggleFiltersButton').click(function(){
	jQuery('#ToggleFiltersButton').toggleClass('active');
	jQuery('#ToggleFiltersContent').toggleClass('active');
});
</script>
						<div class="filter-selects">
							<div class="filter-selects-wrapper filter-selects-4-cols">
								<div>
									<p>
										<label><?php echo __('Order By', 'websitelangid');?>:</label>
										<select name="orderby">
											<option value="date" <?php if($FilterSessionSave_orderby == 'date' or $FilterSessionSave_orderby == '' and $tax_slots_ordering == 'date' or $FilterSessionSave_orderby == '' and $tax_slots_ordering == ''){echo 'selected="selected"';}?>><?php echo __('New to Old', 'websitelangid');?></option>
											<option value="title-asc" <?php if($FilterSessionSave_orderby == 'title-asc' or $FilterSessionSave_orderby == '' and $tax_slots_ordering == 'title-asc'){echo 'selected="selected"';}?>><?php echo __('A to Z', 'websitelangid');?></option>
											<option value="title-desc" <?php if($FilterSessionSave_orderby == 'title-desc' or $FilterSessionSave_orderby == '' and $tax_slots_ordering == 'title-desc'){echo 'selected="selected"';}?>><?php echo __('Z to A', 'websitelangid');?></option>
											<option value="popular" <?php if($FilterSessionSave_orderby == 'popular' or $FilterSessionSave_orderby == '' and $tax_slots_ordering == 'popular'){echo 'selected="selected"';}?>><?php echo __('Most Popular', 'websitelangid');?></option>
											<option value="rating" <?php if($FilterSessionSave_orderby == 'rating' or $FilterSessionSave_orderby == '' and $tax_slots_ordering == 'rating'){echo 'selected="selected"';}?>><?php echo __('Best Rating', 'websitelangid');?></option>
										</select>
									</p>
								</div>
								<?php $slots_providers = get_terms(array('taxonomy'=>'slots_providers')); if($slots_providers){?>
								<div>
									<p>
										<label><?php echo __('Provider', 'websitelangid');?>:</label>
										<select name="provider">
											<option value="" <?php if($FilterSessionSave_provider == '' or $FilterSessionSave_provider == 0){echo 'selected="selected"';}?>><?php echo __('All Providers', 'websitelangid');?></option>
											<?php foreach($slots_providers as $slots_provider){echo '<option value="'.$slots_provider->term_id.'"'; if($FilterSessionSave_provider == $slots_provider->term_id){echo 'selected="selected"';} echo '>'.$slots_provider->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
								<?php $slots_types = get_terms(array('taxonomy'=>'slots_types')); if($slots_types){?>
								<div>
									<p>
										<label><?php echo __('Type', 'websitelangid');?>:</label>
										<select name="type">
											<option value="" <?php if($FilterSessionSave_type == '' or $FilterSessionSave_type == 0){echo 'selected="selected"';}?>><?php echo __('All Types', 'websitelangid');?></option>
											<?php foreach($slots_types as $slots_type){echo '<option value="'.$slots_type->term_id.'"'; if($FilterSessionSave_type == $slots_type->term_id){echo 'selected="selected"';} echo '>'.$slots_type->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
								<?php $slots_features = get_terms(array('taxonomy'=>'slots_features')); if($slots_features){?>
								<div>
									<p>
										<label><?php echo __('Features', 'websitelangid');?>:</label>
										<select name="feature">
											<option value="" <?php if($FilterSessionSave_feature == '' or $FilterSessionSave_feature == 0){echo 'selected="selected"';}?>><?php echo __('All Features', 'websitelangid');?></option>
											<?php foreach($slots_features as $slots_feature){echo '<option value="'.$slots_feature->term_id.'"'; if($FilterSessionSave_feature == $slots_feature->term_id){echo 'selected="selected"';} echo '>'.$slots_feature->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
							</div>
						</div>
						<div class="filter-buttons">
							<div class="filter-buttons-wrapper filter-buttons-2-cols">
								<div>
									<p>
										<input type="submit" value="<?php echo __('Filter Slots', 'websitelangid');?>"/>
									</p>
								</div>
								<div>
									<p>
										<button class="clear-btn" type="button"><?php echo __('Clear Filter', 'websitelangid');?></button>
									</p>
								</div>
							</div>
						</div>
					</form>
<script>
jQuery(function(){
	jQuery(".clear-btn").click(function(){
		jQuery('select[name="orderby"]', '.slots-filter').val('<?php if($tax_slots_ordering == 'date'){echo 'date';}elseif($tax_slots_ordering == 'title-asc'){echo 'title-asc';}elseif($tax_slots_ordering == 'title-desc'){echo 'title-desc';}elseif($tax_slots_ordering == 'popular'){echo 'popular';}elseif($tax_slots_ordering == 'rating'){echo 'rating';}else{echo 'date';}?>').prop('selected', false);
		jQuery('select[name="provider"]', '.slots-filter').val('').prop('selected', false);
		jQuery('select[name="type"]', '.slots-filter').val('').prop('selected', false);
		jQuery('select[name="feature"]', '.slots-filter').val('').prop('selected', false);
		jQuery('.slots-filter').submit();
	});
});
</script>
					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged'):1;
					/*ODER*/
					if($FilterSessionSave_orderby == 'date' or $FilterSessionSave_orderby == '' and $tax_slots_ordering == 'date'){
						$slots_orderby = 'date';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}elseif($FilterSessionSave_orderby == 'title-asc' or $FilterSessionSave_orderby == '' and $tax_slots_ordering == 'title-asc'){
						$slots_orderby = 'title';
						$slots_order = 'ASC';
						$slots_meta_key = '';
					}elseif($FilterSessionSave_orderby == 'title-desc' or $FilterSessionSave_orderby == '' and $tax_slots_ordering == 'title-desc'){
						$slots_orderby = 'title';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}elseif($FilterSessionSave_orderby == 'popular' or $FilterSessionSave_orderby == '' and $tax_slots_ordering == 'popular'){
						$slots_orderby = 'meta_value_num';
						$slots_order = 'DESC';
						$slots_meta_key = 'wpb_post_views_count';
					}elseif($FilterSessionSave_orderby == 'rating' or $FilterSessionSave_orderby == '' and $tax_slots_ordering == 'rating'){
						$slots_orderby = 'gdrts';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}else{
						$slots_orderby = 'date';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}
					
					/*PROVIDER*/
					if($FilterSessionSave_provider != '' or $FilterSessionSave_provider != 0){
						$provider = array('taxonomy'=>'slots_providers', 'field'=>'id', 'terms'=>array($FilterSessionSave_provider));
					}
					
					/*TYPE*/
					if($FilterSessionSave_type != '' or $FilterSessionSave_type != 0){
						$type = array('taxonomy'=>'slots_types', 'field'=>'id', 'terms'=>array($FilterSessionSave_type));
					}
					
					/*FEATURE*/
					if($FilterSessionSave_feature != '' or $FilterSessionSave_feature != 0){
						$feature = array('taxonomy'=>'slots_features', 'field'=>'id', 'terms'=>array($FilterSessionSave_feature));
					}
					
					/*CURRENT TERM*/
					$current_term = array('taxonomy'=>$taxonomy, 'field'=>'id', 'terms'=>$term_id);
					
					$args = array('post_type'=>'slots', 'meta_key'=>$slots_meta_key, 'orderby'=>$slots_orderby, 'order'=>$slots_order, 'paged'=>$paged, 'tax_query'=>array($current_term, $provider, $type, $feature));
					query_posts($args);
					?>
					<?php if(have_posts()):?>
					<ul class="slots-listing">
						<?php while(have_posts()):the_post();?>
						<?php get_template_part('template', 'slots-listing');?>
						<?php endwhile;?>
					</ul>
					<?php wp_pagenavi();?>
					<?php else:?>
					<p style="text-align:center;"><?php echo __('Nothing found', 'websitelangid');?>.</p>
					<?php endif;?>
				</section>
			</div>
		</div>
<?php
if(have_rows('flexible_blocks_bottom', $taxonomy.'_'.$term_id)):while(have_rows('flexible_blocks_bottom', $taxonomy.'_'.$term_id)):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
		<?php $linking_terms = get_terms(array('taxonomy'=>$taxonomy, 'hide_empty'=>true, 'exclude'=>$term_id)); if($linking_terms){?>
		<div class="content-zone linking-line float">
			<div class="align">
				<aside>
					<header>
						<h5><?php echo __('Other Slots Themes', 'websitelangid');?></h5>
					</header>
					<ul class="linking-listings">
						<?php foreach($linking_terms as $linking_term){?>
						<li><a href="<?php echo get_term_link($linking_term->term_id);?>"><?php echo $linking_term->name;?></a></li>
						<?php }?>
					</ul>
				</aside>
			</div>
		</div>
		<?php }?>
<?php get_footer();?>