						<?php
						$listing_table_game_id_original = apply_filters('wpml_object_id', get_the_ID(), 'table_games', true, 'en');
						?>
						<li>
							<a href="<?php the_permalink();?>">
								<?php if(get_the_post_thumbnail()){the_post_thumbnail('medium', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="221" height="221" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?>
								<div class="table-game-listing-rating"><?php echo do_shortcode('[gdrts_stars_rating disable_rating="true" type="posts.table_games" id="'.$listing_table_game_id_original.'"]');?></div>
								<div class="table-game-listing-title"><strong><?php the_title();?></strong></div>
								<div class="table-game-listing-overlay"><span><?php echo __('Play for Free', 'websitelangid');?></span></div>
							</a>
							<div class="table-game-listing-favorite"><?php the_favorites_button();?></div>
						</li>