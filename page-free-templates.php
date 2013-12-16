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
							<form action="#" method="post" id="toolbar-filter" class="row-fluid">
								<!-- <div class="toolbar-group span3">
									<label for="orderby"><?php echo _e('Sort By', 'cherry'); ?></label>
									<select name="orderby">
										<option value="date">Recently Added</option>
										<option value="title">Alphabetically</option>
									</select>
								</div> -->
								<div class="toolbar-group span3">
									<label for="type"><?php echo _e('Type', 'cherry'); ?></label>
									<select name="type">
										<?php
											$idObj = get_term_by('name', 'articles', 'post_tag');
											$id    = $idObj->term_id;
										?>
										<option value="<?php echo $id; ?>"><?php echo esc_attr('All'); ?></option>
										<?php
											$tags = get_tags( 'child_of='.$id );
											foreach ( $tags as $tag ) {
												$option = '<option value="' . $tag->term_id . '">';
												$option .= $tag->name;
												$option .= '</option>';
												echo $option;
											}
										?>
									</select>
								</div>
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
												$option = '<option value="' . $category->cat_ID . '">';
												$option .= $category->cat_name;
												$option .= '</option>';
												echo $option;
											}
										?>
									</select>
								</div>
								<input type="hidden" id="ajaxurl" value="<?php echo admin_url('admin-ajax.php'); ?>">
							</form>
						</div>
					</div>

					<div id="allthatjunk">
						<?php do_action('monster_free_template'); ?>
					</div><!--#allthatjunk-->
				</div><!--.content-inner-->
			</div><!--#content-->
		<!--/div--><!--.row-->
	</div><!--.container-->
<?php get_footer(); ?>