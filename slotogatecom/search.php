<?php get_header();?>
		<div class="content-zone float">
			<div class="align small-align">
				<section>
					<header>
						<h1><?php echo __('Search', 'websitelangid');?>: <?php echo get_search_query();?></h1>
					</header>
					<?php if(have_posts()):?>
					<div class="search-results">
						<?php while(have_posts()):the_post();?>
						<article>
							<a class="search-thumbnail" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php if(get_the_post_thumbnail()){the_post_thumbnail('thumbnail', array('alt'=>get_the_title()));}else{echo '<img class="wp-post-image" width="150" height="150" src="'.get_bloginfo('template_url').'/images/placeholder.png" alt="'.__('Image Placeholder', 'websitelangid').'"/>';}?></a>
							<header>
								<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
							</header>
						</article>
						<?php endwhile;?>
					</div>
					<?php wp_pagenavi();?>
					<?php else:?>
						<p><?php echo __('Nothing found', 'websitelangid');?>.</p>
					<?php endif;?>
				</section>
			</div>
		</div>
<?php get_footer();?>