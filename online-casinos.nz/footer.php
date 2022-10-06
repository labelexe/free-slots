<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to finish 
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>

<!-- </main>/ end page container, begun in the header -->
      <section class="prefuter">
  <div class="container">
  <?php $subscription_form_heading = get_field('subscription_form_heading', 'option'); if($subscription_form_heading){?>

    <h2 class="prefuter__title"><?php echo $subscription_form_heading;?></h2>
    <div class="prefuter__subtitle"><?php the_field('subscription_form_desc', 'option');?></div>
    <div class="form-table">
    <?php $subscription_form_shortcode = get_field('subscription_form_shortcode', 'option'); if($subscription_form_shortcode){echo do_shortcode($subscription_form_shortcode);}?>
    </div>
      <?php the_field('subscription_form_captcha', 'option');?>
  </div>
  <?php }?>

</section>
<footer class="footer">
      <div class="container">
        <div class="footer__container">
          <img
          src="<?php bloginfo( 'template_url' ); ?>/assets/img/sponsors.png"
          alt="sponsors"
          class="footer__sponsors"
        />
          <div>
            <div class="footer__list">
               <?php if(has_nav_menu('footer_menu')){?>
                  <?php wp_nav_menu(array('theme_location'=>'footer_menu', 'depth'=>1));?>
                <?php }?>
            </div>
            <p class="license">2021-2022 Online-Casinos.nz</p>
          </div>
        </div>
        
      </div>
    </footer>
    <div class="preloader">
      <svg
        class="preloader__image"
        role="img"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
      >
        <path
          fill="#FFFFFF"
          d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"
        ></path>
      </svg>
    </div>
    <div id="back2top" class="back2top">
      <svg class=" material-icons">
        <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-plus"></use>
      </svg> 
    </div>
    <?php wp_footer();?>
  </body>
</html>
