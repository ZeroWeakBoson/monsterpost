		</div>
		<div class="extra-block"></div>
	</div><!-- .extra -->
	<footer id="footer" class="footer">
		<div id="back-top-wrapper" class="visible-desktop">
			<p id="back-top">
				<a href="#top"><span aria-hidden="true" class="icon-angle-up"></span></a>
			</p>
		</div>
		<div class="container">
		<?php if ( of_get_option('footer_menu') == 'true') { ?>
			<nav class="nav footer-nav">
			<?php if (has_nav_menu('footer_menu')) {
				wp_nav_menu( array(
					'container'      => 'ul',
					'depth'          => 0,
					'theme_location' => 'footer_menu')
				);
			} else {
				echo '<ul>';
					wp_list_pages( array(
						'depth'    => 1,
						'title_li' => '')
					);
				echo '</ul>';
			} ?>
		</nav>
		<?php }

		$myfooter_text = of_get_option('footer_text');
		if ($myfooter_text) {
			echo '<div id="copyright" class="copyright clearfix">' . of_get_option('footer_text') . '</div><!--/.copyright-->';
		} ?>
		</div><!--/.container-->
	</footer>
</div><!--#main-->