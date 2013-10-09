<!-- .social-buttons -->
<?php 
	$id      = $post->ID;
	$url     = get_permalink($id);
	$title   = get_the_title($id);
	$thumb   = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url($thumb);
?>
<h3><?php _e('Enjoyed This Post? Share!', 'cherry'); ?></h3>
<ul class="social-buttons cf unstyled clearfix">
	<li>
		<a class="socialite facebook-like" href="https://www.facebook.com/sharer.php?u=https://www.socialitejs.com&amp;t=Socialite.js" rel="nofollow" target="_blank" data-href="<?php echo $url; ?>" data-send="false" data-layout="box_count" data-width="60" data-show-faces="false">
			<span class="vhidden">Share on Facebook</span>
		</a>
	</li>
	<li>
		<a class="socialite twitter-share" href="http://twitter.com/share" rel="nofollow" target="_blank" data-text="<?php echo $title; ?>" data-url="<?php echo $url; ?>" data-count="vertical" data-via="twitter-username-here">
			<span class="vhidden">Share on Twitter</span>
		</a>
	</li>
	<li>
		<a class="socialite googleplus-one" href="https://plus.google.com/share?url=http://socialitejs.com" rel="nofollow" target="_blank" data-size="tall" data-href="<?php echo $url; ?>">
			<span class="vhidden">Share on Google+</span>
		</a>
	</li>
	<li>
		<a class="socialite pinterest-pinit" href="http://pinterest.com/pin/create/button/?url=<?php echo $url; ?>&amp;media=<?php echo $img_url; ?>&amp;description=<?php echo $title; ?>" data-count-layout="vertical" target="_blank">
			<span class="vhidden">Pin It</span>
		</a>
	</li>
	<li>
		<a id="stumbleupon-share" href="http://www.stumbleupon.com/submit?&amp;url=<?php echo $url; ?>&amp;title=<?php echo $title; ?>" class="socialite stumbleupon-share" data-url="<?php echo $url; ?>" data-title="Socialite JS" data-counter="top" data-layout="5" rel="nofollow" target="_blank">
			<span class="vhidden">Share on StumbleUpon</span>
		</a>
	</li>
</ul>
<!-- //.social-buttons -->