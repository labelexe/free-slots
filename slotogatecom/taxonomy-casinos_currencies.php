<?php get_header();?>
<?php $queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id; $term_name = $queried_object->name;?>
<?php $term_id_original = apply_filters('wpml_object_id', $term_id, $taxonomy, true, 'en');?>
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
}
$tax_casinos_ordering = get_field('tax_casinos_ordering', $taxonomy.'_'.$term_id);
?>
<?php
if(have_rows('flexible_blocks_top', $taxonomy.'_'.$term_id)):while(have_rows('flexible_blocks_top', $taxonomy.'_'.$term_id)):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
		<div class="content-zone float">
			<div class="align">
				<section>
					<div class="taxonomy-archive-intro">
						<div class="taxonomy-archive-content">
							<?php if(term_description()){?>
								<?php echo term_description();?>
							<?php }else{?>
								<?php echo vsprintf(__('<h2>%s</h2><p>%s is one of the world national currencies. Many online casinos accept it for deposits and withdrawals. Thus, %s can be used as a standard payment currency, with no conversions in other international currencies. If players decide to make transactions using %s, they should check whether it is supported by the gambling site and accepted by the selected payment method.</p>', 'websitelangid'), array($term_name, $term_name, $term_name, $term_name));?>
							<?php }?>
						</div>
						<div class="taxonomy-archive-image">
							<?php $tax_image = get_field('tax_image', $taxonomy.'_'.$term_id); if($tax_image){echo wp_get_attachment_image($tax_image, 'full');}else{echo '<img width="395" height="325" src="'.get_bloginfo('template_url').'/images/tax-image-placeholder.png" alt="'.__('Casino', 'websitelangid').'"/>';}?>
						</div>
					</div>
				</section>
			</div>
		</div>
		<div class="content-zone archive-listings float">
			<div class="align">
				<section>
					<header>
						<div class="archive-listings-date"><mark><?php echo __('Updated on', 'websitelangid');?> <?php echo wp_date('F, Y');?></mark></div>
						<h3><?php echo vsprintf(__('%s Casinos in %s', 'websitelangid'), array($queried_object->name, $country_native_name));?></h3>
						<p><?php echo __('Please Rate Our Casinos Collection', 'websitelangid');?></p>
						<?php echo do_shortcode('[gdrts_stars_rating type="terms.casinos_currencies" id="'.$term_id_original.'"]');?>
					</header>
					<?php
					if(is_paged()){
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							$_SESSION['deposit'] = $_POST['deposit'];
							$_SESSION['withdrawal'] = $_POST['withdrawal'];
							$_SESSION['type'] = $_POST['type'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_deposit = $_SESSION['deposit'];
							$FilterSessionSave_withdrawal = $_SESSION['withdrawal'];
							$FilterSessionSave_type = $_SESSION['type'];
						}else{
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_deposit = $_SESSION['deposit'];
							$FilterSessionSave_withdrawal = $_SESSION['withdrawal'];
							$FilterSessionSave_type = $_SESSION['type'];
						}
					}else{
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							$_SESSION['deposit'] = $_POST['deposit'];
							$_SESSION['withdrawal'] = $_POST['withdrawal'];
							$_SESSION['type'] = $_POST['type'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_deposit = $_SESSION['deposit'];
							$FilterSessionSave_withdrawal = $_SESSION['withdrawal'];
							$FilterSessionSave_type = $_SESSION['type'];
						}else{
							$_SESSION['orderby'] = '';
							$_SESSION['deposit'] = '';
							$_SESSION['withdrawal'] = '';
							$_SESSION['type'] = '';
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
							$FilterSessionSave_deposit = $_SESSION['deposit'];
							$FilterSessionSave_withdrawal = $_SESSION['withdrawal'];
							$FilterSessionSave_type = $_SESSION['type'];
						}
					}
					?>
					<button id="ToggleFiltersButton"><span class="show-filters-text"><?php echo __('Show filters', 'websitelangid');?></span><span class="hide-filters-text"><?php echo __('Hide filters', 'websitelangid');?></span><i class="fas fa-chevron-down"></i></button>
					<form id="ToggleFiltersContent" class="filter-form casinos-filter" method="post">
<script>
jQuery('#ToggleFiltersButton').click(function(){
	jQuery('#ToggleFiltersButton').toggleClass('active');
	jQuery('#ToggleFiltersContent').toggleClass('active');
});
</script>
						<div class="filter-infoblock">
							<p><span id="ItemsCount"></span> <?php echo __('Casinos Found for Players', 'websitelangid');?><?php if($country_native_name){echo ' '.__('from', 'websitelangid').' '.do_shortcode('[useriploc type="flag" height="20px" width="auto"]').' '.$country_native_name;}?></p>
						</div>
						<div class="filter-selects">
							<div class="filter-selects-wrapper filter-selects-4-cols">
								<div>
									<p>
										<label><?php echo __('Order By', 'websitelangid');?>:</label>
										<select name="orderby">
											<option value="rating" <?php if($FilterSessionSave_orderby == 'rating' or $FilterSessionSave_orderby == '' and $tax_casinos_ordering == 'rating' or $FilterSessionSave_orderby == '' and $tax_casinos_ordering == ''){echo 'selected="selected"';}?>><?php echo __('Best Rating', 'websitelangid');?></option>
											<option value="title-asc" <?php if($FilterSessionSave_orderby == 'title-asc' or $FilterSessionSave_orderby == '' and $tax_casinos_ordering == 'title-asc'){echo 'selected="selected"';}?>><?php echo __('A to Z', 'websitelangid');?></option>
											<option value="title-desc" <?php if($FilterSessionSave_orderby == 'title-desc' or $FilterSessionSave_orderby == '' and $tax_casinos_ordering == 'title-desc'){echo 'selected="selected"';}?>><?php echo __('Z to A', 'websitelangid');?></option>
											<option value="date" <?php if($FilterSessionSave_orderby == 'date' or $FilterSessionSave_orderby == '' and $tax_casinos_ordering == 'date'){echo 'selected="selected"';}?>><?php echo __('New to Old', 'websitelangid');?></option>
											<option value="popular" <?php if($FilterSessionSave_orderby == 'popular' or $FilterSessionSave_orderby == '' and $tax_casinos_ordering == 'popular'){echo 'selected="selected"';}?>><?php echo __('Most Popular', 'websitelangid');?></option>
										</select>
									</p>
								</div>
								<?php $casinos_deposits = get_terms(array('taxonomy'=>'casinos_deposits')); if($casinos_deposits){?>
								<div>
									<p>
										<label><?php echo __('Deposit Method', 'websitelangid');?>:</label>
										<select name="deposit">
											<option value="" <?php if($FilterSessionSave_deposit == '' or $FilterSessionSave_deposit == 0){echo 'selected="selected"';}?>><?php echo __('All Methods', 'websitelangid');?></option>
											<?php foreach($casinos_deposits as $casinos_deposit){echo '<option value="'.$casinos_deposit->term_id.'"'; if($FilterSessionSave_deposit == $casinos_deposit->term_id){echo 'selected="selected"';} echo '>'.$casinos_deposit->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
								<?php $casinos_withdrawals = get_terms(array('taxonomy'=>'casinos_withdrawals')); if($casinos_withdrawals){?>
								<div>
									<p>
										<label><?php echo __('Withdrawal Method', 'websitelangid');?>:</label>
										<select name="withdrawal">
											<option value="" <?php if($FilterSessionSave_withdrawal == '' or $FilterSessionSave_withdrawal == 0){echo 'selected="selected"';}?>><?php echo __('All Methods', 'websitelangid');?></option>
											<?php foreach($casinos_withdrawals as $casinos_withdrawal){echo '<option value="'.$casinos_withdrawal->term_id.'"'; if($FilterSessionSave_withdrawal == $casinos_withdrawal->term_id){echo 'selected="selected"';} echo '>'.$casinos_withdrawal->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
								<?php $casinos_types = get_terms(array('taxonomy'=>'casinos_types')); if($casinos_types){?>
								<div>
									<p>
										<label><?php echo __('Casino Type', 'websitelangid');?>:</label>
										<select name="type">
											<option value="" <?php if($FilterSessionSave_type == '' or $FilterSessionSave_type == 0){echo 'selected="selected"';}?>><?php echo __('All Types', 'websitelangid');?></option>
											<?php foreach($casinos_types as $casinos_type){echo '<option value="'.$casinos_type->term_id.'"'; if($FilterSessionSave_type == $casinos_type->term_id){echo 'selected="selected"';} echo '>'.$casinos_type->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
							</div>
						</div>
						<div class="filter-buttons">
							<div class="filter-buttons-wrapper filter-buttons-2-cols">
								<div>
									<p>
										<input type="submit" value="<?php echo __('Filter Casinos', 'websitelangid');?>"/>
									</p>
								</div>
								<div>
									<p>
										<button class="clear-btn" type="button"><?php echo __('Clear Filter', 'websitelangid');?></button>
									</p>
								</div>
							</div>
						</div>
					</form>
<script>
jQuery(function(){
	jQuery(".clear-btn").click(function(){
		jQuery('select[name="orderby"]', '.casinos-filter').val('<?php if($tax_casinos_ordering == 'rating'){echo 'rating';}elseif($tax_casinos_ordering == 'title-asc'){echo 'title-asc';}elseif($tax_casinos_ordering == 'title-desc'){echo 'title-desc';}elseif($tax_casinos_ordering == 'date'){echo 'date';}elseif($tax_casinos_ordering == 'popular'){echo 'popular';}else{echo 'rating';}?>').prop('selected', false);
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
					if($FilterSessionSave_orderby == 'rating' or $FilterSessionSave_orderby == '' and  $tax_casinos_ordering == 'rating'){
						$casinos_orderby = 'meta_value_num';
						$casinos_order = 'DESC';
						$casinos_meta_key = 'overall_reviews_rating';
					}elseif($FilterSessionSave_orderby == 'title-asc' or $FilterSessionSave_orderby == '' and  $tax_casinos_ordering == 'title-asc'){
						$casinos_orderby = 'title';
						$casinos_order = 'ASC';
						$casinos_meta_key = '';
					}elseif($FilterSessionSave_orderby == 'title-desc' or $FilterSessionSave_orderby == '' and  $tax_casinos_ordering == 'title-desc'){
						$casinos_orderby = 'title';
						$casinos_order = 'DESC';
						$casinos_meta_key = '';
					}elseif($FilterSessionSave_orderby == 'date' or $FilterSessionSave_orderby == '' and  $tax_casinos_ordering == 'date'){
						$casinos_orderby = 'date';
						$casinos_order = 'DESC';
						$casinos_meta_key = '';
					}elseif($FilterSessionSave_orderby == 'popular' or $FilterSessionSave_orderby == '' and  $tax_casinos_ordering == 'popular'){
						$casinos_orderby = 'meta_value_num';
						$casinos_order = 'DESC';
						$casinos_meta_key = 'wpb_post_views_count';
					}else{
						$casinos_orderby = 'meta_value_num';
						$casinos_order = 'DESC';
						$casinos_meta_key = 'overall_reviews_rating';
					}
					
					/*DEPOSIT*/
					if($FilterSessionSave_deposit != '' or $FilterSessionSave_deposit != 0){
						$deposit = array('taxonomy'=>'casinos_deposits', 'field'=>'id', 'terms'=>array($FilterSessionSave_deposit));
					}
					
					/*WITHDRAWAL*/
					if($FilterSessionSave_withdrawal != '' or $FilterSessionSave_withdrawal != 0){
						$withdrawal = array('taxonomy'=>'casinos_withdrawals', 'field'=>'id', 'terms'=>array($FilterSessionSave_withdrawal));
					}
					
					/*TYPE*/
					if($FilterSessionSave_type != '' or $FilterSessionSave_type != 0){
						$type = array('taxonomy'=>'casinos_types', 'field'=>'id', 'terms'=>array($FilterSessionSave_type));
					}
					
					/*CURRENT TERM*/
					$current_term = array('taxonomy'=>$taxonomy, 'field'=>'id', 'terms'=>$term_id);
					
					/*COUNTRY*/
					if($country_detect){
						$country = array('taxonomy'=>'casinos_countries', 'field'=>'name', 'terms'=>$country_detect);
					}
					
					$args = array('post_type'=>'casinos', 'meta_key'=>$casinos_meta_key, 'orderby'=>$casinos_orderby, 'order'=>$casinos_order, 'paged'=>$paged, 'tax_query'=>array($current_term, $country, $deposit, $withdrawal, $type));
					query_posts($args);
					$count_current_posts = $wp_query->found_posts;
					?>
<script>jQuery("#ItemsCount").text("<?php echo $count_current_posts;?>");</script>
					<?php if(have_posts()):?>
					<ul class="casinos-listing">
						<?php $count_casinos = 1; while(have_posts()):the_post();?>
						<?php get_template_part('template', 'casinos-listing');?>
						<?php $count_casinos++; endwhile;?>
					</ul>
					<?php wp_pagenavi();?>
					<?php else:?>
					<p style="text-align:center;"><?php echo __('Nothing found', 'websitelangid');?>.</p>
					<?php endif;?>
				</section>
			</div>
		</div>
<?php
if(have_rows('flexible_blocks_bottom', $taxonomy.'_'.$term_id)):while(have_rows('flexible_blocks_bottom', $taxonomy.'_'.$term_id)):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
		<?php $linking_terms = get_terms(array('taxonomy'=>$taxonomy, 'hide_empty'=>true, 'exclude'=>$term_id)); if($linking_terms){?>
		<div class="content-zone linking-line float">
			<div class="align">
				<aside>
					<header>
						<h5><?php echo __('Casinos That Accept Other Currencies', 'websitelangid');?></h5>
					</header>
					<ul class="linking-listings">
						<?php foreach($linking_terms as $linking_term){?>
						<li><a href="<?php echo get_term_link($linking_term->term_id);?>"><?php echo $linking_term->name;?></a></li>
						<?php }?>
					</ul>
				</aside>
			</div>
		</div>
		<?php }?>
<?php get_footer();?>