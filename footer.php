<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Luminous_Blog
 */

?>
		</main><!-- #main -->

		<footer id="colophon" class="site-footer">
			<div class="container">
				<!-- Footer Widgets -->
				<div class="footer-content">
					<?php
					// Display footer widget area
					if ( is_active_sidebar( 'footer-widget' ) ) {
						dynamic_sidebar( 'footer-widget' );
					} else {
						// Default footer content if no widgets
						?>
						<div class="footer-widget">
							<h3><?php esc_html_e( 'About This Blog', 'luminous-blog' ); ?></h3>
							<p>
								<?php
								bloginfo( 'description' );
								?>
							</p>
						</div>

						<div class="footer-widget">
							<h3><?php esc_html_e( 'Quick Links', 'luminous-blog' ); ?></h3>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
									'fallback_cb'    => function() {
										echo '<ul>';
										echo '<li><a href="' . esc_url( home_url( '/blog' ) ) . '">Blog</a></li>';
										echo '<li><a href="' . esc_url( home_url( '/about' ) ) . '">About</a></li>';
										echo '<li><a href="' . esc_url( home_url( '/contact' ) ) . '">Contact</a></li>';
										echo '</ul>';
									},
								)
							);
							?>
						</div>

						<div class="footer-widget">
							<h3><?php esc_html_e( 'Follow Us', 'luminous-blog' ); ?></h3>
							<p><?php esc_html_e( 'Connect with us on social media', 'luminous-blog' ); ?></p>
						</div>
						<?php
					}
					?>
				</div>

				<!-- Footer Bottom -->
				<div class="footer-bottom">
					<div class="footer-copyright">
						<p>
							&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> 
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php bloginfo( 'name' ); ?>
							</a> 
							| <?php esc_html_e( 'Powered by WordPress', 'luminous-blog' ); ?>
						</p>
					</div>

					<!-- Social Links -->
					<div class="footer-social">
						<?php
						$social_links = array(
							'twitter'   => 'fab fa-twitter',
							'facebook'  => 'fab fa-facebook',
							'linkedin'  => 'fab fa-linkedin',
							'instagram' => 'fab fa-instagram',
						);

						foreach ( $social_links as $social => $icon ) {
							$link = get_theme_mod( 'luminous_blog_' . $social . '_url' );
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
			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>
