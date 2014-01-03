<!-- BEGIN CAROUSEL -->
<?php
	// declaration array for filter
	$filterArray = array(
			'videos'     => '',
			'books'      => '',
			'podcasts'   => '',
			'slideshows' => ''
		);

	// declaration array for all tags
	$allTagsArray = array();

	// get all tags and record to array
	$tags = get_tags();
	if ( empty($tags) ) 
		return;

	foreach ($tags as $tag) {
		$allTagsArray[$tag->slug] = $tag->term_id;
	}

	// computes the intersection of arrays using keys for comparison
	$filterArray = (array_intersect_key($filterArray, $allTagsArray));

	if ( empty($filterArray) ) 
		return;

	foreach ($filterArray as $key => $value) {
		$filterArray[$key] = $allTagsArray[$key];
	}
?>
<div class="carousel-holder">
	<div class="carousel-heading clearfix">
		<input id="ajaxurl" type="hidden" value="<?php echo admin_url('admin-ajax.php'); ?>">
		<div id="carousel-current-state" class="hidden-phone"><span><?php esc_html_e('Watch &amp; Learn', 'cherry'); ?></span></div>
		<div id="carousel-filter">
			<?php
				foreach ($filterArray as $key => $value) {
					$class = '';
					if ( $key == 'videos' ) {
						$class = 'selected';
					}
					echo '<a href="#' . $key . '" class="' . $class . '" data-filter="' . $key . '">' . str_replace('-', ' ', $key) . '</a>';
				}
			?>
		</div>
		<div id="carousel-pager" class="carousel-pager"></div>
	</div>
	<div class="carousel-wrapper">
		<div id="carousel-cover"></div>
		<ul id="carousel" class="clearfix unstyled">
			<?php do_action( 'monster_carousel_posts' ); ?>
		</ul>
		
		<button id="carousel-prev"><span>&lsaquo;</span></button>
		<button id="carousel-next"><span>&rsaquo;</span></button>
		<script type="text/javascript">
			jQuery(window).load(function(){
				jQuery('#carousel').carouFredSel({
					items: 5,
					width: '100%',
					circular: true,
					infinite: false,
					auto: false,
					scroll: {
						duration: 600
					},
					swipe: {
						onTouch: true
					},
					prev: {
						button: '#carousel-prev',
						items: 1
					},
					next: {
						button: '#carousel-next',
						items: 1
					},
					pagination: '#carousel-pager'
				}, {
					debug: false
				});
			});
		</script>
	</div>
</div>
<hr>
<!-- END CAROUSEL -->