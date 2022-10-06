<?php
/**
 * Template Name: free-slots-no-download
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */

get_header(); // This fxn gets the header.php file and renders it ?>
	    


        <section>

		
        <div class="container">
          <h1 class="hero__title"><?php the_field('archive_casinos_features_heading') ?></h1>
		<div style="margin-bottom: 40px;" class="hero__text"><?php the_field('archive_casinos_features_desc') ?></div>
        <form class="filter-form slots-filter" method="post">
						<div class="filter-selects">
							<div class="filter-selects-wrapper filter-selects-4-cols">
								<div>
									<p>
										<label><?php the_field('filters_order_by', 'option'); ?>:</label>
										<select class="swipe__link" name="orderby">
										<?php echo $orderby = isset($_POST['orderby']) ? $_POST['orderby'] : false; ?>
											<option value="date" <?php if($orderby == 'date' or $orderby == ''){echo 'selected="selected"';}?>><?php the_field('filters_new_to_old', 'option'); ?></option>
											<option value="title-asc" <?php if($orderby == 'title-asc'){echo 'selected="selected"';}?>><?php the_field('filters_a_to_z', 'option'); ?></option>
											<option value="title-desc" <?php if($orderby == 'title-desc'){echo 'selected="selected"';}?>><?php the_field('filters_z_to_a', 'option'); ?></option>
											<option value="popular" <?php if($orderby == 'popular'){echo 'selected="selected"';}?>><?php the_field('filters_most_popular', 'option'); ?></option>
											<option value="rating" <?php if($orderby == 'rating'){echo 'selected="selected"';}?>><?php the_field('filters_best_rating', 'option'); ?></option>
										</select>
									</p>
								</div>
								<?php $slots_providers = get_terms(array('taxonomy'=>'slots_providers')); if($slots_providers){?>
								<div>
									<p>
										<label><?php the_field('filters_all_providers', 'option'); ?>:</label>
										<select class="swipe__link" name="provider">
										<?php $provider = isset($_POST['provider']) ? $_POST['provider'] : false; ?>
											<option value="" <?php if($provider == '' or $provider == 0){echo 'selected="selected"';}?>><?php echo __('All ', 'websitelangid');?><?php the_field('filters_all_providers', 'option'); ?></option>
											<?php foreach($slots_providers as $slots_provider){echo '<option value="'.$slots_provider->term_id.'"'; if($provider == $slots_provider->term_id){echo 'selected="selected"';} echo '>'.$slots_provider->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
								<?php $slots_themes = get_terms(array('taxonomy'=>'slots_themes')); if($slots_themes){?>
								<div>
									<p>
										<label><?php the_field('filters_all_themes', 'option'); ?>:</label>
										<select class="swipe__link" name="theme">
											<?php $theme = isset($_POST['theme']) ? $_POST['theme'] : false; ?>
											<option value="" <?php if($theme == '' or $theme == 0){echo 'selected="selected"';}?>><?php echo __('All ', 'websitelangid');?><?php the_field('filters_all_themes', 'option'); ?></option>
											<?php foreach($slots_themes as $slots_theme){echo '<option value="'.$slots_theme->term_id.'"'; if($theme == $slots_theme->term_id){echo 'selected="selected"';} echo '>'.$slots_theme->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
								<?php $slots_features = get_terms(array('taxonomy'=>'slots_features')); if($slots_features){?>
								<div>
									<p>
										<label><?php the_field('filters_all_features', 'option'); ?>:</label>
										<select class="swipe__link" name="feature">
										<?php $feature = isset($_POST['feature']) ? $_POST['feature'] : false; ?>
											<option value="" <?php if($feature == '' or $feature == 0){echo 'selected="selected"';}?>><?php echo __('All ', 'websitelangid');?><?php the_field('filters_all_features', 'option'); ?></option>
											<?php foreach($slots_features as $slots_feature){echo '<option value="'.$slots_feature->term_id.'"'; if($feature == $slots_feature->term_id){echo 'selected="selected"';} echo '>'.$slots_feature->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
							</div>
						</div>
						<div class="filter-buttons">
							<div class="filter-buttons-wrapper filter-buttons-2-cols">
								<div>
									<p>
										<input class="video__link" type="submit" value="<?php the_field('filters_filter_slots', 'option'); ?>"/>
									</p>
								</div>
								<div>
									<p>
										<button class="video__link clear-btn"  type="button"><?php the_field('filters_clear_filter', 'option'); ?></button>
									</p>
								</div>
							</div>
						</div>
					</form>
					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged'):1;
					/*ODER*/
					$orderby = $orderby;
					if($orderby == 'date'){
						$slots_orderby = 'date';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}elseif($orderby == 'title-asc'){
						$slots_orderby = 'title';
						$slots_order = 'ASC';
						$slots_meta_key = '';
					}elseif($orderby == 'title-desc'){
						$slots_orderby = 'title';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}elseif($orderby == 'popular'){
						$slots_orderby = 'meta_value_num';
						$slots_order = 'DESC';
						$slots_meta_key = 'wpb_post_views_count';
					}elseif($orderby == 'rating'){
						$slots_orderby = 'gdrts';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}else{
						$slots_orderby = 'date';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}
					
					/*PROVIDER*/
					if($provider != '' or $provider != 0){
						$slots_provider = array('taxonomy'=>'slots_providers', 'field'=>'id', 'terms'=>array($provider));
					}
					 
					/*THEME*/
					if($theme != '' or $theme != 0){
						$slots_theme = array('taxonomy'=>'slots_themes', 'field'=>'id', 'terms'=>array($theme));
					}
					
					/*FEATURE*/
					if($feature != '' or $feature != 0){
						$slots_feature = array('taxonomy'=>'slots_features', 'field'=>'id', 'terms'=>array($feature));
					}
					
					$args = array('post_type'=>'slots', 'meta_key'=>$slots_meta_key, 'orderby'=>$slots_orderby, 'order'=>$slots_order, 'paged'=>$paged, 'tax_query'=>array($slots_provider, $slots_theme, $slots_feature ));
					query_posts($args);
					?>
					<?php if(have_posts()):?>
					<ul class="games__list">
						<?php while(have_posts()):the_post();?>
						<?php get_template_part('template', 'slots-listing');?>
						<?php endwhile;?>
					</ul>
					<div class="games__pagination">
					<?php wp_pagenavi();?>
					</div>


					<?php endif;?>
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
          <div class="align">
			  <?php
					wp_reset_query(); // necessary to reset query
					while ( have_posts() ) : the_post();
						the_content();
					endwhile; // End of the loop.
				?>
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
		<?php if(have_rows('archive_casinos_faq', 'option')):?>
			<div class="slot-faq" itemscope itemtype="https://schema.org/FAQPage">
			<h2 class="faq__title"><?php the_field('archive_casinos_faq_heading', 'option');?></h2>
				<?php while(have_rows('archive_casinos_faq', 'option')):the_row();?>
				<div class="faq__text" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
				<h3 class="faq__question" class="accordion"><span itemprop="name"><?php the_sub_field('question');?></span>
					<div class="faq__svg">
						<svg class="faq__svg-plus">
							<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-plus"></use>
						</svg>
						<svg class="faq__svg-minus"> 
							<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-minus"></use>
						</svg>
					</div>
				</h3>
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