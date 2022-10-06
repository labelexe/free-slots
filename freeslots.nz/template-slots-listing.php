				<?php
						$listing_slot_id_original = apply_filters('wpml_object_id', get_the_ID(), 'slots', true, 'en');
						?>
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
                    <span class="bonus__button-text">Play now</span>
                  </a>
                </div>
              </div>
                <h3 class="games__item-title"><?php the_title(); ?></h3>
                <p class="games__item-subtitle"><?php the_field('by_slots_translate', 'option') ?> <?php $slots_providers = wp_get_post_terms(get_the_ID(), 'slots_providers'); if($slots_providers){echo $slots_providers[0]->name;}else{echo '-';}?></p>

                
              </li>