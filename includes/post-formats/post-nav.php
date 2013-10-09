<?php if(function_exists('pagination')) :
	pagination($wp_query->max_num_pages);
else :
	if ( $wp_query->max_num_pages > 1 ) : ?>
	<ul class="pager">
		<li class="previous">
			<?php next_posts_link( __('&laquo; Older Entries', 'cherry')) ?>
		</li><!--.previous-->
		<li class="next">
			<?php previous_posts_link(__('Newer Entries &raquo;', 'cherry')) ?>
		</li><!--.next-->
	</ul><!--.pager-->
	<?php endif; ?>
<?php endif; ?>
<!-- Posts navigation -->