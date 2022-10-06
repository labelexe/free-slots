						<?php
						$listing_slot_id_original = apply_filters('wpml_object_id', get_the_ID(), 'slots', true, 'en');
						?>
						<li>
							<a href="<?php the_permalink();?>">
								<?php if(get_the_post_thumbnail()){the_post_thumbnail('medium', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="221" height="221" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>
								<div class="slot-listing-rating"><?php echo do_shortcode('[gdrts_stars_rating disable_rating="true" type="posts.slots" id="'.$listing_slot_id_original.'"]');?></div>
								<div class="slot-listing-title"><strong><?php the_title();?></strong></div>
								<div class="slot-listing-provider"><?php $slots_providers = wp_get_post_terms(get_the_ID(), 'slots_providers'); if($slots_providers){echo $slots_providers[0]->name;}else{echo '-';}?></div>
								<div class="slot-listing-overlay"><span><?php echo __('Play for Free', 'websitelangid');?></span></div>
							</a>
							<div class="slot-listing-favorite"><?php the_favorites_button();?></div>
						</li>