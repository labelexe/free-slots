						<?php global $country_detect;?>
						<?php $casino_bonuses_relationship = get_field('casino_bonuses_relationship'); if($casino_bonuses_relationship){?>
							<?php
							$casino_permalink = get_permalink($casino_bonuses_relationship[0]->ID);
							$casino_post_thumbnail = get_the_post_thumbnail($casino_bonuses_relationship[0]->ID, 'thumbnail', array('alt'=>$casino_bonuses_relationship[0]->post_title));
							$casino_overall_reviews_rating = round(get_field('overall_reviews_rating', $casino_bonuses_relationship[0]->ID), 2);
							$bonus_claim_link = get_field('bonus_claim_link');
							$bonuses_types = wp_get_post_terms(get_the_ID(), 'bonuses_types');
							$bonus_promo_code = get_field('bonus_promo_code');
							$bonus_not_awarded = get_field('bonus_not_awarded');
							$bonus_description = get_field('bonus_description');
							?>
							<li>
								<div class="bonuses-listing-table-body">
									<div class="bonuses-listing-table-casino">
										<a href="<?php echo $casino_permalink;?>" title="<?php echo $casino_bonuses_relationship[0]->post_title;?>"><?php if($casino_post_thumbnail){echo $casino_post_thumbnail;}else{echo '<img class="wp-post-image" width="120" height="120" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?></a>
									</div>
									<div class="bonuses-listing-table-rating">
										<div class="bonuses-listing-table-rating-wrapper">
											<div class="bonuses-listing-table-rating-stars">
												<?php
												if($casino_overall_reviews_rating == '' or $casino_overall_reviews_rating == 0){
													$casino_overall_reviews_rating = 0;
													$casino_overall_reviews_rating_number = 0;
												}else{
													$casino_overall_reviews_rating_number = $casino_overall_reviews_rating;
												}
												if($casino_overall_reviews_rating <= 0.4){
													$casino_overall_reviews_rating_stars = '<i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($casino_overall_reviews_rating <= 0.9){
													$casino_overall_reviews_rating_stars = '<i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($casino_overall_reviews_rating <= 1.4){
													$casino_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($casino_overall_reviews_rating <= 1.9){
													$casino_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($casino_overall_reviews_rating <= 2.4){
													$casino_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($casino_overall_reviews_rating <= 2.9){
													$casino_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($casino_overall_reviews_rating <= 3.4){
													$casino_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($casino_overall_reviews_rating <= 3.9){
													$casino_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i>';
												}elseif($casino_overall_reviews_rating <= 4.4){
													$casino_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>';
												}elseif($casino_overall_reviews_rating <= 4.9){
													$casino_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>';
												}elseif($casino_overall_reviews_rating == 5){
													$casino_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
												}
												?>
												<p><?php echo $casino_overall_reviews_rating_stars;?> <span><?php echo $casino_overall_reviews_rating_number;?></span></p>
											</div>
											<div class="bonuses-listing-table-rating-award">
												<?php if($bonus_not_awarded != true){?>
													<div>
														<img width="32" height="32" src="<?php bloginfo('template_url');?>/images/logo.svg" alt="<?php bloginfo('title');?>" loading="lazy"/>
														<p><?php echo __('<strong>SlotoGate</strong><br>Gold Award', 'websitelangid');?></p>
													</div>
												<?php }else{?>
													<div class="silver-award">
														<img width="32" height="32" src="<?php bloginfo('template_url');?>/images/logo-silver.svg" alt="<?php bloginfo('title');?>" loading="lazy"/>
														<p><?php echo __('<strong>SlotoGate</strong><br>Silver Award', 'websitelangid');?></p>
													</div>
												<?php }?>
											</div>
										</div>
									</div>
									<div class="bonuses-listing-table-type">
										<p><?php if($bonuses_types){echo $bonuses_types[0]->name;}else{echo '-';}?></p>
									</div>
									<div class="bonuses-listing-table-bonus">
										<?php if($bonus_promo_code){?>
										<div class="bonuses-listing-table-bonus-promo-code">
											<div><mark><img width="18" height="18" src="<?php bloginfo('template_url');?>/images/icons/coupon-icon.svg" alt="Coupon Icon" loading="lazy"/><?php echo '<small>'.__('Promo Code', 'websitelangid').':</small> '.$bonus_promo_code;?></mark></div>
											<p>
												<?php
												$bonus_country_descriptions = get_field('bonus_country_descriptions');
												if($country_detect and $bonus_country_descriptions){
													foreach($bonus_country_descriptions as $bonus_country_description){
														if($bonus_country_description['bonus_country_select']->name == $country_detect){
															$bonus_country_detected_desc = $bonus_country_description['bonus_country_description'];
															break;
														}else{
															$bonus_country_detected_desc = '';
														}
													}
													if($bonus_country_detected_desc != ''){
														echo $bonus_country_detected_desc;
													}else{
														if($bonus_description){echo $bonus_description;}else{echo '-';}
													}
												}else{
													if($bonus_description){echo $bonus_description;}else{echo '-';}
												}
												?>
											</p>
										</div>
										<?php }else{?>
										<div class="bonuses-listing-table-bonus-regular">
											<p><img width="16" height="16" src="<?php bloginfo('template_url');?>/images/icons/bonus-icon.svg" alt="Bonus Icon" loading="lazy"/>
												<?php
												$bonus_country_descriptions = get_field('bonus_country_descriptions');
												if($country_detect and $bonus_country_descriptions){
													foreach($bonus_country_descriptions as $bonus_country_description){
														if($bonus_country_description['bonus_country_select']->name == $country_detect){
															$bonus_country_detected_desc = $bonus_country_description['bonus_country_description'];
															break;
														}else{
															$bonus_country_detected_desc = '';
														}
													}
													if($bonus_country_detected_desc != ''){
														echo $bonus_country_detected_desc;
													}else{
														if($bonus_description){echo $bonus_description;}else{echo '-';}
													}
												}else{
													if($bonus_description){echo $bonus_description;}else{echo '-';}
												}
												?>
											</p>
										</div>
										<?php }?>
									</div>
									<div class="bonuses-listing-table-actions">
										<?php if($bonus_claim_link){?><a class="bonus-item-cta-link" href="<?php echo rtrim(home_url(), '/');?>/go/?type=bonus_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Claim Bonus', 'websitelangid');?></a><?php }?>
										<a href="<?php echo $casino_permalink;?>"><?php echo __('Read Review', 'websitelangid');?></a>
									</div>
								</div>
							</li>
						<?php }?>