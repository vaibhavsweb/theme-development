<?php
/**
 * Luminous Blog Theme Functions
 * 
 * @package Luminous_Blog
 * @version 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Set up theme defaults and register support for WordPress features
 *
 * @return void
 */
function luminous_blog_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'luminous-blog', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'luminous-blog' ),
			'footer'  => esc_html__( 'Footer Menu', 'luminous-blog' ),
		)
	);

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Add support for WordPress block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for custom spacing.
	add_theme_support( 'custom-spacing' );

	// Add support for custom colors.
	add_theme_support( 'custom-colors' );

	// Add support for custom font sizes.
	add_theme_support( 'custom-font-sizes' );

	// Add support for alignment.
	add_theme_support( 'align-wide' );

	// Add custom logo support.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 100,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Add excerpt support for pages.
	add_post_type_support( 'page', 'excerpt' );

	// Set up the WordPress core custom header feature.
	add_theme_support(
		'custom-header',
		apply_filters(
			'luminous_blog_custom_header_args',
			array(
				'default-image' => '',
				'width'         => 1200,
				'height'        => 400,
				'flex-height'   => true,
				'flex-width'    => true,
			)
		)
	);

	// Set content width.
	if ( ! isset( $content_width ) ) {
		$content_width = 1200;
	}
}

add_action( 'after_setup_theme', 'luminous_blog_setup' );

/**
 * Register widget areas
 *
 * @return void
 */
function luminous_blog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'luminous-blog' ),
			'id'            => 'primary-sidebar',
			'description'   => esc_html__( 'Widgets in this area will appear in the sidebar', 'luminous-blog' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widget Area', 'luminous-blog' ),
			'id'            => 'footer-widget',
			'description'   => esc_html__( 'Widgets in this area will appear in the footer', 'luminous-blog' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'luminous_blog_widgets_init' );

/**
 * Enqueue scripts and styles
 *
 * @return void
 */
function luminous_blog_scripts() {
	// Google Fonts: Playfair Display & Inter
	wp_enqueue_style(
		'luminous-blog-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	// Font Awesome Icons
	wp_enqueue_style(
		'font-awesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
		array(),
		'6.4.0'
	);

	// Main stylesheet
	wp_enqueue_style(
		'luminous-blog-style',
		get_stylesheet_uri(),
		array(),
		filemtime( get_template_directory() . '/style.css' )
	);

	// Main JavaScript
	wp_enqueue_script(
		'luminous-blog-script',
		get_template_directory_uri() . '/js/main.js',
		array(),
		filemtime( get_template_directory() . '/js/main.js' ),
		true
	);

	// Localize script for AJAX
	wp_localize_script(
		'luminous-blog-script',
		'luminousBlog',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		)
	);

	// Threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'luminous_blog_scripts' );

/**
 * Add custom logo class to body
 *
 * @param array $classes Body classes.
 * @return array
 */
function luminous_blog_body_classes( $classes ) {
	if ( has_custom_logo() ) {
		$classes[] = 'has-custom-logo';
	}

	if ( is_single() || is_page() ) {
		$classes[] = 'single-content';
	}

	if ( is_home() || is_archive() ) {
		$classes[] = 'archive-content';
	}

	return $classes;
}

add_filter( 'body_class', 'luminous_blog_body_classes' );

/**
 * Filter the excerpt "read more" text
 *
 * @param string $more More text.
 * @return string
 */
function luminous_blog_excerpt_more( $more ) {
	return '';
}

add_filter( 'excerpt_more', 'luminous_blog_excerpt_more' );

/**
 * Custom excerpt length
 *
 * @param int $length Excerpt length.
 * @return int
 */
function luminous_blog_excerpt_length( $length ) {
	return 25;
}

add_filter( 'excerpt_length', 'luminous_blog_excerpt_length' );

/**
 * Add featured image to RSS feed
 *
 * @return void
 */
function luminous_blog_rss_post_thumbnail() {
	global $post;

	if ( has_post_thumbnail( $post->ID ) ) {
		echo get_the_post_thumbnail( $post->ID );
	}
}

add_filter( 'the_excerpt_rss', 'luminous_blog_rss_post_thumbnail' );

/**
 * Customize the comment form
 *
 * @param array $args Comment form arguments.
 * @return array
 */
function luminous_blog_comment_form_args( $args ) {
	$args['class_form'] = 'comment-form';
	$args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-label="' . esc_attr__( 'Comment', 'luminous-blog' ) . '" required="required"></textarea></p>';

	return $args;
}

add_filter( 'comment_form_defaults', 'luminous_blog_comment_form_args' );

/**
 * Add admin styles for the WordPress admin
 *
 * @return void
 */
function luminous_blog_admin_styles() {
	wp_enqueue_style(
		'luminous-blog-admin',
		get_template_directory_uri() . '/css/admin.css',
		array(),
		filemtime( get_template_directory() . '/css/admin.css' )
	);
}

add_action( 'admin_enqueue_scripts', 'luminous_blog_admin_styles' );

/**
 * Get featured image with fallback
 *
 * @param int    $post_id Post ID.
 * @param string $size Image size.
 * @return string
 */
function luminous_blog_get_featured_image( $post_id = 0, $size = 'post-thumbnail' ) {
	if ( ! $post_id ) {
		$post_id = get_the_ID();
	}

	if ( has_post_thumbnail( $post_id ) ) {
		return get_the_post_thumbnail( $post_id, $size );
	}

	return '<div class="post-card-image" style="background: linear-gradient(135deg, #d7bde2, #ecb3ae); width: 100%; height: 180px;"></div>';
}

/**
 * Custom pagination function
 *
 * @param int $max_pages Maximum pages.
 * @return void
 */
function luminous_blog_pagination( $max_pages = 0 ) {
	if ( empty( $max_pages ) ) {
		global $wp_query;
		$max_pages = $wp_query->max_num_pages;
	}

	if ( $max_pages <= 1 ) {
		return;
	}

	echo wp_kses_post( paginate_links(
		array(
			'mid_size'           => 2,
			'prev_text'          => '←',
			'next_text'          => '→',
			'before_page_number' => '',
		)
	) );
}

/**
 * Get post meta information
 *
 * @return void
 */
function luminous_blog_post_meta() {
	?>
	<div class="post-meta">
		<div class="post-meta-item post-date">
			<i class="fas fa-calendar-alt"></i>
			<span><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></span>
		</div>

		<?php if ( has_category() ) : ?>
			<div class="post-meta-item post-category">
				<?php the_category( ', ' ); ?>
			</div>
		<?php endif; ?>

		<div class="post-meta-item post-author">
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 20, '', '', array( 'class' => 'post-author-avatar' ) ); ?>
			<span><?php echo esc_html( get_the_author() ); ?></span>
		</div>

		<div class="post-meta-item">
			<i class="fas fa-comment"></i>
			<span><?php echo esc_html( get_comments_number() ); ?></span>
		</div>
	</div>
	<?php
}

/**
 * Check if there is a custom excerpt
 *
 * @return bool
 */
function luminous_blog_has_custom_excerpt() {
	global $post;
	return ! empty( $post->post_excerpt );
}

/**
 * Enqueue admin CSS
 *
 * @return void
 */
function luminous_blog_enqueue_admin_css() {
	echo '<style>
		:root {
			--color-accent: #e74c3c;
		}
		.wp-admin .luminous-blog-logo {
			width: 32px;
			height: 32px;
			background: linear-gradient(135deg, #e74c3c, #8e44ad);
			border-radius: 50%;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			color: white;
			font-weight: bold;
			margin-right: 8px;
		}
	</style>';
}

add_action( 'admin_head', 'luminous_blog_enqueue_admin_css' );

/**
 * Include customizer file
 */
require_once get_template_directory() . '/inc/customizer.php';
