<?php
/*
Template Name: Casino Bonuses

<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */
?>
<?php get_header();?>
<?php
$country_detect = do_shortcode('[useriploc type="country"]');
if($country_detect){
	$country_detect_term = get_term_by('name', $country_detect, 'casinos_countries');
	if($country_detect_term){
		$country_detect_native_name = get_field('country_native_name', 'casinos_countries_'.$country_detect_term->term_id);
		if($country_detect_native_name){
			$country_native_name = $country_detect_native_name;
		}else{
			$country_native_name = $country_detect;
		}
	}else{
		$country_native_name = $country_detect;
	}
}else{
	$country_native_name = '';
}?>
<section  class="filtration arhive">
        <div class="container">
            <!-- <p class="filtration__subtitle"><?php echo __('Updated for', 'websitelangid');?> <?php the_date('M j', '', ''); ?></p> -->
            <h2 class="filtration__title"><?php echo sprintf(__('Our %s Bonuses Reviews and Ratings', 'websitelangid'), $country_native_name);?></h2>
            <div class="filtration__container">
			<div class="filter-infoblock">
				<p><span id="ItemsCount">
				<?php $count_posts = wp_count_posts('casinos'); //указываем созданный вами тип записи - services
					$published_posts = $count_posts->publish; //количество только опубликованных записей
					echo $published_posts;?>
				</span>
    		<?php echo __('Bonuses found for players from', 'websitelangid');?><?php if($country_native_name){echo ' '.__('from', 'websitelangid').' '.do_shortcode('[useriploc type="flag" height="24px" width="24px"]').' '.$country_native_name;}?></p>
			</div>
					<?php
					if(is_paged()){
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							$_SESSION['type'] = $_POST['type'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_type = $_SESSION['type'];
						}else{
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_type = $_SESSION['type'];
						}
					}else{
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							$_SESSION['type'] = $_POST['type'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_type = $_SESSION['type'];
						}else{
							$_SESSION['orderby'] = '';
							$_SESSION['type'] = '';
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_type = $_SESSION['type'];
						}
					}
					?>
				
					<form id="ToggleFiltersContent" class="filter-form bonuses-filter filter-form-active" method="post">
						<div class="filter-selects">
							<div class="filter-selects-wrapper filter-selects-2-cols">
								<div>
									<p>
										<label><?php echo __('Order By', 'websitelangid');?>:</label>
										<select name="orderby">
											<option value="rand" <?php if($FilterSessionSave_orderby == 'rand' or $FilterSessionSave_orderby == ''){echo 'selected="selected"';}?>><?php echo __('Popular', 'websitelangid');?></option>
											<option value="date-desc" <?php if($FilterSessionSave_orderby == 'date-desc'){echo 'selected="selected"';}?>><?php echo __('New to Old', 'websitelangid');?></option>
											<option value="date-asc" <?php if($FilterSessionSave_orderby == 'date-asc'){echo 'selected="selected"';}?>><?php echo __('Old to New', 'websitelangid');?></option>
										</select>
									</p>
								</div>
								<?php $bonuses_types = get_terms(array('taxonomy'=>'bonuses_types')); if($bonuses_types){?>
								<div>
									<p>
										<label><?php echo __('Bonus Type', 'websitelangid');?>:</label>
										<select name="type">
											<option value="" <?php if($FilterSessionSave_type == '' or $FilterSessionSave_type == 0){echo 'selected="selected"';}?>><?php echo __('All Types', 'websitelangid');?></option>
											<?php foreach($bonuses_types as $bonuses_type){echo '<option value="'.$bonuses_type->term_id.'"'; if($FilterSessionSave_type == $bonuses_type->term_id){echo 'selected="selected"';} echo '>'.$bonuses_type->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
							</div>
						</div>
						<div class="filter-buttons">
						<div class="filter-buttons-wrapper best-casinos filter-buttons-2-cols">
						<div>
							<p>
							<input class="bonus__button" type="submit" value="<?php echo __('Filter Casinos', 'websitelangid');?>">
							</p>
						</div>
						<div>
							<p>
							<button class="bonus__button review clear-btn" type="button"><?php echo __('Clear Filter', 'websitelangid');?></button>
							</p>
						</div>
						</div>
					</div>
					</form>
					</div>
      </section>
<script>
jQuery(function(){
	jQuery(".clear-btn").click(function(){
		jQuery('select[name="orderby"]', '.bonuses-filter').val('rand').prop('selected', false);
		jQuery('select[name="type"]', '.bonuses-filter').val('').prop('selected', false);
		jQuery('.bonuses-filter').submit();
	});
});
</script>
					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged'):1;
					/*ODER*/
					if($FilterSessionSave_orderby == 'rand'){
						$bonuses_orderby = 'rand';
						$bonuses_order = 'DESC';
					}elseif($FilterSessionSave_orderby == 'date-desc'){
						$bonuses_orderby = 'date';
						$bonuses_order = 'DESC';
					}elseif($FilterSessionSave_orderby == 'date-asc'){
						$bonuses_orderby = 'date';
						$bonuses_order = 'ASC';
					}else{
						$bonuses_orderby = 'rand';
						$bonuses_order = 'DESC';
					}
					
					/*TYPE*/
					if($FilterSessionSave_type != '' or $FilterSessionSave_type != 0){
						$type = array('taxonomy'=>'bonuses_types', 'field'=>'id', 'terms'=>array($FilterSessionSave_type));
					}
					
					/*COUNTRY*/
					if($country_detect){
						$country = array('taxonomy'=>'bonuses_countries', 'field'=>'name', 'terms'=>$country_detect);
					}
					
					$args = array('post_type'=>'bonuses', 'orderby'=>$bonuses_orderby, 'order'=>$bonuses_order, 'paged'=>$paged, 'tax_query'=>array($type, $country));
					query_posts($args);
					$count_current_posts = $wp_query->found_posts;
					?>
<script>jQuery("#ItemsCount").text("<?php echo $count_current_posts;?>");</script>
					<?php if(have_posts()):?>
						<section class="play">
            <div class="play__container container">
              <h2 class="play__title">
                
				<?php echo __('Best casinos', 'websitelangid');?>
              </h2>
			 
					<ul class="play__list">
						<?php while(have_posts()):the_post();?>
						<?php get_template_part('template', 'bonuses-listing');?>
						<?php endwhile;?>
					</ul>
					<div class="casino__pagination"><?php wp_pagenavi();?></div>
					<?php else:?>
					<p style="text-align:center;"><?php echo __('Nothing found', 'websitelangid');?>.</p>
					<?php endif;?>
          		
        </div>
      </section>
	  <?php $archive_casinos_content = get_field('archive_bonuses_content', 'option'); if($archive_casinos_content){?>
	  <section class="info">
        <div class="container">
			<div class="info__text casino">
			<?php echo $archive_casinos_content;?>	
			</div>	
        </div>
      </section>
	  <?php }?>

<?php if(have_rows('archive_bonuses_faq', 'option')):?>
	<section class="faq">
      
		<div class="container" >
			<div itemscope itemtype="https://schema.org/FAQPage">
				<h2 class="faq__title"><?php the_field('archive_bonuses_faq_heading', 'option');?></h2>
				<?php while(have_rows('archive_bonuses_faq', 'option')):the_row();?>
				<div  class="faq__text" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
					<div class="faq__question accordion" >
					<strong itemprop="name"><?php the_sub_field('question');?></strong>
						<div class="faq__svg">
							<svg class="faq__svg-plus" class="faq__svg-plus">
							<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-plus"></use>
							</svg>
						</div>
						
					</div>
					<div class="faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
						<div itemprop="text"><?php the_sub_field('answer');?></div>
					</div>
				</div>
				<?php endwhile;?>
			</div>
	   </div>
	 </section>
<?php endif;?>
		<script>
			function filterMenu(selector) {
				let menu = document.querySelector(selector);
				let button = document.querySelector("#filtration__show");
				let title = document.querySelector(".filtration__show-title");

				button.addEventListener("click", (e) => {
					e.preventDefault();
					toggleMenu();
				});

				function toggleMenu() {
					if (menu.classList.contains("filter-form-active")) {
					menu.classList.remove("filter-form-active");
					button.classList.remove("filtration__show-svg-active");
					title.classList.remove("filtration__show-title-active");
					} else {
					menu.classList.add("filter-form-active");
					button.classList.add("filtration__show-svg-active");
					title.classList.add("filtration__show-title-active");
					}
				}
			}
			filterMenu(".filter-form");
		</script>
<?php get_footer();?>