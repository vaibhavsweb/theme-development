<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
				<!-- Archive Header -->
				<header class="page-header">
					<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<!-- Archive Posts -->
				<div class="post-list">
					<?php
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );
					}
					?>
				</div>

				<?php
				// Pagination
				luminous_blog_pagination();
			} else {
				get_template_part( 'template-parts/content', 'none' );
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
