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

						if (is_page_template('page-archives.php')) {

							$current_month = date('m')-1; // get last month
							$current_year  = date('Y');

							// The Query
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							$args = array(
								'post_type'           => 'post',
								'ignore_sticky_posts' => true,
								'paged'               => $paged,
								'year'                => $current_year,
								'monthnum'            => $current_month
								);
							query_posts($args);
						} else {
							$current_month = get_the_date('m'); // 01–12
							if (empty($current_month)) {
								$current_month = '01';
							}
							$current_year = get_the_date('Y'); // Eg., 1999, 2003
						}
						if (have_posts()) :
					?>
					<section id="options" class="clearfix">
						<ul id="sort-by-year" class="option-set unstyled clearfix">
							<?php $months_by_year = array();

								// query to database
								$months = $wpdb->get_results("SELECT DISTINCT MONTH( post_date ) AS month , YEAR( post_date ) AS year FROM $wpdb->posts WHERE post_status = 'publish' and post_date <= now( ) and post_type = 'post' GROUP BY month , year ORDER BY post_date ASC");

								$year = $months[0]->year;
								$temp = array();
								foreach ($months as $month) {
									if ($year == $month->year) {
										array_push($temp, $month->month);
									} else {
										$months_by_year[$year] = $temp;
										$year++; // increment year's count
										$temp = array();
										array_push($temp, $month->month);
									}
								}
								$months_by_year[$year] = $temp;
								krsort($months_by_year); // Sort an array by key in reverse order

								foreach ($months_by_year as $year => $months) {
									if ($year == $current_year) 
										$class = ' class="selected"';
									else
										$class = '';

									$link = home_url('/'.$year.'/'.date("m", strtotime($year.'-'.$months[0].'-01')));
									echo "<li><a href='$link' $class>$year</a></li>";
								}
							?>
						</ul><!--#sort-by-year-->

						<ul id="sort-by-month" class="option-set unstyled clearfix">
							<?php foreach ($months_by_year[$current_year] as $monthNumb) {
									$monthName = date("M", strtotime($current_year.'-'.$monthNumb.'-01'));
									if ($monthNumb == $current_month) {
										$class = ' class="selected"';
									} else {
										$class = '';
									}
									$link = home_url('/'.$current_year.'/'.$monthNumb);
									echo "<li><a href='$link' $class>$monthName</a></li>";
								}
							?>
						</ul><!--#sort-by-month-->

					</section><!--#options-->
					<div class="clear"></div>

					<div class="post-tile row-fluid">
					<?php 
						$post_counter = 0; // main posts counter
						$pair_post    = 1; // counter for pair posts

						while (have_posts()) : the_post();

							if ( $pair_post > 2 ) {
								echo '<div class="post-tile row-fluid">';
								$pair_post = 1;
							}?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('post__holder span6'); ?>>
								<?php get_template_part('includes/post-formats/post-thumb'); ?>
								<?php get_template_part('includes/post-formats/post-meta'); ?>
								<header class="post-header">
									<h4 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'cherry');?> <?php the_title(); ?>"><?php the_title(); ?></a></h4>
								</header>
							</article>
							<?php if ( $pair_post == 2 ) {
								echo '</div><!--.post-tile-->';
							}
							$pair_post++;
							$post_counter++;
						endwhile;
					else: ?>
						<div class="no-results">
							<?php echo '<h5>' . __('There has been an error.', 'cherry') . '</strong></h5>'; ?>
							<p><?php _e('We apologize for any inconvenience, please', 'cherry'); ?> <a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'cherry'); ?></a> <?php _e('or use the search form below.', 'cherry'); ?></p>
							<?php get_search_form(); /* outputs the default Wordpress search form */ ?>
						</div><!--.no-results-->
					<?php endif;

					if ( isset($post_counter) && ( $post_counter % 2) ) {
						echo '</div><!--.post-tile-->';
					}

					get_template_part('includes/post-formats/post-nav'); ?>
				</div><!--content-inner-->
			</div><!--#content-->
			<?php get_sidebar(); ?>
		</div><!--.row-->
	</div><!--.container-->
<?php get_footer(); ?>