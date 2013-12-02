<?php
/**
 *
 * HTML Shortcodes
 *
 */

if ( !function_exists('monster_button_shortcode') ) {
	// Button
	function monster_button_shortcode($atts, $content = null) {
		extract(shortcode_atts(
			array(
				'link'    => 'http://www.google.com',
				'text'    => 'Button Text',
				'size'    => 'normal',
				'style'   => '',
				'target'  => '_self',
				'display' => '',
				'class'   => '',
				'icon'    => 'no'
		), $atts));
		
		$output =  '<a href="'.$link.'" title="'.$text.'" class="btn btn-'.$style.' btn-'.$size.' btn-'.$display.' '.$class.'" target="'.$target.'">';
		if ($icon != 'no') {
			$output .= '<i class="icon-'.$icon.'"></i>';
		}
		$output .= $text;
		$output .= '</a><!-- .btn -->';

		return $output;
	}
	add_shortcode('button', 'monster_button_shortcode');
}

if ( !function_exists('monster_map_shortcode') ) {
	// Map
	function monster_map_shortcode($atts, $content = null) {

		extract(shortcode_atts(
			array(
				'src'    => '',
				'width'  => '',
				'height' => ''
		), $atts));
		
		$output =  '<div class="google-map">';
				$output .= '<iframe src="'.$src.'" frameborder="0" width="'.$width.'" height="'.$height.'" marginwidth="0" marginheight="0" scrolling="no">';
				$output .= '</iframe>';
			$output .= '</div>';

		return $output;
	}
	add_shortcode('map', 'monster_map_shortcode');
}

if ( !function_exists('monster_dropcap_shortcode') ) {
	// Dropcaps
	function monster_dropcap_shortcode($atts, $content = null) {

		$output = '<span class="dropcap">';
		$output .= do_shortcode($content);
		$output .= '</span><!-- .dropcap (end) -->';

		return $output;
	}
	add_shortcode('dropcap', 'monster_dropcap_shortcode');
}

// Horizontal Rule
function hr_shortcode($atts, $content = null) {

	$output = '<div class="hr"><!-- .hr (end) --></div>';

	return $output;
}
add_shortcode('hr', 'hr_shortcode');

// Small Horizontal Rule
function sm_hr_shortcode($atts, $content = null) {

	$output = '<div class="sm_hr"></div>';

	return $output;
}
add_shortcode('sm_hr', 'sm_hr_shortcode');

// Spacer
function spacer_shortcode($atts, $content = null) {

	$output = '<div class="spacer"><!-- .spacer (end) --></div>';

	return $output;
}
add_shortcode('spacer', 'spacer_shortcode');

// Clear
function clear_shortcode($atts, $content = null) {

	$output = '<div class="clear"></div>';

	return $output;
}
add_shortcode('clear', 'clear_shortcode');

// Address
function address_shortcode($atts, $content = null) {
	
	$output = '<address>';
	$output .= do_shortcode($content);
	$output .= '</address> <!-- address (end) -->';

	return $output;
}
add_shortcode('address', 'address_shortcode');


// Lists

// Unstyled
function list_un_shortcode($atts, $content = null) {
	$output = '<div class="list unstyled">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	return $output;
}
add_shortcode('list_un', 'list_un_shortcode');

// Check List
function check_list_shortcode($atts, $content = null) {
	$output = '<div class="list styled check-list">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	return $output;
}
add_shortcode('check_list', 'check_list_shortcode');

// Check2 List
function check2_list_shortcode($atts, $content = null) {
	$output = '<div class="list styled check2-list">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	return $output;
}
add_shortcode('check2_list', 'check2_list_shortcode');

// Arrow List
function arrow_list_shortcode($atts, $content = null) {
	$output = '<div class="list styled arrow-list">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	return $output;
}
add_shortcode('arrow_list', 'arrow_list_shortcode');

// Arrow2 List
function arrow2_list_shortcode($atts, $content = null) {
	$output = '<div class="list styled arrow2-list">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	return $output;
}
add_shortcode('arrow2_list', 'arrow2_list_shortcode');

// Star List
function star_list_shortcode($atts, $content = null) {
	$output = '<div class="list styled star-list">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	return $output;
}
add_shortcode('star_list', 'star_list_shortcode');

// Plus List
function plus_list_shortcode($atts, $content = null) {
	$output = '<div class="list styled plus-list">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	return $output;
}
add_shortcode('plus_list', 'plus_list_shortcode');

// Minus List
function minus_list_shortcode($atts, $content = null) {
	$output = '<div class="list styled minus-list">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	return $output;
}
add_shortcode('minus_list', 'minus_list_shortcode');

// Custom List
function custom_list_shortcode($atts, $content = null) {
	$output = '<div class="list styled custom-list">';
	$output .= do_shortcode($content);
	$output .= '</div>';
	return $output;
}
add_shortcode('custom_list', 'custom_list_shortcode');

// Label
function label_shortcode($atts, $content = null) {

	extract(shortcode_atts(
		array(
			'style' => '',
			'icon' => ''
	), $atts));

	$output = '<span class="label label-'.$style.'">';
	if ($icon != "") {
		$output .= '<i class="'.$icon.'"></i>';
	}
	$output .= $content .'</span>';

	return $output;
}
add_shortcode('label', 'label_shortcode');

if ( !function_exists('monster_media_desc_shortcode') ) {
	// Media description
	function monster_media_desc_shortcode( $atts , $content = null ) {

		// Code
		return '<div class="media-desc">'.$content.'</div>';
	}
	add_shortcode( 'media_desc', 'monster_media_desc_shortcode' );
}

// Text Highlight
function highlight_shortcode($atts, $content = null) {

	$output = '<span class="text-highlight">';
	$output .= do_shortcode($content);
	$output .= '</span><!-- .highlight (end) -->';

	return $output;
}
add_shortcode('highlight', 'highlight_shortcode');

// Template URL
function template_url_shortcode($atts, $content = null) {

	$template_url = home_url();
	return $template_url;
}
add_shortcode('template_url', 'template_url_shortcode');

// Extra Wrap
function extra_wrap_shortcode($atts, $content = null) {

	$output = '<div class="extra-wrap">';
		$output .= do_shortcode($content);
	$output .= '</div>';

	return $output;
}
add_shortcode('extra_wrap', 'extra_wrap_shortcode');

if ( !function_exists('monster_icon_shortcode') ) {
	// Icon
	function monster_icon_shortcode($atts, $content = null) {
		extract(shortcode_atts(
			array(
				'icon_font'       => '',
				'icon_font_size'  => '',
				'icon_font_color' => '',
				'custom_class'    => '',
				'align'           => ''
		), $atts));

		$icon_font = ($icon_font != '')? strtolower($icon_font) : "icon-question";
		$icon_font_size = ($icon_font_size != '')? $icon_font_size : "14px";
		if(stripos($icon_font_size, "px")===false && stripos($icon_font_size, "em")===false){
			$icon_font_size = (int) $icon_font_size . "px";
		}
		$icon_font_color = ($icon_font_color != '')? $icon_font_color : "#000";
		$output = '<figure class="icon-holder align'.$align.' aligntext'.$align.' "><i class="'.$icon_font.' '.$custom_class.'" style="color:'.$icon_font_color.'; font-size:'.$icon_font_size.'; line-height:1.2em;"></i></figure>';
		return $output;
	}
	add_shortcode('icon', 'monster_icon_shortcode');
} ?>