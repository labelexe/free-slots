<?php get_header();?>
<style type="text/css">
  body{font-size: 12px; height: 100%;}
  img {max-width: 100%;}
  /* footer {position: fixed; width: 100%; bottom: 0;  left: 50%; transform: translate(-50%)} */
  #fof{display:block; width:100%;  line-height:1.6em; text-align:center; margin: 5% auto;}
  #fof h1{font-size:5em; text-transform:uppercase;}
  #fof img{ margin: 25px auto;}
  #fof p{display:block; margin:0 0 25px 0; padding:0; font-size:16px;}
  #fof #respond input{width:200px; padding:5px; border:1px solid #CCCCCC;}
  #fof #respond #submit{width:auto;}
  #fof a {color: #333; font-weight: 700;text-decoration: none;}
  #fof a:hover {color: #999}
</style>
<div class="wrapper row2">
  <div id="container" class="clear">
    <section id="fof" class="clear">
    <h1><?php echo __('WHOOPS!', 'websitelangid');?></h1>
      <img src="<?php bloginfo( 'template_url' ); ?>/assets/img/404.png" alt="404">
      <p><?php echo __('The requested URL', 'websitelangid');?> <b><?php echo $_SERVER["REQUEST_URI"]; ?></b><?php echo __(' was not found on this server.!', 'websitelangid');?></p>
      <p> <?php echo __('Go back to the!', 'websitelangid');?> <a href="javascript:history.go(-1)"><?php echo __('previous page!', 'websitelangid');?></a> <?php echo __('or visit our', 'websitelangid');?> <a href="/"><?php echo __('homepage!', 'websitelangid');?></a></p>

    </section>
  </div>
</div>
<?php get_footer();?>