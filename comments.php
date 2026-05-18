<?php
/**
 * The template for displaying comments
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Luminous_Blog
 */

// If the post is protected by a password and the visitor hasn't yet entered the password we will return early without loading the comments.
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) {
		?>
		<h2 class="comments-title">
			<?php
			$luminous_blog_comment_count = get_comments_number();
			if ( '1' === $luminous_blog_comment_count ) {
				echo esc_html__( '1 Comment', 'luminous-blog' );
			} else {
				echo esc_html(
					sprintf(
						__( '%s Comments', 'luminous-blog' ),
						number_format_i18n( $luminous_blog_comment_count )
					)
				);
			}
			?>
		</h2><!-- .comments-title -->

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
			?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'luminous-blog' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'luminous-blog' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'luminous-blog' ) ); ?></div>
			</nav><!-- #comment-nav-above -->
			<?php
		}

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) {
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'luminous-blog' ); ?></p>
			<?php
		}
	}

	// Comment form
	comment_form(
		array(
			'title_reply'          => esc_html__( 'Leave a Comment', 'luminous-blog' ),
			'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'luminous-blog' ),
			'cancel_reply_link'    => esc_html__( 'Cancel reply', 'luminous-blog' ),
			'label_submit'         => esc_html__( 'Post Comment', 'luminous-blog' ),
			'comment_notes_before' => '<p class="comment-notes"><span id="email-notes">' . esc_html__( 'Your email address will not be published.', 'luminous-blog' ) . '</span></p>',
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html_e( 'Comment', 'luminous-blog' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" required></textarea></p>',
			'class_form'           => 'comment-form',
			'class_submit'         => 'btn btn-primary',
		)
	);
	?>
</div><!-- #comments -->
