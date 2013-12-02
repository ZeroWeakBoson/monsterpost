<?php
/*	Register and load javascript
/*-----------------------------------------------------------------------------------*/
function my_script() {
	wp_register_script('modernizr', PARENT_URL.'/js/modernizr.js', array('jquery'), '2.0.6');
	wp_register_script('superfish', PARENT_URL.'/js/superfish.js', array('jquery'), '1.7.4', true);
	wp_register_script('waypoints', PARENT_URL.'/js/waypoints.min.js', array('jquery'), '2.0.3', true);
	wp_register_script('waypoints-sticky', PARENT_URL.'/js/waypoints-sticky.min.js', array('jquery'), '2.0.3', true);
	wp_register_script('magnific-popup', PARENT_URL.'/js/jquery.magnific-popup.min.js', array('jquery'), '0.9.9', true);
	wp_register_script('mobilemenu', PARENT_URL.'/js/jquery.mobilemenu.js', array('jquery'), '1.0', true);
	wp_register_script('flexslider', PARENT_URL.'/js/jquery.flexslider-min.js', array('jquery'), '2.1', true);
	wp_register_script('fittext', PARENT_URL.'/js/jquery.fittext.js', array('jquery'), '1.1', true);
	wp_register_script('spin', PARENT_URL.'/js/spin.min.js', array('jquery'), '0.8.0', true);
	wp_register_script('ladda', PARENT_URL.'/js/ladda.min.js', array('jquery'), '0.8.0', true);
	wp_register_script('filestyle', PARENT_URL.'/js/bootstrap-filestyle.js', array('jquery'), '1.0.3', true);
	wp_register_script('custom', PARENT_URL.'/js/custom.js', array('jquery'), '1.0', true);

	if ( is_front_page() || is_home() ) {
		wp_register_script('carouFredSel', PARENT_URL.'/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery'), '6.2.1', true);
		wp_enqueue_script('carouFredSel');
	}
	if ( is_single() ) {
		wp_register_script('socialite', PARENT_URL.'/js/socialite.js', array('jquery'), '2.0', true);
		wp_enqueue_script('socialite');
	}
	wp_enqueue_script('modernizr');
	wp_enqueue_script('superfish');
	wp_enqueue_script('waypoints');
	wp_enqueue_script('waypoints-sticky');
	wp_enqueue_script('magnific-popup');
	wp_enqueue_script('swfobject');
	wp_enqueue_script('mobilemenu');
	wp_enqueue_script('flexslider');
	wp_enqueue_script('fittext');
	wp_enqueue_script('spin');
	wp_enqueue_script('ladda');
	wp_enqueue_script('filestyle');
	wp_enqueue_script('custom');
	
	// Bootstrap Scripts
	wp_enqueue_script('bootstrap', PARENT_URL.'/bootstrap/js/bootstrap.min.js', array('jquery'), '2.3.0');
}
add_action('wp_enqueue_scripts', 'my_script');

/*	Register and load styles
/*-----------------------------------------------------------------------------------*/
function my_styles() {
	wp_register_style('bootsrap', PARENT_URL . '/bootstrap/css/bootstrap.css', false, '2.3.0', 'all');
	wp_register_style('resposive', PARENT_URL . '/bootstrap/css/responsive.css', false, '2.3.0', 'all');
	wp_register_style('icomoon', PARENT_URL.'/font/font-icomoon/style.css', false, '1.0', 'all');
	wp_register_style('font-awesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', false, '3.2.1', 'all');
	wp_register_style('magnific', PARENT_URL.'/css/magnific-popup.css', false, '0.9.9', 'all');
	wp_register_style('ladda', PARENT_URL.'/css/ladda.min.css', false, '0.8.0', 'all');
	wp_register_style('style', get_stylesheet_uri(), false, '1.0', 'all');

	wp_enqueue_style('bootsrap');
	wp_enqueue_style('resposive');
	wp_enqueue_style('monster-fonts', monster_fonts_url(), array(), null);
	wp_enqueue_style('icomoon');
	wp_enqueue_style('font-awesome');
	wp_enqueue_style('magnific');
	wp_enqueue_style('ladda');
	wp_enqueue_style('style');
}
add_action('wp_enqueue_scripts', 'my_styles');

/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/
function tz_admin_js($hook) {
	if ($hook == 'post.php' || $hook == 'post-new.php') {
		wp_register_script('tz-admin', PARENT_URL . '/js/jquery.custom.admin.js', 'jquery');
		wp_enqueue_script('tz-admin');
	}
}
add_action('admin_enqueue_scripts', 'tz_admin_js', 10, 1);
?>