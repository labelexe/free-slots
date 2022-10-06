<?php
/*
Template Name: home

<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */
?>
<?php get_header(); // This fxn gets the header.php file and renders it ?>

<?php
		
		$slot_id = get_the_ID();
		$slot_title = get_the_title();
		$slot_real_money_link = get_field('slot_real_money_link');
		$report_problem_form_shortcode = get_field('report_problem_form_shortcode', 'option');
		$info_title = get_field('info_title');
		$info_text = get_field('info_text');
    $faqs = get_field('FAQ_home_pages');
		$kard_box = get_field('kard_box');
		$question = the_sub_field('question');
		$answer = get_field('answer');
    $bonus_image = get_field('bonus_images');
    $bonus_prise = get_field('bonus_prise');
    $bonus_description = get_field('bonus_description');
    $bonus_claim_link = get_field('bonus_claim_link');
    $slot_iframe_url = get_field('slot_iframe_url');
    $slot_iframe_url = get_field('slot_iframe_url');
    $hero_title = get_field('hero_title');
    $hero_text = get_field('hero_text');
    $hero_picture = get_field('hero_picture');
    $bonuses_title = get_field('bonuses_title');
		
		/*SET PAGE VIEW*/
		wpb_set_post_views($slot_id);

    $country_detect = do_shortcode('[useriploc type="country"]');
    if($country_detect){
      $country_detect_term = get_term_by('name', $country_detect, 'casinos_countries');
      if($country_detect_term){
        $country_detect_native_name = get_field('Flexible Blocks', 'casinos_countries_'.$country_detect_term->term_id);
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
<main>
      <section class="hero">
        <div class="hero__container container">
          <div>
         
          <h1 class="hero__title"><?php if($hero_title){echo $hero_title;}else{echo 'Welcome to Online-roulette!', 'websitelangid';}?></h1>
          <p class="hero__subtitle"><?php if($hero_text){echo $hero_text;}else{echo 'The best casino reviews and free slots!', 'websitelangid';}?></p>
          </div>
        </div>
      </section>
      <!-- <section class="filtration">
        <div class="container">
        <p class="filtration__subtitle"><?php echo __('Updated for', 'websitelangid');?> <?php the_date('M j', '', ''); ?></p>
            <h2 class="filtration__title"><?php echo sprintf(__('Our %s Casino Reviews and Ratings', 'websitelangid'), $country_native_name);?></h2>
          <div class="filter-infoblock">
							<p><span id="ItemsCount"></span>
              <span> 
           <?php $count_posts = wp_count_posts('casinos'); //указываем созданный вами тип записи - services
				$published_posts = $count_posts->publish; //количество только опубликованных записей
				echo $published_posts;?>
        </span>
    <?php echo __('casinos found for players', 'websitelangid');?><?php if($country_native_name){echo ' '.__('from', 'websitelangid').' '.do_shortcode('[useriploc type="flag" height="24px" width="24px"]').' '.$country_native_name;}?></p>
						</div>
          </section> -->
          <?php 
          if($country_detect){
						$country = array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect);
					}
					
					$args = array('post_type'=>'casinos', 'meta_key'=>$casinos_meta_key, 'orderby'=>$casinos_orderby, 'order'=>$casinos_order, 'paged'=>$paged, 'tax_query'=>array($deposit, $withdrawal, $type, $country));
					query_posts($args);
					$count_current_posts = $wp_query->found_posts;
          ?>
					<?php if(have_posts()):?>
            <section class="play">
            <div class="play__container container">
              <h2 class="play__title">
                
                <?php echo __('Best casinos', 'websitelangid');?>
              </h2>
                

                <?php $latest_slots = get_posts(array('suppress_filters'=>false, 'orderby'=>'rand', 'numberposts'=>10, 'post_type'=>'bonuses')); if($latest_slots){?>
            <ol class="play__list">
              <?php foreach($latest_slots as $key => $post){setup_postdata($post);?>
 
            			<?php global $country_detect;?>
						<?php $casino_bonuses_relationship = get_field('casino_bonuses_relationship'); if($casino_bonuses_relationship){?>
							<?php
							$casino_permalink = get_permalink($casino_bonuses_relationship[0]->ID);
							$casino_post_thumbnail = get_the_post_thumbnail($casino_bonuses_relationship[0]->ID, 'thumbnail', array(
                'class' => "play__logo-bonus best-casinos",
                ),  array('alt'=>$casino_bonuses_relationship[0]->post_title));
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
									<span class="play__item-number best-casinos"><?php echo $key+1; ?></span>
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
              <?php } wp_reset_postdata();?>
            </ol>
			<!-- <?php $casinos_post_type_link = get_post_type_archive_link('casinos'); if($casinos_post_type_link){?>
				<a  class="bonus__button" style="margin: 0 auto;" href="<?php echo $casinos_post_type_link; ?>"><?php the_field('buttons__show_more_games', 'option'); ?></a>
			<?php }?> -->
            <a  class="bonus__button" style="margin: 0 auto;" href="<?php the_field('casino_bonuse_link', 'option'); ?>"><?php the_field('buttons__show_more_games', 'option'); ?></a>
            <?php }?>
          

					<?php else:?>
					<p style="text-align:center;"><?php echo __('Nothing found', 'websitelangid');?>.</p>
					<?php endif;?>
        </div>
      </section>
      <section class="info home">
        <div class="container">
         <div>
          <h2 class="info__title">
          <?php if($info_title){echo $info_title;}else{echo '-';}?>
          </h2>
          <div class="info__text casino">
          <?php if($info_text){echo $info_text;}else{echo '-';}?>
          </div>
         </div>
<!--           <div class="info__images-container">
            <div class="info__img">
            </div>
          </div> -->
        </div>
      </section>
      <section class="faq">
      
      <div class="container" >
        <div class="slot-faq" itemscope itemtype="https://schema.org/FAQPage">
            <h2 class="faq__title"><?php echo sprintf(__('FAQ', 'websitelangid'), get_the_title());?></h2>
  <?php  $rows = $faqs;
      if($rows)
      {
           foreach($rows as $row){
            echo '
              <div class="faq__text" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
              <div class="faq__question accordion" ><h3 itemprop="name">' . $row['question'] . '</h3>
              <div class="faq__svg">
                  <svg class="faq__svg-plus" viewBox="0 0 23 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" stroke-width="0.9143" d="M12.901 25.292v-22.027c0-0.386-0.159-0.754-0.437-1.022s-0.65-0.415-1.036-0.415-0.758 0.147-1.036 0.415v0c-0.278 0.268-0.437 0.635-0.437 1.022v22.027l-5.617-5.418c-0.138-0.133-0.3-0.237-0.478-0.308s-0.367-0.107-0.559-0.107c-0.191 0-0.381 0.036-0.559 0.107s-0.34 0.175-0.478 0.308c-0.138 0.133-0.248 0.291-0.323 0.467v0c-0.075 0.176-0.115 0.365-0.115 0.556s0.039 0.38 0.115 0.556c0.075 0.176 0.186 0.334 0.323 0.467l8.125 7.836c0 0 0 0 0 0l0 0 0.317-0.329 2.192-4.134zM12.901 25.292l5.617-5.418c0.138-0.133 0.3-0.237 0.478-0.308s0.367-0.107 0.559-0.107c0.191 0 0.381 0.036 0.559 0.107s0.34 0.175 0.478 0.308c0.138 0.133 0.248 0.291 0.323 0.467s0.114 0.365 0.114 0.556-0.039 0.38-0.114 0.556c-0.075 0.176-0.186 0.334-0.323 0.467l-8.125 7.836c-0 0-0 0-0 0l-0 0 0.436-4.463z" fill="black"/>
                  </svg>
                </div></div>
              <div class="faq__answer panel"  itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <div itemprop="text">' . $row['answer'] .'</div>
              </div>
            </div>';
           }
  }?>
        </div>
      </div>
  </section>
      <section class="slider">
        <div class="container">

          
          <ul>
          <?php  $kards = $kard_box;
              if($kards)
              {
                  foreach($kards as $kard_box){
                    echo '
                      <li class="slider__cards">
                        <a rel="nofollow noopener noreferrer" target="_blank" href="' . $kard_box['kards_casino_link'] . '">
                        <div class="slider__cards-container-img">
                          <img src="' . $kard_box['kards_casino_img'] . '" alt="" class="slider__cards-img">
                        </div>
                        <h2 class="slider__cards-title">' . $kard_box['kards_casino_title'] .'</h2>
                        <p class="slider__cards-text">' . $kard_box['kards_casino_deskription'] .'</p>
                        <button class="slider__cards-buttons">' . $kard_box['kards_casino_button'] .'</button>
                        </a>
                      </li>';
                  }
          }?>
          </ul>
        </div>
      </section>
     
    </main>
     
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>