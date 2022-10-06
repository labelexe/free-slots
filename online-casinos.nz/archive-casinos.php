<?php get_header();?>
<?php
$country_detect = do_shortcode('[useriploc type="country"]');
if($country_detect){
	$country_detect_term = get_term_by('name', $country_detect, 'casinos_countries');
	if($country_detect_term){
		$country_detect_native_name = get_field('Flexible Blocks', 'casinos_countries_'.$country_detect_term->term_id);
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
}

?>
<section  class="filtration arhive">
        <div class="container">
            <!-- <p class="filtration__subtitle"><?php echo __('Updated for', 'websitelangid');?> <?php the_date('M j', '', ''); ?></p> -->
            <h2 class="filtration__title"><?php echo sprintf(__('Our %s Casino Reviews and Ratings', 'websitelangid'), $country_native_name);?></h2>
            <div class="filtration__container">
			<div class="filter-infoblock">
				<p><span id="ItemsCount">
				<?php $count_posts = wp_count_posts('casinos'); //указываем созданный вами тип записи - services
					$published_posts = $count_posts->publish; //количество только опубликованных записей
					echo $published_posts;?>
				</span>
    		<?php echo __('casinos found for players from', 'websitelangid');?><?php if($country_native_name){echo ' '.__('from', 'websitelangid').' '.do_shortcode('[useriploc type="flag" height="24px" width="24px"]').' '.$country_native_name;}?></p>
			</div>
			<!-- <div id="filtration__show" class="filtration__show">
				<p class="filtration__show-title">
					<span class="show-filters"><?php echo __('Show filters', 'websitelangid');?></span>
					<span class="hide-filters"><?php echo __('Hide filters', 'websitelangid');?></span>
				</p>
            	<div class="filtration__show-svg">
              	<svg id="filtration__show-svg">
                	<use href="<?php bloginfo( 'template_url' ); ?>/assets/svg/sprite.svg#icon-plus"></use>
              	</svg>
            	</div>
          	</div> -->
          		<form id="filter-form" class="filter-form casinos-filter filter-form-active" method="post">
		  			<div class="filter-selects">
						<div class="filter-selects-wrapper filter-selects-4-cols">
							<div>
								<p>
									<label><?php echo __('Order By', 'websitelangid');?>:</label>
									<select name="orderby">
										<option value="rating" <?php if($_POST['orderby'] == 'rating' or $_POST['orderby'] == ''){echo 'selected="selected"';}?>><?php echo __('Best Rating', 'websitelangid');?></option>
										<option value="title-asc" <?php if($_POST['orderby'] == 'title-asc'){echo 'selected="selected"';}?>><?php echo __('A to Z', 'websitelangid');?></option>
										<option value="title-desc" <?php if($_POST['orderby'] == 'title-desc'){echo 'selected="selected"';}?>><?php echo __('Z to A', 'websitelangid');?></option>
										<option value="date" <?php if($_POST['orderby'] == 'date'){echo 'selected="selected"';}?>><?php echo __('New to Old', 'websitelangid');?></option>
										<option value="popular" <?php if($_POST['orderby'] == 'popular'){echo 'selected="selected"';}?>><?php echo __('Most Popular', 'websitelangid');?></option>
									</select>
								</p>
							</div>
							<?php $casinos_deposits = get_terms(array('taxonomy'=>'casinos_deposits')); if($casinos_deposits){?>
							<div>
								<p>
									<label><?php echo __('Deposit Method', 'websitelangid');?>:</label>
									<select name="deposit">
										<option value="" <?php if($_POST['deposit'] == '' or $_POST['deposit'] == 0){echo 'selected="selected"';}?>><?php echo __('All Methods', 'websitelangid');?></option>
										<?php foreach($casinos_deposits as $casinos_deposit){echo '<option value="'.$casinos_deposit->term_id.'"'; if($_POST['deposit'] == $casinos_deposit->term_id){echo 'selected="selected"';} echo '>'.$casinos_deposit->name.'</option>';}?>
									</select>
								</p>
							</div>
							<?php }?>
							<?php $casinos_withdrawals = get_terms(array('taxonomy'=>'casinos_withdrawals')); if($casinos_withdrawals){?>
							<div>
								<p>
									<label><?php echo __('Withdrawal Method', 'websitelangid');?>:</label>
									<select name="withdrawal">
										<option value="" <?php if($_POST['withdrawal'] == '' or $_POST['withdrawal'] == 0){echo 'selected="selected"';}?>><?php echo __('All Methods', 'websitelangid');?></option>
										<?php foreach($casinos_withdrawals as $casinos_withdrawal){echo '<option value="'.$casinos_withdrawal->term_id.'"'; if($_POST['withdrawal'] == $casinos_withdrawal->term_id){echo 'selected="selected"';} echo '>'.$casinos_withdrawal->name.'</option>';}?>
									</select>
								</p>
							</div>
							<?php }?>
							<?php $casinos_types = get_terms(array('taxonomy'=>'casinos_types')); if($casinos_types){?>
							<div>
								<p>
									<label><?php echo __('Casino Type', 'websitelangid');?>:</label>
									<select name="type">
										<option value="" <?php if($_POST['type'] == '' or $_POST['type'] == 0){echo 'selected="selected"';}?>><?php echo __('All Types', 'websitelangid');?></option>
										<?php foreach($casinos_types as $casinos_type){echo '<option value="'.$casinos_type->term_id.'"'; if($_POST['type'] == $casinos_type->term_id){echo 'selected="selected"';} echo '>'.$casinos_type->name.'</option>';}?>
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
           <script>
          jQuery(function(){
            jQuery(".clear-btn").click(function(){
              jQuery('select[name="orderby"]', '.casinos-filter').val('rating').prop('selected', false);
              jQuery('select[name="deposit"]', '.casinos-filter').val('').prop('selected', false);
              jQuery('select[name="withdrawal"]', '.casinos-filter').val('').prop('selected', false);
              jQuery('select[name="type"]', '.casinos-filter').val('').prop('selected', false);
              jQuery('.casinos-filter').submit();
            });
          });
		  
          </script>
					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged'):1;
					/*ODER*/
					if($_POST['orderby'] == 'rating'){
						$casinos_orderby = 'meta_value_num';
						$casinos_order = 'DESC';
						$casinos_meta_key = 'overall_reviews_rating';
					}elseif($_POST['orderby'] == 'title-asc'){
						$casinos_orderby = 'title';
						$casinos_order = 'ASC';
						$casinos_meta_key = '';
					}elseif($_POST['orderby'] == 'title-desc'){
						$casinos_orderby = 'title';
						$casinos_order = 'DESC';
						$casinos_meta_key = '';
					}elseif($_POST['orderby'] == 'date'){
						$casinos_orderby = 'date';
						$casinos_order = 'DESC';
						$casinos_meta_key = '';
					}elseif($_POST['orderby'] == 'popular'){
						$casinos_orderby = 'meta_value_num';
						$casinos_order = 'DESC';
						$casinos_meta_key = 'wpb_post_views_count';
					}else{
						$casinos_orderby = 'meta_value_num';
						$casinos_order = 'DESC';
						$casinos_meta_key = 'overall_reviews_rating';
					}
					
					/*DEPOSIT*/
					if($_POST['deposit'] != '' or $_POST['deposit'] != 0){
						$deposit = array('taxonomy'=>'casinos_deposits', 'field'=>'id', 'terms'=>array($_POST['deposit']));
					}
					
					/*WITHDRAWAL*/
					if($_POST['withdrawal'] != '' or $_POST['withdrawal'] != 0){
						$withdrawal = array('taxonomy'=>'casinos_withdrawals', 'field'=>'id', 'terms'=>array($_POST['withdrawal']));
					}
					
					/*TYPE*/
					if($_POST['type'] != '' or $_POST['type'] != 0){
						$type = array('taxonomy'=>'casinos_types', 'field'=>'id', 'terms'=>array($_POST['type']));
					}
					
					/*COUNTRY*/
					if($country_detect){
						$country = array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect);
					}
					
					$args = array('post_type'=>'casinos', 'meta_key'=>$casinos_meta_key, 'orderby'=>$casinos_orderby, 'order'=>$casinos_order, 'paged'=>$paged, 'tax_query'=>array($deposit, $withdrawal, $type, $country));
					query_posts($args);
					$count_current_posts = $wp_query->found_posts;
					?>
          <script>jQuery("#ItemsCount").text("<?php echo $count_current_posts;?>");</script>				
	</section>
		  <?php if(have_posts()):?>
            <section class="play">
            <div class="play__container container">
              <h2 class="play__title">
                
				<?php echo __('Best casinos', 'websitelangid');?>
              </h2>
			 
            <ol class="play__list">
				<?php $count_casinos = 1; while(have_posts()):the_post();?>
					<?php get_template_part('template', 'casinos-listing');?>
				<?php $count_casinos+1; endwhile;?>
            </ol>
			
			<div class="casino__pagination"><?php wp_pagenavi();?></div>

			<?php else:?>
			<p style="text-align:center; margin-top: 20px;"><?php echo __('Nothing found', 'websitelangid');?>.</p>
			<?php endif;?>
        </div>
      </section>
	  <?php $archive_casinos_content = get_field('archive_bonuses_content', 'option'); if($archive_casinos_content ){?>
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