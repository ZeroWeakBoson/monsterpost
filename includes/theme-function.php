<?php
// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 630;

// The excerpt based on words
function my_string_limit_words($string, $word_limit) {
	// $words = str_word_count($string, 1);
	$words = explode(' ', $string);
	if ( count($words) > $word_limit ) {
		$output = '';
		for ( $i = 0; $i < $word_limit; $i++ ) {
			$output .= $words[$i];
			$output .= ' ';
		}
		$output = trim($output);
		return $output.'&nbsp;&hellip;';
	} else {
		return implode(' ', $words);
	}
}

// The excerpt based on character
function my_string_limit_char($excerpt, $substr=0){
	$string = strip_tags(str_replace('...', '...', $excerpt));
	if ($substr>0) {
		$string = substr($string, 0, $substr);
	}
	return $string;
}

// Remove invalid tags
function remove_invalid_tags($str, $tags) {
	foreach($tags as $tag){
		$str = preg_replace('#^<\/'.$tag.'>|<'.$tag.'>$#', '', trim($str));
	}
	return $str;
}

// Remove Empty Paragraphs
add_filter('the_content', 'shortcode_empty_paragraph_fix');

function shortcode_empty_paragraph_fix($content) {
	$array = array (
			'<p>[' => '[', 
			']</p>' => ']', 
			']<br />' => ']'
	);
	$content = strtr($content, $array);
		return $content;
}

/**
 *
 * Add Thumb Column
 *
 */
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
	// for post and page
	add_theme_support('post-thumbnails', array( 'post', 'page' ) );
	function fb_AddThumbColumn($cols) {
		$cols['thumbnail'] = __('Thumbnail', 'cherry');
		return $cols;
	}
	function fb_AddThumbValue($column_name, $post_id) {
		$width = (int) 35;
		$height = (int) 35;
		if ( 'thumbnail' == $column_name ) {
			// thumbnail of WP 2.9
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			// image from gallery
			$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
			if ($thumbnail_id)
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			elseif ($attachments) {
				foreach ( $attachments as $attachment_id => $attachment ) {
					$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
				}
			}
			if ( isset($thumb) && $thumb ) {
				echo $thumb;
			} else {
				echo __('None', 'cherry');
			}
		}
	}
	// for posts
	add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
	// for pages
	add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
}


/**
 *
 * Show filter by categories for custom posts
 *
 */
function my_restrict_manage_posts() {
	global $typenow;
	$args=array( 'public' => true, '_builtin' => false ); 
	$post_types = get_post_types($args);
	if ( in_array($typenow, $post_types) ) {
	$filters = get_object_taxonomies($typenow);
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			wp_dropdown_categories(array(
				'show_option_all' => __('Show All '.$tax_obj->label, 'cherry' ),
				'taxonomy' => $tax_slug,
				'name' => $tax_obj->name,
				'orderby' => 'term_order',
				// 'selected' => $_GET[$tax_obj->query_var],
				'hierarchical' => $tax_obj->hierarchical,
				'show_count' => false,
				'hide_empty' => true
			));
		}
	}
}
function my_convert_restrict($query) {
	global $pagenow;
	global $typenow;
	if ($pagenow=='edit.php') {
		$filters = get_object_taxonomies($typenow);
		foreach ($filters as $tax_slug) {
			$var = &$query->query_vars[$tax_slug];
			if ( isset($var) ) {
				$term = get_term_by('id',$var,$tax_slug);
				// $var = $term->slug;
			}
		}
	}
}
add_action('restrict_manage_posts', 'my_restrict_manage_posts' );
add_filter('parse_query','my_convert_restrict');

/**
 *
 * Pagination
 *
 */
if ( !function_exists( 'pagination' ) ) {
	function pagination( $pages = '', $range = 1 ) {
		$showitems = ($range * 2) + 1;

		global $wp_query;
		$paged = (int) $wp_query->query_vars['paged'];
		if( empty($paged) || $paged == 0 ) $paged = 1;

		if ( $pages == '' ) {
			$pages = $wp_query->max_num_pages;
			if( !$pages ) {
				$pages = 1;
			}
		}
		if ( 1 != $pages ) {
			echo "<div class=\"pagination pagination__posts\"><ul>";
			if ( $paged > 2 && $paged > $range+1 && $showitems < $pages ) echo "<li class='first'><a href='".get_pagenum_link(1)."'>first</a></li>";
			if ( $paged > 1 && $showitems < $pages ) echo "<li class='prev'><a href='".get_pagenum_link($paged - 1)."'>prev</a></li>";

			for ( $i = 1; $i <= $pages; $i++ ) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					echo ($paged == $i)? "<li class=\"active\"><a href='#'>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
				}
			}

			if ( $paged < $pages && $showitems < $pages ) echo "<li class='next'><a href=\"".get_pagenum_link($paged + 1)."\">next</a></li>"; 
			if ( $paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages ) echo "<li class='last'><a href='".get_pagenum_link($pages)."'>last</a></li>";
			echo "</ul></div>\n";
		}
	}
}

/**
 *
 * Custom Comments Structure
 *
 */
if ( !function_exists( 'mytheme_comment' ) ) {
	function mytheme_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>" class="clearfix">
			<div id="comment-<?php comment_ID(); ?>" class="comment-body clearfix">
				<div class="wrapper">
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment->comment_author_email, 65 ); ?>
						<?php printf(__('<span class="author">%1$s</span>' ), get_comment_author_link()) ?>
					</div>
					<?php if ($comment->comment_approved == '0') : ?>
						<em><?php _e('Your comment is awaiting moderation.', 'cherry') ?></em>
					<?php endif; ?>
					<div class="extra-wrap">
						<?php comment_text() ?>
					</div>
				</div>
				<div class="wrapper">
					<div class="reply">
						<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
					<div class="comment-meta commentmetadata"><?php printf(__('%1$s', 'cherry' ), get_comment_date('F j, Y')) ?></div>
				</div>
			</div>
	<?php }
}

/**
 *
 * Returns the Google font stylesheet URL, if available.
 *
 */
function monster_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Parisienne, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$parisienne = _x( 'on', 'Parisienne: on or off', 'cherry' );

	if ( 'off' !== $parisienne ) {
		$font_families = array();

		if ( 'off' !== $parisienne )
			$font_families[] = 'Parisienne:400';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}
	return $fonts_url;
}

/**
 * Breadcrumbs
 *
 */
if ( !function_exists( 'monster_breadcrumbs' ) ) {
	function monster_breadcrumbs() {

	$showOnHome  = 1; // 1 - show "breadcrumbs" on home page, 0 - hide
	$delimiter   = '<li class="divider"></li>'; // divider
	$home        = get_the_title( get_option('page_on_front', true) ); // text for link "Home"
	$showCurrent = 1; // 1 - show title current post/page, 0 - hide
	$before      = '<li class="active">'; // open tag for active breadcrumb
	$after       = '</li>'; // close tag for active breadcrumb

	global $post;
	$homeLink = home_url();

	if (is_front_page()) {
		if ($showOnHome == 1) 
			echo '<ul class="breadcrumb breadcrumb__t"><li><a href="' . $homeLink . '">' . $home . '</a><li></ul>';
		} else {
			echo '<ul class="breadcrumb breadcrumb__t"><li><a href="' . $homeLink . '">' . $home . '</a></li>' . $delimiter;

			if ( is_home() ) {
				$blog_text = of_get_option('blog_text');
				if ($blog_text == '' || empty($blog_text)) {
					echo "Blog";
				}
				echo $before . $blog_text . $after;
			} 
			elseif ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
				echo $before . "Category Archives".': "' . single_cat_title('', false) . '"' . $after;
			} 
			elseif ( is_search() ) {
				echo $before . "Search for" . ': "' . get_search_query() . '"' . $after;
			} 
			elseif ( is_day() ) {
				echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
				echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li> ' . $delimiter . ' ';
				echo $before . get_the_time('d') . $after;
			} 
			elseif ( is_month() ) {
				echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $delimiter . ' ';
				echo $before . get_the_time('F') . $after;
			} 
			elseif ( is_year() ) {
				echo $before . get_the_time('Y') . $after;
			}
			elseif ( is_tax(get_post_type().'_category') ) {
				$post_name = get_post_type();
				echo $before . ucfirst($post_name) . ' ' . 'category' . ': ' . single_cat_title( '', false ) . $after;
			}
			elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_id = get_the_ID();
					$post_name = get_post_type();
					$post_type = get_post_type_object(get_post_type());
					// echo '<li><a href="' . $homeLink . '/' . $post_type->labels->name . '/">' . $post_type->labels->name . '</a></li>';

					$terms = get_the_terms( $post_id, $post_name.'_category');
					if ( $terms && ! is_wp_error( $terms ) ) {
						echo '<li><a href="' .get_term_link(current($terms)->slug, $post_name.'_category') .'">'.current($terms)->name.'</a></li>';
						echo ' ' . $delimiter . ' ';
					} else {
						// echo '<li><a href="' . $homeLink . '/' . $post_type->labels->name . '/">' . $post_type->labels->name . '</a></li>';
					}

					if ($showCurrent == 1)
						echo $before . get_the_title() . $after;
				} else {
					$cat = get_the_category();
					if (!empty($cat)) {
						$cat  = $cat[0];
						$cats = get_category_parents($cat, TRUE, '</li>' . $delimiter . '<li>');
						if ($showCurrent == 0) 
							$cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
						echo '<li>' . substr($cats, 0, strlen($cats)-4);
					}
					if ($showCurrent == 1) 
						echo $before . get_the_title() . $after;
				}
			}
			elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				if ( isset($post_type) ) {
					echo $before . $post_type->labels->singular_name . $after;
				}
			} 
			elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat    = get_the_category($parent->ID);
				if ( isset($cat) && !empty($cat)) {
					$cat    = $cat[0];
					echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
				}
				if ($showCurrent == 1) 
					echo $before . get_the_title() . $after;
			} 
			elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) 
					echo $before . get_the_title() . $after;
			} 
			elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page          = get_page($parent_id);
					$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
					$parent_id     = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
				}
				if ($showCurrent == 1) 
					echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			} 
			elseif ( is_tag() ) {
				echo $before . "Tag archives" . ': "' . single_tag_title('', false) . '"' . $after;
			} 
			elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo $before . "by" . ' ' . $userdata->display_name . $after;
			} 
			elseif ( is_404() ) {
				echo $before . '404' . $after;
			}
			echo '</ul>';
		}
	} // end breadcrumbs()
} ?>