<div class="top-posts clearfix">
<?php
	global $top_posts_offset;
	$top_posts_offset = 0;
	$numberposts = 3; // how many posts show?

	$args = array(
		'numberposts' => $numberposts,
		'orderby'     => 'post_date',
		'order'       => 'DESC',
		'meta_key'    => 'tz_top_check'
	);
	$top_posts = get_posts( $args );
	$top_posts_count = count( $top_posts );

	// var_dump($top_posts_count);

	if ( $top_posts_count == $numberposts ) {
		loop_monster_top_post( $top_posts, true );

	} elseif ( ( $top_posts_count < $numberposts ) && $top_posts_count ) {

		loop_monster_top_post( $top_posts, true );

		$top_posts_offset = absint( $numberposts - $top_posts_count );
		$args = array(
			'numberposts' => $top_posts_offset,
			'orderby'     => 'post_date',
			'order'       => 'DESC',
			'category'    => -265 // execute 'Watch & Learn' category
		);
		$latest_posts = get_posts( $args );
		loop_monster_top_post( $latest_posts );

	} else {

		$top_posts_offset = $numberposts;
		$args = array(
			'numberposts' => $numberposts,
			'orderby'     => 'post_date',
			'order'       => 'DESC',
			'category'    => -265 // execute 'Watch & Learn' category
		);
		$latest_posts = get_posts( $args );
		loop_monster_top_post( $latest_posts );

	}
?>
<script>jQuery('.rightbottom-side').css({'marginTop' : jQuery('.righttop-side').outerHeight()});</script>
</div>