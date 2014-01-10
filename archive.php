<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<div id="content" class="span8 <?php echo of_get_option('blog_sidebar_pos') ?>">
				<div class="content-inner">
					<section class="title-section">
						<h1 class="title-header"><?php _e('Archives', 'cherry'); ?></h1>
					</section>
					<?php
						global $wpdb;

						if ( is_page_template( 'page-archives.php' ) ) {

							$current_month = date('m'); // get last month
							$current_month = strval( ($current_month == '01') ? '01' : $current_month-- );
							$current_year  = date('Y');

							// The Query
							if ( get_query_var('paged') ) {
								$paged = get_query_var('paged');
							} elseif ( get_query_var('page') ) {
								$paged = get_query_var('page');
							} else {
								$paged = 1;
							}
							$args = array(
								'post_type'           => 'post',
								'post_status'         => 'publish',
								'ignore_sticky_posts' => true,
								'paged'               => $paged,
								'year'                => $current_year,
								'monthnum'            => $current_month
								);
							query_posts( $args );

							if ( !have_posts() ) :
								$current_year--;
								$current_month = '01';
								if ( get_query_var('paged') ) {
									$paged = get_query_var('paged');
								} elseif ( get_query_var('page') ) {
									$paged = get_query_var('page');
								} else {
									$paged = 1;
								}
								$args = array(
									'post_type'           => 'post',
									'post_status'         => 'publish',
									'ignore_sticky_posts' => true,
									'paged'               => $paged,
									'year'                => strval( $current_year ),
									'monthnum'            => $current_month
									);
								query_posts( $args );
							endif;

						} else {
							$current_month = get_the_date('m'); // 01–12
							if ( empty( $current_month ) ) {
								$current_month = '01';
							}
							$current_year = get_the_date('Y'); // Eg., 1999, 2003
						}

						if ( have_posts() ) :
					?>
					<section id="options" class="clearfix">
						<ul id="sort-by-year" class="option-set unstyled clearfix">
							<?php $months_by_year = array();

								// query to database
								$months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month , YEAR( post_date ) AS year FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY post_date ASC");

								$year = $months[0]->year;
								$temp = array();
								foreach ( $months as $month ) {
									if ( $year == $month->year ) {
										array_push( $temp, $month->month );
									} else {
										$months_by_year[$year] = $temp;
										$year++; // increment year's count
										$temp = array();
										array_push( $temp, $month->month );
									}
								}
								$months_by_year[$year] = $temp;
								krsort( $months_by_year ); // Sort an array by key in reverse order

								foreach ( $months_by_year as $year => $months ) {
									if ( $year == $current_year )
										$class = ' class="selected"';
									else
										$class = '';

									$link = home_url( '/' . $year . '/'.date( "m", strtotime($year . '-' . $months[count($months)-1]) ) );
									echo "<li><a href='$link' $class>$year</a></li>";
								}
							?>
						</ul><!--#sort-by-year-->

						<ul id="sort-by-month" class="option-set unstyled clearfix">
						<?php foreach ( $months_by_year[$current_year] as $monthNumb ) {
								$monthName = date( "M", strtotime( $current_year . '-' . $monthNumb . '-01' ) );
								if ( $monthNumb == $current_month ) {
									$class = ' class="selected"';
								} else {
									$class = '';
								}
								$link = home_url( '/' . $current_year . '/' . $monthNumb );
								echo "<li><a href='$link' $class>$monthName</a></li>";
							}
						?>
						</ul><!--#sort-by-month-->

					</section><!--#options-->
					<div class="clear"></div>

					<div class="post-tile">
						<div class="row-fluid">
						<?php
							$post_counter = 0; // main posts counter
							$pair_post    = 1; // counter for pair posts
							$adv_content  = 2; // adv content - output after 2 posts

							while ( have_posts() ) : the_post();

								if ( $post_counter == $adv_content ) {
									// output advertising in the content
									if ( of_get_option('bnr_content') ) {
										get_template_part('bnr/foo-content');
									}
								}

								if ( $pair_post > 2 ) {
									echo '<div class="post-tile">';
									echo '<div class="row-fluid">';
									$pair_post = 1;
								} ?>

								<div class="span6">
								<?php
									// The following determines what the post format is and shows the correct file accordingly
									$format = get_post_format();
									get_template_part( 'includes/post-formats/'.$format );

									if ($format == '')
										get_template_part( 'includes/post-formats/standard' );
								?>
								</div>
								<?php if ( $pair_post == 2 ) {
									echo '</div><!--.row-fluid-->';
									echo '</div><!--.post-tile-->';
								}
								$pair_post++;
								$post_counter++;
								endwhile;

								if ( $post_counter % 2 ) {
									echo '</div><!--.row-fluid-->';
									echo '</div><!--.post-tile-->';
								}
								get_template_part( 'includes/post-formats/post-nav' );
								wp_reset_query(); ?>

							<?php else: ?>
							<div class="no-results">
								<?php echo '<h5>' . __('There has been an error.', 'cherry') . '</strong></h5>'; ?>
								<p><?php _e('We apologize for any inconvenience, please', 'cherry'); ?> <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'cherry'); ?></a> <?php _e('or use the search form below.', 'cherry'); ?></p>
								<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
							</div><!--.no-results-->
						<?php endif; ?>
				</div><!--content-inner-->
			</div><!--#content-->
			<?php get_sidebar(); ?>
		</div><!--.row-->
	</div><!--.container-->
<?php get_footer(); ?>