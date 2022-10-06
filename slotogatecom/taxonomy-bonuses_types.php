<?php get_header();?>
<?php $queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id;?>
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
?>
<?php
if(have_rows('flexible_blocks_top', $taxonomy.'_'.$term_id)):while(have_rows('flexible_blocks_top', $taxonomy.'_'.$term_id)):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
		<?php if(term_description()){?>
		<div class="content-zone float">
			<div class="align">
				<section>
					<div class="taxonomy-archive-intro">
						<div class="taxonomy-archive-content">
							<?php echo term_description();?>
						</div>
						<div class="taxonomy-archive-image">
							<?php $tax_image = get_field('tax_image', $taxonomy.'_'.$term_id); if($tax_image){echo wp_get_attachment_image($tax_image, 'full');}else{echo '<img width="395" height="325" src="'.get_bloginfo('template_url').'/images/tax-image-placeholder.png" alt="'.__('Casino', 'websitelangid').'"/>';}?>
						</div>
					</div>
				</section>
			</div>
		</div>
		<?php }?>
		<div class="content-zone archive-listings float">
			<div class="align">
				<section>
					<header>
						<div class="archive-listings-date"><mark><?php echo __('Updated on', 'websitelangid');?> <?php echo wp_date('F, Y');?></mark></div>
						<h3><?php echo vsprintf(__('%s Selection in %s', 'websitelangid'), array($queried_object->name, $country_native_name));?></h3>
						<p><?php echo __('Please Rate Our Bonuses Collection', 'websitelangid');?></p>
						<?php echo do_shortcode('[gdrts_stars_rating type="terms.bonuses_types" id="'.$term_id_original.'"]');?>
					</header>
					<?php
					if(is_paged()){
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
						}else{
							$FilterSessionSave_orderby = $_SESSION['orderby'];
						}
					}else{
						if($_POST){
							$_SESSION['orderby'] = $_POST['orderby'];
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
						}else{
							$_SESSION['orderby'] = '';
							
							$FilterSessionSave_orderby = $_SESSION['orderby'];
						}
					}
					?>
					<form class="filter-form" method="post">
						<div class="filter-infoblock">
							<p><span id="ItemsCount"></span> <?php echo __('Bonuses Found for Players', 'websitelangid');?><?php if($country_native_name){echo ' '.__('from', 'websitelangid').' '.do_shortcode('[useriploc type="flag" height="20px" width="auto"]').' '.$country_native_name;}?></p>
						</div>
						<div class="filter-selects">
							<div class="filter-selects-wrapper filter-selects-1-cols">
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
							</div>
						</div>
						<div class="filter-buttons">
							<div class="filter-buttons-wrapper filter-buttons-1-cols">
								<div>
									<p>
										<input type="submit" value="<?php echo __('Sort Bonuses', 'websitelangid');?>"/>
									</p>
								</div>
							</div>
						</div>
					</form>
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
					
					/*CURRENT TERM*/
					$type = array('taxonomy'=>$taxonomy, 'field'=>'id', 'terms'=>$term_id);
					
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
					<div class="bonuses-listing-header">
						<div class="bonuses-listing-header-wrapper">
							<div class="bonuses-listing-header-casino"><p><?php echo __('Casino', 'websitelangid');?></p></div>
							<div class="bonuses-listing-header-rating"><p><?php echo __('Rating', 'websitelangid');?></p></div>
							<div class="bonuses-listing-header-type"><p><?php echo __('Type', 'websitelangid');?></p></div>
							<div class="bonuses-listing-header-bonus"><p><?php echo __('Bonus', 'websitelangid');?></p></div>
							<div class="bonuses-listing-header-actions"><p><?php echo __('Actions', 'websitelangid');?></p></div>
						</div>
					</div>
					<ul class="bonuses-listing-table">
						<?php while(have_posts()):the_post();?>
						<?php get_template_part('template', 'bonuses-listing');?>
						<?php endwhile;?>
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
<?php get_footer();?>