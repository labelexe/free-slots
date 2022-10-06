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
		$casino_withdrawal_limit = get_field('casino_withdrawal_limit');
		$casino_company = get_field('casino_company');
		$casino_established_date = get_field('casino_established_date');
		$casino_withdrawal_limit = get_field('casino_withdrawal_limit');
		$loop_casino_bonuses_relationship = get_field('casino_bonuses_relationship');
		$bonus_description = get_field('bonus_description');
		/*SET PAGE VIEW*/
		wpb_set_post_views($casino_id);
		
		$casino_bonuses_relationship = get_field('casino_bonuses_relationship');
		
		?>
		    <main class="casino-review-page">
  
  <section>
   
		 <div class="CasinoOverview" id="CasinoOverview" <?php if($casino_inactive == true){echo 'class="casino-overview-inactive"';}?>></div>
			<div class="casino-review-intro container">
				<div class="grin-circle"></div>
				<div class="casino-review-intro-wrapper">
				<div class="intro-wrapper__container">
					<div class="casino-review-summary">
						<?php if($casino_website_link){echo '<a class="casino-review-summary-logo" href="'.rtrim(home_url(), '/').'/go/?type=casino_page&go_to_id='.$post->ID.'" rel="nofollow noopener noreferrer" target="_blank">';}else{echo '<div class="casino-review-summary-logo">';} if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="150" height="150" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';} if($casino_website_link){echo '</a>';}else{echo '</div>';}?>
						<header>
							<h3><?php the_title();?></h3>
							<?php if($casino_subheading){echo '<p>'.$casino_subheading.'</p>';}?>
							<?php if($casinos_countries and $country_detect){?><p class="casino-review-country"><small><?php echo do_shortcode('[useriploc type="flag" height="24px" width="auto"]');?><?php echo __('Players from', 'websitelangid');?> <?php echo $country_native_name;?> <?php if(in_array($country_detect, $casinos_countries)){echo __('accepted', 'websitelangid');}else{echo __('not accepted', 'websitelangid');}?></small></p><?php }?>
							<div class="casino-review-summary-rating">
						
							<div><?php echo __('Rating:', 'websitelangid');?></div>
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
							<div><?php echo $overall_reviews_rating_stars;?></div>
						</div>
						</header>
						
						
					</div>
					<div>
					<div class="play__item-bonus">
								
						<img src="<?php bloginfo( 'template_url' ); ?>/assets/img/bonus-box.png" alt="Group" class="item-bonus__img">
						<div class="item-bonus__text">
						<span class="text__your-bonys"><?php echo __('Welcome bonus:', 'websitelangid');?></span>
						<p class="text__title-bonus">
							<span class="text__prise-bonus">
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
									}else{
										 if($bonus_description){echo $bonus_description;}else{echo '-';}}
									?>
						</span>
							
							</p>
						</p>
						</div>
					</div>
						<?php if($casino_website_link){?><a class="bonus__button" href="<?php echo rtrim(home_url(), '/');?>/go/?type=casino_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Play now', 'websitelangid');?></a><?php }?>
					</div>
				</div>
				<div class="casino-review-controls">

					<ul>
						<li><a href="#CasinoOverview">
							<svg class="casino-reviev__svg">
							<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Group"></use>
							</svg>  <span><?php echo __('Overview', 'websitelangid');?></span></a>
						</li>
						<li>
							<a href="#CasinoDetails">
							<svg class="casino-reviev__svg">
							<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-list"></use>
							</svg> 
							<?php echo __('Details', 'websitelangid');?></a>
						</li>
						<li><a href="#CasinoBonus"><svg class="casino-reviev__svg">
							<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Group1"></use>
						</svg> <span><?php echo __('Casino Bonus', 'websitelangid');?></span></a></li>									
						<li><a href="#CasinoDescription"><svg class="casino-reviev__svg">
							<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-like"></use>
						</svg><?php echo __('Our Review', 'websitelangid');?></a></li>									
						<li><a href="#CasinoFAQ"><svg class="casino-reviev__svg">
							<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-faq"></use>
						</svg> </i><?php echo __('FAQ', 'websitelangid');?></a></li>									
							
						<?php if(comments_open()){?><li><a href="#CasinoReviews"><svg class="casino-reviev__svg">
							<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-chat"></use>
						</svg> <?php echo __('Reviews', 'websitelangid');?></a></li><?php }?>							
						</ul>
				</div>
			</div>
		 
		

  </section>
  <script>
window.onscroll = () => {
  const casinoOverview = document.querySelector(".CasinoOverview");
  const casinoReviewIntro = document.querySelector(".casino-review-intro");
  const Y = window.scrollY;
  if (Y > 500) {
    casinoOverview.classList.add("casino-overview-height");
    casinoReviewIntro.classList.add("casino-review-intro-fixed");
  }else{
	casinoOverview.classList.remove("casino-overview-height");
    casinoReviewIntro.classList.remove("casino-review-intro-fixed");
  }
};

</script>
   </section>
   <section id="CasinoDetails" class="casino-details">
	<div class="container">
	 <h2 class="casino-details__title"><?php echo __('Casino details', 'websitelangid');?></h2>
	 <ul class="casino-details__list">
	   <li class="casino-details__item">
		 <div>
		   <svg class="casino-details__svg">
			 <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-system-update"></use>
		   </svg>
		   <h3 class="casino-details__item-title"><?php echo __('Website', 'websitelangid');?></h3>
		 </div>
		 <p class="casino-details__text"><?php if($casino_website_link){?><a href="<?php echo $casino_website_link;?>" rel="nofollow noopener noreferrer" target="_blank"><?php if($casino_website_name){echo $casino_website_name;}else{echo __('Visit Website', 'websitelangid');}?></a><?php }else{echo '-';}?></p>
	   </li>
	   <li class="casino-details__item">
		 <div>
		   <svg class="casino-details__svg">
			 <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-system-update"></use>
		   </svg>
		   <h3 class="casino-details__item-title"><?php echo __('Software', 'websitelangid');?></h3>
		 </div>
		   <p class="casino-details__text">
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
			?></p>
	   </li>
	   <li class="casino-details__item">
		 <div>
		   <svg class="casino-details__svg">
			 <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Vector"></use>
		   </svg>
		   <h3 class="casino-details__item-title"><?php echo __('Deposit Methods', 'websitelangid');?></h3>
		 </div>
		   <p class="casino-details__text"><?php if($casinos_deposits){$casinos_deposits_count = 1; foreach($casinos_deposits as $casinos_deposit){if($casinos_deposits_count > 1){echo ', ';} echo $casinos_deposit; $casinos_deposits_count++;}}else{echo '-';}?></p>
	   </li>
	   <li class="casino-details__item">
		   <div>
			 <svg class="casino-details__svg">
			   <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Vector"></use>
			 </svg>
			 <h3 class="casino-details__item-title"><?php echo __('Withdrawal Methods', 'websitelangid');?></h3>
		   </div>
		   <p class="casino-details__text"><?php if($casinos_withdrawals){$casinos_withdrawals_count = 1; foreach($casinos_withdrawals as $casinos_withdrawal){if($casinos_withdrawals_count > 1){echo ', ';} echo $casinos_withdrawal; $casinos_withdrawals_count++;}}else{echo '-';}?></p>
	   </li>
	   <li class="casino-details__item">
		 <div>
		   <svg class="casino-details__svg">
			 <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-bar-chart"></use>
		   </svg>
		   <h3 class="casino-details__item-title"><?php echo __('', 'websitelangid');?>Withdrawal Limit</h3>
		 </div>
		   <p class="casino-details__text">	<?php if($casino_withdrawal_limit){echo $casino_withdrawal_limit;}else{echo '-';}?> </p>
	   </li>
	   <li class="casino-details__item">
		 <div>
		   <svg class="casino-details__svg">
			 <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-location"></use>
		   </svg>
		   <h3 class="casino-details__item-title"><?php echo __('Available in Countries', 'websitelangid');?></h3>
		 </div>
		   <p class="casino-details__text"><?php if($casinos_countries_ids){$casinos_countries_ids_count = 1; foreach($casinos_countries_ids as $casinos_country_id){if($casinos_countries_ids_count > 1){echo ', ';} $country_native_name = get_field('country_native_name', 'casinos_countries_'.$casinos_country_id); if($country_native_name){echo $country_native_name;}else{echo get_term($casinos_country_id)->name;} $casinos_countries_ids_count++;}}else{echo '-';}?></p>
	   </li>
	   <li class="casino-details__item">
		 <div>
		   <svg class="casino-details__svg">
			 <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-mobile-phone"></use>
		   </svg>
		   <h3 class="casino-details__item-title"><?php echo __('Casino Type', 'websitelangid');?></h3>
		 </div>
		   <p class="casino-details__text"><?php if($casinos_types){$casinos_types_count = 1; foreach($casinos_types as $casinos_type){if($casinos_types_count > 1){echo ', ';} echo $casinos_type; $casinos_types_count++;}}else{echo '-';}?></p>
	   </li>
	   <li class="casino-details__item">
		 <div>
		   <svg class="casino-details__svg">
			 <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-coin"></use>
		   </svg>
		   <h3 class="casino-details__item-title"><?php echo __('Currencies', 'websitelangid');?></h3>
		 </div>
		   <p class="casino-details__text"><?php if($casinos_currencies){$casinos_currencies_count = 1; foreach($casinos_currencies as $casinos_currency){if($casinos_currencies_count > 1){echo ', ';} echo $casinos_currency; $casinos_currencies_count++;}}else{echo '-';}?></p>
	   </li>
	   <li class="casino-details__item">
		 <div>
		   <svg class="casino-details__svg">
			 <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-language"></use>
		   </svg>
		   <h3 class="casino-details__item-title"><?php echo __('Languages', 'websitelangid');?></h3>
		 </div>
		   <p class="casino-details__text"><?php if($casinos_languages){$casinos_languages_count = 1; foreach($casinos_languages as $casinos_language){if($casinos_languages_count > 1){echo ', ';} echo $casinos_language; $casinos_languages_count++;}}else{echo '-';}?></p>
	   </li>
	   <li class="casino-details__item">
		<div>
		 <svg class="casino-details__svg">
		   <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-high-quality"></use>
		 </svg>
		 <h3 class="casino-details__item-title"><?php echo __('License', 'websitelangid');?></h3>
		</div>
		   <p class="casino-details__text">
		   <?php if($casinos_licenses){$casinos_licenses_count = 1; foreach($casinos_licenses as $casinos_license){if($casinos_licenses_count > 1){echo ', ';} echo '<span href="'.get_term_link($casinos_license->term_id).'">'.$casinos_license->name.'</span>'; $casinos_licenses_count++;}}else{echo '-';}?></p>
	   </li>
	   <li class="casino-details__item">
		 <div>
		   <svg class="casino-details__svg">
			 <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-handshake"></use>
		   </svg>
		   <h3 class="casino-details__item-title"><?php echo __('Affiliate Program', 'websitelangid');?></h3>
		 </div>
		   <p class="casino-details__text"><?php if($casino_withdrawal_limit){echo $casino_withdrawal_limit;}else{echo '-';}?></p>
	   </li>
	   <li class="casino-details__item">
		<div>
		 <svg class="casino-details__svg">
		   <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-user"></use>
		 </svg>
		 <h3 class="casino-details__item-title"><?php echo __('Company', 'websitelangid');?></h3>
		</div>
		   <p class="casino-details__text"><?php if($casino_company){echo $casino_company;}else{echo '-';}?></p>
	   </li>
	   <li class="casino-details__item">
		 <div>
		   <svg class="casino-details__svg">
			 <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Layer-2"></use>
		   </svg>
		   <h3 class="casino-details__item-title"><?php echo __('Established', 'websitelangid');?></h3>
		 </div>
		   <p class="casino-details__text"><?php if($casino_established_date){echo $casino_established_date;}else{echo '-';}?></p>
	   </li>
	 </ul>
	</div>

   </section>
   <?php if($casino_bonuses_relationship){?>
   <section id="CasinoBonus" class="play-zee">
	   <div class="container">
		   
	   
			<h2 class="info__title play-zee__title"><?php echo sprintf(__('%s Bonuses', 'websitelangid'), $current_casino_title);?></h2>
			<div class="casino-review-bonus">
				<ul class="play-zee__list">
					<li class="play-zee__item">
						<p class="play-zee__item-type"><?php echo __('Type', 'websitelangid');?></p>
						<p class="play-zee__item-deskription"><?php echo __('Description', 'websitelangid');?></p>
						<p class="play-zee__item-promo"><?php echo __('Promo Code', 'websitelangid');?></p>
						<p class="play-zee__claym"><?php echo __('Claim', 'websitelangid');?> </p>
					</li>
				
					<?php foreach($casino_bonuses_relationship as $casino_bonuses_relationship_list_item){?>
					<?php
					$loop_bonus_claim_link = get_field('bonus_claim_link', $casino_bonuses_relationship_list_item->ID);
					$loop_bonuses_types = wp_get_post_terms($casino_bonuses_relationship_list_item->ID, 'bonuses_types');
					$loop_bonus_promo_code = get_field('bonus_promo_code', $casino_bonuses_relationship_list_item->ID);
					$loop_bonus_description = get_field('bonus_description', $casino_bonuses_relationship_list_item->ID);
					$loop_bonus_country_descriptions = get_field('bonus_country_descriptions', $casino_bonuses_relationship_list_item->ID);
					?>
				
					<li class="play-zee__item">
						<p class="play-zee__item-type"><span></span> <?php if($loop_bonuses_types){echo $loop_bonuses_types[0]->name;}else{echo '-';}?></p>
						<p class="play-zee__item-deskription"><span><?php
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
							?></span></p>
							<?php if($loop_bonus_promo_code){?>
							<p class="play-zee__item-promo"><span> <?php echo $loop_bonus_promo_code;?></span> </p>
							<?php }else{?>
								<p class="play-zee__item-promo"> <?php echo __('No Code Required', 'websitelangid');?> </p>
							<?php }?>
						
						<p class="play-zee__claym">
						<?php if($loop_bonus_claim_link){?><a  class="play-zee__item-claym" href="<?php echo rtrim(home_url(), '/');?>/go/?type=bonus_page&go_to_id=<?php echo $casino_bonuses_relationship_list_item->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Claim bonus', 'websitelangid');?></a><?php }else{echo '-';}?>
					</li>
					<?php }?>
				</ul>
				<!-- <p class="play-zee-subtitle"><?php echo __('Terms & Conditions Apply. New Players Aged 18+. Please Gamble Responsibly.', 'websitelangid');?></p> -->
			</div>
		
		
	   </div>
   </section>
   <?php }?>

   <section id="CasinoDescription" class="info ">
	 <div class="container">
	 <?php if($casino_pros or $casino_cons){?>
				<h2 class="info__title title__pros-cons"><?php echo __('Play Zee Pros & Cons', 'websitelangid')?></h2>
				<div class="info__pros-cons">
						<div>
							<?php if($casino_pros){?>
							<p class="title__pros"><strong><?php echo __('Pros', 'websitelangid');?></strong></p>
							<ul class="container__pros">
								<?php foreach($casino_pros as $casino_pros_item){?>
								<li class="container__pros-text"><div class="pros-svg"><i class="pros fas fa-check"></i></div><p><?php echo $casino_pros_item['pros_name'];?></p></li>
								<?php }?>
							</ul>
							<?php }?>
						</div>
						<div>
							<?php if($casino_cons){?>
							<p class="title__pros title__cons"><strong><?php echo __('Cons', 'websitelangid');?></strong></p>
							<ul class="container__pros container__cons">
								<?php foreach($casino_cons as $casino_cons_item){?>
								<li class="container__pros-text"><div class="pros-svg cons-svg"><i class="pros fas fa-times"></i></div><p><?php echo $casino_cons_item['cons_name'];?></p></li>
								<?php }?>
							</ul>
							<?php }?>
						</div>
				</div>
				<?php }?>
			<div>
			<?php if(have_posts()):?>
				<h2 class="info__title"><?php while(have_posts()):the_post();?></h2>
				<div class="info__text casino">
					<?php
							if(get_the_content()){
								the_content();
							}else{
								if($casinos_types){
									echo vsprintf(__('<h1>%s</h1><p>%s Casino is a %s gambling site that has been operating since %s. Thanks to the partnership with well-trusted software developers, it offers a solid collection of slot machines devoted to various themes.
</p><p>%s Casino has a well-developed system of bonuses that includes free spins and special promotions. Once players manage to hit a reward, they will be able to withdraw %S  per week. A safe gambling environment is regulated by  %s.
									</p>', 'websitelangid'), array($current_casino_title, $current_casino_title, $casinos_type,  $casino_established_date, $current_casino_title, $casino_withdrawal_limit, $casinos_license->name));
								}
							}
							?>
							
							<?php endwhile;?>
					</div>
				<?php endif;?>
			</div>
	   
	 </div>
	 <section class="faq">
			<div class="container" >
			<?php if(have_rows('casino_faq')):?>
			<div class="slot-faq" itemscope itemtype="https://schema.org/FAQPage">
				<h2 class="faq__title"><?php echo sprintf(__('%s FAQ', 'websitelangid'), get_the_title());?></h2>
					<?php while(have_rows('casino_faq')):the_row();?>
				<div class="faq__text" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
					<div class="faq__question accordion" ><h3 itemprop="name"><?php the_sub_field('question');?></h3>
						<div class="faq__svg">
							<svg class="faq__svg-plus">
							<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-plus"></use>
							</svg>
						</div>
					</div>
					<div class="faq__answer panel"  itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
					<div itemprop="text"><?php the_sub_field('answer');?></div>
				</div>
			</div>
					<?php endwhile;?>
						<?php else :

			echo vsprintf(__('
			<div class="slot-faq" itemscope itemtype="https://schema.org/FAQPage">
				<h2 class="faq__title">%s FAQ</h2>
				<div class="faq__text" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
					<div class="faq__question" >
						<p itemprop="name">Does %s Casino require a download?</p>
						<div class="faq__svg">
							<svg class="faq__svg-plus" viewBox="0 0 23 32" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" stroke-width="0.9143" d="M12.901 25.292v-22.027c0-0.386-0.159-0.754-0.437-1.022s-0.65-0.415-1.036-0.415-0.758 0.147-1.036 0.415v0c-0.278 0.268-0.437 0.635-0.437 1.022v22.027l-5.617-5.418c-0.138-0.133-0.3-0.237-0.478-0.308s-0.367-0.107-0.559-0.107c-0.191 0-0.381 0.036-0.559 0.107s-0.34 0.175-0.478 0.308c-0.138 0.133-0.248 0.291-0.323 0.467v0c-0.075 0.176-0.115 0.365-0.115 0.556s0.039 0.38 0.115 0.556c0.075 0.176 0.186 0.334 0.323 0.467l8.125 7.836c0 0 0 0 0 0l0 0 0.317-0.329 2.192-4.134zM12.901 25.292l5.617-5.418c0.138-0.133 0.3-0.237 0.478-0.308s0.367-0.107 0.559-0.107c0.191 0 0.381 0.036 0.559 0.107s0.34 0.175 0.478 0.308c0.138 0.133 0.248 0.291 0.323 0.467s0.114 0.365 0.114 0.556-0.039 0.38-0.114 0.556c-0.075 0.176-0.186 0.334-0.323 0.467l-8.125 7.836c-0 0-0 0-0 0l-0 0 0.436-4.463z" fill="black"/>
							</svg>
						</div>
					</div>
					<div class="faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
						<div itemprop="text"><p>Yes, it does. Some slot games can be started without making a deposit.</p></div>
					</div>
				</div>
				<div class="faq__text" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
					<div class="faq__question">
						<p itemprop="name">Does %s have good winning potential?</p>
						<div class="faq__svg">
							<svg class="faq__svg-plus" viewBox="0 0 23 32" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" stroke-width="0.9143" d="M12.901 25.292v-22.027c0-0.386-0.159-0.754-0.437-1.022s-0.65-0.415-1.036-0.415-0.758 0.147-1.036 0.415v0c-0.278 0.268-0.437 0.635-0.437 1.022v22.027l-5.617-5.418c-0.138-0.133-0.3-0.237-0.478-0.308s-0.367-0.107-0.559-0.107c-0.191 0-0.381 0.036-0.559 0.107s-0.34 0.175-0.478 0.308c-0.138 0.133-0.248 0.291-0.323 0.467v0c-0.075 0.176-0.115 0.365-0.115 0.556s0.039 0.38 0.115 0.556c0.075 0.176 0.186 0.334 0.323 0.467l8.125 7.836c0 0 0 0 0 0l0 0 0.317-0.329 2.192-4.134zM12.901 25.292l5.617-5.418c0.138-0.133 0.3-0.237 0.478-0.308s0.367-0.107 0.559-0.107c0.191 0 0.381 0.036 0.559 0.107s0.34 0.175 0.478 0.308c0.138 0.133 0.248 0.291 0.323 0.467s0.114 0.365 0.114 0.556-0.039 0.38-0.114 0.556c-0.075 0.176-0.186 0.334-0.323 0.467l-8.125 7.836c-0 0-0 0-0 0l-0 0 0.436-4.463z" fill="black"/>
							</svg>
						</div>
					</div>
					<div class="faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
						<div itemprop="text"><p>Yes, it does. The casino offers some slot machines in demo mode to let players explore the website and gain some gaming practice.</p></div>
					</div>
				</div>
				<div class="faq__text" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
					<div class="faq__question">
						<p itemprop="name">Can players win real money at %s Casino?</p>
						<div class="faq__svg">
							<svg class="faq__svg-plus" viewBox="0 0 23 32" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" stroke-width="0.9143" d="M12.901 25.292v-22.027c0-0.386-0.159-0.754-0.437-1.022s-0.65-0.415-1.036-0.415-0.758 0.147-1.036 0.415v0c-0.278 0.268-0.437 0.635-0.437 1.022v22.027l-5.617-5.418c-0.138-0.133-0.3-0.237-0.478-0.308s-0.367-0.107-0.559-0.107c-0.191 0-0.381 0.036-0.559 0.107s-0.34 0.175-0.478 0.308c-0.138 0.133-0.248 0.291-0.323 0.467v0c-0.075 0.176-0.115 0.365-0.115 0.556s0.039 0.38 0.115 0.556c0.075 0.176 0.186 0.334 0.323 0.467l8.125 7.836c0 0 0 0 0 0l0 0 0.317-0.329 2.192-4.134zM12.901 25.292l5.617-5.418c0.138-0.133 0.3-0.237 0.478-0.308s0.367-0.107 0.559-0.107c0.191 0 0.381 0.036 0.559 0.107s0.34 0.175 0.478 0.308c0.138 0.133 0.248 0.291 0.323 0.467s0.114 0.365 0.114 0.556-0.039 0.38-0.114 0.556c-0.075 0.176-0.186 0.334-0.323 0.467l-8.125 7.836c-0 0-0 0-0 0l-0 0 0.436-4.463z" fill="black"/>
							</svg>
						</div>
					</div>
					<div class="faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
						<div itemprop="text"><p>Yes, they can. The casino offers the gameplay for real money. After winning a slot game, players can withdraw up to %s from their account.</p></div>
					</div>
				</div>
			</div>', 'websitelangid'), array($current_casino_title, $current_casino_title,  $casinos_type, $current_casino_title, $current_casino_title,   $casino_withdrawal_limit));

					endif; ?>
				</div>
			</div>
		</section> 
   </section>
   
   <section class="slider related-casino">
	 <div class="container">
	   <h2 class="slider__title"><?php echo __('Related casino', 'websitelangid');?></h2>
	   <div class="slider__wrapper">
	   <div class="casino-review-sidebar">
				
				<?php if($casinos_countries and $country_detect){$popular_casinos = get_posts(array('suppress_filters'=>false, 'numberposts'=>5, 'post_type'=>'casinos', 'exclude'=>$casino_id, 'orderby'=>'rand', 'tax_query'=>array(array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect)))); if($popular_casinos){?>
				<aside class="casino-review-sidebar-casinos">
					<ul>
						<?php foreach($popular_casinos as $post){setup_postdata($post);?>
						<?php $popular_casino_website_link = get_field('casino_website_link');?>
						<li class="slider__cards">
		<div class="grin-cirkle"></div>
		<div>
			<div class="slider__cards-container-img">
		<a class="slider__cards-img" href="<?php the_permalink();?>">
								<?php if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="slider__cards-img" width="50" height="50" src="'.get_bloginfo('template_url').'/assets/img/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>
							</a>
		</div>
		<div class="play__item-img bonus-item-rating stars">
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
				
				<?php echo $casino_overall_reviews_rating_stars;?> 
			</div>
		<h3 class="slider__cards-title"><?php the_title();?></h3>
		<p class="slider__cards-text"><?php echo __('Welcome bonus:', 'websitelangid');?>
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
									}else{
										 if($bonus_description){echo $bonus_description;}else{echo '-';}}
									?>
			</p>
		</div>
				<?php if($popular_casino_website_link){?><a class="slider__cards-buttons" href="<?php echo rtrim(home_url(), '/');?>/go/?type=casino_page&go_to_id=<?php echo $post->ID;?>" rel="nofollow noopener noreferrer" target="_blank"><?php echo __('Play', 'websitelangid');?></a><?php }?>
				<a class="slider__cards-buttons review" href="<?php the_permalink();?>"><?php echo __('Read Review', 'websitelangid');?></a>
				
	</li>
	
						<?php } wp_reset_postdata();?>
					</ul>
				</aside>
				<?php }}?>
			</div>
	   </div>
	 </div>
   </section>
   <?php if(comments_open()){?>
	<section id="CasinoReviews" class="slider reviews casino-review-reviews">
	 <div id="carousel" class="container ">
	   <h2 class="slider__title"> <?php echo sprintf(__('%s Customer Reviews', 'websitelangid'), $current_casino_title);?></h2>
	   <?php comments_template();?>
</div>
	 </div>
	 
   </section>
<script>
jQuery('label[for="acf-field_6107d3e4dffad"]').replaceWith('<label for="acf-field_6107d3e4dffad"><?php echo __('Rating', 'websitelangid');?> <span class="acf-required">*</span></label>');

</script>
							<?php }?>
   
 </main>
<script>

let maxsWidth = window.matchMedia("(max-width: 1200px)");
if (maxsWidth.matches) {
  // ширина окна меньше, чем 1200px

  /* конфигурация */
  let width = 400; // ширина картинки
  // видимое количество изображений
  let count = 2;

  let list = carousel.querySelector(".slider__items");
  let listElems = carousel.querySelectorAll(".slider__cards");

  let position = 0; // положение ленты прокрутки

  carousel.querySelector(".prev").onclick = function () {
    // сдвиг влево
    position += width * count;
    // последнее передвижение влево может быть не на 3, а на 2 или 1 элемент
    position = Math.min(position, 0);
    list.style.marginLeft = position + "px";
  };

  carousel.querySelector(".next").onclick = function () {
    // сдвиг вправо
    position -= width * count;
    // последнее передвижение вправо может быть не на 3, а на 2 или 1 элемент
    position = Math.max(position, -width * (listElems.length - count));
    list.style.marginLeft = position + "px";
  };
} else {
  // ширина окна больше, чем 1200px

  /* конфигурация */
  let width = 400; // ширина картинки
  // видимое количество изображений
  let count = 3;

  let list = carousel.querySelector(".slider__items");
  let listElems = carousel.querySelectorAll(".slider__cards");

  let position = 0; // положение ленты прокрутки

  carousel.querySelector(".prev").onclick = function () {
    // сдвиг влево
    position += width * count;
    // последнее передвижение влево может быть не на 3, а на 2 или 1 элемент
    position = Math.min(position, 0);
    list.style.marginLeft = position + "px";
  };

  carousel.querySelector(".next").onclick = function () {
    // сдвиг вправо
    position -= width * count;
    // последнее передвижение вправо может быть не на 3, а на 2 или 1 элемент
    position = Math.max(position, -width * (listElems.length - count));
    list.style.marginLeft = position + "px";
  };
}

</script>
<?php get_footer();?>