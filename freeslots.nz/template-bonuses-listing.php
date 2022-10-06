<?php
						
						$listing_slot_id_original = apply_filters('wpml_object_id', get_the_ID(), 'bonuses', true, 'en');
			?>
							<?php
							$bonus_claim_link = get_field('bonus_claim_link');
							$bonuses_types = wp_get_post_terms(get_the_ID(), 'bonuses_types');
							$bonus_promo_code = get_field('bonus_promo_code');
							$bonus_not_awarded = get_field('bonus_not_awarded');
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
						<span class="text__your-bonys"><?php echo __('Your bonus', 'websitelangid');?></span>
						<p class="text__title-bonus">
							<span class="text__prise-bonus"><?php if($bonus_prise){echo $bonus_prise;}else{echo '';}?></span>
							<?php if($bonus_description){echo $bonus_description;}else{echo '-';}?>
						</p>
						</div>
					</div>
					<a href="<?php if($bonus_claim_link){echo $bonus_claim_link;}else{echo '-';}?> " class="bonus__button">
						<svg class="bonus__button-svg">
						<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Vector-1"></use>
						</svg>
						<span class="bonus__button-text">Play now</span>
					</a>
			  </div>
            </li>