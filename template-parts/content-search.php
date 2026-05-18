<?php
/**
 * Template part for displaying search results
 *
 * @package Luminous_Blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
	<div class="post-card-content" style="padding: 1.5rem;">
		<!-- Post Meta -->
		<?php luminous_blog_post_meta(); ?>

		<!-- Post Title -->
		<h2 class="post-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>

		<!-- Post Excerpt with Search Terms Highlighted -->
		<div class="post-excerpt">
			<?php
			$content = wp_strip_all_tags( get_the_content() );
			$excerpt = wp_trim_words( $content, 40, '...' );
			echo wp_kses_post( $excerpt );
			?>
		</div>

		<!-- Read More -->
		<a href="<?php the_permalink(); ?>" class="read-more">
			<?php esc_html_e( 'Read More', 'luminous-blog' ); ?>
		</a>
	</div>
</article>
