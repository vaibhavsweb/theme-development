<?php
/**
 * Luminous Blog Theme Customizer
 *
 * @package Luminous_Blog
 */

/**
 * Add custom theme customization settings
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function luminous_blog_customize_register( $wp_customize ) {
	// Remove default colors if needed
	$wp_customize->remove_control( 'blogdescription_color' );

	// Add custom section for blog settings
	$wp_customize->add_section(
		'luminous_blog_settings',
		array(
			'title'      => esc_html__( 'Luminous Blog Settings', 'luminous-blog' ),
			'priority'   => 30,
			'capability' => 'edit_theme_options',
		)
	);

	// Posts per page setting
	$wp_customize->add_setting(
		'luminous_blog_posts_per_page',
		array(
			'default'           => 10,
			'sanitize_callback' => 'absint',
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		'luminous_blog_posts_per_page',
		array(
			'label'       => esc_html__( 'Posts Per Page', 'luminous-blog' ),
			'description' => esc_html__( 'Number of posts to display per page in archives', 'luminous-blog' ),
			'section'     => 'luminous_blog_settings',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 50,
			),
		)
	);

	// Blog sidebar width
	$wp_customize->add_setting(
		'luminous_blog_sidebar_width',
		array(
			'default'           => '300px',
			'sanitize_callback' => 'sanitize_text_field',
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		'luminous_blog_sidebar_width',
		array(
			'label'   => esc_html__( 'Sidebar Width', 'luminous-blog' ),
			'section' => 'luminous_blog_settings',
			'type'    => 'select',
			'choices' => array(
				'250px'  => esc_html__( 'Narrow', 'luminous-blog' ),
				'300px'  => esc_html__( 'Default', 'luminous-blog' ),
				'350px'  => esc_html__( 'Wide', 'luminous-blog' ),
			),
		)
	);

	// Accent color setting
	$wp_customize->add_setting(
		'luminous_blog_accent_color',
		array(
			'default'           => '#e74c3c',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'luminous_blog_accent_color',
			array(
				'label'   => esc_html__( 'Accent Color', 'luminous-blog' ),
				'section' => 'luminous_blog_settings',
			)
		)
	);

	// Primary color setting
	$wp_customize->add_setting(
		'luminous_blog_primary_color',
		array(
			'default'           => '#2c3e50',
			'sanitize_callback' => 'sanitize_hex_color',
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'luminous_blog_primary_color',
			array(
				'label'   => esc_html__( 'Primary Color', 'luminous-blog' ),
				'section' => 'luminous_blog_settings',
			)
		)
	);

	// Social media section
	$wp_customize->add_section(
		'luminous_blog_social',
		array(
			'title'      => esc_html__( 'Social Media Links', 'luminous-blog' ),
			'priority'   => 40,
			'capability' => 'edit_theme_options',
		)
	);

	$social_links = array(
		'twitter'   => esc_html__( 'Twitter URL', 'luminous-blog' ),
		'facebook'  => esc_html__( 'Facebook URL', 'luminous-blog' ),
		'linkedin'  => esc_html__( 'LinkedIn URL', 'luminous-blog' ),
		'instagram' => esc_html__( 'Instagram URL', 'luminous-blog' ),
		'youtube'   => esc_html__( 'YouTube URL', 'luminous-blog' ),
	);

	foreach ( $social_links as $social => $label ) {
		$wp_customize->add_setting(
			'luminous_blog_' . $social . '_url',
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
				'type'              => 'option',
			)
		);

		$wp_customize->add_control(
			'luminous_blog_' . $social . '_url',
			array(
				'label'   => $label,
				'section' => 'luminous_blog_social',
				'type'    => 'url',
			)
		);
	}

	// Display settings
	$wp_customize->add_section(
		'luminous_blog_display',
		array(
			'title'      => esc_html__( 'Display Settings', 'luminous-blog' ),
			'priority'   => 50,
			'capability' => 'edit_theme_options',
		)
	);

	// Show featured images
	$wp_customize->add_setting(
		'luminous_blog_show_featured_images',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		'luminous_blog_show_featured_images',
		array(
			'label'   => esc_html__( 'Show Featured Images in Lists', 'luminous-blog' ),
			'section' => 'luminous_blog_display',
			'type'    => 'checkbox',
		)
	);

	// Show excerpt on archives
	$wp_customize->add_setting(
		'luminous_blog_show_excerpt',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		'luminous_blog_show_excerpt',
		array(
			'label'   => esc_html__( 'Show Excerpt on Archive Pages', 'luminous-blog' ),
			'section' => 'luminous_blog_display',
			'type'    => 'checkbox',
		)
	);

	// Show related posts
	$wp_customize->add_setting(
		'luminous_blog_show_related_posts',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		'luminous_blog_show_related_posts',
		array(
			'label'   => esc_html__( 'Show Related Posts', 'luminous-blog' ),
			'section' => 'luminous_blog_display',
			'type'    => 'checkbox',
		)
	);

	// Author box toggle
	$wp_customize->add_setting(
		'luminous_blog_show_author_box',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'type'              => 'option',
		)
	);

	$wp_customize->add_control(
		'luminous_blog_show_author_box',
		array(
			'label'   => esc_html__( 'Show Author Box on Posts', 'luminous-blog' ),
			'section' => 'luminous_blog_display',
			'type'    => 'checkbox',
		)
	);
}

add_action( 'customize_register', 'luminous_blog_customize_register' );

/**
 * Generate custom CSS from customizer settings
 *
 * @return void
 */
function luminous_blog_customize_css() {
	$accent_color   = get_option( 'luminous_blog_accent_color', '#e74c3c' );
	$primary_color  = get_option( 'luminous_blog_primary_color', '#2c3e50' );
	$sidebar_width  = get_option( 'luminous_blog_sidebar_width', '300px' );

	$css = sprintf(
		':root { --color-accent: %s; --color-primary: %s; } .primary-sidebar { width: %s; }',
		esc_attr( $accent_color ),
		esc_attr( $primary_color ),
		esc_attr( $sidebar_width )
	);

	wp_add_inline_style( 'luminous-blog-style', $css );
}

add_action( 'wp_enqueue_scripts', 'luminous_blog_customize_css' );
