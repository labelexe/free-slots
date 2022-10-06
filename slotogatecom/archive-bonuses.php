<?php get_header();?>
<?php
$country_detect = do_shortcode('[useriploc type="country"]');
if($country_detect){
	$country_detect_term = get_term_by('name', $country_detect, 'casinos_countries');
	if($country_detect_term){
		$country_detect_native_name = get_field('country_native_name', 'casinos_countries_'.$country_detect_term->term_id);
		if($country_detect_native_name){
			$country_native_name = $country_detect_native_name;
		}else{
			$country_native_name = $country_detect;
		}
	}else{
		$country_native_name = $country_detect;
	}
}else{
	$country_native_name = '';
}
?>
		<?php $archive_bonuses_content = get_field('archive_bonuses_content', 'option'); if($archive_bonuses_content){?>
		<div class="content-zone float">
			<div class="align">
				<section>
					<div class="taxonomy-archive-intro">
						<div class="taxonomy-archive-content">
							<?php echo $archive_bonuses_content;?>
						</div>
						<div class="taxonomy-archive-image">
							<?php $archive_bonuses_image = get_field('archive_bonuses_image', 'option'); if($archive_bonuses_image){echo wp_get_attachment_image($archive_bonuses_image, 'full');}else{echo '<img width="395" height="325" src="'.get_bloginfo('template_url').'/images/tax-image-placeholder.png" alt="'.__('Casino', 'websitelangid').'"/>';}?>
						</div>
					</div>
				</section>
			</div>
		</div>
		<?php }?>
		<div class="content-zone archive-listings float">
			<div class="align">
				<section>
					<header>
						<h3><?php echo sprintf(__('The Best Casino Bonuses Available in %s ', 'websitelangid'), $country_native_name).wp_date('Y');?></h3>
						<p><?php echo __('Please Rate Our Bonuses Collection', 'websitelangid');?></p>
						<?php echo do_shortcode('[gdrts_stars_rating type="custom.free" id="3"]');?>
					</header>
					<?php
					if(is_paged()){
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							$_SESSION['type'] = $_POST['type'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_type = $_SESSION['type'];
						}else{
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_type = $_SESSION['type'];
						}
					}else{
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							$_SESSION['type'] = $_POST['type'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_type = $_SESSION['type'];
						}else{
							$_SESSION['orderby'] = '';
							$_SESSION['type'] = '';
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_type = $_SESSION['type'];
						}
					}
					?>
					<button id="ToggleFiltersButton"><span class="show-filters-text"><?php echo __('Show filters', 'websitelangid');?></span><span class="hide-filters-text"><?php echo __('Hide filters', 'websitelangid');?></span><i class="fas fa-chevron-down"></i></button>
					<form id="ToggleFiltersContent" class="filter-form bonuses-filter" method="post">
<script>
jQuery('#ToggleFiltersButton').click(function(){
	jQuery('#ToggleFiltersButton').toggleClass('active');
	jQuery('#ToggleFiltersContent').toggleClass('active');
});
</script>
						<div class="filter-infoblock">
							<p><span id="ItemsCount"></span> <?php echo __('p[
								]lkjgxz Found for Players', 'websitelangid');?><?php if($country_native_name){echo ' '.__('from', 'websitelangid').' '.do_shortcode('[useriploc type="flag" height="20px" width="auto"]').' '.$country_native_name;}?></p>
						</div>
						<div class="filter-selects">
							<div class="filter-selects-wrapper filter-selects-2-cols">
								<div>
									<p>
										<label><?php echo __('Order By', 'websitelangid');?>:</label>
										<select name="orderby">
											<option value="rand" <?php if($FilterSessionSave_orderby == 'rand' or $FilterSessionSave_orderby == ''){echo 'selected="selected"';}?>><?php echo __('Popular', 'websitelangid');?></option>
											<option value="date-desc" <?php if($FilterSessionSave_orderby == 'date-desc'){echo 'selected="selected"';}?>><?php echo __('New to Old', 'websitelangid');?></option>
											<option value="date-asc" <?php if($FilterSessionSave_orderby == 'date-asc'){echo 'selected="selected"';}?>><?php echo __('Old to New', 'websitelangid');?></option>
										</select>
									</p>
								</div>
								<?php $bonuses_types = get_terms(array('taxonomy'=>'bonuses_types')); if($bonuses_types){?>
								<div>
									<p>
										<label><?php echo __('Bonus Type', 'websitelangid');?>:</label>
										<select name="type">
											<option value="" <?php if($FilterSessionSave_type == '' or $FilterSessionSave_type == 0){echo 'selected="selected"';}?>><?php echo __('All Types', 'websitelangid');?></option>
											<?php foreach($bonuses_types as $bonuses_type){echo '<option value="'.$bonuses_type->term_id.'"'; if($FilterSessionSave_type == $bonuses_type->term_id){echo 'selected="selected"';} echo '>'.$bonuses_type->name.'</option>';}?>
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
										<input type="submit" value="<?php echo __('Filter Bonuses', 'websitelangid');?>"/>
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
		jQuery('select[name="orderby"]', '.bonuses-filter').val('rand').prop('selected', false);
		jQuery('select[name="type"]', '.bonuses-filter').val('').prop('selected', false);
		jQuery('.bonuses-filter').submit();
	});
});
</script>
					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged'):1;
					/*ODER*/
					if($FilterSessionSave_orderby == 'rand'){
						$bonuses_orderby = 'rand';
						$bonuses_order = 'DESC';
					}elseif($FilterSessionSave_orderby == 'date-desc'){
						$bonuses_orderby = 'date';
						$bonuses_order = 'DESC';
					}elseif($FilterSessionSave_orderby == 'date-asc'){
						$bonuses_orderby = 'date';
						$bonuses_order = 'ASC';
					}else{
						$bonuses_orderby = 'rand';
						$bonuses_order = 'DESC';
					}
					
					/*TYPE*/
					if($FilterSessionSave_type != '' or $FilterSessionSave_type != 0){
						$type = array('taxonomy'=>'bonuses_types', 'field'=>'id', 'terms'=>array($FilterSessionSave_type));
					}
					
					/*COUNTRY*/
					if($country_detect){
						$country = array('taxonomy'=>'bonuses_countries', 'field'=>'name', 'terms'=>$country_detect);
					}
					
					$args = array('post_type'=>'bonuses', 'orderby'=>$bonuses_orderby, 'order'=>$bonuses_order, 'paged'=>$paged, 'tax_query'=>array($type, $country));
					query_posts($args);
					$count_current_posts = $wp_query->found_posts;
					?>
<script>jQuery("#ItemsCount").text("<?php echo $count_current_posts;?>");</script>
					<?php if(have_posts()):?>
					<div class="bonuses-listing-header">
						<div class="bonuses-listing-header-wrapper">
							<div class="bonuses-listing-header-casino"><p><?php echo __('Casino', 'websitelangid');?></p></div>
							<div class="bonuses-listing-header-rating"><p><?php echo __('Rating', 'websitelangid');?></p></div>
							<div class="bonuses-listing-header-type"><p><?php echo __('Type', 'websitelangid');?></p></div>
							<div class="bonuses-listing-header-bonus"><p><?php echo __('Bonus', 'websitelangid');?></p></div>
							<div class="bonuses-listing-header-actions"><p><?php echo __('Actions', 'websitelangid');?></p></div>
						</div>
					</div>
					<ul class="bonuses-listing-table">
						<?php while(have_posts()):the_post();?>
						<?php get_template_part('template', 'bonuses-listing');?>
						<?php endwhile;?>
					</ul>
					<?php wp_pagenavi();?>
					<?php else:?>
					<p style="text-align:center;"><?php echo __('Nothing found', 'websitelangid');?>.</p>
					<?php endif;?>
				</section>
			</div>
		</div>
		<?php if(have_rows('archive_bonuses_features', 'option')):?>
		<div class="content-zone features-line float">
			<div class="align">
				<section>
					<header>
						<h3><?php the_field('archive_bonuses_features_heading', 'option');?></h3>
					</header>
					<?php the_field('archive_bonuses_features_desc', 'option');?>
					<ul class="features-list">
						<?php while(have_rows('archive_bonuses_features', 'option')):the_row();?>
						<li>
							<?php the_sub_field('archive_bonuses_feature_icon');?>
							<div class="feature-title"><strong><?php the_sub_field('archive_bonuses_feature_title');?></strong></div>
							<div class="feature-desc"><?php the_sub_field('archive_bonuses_feature_desc');?></div>
						</li>
						<?php endwhile;?>
					</ul>
				</section>
			</div>
		</div>
		<?php endif;?>
		<?php if(have_rows('archive_bonuses_counter_slides', 'option')):?>
		<div class="content-zone counter-slider-line counter-slider-block-id-bonuses float">
			<div class="align">
				<section>
					<div class="counter-slider-line-noise">
						<div class="counter-slider-line-position">
							<header>
								<h3><?php the_field('archive_bonuses_counter_slider_heading', 'option');?></h3>
							</header>
							<?php the_field('archive_bonuses_counter_slider_desc', 'option');?>
							<div class="owl-carousel">
								<?php $counter_slider_count = 1; while(have_rows('archive_bonuses_counter_slides', 'option')):the_row();?>
								<div>
									<div class="counter-slide-block-count"><?php echo $counter_slider_count;?></div>
									<div class="counter-slide-block-title"><strong><?php the_sub_field('archive_bonuses_counter_slide_title');?></strong></div>
									<div class="counter-slide-block-desc"><?php the_sub_field('archive_bonuses_counter_slide_desc');?></div>
									<?php if(have_rows('archive_bonuses_counter_slide_advantages')):?>
									<div class="counter-slide-block-advantages">
										<?php $counter_slide_advantages_heading = get_sub_field('archive_bonuses_counter_slide_advantages_heading'); if($counter_slide_advantages_heading){echo '<div>'.$counter_slide_advantages_heading.'</div>';}?>
										<ul>
											<?php while(have_rows('archive_bonuses_counter_slide_advantages')):the_row();?>
											<li><i class="fas fa-check"></i><?php the_sub_field('archive_bonuses_counter_slide_advantage');?></li>
											<?php endwhile;?>
										</ul>
									</div>
									<?php endif;?>
								</div>
								<?php $counter_slider_count++; endwhile;?>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
<script>
jQuery(window).on('load', function(){
	var owl_id_counter_slider_bonuses = jQuery('.counter-slider-block-id-bonuses .owl-carousel');
	owl_id_counter_slider_bonuses.owlCarousel({
		stageElement:'ul',
		itemElement:'li',
		items:1,
		responsive:{0:{items:1}, 711:{items:2}, 1101:{items:3}},
		margin:20,
		loop:false,
		mouseDrag:false,
		nav:true,
		dots:true,
		rewind:true,
		navText:['<i class="fas fa-long-arrow-alt-left"></i>','<i class="fas fa-long-arrow-alt-right"></i>'],
	});
});
</script>
		<?php endif;?>
		<?php if(have_rows('archive_bonuses_media_text', 'option')):while(have_rows('archive_bonuses_media_text', 'option')):the_row();?>
		<div class="content-zone media-content-line <?php if(get_sub_field('archive_bonuses_media_text_dark_background') == true){echo 'media-content-line-dark';}?> <?php if(get_sub_field('archive_bonuses_media_text_align_right') == true){echo 'media-content-line-right';}?> float">
			<div class="media-content-background-image">
				<div class="media-content-background-image-wrapper" style="background-image:url(<?php $archive_bonuses_media_text_background_image = get_sub_field('archive_bonuses_media_text_background_image'); if($archive_bonuses_media_text_background_image){echo $archive_bonuses_media_text_background_image;}else{echo get_bloginfo('template_url').'/images/media-block-bg.jpg';}?>);"></div>
			</div>
			<div class="align">
				<section>
					<?php the_sub_field('archive_bonuses_media_text_content');?>
				</section>
			</div>
		</div>
		<?php endwhile; endif;?>
		<?php if(have_rows('archive_bonuses_icons_slider', 'option')):?>
		<div class="content-zone icons-slider-line icons-slider-block-id-bonuses float">
			<div class="align">
				<section>
					<header>
						<h3><?php the_field('archive_bonuses_icons_slider_heading', 'option');?></h3>
					</header>
					<?php the_field('archive_bonuses_icons_slider_desc', 'option');?>
					<div class="owl-carousel">
						<?php while(have_rows('archive_bonuses_icons_slider', 'option')):the_row();?>
						<div>
							<?php the_sub_field('archive_bonuses_icons_slider_icon');?>
							<div class="icons-slide-block-title"><strong><?php the_sub_field('archive_bonuses_icons_slider_title');?></strong></div>
							<div class="icons-slide-block-desc"><?php the_sub_field('archive_bonuses_icons_slider_desc');?></div>
						</div>
						<?php endwhile;?>
					</div>
				</section>
			</div>
		</div>
<script>
jQuery(window).on('load', function(){
	var owl_id_icons_slider_bonuses = jQuery('.icons-slider-block-id-bonuses .owl-carousel');
	owl_id_icons_slider_bonuses.owlCarousel({
		stageElement:'ul',
		itemElement:'li',
		items:1,
		responsive:{0:{items:1}, 711:{items:2}, 1101:{items:3}},
		margin:5,
		loop:false,
		mouseDrag:false,
		nav:true,
		dots:true,
		rewind:true,
		navText:['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
	});
});
</script>
		<?php endif;?>
		<?php if(have_rows('archive_bonuses_cta_links', 'option')):?>
		<div class="content-zone cta-line float">
			<div class="align">
				<aside>
					<div class="cta-line-position">
						<header>
							<h5><?php the_field('archive_bonuses_cta_heading', 'option');?></h5>
						</header>
						<div class="cta-buttons">
							<?php while(have_rows('archive_bonuses_cta_links', 'option')):the_row();?>
							<a href="<?php the_sub_field('archive_bonuses_cta_link_url');?>"><?php the_sub_field('archive_bonuses_cta_link_title');?></a>
							<?php endwhile;?>
						</div>
					</div>
				</aside>
			</div>
		</div>
		<?php endif;?>
		<?php if(have_rows('archive_bonuses_additional_content', 'option')):?>
		<?php while(have_rows('archive_bonuses_additional_content', 'option')):the_row();?>
		<div class="content-zone float">
			<div class="align">
				<section>
					<?php the_sub_field('archive_bonuses_additional_content_block');?>
				</section>
			</div>
		</div>
		<?php endwhile;?>
		<?php endif;?>
		<?php if(have_rows('archive_bonuses_faq', 'option')):?>
		<div class="content-zone faq-line float">
			<div class="align">
				<section>
					<header>
						<h3><?php the_field('archive_bonuses_faq_heading', 'option');?></h3>
					</header>
					<?php while(have_rows('archive_bonuses_faq', 'option')):the_row();?>
					<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
						<h3 class="accordion"><i class="fas fa-plus"></i><i class="fas fa-minus"></i><span itemprop="name"><?php the_sub_field('question');?></span></h3>
						<div class="panel" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
							<div itemprop="text"><?php the_sub_field('answer');?></div>
						</div>
					</div>
					<?php endwhile;?>
				</section>
			</div>
		</div>
		<?php endif;?>
		<div class="content-zone image-blocks-line float">
			<div class="align">
				<aside>
					<header>
						<h5><?php the_field('also_like_heading', 'option');?></h5>
					</header>
					<?php if(have_rows('also_like_items', 'option')):?>
					<ul>
						<?php while(have_rows('also_like_items', 'option')):the_row();?>
						<li>
							<?php echo wp_get_attachment_image(get_sub_field('also_like_image'), 'full');?>
							<div class="image-block-title"><strong><?php the_sub_field('also_like_title');?></strong></div>
							<div class="image-block-desc"><?php the_sub_field('also_like_description');?></div>
							<div class="image-block-link"><a href="<?php the_sub_field('also_like_link');?>"><?php echo __('Explore', 'websitelangid');?></a></div>
						</li>
						<?php endwhile;?>
					</ul>
					<?php endif;?>
				</aside>
			</div>
		</div>
<?php get_footer();?>