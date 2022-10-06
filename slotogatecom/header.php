<?php
if($_GET['type'] != '' and $_GET['go_to_id'] != ''){
	if($_GET['type'] == 'casino_page'){
		wp_redirect(rtrim(home_url(), '/').'/go/?redirect_type=casino_page&redirect_go_to_id='.$_GET['go_to_id']);
		exit;
	}elseif($_GET['type'] == 'slot_page'){
		wp_redirect(rtrim(home_url(), '/').'/go/?redirect_type=slot_page&redirect_go_to_id='.$_GET['go_to_id']);
		exit;
	}elseif($_GET['type'] == 'table_game_page'){
		wp_redirect(rtrim(home_url(), '/').'/go/?redirect_type=table_game_page&redirect_go_to_id='.$_GET['go_to_id']);
		exit;
	}elseif($_GET['type'] == 'bonus_page'){
		wp_redirect(rtrim(home_url(), '/').'/go/?redirect_type=bonus_page&redirect_go_to_id='.$_GET['go_to_id']);
		exit;
	}
}
if($_GET['redirect_type'] != '' and $_GET['redirect_go_to_id'] != ''){
	if($_GET['redirect_type'] == 'casino_page'){
		$get_redirection_link = get_field('casino_website_link', $_GET['redirect_go_to_id']);
	}elseif($_GET['redirect_type'] == 'slot_page'){
		$get_redirection_link = get_field('slot_real_money_link', $_GET['redirect_go_to_id']);
	}elseif($_GET['redirect_type'] == 'table_game_page'){
		$get_redirection_link = get_field('table_game_real_money_link', $_GET['redirect_go_to_id']);
	}elseif($_GET['redirect_type'] == 'bonus_page'){
		$get_redirection_link = get_field('bonus_claim_link', $_GET['redirect_go_to_id']);
	}else{
		$get_redirection_link = null;
	}
	
	if($get_redirection_link){
		header("Location: ".$get_redirection_link);
		die;
	}
}
?>
<!DOCTYPE html>
<html lang="<?php echo ICL_LANGUAGE_CODE;?>">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-TQ738P9');</script>
<!-- End Google Tag Manager -->
<title><?php wp_title('');?></title>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<!--[if lt IE 9]><script src="<?php bloginfo('template_url');?>/js/html5shiv.js"></script><![endif]-->
<?php wp_head();?>
<meta name='dmca-site-verification' content='MnltMlRUR2dJOEkrNW5tQkhIWE5LUT090' />
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TQ738P9" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div class="top-line-responsive float"></div>
	<div class="top-line float">
		<div class="align">
			<div class="top-line-wrapper">
				<div class="site-responsive-menu">
					<div id="ToggleResponsiveMenuOverlay" class="website-overlay"></div>
					<button id="ToggleResponsiveMenu"><img class="site-responsive-menu-open" width="24" height="24" src="<?php bloginfo('template_url');?>/images/icons/menu-icon.svg" alt="Menu Icon" loading="lazy"/><img class="site-responsive-menu-close" width="24" height="24" src="<?php bloginfo('template_url');?>/images/icons/close-menu-icon.svg" alt="Close Menu Icon" loading="lazy"/></button>
				</div>
				<div class="site-id">
					<a href="<?php bloginfo('url');?>">
						<img width="40" height="40" src="<?php bloginfo('template_url');?>/images/logo.svg" alt="<?php bloginfo('title');?>" loading="lazy"/>
						<div class="site-header">
							<div class="site-name"><?php bloginfo('title');?></div>
							<div class="site-desc"><?php bloginfo('description');?></div>
						</div>
					</a>
				</div>
				<div class="site-search">
					<?php if(!is_front_page()){echo do_shortcode('[wd_asp id=1]');}?>
				</div>
				<div class="site-cta">
					<nav>
						<ul>
							<?php $favorites_page_link = get_field('favorites_page_link', 'option'); if($favorites_page_link){?><li><a href="<?php echo $favorites_page_link;?>" rel="nofollow"><img width="16" height="16" src="<?php bloginfo('template_url');?>/images/icons/heart-icon.svg" alt="Heart Icon" loading="lazy"/><span><?php echo __('My favorites', 'websitelangid');?></span></a></li><?php }?>
							<?php $bonus_offers_link = get_field('bonus_offers_link', 'option'); if($bonus_offers_link){?><li><a href="<?php echo $bonus_offers_link;?>" rel="nofollow" target="_blank"><img width="16" height="16" src="<?php bloginfo('template_url');?>/images/icons/bonus-icon.svg" alt="Bonus Icon" loading="lazy"/><span><?php echo __('Claim bonus', 'websitelangid');?></span></a></li><?php }?>
						</ul>
					</nav>
				</div>
				<div class="site-lang">
					<nav>
						<?php do_action('wpml_add_language_selector');?>
					</nav>
<script>
jQuery('.top-line .site-lang nav div > ul > li > a .wpml-ls-native').text('<?php echo ICL_LANGUAGE_CODE;?>');
</script>
				</div>
				<div class="site-account">
					<nav>
						<ul>
							<?php if(is_user_logged_in()){?>
								<li><a href="<?php the_field('account_page_link', 'option');?>" rel="nofollow"><img width="16" height="16" src="<?php bloginfo('template_url');?>/images/icons/user-icon.svg" alt="User Icon" loading="lazy"/><span><?php echo __('My profile', 'websitelangid');?></span></a></li>
							<?php }else{?>
								<li><a href="<?php the_field('register_page_link', 'option');?>" rel="nofollow"><img width="16" height="16" src="<?php bloginfo('template_url');?>/images/icons/user-icon.svg" alt="User Icon" loading="lazy"/><span><?php echo __('Sign in', 'websitelangid');?></span></a></li>
							<?php }?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="nav-line <?php if(is_front_page()){echo 'no-search-header';}?> float">
		<div class="align">
			<nav>
				<?php wp_nav_menu(array('theme_location'=>'main_menu'));?>
			</nav>
		</div>
	</div>
<script>
jQuery('#ToggleResponsiveMenu').click(function(){
	jQuery('body').toggleClass('overflowhidden');
	jQuery('#ToggleResponsiveMenu').toggleClass('active');
	jQuery('#ToggleResponsiveMenuOverlay').fadeToggle(300);
	jQuery('.top-line .site-search').fadeToggle(300);
	jQuery('.nav-line').fadeToggle(300);
});
</script>
	<?php if(!is_front_page()){if(function_exists('yoast_breadcrumb')){?>
	<div class="breadcrumbs-line float">
		<div class="align">
			<nav>
				<?php yoast_breadcrumb('<p id="breadcrumbs">','</p>');?>
			</nav>
		</div>
	</div>
	<?php }}?>
	<main class="float">