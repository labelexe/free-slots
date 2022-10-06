<?php get_header();?>
		<?php $archive_slots_content = get_field('archive_slots_content', 'option'); if($archive_slots_content){?>
		<div class="content-zone float">
			<div class="align">
				<section>
					<div class="taxonomy-archive-intro">
						<div class="taxonomy-archive-content">
							<?php echo $archive_slots_content;?>
						</div>
						<div class="taxonomy-archive-image">
							<?php $archive_slots_image = get_field('archive_slots_image', 'option'); if($archive_slots_image){echo wp_get_attachment_image($archive_slots_image, 'full');}else{echo '<img width="395" height="325" src="'.get_bloginfo('template_url').'/images/tax-image-placeholder.png" alt="'.__('Casino', 'websitelangid').'"/>';}?>
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
						<h3><?php $archive_slots_listing_heading = get_field('archive_slots_listing_heading', 'option'); if($archive_slots_listing_heading){echo $archive_slots_listing_heading;}else{post_type_archive_title();}?></h3>
						<p><?php echo __('Please Rate Our Game Collection', 'websitelangid');?></p>
						<?php echo do_shortcode('[gdrts_stars_rating type="custom.free" id="1"]');?>
					</header>
					<?php
					if(is_paged()){
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							$_SESSION['provider'] = $_POST['provider'];
							$_SESSION['theme'] = $_POST['theme'];
							$_SESSION['feature'] = $_POST['feature'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_provider = $_SESSION['provider'];
							$FilterSessionSave_theme = $_SESSION['theme'];
							$FilterSessionSave_feature = $_SESSION['feature'];
						}else{
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_provider = $_SESSION['provider'];
							$FilterSessionSave_theme = $_SESSION['theme'];
							$FilterSessionSave_feature = $_SESSION['feature'];
						}
					}else{
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							$_SESSION['provider'] = $_POST['provider'];
							$_SESSION['theme'] = $_POST['theme'];
							$_SESSION['feature'] = $_POST['feature'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_provider = $_SESSION['provider'];
							$FilterSessionSave_theme = $_SESSION['theme'];
							$FilterSessionSave_feature = $_SESSION['feature'];
						}else{
							$_SESSION['orderby'] = '';
							$_SESSION['provider'] = '';
							$_SESSION['theme'] = '';
							$_SESSION['feature'] = '';
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_provider = $_SESSION['provider'];
							$FilterSessionSave_theme = $_SESSION['theme'];
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
											<option value="date" <?php if($FilterSessionSave_orderby == 'date' or $FilterSessionSave_orderby == ''){echo 'selected="selected"';}?>><?php echo __('New to Old', 'websitelangid');?></option>
											<option value="title-asc" <?php if($FilterSessionSave_orderby == 'title-asc'){echo 'selected="selected"';}?>><?php echo __('A to Z', 'websitelangid');?></option>
											<option value="title-desc" <?php if($FilterSessionSave_orderby == 'title-desc'){echo 'selected="selected"';}?>><?php echo __('Z to A', 'websitelangid');?></option>
											<option value="popular" <?php if($FilterSessionSave_orderby == 'popular'){echo 'selected="selected"';}?>><?php echo __('Most Popular', 'websitelangid');?></option>
											<option value="rating" <?php if($FilterSessionSave_orderby == 'rating'){echo 'selected="selected"';}?>><?php echo __('Best Rating', 'websitelangid');?></option>
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
								<?php $slots_themes = get_terms(array('taxonomy'=>'slots_themes')); if($slots_themes){?>
								<div>
									<p>
										<label><?php echo __('Theme', 'websitelangid');?>:</label>
										<select name="theme">
											<option value="" <?php if($FilterSessionSave_theme == '' or $FilterSessionSave_theme == 0){echo 'selected="selected"';}?>><?php echo __('All Themes', 'websitelangid');?></option>
											<?php foreach($slots_themes as $slots_theme){echo '<option value="'.$slots_theme->term_id.'"'; if($FilterSessionSave_theme == $slots_theme->term_id){echo 'selected="selected"';} echo '>'.$slots_theme->name.'</option>';}?>
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
		jQuery('select[name="orderby"]', '.slots-filter').val('date').prop('selected', false);
		jQuery('select[name="provider"]', '.slots-filter').val('').prop('selected', false);
		jQuery('select[name="theme"]', '.slots-filter').val('').prop('selected', false);
		jQuery('select[name="feature"]', '.slots-filter').val('').prop('selected', false);
		jQuery('.slots-filter').submit();
	});
});
</script>
					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged'):1;
					/*ODER*/
					if($FilterSessionSave_orderby == 'date'){
						$slots_orderby = 'date';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}elseif($FilterSessionSave_orderby == 'title-asc'){
						$slots_orderby = 'title';
						$slots_order = 'ASC';
						$slots_meta_key = '';
					}elseif($FilterSessionSave_orderby == 'title-desc'){
						$slots_orderby = 'title';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}elseif($FilterSessionSave_orderby == 'popular'){
						$slots_orderby = 'meta_value_num';
						$slots_order = 'DESC';
						$slots_meta_key = 'wpb_post_views_count';
					}elseif($FilterSessionSave_orderby == 'rating'){
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
					
					/*THEME*/
					if($FilterSessionSave_theme != '' or $FilterSessionSave_theme != 0){
						$theme = array('taxonomy'=>'slots_themes', 'field'=>'id', 'terms'=>array($FilterSessionSave_theme));
					}
					
					/*FEATURE*/
					if($FilterSessionSave_feature != '' or $FilterSessionSave_feature != 0){
						$feature = array('taxonomy'=>'slots_features', 'field'=>'id', 'terms'=>array($FilterSessionSave_feature));
					}
					
					$args = array('post_type'=>'slots', 'meta_key'=>$slots_meta_key, 'orderby'=>$slots_orderby, 'order'=>$slots_order, 'paged'=>$paged, 'tax_query'=>array($provider, $theme, $feature));
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
		<?php if(have_rows('archive_slots_features', 'option')):?>
		<div class="content-zone features-line float">
			<div class="align">
				<section>
					<header>
						<h3><?php the_field('archive_slots_features_heading', 'option');?></h3>
					</header>
					<?php the_field('archive_slots_features_desc', 'option');?>
					<ul class="features-list">
						<?php while(have_rows('archive_slots_features', 'option')):the_row();?>
						<li>
							<?php the_sub_field('archive_slots_feature_icon');?>
							<div class="feature-title"><strong><?php the_sub_field('archive_slots_feature_title');?></strong></div>
							<div class="feature-desc"><?php the_sub_field('archive_slots_feature_desc');?></div>
						</li>
						<?php endwhile;?>
					</ul>
				</section>
			</div>
		</div>
		<?php endif;?>
		<?php if(have_rows('archive_slots_counter_slides', 'option')):?>
		<div class="content-zone counter-slider-line counter-slider-block-id-slots float">
			<div class="align">
				<section>
					<div class="counter-slider-line-noise">
						<div class="counter-slider-line-position">
							<header>
								<h3><?php the_field('archive_slots_counter_slider_heading', 'option');?></h3>
							</header>
							<?php the_field('archive_slots_counter_slider_desc', 'option');?>
							<div class="owl-carousel">
								<?php $counter_slider_count = 1; while(have_rows('archive_slots_counter_slides', 'option')):the_row();?>
								<div>
									<div class="counter-slide-block-count"><?php echo $counter_slider_count;?></div>
									<div class="counter-slide-block-title"><strong><?php the_sub_field('archive_slots_counter_slide_title');?></strong></div>
									<div class="counter-slide-block-desc"><?php the_sub_field('archive_slots_counter_slide_desc');?></div>
									<?php if(have_rows('archive_slots_counter_slide_advantages')):?>
									<div class="counter-slide-block-advantages">
										<?php $counter_slide_advantages_heading = get_sub_field('archive_slots_counter_slide_advantages_heading'); if($counter_slide_advantages_heading){echo '<div>'.$counter_slide_advantages_heading.'</div>';}?>
										<ul>
											<?php while(have_rows('archive_slots_counter_slide_advantages')):the_row();?>
											<li><i class="fas fa-check"></i><?php the_sub_field('archive_slots_counter_slide_advantage');?></li>
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
	var owl_id_counter_slider_slots = jQuery('.counter-slider-block-id-slots .owl-carousel');
	owl_id_counter_slider_slots.owlCarousel({
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
		<?php if(have_rows('archive_slots_media_text', 'option')):while(have_rows('archive_slots_media_text', 'option')):the_row();?>
		<div class="content-zone media-content-line <?php if(get_sub_field('archive_slots_media_text_dark_background') == true){echo 'media-content-line-dark';}?> <?php if(get_sub_field('archive_slots_media_text_align_right') == true){echo 'media-content-line-right';}?> float">
			<div class="media-content-background-image">
				<div class="media-content-background-image-wrapper" style="background-image:url(<?php $archive_slots_media_text_background_image = get_sub_field('archive_slots_media_text_background_image'); if($archive_slots_media_text_background_image){echo $archive_slots_media_text_background_image;}else{echo get_bloginfo('template_url').'/images/media-block-bg.jpg';}?>);"></div>
			</div>
			<div class="align">
				<section>
					<?php the_sub_field('archive_slots_media_text_content');?>
				</section>
			</div>
		</div>
		<?php endwhile; endif;?>
		<?php if(have_rows('archive_slots_icons_slider', 'option')):?>
		<div class="content-zone icons-slider-line icons-slider-block-id-slots float">
			<div class="align">
				<section>
					<header>
						<h3><?php the_field('archive_slots_icons_slider_heading', 'option');?></h3>
					</header>
					<?php the_field('archive_slots_icons_slider_desc', 'option');?>
					<div class="owl-carousel">
						<?php while(have_rows('archive_slots_icons_slider', 'option')):the_row();?>
						<div>
							<?php the_sub_field('archive_slots_icons_slider_icon');?>
							<div class="icons-slide-block-title"><strong><?php the_sub_field('archive_slots_icons_slider_title');?></strong></div>
							<div class="icons-slide-block-desc"><?php the_sub_field('archive_slots_icons_slider_desc');?></div>
						</div>
						<?php endwhile;?>
					</div>
				</section>
			</div>
		</div>
<script>
jQuery(window).on('load', function(){
	var owl_id_icons_slider_slots = jQuery('.icons-slider-block-id-slots .owl-carousel');
	owl_id_icons_slider_slots.owlCarousel({
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
		<?php if(have_rows('archive_slots_cta_links', 'option')):?>
		<div class="content-zone cta-line float">
			<div class="align">
				<aside>
					<div class="cta-line-position">
						<header>
							<h5><?php the_field('archive_slots_cta_heading', 'option');?></h5>
						</header>
						<div class="cta-buttons">
							<?php while(have_rows('archive_slots_cta_links', 'option')):the_row();?>
							<a href="<?php the_sub_field('archive_slots_cta_link_url');?>"><?php the_sub_field('archive_slots_cta_link_title');?></a>
							<?php endwhile;?>
						</div>
					</div>
				</aside>
			</div>
		</div>
		<?php endif;?>
		<?php if(have_rows('archive_slots_additional_content', 'option')):?>
		<?php while(have_rows('archive_slots_additional_content', 'option')):the_row();?>
		<div class="content-zone float">
			<div class="align">
				<section>
					<?php the_sub_field('archive_slots_additional_content_block');?>
				</section>
			</div>
		</div>
		<?php endwhile;?>
		<?php endif;?>
		<?php if(have_rows('archive_slots_faq', 'option')):?>
		<div class="content-zone faq-line float">
			<div class="align">
				<section>
					<header>
						<h3><?php the_field('archive_slots_faq_heading', 'option');?></h3>
					</header>
					<?php while(have_rows('archive_slots_faq', 'option')):the_row();?>
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