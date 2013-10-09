<?php
// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 630;

// The excerpt based on words
function my_string_limit_words($string, $word_limit) {
	$words = str_word_count($string, 1);
	if ( count($words) > $word_limit ) {
		$output = '';
		for ( $i=0; $i < $word_limit; $i++ ) {
			$output .= $words[$i];
			$output .= ' ';
		}
		$output = trim($output);
		return $output.'&nbsp;... ';
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
**/
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
**/
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
**/
if ( !function_exists( 'pagination' ) ) {
	function pagination($pages = '', $range = 1) { 
		$showitems = ($range * 2)+1; 
		global $paged;
		
		if(empty($paged)) $paged = 1;

		if($pages == '') {
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages) {
				$pages = 1;
			}
		}

		if(1 != $pages) {
			echo "<div class=\"pagination pagination__posts\"><ul>";
			// if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li class='first'><a href='".get_pagenum_link(1)."'>".__('First', 'cherry')."</a></li>";
			if($paged > 1 && $showitems < $pages) echo "<li class='prev'><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;&nbsp;".__('Prev', 'cherry')."</a></li>";

			for ($i=1; $i <= $pages; $i++) {
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
					echo ($paged == $i)? "<li class=\"active\"><a href=''>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a></li>";
				}
			}

			if ($paged < $pages && $showitems < $pages) echo "<li class='next'><a href=\"".get_pagenum_link($paged + 1)."\">".__('Next', 'cherry')."&nbsp;&rsaquo;</a></li>"; 
			// if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li class='last'><a href='".get_pagenum_link($pages)."'>".__('Last', 'cherry')."</a></li>";
			echo "</ul></div>\n";
		}
	}
}

/**
*
* Custom Comments Structure
*
**/
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
**/
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
?>