<?php get_header();?>
<?php
if(have_rows('flexible_blocks_top')):while(have_rows('flexible_blocks_top')):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
		<?php if(get_the_content()){?>
		<div class="content-zone styled-section float">
			<div class="align">
				<section>
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