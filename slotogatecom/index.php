<?php get_header();?>
		<div class="content-zone float">
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
<?php get_footer();?>