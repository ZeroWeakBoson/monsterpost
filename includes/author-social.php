<!-- BEGIN AUTHOR SOCIAL -->
<?php 
	if(isset($_GET['author_name'])) :
		$curauth = get_userdatabylogin($author_name);
	else :
		$curauth = get_userdata(intval($author));
	endif;
	
	$userContactArray = array();
	$user_email       = get_the_author_meta('user_email', $curauth->ID);
	$twitter          = get_user_meta($curauth->ID, 'twitter', true);
	$facebook         = get_user_meta($curauth->ID, 'facebook', true);
	$google_plus      = get_user_meta($curauth->ID, 'google_plus', true);
	$linkedin         = get_user_meta($curauth->ID, 'linkedin', true);
	$quora            = get_user_meta($curauth->ID, 'quora', true);
	
	if ( !empty($facebook) ) $userContactArray['facebook']       = 'https://www.facebook.com/' . $facebook;
	if ( !empty($twitter) ) $userContactArray['twitter']         = 'https://twitter.com/' . $twitter;
	if ( !empty($google_plus) ) $userContactArray['google-plus'] = 'https://plus.google.com/' . $google_plus;
	if ( !empty($linkedin) ) $userContactArray['linkedin-sign']  = 'http://www.linkedin.com/profile/view?id=' . $linkedin;
	if ( !empty($quora) ) $userContactArray['quora']             = 'http://www.quora.com/' . $quora;
	if ( !empty($user_email) ) $userContactArray['envelope']     = $user_email;

	if ( !empty($userContactArray) ) { ?>
		<ul class="followers-total author-social unstyled clearfix">
			<li class="followers-total-item">
				<a class="followers-total-link" href="#"><i class="icon-user-add"></i></a>
				<ul class="followers-lists unstyled">
				<?php foreach ($userContactArray as $key => $value) {
					if ( $key == 'envelope' ) { ?>
						<li class="followers-item followers-<?php echo $key; ?> clearfix">
							<a href="mailto:<?php echo $value;?>"><i class="icon-<?php echo $key; ?>"></i><?php _e('Email', 'cherry'); ?></a>
						</li>
					<?php } elseif ( $key == 'google-plus' ) { ?>
						<li class="followers-item followers-<?php echo $key; ?> clearfix">
							<a href="<?php echo esc_url($value);?>" target="_blank"><i class="icon-<?php echo $key; ?>"></i><?php _e('Google+', 'cherry'); ?></a>
						</li>
					<?php } else { ?>
						<li class="followers-item followers-<?php echo $key; ?> clearfix">
							<a href="<?php echo esc_url($value);?>" target="_blank"><i class="icon-<?php echo $key; ?>"></i><?php echo ucfirst(__($key, 'cherry')); ?></a>
						</li>
					<?php }
					} ?>
				</ul>
			</li>
		</ul>
	<?php }
?>
<?php echo "<script type='text/javascript'>
		jQuery(function(){
			jQuery('ul.followers-total').superfish({
				animation: {opacity:'show', height:'show'},
				disableHI: true
			});
		});
	</script>"
?>
<!-- END AUTHOR SOCIAL -->