<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) {
	echo '<p class="nocomments">' . __('This post is password protected. Enter the password to view comments.', 'cherry') . '</p>';
	return;
} ?>
<!-- BEGIN Comments -->
	<?php if ( have_comments() ) : ?>
	<div class="comment-holder">
		<h3 class="comments-h">
			<?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'cherry' ), number_format_i18n( get_comments_number() ), '' );?>
		</h3>
		<div class="pagination">
			<?php paginate_comments_links('prev_text=Prev&next_text=Next'); ?> 
		</div>
		<ol class="comment-list clearfix">
			<?php wp_list_comments('type=all&callback=mytheme_comment'); ?>
		</ol>
		<div class="pagination">
			<?php paginate_comments_links('prev_text=Prev&next_text=Next'); ?> 
		</div>
	</div>
	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->
		<?php echo '<p class="nocomments">' . __('No Comments Yet.', 'cherry') . '</p>';
		else : // comments are closed ?>
			<!-- If comments are closed. -->
		<?php echo '<p class="nocomments">' . __('Comments are closed.', 'cherry') . '</p>';
		endif;
	endif;

	if ( comments_open() ) : ?>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
	<p><?php _e('You must be', 'cherry'); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('logged in', 'cherry'); ?></a> <?php _e('to post a comment.', 'cherry'); ?></p>
	<?php else :
		comment_form($post->ID);
	endif; // If registration required and not logged in ?>

<!-- END Comments -->

<?php endif; ?>