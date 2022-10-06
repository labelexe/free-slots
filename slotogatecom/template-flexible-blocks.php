<?php if(get_row_layout() == 'flexible_additional_content'):?>
<div class="content-zone float">
	<div class="align">
		<section>
			<?php the_sub_field('additional_content');?>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_taxonomy_terms'):?>
<div class="content-zone terms-archive float">
	<div class="align">
		<section>
			<header>
				<h3><?php the_sub_field('taxonomy_terms_heading');?></h3>
			</header>
			<?php $taxonomy_terms_name = get_sub_field('taxonomy_terms_name'); if(taxonomy_exists($taxonomy_terms_name)){?>
				<form class="filter-form" method="post">
					<div class="filter-selects">
						<div class="filter-selects-wrapper filter-selects-1-cols">
							<div>
								<p>
									<label><?php echo __('Order By', 'websitelangid');?>:</label>
									<select name="orderby">
										<option value="name-asc" <?php if($_POST['orderby'] == 'name-asc' or $_POST['orderby'] == ''){echo 'selected="selected"';}?>><?php echo __('A to Z', 'websitelangid');?></option>
										<option value="name-desc" <?php if($_POST['orderby'] == 'name-desc'){echo 'selected="selected"';}?>><?php echo __('Z to A', 'websitelangid');?></option>
										<option value="id" <?php if($_POST['orderby'] == 'id'){echo 'selected="selected"';}?>><?php echo __('New to Old', 'websitelangid');?></option>
										<option value="count" <?php if($_POST['orderby'] == 'count'){echo 'selected="selected"';}?>><?php echo __('Most Games', 'websitelangid');?></option>
										<option value="rating" <?php if($_POST['orderby'] == 'rating'){echo 'selected="selected"';}?>><?php echo __('Best Rating', 'websitelangid');?></option>
									</select>
								</p>
							</div>
						</div>
					</div>
					<div class="filter-buttons">
						<div class="filter-buttons-wrapper filter-buttons-1-cols">
							<div>
								<p>
									<input type="submit" value="<?php echo __('Sort Items', 'websitelangid');?>"/>
								</p>
							</div>
						</div>
					</div>
				</form>
				<?php
				if($_POST['orderby'] == 'name-asc'){
					if(ICL_LANGUAGE_CODE == 'en'){
						$meta_key = '';
						$orderby = 'name';
						$order = 'ASC';
					}else{
						if($taxonomy_terms_name == 'casinos_countries'){
							$meta_key = 'country_native_name';
							$orderby = 'meta_value';
							$order = 'ASC';
						}else{
							$meta_key = '';
							$orderby = 'name';
							$order = 'ASC';
						}
					}
				}elseif($_POST['orderby'] == 'name-desc'){
					if(ICL_LANGUAGE_CODE == 'en'){
						$meta_key = '';
						$orderby = 'name';
						$order = 'DESC';
					}else{
						if($taxonomy_terms_name == 'casinos_countries'){
							$meta_key = 'country_native_name';
							$orderby = 'meta_value';
							$order = 'DESC';
						}else{
							$meta_key = '';
							$orderby = 'name';
							$order = 'DESC';
						}
					}
				}elseif($_POST['orderby'] == 'id'){
					$meta_key = '';
					$orderby = 'id';
					$order = 'DESC';
				}elseif($_POST['orderby'] == 'count'){
					$meta_key = '';
					$orderby = 'count';
					$order = 'DESC';
				}elseif($_POST['orderby'] == 'rating'){
					$meta_key = '';
					$orderby = 'gdrts';
					$order = 'DESC';
				}else{
					if(ICL_LANGUAGE_CODE == 'en'){
						$meta_key = '';
						$orderby = 'name';
						$order = 'ASC';
					}else{
						if($taxonomy_terms_name == 'casinos_countries'){
							$meta_key = 'country_native_name';
							$orderby = 'meta_value';
							$order = 'ASC';
						}else{
							$meta_key = '';
							$orderby = 'name';
							$order = 'ASC';
						}
					}
				}
				
				$taxonomy_terms = get_terms(array('taxonomy'=>$taxonomy_terms_name, 'hide_empty'=>true, 'meta_key'=>$meta_key, 'orderby'=>$orderby, 'order'=>$order));
				?>
				<?php if($taxonomy_terms){?>
				<ul class="terms-listing <?php if($taxonomy_terms_name == 'slots_providers'){echo 'providers-listing';}?>">
					<?php foreach($taxonomy_terms as $taxonomy_term){?>
					<li>
						<a href="<?php echo get_term_link($taxonomy_term->term_id);?>">
							<?php
							if($taxonomy_terms_name == 'slots_providers'){
								echo '<div class="provider-listing-image">';
								$taxonomy_term_image = get_field('tax_image', $taxonomy_terms_name.'_'.$taxonomy_term->term_id); if($taxonomy_term_image){echo wp_get_attachment_image($taxonomy_term_image, 'full', false, array('alt'=>$taxonomy_term->name));}else{echo '<img width="150" height="150" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}
								echo '<div class="term-provider-overlay"><span>'.__('Visit Provider Page', 'websitelangid').'</span></div></div>';
							}else{
								$taxonomy_term_image = get_field('tax_image', $taxonomy_terms_name.'_'.$taxonomy_term->term_id); if($taxonomy_term_image){echo wp_get_attachment_image($taxonomy_term_image, 'thumbnail', false, array('alt'=>$taxonomy_term->name));}else{echo '<img width="150" height="150" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}
							}
							?>
							<div class="term-title"><strong><?php if($taxonomy_terms_name == 'casinos_countries'){$country_native_name = get_field('country_native_name', 'casinos_countries_'.$taxonomy_term->term_id); if($country_native_name){echo $country_native_name;}else{echo $taxonomy_term->name;}}else{echo $taxonomy_term->name;}?><span><?php echo $taxonomy_term->count;?></span></strong></div>
						</a>
					</li>
					<?php }?>
				</ul>
				<?php }?>
			<?php }?>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_faq'):?>
<div class="content-zone faq-line float">
	<div class="align">
		<section>
			<header>
				<h3><?php the_sub_field('faq_heading');?></h3>
			</header>
			<?php if(have_rows('faq')):?>
			<div itemscope itemtype="https://schema.org/FAQPage">
				<?php while(have_rows('faq')):the_row();?>
				<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
					<h3 class="accordion"><i class="fas fa-plus"></i><i class="fas fa-minus"></i><span itemprop="name"><?php the_sub_field('question');?></span></h3>
					<div class="panel" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
						<div itemprop="text"><?php the_sub_field('answer');?></div>
					</div>
				</div>
				<?php endwhile;?>
			</div>
			<?php endif;?>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_also_like'):?>
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
<?php elseif(get_row_layout() == 'flexible_media_text'):?>
<div class="content-zone media-content-line <?php if(get_sub_field('media_text_dark_background') == true){echo 'media-content-line-dark';}?> <?php if(get_sub_field('media_text_align_right') == true){echo 'media-content-line-right';}?> float">
	<div class="media-content-background-image">
		<div class="media-content-background-image-wrapper" style="background-image:url(<?php $media_text_background_image = get_sub_field('media_text_background_image'); if($media_text_background_image){echo $media_text_background_image;}else{echo get_bloginfo('template_url').'/images/media-block-bg.jpg';}?>);"></div>
	</div>
	<div class="align">
		<section>
			<?php the_sub_field('media_text_content');?>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_features'):?>
<div class="content-zone features-line float">
	<div class="align">
		<section>
			<header>
				<h3><?php the_sub_field('features_heading');?></h3>
			</header>
			<?php the_sub_field('features_desc');?>
			<?php if(have_rows('features')):?>
			<ul class="features-list">
				<?php while(have_rows('features')):the_row();?>
				<li>
					<?php the_sub_field('feature_icon');?>
					<div class="feature-title"><strong><?php the_sub_field('feature_title');?></strong></div>
					<div class="feature-desc"><?php the_sub_field('feature_desc');?></div>
				</li>
				<?php endwhile;?>
			</ul>
			<?php endif;?>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_counter_slider'):?>
<?php $counter_slider_id = rand(1513, 52342);?>
<div class="content-zone counter-slider-line counter-slider-block-id-<?php echo $counter_slider_id;?> float">
	<div class="align">
		<section>
			<div class="counter-slider-line-noise">
				<div class="counter-slider-line-position">
					<header>
						<h3><?php the_sub_field('counter_slider_heading');?></h3>
					</header>
					<?php the_sub_field('counter_slider_desc');?>
					<?php if(have_rows('counter_slides')):?>
					<div class="owl-carousel">
						<?php $counter_slider_count = 1; while(have_rows('counter_slides')):the_row();?>
						<div>
							<div class="counter-slide-block-count"><?php echo $counter_slider_count;?></div>
							<div class="counter-slide-block-title"><strong><?php the_sub_field('counter_slide_title');?></strong></div>
							<div class="counter-slide-block-desc"><?php the_sub_field('counter_slide_desc');?></div>
							<?php if(have_rows('counter_slide_advantages')):?>
							<div class="counter-slide-block-advantages">
								<?php $counter_slide_advantages_heading = get_sub_field('counter_slide_advantages_heading'); if($counter_slide_advantages_heading){echo '<div>'.$counter_slide_advantages_heading.'</div>';}?>
								<ul>
									<?php while(have_rows('counter_slide_advantages')):the_row();?>
									<li><i class="fas fa-check"></i><?php the_sub_field('counter_slide_advantage');?></li>
									<?php endwhile;?>
								</ul>
							</div>
							<?php endif;?>
						</div>
						<?php $counter_slider_count++; endwhile;?>
					</div>
					<?php endif;?>
				</div>
			</div>
		</section>
	</div>
</div>
<script>
jQuery(window).on('load', function(){
	var owl_id_counter_slider_<?php echo $counter_slider_id;?> = jQuery('.counter-slider-block-id-<?php echo $counter_slider_id;?> .owl-carousel');
	owl_id_counter_slider_<?php echo $counter_slider_id;?>.owlCarousel({
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
<?php elseif(get_row_layout() == 'flexible_icons_slider'):?>
<?php $icons_slider_id = rand(4532, 12854);?>
<div class="content-zone icons-slider-line icons-slider-block-id-<?php echo $icons_slider_id;?> float">
	<div class="align">
		<section>
			<header>
				<h3><?php the_sub_field('icons_slider_heading');?></h3>
			</header>
			<?php the_sub_field('icons_slider_desc');?>
			<?php if(have_rows('icons_slider')):?>
			<div class="owl-carousel">
				<?php while(have_rows('icons_slider')):the_row();?>
				<div>
					<?php the_sub_field('icons_slider_icon');?>
					<div class="icons-slide-block-title"><strong><?php the_sub_field('icons_slider_title');?></strong></div>
					<div class="icons-slide-block-desc"><?php the_sub_field('icons_slider_desc');?></div>
				</div>
				<?php endwhile;?>
			</div>
			<?php endif;?>
		</section>
	</div>
</div>
<script>
jQuery(window).on('load', function(){
	var owl_id_icons_slider_<?php echo $icons_slider_id;?> = jQuery('.icons-slider-block-id-<?php echo $icons_slider_id;?> .owl-carousel');
	owl_id_icons_slider_<?php echo $icons_slider_id;?>.owlCarousel({
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
<?php elseif(get_row_layout() == 'flexible_cta'):?>
<div class="content-zone cta-line float">
	<div class="align">
		<aside>
			<div class="cta-line-position">
				<header>
					<h5><?php the_sub_field('cta_heading');?></h5>
				</header>
				<?php if(have_rows('cta_links')):?>
				<div class="cta-buttons">
					<?php while(have_rows('cta_links')):the_row();?>
					<a href="<?php the_sub_field('cta_link_url');?>"><?php the_sub_field('cta_link_title');?></a>
					<?php endwhile;?>
				</div>
				<?php endif;?>
			</div>
		</aside>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_featured_items'):?>
<div class="content-zone featured-search float">
	<div class="align">
		<section>
			<div class="featured-search-noise">
				<div class="featured-search-coins">
					<div class="featured-search-position">
						<header>
							<h3><?php the_sub_field('featured_items_heading');?></h3>
						</header>
						<?php the_sub_field('featured_items_desc');?>
						<?php echo do_shortcode('[wd_asp id=1]');?>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_best_casinos'):?>
<?php
if($country_detect == ''){$country_detect = do_shortcode('[useriploc type="country"]');}
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
<div class="content-zone archive-listings float">
	<div class="align">
		<section>
			<header>
				<h3><?php echo __('Find the Best Online Casinos', 'websitelangid');?> <?php if($country_native_name){echo ' '.__('in', 'websitelangid').' '.$country_native_name;}?></h3>
			</header>
			<?php the_sub_field('best_casinos_desc');?>
			<?php if($country_detect){$best_casinos = get_posts(array('suppress_filters'=>false, 'numberposts'=>6, 'post_type'=>'casinos', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'meta_key'=>'overall_reviews_rating', 'tax_query'=>array(array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect)))); if($best_casinos){?>
			<ul class="casinos-listing">
				<?php foreach($best_casinos as $post){setup_postdata($post);?>
				<?php get_template_part('template', 'casinos-listing');?>
				<?php } wp_reset_postdata();?>
			</ul>
			<?php }}?>
			<?php $casinos_post_type_link = get_post_type_archive_link('casinos'); if($casinos_post_type_link){?>
			<footer>
				<a href="<?php echo $casinos_post_type_link?>"><?php echo __('All Casinos Collection', 'websitelangid');?><i class="fas fa-long-arrow-alt-right"></i></a>
			</footer>
			<?php }?>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_latest_slots'):?>
<div class="content-zone archive-listings float">
	<div class="align">
		<section>
			<header>
				<h3><?php the_sub_field('latest_slots_heading');?></h3>
			</header>
			<?php the_sub_field('latest_slots_desc');?>
			<?php $latest_slots = get_posts(array('suppress_filters'=>false, 'numberposts'=>12, 'post_type'=>'slots')); if($latest_slots){?>
			<ul class="slots-listing">
				<?php foreach($latest_slots as $post){setup_postdata($post);?>
				<?php get_template_part('template', 'slots-listing');?>
				<?php } wp_reset_postdata();?>
			</ul>
			<?php }?>
			<?php $slots_post_type_link = get_post_type_archive_link('slots'); if($slots_post_type_link){?>
			<footer>
				<a href="<?php echo $slots_post_type_link;?>"><?php echo __('All Slots Collection', 'websitelangid');?><i class="fas fa-long-arrow-alt-right"></i></a>
			</footer>
			<?php }?>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_best_providers'):?>
<div class="content-zone best-providers-archive float">
	<div class="align">
		<section>
			<div class="best-providers-archive-noise">
				<div class="best-providers-archive-position">
					<header>
						<h3><?php the_sub_field('best_providers_heading');?></h3>
					</header>
					<?php the_sub_field('best_providers_desc');?>
					<?php $best_slots_providers = get_terms(array('taxonomy'=>'slots_providers', 'hide_empty'=>true, 'orderby'=>'gdrts', 'order'=>'DESC', 'number'=>6)); if($best_slots_providers){?>
					<ul class="best-providers-listing">
						<?php foreach($best_slots_providers as $best_slots_provider){?>
						<li>
							<a href="<?php echo get_term_link($best_slots_provider->term_id);?>">
								<?php $best_slots_provider_image = get_field('tax_image', 'slots_providers_'.$best_slots_provider->term_id); if($best_slots_provider_image){echo '<div class="best-provider-image">'.wp_get_attachment_image($best_slots_provider_image, 'full', false, array('alt'=>$best_slots_provider->name)).'<div class="best-provider-overlay"><span>'.__('Visit Provider Page', 'websitelangid').'</span></div></div>';}else{echo '<div class="best-provider-image"><img width="163" height="163" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/><div class="best-provider-overlay"><span>'.__('Visit Provider Page', 'websitelangid').'</span></div></div>';}?>
								<div class="best-provider-title"><strong><?php echo $best_slots_provider->name;?></strong><br><small><?php echo $best_slots_provider->count;?> <?php echo __('games', 'websitelangid');?></small></div>
							</a>
						</li>
						<?php }?>
					</ul>
					<?php }?>
					<?php $best_providers_link = get_sub_field('best_providers_link'); if($best_providers_link){?>
					<footer>
						<a href="<?php echo $best_providers_link;?>"><?php echo __('All Providers Collection', 'websitelangid');?><i class="fas fa-long-arrow-alt-right"></i></a>
					</footer>
					<?php }?>
				</div>
			</div>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_best_slots'):?>
<div class="content-zone archive-listings float">
	<div class="align">
		<section>
			<header>
				<h3><?php the_sub_field('best_slots_heading');?></h3>
			</header>
			<?php the_sub_field('best_slots_desc');?>
			<?php $best_slots = get_posts(array('suppress_filters'=>false, 'numberposts'=>6, 'post_type'=>'slots', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'meta_key'=>'wpb_post_views_count')); if($best_slots){?>
			<ul class="slots-listing">
				<?php foreach($best_slots as $post){setup_postdata($post);?>
				<?php get_template_part('template', 'slots-listing');?>
				<?php } wp_reset_postdata();?>
			</ul>
			<?php }?>
			<?php $slots_post_type_link = get_post_type_archive_link('slots'); if($slots_post_type_link){?>
			<footer>
				<a href="<?php echo $slots_post_type_link;?>"><?php echo __('All Slots Collection', 'websitelangid');?><i class="fas fa-long-arrow-alt-right"></i></a>
			</footer>
			<?php }?>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_best_table_games'):?>
<div class="content-zone archive-listings float">
	<div class="align">
		<section>
			<header>
				<h3><?php the_sub_field('best_table_games_heading');?></h3>
			</header>
			<?php the_sub_field('best_table_games_desc');?>
			<?php $popular_table_games = get_posts(array('suppress_filters'=>false, 'numberposts'=>6, 'post_type'=>'table_games', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'meta_key'=>'wpb_post_views_count')); if($popular_table_games){?>
			<ul class="table-games-listing">
				<?php foreach($popular_table_games as $post){setup_postdata($post);?>
				<?php get_template_part('template', 'table-games-listing');?>
				<?php } wp_reset_postdata();?>
			</ul>
			<?php }?>
			<?php $table_games_post_type_link = get_post_type_archive_link('table_games'); if($table_games_post_type_link){?>
			<footer>
				<a href="<?php echo $table_games_post_type_link;?>"><?php echo __('All Table Games', 'websitelangid');?><i class="fas fa-long-arrow-alt-right"></i></a>
			</footer>
			<?php }?>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_featured_links'):?>
<div class="content-zone featured-links float">
	<div class="align">
		<section>
			<div class="featured-links-noise">
				<div class="featured-links-position">
					<div class="featured-links-wrapper">
						<div class="featured-links-content">
							<?php the_sub_field('featured_links_content');?>
						</div>
						<?php if(have_rows('featured_links')):?>
						<div class="featured-links-items">
							<ul>
								<?php while(have_rows('featured_links')):the_row();?>
								<li>
									<div class="featured-links-item-wrapper">
										<div class="featured-links-item-icon"><?php the_sub_field('featured_link_icon');?></div>
										<div class="featured-links-item-title"><strong><?php the_sub_field('featured_link_title');?></strong></div>
									</div>
									<div class="featured-links-item-desc"><?php the_sub_field('featured_link_desc');?></div>
									<div class="featured-links-item-link"><a href="<?php the_sub_field('featured_link_url');?>"><?php echo __('Explore', 'websitelangid');?><i class="fas fa-long-arrow-alt-right"></i></a></div>
								</li>
								<?php endwhile;?>
							</ul>
						</div>
						<?php endif;?>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_slot_types'):?>
<div class="content-zone archive-listings float">
	<div class="align">
		<section>
			<header>
				<h3><?php the_sub_field('slot_types_heading');?></h3>
			</header>
			<?php the_sub_field('slot_types_desc');?>
			<?php $top_casino_offset = 0; if(have_rows('slot_types_items')):while(have_rows('slot_types_items')):the_row();?>
				<?php $slots_by_type = get_posts(array('suppress_filters'=>false, 'numberposts'=>4, 'post_type'=>'slots', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'meta_key'=>'wpb_post_views_count', 'tax_query'=>array(array('taxonomy'=>'slots_types', 'field'=>'id', 'terms'=>get_sub_field('slot_type_item_category'))))); if($slots_by_type){?>
				<div class="slot-type-box-wrapper">
					<div class="slot-type-box">
						<h4><?php the_sub_field('slot_types_item_heading');?></h4>
						<?php the_sub_field('slot_types_item_desc');?>
						<ul class="slots-listing">
							<?php foreach($slots_by_type as $post){setup_postdata($post);?>
							<?php get_template_part('template', 'slots-listing');?>
							<?php } wp_reset_postdata();?>
						</ul>
					</div>
					<?php if($country_detect == ''){$country_detect = do_shortcode('[useriploc type="country"]');} if($country_detect){$top_casino = get_posts(array('suppress_filters'=>false, 'numberposts'=>1, 'offset'=>$top_casino_offset, 'post_type'=>'casinos', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'meta_key'=>'overall_reviews_rating', 'tax_query'=>array(array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect)))); if($top_casino){?>
					<div class="slot-type-top-casino">
						<?php foreach($top_casino as $post){setup_postdata($post);?>
						<?php
						$loop_overall_reviews_rating = round(get_field('overall_reviews_rating'), 2);
						$loop_casino_bonuses_relationship = get_field('casino_bonuses_relationship');
						$loop_casino_website_link = get_field('casino_website_link');
						?>
						<aside class="slot-type-top-casino-item">
							<div class="slot-type-top-casino-item-image"><?php if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="150" height="150" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?></div>
							<header><h5><?php the_title();?></h5></header>
							<div class="slot-type-top-casino-item-rating">
								<?php
								if($loop_overall_reviews_rating == '' or $loop_overall_reviews_rating == 0){
									$loop_overall_reviews_rating = 0;
									$loop_overall_reviews_rating_number = 0;
								}else{
									$loop_overall_reviews_rating_number = $loop_overall_reviews_rating;
								}
								if($loop_overall_reviews_rating <= 0.4){
									$loop_overall_reviews_rating_stars = '<i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
								}elseif($loop_overall_reviews_rating <= 0.9){
									$loop_overall_reviews_rating_stars = '<i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
								}elseif($loop_overall_reviews_rating <= 1.4){
									$loop_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
								}elseif($loop_overall_reviews_rating <= 1.9){
									$loop_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
								}elseif($loop_overall_reviews_rating <= 2.4){
									$loop_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
								}elseif($loop_overall_reviews_rating <= 2.9){
									$loop_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
								}elseif($loop_overall_reviews_rating <= 3.4){
									$loop_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
								}elseif($loop_overall_reviews_rating <= 3.9){
									$loop_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i>';
								}elseif($loop_overall_reviews_rating <= 4.4){
									$loop_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>';
								}elseif($loop_overall_reviews_rating <= 4.9){
									$loop_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>';
								}elseif($loop_overall_reviews_rating == 5){
									$loop_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
								}
								?>
								<?php echo $loop_overall_reviews_rating_stars;?> <span><?php echo $loop_overall_reviews_rating_number;?></span>
							</div>
							<div class="slot-type-top-casino-item-bonus"><?php echo __('Welcome Bonus', 'websitelangid');?>
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
							<div class="slot-type-top-casino-item-cta">
								<?php if($loop_casino_website_link){?><a class="slot-type-top-casino-item-cta-featured" href="<?php echo rtrim(home_url(), '/');?>/go/?type=casino_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Claim Bonus', 'websitelangid');?></a><?php }?>
								<a href="<?php the_permalink();?>"><?php echo __('Read Review', 'websitelangid');?></a>
							</div>
						</aside>
						<?php } wp_reset_postdata();?>
					</div>
					<?php }}?>
				</div>
				<?php }?>
			<?php $top_casino_offset++; endwhile; endif;?>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_discover_info'):?>
<div class="content-zone discover-info-line float">
	<div class="align">
		<section>
			<header>
				<h3><?php the_sub_field('discover_info_heading');?></h3>
			</header>
			<?php the_sub_field('discover_info_desc');?>
			<?php if(have_rows('discover_info_items')):?>
			<ul class="discover-info-items">
				<?php while(have_rows('discover_info_items')):the_row();?>
				<li>
					<?php the_sub_field('discover_info_item_icon');?>
					<div class="discover-info-item-title"><strong><?php the_sub_field('discover_info_item_title');?></strong></div>
					<div class="discover-info-item-desc"><?php the_sub_field('discover_info_item_desc');?></div>
					<a href="<?php the_sub_field('discover_info_item_link');?>" class="discover-info-item-link"><?php echo __('Read More', 'websitelangid');?><i class="fas fa-long-arrow-alt-right"></i></a>
				</li>
				<?php endwhile;?>
			</ul>
			<?php endif;?>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_compare_tables'):?>
<div class="content-zone compare-table-line float">
	<div class="align">
		<section>
			<header>
				<h3><?php the_sub_field('compare_tables_heading');?></h3>
			</header>
			<?php the_sub_field('compare_tables_desc');?>
			<div class="compare-tables">
				<div>
					<h4><?php the_sub_field('compare_table_left_heading');?></h4>
					<?php if(have_rows('compare_table_left_items')):?>
					<ul>
						<?php while(have_rows('compare_table_left_items')):the_row();?>
						<li><?php if(get_sub_field('compare_table_left_item_checked') == true){echo '<i class="fas fa-check"></i>';}else{echo '<i class="fas fa-times"></i>';} the_sub_field('compare_table_left_item_desc');?></li>
						<?php endwhile;?>
					</ul>
					<?php endif;?>
				</div>
				<div>
					<h4><?php the_sub_field('compare_table_right_heading');?></h4>
					<?php if(have_rows('compare_table_right_items')):?>
					<ul>
						<?php while(have_rows('compare_table_right_items')):the_row();?>
						<li><?php if(get_sub_field('compare_table_right_item_checked') == true){echo '<i class="fas fa-check"></i>';}else{echo '<i class="fas fa-times"></i>';} the_sub_field('compare_table_right_item_desc');?></li>
						<?php endwhile;?>
					</ul>
					<?php endif;?>
				</div>
			</div>
		</section>
	</div>
</div>
<?php elseif(get_row_layout() == 'flexible_exclamation_info'):?>
<div class="content-zone exclamation-info-line float">
	<div class="align">
		<section>
			<div class="exclamation-info-line-noise">
				<div class="exclamation-info-line-hero">
					<div class="exclamation-info-line-position">
						<header>
							<h3><?php the_sub_field('exclamation_info_heading');?></h3>
						</header>
						<?php the_sub_field('exclamation_info_desc');?>
						<?php if(have_rows('exclamation_info_links')):?>
						<ul>
							<?php while(have_rows('exclamation_info_links')):the_row();?>
							<li><a href="<?php the_sub_field('link_url');?>"><i class="fas fa-long-arrow-alt-right"></i><?php the_sub_field('link_title');?></a></li>
							<?php endwhile;?>
						</ul>
						<?php endif;?>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<?php endif;?>