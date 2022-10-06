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
		$slots_availables = wp_get_post_terms($slot_id, 'slots_availables');
		$slot_real_money_link = get_field('slot_real_money_link');
		$report_problem_form_shortcode = get_field('report_problem_form_shortcode', 'option');
		$slot_background_image = get_field('slot_background_image');
		$slot_iframe_url = get_field('slot_iframe_url');
		$slot_reels = get_field('slot_reels');
		$slot_paylines = get_field('slot_paylines');
		$slot_rtp = get_field('slot_rtp');
		$slot_volatility = get_field('slot_volatility');
		$slot_min_bet = get_field('slot_min_bet');
		$slot_max_bet = get_field('slot_max_bet');
		$slot_max_win = get_field('slot_max_win');
    $release_date = get_field('release_date');
		$last_update = get_field('last_update');
		$slots_return_to_player = get_field('slots_return_to_player');
		$slot_popularity = get_field('slot_popularity');
		$ways_to_win = get_field('ways_to_win');
		
		/*SET PAGE VIEW*/
		wpb_set_post_views($slot_id);
		?>
	<main>
      <section class="gates container">
        <div class="gates__container">
          <div class="gates__rating">
            <h2 class="gates__title"><?php the_title(); ?></h2>
            <div>
              <div class="gates__votes">
                <div class="slot-rating">
                  <?php do_shortcode('[gdrts_stars_rating]')?>
                  <div class="slot-rating-stars"><?php echo do_shortcode('[gdrts_stars_rating type="posts.slots" id="'.$slot_id_original.'"]');?></div>
                </div>
              </div>
            </div>
          </div>
          <div class="video" style="background-image:url(<?php if($slot_background_image){echo $slot_background_image;}else{echo get_bloginfo('template_url').'/assets/img/slot-bg.jpg';}?>); ">
            <div class="video__background">
            <?php if($slot_iframe_url){?>
              <button id="LoadUpFrameButton"  class="video__link">
              <svg class="bonus__button-svg">
                <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Vector-1"></use>
              </svg>
              <span class="bonus__button-text"><?php the_field('buttons_play_now', 'option'); ?></span>
            </button>
              <div id="FrameWrapping"></div>
              <?php }?>
            </div>
          </div>
        </div>
        
      <div class="play">
        <div class="play__container container">
          <h2 class="play__title">
          <?php the_field('bonuses_title', 'option');?> <span><?php echo __('bonus', 'websitelangid');?></span>
            <bonus></bonus>
          </h2>
          <?php $latest_slots = get_posts(array('suppress_filters'=>false, 'numberposts'=>10, 'post_type'=>'bonuses')); if($latest_slots){?>
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
                      src=" <?php if($bonus_image){echo $bonus_image;}else{echo get_bloginfo('template_url').'/assets/img/placeholder-bonus.png';};?> "
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
                        <span class="text__your-bonys"><?php the_field('archive_bonuses_content', 'option'); ?></span>
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
          <a href="#" class="bonus__link"> <?php echo __('Show', 'websitelangid');?></a>
        </div>
      </div>
    </section>
    <section class="game-information">
      <div class="container">
        <h2 class="game-information__title"><?php the_title(); ?></h2>
        <p class="game-information-text"> <?php the_field('archive_slots_content', 'option'); ?></p>
        <div class="game-information-box">
          <div class="box__information">
		  <?php the_post_thumbnail(
                        array(100, 100),
                        array(
                        'class' => "information__img",
                        
                        ) 
                        ); ?>
            <!-- <img src="<?php bloginfo( 'template_url' ); ?> /assets/img/olimpus.png" alt="" class="information__img"> -->
            <h3 class="information__title">
              <svg class="information__svg">
                <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-slot-machine-1"></use>
              </svg>
              <?php the_field('slots_game_information', 'option'); ?>
              
            </h3>
            
            <ul class="information__list">
            <?php if($slots_features){?>
              <?php foreach($slots_features as $slots_feature){?>
            <li class="information__item">
							
                <p class="information_item-text"><?php the_field('tax_icon', 'slots_features_'.$slots_feature->term_id); echo $slots_feature->name;?></p>
                <?php if($slots_features){?>
                  <div class="information_item-iner active">
                  <svg>
                    <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Vector-ok"></use>
                  </svg>
                </div>
                  <?php }else{?>
                    <div class="information_item-iner close">
                  <svg>
                    <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-close"></use>
                  </svg>
                </div>
                 <?php }?> 
              </li>
              <?php }?>
						<?php }?>
              <li class="information__item">
                <p class="information_item-text"><?php the_field('slot_max_win', 'option'); ?>
                  
                </p>
                <div class="information_item-iner"> 
                  <p><?php if($slot_max_win){echo $slot_max_win;}else{echo '-';}?></p>
                </div>
              </li>
              <li class="information__item">
                <p class="information_item-text"><?php the_field('slot_min_bet', 'option'); ?>
                  
                </p>
                <div class="information_item-iner"> 
                  <p><?php if($slot_min_bet){echo $slot_min_bet;}else{echo '-';}?>
                </div>
              </li>
              <li class="information__item">
                <p class="information_item-text"><?php the_field('slots_max_bet', 'option'); ?>
                  
                </p>
                <div class="information_item-iner"> 
                  <p><?php if($slot_max_bet){echo $slot_max_bet;}else{echo '-';}?></p>
                </div>
              </li>
              <li class="information__item">
                <p class="information_item-text"><?php the_field('slots_release_date', 'option'); ?> </p>
                <div class="information_item-iner"> 
                  <p><?php if($release_date){echo $release_date;}else{echo '-';}?></p>
                  
                </div>
              </li>
              <li class="information__item">
                <p class="information_item-text"><?php the_field('slots_last_update', 'option'); ?></p>
                <div class="information_item-iner"> 
                <p><?php if($last_update){echo $last_update;}else{echo '-';}?></p>
                </div>
              </li>
            </ul>
          </div>
          <div class="box__data">
            <ul class="data__list">
              <li class="data__item">
                <p class="data__item-title"><?php the_field('archive_slots_return', 'option'); ?> </p>
                <p class="data__item-text">
                  <svg>
                    <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-bask"></use>
                  </svg>
                  
                  <?php if($slots_return_to_player){?><?php echo $slots_return_to_player?><?php }else{echo '-';}?>
                </p>
              </li>
              <li class="data__item">
                <p class="data__item-title"><?php the_field('slots_game_type', 'option'); ?> </p>
                <p class="data__item-text">
                  <svg>
                    <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Component-mashine"></use>
                  </svg>
                  <?php if($slots_types){$slots_types_count = 1; foreach($slots_types as $slots_type){if($slots_types_count > 1){echo ', ';} echo $slots_type->name; $slots_types_count++;}}else{echo '-';}?>
                </p>
              </li>
              <li class="data__item">
                <p class="data__item-title"><?php the_field('slots_popularity', 'option'); ?> </p>
                <p class="data__item-text">
                  <svg>
                    <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-star"></use>
                  </svg>
                  <?php if($slot_popularity){?><?php echo $slot_popularity?><?php }else{echo '-';}?>
                </p>
              </li>
              <li class="data__item">
                <p class="data__item-title"><?php the_field('slots_game_provider', 'option'); ?> </p>
                <p class="data__item-text">
                  <svg>
                    <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-gear"></use>
                  </svg>
                  <?php if($slots_providers){?> <?php echo $slots_providers[0]->name;?> <?php }else{echo '-';}?>
                </p>
              </li>
              <li class="data__item">
                <p class="data__item-title"><?php the_field('slots_available_on', 'option'); ?> </p>
                <p class="data__item-text">
                  <svg>
                    <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Component-2-5"></use>
                  </svg>
                  <?php if($slots_availables){$slots_availables_count = 1; foreach($slots_availables as $slots_theme){if($slots_availables_count > 1){echo ', ';} echo $slots_theme->name; $slots_availables_count++;}}else{echo '-';}?>
                </p>
              </li>
              <li class="data__item">
                <p class="data__item-title"><?php the_field('slots_winlines', 'option'); ?> </p>
                <p class="data__item-text">
                  <svg>
                    <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-cup"></use>
                  </svg>
                  <?php if($ways_to_win){?><?php echo $ways_to_win?><?php }else{echo '-';}?>
                </p>
              </li>
            </ul>
            <p class="data__provider">
              <svg>
                <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-gear"></use>
              </svg>
              <?php the_field('slots_about_game_provider', 'option'); ?> 
            </p>
            <div class="data__item pragmatic">
            <?php if($slots_providers){?>
              <div class="pragmatic__img"><?php $slots_providers_tax_image = get_field('tax_image', 'slots_providers_'.$slots_providers[0]->term_id); if($slots_providers_tax_image){echo '<div class="pragmatic__img">'.wp_get_attachment_image($slots_providers_tax_image, 'full', false, array('alt'=>$slots_providers[0]->name)).'</div>';}else{echo '<div class="pragmatic__img"><img  src="'.get_bloginfo('template_url').'/assets/img/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/></div>';}?></div>
              <?php }?>
              <!-- <img src="<?php bloginfo( 'template_url' ); ?> /assets/img/PRAGMATIC.webp" alt="" class="pragmatic__img"> -->
              <h3 class="pragmatic__title"><?php if($slots_providers){?><?php echo $slots_providers[0]->name;?><?php }else{echo '-';}?></h3>
              <a href="<?php echo get_term_link($slots_providers[0]->term_id);?>" class="pragmatic__link"><?php the_field('slots_real_money_casinos', 'option'); ?>
                <svg>
                  <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-chevron-double-right"></use>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>

    </section>
      <section class="info">
        <div class="container">
        <?php if(have_posts()):?>
         <div class="info__post">
          <div>
          
                <?php while(have_posts()):the_post();?>
                <?php
                if(get_the_content()){
                  the_content();
                }else{
                  if($slots_types){
                    echo vsprintf(__('<h1>%s Slot</h1><p>%s slot is an online %s slot created by %s.  It needs you to build up a winning combination to enjoy multiple gameplay features and generous bonuses.</p> <p>%s offers a solid gambling experience for free and for real money. With an RTP of %s, it demonstrates a high winning potential. The slot is available on various %s devices. To give it a try, you need to register at a gambling site, load the game, and press the “Spin” button.</p>', 'websitelangid'), array($slot_title, $slot_title, $slots_types[0]->name, $slots_providers[0]->name, $slot_title, $slots_return_to_player,  $slots_availables[0]->name));
                  }?>
               <?php }


                ?>
                <?php endwhile;?>
                
          </div>
      
         <div class="info__images-container slots">
           <div class="info__img info__img-1"></div>
           <div class="info__img info__img-2"></div>
           <div class="info__img info__img-3"></div>
         </div>
         <?php endif;?>
        </div>
      </section>
      <section class="more-games">
        <div class="more-games_container">
          <div class="more-games__inner">
            <h2 class="inner__title">
              <svg>
              <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Component-mashine"></use>
            </svg>
            <?php the_field('slots_top_slots_providers', 'option'); ?> 
            </h2>
            <div class="inner__games">
              <?php the_sub_field('best_providers_desc');?>
              <?php $best_slots_providers = get_terms(array('taxonomy'=>'slots_providers', 'hide_empty'=>true, 'orderby'=>'gdrts', 'order'=>'DESC', 'number'=>5)); if($best_slots_providers){?>
              <ul class="games__list">
                <?php foreach($best_slots_providers as $best_slots_provider){?>
                <li class="games__item" >
                  <a href="<?php echo get_term_link($best_slots_provider->term_id);?>">
                    <?php $best_slots_provider_image = get_field('tax_image', 'slots_providers_'.$best_slots_provider->term_id); if($best_slots_provider_image){echo '<div class="games__item">'.wp_get_attachment_image($best_slots_provider_image, 'full', false, array('alt'=>$best_slots_provider->name)).'<div class="games__item-hover">
                          <a href="'.get_term_link($best_slots_provider->term_id).'" class="item-hover-link">
                            <span class="bonus__button-text">'.__('Play now', 'websitelangid').'</span>
                          </a>
                        </div>';}else{echo '<div class="games__item"><img class="attachment-full size-full games__item-img" src="'.get_bloginfo('template_url').'/assets/img/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/><div class="games__item-hover">
                          <a href="'.get_term_link($best_slots_provider->term_id).'" class="item-hover-link">
                            <span class="bonus__button-text">'.__('Play now', 'websitelangid').'</span>
                          </a>
                        </div>';}?>
                    <div class="games__item-title"><strong><?php echo $best_slots_provider->name;?><br><span class="games__item-subtitle"><?php echo $best_slots_provider->count;?> <?php echo __('games', 'websitelangid');?></span></strong></div>
                  </a>
                </li>
                <?php }?>
              </ul>
              <?php }?>
              <?php $best_providers_link = get_sub_field('best_providers_link'); if($best_providers_link){?>
                <a  href="<?php echo $best_providers_link;?>"><?php echo __('All Providers Collection', 'websitelangid');?></a>
              <?php }?>

            </div>
            <?php $best_providers_link = get_sub_field('best_providers_link'); if($best_providers_link){?>
                <a class="more-games__link" href="<?php echo $best_providers_link;?>"><?php echo __('All Providers Collection', 'websitelangid');?></a>
              <?php }?>
          </div>
          <div class="more-games__popular">
          <?php $popular_slots = get_posts(array('suppress_filters'=>false, 'numberposts'=>5, 'post_type'=>'slots', 'meta_key'=>'wpb_post_views_count', 'orderby'=>'meta_value_num', 'order'=>'DESC', 'exclude'=>$slot_id)); if($popular_slots){?>
					<aside class="pupular__game">
            <h2 class="popular__title">
              <svg>
                <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-star"></use>
              </svg> 
              <?php the_field('slots_popular_slots', 'option'); ?>
            </h2>
						<ul class="pupular games__list">
							<?php foreach($popular_slots as $post){setup_postdata($post);?>
                <li class="games__item" id="<?php get_the_ID(); ?>" >
              <div class="games__item-container">
              <?php if(get_the_post_thumbnail()){the_post_thumbnail(array(100, 100),
                array(
                'class' => "games__item-img",
                ), array('alt'=>get_the_title()));}
                else{echo '<img class="games__item-img games__item-placeholder" src="'.get_bloginfo('template_url').'/assets/img/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>  
                <div class="games__item-hover">
                  <a href="<?php the_permalink(); ?>" class="item-hover-link">
                    <svg class="bonus__button-svg">
                      <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Vector-1"></use>
                    </svg>
                    <span class="bonus__button-text"><?php the_field('buttons_play_now', 'option'); ?></span>
                  </a>
                </div>
              </div>
                <h3 class="games__item-title"><?php the_title(); ?></h3>
                <p class="games__item-subtitle">by <?php $slots_providers = wp_get_post_terms(get_the_ID(), 'slots_providers'); if($slots_providers){echo $slots_providers[0]->name;}else{echo '-';}?></p>

                
              </li>
							<?php } wp_reset_postdata();?>
						</ul>
              <a  class="more-games__link" href="<?php the_field('buttons_url_show_more_games', 'option'); ?>"><?php the_field('buttons__show_more_games', 'option'); ?></a>
					</aside>
					<?php }?>   
        </div>
      </section>
      <section class="faq">
      
        <div class="container" >
        
					<div id="slot-faq" class="slot-faq">
						<h2 class="faq__title"><?php echo sprintf(__('%s Slot FAQ', 'websitelangid'), get_the_title());?></h2>
						<?php if(have_rows('slot_faq')):?>
						<ul>
            <?php while(have_rows('slot_faq')):the_row();?>
              <li class="faq__text" itemscope itemtype="https://schema.org/FAQPage">
                <div class="faq__question"    itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                  <p itemprop="name"><?php the_sub_field('question');?></p>
                  <div class="faq__svg">
                    <svg class="faq__svg-plus">
                      <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-plus"></use>
                    </svg>
                    <svg class="faq__svg-minus"> 
                      <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-minus"></use>
                    </svg>
                  </div>
                </div>
                <div class="faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <div itemprop="text"><p><?php the_sub_field('answer');?></p></div>
                </div>
              </li>
 
						<?php endwhile;?>
					<?php else :

  echo vsprintf(__('<li class="faq__text" itemscope itemtype="https://schema.org/FAQPage">
  <div class="faq__question"    itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <p itemprop="name">Is %s slot compatible with mobile devices?</p>
    <div class="faq__svg">
      <svg class="faq__svg-plus" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0Z" fill="white"/>
      </svg>
      <svg class="faq__svg-minus" viewBox="0 0 14 2" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M13.125 0H7.875H0.875C0.642936 0 0.420376 0.0921874 0.256282 0.256282C0.0921874 0.420376 0 0.642936 0 0.875C0 1.10706 0.0921874 1.32962 0.256282 1.49372C0.420376 1.65781 0.642936 1.75 0.875 1.75H7.875H13.125C13.3571 1.75 13.5796 1.65781 13.7437 1.49372C13.9078 1.32962 14 1.10706 14 0.875C14 0.642936 13.9078 0.420376 13.7437 0.256282C13.5796 0.0921874 13.3571 0 13.125 0Z" fill="white"/>
      </svg>
    </div>
  </div>
  <div class="faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
  <div itemprop="text"><p>Yes, it is. The given %s slot is perfectly compatible with Android and iOS devices.</p></div>
  </div>
  </li>
  <li class="faq__text" itemscope itemtype="https://schema.org/FAQPage">
  <div class="faq__question"    itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <p itemprop="name">Is %s slot available for free?</p>
    <div class="faq__svg">
      <svg class="faq__svg-plus" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0Z" fill="white"/>
      </svg>
      <svg class="faq__svg-minus" viewBox="0 0 14 2" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M13.125 0H7.875H0.875C0.642936 0 0.420376 0.0921874 0.256282 0.256282C0.0921874 0.420376 0 0.642936 0 0.875C0 1.10706 0.0921874 1.32962 0.256282 1.49372C0.420376 1.65781 0.642936 1.75 0.875 1.75H7.875H13.125C13.3571 1.75 13.5796 1.65781 13.7437 1.49372C13.9078 1.32962 14 1.10706 14 0.875C14 0.642936 13.9078 0.420376 13.7437 0.256282C13.5796 0.0921874 13.3571 0 13.125 0Z" fill="white"/>
      </svg>
    </div>
  </div>
  <div class="faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
  <div itemprop="text"><p>Yes, it is. Some casinos offer %s slot in demo mode. Players are allowed to start the gameplay without depositing any money.</p></div>
  </div>
  </li>
  <li class="faq__text" itemscope itemtype="https://schema.org/FAQPage">
  <div class="faq__question"    itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
    <p itemprop="name">Where can you play %s slot?</p>
    <div class="faq__svg">
      <svg class="faq__svg-plus" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0Z" fill="white"/>
      </svg>
      <svg class="faq__svg-minus" viewBox="0 0 14 2" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M13.125 0H7.875H0.875C0.642936 0 0.420376 0.0921874 0.256282 0.256282C0.0921874 0.420376 0 0.642936 0 0.875C0 1.10706 0.0921874 1.32962 0.256282 1.49372C0.420376 1.65781 0.642936 1.75 0.875 1.75H7.875H13.125C13.3571 1.75 13.5796 1.65781 13.7437 1.49372C13.9078 1.32962 14 1.10706 14 0.875C14 0.642936 13.9078 0.420376 13.7437 0.256282C13.5796 0.0921874 13.3571 0 13.125 0Z" fill="white"/>
      </svg>
    </div>
  </div>
  <div class="faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
  <div itemprop="text"><p>Many gambling sites have %s slot in their collection. Make sure to check it out before joining.</p></div>
  </div>
  </li>', 'websitelangid'), array($slot_title, $slots_types[0]->name, $slot_title,   $slot_title, $slot_title, $slot_title));

        endif; ?>
         </ul>
					</div>
        </div>
      </section>   
    </main>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
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
<?php get_footer();?>