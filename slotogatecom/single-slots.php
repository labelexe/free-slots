<?php get_header();?>
		<?php
		$country_detect = do_shortcode('[useriploc type="country"]');
		
		$slot_id = get_the_ID();
		$slot_id_original = apply_filters('wpml_object_id', $slot_id, 'slots', true, 'en');
		$slot_title = get_the_title();
		$slots_providers = wp_get_post_terms($slot_id, 'slots_providers');
		$slots_types = wp_get_post_terms($slot_id, 'slots_types');
		$slots_themes = wp_get_post_terms($slot_id, 'slots_themes');
		$slots_features = wp_get_post_terms($slot_id, 'slots_features');
		$slot_real_money_link = get_field('slot_real_money_link');
		$report_problem_form_shortcode = get_field('report_problem_form_shortcode', 'option');
		$slot_background_image = get_field('slot_background_image');
		$slot_iframe_url = get_field('slot_iframe_url');
		$slots_archive_url = get_post_type_archive_link('slots');
		$slot_reels = get_field('slot_reels');
		$slot_paylines = get_field('slot_paylines');
		$slot_rtp = get_field('slot_rtp');
		$slot_volatility = get_field('slot_volatility');
		$slot_min_bet = get_field('slot_min_bet');
		$slot_max_bet = get_field('slot_max_bet');
		$slot_top_win = get_field('slot_top_win');
		
		/*SET PAGE VIEW*/
		wpb_set_post_views($slot_id);
		?>
		<div class="content-zone single-slot-page float">
			<div class="align">
				<section>
					<header class="slot-header">
						<h3><?php the_title();?></h3>
						<div class="slot-rating">
							<div class="slot-rating-stars"><?php echo do_shortcode('[gdrts_stars_rating type="posts.slots" id="'.$slot_id_original.'"]');?></div>
						</div>
					</header>
					<div class="slot-main">
						<div class="slot-game">
							<div class="slot-summary">
								<div class="slot-provider">
									<?php if($slots_providers){?>
									<a href="<?php echo get_term_link($slots_providers[0]->term_id);?>">
									<?php $slots_providers_tax_image = get_field('tax_image', 'slots_providers_'.$slots_providers[0]->term_id); if($slots_providers_tax_image){echo '<div class="slot-provider-image">'.wp_get_attachment_image($slots_providers_tax_image, 'full', false, array('alt'=>$slots_providers[0]->name)).'</div>';}else{echo '<div class="slot-provider-image"><img width="50" height="50" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/></div>';}?><div><?php echo $slots_providers[0]->name;?> <span>(<?php echo $slots_providers[0]->count;?> <?php echo __('slots', 'websitelangid');?>)</span></div></a>
									<?php }?>
								</div>
								<div class="slot-controls">
									<ul>
										<?php if($slot_real_money_link){?><li><a class="slot-control-play" href="<?php echo rtrim(home_url(), '/');?>/go/?type=slot_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><i class="fas fa-dollar-sign"></i><?php echo __('Play for Real Money', 'websitelangid');?></a></li><?php }?>
										<li><a class="slot-control-refresh" href="#"><i class="fas fa-sync-alt"></i><span><?php echo __('Refresh Game Credits', 'websitelangid');?></span></a></li>
										<li><?php the_favorites_button();?></li>
										<?php if($report_problem_form_shortcode){?><li><a class="ari-fancybox" href="#ReportProblem" title="<?php echo __('Report a Problem', 'websitelangid');?>"><i class="fas fa-exclamation-circle"></i></a></li><?php }?>
										<li><a class="slot-control-expand" href="#" title="<?php echo __('Open in Fullscreen', 'websitelangid');?>"><i class="fas fa-expand-arrows-alt"></i><i class="fas fa-compress-arrows-alt"></i></a></li>
									</ul>
								</div>
							</div>
							<div class="slot-frame" style="background-image:url(<?php if($slot_background_image){echo $slot_background_image;}else{echo get_bloginfo('template_url').'/images/slot-bg.jpg';}?>);">
								<div class="slot-frame-wrapper">
									<?php if($slot_iframe_url){?>
									<button id="LoadUpFrameButton"><?php echo __('Play Free', 'websitelangid');?>!</button>
									<div id="FrameWrapping"></div>
<script>
jQuery("#LoadUpFrameButton").click(function(){
	jQuery('#FrameWrapping').html('<iframe id="FramePlaceholder" src="<?php echo $slot_iframe_url;?>"></iframe>');
	jQuery("#LoadUpFrameButton").css({"display":"none"});
	jQuery("#FrameWrapping").css({"display":"block"});
	jQuery(".slot-control-expand").css({"display":"block"});
});
jQuery(".slot-control-refresh").click(function(){
	event.preventDefault();
	jQuery('#FramePlaceholder').attr('src', function(i, val){return val;});
});
</script>
									<?php }?>
								</div>
								<?php if($country_detect){$casinos_slides = get_posts(array('suppress_filters'=>false, 'numberposts'=>3, 'post_type'=>'casinos', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'meta_key'=>'overall_reviews_rating', 'tax_query'=>array(array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect)))); if($casinos_slides){?>
								<div class="slot-frame-fullscreen-slider">
									<aside>
										<header>
											<h5><?php echo __('Ready to Play', 'websitelangid');?> <?php the_title();?> <?php echo __('for Real', 'websitelangid');?>?</h5>
										</header>
										<div class="owl-carousel">
											<?php foreach($casinos_slides as $post){setup_postdata($post);?>
											<?php
											$loop_casino_website_link = get_field('casino_website_link');
											$loop_casino_pros = get_field('casino_pros');
											$loop_casino_bonuses_relationship = get_field('casino_bonuses_relationship');
											?>
											<div>
												<div class="slide-casino-link"><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="80" height="80" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?></a></div>
												<div class="slide-casino-desc"><?php echo __('Welcome Bonus', 'websitelangid');?>:<br>
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
												<?php if($loop_casino_pros){?>
												<div class="slide-casino-pros">
													<?php $casino_pros_count = 1; foreach($loop_casino_pros as $loop_casino_pros_item){?>
													<div><mark><i class="fas fa-check"></i><?php echo $loop_casino_pros_item['pros_name'];?></mark></div>
													<?php if($casino_pros_count == 3){break;}?>
													<?php $casino_pros_count++;}?>
												</div>
												<?php }?>
												<div class="slide-casino-cta">
													<?php if($loop_casino_website_link){?><a class="slide-casino-cta-featured" href="<?php echo rtrim(home_url(), '/');?>/go/?type=casino_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Play Now', 'websitelangid');?></a><?php }?>
													<a href="<?php the_permalink();?>"><?php echo __('Read Review', 'websitelangid');?></a>
												</div>
											</div>
											<?php } wp_reset_postdata();?>
										</div>
										<?php $real_money_casinos = get_field('real_money_casinos', 'option'); if($real_money_casinos){?>
										<footer>
											<p><a href="<?php echo $real_money_casinos;?>"><?php echo __('All Real Money Casinos', 'websitelangid');?></a></p>
										</footer>
										<?php }?>
<script>
jQuery(window).on('load', function(){
	var owl_id_slot_frame_fullscreen_slider = jQuery('.slot-frame-fullscreen-slider aside .owl-carousel');
	owl_id_slot_frame_fullscreen_slider.owlCarousel({
		stageElement:'ul',
		itemElement:'li',
		items:1,
		loop:true,
		mouseDrag:false,
		nav:true,
		rewind:false,
		navText:['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
		autoplay:true,
		autoplayTimeout:8000,
		autoplaySpeed:500,
	});
});
</script>
									</aside>
								</div>
								<?php }}?>
							</div>
<script>
jQuery('a.slot-control-expand').click(function(){
	event.preventDefault();
	jQuery('.slot-control-refresh').toggleClass('slot-control-refresh-fullscreen');
	jQuery('.slot-control-expand').toggleClass('slot-control-expand-fullscreen');
	jQuery('.slot-frame').toggleClass('slot-frame-fullscreen');
	jQuery('body').toggleClass('fancybox-active compensate-for-scrollbar');
});
</script>
						</div>
						<div class="slot-extras">
							<?php if($slots_providers){$popular_provider_slots = get_posts(array('suppress_filters'=>false, 'numberposts'=>10, 'post_type'=>'slots', 'meta_key'=>'wpb_post_views_count', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'exclude'=>$slot_id, 'tax_query'=>array(array('taxonomy'=>'slots_providers', 'field'=>'id', 'terms'=>$slots_providers[0]->term_id)))); if($popular_provider_slots){?>
							<aside class="slot-extra-games">
								<header>
									<h5><?php echo __('What Else to Play?', 'websitelangid');?></h5>
								</header>
								<ul>
									<?php foreach($popular_provider_slots as $post){setup_postdata($post);?>
									<?php
									$loop_slot_id_original = apply_filters('wpml_object_id', get_the_ID(), 'slots', true, 'en');
									$loop_slot_rtp = get_field('slot_rtp');
									$loop_slot_paylines = get_field('slot_paylines');
									$loop_slot_reels = get_field('slot_reels');
									?>
									<li>
										<a href="<?php the_permalink();?>">
											<?php if(get_the_post_thumbnail()){the_post_thumbnail('medium', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="120" height="120" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>
											<div class="slot-extra-game-content">
												<div class="slot-extra-game-title"><strong><?php the_title();?></strong></div>
												<div class="slot-extra-game-rating"><?php echo do_shortcode('[gdrts_stars_rating disable_rating="true" type="posts.slots" id="'.$loop_slot_id_original.'"]');?></div>
												<div class="slot-extra-game-summary">
													<dl>
														<dt><?php echo __('RTP', 'websitelangid');?></dt>
														<dd><?php if($loop_slot_rtp){echo $loop_slot_rtp;}else{echo '-';}?></dd>
													</dl>
													<dl>
														<dt><?php echo __('Paylines', 'websitelangid');?></dt>
														<dd><?php if($loop_slot_paylines){echo $loop_slot_paylines;}else{echo '-';}?></dd>
													</dl>
													<dl>
														<dt><?php echo __('Reels', 'websitelangid');?></dt>
														<dd><?php if($loop_slot_reels){echo $loop_slot_reels;}else{echo '-';}?></dd>
													</dl>
												</div>
											</div>
										</a>
									</li>
									<?php } wp_reset_postdata();?>
								</ul>
							</aside>
							<?php }}?>
						</div>
					</div>
				</section>
			</div>
		</div>
		<?php if($country_detect){$best_real_money_casinos = get_posts(array('suppress_filters'=>false, 'numberposts'=>5, 'post_type'=>'casinos', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'meta_key'=>'overall_reviews_rating', 'tax_query'=>array(array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect), array('taxonomy'=>'casinos_categories', 'field'=>'id', 'terms'=>374)))); if($best_real_money_casinos){?>
		<div class="content-zone archive-listings float">
			<div class="align">
				<aside>
					<header>
						<h5><?php echo __('Play', 'websitelangid');?> <?php the_title();?> <?php echo __('at Online Casinos', 'websitelangid');?></h5>
					</header>
					<ul class="casinos-listing">
						<?php foreach($best_real_money_casinos as $post){setup_postdata($post);?>
						<?php get_template_part('template', 'casinos-listing');?>
						<?php } wp_reset_postdata();?>
					</ul>
				</aside>
			</div>
		</div>
		<?php }}?>
		<?php $popular_slots = get_posts(array('suppress_filters'=>false, 'numberposts'=>6, 'post_type'=>'slots', 'meta_key'=>'wpb_post_views_count', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'exclude'=>$slot_id)); if($popular_slots){?>
		<div class="content-zone popular-free-slots float">
			<div class="align">
				<aside>
					<div class="popular-free-slots-noise">
						<div class="popular-free-slots-position">
							<header>
								<h5><?php echo __('Popular Free Slots', 'websitelangid');?></h5>
							</header>
							<ul>
								<?php foreach($popular_slots as $post){setup_postdata($post);?>
								<li>
									<a href="<?php the_permalink();?>">
										<?php if(get_the_post_thumbnail()){the_post_thumbnail('medium', array('alt'=>get_the_title()));}else{echo '<img width="213" height="213" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>
										<div class="slot-title"><strong><?php the_title();?></strong></div>
									</a>
								</li>
								<?php } wp_reset_postdata();?>
							</ul>
							<?php if($slots_archive_url){?>
							<footer>
								<a href="<?php echo $slots_archive_url;?>"><?php echo __('All Free Slots', 'websitelangid');?><i class="fas fa-long-arrow-alt-right"></i></a>
							</footer>
							<?php }?>
						</div>
					</div>
				</aside>
			</div>
		</div>
		<?php }?>
		<div class="content-zone slot-base-line float">
			<div class="align">
				<section>
					<div class="slot-base">
						<div class="slot-base-image">
							<div class="slot-base-image-wrapper" style="background-image:url(<?php if(get_the_post_thumbnail_url()){the_post_thumbnail_url('full');}else{echo get_bloginfo('template_url').'/images/placeholder.png';}?>);">
								<?php if(get_the_post_thumbnail()){the_post_thumbnail('medium', array('alt'=>get_the_title()));}else{echo '<img width="268" height="268" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>
							</div>
						</div>
						<div class="slot-base-info">
							<h3><?php echo __('Slot Info', 'websitelangid');?></h3>
							<dl>
								<dt><i class="fas fa-microchip"></i><?php echo __('Software', 'websitelangid');?></dt>
								<dd><?php if($slots_providers){?><a href="<?php echo get_term_link($slots_providers[0]->term_id);?>"><?php echo $slots_providers[0]->name;?></a><?php }else{echo '-';}?></dd>
							</dl>
							<dl>
								<dt><i class="fas fa-tasks"></i><?php echo __('Type', 'websitelangid');?></dt>
								<dd><?php if($slots_types){$slots_types_count = 1; foreach($slots_types as $slots_type){if($slots_types_count > 1){echo ', ';} echo $slots_type->name; $slots_types_count++;}}else{echo '-';}?></dd>
							</dl>
							<dl>
								<dt><i class="fas fa-th"></i><?php echo __('Reels', 'websitelangid');?></dt>
								<dd><?php if($slot_reels){echo $slot_reels;}else{echo '-';}?></dd>
							</dl>
							<dl>
								<dt><i class="fas fa-sliders-h"></i><?php echo __('Paylines', 'websitelangid');?></dt>
								<dd><?php if($slot_paylines){echo $slot_paylines;}else{echo '-';}?></dd>
							</dl>
							<dl>
								<dt><i class="fas fa-history"></i><?php echo __('RTP', 'websitelangid');?></dt>
								<dd><?php if($slot_rtp){echo $slot_rtp;}else{echo '-';}?></dd>
							</dl>
							<dl>
								<dt><i class="fas fa-balance-scale-left"></i><?php echo __('Volatility', 'websitelangid');?></dt>
								<dd><?php if($slot_volatility){echo $slot_volatility;}else{echo '-';}?></dd>
							</dl>
							<dl>
								<dt><i class="fas fa-sort-amount-down-alt"></i><?php echo __('Min Bet', 'websitelangid');?></dt>
								<dd><?php if($slot_min_bet){echo $slot_min_bet;}else{echo '-';}?></dd>
							</dl>
							<dl>
								<dt><i class="fas fa-sort-amount-up"></i><?php echo __('Max Bet', 'websitelangid');?></dt>
								<dd><?php if($slot_max_bet){echo $slot_max_bet;}else{echo '-';}?></dd>
							</dl>
							<dl>
								<dt><i class="fas fa-gem"></i><?php echo __('Top Win', 'websitelangid');?></dt>
								<dd><?php if($slot_top_win){echo $slot_top_win;}else{echo '-';}?></dd>
							</dl>
							<dl>
								<dt><i class="fas fa-tasks"></i><?php echo __('Themes', 'websitelangid');?></dt>
								<dd><?php if($slots_themes){$slots_themes_count = 1; foreach($slots_themes as $slots_theme){if($slots_themes_count > 1){echo ', ';} echo $slots_theme->name; $slots_themes_count++;}}else{echo '-';}?></dd>
							</dl>
						</div>
						<?php if($slots_features){?>
						<div class="slot-base-features">
							<h3><?php echo __('Bonus Features', 'websitelangid');?></h3>
							<?php foreach($slots_features as $slots_feature){?>
								<dl>
									<dt><?php the_field('tax_icon', 'slots_features_'.$slots_feature->term_id); echo $slots_feature->name;?></dt>
									<dd><?php echo __('Yes', 'websitelangid');?></dd>
								</dl>
							<?php }?>
						</div>
						<?php }?>
					</div>
				</section>
			</div>
		</div>
		<?php if($slots_providers){$provider_offered_casinos = get_field('provider_offered_casinos', 'slots_providers_'.$slots_providers[0]->term_id); if($provider_offered_casinos){?>
		<div class="content-zone slot-featured-casinos-line float">
			<div class="align">
				<aside>
					<div class="slot-featured-casinos-line-noise">
						<div class="slot-featured-casinos-line-position">
							<header>
								<h5><?php echo __('Best Casinos that Offer', 'websitelangid').' '.$slots_providers[0]->name;?></h5>
							</header>
							<div class="owl-carousel">
								<?php foreach($provider_offered_casinos as $post){setup_postdata($post);?>
								<?php
								$loop_casino_website_link = get_field('casino_website_link');
								?>
								<div>
									<?php if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="147" height="147" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>
									<div class="slot-featured-casino-title"><strong><?php the_title();?></strong></div>
									<div class="slot-featured-casino-cta">
										<div>
											<?php if($loop_casino_website_link){?><a href="<?php echo rtrim(home_url(), '/');?>/go/?type=casino_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Play', 'websitelangid');?></a><?php }?>
											<a href="<?php the_permalink();?>"><?php echo __('Read Review', 'websitelangid');?></a>
										</div>
									</div>
								</div>
								<?php } wp_reset_postdata();?>
							</div>
						</div>
					</div>
				</aside>
			</div>
		</div>
<script>
jQuery(window).on('load', function(){
	var owl_id_featured_casinos_slider = jQuery('.slot-featured-casinos-line .owl-carousel');
	owl_id_featured_casinos_slider.owlCarousel({
		stageElement:'ul',
		itemElement:'li',
		items:1,
		responsive:{0:{items:1}, 341:{items:2}, 531:{items:3}, 721:{items:4}, 831:{items:5}, 1101:{items:6}, 1261:{items:7}},
		margin:0,
		loop:false,
		mouseDrag:false,
		nav:true,
		dots:true,
		rewind:true,
		navText:['<i class="fas fa-long-arrow-alt-left"></i>','<i class="fas fa-long-arrow-alt-right"></i>'],
	});
});
</script>
		<?php }}?>
		<div class="content-zone styled-section float">
			<div class="align">
				<section>
					<img class="wp-post-image" width="1200" height="201" src="<?php bloginfo('template_url');?>/images/table_games_featured_image.webp" alt="<?php the_title();?>" loading="lazy"/>
					<?php if(have_posts()):?>
					<?php while(have_posts()):the_post();?>
					<?php
					if(get_the_content()){
						the_content();
					}else{
						if($slots_types and $slots_providers and $slot_rtp and $slot_volatility and $slot_top_win){
							echo vsprintf(__('<h1>%s</h1><p>%s is a %s slot machine by %s developer. It is based on special features that build up winning combinations. With an RTP of %s and %s volatility, %s also offers top wins of up to %s. This means that players can earn money with just a few clicks.</p><p>If %s seems to be the right choice for you, give it a try. To start the gameplay, you just need to visit the casino, load the game, and press the “Spin” button. If you want to learn some more information about this and other %s slot machines, you can check out our online guide.</p>', 'websitelangid'), array($slot_title, $slot_title, $slots_types[0]->name, $slots_providers[0]>name, $slot_rtp, $slot_volatility, $slot_title, $slot_top_win, $slot_title, $slots_types[0]->name));
						}
					}
					?>
					<?php endwhile;?>
					<?php endif;?>
				</section>
			</div>
		</div>
		<?php if(have_rows('slot_faq')):?>
		<div class="content-zone faq-line float">
			<div class="align">
				<section>
					<header>
						<h3><?php echo sprintf(__('%s FAQ', 'websitelangid'), get_the_title());?></h3>
					</header>
					<div itemscope itemtype="https://schema.org/FAQPage">
						<?php while(have_rows('slot_faq')):the_row();?>
						<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
							<h3 class="accordion"><i class="fas fa-plus"></i><i class="fas fa-minus"></i><span itemprop="name"><?php the_sub_field('question');?></span></h3>
							<div class="panel" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
								<div itemprop="text"><?php the_sub_field('answer');?></div>
							</div>
						</div>
						<?php endwhile;?>
					</div>
				</section>
			</div>
		</div>
		<?php endif;?>
		<?php if($slots_providers){$all_provider_slots = get_posts(array('suppress_filters'=>false, 'numberposts'=>-1, 'post_type'=>'slots', 'orderby'=>'title', 'order'=>'ASC', 'tax_query'=>array(array('taxonomy'=>'slots_providers', 'field'=>'id', 'terms'=>$slots_providers[0]->term_id)))); if($all_provider_slots){?>
		<div class="content-zone provider-slot-games float">
			<div class="align">
				<aside>
					<header>
						<h5><?php echo __('All Slot Machine Games by', 'websitelangid');?> <?php echo $slots_providers[0]->name;?></h5>
					</header>
					<ul>
						<?php foreach($all_provider_slots as $post){setup_postdata($post);?>
						<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
						<?php } wp_reset_postdata();?>
					</ul>
				</aside>
			</div>
		</div>
		<?php }}?>
<?php get_footer();?>