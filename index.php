<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Luminous_Blog
 */

get_header();
?>

<div class="container">
	<div class="content-area">
		<!-- Main Content -->
		<div class="site-content">
			<?php
			if ( is_home() && ! is_front_page() ) {
				?>
				<header class="page-header">
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				</header>
				<?php
			}

			if ( have_posts() ) {
				?>
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
