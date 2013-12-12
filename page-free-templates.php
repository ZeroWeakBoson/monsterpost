<?php
/**
 * Template Name: Free Templates
 */
get_header(); ?>
	<div class="container">
		<!-- <div class="row"> -->
			<div id="content">
				<div class="content-inner">
					<?php get_template_part('title'); ?>

					<div class="row">
						<div class="span12">
							<form id="toolbar-filter" action="#" method="post">
								<input type="hidden" id="toolbar-order">
								<div class="toolbar-group">
									<label for="sort-by"><?php echo _e('Sort By', 'cherry'); ?></label>
									<select name="sort-by">
										<option value="date">Recently Added</option>
										<option value="title">Alphabetically</option>
									</select>
								</div>
								<div class="toolbar-group">
									<label for="type"><?php echo _e('Type', 'cherry'); ?></label>
									<select name="type">
										<option value="html5">HTML5</option>
										<option value="wordpress">WordPress</option>
										<option value="drupal">Drupal</option>
										<option value="joomla">Joomla</option>
										<option value="bootstrap">Bootstrap</option>
										<option value="javascript-animated">JavaScript Animated</option>
										<option value="oscommerce">osCommerce</option>
										<option value="prestashop">PrestaShop</option>
										<option value="facebook">Facebook</option>
									</select>
								</div>
								<div class="toolbar-group">
									<label for="cat"><?php echo _e('Category', 'cherry'); ?></label>
									<select name="cat">
										<option value="cafe-restaurant ">Cafe &amp; Restaurant </option>
										<option value="design-studio">Design Studio</option>
										<option value="business">Business</option>
										<option value="agriculture">Agriculture</option>
										<option value="holiday">Holiday</option>
										<option value="food-drink">Food &amp; Drink</option>
										<option value="art-photography">Art &amp; Photography</option>
										<option value="travel">Travel</option>
										<option value="wedding">Wedding</option>
									</select>
								</div>
							</form>
						</div>
					</div>

					<div id="allthatjunk">
						<?php do_action('monster_free_template', 'date'); ?>
					</div><!--#allthatjunk-->
				</div><!--.content-inner-->
			</div><!--#content-->
		<!--/div--><!--.row-->
	</div><!--.container-->
<?php get_footer(); ?>