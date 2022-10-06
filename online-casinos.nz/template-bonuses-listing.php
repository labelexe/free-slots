<?php global $country_detect;?>
<?php $casino_bonuses_relationship = get_field('casino_bonuses_relationship'); if($casino_bonuses_relationship){?>
	<?php
	$casino_permalink = get_permalink($casino_bonuses_relationship[0]->ID);
	$casino_post_thumbnail = get_the_post_thumbnail($casino_bonuses_relationship[0]->ID, 'thumbnail', array('class' => "play__logo-bonus best-casinos",),  array('alt'=>$casino_bonuses_relationship[0]->post_title));
	$casino_overall_reviews_rating = round(get_field('overall_reviews_rating', $casino_bonuses_relationship[0]->ID), 2);
	$bonus_claim_link = get_field('bonus_claim_link');
	$bonuses_types = wp_get_post_terms(get_the_ID(), 'bonuses_types');
	$bonus_promo_code = get_field('bonus_promo_code');
	$bonus_not_awarded = get_field('bonus_not_awarded');
	$bonus_description = get_field('bonus_description');
	$bonus_image = get_field('bonus_images');
	$bonus_prise = get_field('bonus_prise');
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
			
			<a  href="<?php echo $casino_permalink;?>" title="<?php echo $casino_bonuses_relationship[0]->post_title;?>"><?php if($casino_post_thumbnail){echo $casino_post_thumbnail;}else{echo '<img class="play__logo-bonus best-casinos"" src="'.get_bloginfo('template_url').'/assets/img/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?></a>
			<!-- <a href="<?php echo $casino_permalink;?>" title="<?php echo $casino_bonuses_relationship[0]->post_title;?>"><img
src=" <?php if($bonus_image){echo $bonus_image;}else{echo get_bloginfo('template_url').'/assets/img/placeholder.png';};?> "

alt="cosmo"
class="play__item-img"
/></a> -->
			</div>
			<div class="bonus-item-rating-box">
			<span><?php echo __('Rating', 'websitelangid');?></span>
			<div class="play__item-img bonus-item-rating best-casinos">
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
				<span class="text__prise-bonus best-casinos"></span>
				<?php if($bonus_description){echo $bonus_description;}else{echo '-';}?>
				</p>
			</div>
		</div>
	</div>
		<div class="bonus__button-container best-casinos">
			<?php if($bonus_claim_link){?>
				<a rel="nofollow noopener noreferrer" target="_blank" href="<?php echo rtrim(home_url(), '/');?>/go/?type=bonus_page&go_to_id=<?php echo $post->ID;?>" class="bonus__button">
				<?php echo __('Play now', 'websitelangid');?>
				</a><?php }?>
				<a class="bonus__button review" href="<?php echo $casino_permalink;?>"><?php echo __('Read Review', 'websitelangid');?></a>
		</div>
		</li>
	
<?php }?>