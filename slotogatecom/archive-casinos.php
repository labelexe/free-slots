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
		<?php $archive_casinos_content = get_field('archive_casinos_content', 'option'); if($archive_casinos_content){?>
		<div class="content-zone float">
			<div class="align">
				<section>
					<div class="taxonomy-archive-intro">
						<div class="taxonomy-archive-content">
							<?php echo $archive_casinos_content;?>
						</div>
						<div class="taxonomy-archive-image">
							<?php $archive_casinos_image = get_field('archive_casinos_image', 'option'); if($archive_casinos_image){echo wp_get_attachment_image($archive_casinos_image, 'full');}else{echo '<img width="395" height="325" src="'.get_bloginfo('template_url').'/images/tax-image-placeholder.png" alt="'.__('Casino', 'websitelangid').'"/>';}?>
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
						<div class="archive-listings-date"><mark><?php echo __('Updated on', 'websitelangid');?> <?php echo wp_date('F, Y');?></mark></div>
						<h3><?php echo sprintf(__('Our %s Casino Reviews & Ratings', 'websitelangid'), $country_native_name);?></h3>
						<p><?php echo __('Please Rate Our Casinos Collection', 'websitelangid');?></p>
						<?php echo do_shortcode('[gdrts_stars_rating type="custom.free" id="2"]');?>
					</header>
					<?php
					if(is_paged()){
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							$_SESSION['deposit'] = $_POST['deposit'];
							$_SESSION['withdrawal'] = $_POST['withdrawal'];
							$_SESSION['type'] = $_POST['type'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_deposit = $_SESSION['deposit'];
							$FilterSessionSave_withdrawal = $_SESSION['withdrawal'];
							$FilterSessionSave_type = $_SESSION['type'];
						}else{
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_deposit = $_SESSION['deposit'];
							$FilterSessionSave_withdrawal = $_SESSION['withdrawal'];
							$FilterSessionSave_type = $_SESSION['type'];
						}
					}else{
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							$_SESSION['deposit'] = $_POST['deposit'];
							$_SESSION['withdrawal'] = $_POST['withdrawal'];
							$_SESSION['type'] = $_POST['type'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_deposit = $_SESSION['deposit'];
							$FilterSessionSave_withdrawal = $_SESSION['withdrawal'];
							$FilterSessionSave_type = $_SESSION['type'];
						}else{
							$_SESSION['orderby'] = '';
							$_SESSION['deposit'] = '';
							$_SESSION['withdrawal'] = '';
							$_SESSION['type'] = '';
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_deposit = $_SESSION['deposit'];
							$FilterSessionSave_withdrawal = $_SESSION['withdrawal'];
							$FilterSessionSave_type = $_SESSION['type'];
						}
					}
					?>
					<button id="ToggleFiltersButton"><span class="show-filters-text"><?php echo __('Show filters', 'websitelangid');?></span><span class="hide-filters-text"><?php echo __('Hide filters', 'websitelangid');?></span><i class="fas fa-chevron-down"></i></button>
					<form id="ToggleFiltersContent" class="filter-form casinos-filter" method="post">
<script>
jQuery('#ToggleFiltersButton').click(function(){
	jQuery('#ToggleFiltersButton').toggleClass('active');
	jQuery('#ToggleFiltersContent').toggleClass('active');
});
</script>
						<div class="filter-infoblock">
							<p><span id="ItemsCount"></span> <?php echo __('Casinos Found for Players', 'websitelangid');?><?php if($country_native_name){echo ' '.__('from', 'websitelangid').' '.do_shortcode('[useriploc type="flag" height="20px" width="auto"]').' '.$country_native_name;}?></p>
						</div>
						<div class="filter-selects">
							<div class="filter-selects-wrapper filter-selects-4-cols">
								<div>
									<p>
										<label><?php echo __('Order By', 'websitelangid');?>:</label>
										<select name="orderby">
											<option value="rating" <?php if($FilterSessionSave_orderby == 'rating' or $FilterSessionSave_orderby == ''){echo 'selected="selected"';}?>><?php echo __('Best Rating', 'websitelangid');?></option>
											<option value="title-asc" <?php if($FilterSessionSave_orderby == 'title-asc'){echo 'selected="selected"';}?>><?php echo __('A to Z', 'websitelangid');?></option>
											<option value="title-desc" <?php if($FilterSessionSave_orderby == 'title-desc'){echo 'selected="selected"';}?>><?php echo __('Z to A', 'websitelangid');?></option>
											<option value="date" <?php if($FilterSessionSave_orderby == 'date'){echo 'selected="selected"';}?>><?php echo __('New to Old', 'websitelangid');?></option>
											<option value="popular" <?php if($FilterSessionSave_orderby == 'popular'){echo 'selected="selected"';}?>><?php echo __('Most Popular', 'websitelangid');?></option>
										</select>
									</p>
								</div>
								<?php $casinos_deposits = get_terms(array('taxonomy'=>'casinos_deposits')); if($casinos_deposits){?>
								<div>
									<p>
										<label><?php echo __('Deposit Method', 'websitelangid');?>:</label>
										<select name="deposit">
											<option value="" <?php if($FilterSessionSave_deposit == '' or $FilterSessionSave_deposit == 0){echo 'selected="selected"';}?>><?php echo __('All Methods', 'websitelangid');?></option>
											<?php foreach($casinos_deposits as $casinos_deposit){echo '<option value="'.$casinos_deposit->term_id.'"'; if($FilterSessionSave_deposit == $casinos_deposit->term_id){echo 'selected="selected"';} echo '>'.$casinos_deposit->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
								<?php $casinos_withdrawals = get_terms(array('taxonomy'=>'casinos_withdrawals')); if($casinos_withdrawals){?>
								<div>
									<p>
										<label><?php echo __('Withdrawal Method', 'websitelangid');?>:</label>
										<select name="withdrawal">
											<option value="" <?php if($FilterSessionSave_withdrawal == '' or $FilterSessionSave_withdrawal == 0){echo 'selected="selected"';}?>><?php echo __('All Methods', 'websitelangid');?></option>
											<?php foreach($casinos_withdrawals as $casinos_withdrawal){echo '<option value="'.$casinos_withdrawal->term_id.'"'; if($FilterSessionSave_withdrawal == $casinos_withdrawal->term_id){echo 'selected="selected"';} echo '>'.$casinos_withdrawal->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
								<?php $casinos_types = get_terms(array('taxonomy'=>'casinos_types')); if($casinos_types){?>
								<div>
									<p>
										<label><?php echo __('Casino Type', 'websitelangid');?>:</label>
										<select name="type">
											<option value="" <?php if($FilterSessionSave_type == '' or $FilterSessionSave_type == 0){echo 'selected="selected"';}?>><?php echo __('All Types', 'websitelangid');?></option>
											<?php foreach($casinos_types as $casinos_type){echo '<option value="'.$casinos_type->term_id.'"'; if($FilterSessionSave_type == $casinos_type->term_id){echo 'selected="selected"';} echo '>'.$casinos_type->name.'</option>';}?>
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
										<input type="submit" value="<?php echo __('Filter Casinos', 'websitelangid');?>"/>
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
		jQuery('select[name="orderby"]', '.casinos-filter').val('rating').prop('selected', false);
		jQuery('select[name="deposit"]', '.casinos-filter').val('').prop('selected', false);
		jQuery('select[name="withdrawal"]', '.casinos-filter').val('').prop('selected', false);
		jQuery('select[name="type"]', '.casinos-filter').val('').prop('selected', false);
		jQuery('.casinos-filter').submit();
	});
});
</script>
					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged'):1;
					/*ODER*/
					if($FilterSessionSave_orderby == 'rating'){
						$casinos_orderby = 'meta_value_num';
						$casinos_order = 'DESC';
						$casinos_meta_key = 'overall_reviews_rating';
					}elseif($FilterSessionSave_orderby == 'title-asc'){
						$casinos_orderby = 'title';
						$casinos_order = 'ASC';
						$casinos_meta_key = '';
					}elseif($FilterSessionSave_orderby == 'title-desc'){
						$casinos_orderby = 'title';
						$casinos_order = 'DESC';
						$casinos_meta_key = '';
					}elseif($FilterSessionSave_orderby == 'date'){
						$casinos_orderby = 'date';
						$casinos_order = 'DESC';
						$casinos_meta_key = '';
					}elseif($FilterSessionSave_orderby == 'popular'){
						$casinos_orderby = 'meta_value_num';
						$casinos_order = 'DESC';
						$casinos_meta_key = 'wpb_post_views_count';
					}else{
						$casinos_orderby = 'meta_value_num';
						$casinos_order = 'DESC';
						$casinos_meta_key = 'overall_reviews_rating';
					}
					
					/*DEPOSIT*/
					if($FilterSessionSave_deposit != '' or $FilterSessionSave_deposit != 0){
						$deposit = array('taxonomy'=>'casinos_deposits', 'field'=>'id', 'terms'=>array($FilterSessionSave_deposit));
					}
					
					/*WITHDRAWAL*/
					if($FilterSessionSave_withdrawal != '' or $FilterSessionSave_withdrawal != 0){
						$withdrawal = array('taxonomy'=>'casinos_withdrawals', 'field'=>'id', 'terms'=>array($FilterSessionSave_withdrawal));
					}
					
					/*TYPE*/
					if($FilterSessionSave_type != '' or $FilterSessionSave_type != 0){
						$type = array('taxonomy'=>'casinos_types', 'field'=>'id', 'terms'=>array($FilterSessionSave_type));
					}
					
					/*COUNTRY*/
					if($country_detect){
						$country = array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect);
					}
					
					$args = array('post_type'=>'casinos', 'meta_key'=>$casinos_meta_key, 'orderby'=>$casinos_orderby, 'order'=>$casinos_order, 'paged'=>$paged, 'tax_query'=>array($deposit, $withdrawal, $type, $country));
					query_posts($args);
					$count_current_posts = $wp_query->found_posts;
					?>
<script>jQuery("#ItemsCount").text("<?php echo $count_current_posts;?>");</script>
					<?php if(have_posts()):?>
					<ul class="casinos-listing">
						<?php $count_casinos = 1; while(have_posts()):the_post();?>
						<?php get_template_part('template', 'casinos-listing');?>
						<?php $count_casinos++; endwhile;?>
					</ul>
					<?php wp_pagenavi();?>
					<?php else:?>
					<p style="text-align:center;"><?php echo __('Nothing found', 'websitelangid');?>.</p>
					<?php endif;?>
				</section>
			</div>
		</div>
		<?php if(have_rows('archive_casinos_features', 'option')):?>
		<div class="content-zone features-line float">
			<div class="align">
				<section>
					<header>
						<h3><?php the_field('archive_casinos_features_heading', 'option');?></h3>
					</header>
					<?php the_field('archive_casinos_features_desc', 'option');?>
					<ul class="features-list">
						<?php while(have_rows('archive_casinos_features', 'option')):the_row();?>
						<li>
							<?php the_sub_field('archive_casinos_feature_icon');?>
							<div class="feature-title"><strong><?php the_sub_field('archive_casinos_feature_title');?></strong></div>
							<div class="feature-desc"><?php the_sub_field('archive_casinos_feature_desc');?></div>
						</li>
						<?php endwhile;?>
					</ul>
				</section>
			</div>
		</div>
		<?php endif;?>
		<?php if(have_rows('archive_casinos_counter_slides', 'option')):?>
		<div class="content-zone counter-slider-line counter-slider-block-id-casinos float">
			<div class="align">
				<section>
					<div class="counter-slider-line-noise">
						<div class="counter-slider-line-position">
							<header>
								<h3><?php the_field('archive_casinos_counter_slider_heading', 'option');?></h3>
							</header>
							<?php the_field('archive_casinos_counter_slider_desc', 'option');?>
							<div class="owl-carousel">
								<?php $counter_slider_count = 1; while(have_rows('archive_casinos_counter_slides', 'option')):the_row();?>
								<div>
									<div class="counter-slide-block-count"><?php echo $counter_slider_count;?></div>
									<div class="counter-slide-block-title"><strong><?php the_sub_field('archive_casinos_counter_slide_title');?></strong></div>
									<div class="counter-slide-block-desc"><?php the_sub_field('archive_casinos_counter_slide_desc');?></div>
									<?php if(have_rows('archive_casinos_counter_slide_advantages')):?>
									<div class="counter-slide-block-advantages">
										<?php $counter_slide_advantages_heading = get_sub_field('archive_casinos_counter_slide_advantages_heading'); if($counter_slide_advantages_heading){echo '<div>'.$counter_slide_advantages_heading.'</div>';}?>
										<ul>
											<?php while(have_rows('archive_casinos_counter_slide_advantages')):the_row();?>
											<li><i class="fas fa-check"></i><?php the_sub_field('archive_casinos_counter_slide_advantage');?></li>
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
	var owl_id_counter_slider_casinos = jQuery('.counter-slider-block-id-casinos .owl-carousel');
	owl_id_counter_slider_casinos.owlCarousel({
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
		<?php if(have_rows('archive_casinos_media_text', 'option')):while(have_rows('archive_casinos_media_text', 'option')):the_row();?>
		<div class="content-zone media-content-line <?php if(get_sub_field('archive_casinos_media_text_dark_background') == true){echo 'media-content-line-dark';}?> <?php if(get_sub_field('archive_casinos_media_text_align_right') == true){echo 'media-content-line-right';}?> float">
			<div class="media-content-background-image">
				<div class="media-content-background-image-wrapper" style="background-image:url(<?php $archive_casinos_media_text_background_image = get_sub_field('archive_casinos_media_text_background_image'); if($archive_casinos_media_text_background_image){echo $archive_casinos_media_text_background_image;}else{echo get_bloginfo('template_url').'/images/media-block-bg.jpg';}?>);"></div>
			</div>
			<div class="align">
				<section>
					<?php the_sub_field('archive_casinos_media_text_content');?>
				</section>
			</div>
		</div>
		<?php endwhile; endif;?>
		<?php if(have_rows('archive_casinos_icons_slider', 'option')):?>
		<div class="content-zone icons-slider-line icons-slider-block-id-casinos float">
			<div class="align">
				<section>
					<header>
						<h3><?php the_field('archive_casinos_icons_slider_heading', 'option');?></h3>
					</header>
					<?php the_field('archive_casinos_icons_slider_desc', 'option');?>
					<div class="owl-carousel">
						<?php while(have_rows('archive_casinos_icons_slider', 'option')):the_row();?>
						<div>
							<?php the_sub_field('archive_casinos_icons_slider_icon');?>
							<div class="icons-slide-block-title"><strong><?php the_sub_field('archive_casinos_icons_slider_title');?></strong></div>
							<div class="icons-slide-block-desc"><?php the_sub_field('archive_casinos_icons_slider_desc');?></div>
						</div>
						<?php endwhile;?>
					</div>
				</section>
			</div>
		</div>
<script>
jQuery(window).on('load', function(){
	var owl_id_icons_slider_casinos = jQuery('.icons-slider-block-id-casinos .owl-carousel');
	owl_id_icons_slider_casinos.owlCarousel({
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
		<?php if(have_rows('archive_casinos_cta_links', 'option')):?>
		<div class="content-zone cta-line float">
			<div class="align">
				<aside>
					<div class="cta-line-position">
						<header>
							<h5><?php the_field('archive_casinos_cta_heading', 'option');?></h5>
						</header>
						<div class="cta-buttons">
							<?php while(have_rows('archive_casinos_cta_links', 'option')):the_row();?>
							<a href="<?php the_sub_field('archive_casinos_cta_link_url');?>"><?php the_sub_field('archive_casinos_cta_link_title');?></a>
							<?php endwhile;?>
						</div>
					</div>
				</aside>
			</div>
		</div>
		<?php endif;?>
		<?php if(have_rows('archive_casinos_additional_content', 'option')):?>
		<?php while(have_rows('archive_casinos_additional_content', 'option')):the_row();?>
		<div class="content-zone float">
			<div class="align">
				<section>
					<?php the_sub_field('archive_casinos_additional_content_block');?>
				</section>
			</div>
		</div>
		<?php endwhile;?>
		<?php endif;?>
		<?php if(have_rows('archive_casinos_faq', 'option')):?>
		<div class="content-zone faq-line float">
			<div class="align">
				<section>
					<header>
						<h3><?php the_field('archive_casinos_faq_heading', 'option');?></h3>
					</header>
					<?php while(have_rows('archive_casinos_faq', 'option')):the_row();?>
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