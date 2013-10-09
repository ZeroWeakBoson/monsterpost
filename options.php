<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

if(!function_exists('optionsframework_option_name')) {
	function optionsframework_option_name() {
		// This gets the theme name from the stylesheet (lowercase and without spaces)
		$themename = 'cherry';

		$optionsframework_settings = get_option('optionsframework');
		$optionsframework_settings['id'] = $themename;
		update_option('optionsframework', $optionsframework_settings);
	}
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */
if(!function_exists('optionsframework_options')) {
	function optionsframework_options() {

		// Logo type
		$logo_type = array(
			"image_logo" => __("Image Logo", 'cherry'),
			"text_logo"  => __("Text Logo", 'cherry')
		);

		// Search box in the header
		$g_search_box = array(
			"no"  => "No",
			"yes" => "Yes"
		);

		// Superfish fade-in animation
		$sf_f_animation_array = array(
			"show"  => "Enable fade-in animation",
			"false" => "Disable fade-in animation"
		);

		// Superfish slide-down animation
		$sf_sl_animation_array = array(
			"show"  => "Enable slide-down animation",
			"false" => "Disable slide-down animation"
		);

		// Superfish animation speed
		$sf_speed_array = array(
			"slow" => "Slow","normal" => "Normal",
			"fast" => "Fast"
		);

		// Superfish arrows markup
		$sf_arrows_array = array(
			"true" => "Yes",
			"false" => "No"
		);

		// Fonts
		$typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
		asort($typography_mixed_fonts);

		// Footer menu
		$footer_menu_array = array("true" => "Yes","false" => "No");


		// Meta for blog
		$post_meta_array = array("true" => "Yes","false" => "No");

		// Meta for blog
		$post_excerpt_array = array(
			"true" => "Yes",
			"false" => "No"
		);

		// If using image radio buttons, define a directory path
		$imagepath = PARENT_URL . '/includes/images/';

		$options = array();

		$options[] = array( "name" => "General",

							"type" => "heading");

							

		$options['google_mixed_3'] = array( 'name' => 'Body Text',

							'desc' => 'Choose your prefered font for body text. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',

							'id' => 'google_mixed_3',

							'std' => array( 'size' => '16px', 'lineheight' => '22px', 'face' => 'PT Sans, sans-serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#333333'),

							'type' => 'typography',

							'options' => array(

									'faces' => $typography_mixed_fonts )

							);



		$options['h1_heading'] = array( 'name' => 'H1 Heading',

							'desc' => 'Choose your prefered font for H1 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',

							'id' => 'h1_heading',

							'std' => array( 'size' => '35px', 'lineheight' => '40px', 'face' => 'Georgia, "Times New Roman", Times, serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#333333'),

							'type' => 'typography',

							'options' => array(

									'faces' => $typography_mixed_fonts )

							);

		

		$options['h2_heading'] = array( 'name' => 'H2 Heading',

							'desc' => 'Choose your prefered font for H2 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',

							'id' => 'h2_heading',

							'std' => array( 'size' => '30px', 'lineheight' => '35px', 'face' => 'Georgia, "Times New Roman", Times, serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#333333'),

							'type' => 'typography',

							'options' => array(

									'faces' => $typography_mixed_fonts )

							);

							

		$options['h3_heading'] = array( 'name' => 'H3 Heading',

							'desc' => 'Choose your prefered font for H3 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',

							'id' => 'h3_heading',

							'std' => array( 'size' => '22px', 'lineheight' => '35px', 'face' => 'Georgia, "Times New Roman", Times, serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#333333'),

							'type' => 'typography',

							'options' => array(

									'faces' => $typography_mixed_fonts )

							);

		

		$options['h4_heading'] = array( 'name' => 'H4 Heading',

							'desc' => 'Choose your prefered font for H4 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',

							'id' => 'h4_heading',

							'std' => array( 'size' => '17px', 'lineheight' => '20px', 'face' => 'Georgia, "Times New Roman", Times, serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#333333'),

							'type' => 'typography',

							'options' => array(

									'faces' => $typography_mixed_fonts )

							);

							

		$options['h5_heading'] = array( 'name' => 'H5 Heading',

							'desc' => 'Choose your prefered font for H5 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',

							'id' => 'h5_heading',

							'std' => array( 'size' => '14px', 'lineheight' => '20px', 'face' => 'PT Sans, sans-serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#333333'),

							'type' => 'typography',

							'options' => array(

									'faces' => $typography_mixed_fonts )

							);

							

		$options['h6_heading'] = array( 'name' => 'H6 Heading',

							'desc' => 'Choose your prefered font for H6 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',

							'id' => 'h6_heading',

							'std' => array( 'size' => '12px', 'lineheight' => '18px', 'face' => 'PT Sans, sans-serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#333333'),

							'type' => 'typography',

							'options' => array(

									'faces' => $typography_mixed_fonts )

							);

		

		$options['g_search_box_id'] = array( "name" => "Display search box?",

							"desc" => "Display search box in the header?",

							"id" => "g_search_box_id",

							"type" => "radio",

							"std" => "yes",

							"options" => $g_search_box);

		

		$options['custom_css'] = array( "name" => "Custom CSS",

							"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",

							"id" => "custom_css",

							"std" => "",

							"type" => "textarea");

		


		$options[] = array( "name" => "Logo & Favicon",

							"type" => "heading");

		

		$options['logo_type'] = array( "name" => "What kind of logo?",

							"desc" => "Select whether you want your main logo to be an image or text. If you select 'image' you can put in the image url in the next option, and if you select 'text' your Site Title will be shown instead.",

							"id" => "logo_type",

							"std" => "image_logo",

							"type" => "radio",

							"options" => $logo_type);



		$options['logo_typography'] = array( 'name' => 'Logo Typography',

							'desc' => 'Choose your prefered font for menu. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',

							'id' => 'logo_typography',

							'std' => array( 'size' => '60px', 'lineheight' => '60px', 'face' => 'Helvetica', 'style' => 'bold', 'character'  => 'latin', 'color' => '#d84a38'),

							'type' => 'typography',

							'options' => array(

									'faces' => $typography_mixed_fonts )

							);

		

		$options['logo_url'] = array( "name" => "Logo Image Path",

							"desc" => "Click Upload or Enter the direct path to your <strong>logo image</strong>. For example <em>http://your_website_url_here/wp-content/themes/MonsterPost/images/logo.png</em>",

							"id" => "logo_url",

							"std" => get_stylesheet_directory_uri() . "/images/logo.png",

							"type" => "upload");

							

		$options['favicon'] = array( "name" => "Favicon",

							"desc" => "Click Upload or Enter the direct path to your <strong>favicon</strong>. For example <em>http://your_website_url_here/wp-content/themes/MonsterPost/favicon.ico</em>",

							"id" => "favicon",

							"std" => get_stylesheet_directory_uri() . "/favicon.ico",

							"type" => "upload");

		

		$options[] = array( "name" => "Navigation",

							"type" => "heading");



		$options['menu_typography'] = array( 'name' => 'Menu Typography',

							'desc' => 'Choose your prefered font for menu. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',

							'id' => 'menu_typography',

							'std' => array( 'size' => '17px', 'lineheight' => '21px', 'face' => 'Georgia, "Times New Roman", Times, serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#353535'),

							'type' => 'typography',

							'options' => array(

									'faces' => $typography_mixed_fonts )

							);

		

		$options['sf_delay'] = array( "name" => "Delay",

							"desc" => "miliseconds delay on mouseout.",

							"id" => "sf_delay",

							"std" => "1000",

							"class" => "tiny",

							"type" => "text");

		

		$options['sf_f_animation'] = array( "name" => "Fade-in animation",

							"desc" => "Fade-in animation.",

							"id" => "sf_f_animation",

							"std" => "show",

							"type" => "radio",

							"options" => $sf_f_animation_array);

		

		$options['sf_sl_animation'] = array( "name" => "Slide-down animation",

							"desc" => "Slide-down animation.",

							"id" => "sf_sl_animation",

							"std" => "show",

							"type" => "radio",

							"options" => $sf_sl_animation_array);

		

		$options['sf_speed'] = array( "name" => "Speed",

							"desc" => "Animation speed.",

							"id" => "sf_speed",

							"type" => "select",

							"std" => "normal",

							"class" => "tiny", //mini, tiny, small

							"options" => $sf_speed_array);

		

		$options['sf_arrows'] = array( "name" => "Arrows markup",

							"desc" => "Do you want to generate arrow mark-up?",

							"id" => "sf_arrows",

							"std" => "false",

							"type" => "radio",

							"options" => $sf_arrows_array);

		

		

		$options[] = array( "name" => "Blog",

							"type" => "heading");

		

		$options['blog_text'] = array( "name" => "Blog Title",

							"desc" => "Enter Your Blog Title used on Blog page.",

							"id" => "blog_text",

							"std" => "It's going to need a bigger coverage",

							"type" => "text");

		

		$options['blog_read_also'] = array( "name" => "Read Also Posts Title",

							"desc" => "Enter Your Title used on Single Post page for read also posts.",

							"id" => "blog_read_also",

							"std" => "Read Also",

							"type" => "text");

		

		$options['blog_sidebar_pos'] = array( "name" => "Sidebar position",

							"desc" => "Choose sidebar position.",

							"id" => "blog_sidebar_pos",

							"std" => "left",

							"type" => "images",

							"options" => array(

								'left' => $imagepath . '2cl.png',

								'right' => $imagepath . '2cr.png',)

							);

		

		$options['post_meta'] = array( "name" => "Enable Meta for blog posts?",

							"desc" => "Enable or Disable meta information for blog posts.",

							"id" => "post_meta",

							"std" => "true",

							"type" => "radio",

							"options" => $post_meta_array);

		

		$options['post_excerpt'] = array( "name" => "Enable excerpt for blog posts?",

							"desc" => "Enable or Disable excerpt for blog posts.",

							"id" => "post_excerpt",

							"std" => "false",

							"type" => "radio",

							"options" => $post_excerpt_array);



		$options['excerpt_count'] = array( "name" => "Excerpt words",

							"desc" => "Excerpt length (words).",

							"id" => "excerpt_count",

							"std" => "20",

							"class" => "small",

							"type" => "text");



		

		$options[] = array( "name" => "Footer",

							"type" => "heading");

		

		$options['footer_text'] = array( "name" => "Footer copyright text",

							"desc" => "Enter text used in the right side of the footer. HTML tags are allowed.",

							"id" => "footer_text",

							"std" => "Copyright &copy; 2013<br><span>Powered by <a href='http://www.cherryframework.com/' target='_blank'>Cherry Framework</a></span>",

							"type" => "textarea");

		

		$options['ga_code'] = array( "name" => "Google Analytics Code",

							"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",

							"id" => "ga_code",

							"std" => "",

							"type" => "textarea");

		

		$options['feed_url'] = array( "name" => "Feedburner URL",

							"desc" => "Feedburner is a Google service that takes care of your RSS feed. Paste your Feedburner URL here to let readers see it in your website.",

							"id" => "feed_url",

							"std" => "",

							"type" => "text");

		

		$options['footer_menu'] = array( "name" => "Display Footer menu?",

							"desc" => "Do you want to display footer menu?",

							"id" => "footer_menu",

							"std" => "true",

							"type" => "radio",

							"options" => $footer_menu_array);



		$options['footer_menu_typography'] = array( 'name' => 'Footer Menu Typography',

							'desc' => 'Choose your prefered font for menu. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the <a href="http://www.google.com/webfonts">Google Web Fonts</a> library.</em>',

							'id' => 'footer_menu_typography',

							'std' => array( 'size' => '17px', 'lineheight' => '21px', 'face' => 'Georgia, "Times New Roman", Times, serif', 'style' => 'normal', 'character'  => 'latin', 'color' => '#353535'),

							'type' => 'typography',

							'options' => array(

									'faces' => $typography_mixed_fonts )

							);

		// Social
		$options[] = array( 
							"name" => "Social",
							"type" => "heading"
		);
		$options['facebook'] = array( 
							"name" => "Facebook Username",
							"desc" => "Facebook Username",
							"id" => "facebook_username",
							"std" => "",
							"type" => "text");
		$options['twitter'] = array( 
							"name" => "Twitter Username",
							"desc" => "Twitter UsernameL",
							"id" => "twitter_username",
							"std" => "",
							"type" => "text");
		$options['flickr'] = array( 
							"name" => "Google+ ID",
							"desc" => "Google+ ID",
							"id" => "google_userID",
							"std" => "",
							"type" => "text");
		$options['youtube'] = array( 
							"name" => "Stumble Username",
							"desc" => "Stumble Username",
							"id" => "stumble_username",
							"std" => "",
							"type" => "text");
		$options['google'] = array( 
							"name" => "Pinterest Username",
							"desc" => "Pinterest Username",
							"id" => "pinterest_username",
							"std" => "",
							"type" => "text");
		
		return $options;

	}

}



/* 

 * This is an example of how to add custom scripts to the options panel.

 * This example shows/hides an option when a checkbox is clicked.

 */



add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');





if(!function_exists('optionsframework_custom_scripts')) {



	function optionsframework_custom_scripts() { ?>



		<script type="text/javascript">

		jQuery(document).ready(function($) {



			$('#example_showhidden').click(function() {

					$('#section-example_text_hidden').fadeToggle(400);

			});

			

			if ($('#example_showhidden:checked').val() !== undefined) {

				$('#section-example_text_hidden').show();

			}

			

		});

		</script>



		<?php

		}



}







/**

* Front End Customizer

*

* WordPress 3.4 Required

*/

add_action( 'customize_register', 'cherry_register' );



if(!function_exists('cherry_register')) {



	function cherry_register($wp_customize) {

		/**

		 * This is optional, but if you want to reuse some of the defaults

		 * or values you already have built in the options panel, you

		 * can load them into $options for easy reference

		 */

		$options = optionsframework_options();

		

		

		

		/*-----------------------------------------------------------------------------------*/

		/*	General

		/*-----------------------------------------------------------------------------------*/

		$wp_customize->add_section( 'cherry_header', array(

			'title' => __( 'General', 'cherry' ),

			'priority' => 200

		));

		

		/* Background Image*/

		$wp_customize->add_setting( 'cherry[body_background][image]', array(

			'default' => $options['body_background']['std']['image'],

			'type' => 'option'

		) );

		

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'body_background_image', array(

			'label'   => 'Background Image',

			'section' => 'cherry_header',

			'settings'   => 'cherry[body_background][image]'

		) ) );

		

		

		/* Background Color*/

		$wp_customize->add_setting( 'cherry[body_background][color]', array(

			'default' => $options['body_background']['std']['color'],

			'type' => 'option'

		) );

		

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_background', array(

			'label'   => 'Background Color',

			'section' => 'cherry_header',

			'settings'   => 'cherry[body_background][color]'

		) ) );

		

		/* Header Color */

		$wp_customize->add_setting( 'cherry[header_color]', array(

			'default' => $options['header_color']['std'],

			'type' => 'option'

		) );

		

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_color', array(

			'label'   => $options['header_color']['name'],

			'section' => 'cherry_header',

			'settings'   => 'cherry[header_color]'

		) ) );

		

		

		/* Body Font Face */

		$wp_customize->add_setting( 'cherry[google_mixed_3][face]', array(

			'default' => $options['google_mixed_3']['std']['face'],

			'type' => 'option'

		) );

		

		$wp_customize->add_control( 'cherry_google_mixed_3', array(

				'label' => $options['google_mixed_3']['name'],

				'section' => 'cherry_header',

				'settings' => 'cherry[google_mixed_3][face]',

				'type' => 'select',

				'choices' => $options['google_mixed_3']['options']['faces']

		) );

		

		

		/* Buttons and Links Color */

		$wp_customize->add_setting( 'cherry[links_color]', array(

			'default' => $options['links_color']['std'],

			'type' => 'option'

		) );

		

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'links_color', array(

			'label'   => $options['links_color']['name'],

			'section' => 'cherry_header',

			'settings'   => 'cherry[links_color]'

		) ) );

		

		/* H1 Heading font face */

		$wp_customize->add_setting( 'cherry[h1_heading][face]', array(

			'default' => $options['h1_heading']['std']['face'],

			'type' => 'option'

		) );

		

		$wp_customize->add_control( 'cherry_h1_heading', array(

				'label' => $options['h1_heading']['name'],

				'section' => 'cherry_header',

				'settings' => 'cherry[h1_heading][face]',

				'type' => 'select',

				'choices' => $options['h1_heading']['options']['faces']

		) );

		

		/* H2 Heading font face */

		$wp_customize->add_setting( 'cherry[h2_heading][face]', array(

			'default' => $options['h2_heading']['std']['face'],

			'type' => 'option'

		) );

		

		$wp_customize->add_control( 'cherry_h2_heading', array(

				'label' => $options['h2_heading']['name'],

				'section' => 'cherry_header',

				'settings' => 'cherry[h2_heading][face]',

				'type' => 'select',

				'choices' => $options['h2_heading']['options']['faces']

		) );



		/* H3 Heading font face */

		$wp_customize->add_setting( 'cherry[h3_heading][face]', array(

			'default' => $options['h3_heading']['std']['face'],

			'type' => 'option'

		) );

		

		$wp_customize->add_control( 'cherry_h3_heading', array(

				'label' => $options['h3_heading']['name'],

				'section' => 'cherry_header',

				'settings' => 'cherry[h3_heading][face]',

				'type' => 'select',

				'choices' => $options['h3_heading']['options']['faces']

		) );



		/* H4 Heading font face */

		$wp_customize->add_setting( 'cherry[h4_heading][face]', array(

			'default' => $options['h4_heading']['std']['face'],

			'type' => 'option'

		) );

		

		$wp_customize->add_control( 'cherry_h4_heading', array(

				'label' => $options['h4_heading']['name'],

				'section' => 'cherry_header',

				'settings' => 'cherry[h4_heading][face]',

				'type' => 'select',

				'choices' => $options['h4_heading']['options']['faces']

		) );



		/* H5 Heading font face */

		$wp_customize->add_setting( 'cherry[h5_heading][face]', array(

			'default' => $options['h5_heading']['std']['face'],

			'type' => 'option'

		) );

		

		$wp_customize->add_control( 'cherry_h5_heading', array(

				'label' => $options['h5_heading']['name'],

				'section' => 'cherry_header',

				'settings' => 'cherry[h5_heading][face]',

				'type' => 'select',

				'choices' => $options['h5_heading']['options']['faces']

		) );

		

		/* H6 Heading font face */

		$wp_customize->add_setting( 'cherry[h6_heading][face]', array(

			'default' => $options['h6_heading']['std']['face'],

			'type' => 'option'

		) );

		

		$wp_customize->add_control( 'cherry_h6_heading', array(

				'label' => $options['h6_heading']['name'],

				'section' => 'cherry_header',

				'settings' => 'cherry[h6_heading][face]',

				'type' => 'select',

				'choices' => $options['h6_heading']['options']['faces']

		) );

		

		

		/* Search Box*/

		$wp_customize->add_setting( 'cherry[g_search_box_id]', array(

				'default' => $options['g_search_box_id']['std'],

				'type' => 'option'

		) );

		$wp_customize->add_control( 'cherry_g_search_box_id', array(

				'label' => $options['g_search_box_id']['name'],

				'section' => 'cherry_header',

				'settings' => 'cherry[g_search_box_id]',

				'type' => $options['g_search_box_id']['type'],

				'choices' => $options['g_search_box_id']['options']

		) );

		

		

		/*-----------------------------------------------------------------------------------*/

		/*	Logo

		/*-----------------------------------------------------------------------------------*/

		

		$wp_customize->add_section( 'cherry_logo', array(

			'title' => __( 'Logo', 'cherry' ),

			'priority' => 201

		) );

		

		/* Logo Type */

		$wp_customize->add_setting( 'cherry[logo_type]', array(

				'default' => $options['logo_type']['std'],

				'type' => 'option'

		) );

		$wp_customize->add_control( 'cherry_logo_type', array(

				'label' => $options['logo_type']['name'],

				'section' => 'cherry_logo',

				'settings' => 'cherry[logo_type]',

				'type' => $options['logo_type']['type'],

				'choices' => $options['logo_type']['options']

		) );

		

		/* Logo Path */

		$wp_customize->add_setting( 'cherry[logo_url]', array(

			'type' => 'option'

		) );

		

		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_url', array(

			'label' => $options['logo_url']['name'],

			'section' => 'cherry_logo',

			'settings' => 'cherry[logo_url]'

		) ) );

		

		

		/*-----------------------------------------------------------------------------------*/

		/*	Blog

		/*-----------------------------------------------------------------------------------*/

		

		

		$wp_customize->add_section( 'cherry_blog', array(

				'title' => __( 'Blog', 'cherry' ),

				'priority' => 203

		) );

		

		/* Blog image size */

		$wp_customize->add_setting( 'cherry[post_image_size]', array(

				'default' => $options['post_image_size']['std'],

				'type' => 'option'

		) );

		$wp_customize->add_control( 'cherry_post_image_size', array(

				'label' => $options['post_image_size']['name'],

				'section' => 'cherry_blog',

				'settings' => 'cherry[post_image_size]',

				'type' => $options['post_image_size']['type'],

				'choices' => $options['post_image_size']['options']

		) );

		

		/* Single post image size */

		$wp_customize->add_setting( 'cherry[single_image_size]', array(

				'default' => $options['single_image_size']['std'],

				'type' => 'option'

		) );

		$wp_customize->add_control( 'cherry_single_image_size', array(

				'label' => $options['single_image_size']['name'],

				'section' => 'cherry_blog',

				'settings' => 'cherry[single_image_size]',

				'type' => $options['single_image_size']['type'],

				'choices' => $options['single_image_size']['options']

		) );

		

		/* Post Meta */

		$wp_customize->add_setting( 'cherry[post_meta]', array(

				'default' => $options['post_meta']['std'],

				'type' => 'option'

		) );

		$wp_customize->add_control( 'cherry_post_meta', array(

				'label' => $options['post_meta']['name'],

				'section' => 'cherry_blog',

				'settings' => 'cherry[post_meta]',

				'type' => $options['post_meta']['type'],

				'choices' => $options['post_meta']['options']

		) );

		

		/* Post Excerpt */

		$wp_customize->add_setting( 'cherry[post_excerpt]', array(

				'default' => $options['post_excerpt']['std'],

				'type' => 'option'

		) );

		$wp_customize->add_control( 'cherry_post_excerpt', array(

				'label' => $options['post_excerpt']['name'],

				'section' => 'cherry_blog',

				'settings' => 'cherry[post_excerpt]',

				'type' => $options['post_excerpt']['type'],

				'choices' => $options['post_excerpt']['options']

		) );

		

		

		

		/*-----------------------------------------------------------------------------------*/

		/*	Footer

		/*-----------------------------------------------------------------------------------*/

		

		$wp_customize->add_section( 'cherry_footer', array(

			'title' => __( 'Footer', 'cherry' ),

			'priority' => 204

		) );

			

		/* Footer Copyright Text */

		$wp_customize->add_setting( 'cherry[footer_text]', array(

				'default' => $options['footer_text']['std'],

				'type' => 'option'

		) );

		$wp_customize->add_control( 'cherry_footer_text', array(

				'label' => $options['footer_text']['name'],

				'section' => 'cherry_footer',

				'settings' => 'cherry[footer_text]',

				'type' => 'text'

		) );

		

		

		/* Display Footer Menu */

		$wp_customize->add_setting( 'cherry[footer_menu]', array(

				'default' => $options['footer_menu']['std'],

				'type' => 'option'

		) );

		$wp_customize->add_control( 'cherry_footer_menu', array(

				'label' => $options['footer_menu']['name'],

				'section' => 'cherry_footer',

				'settings' => 'cherry[footer_menu]',

				'type' => $options['footer_menu']['type'],

				'choices' => $options['footer_menu']['options']

		) );

		



		

	};



}