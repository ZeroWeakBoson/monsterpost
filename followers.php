<!-- BEGIN FOLLOWERS -->
<?php 
	require_once('../../../wp-load.php');

	// get social accounts
	$facebook_username  = of_get_option('facebook_username');
	$twitter_username   = of_get_option('twitter_username');
	$google_userID      = of_get_option('google_userID');
	$stumble_username   = of_get_option('stumble_username');
	$pinterest_username = of_get_option('pinterest_username');
	$total_array        = array();

	/*==========  Facebook  ==========*/
	if ($facebook_username != '') {
		$fb = @json_decode(file_get_contents('https://graph.facebook.com/'.$facebook_username));
		if (is_object($fb)) {
			$fb_fans = number_format($fb->talking_about_count);
			$fb_fans = str_replace(',', '', $fb_fans);
			$total_array['facebook'] = $fb_fans;
		}
	}

	/*==========  Twitter  ==========*/
	if ($twitter_username != '') {
		$tw_fans = 0;
		if (function_exists('getTweets')) {
			$opt_args = array(
				'trim_user'         => false,
				'exclude_replies'   => false,
				'include_rts'       => true
			);
			$tweets = getTweets(1, $twitter_username, $opt_args);
			if ( is_array($tweets) ){
				foreach ( $tweets as $tweet ){
					$tw      = $tweet['user'];
					$tw_fans = $tw['followers_count'];
					$total_array['twitter'] = $tw_fans;
				}
			}
		}
	}

	/*==========  Google+  ==========*/
	if ($google_userID != '') {
		$gp_fans = google_plus_follower_amount($google_userID);
	}

	/*==========  StumbleUpon  ==========*/
	if ($stumble_username != '') {
		$stumble_fans = stumble_follower_amount($stumble_username);
		if ( $stumble_fans == '' )
			$stumble_fans = 0;
		$total_array['stumbleupon'] = $stumble_fans;
	}

	/*==========  Pinterest  ==========*/
	if ($pinterest_username != '') {
		$pinterest_fans = pinterest_follower_amount($pinterest_username);
		if ( $pinterest_fans == '' )
			$pinterest_fans = 0;
		$total_array['pinterest'] = $pinterest_fans;
	}

	/*==========  Total  ==========*/
	if (empty($total_array)) 
		return;

	// $total   = $fb_fans + $tw_fans + $gp_fans + $stumble_fans + $pinterest_fans;
	$total = 0;
	foreach ($total_array as $value) {
		$total += $value;
	}
?>
	<li class="followers-total-item">
		<a class="followers-total-link" href="#"><i class="icon-forward hidden-phone"></i><em class="followers-total-value"><?php echo $total; ?></em></a>
		<ul class="followers-lists unstyled">
			<?php if (isset($fb_fans)) { ?>
				<li class="followers-item followers-facebook clearfix">
					<a href="<?php echo esc_url('https://www.facebook.com/'.$facebook_username); ?>" target="_blank"><i class="icon-facebook"></i><?php _e('Facebook', 'cherry'); ?></a>
					<span class="followers-count"><?php echo $fb_fans; ?></span>
				</li>
		<?php }
			if (isset($tw_fans)) {
				if (function_exists('getTweets')) { ?>
					<li class="followers-item followers-twitter clearfix">
						<a href="<?php echo esc_url('https://twitter.com/'.$twitter_username); ?>" target="_blank"><i class="icon-twitter" ></i><?php _e('Twitter', 'cherry'); ?></a>
						<span class='followers-count'><?php echo $tw_fans; ?></span>
					</li>
				<?php }
			}
			if (isset($gp_fans)) { ?>
				<li class="followers-item followers-google clearfix">
					<a href="https://plus.google.com/<?php echo $google_userID; ?>" target="_blank"><i class="icon-google-plus"></i><?php _e('Google+', 'cherry'); ?></a>
					<span class='followers-count'><?php echo $gp_fans; ?></span>
				</li>
		<?php }
			if (isset($stumble_fans)) { ?>
				<li class="followers-item followers-stumble clearfix">
					<a href="<?php echo esc_url('http://www.stumbleupon.com/stumbler/'.$stumble_username.'/likes'); ?>" target="_blank"><i class="icon-stumbleupon"></i><?php _e('StumbleUpon', 'cherry'); ?></a>
					<span class="followers-count"><?php echo $stumble_fans; ?></span>
				</li>
		<?php }
			if (isset($pinterest_fans)) { ?>
				<li class="followers-item followers-pinterest clearfix">
					<a href="<?php echo esc_url('http://pinterest.com/'.$pinterest_username); ?>" target="_blank"><i class="icon-pinterest"></i><?php _e('Pinterest', 'cherry'); ?></a>
					<span class="followers-count"><?php echo $pinterest_fans; ?></span>
				</li>
		<?php } ?>
			<!-- <li class="followers-item followers-envelope clearfix">
				<a href="#"><i class="icon-envelope"></i><?php _e('Tell a Friend', 'cherry'); ?></a>
			</li> -->
		</ul>
	</li>
<?php echo "<script type='text/javascript'>
		jQuery(function(){
			jQuery('ul.followers-total').superfish({
				animation: {opacity:'show',height:'show'},
				disableHI: true
			});
		});
	</script>"
?>
<!-- END FOLLOWERS -->