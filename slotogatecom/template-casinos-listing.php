						<?php
						global $count_casinos, $country_detect, $loop_count_casinos;
						$current_casino_id = get_the_ID();
						$loop_overall_reviews_rating = round(get_field('overall_reviews_rating'), 2);
						$loop_casino_website_link = get_field('casino_website_link');
						$loop_casino_bonuses_relationship = get_field('casino_bonuses_relationship');
						$loop_casinos_deposits = wp_get_post_terms($current_casino_id, 'casinos_deposits', array('fields'=>'all'));
						?>
						<?php if($count_casinos == 1){?>
							<?php
							$loop_casino_subheading = get_field('casino_subheading');
							$loop_casino_description = get_field('casino_description');
							$loop_casinos_types = wp_get_post_terms($current_casino_id, 'casinos_types', array('fields'=>'names'));
							?>
							<li class="main-casino-item">
								<div class="main-casino-item-wrapper">
									<div class="main-casino-item-meta">
										<div class="main-casino-item-image">
											<a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="150" height="150" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?></a>
										</div>
										<div class="main-casino-item-rating">
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
										<?php if($loop_casinos_types){?><div class="main-casino-item-types"><strong><?php echo __('Types', 'websitelangid');?></strong>:<br><?php $loop_casinos_types_count = 1; foreach($loop_casinos_types as $loop_casinos_type){if($loop_casinos_types_count > 1){echo ', ';} echo $loop_casinos_type; $loop_casinos_types_count++;}?></div><?php }?>
										<?php if($loop_casinos_deposits){shuffle($loop_casinos_deposits);?><div class="main-casino-item-deposits"><strong><?php echo __('Deposit Methods', 'websitelangid');?></strong>:<br><?php $loop_casinos_deposits_count = 1; foreach($loop_casinos_deposits as $loop_casinos_deposit){$tax_logo_image = get_field('tax_logo_image', 'casinos_deposits_'.$loop_casinos_deposit->term_id); echo '<span>'.wp_get_attachment_image($tax_logo_image, 'full').$loop_casinos_deposit->name.'</span>'; if($loop_casinos_deposits_count == 6){echo '<br>'.__('and more...', 'websitelangid'); break;} $loop_casinos_deposits_count++;}?></div><?php }?>
									</div>
									<div class="main-casino-item-info">
										<div class="main-casino-item-title"><strong><?php the_title(); if($loop_casino_subheading){echo ' - '.$loop_casino_subheading;}?></strong></div>
										<?php if($loop_casino_description){?><div class="main-casino-item-desc"><?php echo $loop_casino_description;?></div><?php }?>
										<div class="main-casino-item-bonus"><?php echo __('Welcome Bonus', 'websitelangid');?><br>
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
										<?php if(have_rows('casino_pros')){?>
										<div class="main-casino-item-pros">
											<ul>
												<?php while(have_rows('casino_pros')){the_row();?>
												<li><i class="fas fa-check"></i><?php the_sub_field('pros_name');?></li>
												<?php }?>
											</ul>
										</div>
										<?php }?>
										<div class="main-casino-item-cta">
											<?php if($loop_casino_website_link){?><a class="main-casino-item-cta-link" href="<?php echo rtrim(home_url(), '/');?>/go/?type=casino_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Play Now', 'websitelangid');?></a><?php }?>
											<a href="<?php the_permalink();?>"><?php echo __('Read Review', 'websitelangid');?></a>
										</div>
									</div>
								</div>
							</li>
						<?php }else{?>
							<?php if($count_casinos == 2 or $count_casinos == '' and $loop_count_casinos == ''){?>
							<li class="casinos-listing-header">
								<div class="casinos-listing-header-wrapper">
									<div class="casinos-listing-header-name"><p><?php echo __('Name', 'websitelangid');?></p></div>
									<div class="casinos-listing-header-bonus"><p><?php echo __('Welcome bonus', 'websitelangid');?></p></div>
									<div class="casinos-listing-header-pros"><p><?php echo __('Pros', 'websitelangid');?></p></div>
									<div class="casinos-listing-header-payments"><p><?php echo __('Payments', 'websitelangid');?></p></div>
									<div class="casinos-listing-header-actions"><p><?php echo __('Actions', 'websitelangid');?></p></div>
								</div>
							</li>
							<?php }?>
							<li class="casinos-listing-table <?php if($count_casinos == 2){echo 'first-in-list';}?>">
								<div class="casinos-listing-table-body">
									<div class="casinos-listing-table-image">
										<a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="150" height="150" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?></a>
									</div>
									<div class="casinos-listing-table-name">
										<p><strong><?php the_title();?></strong></p>
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
										<p><?php echo $loop_overall_reviews_rating_stars;?> <span><?php echo $loop_overall_reviews_rating_number;?></span></p>
									</div>
									<div class="casinos-listing-table-bonus">
										<p><img width="16" height="16" src="<?php bloginfo('template_url');?>/images/icons/bonus-icon.svg" alt="Bonus Icon" loading="lazy"/>
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
										</p>
									</div>
									<div class="casinos-listing-table-pros">
										<?php if(have_rows('casino_pros')){?>
										<ul>
											<?php while(have_rows('casino_pros')){the_row();?>
											<li><i class="fas fa-check"></i><?php the_sub_field('pros_name');?></li>
											<?php }?>
										</ul>
										<?php }?>
									</div>
									<div class="casinos-listing-table-payments">
										<?php if($loop_casinos_deposits){shuffle($loop_casinos_deposits);?><p><?php $loop_casinos_deposits_count = 1; foreach($loop_casinos_deposits as $loop_casinos_deposit){$tax_logo_image = get_field('tax_logo_image', 'casinos_deposits_'.$loop_casinos_deposit->term_id); echo '<span>'.wp_get_attachment_image($tax_logo_image, 'full').$loop_casinos_deposit->name.'</span>'; if($loop_casinos_deposits_count == 6){break;} $loop_casinos_deposits_count++;}?></p><?php }?>
									</div>
									<div class="casinos-listing-table-actions">
										<?php if($loop_casino_website_link){?><a class="casino-cta-link" href="<?php echo rtrim(home_url(), '/');?>/go/?type=casino_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Claim Bonus', 'websitelangid');?></a><?php }?>
										<a href="<?php the_permalink();?>"><?php echo __('Read Review', 'websitelangid');?></a>
									</div>
								</div>
							</li>
							<?php $loop_count_casinos = 1;?>
						<?php }?>