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
		$free_slots_title = get_field('free_slots_title');
		$free_slots_text = get_field('free_slots_text');
		$faqs = get_field('FAQ_home_pages');
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
		?>
      <section class="hero">
        <div class="hero__container container">
          <div class="hero__container-box">
            <div class="hero__img-cirkl"></div>
            <h2 class="hero__title"><?php if($hero_title){echo $hero_title;}else{echo 'Free Slots No Download', 'websitelangid';}?></h2>
            <p class="hero__text">
            <?php if($hero_text){echo $hero_text;}else{echo 'Welcome to the list of totally free slots with no download, no registration, no deposit required! Here we provide free spins bonus, bonus round games with stacked wild, 324 ways to win, features containing progressive jackpots, and super-profitable paytables. Instant play is available just for fun from mobile devices on iOS and Android!<br>
The collection of 1200+ best new and old popular free video slot machines with no money, no sign up needed. Win real money in classic, 3D free slot games instantly!', 'websitelangid';}?>
            </p>
            <a class="hero__link" href="<?php the_field('hero_link'); ?>"><?php the_field('buttons_explore_games', 'option'); ?></a>
          </div>
          <img class="hero__img" src="<?php echo $hero_picture;?>" alt="hero img" />
        </div>
      </section>
      <section class="games">
        <h2 class="games__title container"><?php echo __('New Free Slots', 'websitelangid');?></h2>
		<p class="info__text info__text-game container">
		<?php echo __('Try new free slot machine games without registration! The concept of free slots simply allows gamblers to play more of the best games and enjoy outstanding gaming experience.', 'websitelangid');?>
		
		</p>
        <p class="info__text container">
          <span><?php $count_posts = wp_count_posts('slots'); //указываем созданный вами тип записи - services
					$published_posts = $count_posts->publish; //количество только опубликованных записей
					echo $published_posts;?></span>
         <!-- <span> 
           <?php $count_posts = wp_count_posts('slots'); //указываем созданный вами тип записи - services
				$published_posts = $count_posts->publish; //количество только опубликованных записей
				echo $published_posts;?>
		</span> -->
          <?php the_field('slots_games_found', 'option'); ?> </p>

        <div class="container">

            <!-- <?php the_sub_field('latest_slots_desc');?> -->
            <?php $latest_slots = get_posts(array('suppress_filters'=>false, 'orderby'=>'rand', 'numberposts'=>15,  'post_type'=>'slots')); if($latest_slots){?>
            <ul class="games__list">
              <?php foreach($latest_slots as $post){setup_postdata($post);?>
              <?php get_template_part('template', 'slots-listing');?>
              <?php } wp_reset_postdata();?>
            </ul>
            <!-- <div class="games__pagination">
              <?php wp_pagenavi();?>
            </div> -->

            <?php }?>
         
			<div class="games_nav-container">
              
                <a  class="games__link" href="<?php the_field('buttons_url_show_more_games', 'option'); ?>"><?php the_field('buttons__show_more_games', 'option'); ?></a>
              </div>
        </div>
      </section>
      <section class="play">
        <div class="play__container container">
          <h2 class="play__title">
		  <?php the_field('bonuses_title', 'option');?>
             <span><?php echo __('bonus', 'websitelangid');?></span>
            <bonus></bonus>
          </h2>
          <?php $latest_slots = get_posts(array('suppress_filters'=>false, 'numberposts'=>10, 'post_type'=>'bonuses', 'orderby' => 'title',
'order' => 'ASC')); if($latest_slots){?>
            <ol class="play__list">
              <?php foreach($latest_slots as $key => $post){setup_postdata($post);?>
 
							<?php
              $listing_slot_id_original = apply_filters('wpml_object_id', get_the_ID(), 'bonuses', true, 'en');
							$bonus_promo_code = get_field('bonus_promo_code');
							$bonus_image = get_field('bonus_images');
							$bonus_prise = get_field('bonus_prise');
							$bonus_description = get_field('bonus_description');
							$bonus_claim_link = get_field('bonus_claim_link');
							?>
                <li class="play__item">
                  <div class="play__item-box">
                    <span class="play__item-number"><?php echo $key+1; ?></span>
                  <img
                      src=" <?php if($bonus_image){echo $bonus_image;}else{echo get_bloginfo('template_url').'/assets/img/placeholder.png';};?> "
                      alt="cosmo"
                      class="play__item-img"
                    />
                  
                  </div>
                  <div class="play__item-container">
                    <div class="play__item-bonus">
                      <img
                        src="<?php bloginfo( 'template_url' ); ?>/assets/img/Group.webp"
                        alt="Group"
                        class="item-bonus__img"
                      />
                      <div class="item-bonus__text">
                        <span class="text__your-bonys"><?php echo __('Your bonus', 'websitelangid');?></span>
                        <p class="text__title-bonus">
                          <span class="text__prise-bonus"><?php if($bonus_prise){echo $bonus_prise;}else{echo '';}?></span>
                          <?php if($bonus_description){echo $bonus_description;}else{echo '-';}?>
                        </p>
                      </div>
                    </div>
                    <a target="_blank" rel="nofollow" href="<?php if($bonus_claim_link){echo $bonus_claim_link;}else{echo '-';}?> " class="bonus__button">
                      <svg class="bonus__button-svg">
                        <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Vector-1"></use>
                      </svg>
                      <span class="bonus__button-text"><?php the_field('buttons_play_now', 'option'); ?></span>
                    </a>
                  </div>
                </li>
              <?php } wp_reset_postdata();?>
            </ol>
            <?php }?>
          
          <!-- <a href="#" class="bonus__link"> Show</a> -->
        </div>
      </section>	
      <section class="info">
        <div class="container info-container">
         <div>
          <?php if($free_slots_title){echo $free_slots_title;}else{echo '-';}?>
          <p class="info__text">
          <?php if($free_slots_text){echo $free_slots_text;}else{echo '-';}?>
          </p>
         </div>
         <div class="info__images-container">
           <div class="info__img info__img-1"></div>
           <div class="info__img info__img-2"></div>
           <div class="info__img info__img-3"></div>
           <div class="info__img info__img-4"></div>
         </div>
        </div>
      </section>
      <section class="faq">
      
        <div class="container" >
         <?php if(have_rows('FAQ_home_pages')):?>
					<div class="slot-faq" itemscope itemtype="https://schema.org/FAQPage">
          <h2 class="faq__title"><?php echo sprintf(__('FAQ', 'websitelangid'), get_the_title());?></h2>
						<?php while(have_rows('FAQ_home_pages')):the_row();?>
						<div class="faq__text" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
							<h3 class="faq__question" class="accordion"><span itemprop="name"><?php the_sub_field('question');?></span>
              <div class="faq__svg">
                    <svg class="faq__svg-plus" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0Z" fill="white"/>
                    </svg>
                    <svg class="faq__svg-minus" viewBox="0 0 14 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M13.125 0H7.875H0.875C0.642936 0 0.420376 0.0921874 0.256282 0.256282C0.0921874 0.420376 0 0.642936 0 0.875C0 1.10706 0.0921874 1.32962 0.256282 1.49372C0.420376 1.65781 0.642936 1.75 0.875 1.75H7.875H13.125C13.3571 1.75 13.5796 1.65781 13.7437 1.49372C13.9078 1.32962 14 1.10706 14 0.875C14 0.642936 13.9078 0.420376 13.7437 0.256282C13.5796 0.0921874 13.3571 0 13.125 0Z" fill="white"/>
                    </svg>
                  </div></h3>
							<div class="faq__answer" class="panel" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
								<div itemprop="text"><?php the_sub_field('answer');?></div>
							</div>
						</div>
						<?php endwhile;?>
					</div>
					<?php endif;?>
        </div>
      </section>   
     
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>