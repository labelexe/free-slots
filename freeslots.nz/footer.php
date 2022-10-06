<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to finish 
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>

<!-- </main>/ end page container, begun in the header -->
</main>
<footer class="footer">
      <div class="container">
        <div class="footer__container">
        <a href="<?php bloginfo('url');?>" class="logo footer__logo" >
          <span>FREE</span>SLOTS.NZ
        </a>

        <?php if(has_nav_menu('footer_menu')){?>
					<?php wp_nav_menu(array('theme_location'=>'footer_menu', 'depth'=>1));?>
        <?php }?>

        <img
          src="<?php bloginfo( 'template_url' ); ?>/assets/img/sponsors.png"
          alt="sponsors"
          class="footer__sponsors"
        />
      </div>
    </footer>
    <div class="preloader">
      <!-- <svg
        class="preloader__image"
        role="img"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
      >
        <path
          fill="#FFFFFF"
          d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"
        ></path>
      </svg> -->
      <div>
        <svg class="ap" viewBox="0 0 128 256" width="128px" height="256px" xmlns="http://www.w3.org/2000/svg">
          <defs>
            <linearGradient id="ap-grad1" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="hsl(223,90%,55%)" />
              <stop offset="100%" stop-color="hsl(253,90%,55%)" />
            </linearGradient>
            <linearGradient id="ap-grad2" x1="0" y1="0" x2="0" y2="1">
              <stop offset="0%" stop-color="hsl(193,90%,55%)" />
              <stop offset="50%" stop-color="hsl(223,90%,55%)" />
              <stop offset="100%" stop-color="hsl(253,90%,55%)" />
            </linearGradient>
          </defs>
          <circle class="ap__ring" r="56" cx="64" cy="192" fill="none" stroke="#ddd" stroke-width="16" stroke-linecap="round" />
          <circle class="ap__worm1" r="56" cx="64" cy="192" fill="none" stroke="url(#ap-grad1)" stroke-width="16" stroke-linecap="round" stroke-dasharray="87.96 263.89" />
          <path class="ap__worm2" d="M120,192A56,56,0,0,1,8,192C8,161.07,16,8,64,8S120,161.07,120,192Z" fill="none" stroke="url(#ap-grad2)" stroke-width="16" stroke-linecap="round" stroke-dasharray="87.96 494" />
        </svg>
      </div>
    </div>
    <div class="back2top">
      <svg class=" material-icons">
        <use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-Icon"></use>
      </svg> 
    </div>
    <!-- <script type="text/javascript" src="./js/index.js"></script> -->
	    <?php $slot_id = get_the_ID();
		$slot_id_original = apply_filters('wpml_object_id', $slot_id, 'slots', true, 'en');
		$slots_providers = wp_get_post_terms($slot_id, 'slots_providers');
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$term = get_queried_object();

if( strpos($_SERVER['REQUEST_URI'], '/providers/') !== FALSE) {
	echo '<script>$(".wpml-ls-link").attr("href", "https://free-slots.co.za/providers/'. $term->slug .'");</script>';
	}elseif( strpos($_SERVER['REQUEST_URI'], '/slots/') !== FALSE) {
    echo '<script>$(".wpml-ls-link").attr("href", "https://free-slots.co.za/slots/'. get_page_uri( $page ).'");</script>';
	}else{
	echo '<script>$(".wpml-ls-link").attr("href", "https://free-slots.co.za/'. get_page_uri( $page ).'");</script>';
}

?>

<?php 
if( strpos($_SERVER['REQUEST_URI'], '/providers/') !== FALSE) {
    echo '<script>$(".js-wpml-ls-item-toggle").attr("href", "'. get_term_link($slots_providers[0]->term_id)  .'");</script>';
	}elseif( strpos($_SERVER['REQUEST_URI'], '/slots/') !== FALSE) {
	echo '<script>$(".js-wpml-ls-item-toggle").attr("href", "https://freeslots.nz/slots/'. get_page_uri( $page ).'");</script>';
	}else{
	echo '<script>$(".js-wpml-ls-item-toggle").attr("href", "'.get_page_link( $page  ).'");</script>';
} ?>
<?php if(current_user_can('administrator')){?>
<aside class="bpc-banner-popup-blue">
	<a class="bpc-banner-close" href="#"><img width="18" height="18" src="<?php bloginfo('template_url');?>/banners-content/close.svg" alt="Close Iocn"/></a>
	<div class="bpc-banner-popup-cols">
		<div class="bpc-banner-popup-content">
			<p><?php echo __('May vary based on your location', 'websitelangid');?></p>
			<header>
				<h5><?php echo __('Subscribe to Get <span>100% Bonus + 100 No Deposit Spins</span>', 'websitelangid');?></h5>
			</header>
			<footer>
				<p><?php echo __('By subscribing I confirm that I have read and agreed to the <a href="#" rel="nofollow" target="_blank">terms and conditions</a>.', 'websitelangid');?></p>
			</footer>
		</div>
		<div class="bpc-banner-popup-form">
			<form>
				<div class="bpc-form-cols">
					<div class="bpc-form-col-70">
						<input type="email" placeholder="Enter your email to get free spins"/>
					</div>
					<div class="bpc-form-col-30">
						<input type="submit" value="Sign Up!"/>
					</div>
					<div class="bpc-form-col-100">
						<label><input type="checkbox"><span class="wpcf7-list-item-label">I am at least 18 years old and legally allowed to play in a casino</span></label>
					</div>
				</div>
			</form>
			<?php //echo do_shortcode('[contact-form-7 id="86503" title="Subscription Banner Popup Form"]');?>
		</div>
	</div>
</aside>
<style>
body .bpc-banner-popup-blue{box-sizing:border-box;position:fixed;width:1166px;bottom:0;left:50%;margin-left:-583px;z-index:99999;background:url(<?php bloginfo('template_url');?>/banners-content/banner-blue-bg.png)center center no-repeat #1B2055;background-size:cover;border-radius:20px 20px 0px 0px;border:1px solid #FEC401;border-bottom:none;padding:20px 48px 20px 211px;}
body .bpc-banner-popup-blue > *{box-sizing:border-box;}
body .bpc-banner-popup-blue:before{content:"";display:block;position:absolute;left:-5px;top:-26px;width:206px;height:169px;background:url(<?php bloginfo('template_url');?>/banners-content/featured-image-seven.png)center center no-repeat;background-size:contain;}
body .bpc-banner-popup-blue .bpc-banner-close{display:block;width:18px;height:18px;position:absolute;right:20px;top:20px;text-decoration:none;}
body .bpc-banner-popup-blue .bpc-banner-close img{display:block;width:18px;height:18px;margin:0 auto;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols{display:flex;flex-wrap:wrap;align-items:center;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content{width:calc(100% - 456px);padding-right:20px;border-right:1px solid rgba(240,238,196,0.2);}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content > p{color:#D9DBF9;font-size:12px;line-height:1.5;margin-bottom:5px;font-family:'Arial';}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content h5{color:#fff;text-transform:uppercase;font-size:22px;line-height:1.2;margin-bottom:10px;font-weight:bold;font-family:'Arial';}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content h5 > *{line-height:1.2;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content h5 > span{line-height:1.2;color:#FFD25F;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content footer p{color:#D9DBF9;font-size:11px;margin-bottom:0;line-height:1.5;font-family:'Arial';}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content footer p a{display:inline;color:#5F6DFF;text-decoration:underline;transition:0.5s;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content footer p a:hover{text-decoration:none;color:#fff;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form{width:436px;margin-left:20px;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form{margin-bottom:0;color:#fff;font-size:13px;font-family:'Arial';line-height:1.5;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form .bpc-form-cols{display:flex;flex-wrap:wrap;margin:0 -5px;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form .bpc-form-cols > div{width:calc(100% - 10px);margin:0 5px;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form .bpc-form-cols .bpc-form-col-70{width:calc(70% - 10px);margin:0 5px 10px;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form .bpc-form-cols .bpc-form-col-30{width:calc(30% - 10px);margin:0 5px 10px;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form input[type="email"], body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form input[type="text"]{display:block;width:100%;max-width:100%;padding:13px 16px;line-height:22px;font-size:15px!important;font-family:'Arial';border-radius:8px;border:none;outline:none;color:#686868;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form input[type="submit"]{display:block;width:100%;max-width:100%;background:#3D4DED;color:#fff;font-weight:bold;font-size:15px!important;font-family:'Arial';line-height:22px;padding:11px 0;margin-top:-2px;border-radius:8px;border:4px solid rgba(61,77,237,0.4);transition:0.5s;outline:none;cursor:pointer;background-clip:padding-box;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form input[type="submit"]:hover, body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form input[type="submit"]:focus{background:#fff;color:#3D4DED;border-color:rgba(255,255,255,0.1);background-clip:padding-box;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form label{display:block;font-size:13px;color:#D9DBF9;font-family:'Arial';cursor:pointer;line-height:15px;position:relative;padding-left:19px;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form label > *{vertical-align:top;line-height:15px;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form label span{display:inline-block;vertical-align:top;line-height:15px;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form label input[type="checkbox"]{position:absolute;left:0;top:0;background:url(<?php bloginfo('template_url');?>/banners-content/checbox-blue.svg)center -50px no-repeat #fff;background-size:14px;width:15px;height:15px;padding:0;border:1px solid #9A9A9A;border-radius:2px;transition:0.5s;cursor:pointer;-webkit-appearance:none;-moz-appearance:none;appearance:none;outline:none;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form label input[type="checkbox"]:focus{border-color:#5F6DFF;}
body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form label input[type="checkbox"]:hover, body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form label input[type="checkbox"]:checked{background:url(<?php bloginfo('template_url');?>/banners-content/checbox-blue.svg)center center no-repeat #fff;border-color:#5F6DFF;}
@media screen and (max-width:1200px){
	body .bpc-banner-popup-blue{left:0;right:0;width:auto;margin-left:0;border-radius:0px;border-left:none;border-right:none;}
}
@media screen and (max-width:1090px){
	body .bpc-banner-popup-blue{padding:20px 48px 20px 20px;}
	body .bpc-banner-popup-blue:before{display:none;}
}
@media screen and (max-width:910px){
	body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content h5{font-size:18px;}
}
@media screen and (max-width:790px){
	body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content{width:100%;padding-right:0;border-right:none;margin-bottom:5px;}
	body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form{width:100%;margin-left:0;}
}
@media screen and (max-width:490px){
	body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content{order:2;margin:5px 0 0;}
	body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content > p{display:none;}
	body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-content h5{display:none;}
}
@media screen and (max-width:440px){
	body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form .bpc-form-cols .bpc-form-col-70, body .bpc-banner-popup-blue .bpc-banner-popup-cols .bpc-banner-popup-form form .bpc-form-cols .bpc-form-col-30{width:calc(100% - 10px);}
}
</style>
<script>
function createCookie(name, value, days){
	var expires;
	if(days){
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		expires = "; expires=" + date.toGMTString();
	}else{
		expires = "";
	}
	document.cookie = encodeURIComponent(name) + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function readCookie(name){
	var nameEQ = encodeURIComponent(name) + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++){
		var c = ca[i];
		while(c.charAt(0) === ' ') c = c.substring(1, c.length);
		if(c.indexOf(nameEQ) === 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
	}
	return null;
}

jQuery(function(jQuery){
	var ck = readCookie("bpc-banner-popup-blue");
	if(!(ck == 1)){
		jQuery('.bpc-banner-popup-blue').fadeIn(400);
		jQuery('.bpc-banner-close').on('click', function(e){
			event.preventDefault();
			createCookie('bpc-banner-popup-blue', '1', '1'); /*1 Day Cookie*/
			jQuery('.bpc-banner-popup-blue').fadeOut(400);
		});
	}
});
</script>
<?php }?>
<?php wp_footer();?>

</body>
</html>

