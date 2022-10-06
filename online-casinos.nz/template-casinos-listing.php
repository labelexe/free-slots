<?php
						global $count_casinos, $country_detect;
						$current_casino_id = get_the_ID();
						$loop_overall_reviews_rating = round(get_field('overall_reviews_rating'), 2);
						$loop_casino_website_link = get_field('casino_website_link');
						$loop_casino_bonuses_relationship = get_field('casino_bonuses_relationship');
						?>
						<?php if($count_casinos == 1){?>
							<?php
							$loop_casino_subheading = get_field('casino_subheading');
							$loop_casino_description = get_field('casino_description');
							$bonus_description = get_field('bonus_description');
							$loop_casinos_types = wp_get_post_terms($current_casino_id, 'casinos_types', array('fields'=>'names'));
							$loop_casinos_deposits = wp_get_post_terms($current_casino_id, 'casinos_deposits', array('fields'=>'names'));
							?>
							
							
							<li class="play__item best-casinos">
								<div class="play__item-container">
									<div class="best-casinos-container">
										<div class="play__item-box best-casinos">
										<svg class="best-casinos__svg">
											<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-image-left"></use>
										</svg>
										<span class="play__item-number best-casinos"><?php echo $wp_query->current_post +1; ?></span>
										<svg class="best-casinos__svg">
											<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-image-right"></use>
										</svg>
										<a class="play__logo-bonus best-casinos" href="<?php the_permalink();?>">
										<div class="play__logo-bonus best-casinos"><?php if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('class' => "play__logo-bonus best-casinos",), array('alt'=>get_the_title()));}else{echo '<img class="play__logo-bonus best-casinos"" src="'.get_bloginfo('template_url').'/assets/img/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?></div>
										</a>
									
										
										</div>
										<div class="bonus-item-rating-box">
										<span><?php echo __('Rating', 'websitelangid');?></span>
										<div class="play__item-img bonus-item-rating best-casinos">
										<div class="casino-rating">
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
											<?php echo $loop_overall_reviews_rating_stars;?> 
										</div>
										</div>
										</div>
									</div>
									<div class="play__item-bonus best-casinos">
										
										<img
										src="<?php bloginfo( 'template_url' ); ?>/assets/img/bonus-box.png"
										alt="Group"
										class="item-bonus__img best-casinos"
										/>
										<div class="item-bonus__text best-casinos">
										
											
										<span class="text__your-bonys best-casinos"><?php echo __('Welcome bonus:', 'websitelangid');?></span>
										<p class="text__title-bonus best-casinos">
												
										<?php
										if($loop_casino_bonuses_relationship){
											foreach($loop_casino_bonuses_relationship as $loop_casino_bonuses_relationship_item){
												$loop_bonuses_types = wp_get_post_terms($loop_casino_bonuses_relationship_item->ID, 'bonuses_types');
												if($loop_bonuses_types){
													$loop_bonus_description = get_field('bonus_description', $loop_casino_bonuses_relationship_item->ID);
													$loop_bonus_country_descriptions = get_field('bonus_country_descriptions', $loop_casino_bonuses_relationship_item->ID);
													if($country_detect and $loop_bonus_country_descriptions){
														{
															if($loop_bonus_description){echo $loop_bonus_description;}else{echo '-';}
														}
													}else{
														if($loop_bonus_description){echo $loop_bonus_description;}else{echo '-';}
													}
													break;
												}
											}
										}else{
											 echo '-';}
										?>
										</p>
										</div>
									</div>
								</div>
								<div class="bonus__button-container best-casinos">
									<?php if($loop_casino_website_link){?><a class="bonus__button" href="<?php echo rtrim(home_url(), '/');?>/go/?type=casino_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Play Now', 'websitelangid');?></a><?php }?>
									<a class="bonus__button review" href="<?php the_permalink();?>"><?php echo __('Read Review', 'websitelangid');?></a>
								</div>
							</li>
						<?php }?>