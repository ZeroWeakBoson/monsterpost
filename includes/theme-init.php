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
		// update_option( 'posts_per_page', 8 );

		// Set permalink custom structure
		// update_option( 'permalink_structure', '/%category%/%postname%/' );
	}
	add_action( 'after_setup_theme', 'cherry_theme_setup' );
endif;

// Custom Taxonomy Code
// http://net.tutsplus.com/tutorials/wordpress/introducing-wordpress-3-custom-taxonomies/
add_action( 'init', 'moster_add_type_taxonomies', 0 );
function moster_add_type_taxonomies() {
	// Add new "Types" taxonomy to Posts
	register_taxonomy('type', 'post', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => __( 'Types', 'cherry' ),
			'singular_name' => __( 'Type', 'cherry' ),
			'search_items' =>  __( 'Search Types', 'cherry' ),
			'all_items' => __( 'All Types', 'cherry' ),
			'parent_item' => __( 'Parent Type', 'cherry' ),
			'parent_item_colon' => __( 'Parent Type:', 'cherry' ),
			'edit_item' => __( 'Edit Type', 'cherry' ),
			'update_item' => __( 'Update Type', 'cherry' ),
			'add_new_item' => __( 'Add New Type', 'cherry' ),
			'new_item_name' => __( 'New Type Name', 'cherry' ),
			'menu_name' => __( 'Types', 'cherry' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'types', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
?>