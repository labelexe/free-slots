<?php wp_safe_redirect(set_url_scheme(get_site_url()), 301); exit;?>
<?php get_header();?>
		<div class="content-zone float">
			<div class="align">
				<section>
					<header>
						<h1><?php the_title();?></h1>
					</header>
					<?php if(have_posts()):?>
					<?php while(have_posts()):the_post();?>
						<?php the_content();?>
						<p><?php echo __('Claim Link', 'websitelangid');?>: <?php the_field('bonus_claim_link');?></p>
						<p><?php echo __('Promo Code', 'websitelangid');?>: <?php the_field('bonus_promo_code');?></p>
						<p><?php echo __('Description', 'websitelangid');?>: <?php the_field('bonus_description');?></p>
						<?php if(have_rows('bonus_country_descriptions')):?>
						<ul>
							<?php while(have_rows('bonus_country_descriptions')):the_row();?>
							<li><?php echo __('Country', 'websitelangid');?>: <?php $bonus_country_select = get_sub_field('bonus_country_select'); echo $bonus_country_select->name;?>;<br><?php echo __('Description', 'websitelangid');?>: <?php the_sub_field('bonus_country_description');?>;</li>
							<?php endwhile;?>
						</ul>
						<?php endif;?>
					<?php endwhile;?>
					<?php endif;?>
				</section>
			</div>
		</div>
<?php get_footer();?>