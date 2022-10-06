<?php get_header();?>
<?php
if(have_rows('flexible_blocks_top')):while(have_rows('flexible_blocks_top')):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
		<?php if(get_the_content()){?>
		<div class="content-zone float">
			<div class="align small-align">
				<section>
					<header>
						<h1><?php the_title();?></h1>
					</header>
					<?php the_post_thumbnail('large', array('alt'=>get_the_title()));?>
					<footer>
						<p><time datetime="<?php the_time('Y-m-d');?>"><?php the_time('d M Y');?></time></p>
					</footer>
					<?php if(have_posts()):?>
					<?php while(have_posts()):the_post();?>
					<?php the_content();?>
					<?php endwhile;?>
					<?php endif;?>
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