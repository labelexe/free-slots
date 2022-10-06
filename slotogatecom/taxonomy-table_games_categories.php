<?php get_header();?>
<?php $queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;?>
<?php $term_id_original = apply_filters('wpml_object_id', $term_id, $taxonomy, true, 'en');?>
<?php
if(have_rows('flexible_blocks_top', $taxonomy.'_'.$term_id)):while(have_rows('flexible_blocks_top', $taxonomy.'_'.$term_id)):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
		<?php if(term_description()){?>
		<div class="content-zone float">
			<div class="align">
				<section>
					<div class="taxonomy-archive-intro">
						<div class="taxonomy-archive-content">
							<?php echo term_description();?>
						</div>
						<div class="taxonomy-archive-image">
							<?php $tax_image = get_field('tax_image', $taxonomy.'_'.$term_id); if($tax_image){echo wp_get_attachment_image($tax_image, 'full');}else{echo '<img width="395" height="325" src="'.get_bloginfo('template_url').'/images/tax-image-placeholder.png" alt="'.__('Casino', 'websitelangid').'"/>';}?>
						</div>
					</div>
				</section>
			</div>
		</div>
		<?php }?>
		<?php if(have_posts()):?>
		<div class="content-zone archive-listings float">
			<div class="align">
				<section>
					<header>
						<div class="archive-listings-date"><mark><?php echo __('Updated on', 'websitelangid');?> <?php echo wp_date('F, Y');?></mark></div>
						<h1><?php single_term_title();?></h1>
						<p><?php echo __('Please Rate Our Table Games Collection', 'websitelangid');?></p>
						<?php echo do_shortcode('[gdrts_stars_rating type="terms.table_games_categories" id="'.$term_id_original.'"]');?>
					</header>
					<ul class="table-games-listing">
						<?php while(have_posts()):the_post();?>
						<?php get_template_part('template', 'table-games-listing');?>
						<?php endwhile;?>
					</ul>
					<?php wp_pagenavi();?>
				</section>
			</div>
		</div>
		<?php endif;?>
<?php
if(have_rows('flexible_blocks_bottom', $taxonomy.'_'.$term_id)):while(have_rows('flexible_blocks_bottom', $taxonomy.'_'.$term_id)):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
<?php get_footer();?>