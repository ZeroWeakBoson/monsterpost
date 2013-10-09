<?php get_header(); ?>

<div class="container">
	<div id="content">
		<div class="row">
			<div class="span6 offset3 error404-holder">
				<div class="error404-holder_num">4<span>0</span>4</div>
				<div class="hgroup_404">
					<?php echo '<h1>' . __('Page not found', 'cherry') . '</h1>'; ?>
					<?php echo '<h4>' . __('It might have been removed or is temporarily unavailable.', 'cherry') . '</h4>'; ?>
				</div>
				<div class="clear"></div>
				
				<?php echo '<h4>' . __('Try a search box to find what you\'re looking for:', 'cherry') . '</h4>'; ?>
				<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
				<?php echo '<span class="or">' . __('or', 'cherry') . '</span>'; ?>
				<ul class="error404-nav unstyled clearfix">
					<?php 
						if (array_key_exists('REQUEST_SCHEME', $_SERVER)) {
							$request_scheme = $_SERVER['REQUEST_SCHEME'] . '://';
						} else {
							$request_scheme = '';
						}
						if (array_key_exists('HTTP_HOST', $_SERVER)) {
							$http_host = $_SERVER['HTTP_HOST'];
						} else {
							$http_host = '';
						}
						if (array_key_exists('REDIRECT_URL', $_SERVER)) {
							$redirect_url = $_SERVER['REDIRECT_URL'];
						} else {
							$redirect_url = '';
						}

						$back = $request_scheme . $http_host . $redirect_url;
						$pos = strrpos($back, "/");
						if ($pos !== false) {
							$back = substr($back, 0, $pos);
						}
						if (isset($back) && ($back !='')) {
							echo '<li class="error404-nav-item"><a href="'.$back.'">'. __('Go Back', 'cherry') .'</a></li>';
						}
					?>
					<li class="error404-nav-item error404-nav-spacer">&nbsp;&frasl;&nbsp;</li>
					<li class="error404-nav-item"><a href="<?php echo home_url(); ?>"><?php _e('Go to Home Page', 'cherry'); ?></a></li>
					<li class="error404-nav-item error404-nav-spacer">&nbsp;&frasl;&nbsp;</li>
					<li class="error404-nav-item"><a href="<?php echo home_url('/contact'); ?>"><?php _e('Contact Us', 'cherry'); ?></a></li>
				</ul>
			</div>
		</div><!--#error404 .post-->
	</div><!--#content-->
</div>

<?php get_footer(); ?>