<?php
/**
 * Template Name: Free Templates
 */
get_header(); ?>
	<div class="container">
		<div id="content">
			<div class="content-inner">
				<?php get_template_part('title'); ?>

				<form action="#" method="post" id="toolbar-filter" class="row-fluid">
					<?php
						$terms = get_terms('type');
						$count = count($terms);
						if ( $count > 0 ) { ?>
						<div class="toolbar-group span3">
							<label for="type"><?php echo _e('Type', 'cherry'); ?></label>
							<select name="type">
								<option value="<?php echo 'all'; ?>"><?php echo esc_attr('All'); ?></option>
								<?php foreach ( $terms as $term ) {
									echo "<option value=" . $term->slug . ">" . $term->name . "</option>";
								} ?>
							</select>
						</div>
					<?php } ?>

					<div class="toolbar-group span3">
						<label for="cat"><?php echo _e('Category', 'cherry'); ?></label>
						<select name="cat">
							<?php
								$idObj = get_category_by_slug( 'free-website-templates' );
								$id    = $idObj->term_id;
							?>
							<option value="<?php echo $id; ?>"><?php echo esc_attr('All'); ?></option>
							<?php
								$categories = get_categories( 'child_of='.$id );
								foreach ( $categories as $category ) {
									echo '<option value="' . $category->cat_ID . '">' . $category->cat_name . '</option>';
								}
							?>
						</select>
					</div>
					<input type="hidden" id="ajaxurl" value="<?php echo admin_url('admin-ajax.php'); ?>">
				</form>

				<div id="allthatjunk">
					<?php do_action('monster_free_template'); ?>
				</div><!--#allthatjunk-->
			</div><!--.content-inner-->
		</div><!--#content-->
	</div><!--.container-->
<?php get_footer(); ?>