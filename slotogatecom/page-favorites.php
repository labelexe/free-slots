<?php get_header();?>
<?php
if(have_rows('flexible_blocks_top')):while(have_rows('flexible_blocks_top')):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
		<?php if(get_the_content()){?>
		<div class="content-zone float">
			<div class="align">
				<section>
					<?php if(have_posts()):?>
					<?php while(have_posts()):the_post();?>
					<?php the_content();?>
					<?php endwhile;?>
					<?php endif;?>
					<?php if(is_user_logged_in()){?>
						<h3 class="accordion active"><i class="fas fa-angle-down"></i><?php echo __('Favorite Casinos', 'websitelangid');?></h3>
						<div class="panel" style="display:block;">
							<?php echo do_shortcode('[user_favorites post_types="casinos" include_buttons="true" include_thumbnails="true" thumbnail_size="thumbnail"]');?>
						</div>
						<h3 class="accordion active"><i class="fas fa-angle-down"></i><?php echo __('Favorite Slots', 'websitelangid');?></h3>
						<div class="panel" style="display:block;">
							<?php echo do_shortcode('[user_favorites post_types="slots" include_buttons="true" include_thumbnails="true" thumbnail_size="thumbnail"]');?>
						</div>
						<h3 class="accordion active"><i class="fas fa-angle-down"></i><?php echo __('Favorite Table Games', 'websitelangid');?></h3>
						<div class="panel" style="display:block;">
							<?php echo do_shortcode('[user_favorites post_types="table_games" include_buttons="true" include_thumbnails="true" thumbnail_size="thumbnail"]');?>
						</div>
					<?php }else{?>
						<p><?php echo __('Only registered users can add items to favorites, if you already have an account or want to register, please visit this link', 'websitelangid');?> - <a href="<?php the_field('register_page_link', 'option');?>" rel="nofollow"><?php echo __('Register/Login', 'websitelangid');?></a>.</p>
					<?php }?>
				</section>
			</div>
		</div>
		<?php }?>
<?php
if(have_rows('flexible_blocks_bottom')):while(have_rows('flexible_blocks_bottom')):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
<?php get_footer();?>