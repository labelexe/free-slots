<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */

get_header(); // This fxn gets the header.php file and renders it ?>
	    


       <div class="container">
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


		
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>