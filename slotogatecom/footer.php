		<?php $subscription_form_heading = get_field('subscription_form_heading', 'option'); if($subscription_form_heading){?>
		<div class="content-zone global-subscribption-line float">
			<div class="global-subscribption-line-noise">
				<div class="align">
					<aside>
						<header>
							<h5><?php echo $subscription_form_heading;?></h5>
						</header>
						<?php the_field('subscription_form_desc', 'option');?>
						<?php $subscription_form_shortcode = get_field('subscription_form_shortcode', 'option'); if($subscription_form_shortcode){echo do_shortcode($subscription_form_shortcode);}?>
					</aside>
				</div>
			</div>
		</div>
		<?php }?>
	</main>
	<footer class="footer-line float">
		<div class="footer-mainbox float">
			<div class="align">
				<div class="footer-wrapper">
					<div class="footer-meta">
						<div class="site-id">
							<a href="<?php bloginfo('url');?>">
								<img width="40" height="40" src="<?php bloginfo('template_url');?>/images/logo.svg" alt="<?php bloginfo('title');?>" loading="lazy"/>
								<div class="site-header">
									<div class="site-name"><?php bloginfo('title');?></div>
									<div class="site-desc"><?php bloginfo('description');?></div>
								</div>
							</a>
						</div>
						<?php if(have_rows('socials', 'option')):?>
						<ul class="socials">
							<?php while(have_rows('socials', 'option')):the_row();?>
							<li><a class="<?php the_sub_field('link_css');?>" href="<?php the_sub_field('link_url');?>" rel="nofollow noopener noreferrer" target="_blank" title="<?php the_sub_field('link_title');?>"><?php the_sub_field('link_icon');?></a></li>
							<?php endwhile;?>
						</ul>
						<?php endif;?>
						<div class="dmca-badge-wrapper">
							<a href="//www.dmca.com/Protection/Status.aspx?ID=9b152e77-9b6b-4950-9059-3bd6976a08f7" title="<?php echo __('DMCA.com Protection Status', 'websitelangid');?>" class="dmca-badge" rel="nofollow noopener noreferrer" target="_blank"><img width="100" height="20" src ="https://images.dmca.com/Badges/dmca-badge-w100-5x1-08.png?ID=9b152e77-9b6b-4950-9059-3bd6976a08f7" alt="<?php echo __('DMCA.com Protection Status', 'websitelangid');?>" loading="lazy"/></a>
							<script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"></script>
						</div>
						<div class="copyrights"><p>2021-<?php echo wp_date('Y');?> © <?php echo __('All Rights Reserved', 'websitelangid');?> | <a href="<?php bloginfo('url');?>"><?php bloginfo('title');?></a></p></div>
					</div>
					<?php if(is_active_sidebar('footer')){?>
					<div class="footer-widgets">
						<div class="footer-widgets-wrapper">
							<?php dynamic_sidebar('footer');?>
						</div>
					</div>
					<?php }?>
				</div>
			</div>
		</div>
		<div class="footer-bottom float">
			<div class="align">
				<?php if(has_nav_menu('footer_menu')){?>
				<nav>
					<?php wp_nav_menu(array('theme_location'=>'footer_menu', 'depth'=>1));?>
				</nav>
				<?php }?>
				<aside>
					<ul>
						<li><img width="22" height="22" src="<?php bloginfo('template_url');?>/images/footer-18-icon.png" alt="<?php echo __('Age Restriction', 'websitelangid');?>" loading="lazy"/></li>
						<li><a href="https://ecogra.org" rel="nofollow noopener noreferrer" target="_blank" title="eCogra"><img width="73" height="22" src="<?php bloginfo('template_url');?>/images/footer-ecogra-icon.png" alt="eCogra" loading="lazy"/></a></li>
						<li><a href="https://www.gamcare.org.uk" rel="nofollow noopener noreferrer" target="_blank" title="GamCare"><img width="76" height="22" src="<?php bloginfo('template_url');?>/images/footer-gamcare-icon.png" alt="GamCare" loading="lazy"/></a></li>
						<li><a href="https://www.begambleaware.org" rel="nofollow noopener noreferrer" target="_blank" title="BeGambleAware"><img width="230" height="22" src="<?php bloginfo('template_url');?>/images/footer-begambleaware-icon.png" alt="BeGambleAware" loading="lazy"/></a></li>
					</ul>
				</aside>
			</div>
		</div>
	</footer>
<?php if(is_singular(array('slots', 'table_games'))){$report_problem_form_shortcode = get_field('report_problem_form_shortcode', 'option'); if($report_problem_form_shortcode){?><div id="ReportProblem" class="fancybox-hide"><?php echo do_shortcode($report_problem_form_shortcode);?></div><?php }}?>
<?php wp_footer();?>
<script>var acc = document.getElementsByClassName("accordion"); var i; for(i = 0; i < acc.length; i++){acc[i].onclick = function(){this.classList.toggle("active"); var panel = this.nextElementSibling; if(panel.style.display === "block"){panel.style.display = "none";}else{panel.style.display = "block";}}}</script>
</body>
</html>