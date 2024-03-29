<?php
	/*-----------------------------------------------------------------------------------*/
	/* Set Proper Parent/Child theme paths for inclusion
	/*-----------------------------------------------------------------------------------*/
	@define( 'PARENT_DIR', get_template_directory() );
	@define( 'CHILD_DIR', get_stylesheet_directory() );
	@define( 'PARENT_URL', get_template_directory_uri() );
	@define( 'CHILD_URL', get_stylesheet_directory_uri() );
	@define( 'FILE_WRITEABLE', is_writeable(PARENT_DIR.'/style.css') );

	// disqus shortname
	@define( 'DISQUS_SHORTNAME', 'tm-monsterblog' );

	/*
	 * Variables array init
	 *
	 */
	$variablesArray = array(
		'textColor'      =>	'#000000',
		'baseFontFamily' =>	'#000000',
		'baseFontSize'   =>	'#000000',
		'baseLineHeight' =>	'#000000'
		);

	/*
	 * Helper function to return the theme option value.
	 * If no value has been saved, it returns $default.
	 * Needed because options are saved as serialized strings.
	 */
	if ( !function_exists( 'of_get_option' ) ) {
		function of_get_option($name, $default = false) {

			$optionsframework_settings = get_option('optionsframework');

			// Gets the unique option id
			$option_name = $optionsframework_settings['id'];

			if ( get_option($option_name) ) {
				$options = get_option($option_name);
			}
			if ( isset($options[$name]) ) {
				return $options[$name];
			} else {
				return $default;
			}
		}
	}

	/**
	*
	* JS global variables
	*
	**/
	function monster_js_global_variables(){
		$output = "<script>";
		$output .="\nvar POST_EXISTS = 0;\n";
		$output .= "</script>\n";
		echo $output;
	}
	add_action('wp_head', 'monster_js_global_variables');

	/*
	 * Unlink less cache files
	 *
	 */
	function clean_less_cache() {

		$bootstrapInput = PARENT_DIR .'/less/bootstrap.less';
		$themeInput     = PARENT_DIR .'/less/style.less';

		$cacheFile1 = $bootstrapInput.".cache";
		$cacheFile2 = $themeInput.".cache";
		if (file_exists($cacheFile1)) unlink($cacheFile1);
		if (file_exists($cacheFile2)) unlink($cacheFile2);
	}

	if (( (is_admin() && isset($_GET['activated'] )) || (is_admin() && ($pagenow == "themes.php")) ) && FILE_WRITEABLE) {
		clean_less_cache();
	}

	// Loading Scripts and Stylesheets
	include_once PARENT_DIR . '/includes/theme-scripts.php';

	// Widget and Sidebar
	include_once PARENT_DIR . '/includes/sidebar-init.php';
	include_once PARENT_DIR . '/includes/register-widgets.php';

	// Theme initialization
	include_once PARENT_DIR . '/includes/theme-init.php';

	// Additional function
	include_once PARENT_DIR . '/includes/theme-function.php';

	// Shortcodes
	include_once PARENT_DIR . '/includes/theme_shortcodes/columns.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/alert.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/tabs.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/toggle.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/html.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/misc.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/service_box.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/post_cycle.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/progressbar.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/table.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/hero_unit.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/categories.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/tags.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/contact_form.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/feedback_form.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/subscribe_form.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/newsletter_form.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/contact_follow.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/interview.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/gallery.php';
	if ( !class_exists('efficientRelatedPosts') ) {
		include_once PARENT_DIR . '/includes/theme_shortcodes/related_posts.php';
	}

	// tinyMCE includes
	include_once PARENT_DIR . '/includes/theme_shortcodes/tinymce/tinymce_shortcodes.php';

	// Aqua Resizer for image cropping and resizing on the fly
	include_once PARENT_DIR . '/includes/aq_resizer.php';

	// Add the postmeta
	include_once PARENT_DIR . '/includes/theme-postmeta.php';

	// Loading options.php for theme customizer
	include_once PARENT_DIR . '/options.php';

	// Plugin Activation
	include_once PARENT_DIR . '/includes/register-plugins.php';

	// WP popular posts
	if ( !class_exists('WordpressPopularPosts') ) {
		include_once PARENT_DIR . '/includes/wordpress-popular-posts.php';
	}

	// Embedding LESS compile
	if ( !class_exists('lessc') ) {
		include_once (PARENT_DIR .'/includes/lessc.inc.php');
	}
	include_once (PARENT_DIR .'/includes/less-compile.php');

	// removes detailed login error information for security
	add_filter('login_errors', create_function('$a', "return null;"));

	// remove elements from the header
	add_filter('the_generator', create_function('', 'return "";'));
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');

	// custom admin login header logo
	add_action( 'login_head', 'monster_login_logo');
	function monster_login_logo() {
		echo '<style type="text/css">
		h1 a { background-image:url('. CHILD_URL . '/images/logo.png' . ') !important; background-size: 295px 48px !important; width: 295px !important; height: 48px !important; padding: 0 !important; margin: 0 0 0 9px !important;}
		</style>
		<script type="text/javascript">window.onload = function(){document.getElementById("login").getElementsByTagName("a")[0].href = "'. home_url() . '";document.getElementById("login").getElementsByTagName("a")[0].title = "Go to site";}</script>';
	}

	// remove meta boxes from wordpress dashboard for all users
	add_action('wp_dashboard_setup', 'monster_remove_dashboard_widgets' );
	function monster_remove_dashboard_widgets(){
		// Globalize the metaboxes array, this holds all the widgets for wp-admin
		global $wp_meta_boxes;

		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
		unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	}

	/*
	 * Loads the Options Panel
	 *
	 * If you're loading from a child theme use stylesheet_directory
	 * instead of template_directory
	 */
	if ( !function_exists( 'optionsframework_init' ) ) {
		define( 'OPTIONS_FRAMEWORK_DIRECTORY', PARENT_URL . '/admin/' );
		include_once dirname( __FILE__ ) . '/admin/options-framework.php';
	}

	// Removes Trackbacks from the comment cout
	if (!function_exists('comment_count')) {
		add_filter('get_comments_number', 'comment_count', 0);

		function comment_count( $count ) {
			if ( ! is_admin() ) {
				global $id;
				$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
				return count($comments_by_type['comment']);
			} else {
				return $count;
			}
		}
	}

	// add ie conditional html5 shim to header
	function add_ie_html5_shim() {
		echo '<!--[if lt IE 8]>';
		echo '<div style="clear: both; text-align:center; position: relative;"">';
		echo '<a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode">';
		echo '<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" alt="" /></a>';
		echo '</div>';
		echo '<![endif]-->';

		echo '<!--[if lt IE 9]>';
		echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
		echo '<![endif]-->';
	}
	add_action('wp_head', 'add_ie_html5_shim');

	// Post Formats
	$formats = array( 'audio', 'gallery', 'image', 'video' );
	add_theme_support( 'post-formats', $formats );
	add_post_type_support( 'post', 'post-formats' );

	// Custom excpert length
	if(!function_exists('new_excerpt_length')) {
		function new_excerpt_length($length) {
			// return (of_get_option('excerpt_count')=='') ? 20 : of_get_option('excerpt_count');
			return 100;
		}
		add_filter('excerpt_length', 'new_excerpt_length');
	}

	// enable shortcodes in sidebar
	add_filter('widget_text', 'do_shortcode');

	// enable shortcodes in excerpt
	add_filter('the_excerpt', 'do_shortcode');

	// custom excerpt ellipses for 2.9+
	if(!function_exists('custom_excerpt_more')) {
		function custom_excerpt_more($more) {
			return __('Read More', 'cherry') . ' &raquo;';
		}
		add_filter('excerpt_more', 'custom_excerpt_more');
	}

	// no more jumping for read more link
	if(!function_exists('no_more_jumping')) {
		function no_more_jumping($post_id) {
			global $post;
			return '&nbsp;<a href="'.get_permalink( $post_id ).'" class="btn-link">'.__('Read More', 'cherry').'</a>';
		}
		add_filter('excerpt_more', 'no_more_jumping');
	}

	// add custom class to .more-link (<!--more-->)
	if (function_exists('add_morelink_classes')) {
		function add_morelink_classes( $more_link_html ) {
			// Example - else this var has no scope inside the function
			global $var_declared_outside_function;

			$new_classes = array( 'btn-link');
			$more_link_html = str_replace( 'class="more-link', 'class="' . implode( ' ', $new_classes ) . ' more-link', $more_link_html );

			return $more_link_html;
		}
		add_filter( 'the_content_more_link', 'add_morelink_classes' );
	}

	// category id in body and post class
	if(!function_exists('category_id_class')) {
		function category_id_class($classes) {
			global $post;
			foreach((get_the_category()) as $category)
				$classes [] = 'cat-' . $category->cat_ID . '-id';
				return $classes;
		}
		add_filter('post_class', 'category_id_class');
		add_filter('body_class', 'category_id_class');
	}

	add_filter('body_class','cherry_layout_class');
	function cherry_layout_class($classes) {
		if ( is_archive() && !is_category() && !is_author() && !is_tag() )
			$classes[] = 'is-custom-archive';

		return $classes;
	}

	// Threaded Comments
	if(!function_exists('enable_threaded_comments')) {
		function enable_threaded_comments(){
			if (!is_admin()) {
				if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
					wp_enqueue_script('comment-reply');
				}
			}
		}
		add_action('get_header', 'enable_threaded_comments');
	}

	// Google+ followers amount
	if ( !function_exists('google_plus_follower_amount') ) {
		function google_plus_follower_amount($account){
			$response = @file_get_contents("https://plus.google.com/u/0/$account/posts?hl=en");
			preg_match('/<span role="button" class="a-n Cl7aRc" tabindex="0">(.*?)<\/span>/s', $response, $following);
			if (isset($following) && !empty($following)){
				$count = $following[1];
				$circles = preg_replace('/[^0-9_]/', '', $count);
				return $circles;
			}
			return 0;
		}
	}

	// StumbleUpon followers amount
	if ( !function_exists('stumble_follower_amount') ) {
		function stumble_follower_amount($account){
			$start = '/stumbler/'.$account.'/connections/followers';
			$finish = 'Followers';
			$response = file_get_contents('http://www.stumbleupon.com/'.$start);
			$r = explode( $start, $response );
			if ( isset($r[1]) ){
				$r = explode($finish, $r[1]);
				return preg_replace('/[^0-9]/', '', $r[0]);
			}
			return '';
		}
	}

	// Pinterest followers amount
	if ( !function_exists('pinterest_follower_amount') ) {
		function pinterest_follower_amount($account){
			$start    = '/'.$account.'/followers/';
			$middle   = 'buttonText';
			$finish   = 'Followers';
			$response = file_get_contents('http://pinterest.com/'.$account.'/followers/');
			$r        = explode( $start, $response );

			if ( is_array($r) && isset($r[count($r)-1]) ) {
				$r = explode($middle, $r[count($r)-1]);

				if ( is_array($r) && isset($r[1]) ) {
					$r = explode($finish, $r[1]);
				}
				return preg_replace('/[^0-9]/', '', $r[0]);
			}
			return '';
		}
	}

	if (!function_exists('the_post_thumbnail_caption')) {
		function the_post_thumbnail_caption() {
			global $post;

			$thumbnail_id    = get_post_thumbnail_id($post->ID);
			$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

			if ( $thumbnail_image && isset($thumbnail_image[0]) && !empty($thumbnail_image[0]->post_content) ) {
				return '<span class="wp-caption-text">'.$thumbnail_image[0]->post_content.'</span>';
			}
		}
	}

	// Add Extra Contact Methods to User Profiles
	if (!function_exists('my_user_contactmethods')) {
		add_filter('user_contactmethods', 'my_user_contactmethods');

		function my_user_contactmethods($user_contactmethods) {

			unset($user_contactmethods['yim']);
			unset($user_contactmethods['aim']);
			unset($user_contactmethods['jabber']);

			$user_contactmethods['facebook']    = 'Facebook Username';
			$user_contactmethods['twitter']     = 'Twitter Username';
			$user_contactmethods['google_plus'] = 'Google+ ID';
			$user_contactmethods['linkedin']    = 'LinkedIn ID';
			$user_contactmethods['quora']       = 'Quora Username';
			return $user_contactmethods;
		}
	}

	// Author List with Avatars
	if (!function_exists('get_monster_contributors')) {
		function get_monster_contributors() {
			global $wpdb;
			$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
			foreach ($authors as $author ) {
				echo "<li class='author-item'>";
					echo "<a href=\"".get_bloginfo('url')."/author/";
						the_author_meta('user_nicename', $author->ID);
						echo "/\">";
							echo get_avatar($author->ID, 120);
						echo "<span class='zoom-icon'></span>";
						echo "<h5>";
							the_author_meta('display_name', $author->ID);
						echo "</h5>";
					echo "</a>";
				echo "</li>";
			}
		}
	}

	// Integrating Disqus Into WordPress Without a Plugin
	if (!function_exists('disqus_embed')) {
		function disqus_embed($disqus_shortname) {
			global $post;
			wp_enqueue_script('disqus_embed','http://'.$disqus_shortname.'.disqus.com/embed.js');
			echo '<div id="disqus_thread"></div>
			<script type="text/javascript">
				var disqus_shortname = "'.$disqus_shortname.'",
					disqus_title = "'.$post->post_title.'",
					disqus_url = "'.get_permalink($post->ID).'",
					disqus_identifier = "'.$disqus_shortname.'-'.$post->ID.'";
			</script>';
		}
	}

	// Fetching the Comment Count
	if (!function_exists('disqus_count')) {
		function disqus_count($disqus_shortname) {
			wp_enqueue_script('disqus_count','http://'.$disqus_shortname.'.disqus.com/count.js');
			echo '<a href="'. get_permalink() .'#disqus_thread"></a>';
		}
	}

	// Get author comment count
	if (!function_exists('author_comment_count')) {
		function author_comment_count( $author ){
			global $wpdb;

			$sql = "SELECT COUNT(comment_ID)
			FROM {$wpdb->comments}
			WHERE comment_author = '$author'";
			$a = $wpdb->get_var($sql);
			return $a;
		}
	}

	// allow html in category and taxonomy descriptions
	remove_filter( 'pre_term_description', 'wp_filter_kses' );
	remove_filter( 'pre_link_description', 'wp_filter_kses' );
	remove_filter( 'pre_link_notes', 'wp_filter_kses' );
	remove_filter( 'term_description', 'wp_kses_data' );

	// Database install
	if ( !function_exists('wpp_install')) {

		add_action('after_setup_theme', 'wpp_install');
		function wpp_install() {
			global $wpdb;

			$wpdb->show_errors();
			$sql = "";
			$charset_collate = "";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

			if ( ! empty($wpdb->charset) ) $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
			if ( ! empty($wpdb->collate) ) $charset_collate .= " COLLATE $wpdb->collate";

			// set table name
			$table = $wpdb->prefix . "popularpostsdata";

			// does popularpostsdata table exists?
			if ( $wpdb->get_var("SHOW TABLES LIKE '$table'") != $table ) { // fresh setup
				$sql = "CREATE TABLE " . $table . " ( UNIQUE KEY id (postid), postid int(10) NOT NULL, day datetime NOT NULL default '0000-00-00 00:00:00', last_viewed datetime NOT NULL default '0000-00-00 00:00:00', pageviews int(10) default 1 ) $charset_collate; CREATE TABLE " . $table ."cache ( UNIQUE KEY compositeID (id, day_no_time), id int(10) NOT NULL, day datetime NOT NULL default '0000-00-00 00:00:00', day_no_time date NOT NULL default '0000-00-00', pageviews int(10) default 1 ) $charset_collate;";
			} else {

				// check if cahe table is missing
				$cache = $table . "cache";

				if ( $wpdb->get_var("SHOW TABLES LIKE '$cache'") != $cache ) {
					$sql = "CREATE TABLE $cache ( UNIQUE KEY compositeID (id, day_no_time), id int(10) NOT NULL, day datetime NOT NULL default '0000-00-00 00:00:00', day_no_time date NOT NULL default '0000-00-00', pageviews int(10) default 1 ) $charset_collate;";
				} else { // check if any column is missing

					// get table columns
					$cacheFields = $wpdb->get_results("SHOW FIELDS FROM $cache", ARRAY_A);
					$alter_day = true;
					$add_daynotime = true;

					foreach ($cacheFields as $column) {
						// check if day column is type datetime
						if ($column['Field'] == 'day') {
							if ($column['Type'] == 'datetime') {
								$alter_day = false;
							}
						}

						// check if day_no_time field exists
						if ($column['Field'] == 'day_no_time') {
							$add_daynotime = false;
						}
					}

					if ($alter_day) { // day column is not datimetime, so change it
						$wpdb->query("ALTER TABLE $cache CHANGE day day datetime NOT NULL default '0000-00-00 00:00:00';");
					}

					if ($add_daynotime) { // day_no_time column is missing, add it
						$wpdb->query("ALTER TABLE $cache ADD day_no_time date NOT NULL default '0000-00-00';");
						$wpdb->query("UPDATE $cache SET day_no_time = day;");
					}

					$cacheIndex = $wpdb->get_results("SHOW INDEX FROM $cache", ARRAY_A);
					if ($cacheIndex[0]['Key_name'] == "id") { // if index is id-day change to id-day_no_time
						$wpdb->query("ALTER TABLE $cache DROP INDEX id, ADD UNIQUE KEY compositeID (id, day_no_time);");
					}

					/*
					ALTER TABLE wp_popularpostsdatacache DROP INDEX id, ADD UNIQUE KEY compositeID (id, day_no_time);
					*/
				}
			}
			dbDelta($sql);
		}
	}

	// Navigation with description
	if (! class_exists('description_walker')) {
		class description_walker extends Walker_Nav_Menu {
			function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
				global $wp_query;
				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

				$class_names = $value = '';
				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
				$class_names = ' class="'. esc_attr( $class_names ) . '"';
				$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
				$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
				$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
				$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

				$description  = ! empty( $item->description ) ? '<span class="desc">'.esc_attr( $item->description ).'</span>' : '';

				if($depth != 0) {
					$description = $append = $prepend = "";
				}

				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before;

				if (isset($prepend))
					$item_output .= $prepend;

				$item_output .= apply_filters( 'the_title', $item->title, $item->ID );

				if (isset($append))
					$item_output .= $append;

				$item_output .= $description.$args->link_after;
				$item_output .= '</a>';
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}
	}

	// Get Free Templates
	add_action( 'monster_free_template', 'get_monster_free_template' );
	add_action( 'wp_ajax_get_monster_free_template', 'get_monster_free_template' );
	add_action( 'wp_ajax_nopriv_get_monster_free_template', 'get_monster_free_template' );

	function get_monster_free_template() {
		$idObj = get_category_by_slug( 'free-website-templates' );
		$catID = $idObj->term_id;

		$defaults = array(
			'type'   => '',
			'cat'    => $catID,
			'offset' => 0,
			'num'    => 20 // 20
		);

		$tax_query = '';

		if ( !empty($_POST) && array_key_exists('type', $_POST) ) {
			$defaults['type'] = $_POST['type'];

			if ( $defaults['type'] != 'all' ) {
				$tax_query = array(
					array(
						'taxonomy' => 'type',
						'field'    => 'slug',
						'terms'    => $defaults['type']
					)
				);
			}
		}
		if ( !empty($_POST) && array_key_exists('cat', $_POST) ) {
			$defaults['cat']  = $_POST['cat'];
		}
		if ( !empty($_POST) && array_key_exists('offset', $_POST) ) {
			$defaults['offset'] = intval( $_POST['offset'] );
		}
		if ( !empty($_POST) && array_key_exists('num', $_POST) ) {
			$defaults['num'] = intval( $_POST['num'] );
		}

		// WP_Query arguments
		$args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'cat'                 => $defaults['cat'],
			'posts_per_page'      => $defaults['num'],
			'offset'              => $defaults['offset'],
			'ignore_sticky_posts' => true,
			'order'               => 'DESC',
			'orderby'             => 'date',
			'tax_query'           => $tax_query
		);

		// The Query
		$free_query = new WP_Query( $args );

		// The Loop
		if ( $free_query->have_posts() ) {
			$counter = 1;

			echo '<div class="row-fluid">';

			while ( $free_query->have_posts() ) {
				$free_query->the_post();

				$post_id = get_the_ID();

				// if ( !empty($_POST) && array_key_exists('cat', $_POST) ) {
				// 	$val = $_POST['cat'];
				// 	if ( $val != $catID ) {
				// 		add_post_meta( $post_id, 'filter-cat', $val, true );
				// 	}
				// 	update_option( 'select-filter-cat', $val );
				// }

				if ( $counter > 4 ) {
					echo '<div class="row-fluid">';
					$counter = 1;
				}

				echo '<div id="post-' . $post_id . '" class="span3">';
						$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
						$url            = $attachment_url['0'];
						$image          = aq_resize($url, 254, 134, true);

						if ($image) {
							echo '<figure class="thumbnail">';
								echo '<a href="' . get_permalink( $post_id ) . '" title="Permanent Link to ' . the_title('', '', false) . '">';
									echo '<img src="' . $image . '" alt="' . the_title('', '', false) . '">';
								echo '</a>';
							echo '</figure>';
						}

					echo '<header class="post-header">';
						echo '<h4>';
							echo '<a href="' . get_permalink( $post_id ) . '" title="Permanent Link to ' . the_title('', '', false) . '">'. the_title('', '', false) .'</a>';
						echo '</h4>';
					echo '</header>';
				echo '</div>';

				if ( $counter == 4 ) echo '</div><!--.row-fluid--><hr>';
					$counter++;
				}

			// if (( $counter % 4 ) == 0) {
			if ( $counter < 4 ) {
				echo '</div><!--.row-fluid--><hr>';
			}
		}
		// Restore original Post Data
		wp_reset_postdata();

		// temp WP_Query arguments
		$temp_args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'cat'                 => $defaults['cat'],
			'posts_per_page'      => $defaults['num'],
			'offset'              => $defaults['offset'] + $defaults['num'],
			'ignore_sticky_posts' => true,
			'order'               => 'DESC',
			'orderby'             => 'date',
			'tax_query'           => $tax_query
		);
		// temp The Query
		$temp_free_query = new WP_Query( $temp_args );
		if ( $temp_free_query->have_posts() ) {
			echo "<script>";
				echo "POST_EXISTS = 1;";
			echo "</script>";
		} else {
			echo "<script>";
				echo "POST_EXISTS = 0;";
			echo "</script>";
		}
		// Restore original Post Data
		wp_reset_postdata();

		if ( !empty($_POST) && array_key_exists('type', $_POST) ) {
			exit;
		}
	}

// Get images for posts from Free Website Templates category
if ( !function_exists('monster_free_template_gallery') ) {
	function monster_free_template_gallery() {
		$args = array(
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
			'post_type'      => 'attachment',
			'post_parent'    => get_the_ID(),
			'post_mime_type' => 'image',
			'post_status'    => null,
			'numberposts'    => -1,
		);
		$attachments = get_posts($args);

		if ($attachments) :
			$random = uniqid();
			if ( count($attachments) > 8 ) {
				$pagerType = 'short';
			} else {
				$pagerType = 'full';
			} ?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery('#bxslider_<?php echo $random ?>').bxSlider({
						pagerType: "<?php echo $pagerType; ?>"
					});
				});
			</script>
			<!-- Slider -->
			<ul id="bxslider_<?php echo $random ?>" class="bxslider unstyled">
				<?php
					foreach ($attachments as $attachment) :
						$attachment_url = wp_get_attachment_image_src( $attachment->ID, 'full' );
						$url            = $attachment_url['0'];
						$image          = aq_resize($url, 800, 400, true);
					?>
				<li><img src="<?php echo $image; ?>" alt="<?php echo apply_filters('the_title', $attachment->post_title); ?>"/></li>
				<?php
					endforeach;
				?>
			</ul>
		<?php
		else:
			get_template_part('includes/post-formats/post-thumb');
		endif;
	}
}


// Get Related Posts in single post from Free Website Templates category
if ( !function_exists('monster_free_template_related_posts') ) {
	function monster_free_template_related_posts( $params ) {
		// WP_Query arguments
		$args = array (
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'post__not_in'   => array($params['id']),
			'cat'            => $params['cat'],
			'posts_per_page' => 4,
			'order'          => 'DESC',
			'orderby'        => 'date',
			'tax_query'      => $params['type']
		);

		// The Query
		$related_query = new WP_Query( $args );

		// The Loop
		if ( $related_query->have_posts() ) {
			echo '<div class="free-related-posts">';
				echo '<h3>' . __('Related Posts','cherry') . '</h3>';
				echo '<ul class="unstyled row-fluid">';
				while ( $related_query->have_posts() ) {
					$related_query->the_post();
					echo '<li class="free-related-posts_item span3">';

						if ( has_post_thumbnail() ) {
							$thumb   = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
							$image   = aq_resize( $img_url, 155, 120, true ); //resize & crop img

							echo '<figure class="thumbnail">';
								echo '<a href="' . get_permalink( get_the_ID() ) . '" title="Permanent Link to ' . the_title('', '', false) . '">';
									echo '<img src="' . $image . '" alt="' . the_title('', '', false) . '">';
								echo '</a>';
							echo '</figure>';
						}
						echo '<h5><a href="' . get_permalink( get_the_ID() ) . '">' . the_title('', '', false) . '</a></h5>';
					echo '</li>';
				}
				echo '</ul>';
			echo '</div>';
		} else {
			// no posts found
			echo '<p>' . __('No repaled posts', 'cherry') . '</p>';
		}

		// Restore original Post Data
		wp_reset_postdata();
	}
}

// http://werdswords.com/force-sub-categories-use-the-parent-category-template/
add_filter( 'category_template', 'monster_subcategory_hierarchy' );
function monster_subcategory_hierarchy() {
	$category = get_queried_object();

	$parent_id = $category->category_parent;

	$templates = array();

	if ( $category->slug == 'free-website-templates' ) {
		$templates[] = 'category.php';
		return locate_template( $templates );
	}

	if ( $parent_id == 0 ) {
		// Use default values from get_category_template()
		$templates[] = "category-{$category->slug}.php";
		$templates[] = "category-{$category->term_id}.php";
		$templates[] = 'category.php';
	} else {
		// Create replacement $templates array
		$parent = get_category( $parent_id );

		// Current first
		$templates[] = "category-{$category->slug}.php";
		$templates[] = "category-{$category->term_id}.php";

		// Parent second
		$templates[] = "category-{$parent->slug}.php";
		$templates[] = "category-{$parent->term_id}.php";
		$templates[] = 'category.php';
	}
	return locate_template( $templates );
}

// Get Carousel Posts
add_action( 'monster_carousel_posts', 'get_monster_carousel_posts' );
add_action( 'wp_ajax_get_monster_carousel_posts', 'get_monster_carousel_posts' );
add_action( 'wp_ajax_nopriv_get_monster_carousel_posts', 'get_monster_carousel_posts' );
function get_monster_carousel_posts() {

	if ( !empty($_POST) && array_key_exists('filterVal', $_POST) ) {
		$value = $_POST['filterVal'];
	} else {
		$value = 'videos';
	}

	//get all terms (e.g. tags or post tags), then display all posts in each term
	$taxonomy   = 'tag';
	$param_type = 'tag';
	$term_args  = array(
		'orderby' => 'name',
		'order'   => 'ASC'
	);
	$terms = get_terms( $taxonomy, $term_args );
	if ( $terms ) {
		$args = array(
			"$param_type"         => $value,
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'showposts'           => 10,
			'ignore_sticky_posts' => 1,
			'tax_query'           => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => array( 'learn-web-design' )
				)
			)
			// 'meta_key'            => 'tz_filter',
			// 'meta_value'          => 'true'
		);
		$carousel_query = new WP_Query($args);
		if( $carousel_query->have_posts() ) {
			while ($carousel_query->have_posts()) : $carousel_query->the_post();
				$post_id = get_the_ID();
				$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
				$url            = $attachment_url['0'];
				$image          = aq_resize($url, 180, 180, true);

				echo "<li class='$value'>";
					if ($image) {
						echo '<figure class="thumbnail">';
							echo '<a class="carousel-link" href="' . get_permalink( $post_id ) . '" title="Permanent Link to ' . the_title('', '', false) . '">';
								echo '<img src="' . $image . '" alt="' . the_title('', '', false) . '">';
							echo '</a>';
						echo '</figure>';
					}
					echo '<div class="desc hidden-phone">
							<time datetime="'.get_the_time('Y-m-d\TH:i:s', $post_id).'">' . get_the_date() . '</time>
							<h5><a href="' . get_permalink( $post_id ) . '" title="' . the_title('', '', false) . '">' . my_string_limit_words( get_the_title(), 5 ) . '</a></h5>
						</div>';
				echo '</li>';
			endwhile;
			echo '<li class="' . $value . ' view-all-item">
				<a href=' . home_url("/tag/$value") . ' class="view-all-link" target="_blank">
					<div class="view-all-text">
						<strong>' . __('View all', 'cherry') . '</strong>
						<span class="view-all-tag">' . str_replace('-', ' ', $value) . '</span>
					</div>
					<div class="middle-hack"></div>
				</a>
			</li>';
		}
		wp_reset_postdata(); // Restore global post data stomped by the_post().
	}
	if ( !empty($_POST) && array_key_exists('filterVal', $_POST) ) {
		exit;
	}
}

function loop_monster_top_post( $posts, $is_meta = false ) {
	global $post, $top_post_side;
	$side_array = array( "left", "right top", "right bottom" );

	if ( !empty($top_post_side) ) {
		$diff = array_diff( $side_array, $top_post_side );
	}

	$tmp_post = $post;
	foreach( $posts as $post ) : setup_postdata($post);
		if ( $is_meta ) {
			$top_post_side[$post->ID] = get_post_meta( $post->ID, 'tz_top_check', true );
		} else {
			if ( isset($diff) ) {
				$top_post_side[$post->ID] = array_shift($diff);
			} else {
				$top_post_side[$post->ID] = array_shift($side_array);
			}
		}
		get_monster_top_post( $post->ID, $top_post_side[$post->ID] );
	endforeach;
	wp_reset_postdata();
	// return value $post
	$post = $tmp_post;
}

function get_monster_top_post( $post_id, $side ) {
	$side            = sanitize_html_class( $side );
	$post_permalink  = get_permalink( $post_id );
	$post_title      = esc_html( get_the_title( $post_id ) );
	$post_title_attr = esc_attr( strip_tags( get_the_title( $post_id ) ) );
	if ( ( has_excerpt($post_id) ) && ( 'left' === $side ) ) {
		$post_excerpt = wp_strip_all_tags( get_the_excerpt() );
	}

	echo "<div class='$side-side'>";

		if ( has_post_thumbnail( $post_id ) ) {
			$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full' );
			$url = $attachment_url['0'];
			if ( 'left' === $side ) {
				$image = aq_resize($url, 435, 268, true);
			} else {
				$image = aq_resize($url, 235, 140, true);
			}
		}

		echo "<div class='top-posts-item'>";

			if ( has_post_thumbnail( $post_id ) ) {
				echo "<figure class='featured-thumbnail thumbnail'>";
					echo "<a href='$post_permalink' title='$post_title'>";
						echo "<img src='$image' alt='$post_title' />";
					echo "</a>";
					$categories = get_the_category();
					if( !empty($categories) ){
						$category = $categories[0];
						echo "<span class='post-cat'>$category->cat_name</span>";
					}
				echo "</figure>";
			}

			echo "<div class='post_meta'>";
				_e('by ', 'cherry');
				echo " <a href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "'>" . get_the_author_meta( 'display_name' ) . "</a>";
				echo " &nbsp<em class='post_meta-separator'></em>&nbsp; <time datetime='".get_the_time( 'Y-m-d\TH:i:s', $post_id )."'>".get_the_date()."</time>";
			echo "</div><!--.post_meta-->";

			if ( !has_post_thumbnail( $post_id ) ) {
				$categories = get_the_category();
				if( !empty($categories) ){
					$category = $categories[0];
					echo __('in ', 'cherry') . '<a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a>';
				}
			}

			echo "<h4><a href='$post_permalink' title='$post_title_attr'>$post_title</a></h4>";
			if ( isset($post_excerpt) ) {
				echo "<p class='excerpt'>" . my_string_limit_words( $post_excerpt, 30 ) . "</p>";
			}

		echo "</div><!--.top-posts-item-->";

	echo "</div><!--.$side-side-->";
}
?>