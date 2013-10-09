<?php if ( !function_exists( 'cherry_theme_setup' ) ):
	function cherry_theme_setup() {

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// This theme uses post thumbnails
		if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 335, 200, true ); // Normal post thumbnails
		}

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// custom menu support
		add_theme_support( 'menus' );
		if ( function_exists( 'register_nav_menus' ) ) {
			register_nav_menus(
				array(
					'header_menu' => 'Header Menu',
					'footer_menu' => 'Footer Menu'
				)
			);
		}

		// Loading theme textdomain
		load_theme_textdomain( 'cherry', PARENT_DIR . '/languages' );

		// Set post count for blog
		update_option( 'posts_per_page', 8 );

		// Set permalink custom structure
		update_option( 'permalink_structure', '/%category%/%postname%/' );
	}
	add_action( 'after_setup_theme', 'cherry_theme_setup' );
endif;
?>