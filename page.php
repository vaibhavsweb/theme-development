<?php
/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package Luminous_Blog
 */

get_header();
?>

<div class="container">
	<div class="content-area">
		<div class="site-content">
			<?php
			while ( have_posts() ) {
				the_post();
				?>

				<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
					<!-- Page Header -->
					<header class="post-header">
						<?php the_title( '<h1 class="post-title">', '</h1>' ); ?>
					</header><!-- .post-header -->

					<!-- Featured Image -->
					<?php
					if ( has_post_thumbnail() ) {
						?>
						<figure class="post-featured-image">
							<?php the_post_thumbnail( 'post-thumbnail' ); ?>
						</figure>
						<?php
					}
					?>

					<!-- Page Content -->
					<div class="post-body">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'luminous-blog' ),
								'after'  => '</div>',
							)
						);
						?>
					</div><!-- .post-body -->

				</article><!-- #post-<?php the_ID(); ?> -->

				<?php
				// Comments
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			}
			?>
		</div><!-- .site-content -->

		<!-- Sidebar -->
		<aside id="secondary" class="primary-sidebar">
			<?php dynamic_sidebar( 'primary-sidebar' ); ?>
		</aside><!-- .primary-sidebar -->
	</div><!-- .content-area -->
</div><!-- .container -->

<?php get_footer();
