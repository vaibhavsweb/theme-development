<?php
/**
 * Template part for displaying related posts
 *
 * @package Luminous_Blog
 */

if ( ! is_singular( 'post' ) ) {
	return;
}

// Get current post ID and categories
$post_id   = get_the_ID();
$categories = get_the_category( $post_id );

if ( empty( $categories ) ) {
	return;
}

// Get category IDs
$category_ids = array_map( function( $cat ) {
	return $cat->term_id;
}, $categories );

// Query for related posts
$args = array(
	'category__in'   => $category_ids,
	'post__not_in'   => array( $post_id ),
	'posts_per_page' => 3,
	'orderby'        => 'rand',
);

$related_posts = new WP_Query( $args );

if ( $related_posts->have_posts() ) {
	?>
	<section class="related-posts" style="margin-top: 3rem; padding-top: 2rem; border-top: 2px solid var(--color-border);">
		<h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">
			<?php esc_html_e( 'Related Posts', 'luminous-blog' ); ?>
		</h2>

		<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
			<?php
			while ( $related_posts->have_posts() ) {
				$related_posts->the_post();
				?>
				<article class="related-post-card" style="background: var(--color-bg-light); border-radius: 8px; overflow: hidden; transition: all 0.3s ease;">
					<?php
					if ( has_post_thumbnail() ) {
						?>
						<div style="height: 180px; overflow: hidden;">
							<?php the_post_thumbnail( 'post-thumbnail', array( 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) ); ?>
						</div>
						<?php
					}
					?>
					<div style="padding: 1rem;">
						<h3 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.5rem;">
							<a href="<?php the_permalink(); ?>" style="color: var(--color-primary);">
								<?php the_title(); ?>
							</a>
						</h3>
						<p style="font-size: 0.875rem; color: var(--color-text-light); margin-bottom: 0.5rem;">
							<?php echo esc_html( get_the_date( 'M j, Y' ) ); ?>
						</p>
					</div>
				</article>
				<?php
			}
			?>
		</div>
	</section>
	<?php

	wp_reset_postdata();
}
