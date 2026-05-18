<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
					<!-- Post Header -->
					<header class="post-header">
						<?php
						// Display post meta
						luminous_blog_post_meta();

						// Display post title
						the_title( '<h1 class="post-title">', '</h1>' );
						?>
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

					<!-- Post Content -->
					<div class="post-body">
						<?php
						the_content(
							sprintf(
								wp_kses(
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'luminous-blog' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								wp_kses_post( get_the_title() )
							)
						);

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'luminous-blog' ),
								'after'  => '</div>',
							)
						);
						?>
					</div><!-- .post-body -->

					<!-- Post Tags -->
					<?php
					if ( has_tag() ) {
						?>
						<div class="post-tags">
							<?php the_tags( '', '', '' ); ?>
						</div>
						<?php
					}
					?>

					<!-- Author Box -->
					<?php
					if ( get_the_author_meta( 'description' ) ) {
						?>
						<div class="author-box">
							<div class="author-header">
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 80, '', '', array( 'class' => 'author-avatar' ) ); ?>
								<div class="author-info">
									<h3><?php esc_html_e( 'About ', 'luminous-blog' ); ?><?php the_author(); ?></h3>
									<?php
									$author_role = get_user_meta( get_the_author_meta( 'ID' ), 'author_role', true );
									if ( ! empty( $author_role ) ) {
										?>
										<div class="author-role"><?php echo esc_html( $author_role ); ?></div>
										<?php
									}
									?>
								</div>
							</div>

							<div class="author-bio">
								<?php the_author_meta( 'description' ); ?>
							</div>

							<!-- Author Social Links -->
							<div class="author-social">
								<?php
								$social_links = array(
									'twitter'   => 'fab fa-twitter',
									'facebook'  => 'fab fa-facebook',
									'linkedin'  => 'fab fa-linkedin',
									'instagram' => 'fab fa-instagram',
									'website'   => 'fas fa-globe',
								);

								foreach ( $social_links as $social => $icon ) {
									$meta_key = $social === 'website' ? 'user_url' : 'author_' . $social;
									if ( 'website' !== $social ) {
										$link = get_user_meta( get_the_author_meta( 'ID' ), $meta_key, true );
									} else {
										$link = get_the_author_meta( 'user_url' );
									}

									if ( ! empty( $link ) ) {
										printf(
											'<a href="%s" target="_blank" rel="noopener noreferrer" aria-label="%s"><i class="%s"></i></a>',
											esc_url( $link ),
											esc_attr( ucfirst( $social ) ),
											esc_attr( $icon )
										);
									}
								}
								?>
							</div>
						</div>
						<?php
					}
					?>

				</article><!-- #post-<?php the_ID(); ?> -->

				<?php
				// Related posts
				get_template_part( 'template-parts/related-posts' );

				// Comments
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				// Navigation
				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'luminous-blog' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'luminous-blog' ) . '</span> <span class="nav-title">%title</span>',
					)
				);
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
