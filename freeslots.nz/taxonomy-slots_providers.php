<?php get_header();?>
<?php $queried_object = get_queried_object(); $taxonomy = $queried_object->taxonomy; $term_id = $queried_object->term_id; $term_name = $queried_object->name;?>
<?php $term_id_original = apply_filters('wpml_object_id', $term_id, $taxonomy, true, 'en');?>
<?php
$country_detect = do_shortcode('[useriploc type="country"]');
$tax_slots_ordering = get_field('tax_slots_ordering', $taxonomy.'_'.$term_id);
?>
<?php
if(have_rows('flexible_blocks_top', $taxonomy.'_'.$term_id)):while(have_rows('flexible_blocks_top', $taxonomy.'_'.$term_id)):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>

		<div class="content-zone archive-listings float container">
			<div class="align">
				<section>
					<header style="display: flex; justify-content: space-between;">
						<div>
						<h1><?php echo sprintf(__('%s Slot Machine Games', 'websitelangid'), $queried_object->name);?></h1>
						<p><?php echo __('Please Rate this Provider', 'websitelangid');?></p>
						</div>
						<?php echo do_shortcode('[gdrts_stars_rating type="terms.slots_providers" id="'.$term_id_original.'"]');?>
					</header>
					
					<form class="filter-form slots-filter" method="post">
						<div class="filter-selects">
							<div class="filter-selects-wrapper filter-selects-4-cols">
								<div>
									<p>
										<label><?php echo __('Order By', 'websitelangid');?>:</label>
										<select  class="swipe__link" name="orderby">
											<?php if (isset($_POST['orderby'])) {
														$orderby = $_POST['orderby'];
													} else {
														$orderby = 0;
													} ?>
											<option value="date" <?php if($_POST['orderby'] == 'date' or $_POST['orderby'] == '' and $tax_slots_ordering == 'date' or $_POST['orderby'] == '' and $tax_slots_ordering == ''){echo 'selected="selected"';}?>><?php echo __('New to Old', 'websitelangid');?></option>
											<option value="title-asc" <?php echo selected($orderby, 'title-asc'); ?>> <?php echo __('A to Z', 'websitelangid');?></option>
											<option value="title-desc" <?php if($_POST['orderby'] == 'title-desc' or $_POST['orderby'] == '' and $tax_slots_ordering == 'title-desc'){echo 'selected="selected"';}?>><?php echo __('Z to A', 'websitelangid');?></option>
											<option value="popular" <?php if($_POST['orderby'] == 'popular' or $_POST['orderby'] == '' and $tax_slots_ordering == 'popular'){echo 'selected="selected"';}?>><?php echo __('Most Popular', 'websitelangid');?></option>
											<option value="rating" <?php if($_POST['orderby'] == 'rating' or $_POST['orderby'] == '' and $tax_slots_ordering == 'rating'){echo 'selected="selected"';}?>><?php echo __('Best Rating', 'websitelangid');?></option>
										</select>
									</p>
								</div>
								<?php $slots_types = get_terms(array('taxonomy'=>'slots_types')); if($slots_types){?>
								<div>
									<p>
										<label><?php echo __('Type', 'websitelangid');?>:</label>
										<select  class="swipe__link" name="type">
										<?php if (isset($_POST['type'])) {
														$type = $_POST['type'];
													} else {
														$type = 0;
													} ?>
											<option value="" <?php if($type == '' or $type == 0){echo 'selected="selected"';}?>><?php echo __('All Types', 'websitelangid');?></option>
											<?php foreach($slots_types as $slots_type){echo '<option value="'.$slots_type->term_id.'"'; if($type == $slots_type->term_id){echo 'selected="selected"';} echo '>'.$slots_type->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
								<?php $slots_themes = get_terms(array('taxonomy'=>'slots_themes')); if($slots_themes){?>
								<div>
									<p>
										<label><?php echo __('Theme', 'websitelangid');?>:</label>
										<select  class="swipe__link" name="theme">
											<option value="" <?php if($_POST['theme'] == '' or $_POST['theme'] == 0){echo 'selected="selected"';}?>><?php echo __('All Themes', 'websitelangid');?></option>
											<?php foreach($slots_themes as $slots_theme){echo '<option value="'.$slots_theme->term_id.'"'; if($_POST['theme'] == $slots_theme->term_id){echo 'selected="selected"';} echo '>'.$slots_theme->name.'</option>';}?>
										</select>
									</p>
								</div>
								<?php }?>
								<?php $slots_features = get_terms(array('taxonomy'=>'slots_features')); if($slots_features){?>
								<div>
									<p>
										<label><?php echo __('Features', 'websitelangid');?>:</label>
										<select   class="swipe__link" name="feature">
											<option value="" <?php if($_POST['feature'] == '' or $_POST['feature'] == 0){echo 'selected="selected"';}?>><?php echo __('All Features', 'websitelangid');?></option>
											<?php foreach($slots_features as $slots_feature){echo '<option value="'.$slots_feature->term_id.'"'; if($_POST['feature'] == $slots_feature->term_id){echo 'selected="selected"';} echo '>'.$slots_feature->name.'</option>';}?>
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
										<input class="video__link" type="submit" value="<?php echo __('Filter Slots', 'websitelangid');?>"/>
									</p>
								</div>
								<div>
									<p>
										<button class="video__link" class="clear-btn" type="button"><?php echo __('Clear Filter', 'websitelangid');?></button>
									</p>
								</div>
							</div>
						</div>
					</form>
<script  type="text/javascript">
jQuery(function(){
	jQuery(".clear-btn").click(function(){
		jQuery('select[name="orderby"]', '.slots-filter').val('date').prop('selected', false);
		jQuery('select[name="provider"]', '.slots-filter').val('').prop('selected', false);
		jQuery('select[name="theme"]', '.slots-filter').val('').prop('selected', false);
		jQuery('select[name="feature"]', '.slots-filter').val('').prop('selected', false);
		jQuery('.slots-filter').submit();
	});
});
</script>
				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged'):1;
					/*ODER*/
					if($_POST['orderby'] == 'date' or $_POST['orderby'] == '' and $tax_slots_ordering == 'date'){
						$slots_orderby = 'date';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}elseif($_POST['orderby'] == 'title-asc' or $_POST['orderby'] == '' and $tax_slots_ordering == 'title-asc'){
						$slots_orderby = 'title';
						$slots_order = 'ASC';
						$slots_meta_key = '';
					}elseif($_POST['orderby'] == 'title-desc' or $_POST['orderby'] == '' and $tax_slots_ordering == 'title-desc'){
						$slots_orderby = 'title';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}elseif($_POST['orderby'] == 'popular' or $_POST['orderby'] == '' and $tax_slots_ordering == 'popular'){
						$slots_orderby = 'meta_value_num';
						$slots_order = 'DESC';
						$slots_meta_key = 'wpb_post_views_count';
					}elseif($_POST['orderby'] == 'rating' or $_POST['orderby'] == '' and $tax_slots_ordering == 'rating'){
						$slots_orderby = 'gdrts';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}else{
						$slots_orderby = 'date';
						$slots_order = 'DESC';
						$slots_meta_key = '';
					}
					
					/*TYPE*/
					if($_POST['type'] != '' or $_POST['type'] != 0){
						$type = array('taxonomy'=>'slots_types', 'field'=>'id', 'terms'=>array($_POST['type']));
					}
					
					/*THEME*/
					if($_POST['theme'] != '' or $_POST['theme'] != 0){
						$theme = array('taxonomy'=>'slots_themes', 'field'=>'id', 'terms'=>array($_POST['theme']));
					}
					
					/*FEATURE*/
					if($_POST['feature'] != '' or $_POST['feature'] != 0){
						$feature = array('taxonomy'=>'slots_features', 'field'=>'id', 'terms'=>array($_POST['feature']));
					}
					
					/*CURRENT TERM*/
					$current_term = array('taxonomy'=>$taxonomy, 'field'=>'id', 'terms'=>$term_id);
					
					$args = array('post_type'=>'slots', 'meta_key'=>$slots_meta_key, 'orderby'=>$slots_orderby, 'order'=>$slots_order, 'paged'=>$paged, 'tax_query'=>array($current_term, $type, $theme, $feature));
					query_posts($args);
				?>
					<?php if(have_posts()):?>
					<ul class="games__list">
						<?php while(have_posts()):the_post();?>
						<?php get_template_part('template', 'slots-listing');?>
						<?php endwhile;?>
					</ul>
					<div style=" margin-bottom: 20px;" class="games__pagination">
					<?php wp_pagenavi();?>
					</div>
					<?php else:?>
					<p style="text-align:center;"><?php echo __('Nothing found', 'websitelangid');?>.</p>
					<?php endif;?>
					<section class="info">
						<div class="container">
							<div class="info__post">
							<div>
							<?php $tax_image = get_field('tax_image', $taxonomy.'_'.$term_id); if($tax_image){echo wp_get_attachment_image($tax_image, 'full', false, array('class'=>'provider-logo'));}?>
							<?php if(term_description()){?>
								<?php echo term_description();?>
							<?php }else{?>
								<?php echo vsprintf(__('<h2>%s provider</h2><p>%s is a gaming software provider that specializes in online casino software. It has over a lot of titles in its portfolio, with new releases happening regularly. %s is known for the dual release approach, which makes its software work equally well on desktop and mobile devices. If you consider learning more about %s, you are at the right place. Find more information in our guide.</p>', 'websitelangid'), array($term_name, $term_name, $term_name, $term_name));?>
							<?php }?>
							</div>
							</div>
						</div>
					</section>
				</section>
				<section class="faq">
      
	  <div class="container" >
	  
				  <div id="slot-faq" class="slot-faq">
					  <h2 class="faq__title"><?php echo sprintf(__('%s FAQ', 'websitelangid'), $queried_object->name);?></h2>
					  <?php if(have_rows('slot_faq')):?>
						<?php while(have_rows('slot_faq')):the_row();?>	<?php endwhile;?>
				  <?php else :

echo vsprintf(__('
<div class="slot-faq" itemscope itemtype="https://schema.org/FAQPage">
    <div class="faq__text" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
      <div class="faq__question" >
        <p itemprop="name">Does %s  produce mobile-friendly gaming content?</p>
        <div class="faq__svg">
                    <svg class="faq__svg-plus" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0Z" fill="white"/>
                    </svg>
                    <svg class="faq__svg-minus" viewBox="0 0 14 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M13.125 0H7.875H0.875C0.642936 0 0.420376 0.0921874 0.256282 0.256282C0.0921874 0.420376 0 0.642936 0 0.875C0 1.10706 0.0921874 1.32962 0.256282 1.49372C0.420376 1.65781 0.642936 1.75 0.875 1.75H7.875H13.125C13.3571 1.75 13.5796 1.65781 13.7437 1.49372C13.9078 1.32962 14 1.10706 14 0.875C14 0.642936 13.9078 0.420376 13.7437 0.256282C13.5796 0.0921874 13.3571 0 13.125 0Z" fill="white"/>
                    </svg>
                  </div>
      </div>
      <div class="faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <div itemprop="text"><p>Yes, it does. The provider offers slots in a mobile format. Players can launch any slot on Android and iOS devices.</p></div>
      </div>
    </div>
    <div class="faq__text" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
      <div class="faq__question">
        <p itemprop="name">Where can players get access to the slot machines by %s?</p>
        <div class="faq__svg">
                    <svg class="faq__svg-plus" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0Z" fill="white"/>
                    </svg>
                    <svg class="faq__svg-minus" viewBox="0 0 14 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M13.125 0H7.875H0.875C0.642936 0 0.420376 0.0921874 0.256282 0.256282C0.0921874 0.420376 0 0.642936 0 0.875C0 1.10706 0.0921874 1.32962 0.256282 1.49372C0.420376 1.65781 0.642936 1.75 0.875 1.75H7.875H13.125C13.3571 1.75 13.5796 1.65781 13.7437 1.49372C13.9078 1.32962 14 1.10706 14 0.875C14 0.642936 13.9078 0.420376 13.7437 0.256282C13.5796 0.0921874 13.3571 0 13.125 0Z" fill="white"/>
                    </svg>
                  </div>
      </div>
      <div class="faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <div itemprop="text"><p>The slots produced by %s are supported by online casinos. You need to check the local gallery before joining.</p></div>
      </div>
    </div>
    <div class="faq__text" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
      <div class="faq__question">
        <p itemprop="name">Does %s offer free slot machines?</p>
        <div class="faq__svg">
                    <svg class="faq__svg-plus" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M7 0C7.23206 0 7.45462 0.0921874 7.61872 0.256282C7.78281 0.420376 7.875 0.642936 7.875 0.875V6.125H13.125C13.3571 6.125 13.5796 6.21719 13.7437 6.38128C13.9078 6.54538 14 6.76794 14 7C14 7.23206 13.9078 7.45462 13.7437 7.61872C13.5796 7.78281 13.3571 7.875 13.125 7.875H7.875V13.125C7.875 13.3571 7.78281 13.5796 7.61872 13.7437C7.45462 13.9078 7.23206 14 7 14C6.76794 14 6.54538 13.9078 6.38128 13.7437C6.21719 13.5796 6.125 13.3571 6.125 13.125V7.875H0.875C0.642936 7.875 0.420376 7.78281 0.256282 7.61872C0.0921874 7.45462 0 7.23206 0 7C0 6.76794 0.0921874 6.54538 0.256282 6.38128C0.420376 6.21719 0.642936 6.125 0.875 6.125H6.125V0.875C6.125 0.642936 6.21719 0.420376 6.38128 0.256282C6.54538 0.0921874 6.76794 0 7 0Z" fill="white"/>
                    </svg>
                    <svg class="faq__svg-minus" viewBox="0 0 14 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M13.125 0H7.875H0.875C0.642936 0 0.420376 0.0921874 0.256282 0.256282C0.0921874 0.420376 0 0.642936 0 0.875C0 1.10706 0.0921874 1.32962 0.256282 1.49372C0.420376 1.65781 0.642936 1.75 0.875 1.75H7.875H13.125C13.3571 1.75 13.5796 1.65781 13.7437 1.49372C13.9078 1.32962 14 1.10706 14 0.875C14 0.642936 13.9078 0.420376 13.7437 0.256282C13.5796 0.0921874 13.3571 0 13.125 0Z" fill="white"/>
                    </svg>
                  </div>
      </div>
      <div class="faq__answer" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
        <div itemprop="text"><p>Yes, it does. Many online casinos supporting %s software offer the slots in demo mode. Players are allowed to start the gameplay without depositing a single cent.</p></div>
      </div>
    </div>
  </div>
', 'websitelangid'), array($term_name, $term_name, $term_name,   $term_name, $term_name, $term_name));

	  endif; ?>
		  </div>
	  </div>
	</section>   
<?php
if(have_rows('flexible_blocks_bottom', $taxonomy.'_'.$term_id)):while(have_rows('flexible_blocks_bottom', $taxonomy.'_'.$term_id)):the_row();
	get_template_part('template', 'flexible-blocks');
endwhile; endif;
?>
			</div>
		</div>

<?php get_footer();?>