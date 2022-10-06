<?php get_header();?>
		<div class="content-zone blog-line float">
			<div class="align">
				<section>
					<header>
						<h1><?php single_cat_title();?></h1>
					</header>
					<?php echo category_description();?>
					<?php if(have_posts()):?>
					<div class="news-posts">
						<?php while(have_posts()):the_post();?>
						<article>
							<?php if(get_the_post_thumbnail()){?><a class="blog-post-thumb" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_post_thumbnail('large', array('alt'=>get_the_title()));?></a><?php }?>
							<header>
								<p><time datetime="<?php the_time('Y-m-d');?>"><?php the_time('d M Y');?></time></p>
								<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
							</header>
							<?php the_excerpt();?>
						</article>
						<?php endwhile;?>
					</div>
					<?php wp_pagenavi();?>
					<?php endif;?>
				</section>
			</div>
		</div>
<?php get_footer();?>