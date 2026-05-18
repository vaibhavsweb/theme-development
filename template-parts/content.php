<?php
/**
 * Template part for displaying posts in blog listing
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Luminous_Blog
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
	<!-- Featured Image -->
	<div class="post-card-image">
		<?php
		if ( has_post_thumbnail() ) {
			the_post_thumbnail( 'post-thumbnail' );
		} else {
			?>
			<div style="width: 100%; height: 180px; background: linear-gradient(135deg, #d7bde2, #ecb3ae);"></div>
			<?php
		}
		?>
	</div>

	<!-- Post Content -->
	<div class="post-card-content">
		<!-- Post Meta -->
		<?php luminous_blog_post_meta(); ?>

		<!-- Post Title -->
		<h2 class="post-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>

		<!-- Post Excerpt -->
		<div class="post-excerpt">
			<?php
			if ( luminous_blog_has_custom_excerpt() ) {
				the_excerpt();
			} else {
				echo wp_kses_post( wp_trim_words( get_the_content(), 25, '...' ) );
			}
			?>
		</div>

		<!-- Read More -->
		<a href="<?php the_permalink(); ?>" class="read-more">
			<?php esc_html_e( 'Read More', 'luminous-blog' ); ?>
		</a>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
