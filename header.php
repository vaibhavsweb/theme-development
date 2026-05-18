<?php
/**
 * The header for the theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Luminous_Blog
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#2c3e50">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="page" class="site">
		<header id="masthead" class="site-header">
			<div class="container">
				<div class="header-top">
					<!-- Site Branding -->
					<div class="site-branding">
						<?php
						if ( has_custom_logo() ) {
							the_custom_logo();
						} else {
							?>
							<div class="site-logo">
								<i class="fas fa-feather"></i>
							</div>
							<?php
						}
						?>
						<div>
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>
							<?php
							$blog_description = get_bloginfo( 'description', 'display' );
							if ( $blog_description || is_customize_preview() ) :
								?>
								<p class="site-description"><?php echo esc_html( $blog_description ); ?></p>
								<?php
							endif;
							?>
						</div>
					</div>

					<!-- Navigation & Search -->
					<div style="display: flex; gap: 2rem; align-items: center;">
						<!-- Main Navigation -->
						<nav id="site-navigation" class="main-navigation">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'menu_id'        => 'primary-menu',
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
						</nav>

						<!-- Search Bar -->
						<form method="get" class="search-bar" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<input 
								type="search" 
								name="s" 
								placeholder="<?php esc_attr_e( 'Search...', 'luminous-blog' ); ?>" 
								value="<?php echo esc_attr( get_search_query() ); ?>"
							>
							<button type="submit" aria-label="<?php esc_attr_e( 'Search', 'luminous-blog' ); ?>">
								<i class="fas fa-search"></i>
							</button>
						</form>

						<!-- Mobile Menu Toggle -->
						<button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="<?php esc_attr_e( 'Toggle Menu', 'luminous-blog' ); ?>">
							<i class="fas fa-bars"></i>
						</button>
					</div>
				</div>
			</div>
		</header><!-- #masthead -->

		<main id="main" class="site-main">
