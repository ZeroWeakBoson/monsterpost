<?php

// ==== Post Format meta boxes ====================================== //


// === Define Metabox Fields ====================================== //

$prefix = 'tz_';

$meta_box_link = array(
	'id' => 'tz-meta-box-link',
	'title' =>  __('Link Settings', 'cherry'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('The URL','cherry'),
				"desc" => __('Insert the URL you wish to link to.','cherry'),
				"id" => $prefix."link_url",
				"type" => "text",
				"std" => ""
			),
	),
);

$meta_box_image = array(
	'id' => 'tz-meta-box-image',
	'title' =>  __('Image Settings', 'cherry'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Enable Lightbox','cherry'),
				"desc" => __('Check this to enable the lightbox.','cherry'),
				"id" => $prefix."image_lightbox",
				"type" => "select",
				'std' => 'no',
				'options' => array('yes', 'no'),
			),
	),
);

$meta_box_check = array(
	'id' => 'tz-meta-box-check',
	'title' =>  __('Go to Top Posts', 'cherry'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Yep, I\'m top post.','cherry'),
				"desc" => __('Check it, If you want to mark this post as a top.','cherry'),
				"id" => $prefix."top_check",
				"type" => "text",
				"std" => ""
			),
	),
);

$meta_box_filter = array(
	'id' => 'tz-meta-box-filter',
	'title' =>  __('Go to Filterable Carousel', 'cherry'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Post from a Filterable Carousel.','cherry'),
				"desc" => __('Check it, If you want to send this post to Filterable Carousel.','cherry'),
				"id" => $prefix."filter",
				"type" => "text",
				"std" => ""
			),
	),
);

$meta_box_source = array(
	'id' => 'tz-meta-box-source',
	'title' =>  __('Source', 'cherry'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('URL to the source','cherry'),
				"desc" => __('If you use sided media content, please type URL to it.','cherry'),
				"id" => $prefix."source_url",
				"type" => "text",
				"std" => ""
			),
	),
);

$meta_box_audio = array(
	'id' => 'tz-meta-box-audio',
	'title' =>  __('Audio', 'cherry'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Audio shortcode (duplicate)','cherry'),
				"desc" => __('Please, duplicate here inserted in the post\'s content audio shortcode.','cherry'),
				"id" => $prefix."audio_source",
				"type" => "text",
				"std" => ""
			),
	),
);

$meta_box_video = array(
	'id' => 'tz-meta-box-video',
	'title' =>  __('Video', 'cherry'),
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array( "name" => __('Video source (duplicate)','cherry'),
				"desc" => __('Please, duplicate here inserted in the post\'s content video source.','cherry'),
				"id" => $prefix."video_source",
				"type" => "text",
				"std" => ""
			),
	),
);


add_action('admin_menu', 'tz_add_box');

/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/

function tz_add_box() {
	global $meta_box_link, $meta_box_image, $meta_box_check, $meta_box_filter, $meta_box_source, $meta_box_audio, $meta_box_video;

	add_meta_box($meta_box_image['id'], $meta_box_image['title'], 'tz_show_box_image', $meta_box_image['page'], $meta_box_image['context'], $meta_box_image['priority']);
	add_meta_box($meta_box_link['id'], $meta_box_link['title'], 'tz_show_box_link', $meta_box_link['page'], $meta_box_link['context'], $meta_box_link['priority']);
	add_meta_box($meta_box_check['id'], $meta_box_check['title'], 'tz_show_box_check', $meta_box_check['page'], $meta_box_check['context'], $meta_box_check['priority']);
	add_meta_box($meta_box_filter['id'], $meta_box_filter['title'], 'tz_show_box_filter', $meta_box_filter['page'], $meta_box_filter['context'], $meta_box_filter['priority']);
	add_meta_box($meta_box_source['id'], $meta_box_source['title'], 'tz_show_box_source', $meta_box_source['page'], $meta_box_source['context'], $meta_box_source['priority']);
	add_meta_box($meta_box_audio['id'], $meta_box_audio['title'], 'tz_show_box_audio', $meta_box_audio['page'], $meta_box_audio['context'], $meta_box_audio['priority']);
	add_meta_box($meta_box_video['id'], $meta_box_video['title'], 'tz_show_box_video', $meta_box_video['page'], $meta_box_video['context'], $meta_box_video['priority']);
}


/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function tz_show_box_link() {
	global $meta_box_link, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($meta_box_link['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			
			//If Text
			case 'text':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;

		}

	}

	echo '</table>';
}

function tz_show_box_image() {
	global $meta_box_image, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($meta_box_image['fields'] as $field) {
		
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		switch ($field['type']) {

			
			//If Select
			case 'select':
			
				echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option';
					if ($meta == $option ) { 
						echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';
			
			break;

		}

	}

	echo '</table>';
}

function tz_show_box_check() {
	global $meta_box_check, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($meta_box_check['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
			
			//If Checkbox
			case 'text':
			
			echo '<tr>',
				'<th style="width:15%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';

			echo '<input type="checkbox" name="', $field['id'], '" id="<?php echo $id ?>" ', checked($meta, 'true'), ' value="true" />';
			
			break;
		}
	}

	echo '</table>';
}

function tz_show_box_filter() {
	global $meta_box_filter, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($meta_box_filter['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
			
			//If Checkbox
			case 'text':
			
			echo '<tr>',
				'<th style="width:15%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';

			echo '<input type="checkbox" name="', $field['id'], '" id="<?php echo $id ?>" ', checked($meta, 'true'), ' value="true" />';
			
			break;
		}
	}

	echo '</table>';
}

function tz_show_box_source() {
	global $meta_box_source, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($meta_box_source['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			
			//If Text
			case 'text':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;

		}

	}

	echo '</table>';
}

function tz_show_box_audio() {
	global $meta_box_audio, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($meta_box_audio['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			
			//If Text
			case 'text':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;

		}

	}

	echo '</table>';
}

function tz_show_box_video() {
	global $meta_box_video, $post;

	// Use nonce for verification
	echo '<input type="hidden" name="tz_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($meta_box_video['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {

			
			//If Text
			case 'text':
			
			echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;

		}

	}

	echo '</table>';
}

add_action('save_post', 'tz_save_data');


/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/

function tz_save_data($post_id) {
	global $meta_box_link, $meta_box_image, $meta_box_check, $meta_box_filter, $meta_box_source, $meta_box_audio, $meta_box_video;

	// verify nonce
	if (!isset($_POST['tz_meta_box_nonce']) || !wp_verify_nonce($_POST['tz_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	foreach ($meta_box_link['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

	foreach ($meta_box_image['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

	foreach ($meta_box_check['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

	foreach ($meta_box_filter['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

	foreach ($meta_box_source['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

	foreach ($meta_box_audio['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}

	foreach ($meta_box_video['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}