<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Luminous_Blog
 */

get_header();
?>

<div class="container">
	<div class="content-area">
		<div class="site-content">
			<article class="single-post">
				<header class="post-header text-center">
					<h1 class="page-title" style="font-size: 4rem; color: var(--color-accent);">
						<?php esc_html_e( '404', 'luminous-blog' ); ?>
					</h1>
					<p style="font-size: 1.5rem; color: var(--color-text-light); margin: 1rem 0;">
						<?php esc_html_e( 'Oops! Page Not Found', 'luminous-blog' ); ?>
					</p>
				</header>

				<div class="post-body text-center">
					<p>
						<?php esc_html_e( 'The page you are looking for does not exist. It might have been moved or deleted.', 'luminous-blog' ); ?>
					</p>

					<p style="margin-top: 2rem;">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
							<?php esc_html_e( '← Back to Home', 'luminous-blog' ); ?>
						</a>
					</p>

					<!-- Search Box -->
					<div style="margin-top: 3rem; padding: 2rem; background-color: var(--color-bg-light); border-radius: 8px;">
						<p style="margin-bottom: 1rem;">
							<?php esc_html_e( 'Try searching for what you are looking for:', 'luminous-blog' ); ?>
						</p>
						<?php get_search_form(); ?>
					</div>
				</div>
			</article>
		</div><!-- .site-content -->

		<!-- Sidebar -->
		<aside id="secondary" class="primary-sidebar">
			<?php dynamic_sidebar( 'primary-sidebar' ); ?>
		</aside><!-- .primary-sidebar -->
	</div><!-- .content-area -->
</div><!-- .container -->

<?php get_footer();
