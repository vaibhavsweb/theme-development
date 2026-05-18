<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Luminous_Blog
 */

get_header();
?>

<div class="container">
	<div class="content-area">
		<div class="site-content">
			<?php
			if ( have_posts() ) {
				?>
				<header class="page-header">
					<h1 class="page-title">
						<?php
						printf(
							esc_html__( 'Search Results for: %s', 'luminous-blog' ),
							'<span>' . get_search_query() . '</span>'
						);
						?>
					</h1>
					<p class="search-results-count">
						<?php
						printf(
							esc_html__( 'We found %d result(s) for your search.', 'luminous-blog' ),
							$GLOBALS['wp_query']->found_posts
						);
						?>
					</p>
				</header>

				<div class="post-list">
					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content-search' );
					}
					?>
				</div>

				<?php
				luminous_blog_pagination();
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
			?>
		</div><!-- .site-content -->

		<!-- Sidebar -->
		<aside id="secondary" class="primary-sidebar">
			<?php
			dynamic_sidebar( 'primary-sidebar' );

			if ( ! have_posts() ) {
				?>
				<div class="widget">
					<h2 class="widget-title"><?php esc_html_e( 'Try a New Search', 'luminous-blog' ); ?></h2>
					<?php get_search_form(); ?>
				</div>
				<?php
			}
			?>
		</aside><!-- .primary-sidebar -->
	</div><!-- .content-area -->
</div><!-- .container -->

<?php get_footer();
