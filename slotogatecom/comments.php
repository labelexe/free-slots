<?php
$casino_reviews_id_original = apply_filters('wpml_object_id', get_the_ID(), 'casinos', true, 'en');
?>
<?php $comments = get_comments(array('post_id'=>$casino_reviews_id_original, 'status'=>'approve', 'number'=>''));?>
<?php $overall_reviews_rating = round(get_field('overall_reviews_rating'), 2);?>
<div class="comments-wrapper" <?php if($comments){?>itemtype="https://schema.org/Organization" itemscope<?php }?>>
	<div class="comments-flex">
		<?php if($comments){?>
			<button class="hiddenbox" id="ShowReviewInLang"><span class="show-all-reviews"><?php echo __('All Languages', 'websitelangid');?></span><span class="show-native-reviews"><?php echo __('English Reviews', 'websitelangid');?></span></button>
			<ol class="commentlist">
				<?php foreach($comments as $comment){?>
				<?php
				$comment_rating = get_comment_meta($comment->comment_ID, 'comment_rating')[0];
				$overall_post_rating[] = $comment_rating;
				$approved_comments[] = 1;
				$comment_language = get_comment_meta($comment->comment_ID, 'comment_language')[0];
				if($comment_language == ''){$comment_language_value = 'en';}else{$comment_language_value = $comment_language;}
				?>
				<li class="<?php if($comment_language_value == ICL_LANGUAGE_CODE){echo 'current-language-review';}else{echo 'foreign-language-review';}?>" id="comment-<?php echo $comment->comment_ID;?>" lang="<?php echo $comment_language_value;?>">
					<article itemprop="review" itemtype="https://schema.org/Review" itemscope>
						<div class="hiddenbox" itemprop="itemReviewed" itemscope itemtype="https://schema.org/Organization"><span itemprop="name"><?php the_title();?></span></div>
						<meta itemprop="datePublished" content="<?php echo $comment->comment_date;?>"/>
						<header>
							<h4 itemprop="author" itemtype="https://schema.org/Person" itemscope><span itemprop="name"><?php echo $comment->comment_author;?></span></h4>
							<div class="comment-rating" itemprop="reviewRating" itemtype="https://schema.org/Rating" itemscope>
								<?php
								if($comment_rating == 1){
									echo '<div class="hiddenbox"><span itemprop="ratingValue">1</span></div><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
								}elseif($comment_rating == 2){
									echo '<div class="hiddenbox"><span itemprop="ratingValue">2</span></div><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
								}elseif($comment_rating == 3){
									echo '<div class="hiddenbox"><span itemprop="ratingValue">3</span></div><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i>';
								}elseif($comment_rating == 4){
									echo '<div class="hiddenbox"><span itemprop="ratingValue">4</span></div><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star"></i>';
								}elseif($comment_rating == 5){
									echo '<div class="hiddenbox"><span itemprop="ratingValue">5</span></div><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
								}else{
									echo '<div class="hiddenbox"><span itemprop="ratingValue">5</span></div><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
								}
								?>
								<time datetime="<?php echo $comment->comment_date;?>"><?php echo $comment->comment_date;?></time>
								<div class="hiddenbox"><meta itemprop="worstRating" content="1"/><meta itemprop="bestRating" content="5"/></div>
							</div>
						</header>
						<div itemprop="reviewBody"><?php echo $comment->comment_content;?></div>
					</article>
				</li>
				<?php }?>
			</ol>
<script>
if(jQuery(".current-language-review").length > 0 && jQuery(".foreign-language-review").length > 0){
	jQuery("#ShowReviewInLang").removeClass("hiddenbox");
}
jQuery("#ShowReviewInLang").click(function(){
	jQuery("#ShowReviewInLang").toggleClass("active")
	jQuery(".foreign-language-review").toggle();
});
</script>
			<?php $overall_post_rating_result_summ = array_sum($overall_post_rating) / array_sum($approved_comments); $overall_post_rating_result = round($overall_post_rating_result_summ, 2);?>
			<div class="hiddenbox">
				<meta itemprop="name" content="<?php the_title();?>"/>
				<link itemprop="image" href="<?php the_post_thumbnail_url('full');?>"/>
				<div itemprop="aggregateRating" itemtype="https://schema.org/AggregateRating" itemscope>
					<meta itemprop="worstRating" content="1"/>
					<meta itemprop="bestRating" content="5"/>
					<meta itemprop="reviewCount" content="<?php echo array_sum($approved_comments);?>"/>
					<meta itemprop="ratingValue" content="<?php echo $overall_post_rating_result;?>"/>
				</div>
			</div>
			<?php if($overall_reviews_rating == '' or $overall_reviews_rating != $overall_post_rating_result){update_field('overall_reviews_rating', $overall_post_rating_result);}?>
		<?php }else{?>
			<p><?php echo __('Currently there are no reviews for', 'websitelangid');?> «<?php the_title();?>».</p>
			<?php if($overall_reviews_rating == '' or $overall_reviews_rating != 0){update_field($overall_reviews_rating, 0);}?>
		<?php }?>
	</div>
	<?php
	comment_form(
		array(
			'fields'=>array(
				'author'=>'<p class="comment-form-author"><label for="author">'.__('Name', 'websitelangid').($req ? ' <span class="required">*</span>' : '').'</label> <input id="author" name="author" type="text" value="'.esc_attr($commenter['comment_author']).'" size="30"'.$aria_req.$html_req.'/></p>',
				'email'=>'<p class="comment-form-email"><label for="email">'.__('Email', 'websitelangid').($req ? ' <span class="required">*</span>' : '').'</label> <input id="email" name="email" '.($html5 ? 'type="email"' : 'type="text"').' value="'.esc_attr($commenter['comment_author_email']).'" size="30" aria-describedby="email-notes"'.$aria_req.$html_req.'/></p>',
				'cookies'=>'<p class="comment-form-cookies-consent">'.sprintf('<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />', $consent).'<label for="wp-comment-cookies-consent">'.__('Save my name and email in this browser for the next time I post a review', 'websitelangid').'.</label></p>',
			),
			'comment_field'=>'<p class="comment-form-comment"><label for="comment">'.__('Your Review', 'websitelangid').' <span class="required">*</span></label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			'title_reply'=>__('Add Review', 'websitelangid'),
			'label_submit'=>__('Submit Review', 'websitelangid'),
		), $casino_reviews_id_original
	);
	?>
</div>