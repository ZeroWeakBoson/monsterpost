<div id="main" class="main-holder container">
	<div class="extra">
		<header id="header" class="header">
			<div class="nav-inner">
				<!-- BEGIN SEARCH FORM -->
				<?php if ( of_get_option('g_search_box_id') == 'yes') { ?>
					<div class="search-form search-form__h clearfix" id="search-header__holder">
						<form id="search-header" class="navbar-form" method="get" action="<?php echo home_url(); ?>/" accept-charset="utf-8">
							<button class="search-form_ic" id="search-form-no" type="button"><i class="icon-close"></i></button>
							<button class="search-form_is" id="search-form-yes" type="submit"><i class="icon-search"></i></button>
							<input type="text" name="s" placeholder="<?php _e('Search...', 'cherry'); ?>" class="search-form_it">
						</form>
					</div>
				<?php } ?>
				<!-- END SEARCH FORM -->
				<div class="nav-row top container">
					<?php if ( of_get_option('g_search_box_id') == 'yes') { ?>
						<button class="search-form__call icon-search" id="search-form-call" type="button"></button><!-- I'm call search form -->
					<?php } ?>
					<!-- BEGIN LOGO -->
					<div class="logo">
						<div class="logo-inner">
						<?php if ( of_get_option('logo_type') == 'text_logo' ) { ?>
							<!-- text logo -->
							<?php if( is_front_page() ) { ?>
								<h1 class="logo_h logo_h__txt"><?php bloginfo('name'); ?></h1>
							<?php } elseif ( is_home() || is_404() ) { ?>
								<h1 class="logo_h logo_h__txt"><a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>" class="logo_link"><?php bloginfo('name'); ?></a></h1>
							<?php } else { ?>
								<h2 class="logo_h logo_h__txt"><a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>" class="logo_link"><?php bloginfo('name'); ?></a></h2>
							<?php } ?>
						<?php } else { ?>
							<!-- image logo -->
							<?php if ( of_get_option('logo_url') == '' ) :
								if ( is_front_page() ) { ?>
								<img src="<?php echo CHILD_URL; ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>" class="hires">
							<?php } else  { ?>
								<a href="<?php echo home_url('/'); ?>" class="logo_h logo_h__img"><img src="<?php echo CHILD_URL; ?>/images/logo.png" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>" class="hires"></a>
							<?php } else :
								if ( is_front_page() ) { ?>
									<img src="<?php echo of_get_option('logo_url', '' ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>" class="hires">
								<?php } else { ?>
									<a href="<?php echo home_url('/'); ?>" class="logo_h logo_h__img"><img src="<?php echo of_get_option('logo_url', '' ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>" class="hires"></a>
								<?php }
								endif;
							}?>
						</div>
					</div>
					<!-- END LOGO -->
					<!-- BEGIN MAIN NAVIGATION -->
					<nav class="nav nav__primary">
						<?php if (has_nav_menu('header_menu')) { ?>
							<?php wp_nav_menu( array(
								'container'      => 'ul',
								'menu_class'     => 'sf-menu',
								'menu_id'        => 'topnav',
								'depth'          => 0,
								'theme_location' => 'header_menu',
								'walker'         => new description_walker()
							));
						} else {
							echo '<ul class="sf-menu">';
								$cat_name_array = array('news', 'articles', 'tutorials', 'tools', 'showcases', 'free-stuff', 'interviews', 'infographics');
								$cat_id_array = array();
								$count = 0;
								foreach ($cat_name_array as $value) {
									$cat_id_array[$count] = get_cat_ID( $value );
									$count++;
								}
								$include_cat_str = implode(',', $cat_id_array);
								$args = array(
									'include'    => $include_cat_str,
									'orderby'    => 'name',
									'order'      => 'ASC',
									'hide_empty' => 0
									);
								$categories = get_categories($args);
								foreach ($categories as $category) {
									echo '<li><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></li>';
								}
							echo '</ul>';
						} ?>
						<script type="text/javascript">
							// Init navigation menu
							jQuery(function(){
								jQuery('ul.sf-menu').superfish({
									delay: <?php echo (of_get_option('sf_delay')!='') ? of_get_option('sf_delay') : 600; ?>, // the delay in milliseconds that the mouse can remain outside a sub-menu without it closing
									animation: {
										opacity: "<?php echo (of_get_option('sf_f_animation')!='') ? of_get_option('sf_f_animation') : 'show'; ?>",
										height: "<?php echo (of_get_option('sf_sl_animation')!='') ? of_get_option('sf_sl_animation') : 'show'; ?>"
									}, // used to animate the sub-menu open
									speed: "<?php echo (of_get_option('sf_speed')!='') ? of_get_option('sf_speed') : 'normal'; ?>", // animation speed 
									autoArrows: <?php echo (of_get_option('sf_arrows')==false) ? 'false' : of_get_option('sf_arrows'); ?>, // generation of arrow mark-up (for submenu)
									disableHI: true // to disable hoverIntent detection
								});
							})
						</script>
					</nav>
					<!-- END MAIN NAVIGATION -->
					<div class="clear"></div>
			</div><!--.nav-row-->
		</div><!--.nav-inner-->
		<?php
			if ( of_get_option('bnr_top') ) {
				// output advertise in the header
				get_template_part('bnr/foo-header');
			}
		?>
	</header>
	<div class="content-holder clearfix">