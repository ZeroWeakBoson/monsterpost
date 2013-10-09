<!-- Post Date -->
<div class="post_date">
	<span class="date"><time datetime="<?php the_time('Y-m-d\TH:i:s'); ?>"><?php the_time('M'); ?> <strong><?php the_time('m'); ?></strong></time></span>
	<span class="post_category">
		<b><?php _e('Filed under:', 'cherry'); ?></b>
		<?php the_category(', '); ?>
	</span>
	<?php 
		$posttags = get_the_tags();
		global $tag_array;
		$tag_array = array();
		$i = 0;
		if ($posttags) { ?>
			<ul class="post_tag unstyled clearfix">
			<?php foreach($posttags as $tag) {
				echo '<li><a href="'.get_tag_link($tag->term_id).'"><i class="icon-tag"></i> ' . $tag->name . '</a></li>'; 
				$tag_array[$i] = $tag->slug;
				$i++;
			} ?>
			</ul>
		<?php }
	?>
</div>
<!--// Post Date -->