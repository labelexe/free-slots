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
		
		$casino_id = get_the_ID();
		$casino_id_original = apply_filters('wpml_object_id', get_the_ID(), 'casinos', true, 'en');
		$current_casino_title = get_the_title();
		$casino_inactive = get_field('casino_inactive');
		$casino_inactive_message = get_field('casino_inactive_message');
		$casino_pros = get_field('casino_pros');
		$casino_cons = get_field('casino_cons');
		$casino_faq = get_field('casino_faq');
		$casino_subheading = get_field('casino_subheading');
		$casinos_countries = wp_get_post_terms($casino_id, 'casinos_countries', array('fields'=>'names'));
		$casinos_countries_ids = wp_get_post_terms($casino_id, 'casinos_countries', array('fields'=>'ids'));
		$overall_reviews_rating = round(get_field('overall_reviews_rating'), 2);
		$casino_website_link = get_field('casino_website_link');
		$casino_website_name = get_field('casino_website_name');
		$casinos_deposits = wp_get_post_terms($casino_id, 'casinos_deposits', array('fields'=>'names'));
		$casinos_withdrawals = wp_get_post_terms($casino_id, 'casinos_withdrawals', array('fields'=>'names'));
		$casino_software = get_field('casino_software');
		$casinos_types = wp_get_post_terms($casino_id, 'casinos_types', array('fields'=>'names'));
		$casinos_currencies = wp_get_post_terms($casino_id, 'casinos_currencies', array('fields'=>'names'));
		$casinos_languages = wp_get_post_terms($casino_id, 'casinos_languages', array('fields'=>'names'));
		$casinos_licenses = wp_get_post_terms($casino_id, 'casinos_licenses');
		$casino_established_date = get_field('casino_established_date');
		$casino_withdrawal_limit = get_field('casino_withdrawal_limit');
		
		/*SET PAGE VIEW*/
		wpb_set_post_views($casino_id);
		
		$casino_bonuses_relationship = get_field('casino_bonuses_relationship');
		?>
		<div class="content-zone casino-review-page float">
			<div class="align">
				<section>
					<?php if($casino_inactive == true){?>
					<div id="CasinoInactive"></div>
					<aside class="casino-review-inactive">
						<div class="align">
							<p><strong><i class="fas fa-exclamation-circle"></i><?php /*  echo __('Inactive', 'websitelangid'); */?></strong><?php /* the_title(); */ ?><?php if($casino_inactive_message){echo $casino_inactive_message;}else{echo __('is no longer available as it has stopped its operations. Please try these instead:', 'websitelangid');}?></p>
							<?php if($casinos_countries and $country_detect){$active_casinos = get_posts(array('suppress_filters'=>false, 'numberposts'=>4, 'post_type'=>'casinos', 'exclude'=>$casino_id, 'tax_query'=>array(array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect)), 'meta_query'=>array('relation'=>'AND', 'active_casinos'=>array('key'=>'casino_inactive', 'value'=>1, 'compare'=>'NOT IN'), 'casino_rating'=>array('key'=>'overall_reviews_rating', 'compare'=>'EXISTS', 'type'=>'NUMERIC')), 'orderby'=>array('casino_rating'=>'DESC', 'title'=>'ASC'))); if($active_casinos){?>
							<ul>
								<?php foreach($active_casinos as $post){setup_postdata($post);?>
								<?php
								$active_casino_website_link = get_field('casino_website_link');
								$active_overall_reviews_rating = round(get_field('overall_reviews_rating'), 2);
								?>
								<li>
									<a class="casino-review-active-casino-page" href="<?php the_permalink();?>">
										<?php if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="50" height="50" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>
										<div class="casino-review-active-casino-info">
											<div class="casino-review-active-casino-name"><?php the_title();?></div>
											<div class="casino-review-active-casino-rating">
												<?php
												if($active_overall_reviews_rating == '' or $active_overall_reviews_rating == 0){
													$active_overall_reviews_rating = 0;
													$active_overall_reviews_rating_number = 0;
												}else{
													$active_overall_reviews_rating_number = $active_overall_reviews_rating;
												}
												if($active_overall_reviews_rating <= 0.4){
													$active_overall_reviews_rating_stars = '<i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($active_overall_reviews_rating <= 0.9){
													$active_overall_reviews_rating_stars = '<i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($active_overall_reviews_rating <= 1.4){
													$active_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($active_overall_reviews_rating <= 1.9){
													$active_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($active_overall_reviews_rating <= 2.4){
													$active_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($active_overall_reviews_rating <= 2.9){
													$active_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($active_overall_reviews_rating <= 3.4){
													$active_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
												}elseif($active_overall_reviews_rating <= 3.9){
													$active_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i>';
												}elseif($active_overall_reviews_rating <= 4.4){
													$active_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>';
												}elseif($active_overall_reviews_rating <= 4.9){
													$active_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>';
												}elseif($active_overall_reviews_rating == 5){
													$active_overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
												}
												?>
												<?php echo $active_overall_reviews_rating_stars;?> <span><?php echo $active_overall_reviews_rating_number;?></span>
											</div>
										</div>
									</a>
									<?php if($active_casino_website_link){?><a class="casino-review-active-casino-link" href="<?php echo rtrim(home_url(), '/');?>/go/?type=casino_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Play', 'websitelangid');?></a><?php }?>
								</li>
								<?php } wp_reset_postdata();?>
							</ul>
							<?php }}?>
						</div>
					</aside>
					<?php }?>
					<div id="CasinoOverview" <?php if($casino_inactive == true){echo 'class="casino-overview-inactive"';}?>></div>
					<div class="casino-review-intro">
						<div class="casino-review-intro-wrapper">
							<div class="casino-review-summary">
								<?php if($casino_website_link){echo '<a class="casino-review-summary-logo" href="'.rtrim(home_url(), '/').'/go/?type=casino_page&go_to_id='.$post->ID.'" rel="nofollow noopener noreferrer" target="_blank">';}else{echo '<div class="casino-review-summary-logo">';} if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="150" height="150" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';} if($casino_website_link){echo '</a>';}else{echo '</div>';}?>
								<header>
									<h3><?php the_title();?></h3>
									<?php if($casino_subheading){echo '<p>'.$casino_subheading.'</p>';}?>
									<?php if($casinos_countries and $country_detect){?><p class="casino-review-country"><small><?php echo do_shortcode('[useriploc type="flag" height="24px" width="auto"]');?><?php echo __('Players from', 'websitelangid');?> <?php echo $country_native_name;?> <?php if(in_array($country_detect, $casinos_countries)){echo __('accepted', 'websitelangid');}else{echo __('not accepted', 'websitelangid');}?></small></p><?php }?>
									<?php if($casino_website_link){?><a class="casino-review-cta-link" href="<?php echo rtrim(home_url(), '/');?>/go/?type=casino_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Visit Casino', 'websitelangid');?></a><?php }?>
									<div class="casino-review-favorite"><?php the_favorites_button();?></div>
								</header>
								<div class="casino-review-summary-rating">
									<?php
									if($overall_reviews_rating == '' or $overall_reviews_rating == 0){
										$overall_reviews_rating = 0;
										$overall_reviews_rating_number = 0;
									}else{
										$overall_reviews_rating_number = $overall_reviews_rating;
									}
									if($overall_reviews_rating <= 0.4){
										$overall_reviews_rating_stars = '<i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
									}elseif($overall_reviews_rating <= 0.9){
										$overall_reviews_rating_stars = '<i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
									}elseif($overall_reviews_rating <= 1.4){
										$overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
									}elseif($overall_reviews_rating <= 1.9){
										$overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
									}elseif($overall_reviews_rating <= 2.4){
										$overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
									}elseif($overall_reviews_rating <= 2.9){
										$overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
									}elseif($overall_reviews_rating <= 3.4){
										$overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
									}elseif($overall_reviews_rating <= 3.9){
										$overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i><i class="far fa-star"></i>';
									}elseif($overall_reviews_rating <= 4.4){
										$overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>';
									}elseif($overall_reviews_rating <= 4.9){
										$overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>';
									}elseif($overall_reviews_rating == 5){
										$overall_reviews_rating_stars = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
									}
									?>
									<?php echo $overall_reviews_rating_stars;?><br><?php echo __('Rating', 'websitelangid');?> <?php echo $overall_reviews_rating_number;?><br><?php echo __('Based On', 'websitelangid');?> <?php echo get_comments_number($casino_id_original);?> <?php echo __('Reviews', 'websitelangid');?>
								</div>
								<div class="casino-review-summary-bonus">
									<p><small><?php echo __('Casino Welcome Bonus', 'websitelangid');?></small><br>
									<?php
									if($casino_bonuses_relationship){
										foreach($casino_bonuses_relationship as $casino_bonuses_relationship_item){
											$bonuses_types = wp_get_post_terms($casino_bonuses_relationship_item->ID, 'bonuses_types');
											if($bonuses_types[0]->name = 'Welcome Bonus'){
												$bonus_description = get_field('bonus_description', $casino_bonuses_relationship_item->ID);
												$bonus_country_descriptions = get_field('bonus_country_descriptions', $casino_bonuses_relationship_item->ID);
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
												break;
											}
										}
									}else{echo '-';}
									?>
									</p>
								</div>
							</div>
							<div class="casino-review-controls">
								<ul>
									<li><a href="#CasinoOverview"><i class="fas fa-file-alt"></i><?php echo __('Overview', 'websitelangid');?></a></li>
									<li><a href="#CasinoDetails"><i class="fas fa-info-circle"></i><?php echo __('Details', 'websitelangid');?></a></li>
									<?php if($casino_bonuses_relationship){?><li><a href="#CasinoBonus"><i class="fas fa-tag"></i><?php echo __('Casino Bonus', 'websitelangid');?></a></li><?php }?>
									<?php if(get_the_content() or $casino_pros or $casino_cons){?><li><a href="#CasinoDescription"><i class="fas fa-edit"></i><?php echo __('Our Review', 'websitelangid');?></a></li><?php }?>
									<?php if(have_rows('casino_faq')){?><li><a href="#CasinoFAQ"><i class="fas fa-question-circle"></i><?php echo __('FAQ Player', 'websitelangid');?></a></li><?php }?>
									<?php if(comments_open()){?><li><a href="#CasinoReviews"><i class="fas fa-comments"></i><?php echo __('Reviews', 'websitelangid');?></a></li><?php }?>
								</ul>
							</div>
						</div>
					</div>
<script>
jQuery(window).scroll(function(){
	if(jQuery(window).width() > 1300){
		if(jQuery('#CasinoOverview').hasClass('casino-overview-inactive')){
			if(jQuery(this).scrollTop() > 800){
				jQuery('.casino-review-intro').addClass("casino-review-intro-fixed");
				jQuery('#CasinoOverview').addClass("casino-overview-height");
			}else{
				jQuery('.casino-review-intro').removeClass("casino-review-intro-fixed");
				jQuery('#CasinoOverview').removeClass("casino-overview-height");
			}
		}else{
			if(jQuery(this).scrollTop() > 340){
				jQuery('.casino-review-intro').addClass("casino-review-intro-fixed");
				jQuery('#CasinoOverview').addClass("casino-overview-height");
			}else{
				jQuery('.casino-review-intro').removeClass("casino-review-intro-fixed");
				jQuery('#CasinoOverview').removeClass("casino-overview-height");
			}
		}
	}

	if(jQuery(this).scrollTop() > 800){
		jQuery('.casino-review-inactive').addClass("casino-review-inactive-fixed");
		jQuery('#CasinoInactive').addClass("casino-inactive-block-fixed");
	}else{
		jQuery('.casino-review-inactive').removeClass("casino-review-inactive-fixed");
		jQuery('#CasinoInactive').removeClass("casino-inactive-block-fixed");
	}
});
</script>
					<div class="casino-review-columns">
						<div class="casino-review-content">
							<div id="CasinoDetails" class="casino-review-details">
								<div class="tab">
									<button class="tablinks" onclick="openTab(event, 'TabCasinoDetails')" id="defaultTabOpen"><?php echo __('Casino Details', 'websitelangid');?></button>
									<button class="tablinks" onclick="openTab(event, 'TabCasinoMoreDetails')"><?php echo __('More Casino Details', 'websitelangid');?></button>
								</div>
								<div id="TabCasinoDetails" class="tabcontent">
									<table>
										<tbody>
											<tr>
												<th><i class="fas fa-globe"></i><?php echo __('Website', 'websitelangid');?></th>
												<td><?php if($casino_website_link){?><a href="<?php echo rtrim(home_url(), '/').'/go/?type=casino_page&go_to_id='.$post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php if($casino_website_name){echo $casino_website_name;}else{echo __('Visit Website', 'websitelangid');}?></a><?php }else{echo '-';}?></td>
											</tr>
											<tr>
												<th><i class="fas fa-microchip"></i><?php echo __('Software', 'websitelangid');?></th>
												<td>
												<?php
												$casino_software_array = explode('|', $casino_software);
												if($casino_software_array){
													$casino_software_array_count = 1;
													foreach($casino_software_array as $casino_software_array_item){
														if($casino_software_array_count > 1){echo ', ';}
														$casino_software_array_item_provider = get_term_by('name', $casino_software_array_item, 'slots_providers');
														if($casino_software_array_item_provider){echo '<a href="'.get_term_link($casino_software_array_item_provider->term_id).'">';}
														echo $casino_software_array_item;
														if($casino_software_array_item_provider){echo '</a>';}
														$casino_software_array_count++;
													}
												}else{echo '-';}
												?>
												</td>
											</tr>
											<tr>
												<th><i class="fas fa-chevron-circle-down"></i><?php echo __('Deposit Methods', 'websitelangid');?></th>
												<td><?php if($casinos_deposits){$casinos_deposits_count = 1; foreach($casinos_deposits as $casinos_deposit){if($casinos_deposits_count > 1){echo ', ';} echo $casinos_deposit; $casinos_deposits_count++;}}else{echo '-';}?></td>
											</tr>
											<tr>
												<th><i class="fas fa-chevron-circle-up"></i><?php echo __('Withdrawal Methods', 'websitelangid');?></th>
												<td><?php if($casinos_withdrawals){$casinos_withdrawals_count = 1; foreach($casinos_withdrawals as $casinos_withdrawal){if($casinos_withdrawals_count > 1){echo ', ';} echo $casinos_withdrawal; $casinos_withdrawals_count++;}}else{echo '-';}?></td>
											</tr>
											<tr>
												<th><i class="fas fa-signal"></i><?php echo __('Withdrawal Limit', 'websitelangid');?></th>
												<td><?php if($casino_withdrawal_limit){echo $casino_withdrawal_limit;}else{echo '-';}?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div id="TabCasinoMoreDetails" class="tabcontent">
									<table>
										<tbody>
											<tr>
												<th><i class="fas fa-map-marker-alt"></i><?php echo __('Available in Countries', 'websitelangid');?></th>
												<td><?php if($casinos_countries_ids){$casinos_countries_ids_count = 1; foreach($casinos_countries_ids as $casinos_country_id){if($casinos_countries_ids_count > 1){echo ', ';} $country_native_name = get_field('country_native_name', 'casinos_countries_'.$casinos_country_id); if($country_native_name){echo $country_native_name;}else{echo get_term($casinos_country_id)->name;} $casinos_countries_ids_count++;}}else{echo '-';}?></td>
											</tr>
											<tr>
												<th><i class="fas fa-tasks"></i><?php echo __('Casino Type', 'websitelangid');?></th>
												<td><?php if($casinos_types){$casinos_types_count = 1; foreach($casinos_types as $casinos_type){if($casinos_types_count > 1){echo ', ';} echo $casinos_type; $casinos_types_count++;}}else{echo '-';}?></td>
											</tr>
											<tr>
												<th><i class="fas fa-dollar-sign"></i><?php echo __('Currencies', 'websitelangid');?></th>
												<td><?php if($casinos_currencies){$casinos_currencies_count = 1; foreach($casinos_currencies as $casinos_currency){if($casinos_currencies_count > 1){echo ', ';} echo $casinos_currency; $casinos_currencies_count++;}}else{echo '-';}?></td>
											</tr>
											<tr>
												<th><i class="fas fa-language"></i><?php echo __('Languages', 'websitelangid');?></th>
												<td><?php if($casinos_languages){$casinos_languages_count = 1; foreach($casinos_languages as $casinos_language){if($casinos_languages_count > 1){echo ', ';} echo $casinos_language; $casinos_languages_count++;}}else{echo '-';}?></td>
											</tr>
											<tr>
												<th><i class="fas fa-file-contract"></i><?php echo __('License', 'websitelangid');?></th>
												<td><?php if($casinos_licenses){$casinos_licenses_count = 1; foreach($casinos_licenses as $casinos_license){if($casinos_licenses_count > 1){echo ', ';} echo '<a href="'.get_term_link($casinos_license->term_id).'">'.$casinos_license->name.'</a>'; $casinos_licenses_count++;}}else{echo '-';}?></td>
											</tr>
											<tr>
												<th><i class="fas fa-calendar-check"></i><?php echo __('Established', 'websitelangid');?></th>
												<td><?php if($casino_established_date){echo $casino_established_date;}else{echo '-';}?></td>
											</tr>
										</tbody>
									</table>
								</div>
<script>
function openTab(evt, tabName){
	var i, tabcontent, tablinks;
	tabcontent = document.getElementsByClassName("tabcontent");
	for(i = 0; i < tabcontent.length; i++){tabcontent[i].style.display = "none";}
	tablinks = document.getElementsByClassName("tablinks");
	for(i = 0; i < tablinks.length; i++){tablinks[i].className = tablinks[i].className.replace(" active", "");}
	document.getElementById(tabName).style.display = "block";
	evt.currentTarget.className += " active";
}
document.getElementById("defaultTabOpen").click();
</script>
							</div>
							<?php if($casino_bonuses_relationship){?>
							<div id="CasinoBonus">
								<h2><?php echo sprintf(__('%s Bonuses', 'websitelangid'), $current_casino_title);?></h2>
								<div class="casino-review-bonus">
									<table>
										<thead>
											<tr>
												<th><?php echo __('Type', 'websitelangid');?></th>
												<th><?php echo __('Description', 'websitelangid');?></th>
												<th><?php echo __('Promo Code', 'websitelangid');?></th>
												<th><?php echo __('Claim', 'websitelangid');?></th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($casino_bonuses_relationship as $casino_bonuses_relationship_list_item){?>
											<?php
											$loop_bonus_claim_link = get_field('bonus_claim_link', $casino_bonuses_relationship_list_item->ID);
											$loop_bonuses_types = wp_get_post_terms($casino_bonuses_relationship_list_item->ID, 'bonuses_types');
											$loop_bonus_promo_code = get_field('bonus_promo_code', $casino_bonuses_relationship_list_item->ID);
											$loop_bonus_description = get_field('bonus_description', $casino_bonuses_relationship_list_item->ID);
											$loop_bonus_country_descriptions = get_field('bonus_country_descriptions', $casino_bonuses_relationship_list_item->ID);
											?>
											<tr>
												<td><?php if($loop_bonuses_types){echo $loop_bonuses_types[0]->name;}else{echo '-';}?></td>
												<td>
												<?php
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
												?>
												</td>
												<td><?php if($loop_bonus_promo_code){echo $loop_bonus_promo_code;}else{echo __('No Code Required', 'websitelangid');}?></td>
												<td><?php if($loop_bonus_claim_link){?><a href="<?php echo rtrim(home_url(), '/');?>/go/?type=bonus_page&go_to_id=<?php echo $casino_bonuses_relationship_list_item->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Claim Bonus', 'websitelangid');?></a><?php }else{echo '-';}?></td>
											</tr>
											<?php }?>
										</tbody>
									</table>
									<p><em><?php echo __('Terms & Conditions Apply. New Players Aged 18+. Please Gamble Responsibly.', 'websitelangid');?></em></p>
								</div>
							</div>
							<?php }?>
							<div id="CasinoDescription">
								<?php if($casino_pros or $casino_cons){?>
								<h2><?php echo sprintf(__('%s Pros & Cons', 'websitelangid'), $current_casino_title);?></h2>
								<div class="casino-review-pros-cons">
									<div>
										<?php if($casino_pros){?>
										<p><strong><?php echo __('Pros', 'websitelangid');?></strong></p>
										<ul>
											<?php foreach($casino_pros as $casino_pros_item){?>
											<li><i class="fas fa-check"></i><?php echo $casino_pros_item['pros_name'];?></li>
											<?php }?>
										</ul>
										<?php }?>
									</div>
									<div>
										<?php if($casino_cons){?>
										<p><strong><?php echo __('Cons', 'websitelangid');?></strong></p>
										<ul>
											<?php foreach($casino_cons as $casino_cons_item){?>
											<li><i class="fas fa-times"></i><?php echo $casino_cons_item['cons_name'];?></li>
											<?php }?>
										</ul>
										<?php }?>
									</div>
								</div>
								<?php }?>
								<?php if(have_posts()):?>
								<hr>
								<?php while(have_posts()):the_post();?>
								<?php
								if(get_the_content()){
									the_content();
								}else{
									if($casino_established_date and $casinos_licenses and $casinos_types and $casino_software){
										if($casinos_types[1] != ''){$casinos_types_content_list = $casinos_types[0].', '.$casinos_types[1];}else{$casinos_types_content_list = $casinos_types[0];}
										echo vsprintf(__('<h1>%s</h1><p>%s is certainly one of the most popular gambling sites, established in %s. Perhaps the reason for this is the fact that it is boasting a vast array of games and fantastic bonuses. It is licensed by %s, which guarantees a safe and secure gaming experience. %s is compatible with different devices and offers: %s option(s). It uses special gaming software provided by such famous developer(s) as %s.</p><p>%s isn’t perfect, however, its service offer is admired by players from all over the world. If you want to see a detailed review of this and other casinos, feel free to look through our online guide.</p>', 'websitelangid'), array($current_casino_title, $current_casino_title, $casino_established_date, $casinos_licenses[0]->name, $current_casino_title, $casinos_types_content_list, $casino_software, $current_casino_title));
									}
								}
								?>
								<?php endwhile;?>
								<hr>
								<?php endif;?>
							</div>
							<?php if($casino_faq){?>
							<div id="CasinoFAQ" itemscope itemtype="https://schema.org/FAQPage">
								<h2><?php echo sprintf(__('%s FAQ', 'websitelangid'), $current_casino_title);?></h2>
								<?php foreach($casino_faq as $casino_faq_item){?>
								<div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
									<h3 class="accordion"><i class="fas fa-plus"></i><i class="fas fa-minus"></i><span itemprop="name"><?php echo $casino_faq_item['question'];?></span></h3>
									<div class="panel" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
										<div itemprop="text"><?php echo $casino_faq_item['answer'];?></div>
									</div>
								</div>
								<?php }?>
							</div>
							<?php }?>
							<?php if(comments_open()){?>
							<div id="CasinoReviews" class="casino-review-reviews">
								<h2><?php echo sprintf(__('%s Customer Reviews', 'websitelangid'), $current_casino_title);?></h2>
								<?php comments_template();?>
							</div>
<script>
jQuery('label[for="acf-field_6107d3e4dffad"]').replaceWith('<label for="acf-field_6107d3e4dffad"><?php echo __('Rating', 'websitelangid');?> <span class="acf-required">*</span></label>');

jQuery('input[id="acf-field_61e9320fdb580"]').val('<?php echo ICL_LANGUAGE_CODE;?>')
</script>
							<?php }?>
						</div>
						<div class="casino-review-sidebar">
							<?php if($casinos_countries and $country_detect){$top_casino_bonuses = get_posts(array('suppress_filters'=>false, 'numberposts'=>10, 'post_type'=>'casinos', 'exclude'=>$casino_id, 'orderby'=>'meta_value_num', 'order'=>'DESC', 'meta_key'=>'overall_reviews_rating', 'tax_query'=>array(array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect)))); if($top_casino_bonuses){?>
							<aside class="casino-review-sidebar-bonuses">
								<header>
									<h5><?php echo __('Top Casino Bonuses', 'websitelangid');?></h5>
								</header>
								<ul>
									<?php foreach($top_casino_bonuses as $post){setup_postdata($post);?>
									<?php
									$loop_casino_bonuses_relationship = get_field('casino_bonuses_relationship');
									if($loop_casino_bonuses_relationship){
										$loop_bonus_claim_link = get_field('bonus_claim_link', $loop_casino_bonuses_relationship[0]->ID);
										$loop_bonus_promo_code = get_field('bonus_promo_code', $loop_casino_bonuses_relationship[0]->ID);
										$loop_bonus_description = get_field('bonus_description', $loop_casino_bonuses_relationship[0]->ID);
										$loop_bonus_country_descriptions = get_field('bonus_country_descriptions', $loop_casino_bonuses_relationship[0]->ID);
									}else{
										$loop_bonus_claim_link = '';
										$loop_bonus_promo_code = '';
										$loop_bonus_description = '';
										$loop_bonus_country_descriptions = '';
									}
									?>
									<li>
										<a class="casino-review-sidebar-bonus" href="<?php the_permalink();?>">
											<?php if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="50" height="50" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>
											<div class="casino-review-sidebar-bonus-desc"><?php the_title();?>: 
												<?php
												if($loop_casino_bonuses_relationship){
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
													
												}else{
													echo '-';
												}
												?>
												<?php if($loop_bonus_promo_code){echo ' ('.__('Promo Code', 'websitelangid').': '.$loop_bonus_promo_code.')';}?>
											</div>
										</a>
										<?php if($loop_bonus_claim_link){?><a class="casino-review-sidebar-bonus-link" href="<?php echo rtrim(home_url(), '/');?>/go/?type=bonus_page&go_to_id=<?php echo $loop_casino_bonuses_relationship[0]->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Get', 'websitelangid');?></a><?php }?>
									</li>
									<?php } wp_reset_postdata();?>
								</ul>
							</aside>
							<?php }}?>
							<?php if($casinos_countries and $country_detect){$popular_casinos = get_posts(array('suppress_filters'=>false, 'numberposts'=>10, 'post_type'=>'casinos', 'exclude'=>$casino_id, 'orderby'=>'rand', 'tax_query'=>array(array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect)))); if($popular_casinos){?>
							<aside class="casino-review-sidebar-casinos">
								<header>
									<h5><?php echo __('Most Popular Casino', 'websitelangid');?></h5>
								</header>
								<ul>
									<?php foreach($popular_casinos as $post){setup_postdata($post);?>
									<?php $popular_casino_website_link = get_field('casino_website_link');?>
									<li>
										<a class="casino-review-sidebar-casino" href="<?php the_permalink();?>">
											<?php if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="50" height="50" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>
											<div class="casino-review-sidebar-casino-name"><?php the_title();?></div>
										</a>
										<?php if($popular_casino_website_link){?><a class="casino-review-sidebar-casino-link" href="<?php echo rtrim(home_url(), '/');?>/go/?type=casino_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Play', 'websitelangid');?></a><?php }?>
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
<script>
jQuery(document).on('click', 'a[href^="#"]', function(event){
	event.preventDefault();
	jQuery('html, body').animate({scrollTop:jQuery(jQuery.attr(this, 'href')).offset().top - 58}, 500);
});
</script>
<?php get_footer();?>