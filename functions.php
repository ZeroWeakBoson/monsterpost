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
	// include_once PARENT_DIR . '/includes/theme_shortcodes/shortcodes.php';
	// include_once PARENT_DIR . '/includes/theme_shortcodes/posts_grid.php';
	// include_once PARENT_DIR . '/includes/theme_shortcodes/posts_list.php';
	// include_once PARENT_DIR . '/includes/theme_shortcodes/mini_posts_list.php';
	// include_once PARENT_DIR . '/includes/theme_shortcodes/mini_posts_grid.php';
	// include_once PARENT_DIR . '/includes/theme_shortcodes/banner.php';
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
	include_once PARENT_DIR . '/includes/theme_shortcodes/related_posts.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/widget.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/subscribe_form.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/newsletter_form.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/contact_follow.php';
	include_once PARENT_DIR . '/includes/theme_shortcodes/interview.php';

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
	$formats = array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' );
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
		function no_more_jumping() {
			global $post;
			return '&nbsp;<a href="'.get_permalink($post->ID).'" class="btn-link">'.__('Read More', 'cherry').'</a>';
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
	if (!function_exists('contributors')) {
		function contributors() {
			global $wpdb;
			$authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
			foreach ($authors as $author ) {
				echo "<li class='author-item'>";
					echo "<figure class='featured-thumbnail'><a href=\"".get_bloginfo('url')."/author/";
						the_author_meta('user_nicename', $author->ID);
						echo "/\">";
						echo get_avatar($author->ID, 120);
					echo "<span class='zoom-icon'></span></a></figure>";
					echo "<div class='desc'>";
						echo "<h5><a href=\"".get_bloginfo('url')."/author/";
							the_author_meta('user_nicename', $author->ID);
							echo "/\">";
							the_author_meta('display_name', $author->ID);
						echo "</a></h5>";
					echo "</div>";
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
	}?>