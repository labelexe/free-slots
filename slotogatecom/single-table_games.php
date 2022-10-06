<?php get_header();?>
<?php
if(have_rows('flexible_blocks_top')):while(have_rows('flexible_blocks_top')):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
		<?php
		$country_detect = do_shortcode('[useriploc type="country"]');
		
		$table_game_id = get_the_ID();
		$table_game_title = get_the_title();
		$table_game_id_original = apply_filters('wpml_object_id', $table_game_id, 'table_games', true, 'en');
		$table_game_real_money_link = get_field('table_game_real_money_link');
		$report_problem_form_shortcode = get_field('report_problem_form_shortcode', 'option');
		$table_game_background_image = get_field('table_game_background_image');
		$table_game_iframe_url = get_field('table_game_iframe_url');
		
		/*SET PAGE VIEW*/
		wpb_set_post_views($table_game_id);
		?>
		<div class="content-zone single-table_game-page float">
			<div class="align">
				<section>
					<header class="table_game-header">
						<h3><?php the_title();?></h3>
						<div class="table_game-rating">
							<div class="table_game-rating-stars"><?php echo do_shortcode('[gdrts_stars_rating type="posts.table_games" id="'.$table_game_id_original.'"]');?></div>
						</div>
					</header>
					<div class="table_game-main">
						<div class="table_game-game">
							<div class="table_game-controls">
								<ul>
									<?php if($table_game_real_money_link){?><li><a class="table_game-control-play" href="<?php echo rtrim(home_url(), '/');?>/go/?type=table_game_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><i class="fas fa-dollar-sign"></i><?php echo __('Play for Real Money', 'websitelangid');?></a></li><?php }?>
									<li><a class="table_game-control-refresh" href="#"><i class="fas fa-sync-alt"></i><span><?php echo __('Refresh Game Credits', 'websitelangid');?></span></a></li>
									<li><?php the_favorites_button();?></li>
									<?php if($report_problem_form_shortcode){?><li><a class="ari-fancybox" href="#ReportProblem" title="<?php echo __('Report a Problem', 'websitelangid');?>"><i class="fas fa-exclamation-circle"></i></a></li><?php }?>
									<li><a class="table_game-control-expand" href="#" title="<?php echo __('Open in Fullscreen', 'websitelangid');?>"><i class="fas fa-expand-arrows-alt"></i><i class="fas fa-compress-arrows-alt"></i></a></li>
								</ul>
							</div>
							<div class="table_game-frame" style="background-image:url(<?php if($table_game_background_image){echo $table_game_background_image;}else{echo get_bloginfo('template_url').'/images/slot-bg.jpg';}?>);">
								<div class="table_game-frame-wrapper">
									<?php if($table_game_iframe_url){?>
									<button id="LoadUpFrameButton"><?php echo __('Play Free', 'websitelangid');?>!</button>
									<div id="FrameWrapping"></div>
<script>
jQuery("#LoadUpFrameButton").click(function(){
	jQuery('#FrameWrapping').html('<iframe id="FramePlaceholder" src="<?php echo $table_game_iframe_url;?>"></iframe>');
	jQuery("#LoadUpFrameButton").css({"display":"none"});
	jQuery("#FrameWrapping").css({"display":"block"});
	jQuery(".table_game-control-expand").css({"display":"block"});
});
jQuery(".table_game-control-refresh").click(function(){
	event.preventDefault();
	jQuery('#FramePlaceholder').attr('src', function(i, val){return val;});
});
</script>
									<?php }?>
								</div>
								<?php if($country_detect){$casinos_slides = get_posts(array('suppress_filters'=>false, 'numberposts'=>3, 'post_type'=>'casinos', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'meta_key'=>'overall_reviews_rating', 'tax_query'=>array(array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect)))); if($casinos_slides){?>
								<div class="table_game-frame-fullscreen-slider">
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
	var owl_id_table_game_frame_fullscreen_slider = jQuery('.table_game-frame-fullscreen-slider aside .owl-carousel');
	owl_id_table_game_frame_fullscreen_slider.owlCarousel({
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
jQuery('a.table_game-control-expand').click(function(){
	event.preventDefault();
	jQuery('.table_game-control-refresh').toggleClass('table_game-control-refresh-fullscreen');
	jQuery('.table_game-control-expand').toggleClass('table_game-control-expand-fullscreen');
	jQuery('.table_game-frame').toggleClass('table_game-frame-fullscreen');
	jQuery('body').toggleClass('fancybox-active compensate-for-scrollbar');
});
</script>
						</div>
						<div class="table_game-extras">
							<?php $popular_table_games = get_posts(array('suppress_filters'=>false, 'numberposts'=>10, 'post_type'=>'table_games', 'meta_key'=>'wpb_post_views_count', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'exclude'=>$table_game_id)); if($popular_table_games){?>
							<aside class="table_game-extra-games">
								<header>
									<h5><?php echo __('What Else to Play?', 'websitelangid');?></h5>
								</header>
								<ul>
									<?php foreach($popular_table_games as $post){setup_postdata($post);?>
									<?php
									$loop_table_game_id_original = apply_filters('wpml_object_id', get_the_ID(), 'table_games', true, 'en');
									?>
									<li>
										<a href="<?php the_permalink();?>">
											<?php if(get_the_post_thumbnail()){the_post_thumbnail('medium', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="120" height="120" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>
											<div class="table_game-extra-game-content">
												<div class="table_game-extra-game-title"><strong><?php the_title();?></strong></div>
												<div class="table_game-extra-game-rating"><?php echo do_shortcode('[gdrts_stars_rating disable_rating="true" type="posts.table_games" id="'.$loop_table_game_id_original.'"]');?></div>
											</div>
										</a>
									</li>
									<?php } wp_reset_postdata();?>
								</ul>
							</aside>
							<?php }?>
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
						echo vsprintf(__('<h1>%s</h1><p>%s is a table game that has taken the whole world. Thanks to high volatility and bonuses, it is easy to play. With a beneficial RTP, %s offers a great number of bets to place on the online table.</p><p>%s grants a video gambling experience to beginners and high-rollers. If you want to know more about it, make sure to read our guide.</p>', 'websitelangid'), array($table_game_title, $table_game_title, $table_game_title, $table_game_title));
					}
					?>
					<?php endwhile;?>
					<?php endif;?>
				</section>
			</div>
		</div>
<?php
if(have_rows('flexible_blocks_bottom')):while(have_rows('flexible_blocks_bottom')):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
		<?php if(have_rows('table_game_faq')):?>
		<div class="content-zone faq-line float">
			<div class="align">
				<section>
					<header>
						<h3><?php echo sprintf(__('%s FAQ', 'websitelangid'), get_the_title());?></h3>
					</header>
					<div itemscope itemtype="https://schema.org/FAQPage">
						<?php while(have_rows('table_game_faq')):the_row();?>
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
<?php get_footer();?>