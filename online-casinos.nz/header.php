<?php
if($_GET['type'] != '' and $_GET['go_to_id'] != ''){
	if($_GET['type'] == 'casino_page'){
		wp_redirect(rtrim(home_url(), '/').'/go/?redirect_type=casino_page&redirect_go_to_id='.$_GET['go_to_id']);
		exit;
	}elseif($_GET['type'] == 'bonus_page'){
		wp_redirect(rtrim(home_url(), '/').'/go/?redirect_type=bonus_page&redirect_go_to_id='.$_GET['go_to_id']);
		exit;
	}
}
if($_GET['redirect_type'] != '' and $_GET['redirect_go_to_id'] != ''){
	if($_GET['redirect_type'] == 'bonus_page'){
		$get_redirection_link = get_field('bonus_claim_link', $_GET['redirect_go_to_id']);
	}elseif($_GET['redirect_type'] == 'casino_page'){
		$get_redirection_link = get_field('casino_website_link', $_GET['redirect_go_to_id']);
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
<html lang="en-NZ">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<meta name="viewport" content="width=device-width" />
<?php

$casino_id = get_the_ID();
$meta_title_casinos = get_the_title();
$casino_established_date = get_field('casino_established_date');
$casino_id_original = apply_filters('wpml_object_id', get_the_ID(), 'casinos', true, 'en');
$casinos_types = wp_get_post_terms($casino_id, 'casinos_types', array('fields'=>'names'));
$casinos_types_meta = $casinos_types[0]->name;
if( strpos($_SERVER['REQUEST_URI'], '/casinos/') !== FALSE) {
    echo "<meta name='description' content='$meta_title_casinos Casino is an experienced $casinos_types_meta resource where players can play slot games and win real money. Founded in $casino_established_date, it has a solid gambling offer for all gamblers
' />";
    
}

?>

    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="<?php bloginfo( 'template_url' ); ?>/assets/img/favikon.png"
    />
    <?php wp_head();?>
  </head>
  <body>
    <header class="js-page-header">
     <div class="container">
      <nav >
        <a class="logo" href="<?php bloginfo('url');?>">
          <img class="logo" src="<?php bloginfo( 'template_url' ); ?>/assets/img/logo.png" alt="online-casinos.nz">
          <!-- <strong class="logo-text">CASINO-<span>ONLINE.PH</span></strong> -->
        </a>

        <div class="menu-container">
          <div id="nav__burger-menu" class="nav__burger-menu">
            <div class="burger-menu_button">
              <span class="burger-menu_lines"></span>
            </div>
          </div>
  
          <div class="burger-menu_nav">
            <div class="menu_nav-label">
              <?php echo do_shortcode('[wd_asp id=2]');?>
            </div>
            <ul>
            <li>
              <?php wp_nav_menu(array('theme_location'=>'main_menu'));?>
              </li>
              <li class="burger-menu_link providers">
                <div class="menu-item"
                  ><?php the_field('other_casino_text', 'option');?>
                  <svg class="burger-menu_link-svg">
                    <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Icon"></use>
                  </svg>
                </div>
                <div class="menu-link__subitem">
                  <ul class="menu-link__subitem-item">
                  <?php while(have_rows('other_casino', 'option')):the_row();?>
                    <li class="subitem__list">
                      <a href="<?php the_sub_field('casinos_link');?>" class="subitem__list-link"><?php the_sub_field('casinos_text');?></a>
                    </li>
                  <?php endwhile;?>
                 
                  </ul>
                </div>
              </li>
              </ul>
                </div>
          </div>
          <div id="language__menu" class="language__menu">

          <div class="language__menu-button">
						<?php do_action('wpml_add_language_selector');?>
          </div>
        </div>
      </nav>
     </div>
      
    </header>
    <?php if(!is_front_page()){if(function_exists('yoast_breadcrumb')){?>
	<div class="breadcrumbs-line float">
			<nav class="container">
				<?php yoast_breadcrumb('<p id="breadcrumbs">','</p>');?>
			</nav>
	</div>
	<?php }}?>