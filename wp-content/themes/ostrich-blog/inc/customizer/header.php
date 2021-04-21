<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Header panel
 */

$wp_customize->add_panel(
	'ostrich_blog_header_panel',
	array(
		'title' => esc_html__( 'Header', 'ostrich-blog' ),
		'priority' => 100
	)
);



// Header section
$wp_customize->add_section(
	'ostrich_blog_header_section',
	array(
		'title' => esc_html__( 'Header', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_header_panel',
	)
);

// Header menu sticky enable settings
$wp_customize->add_setting(
	'ostrich_blog_make_menu_sticky',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => false
	)
);

$wp_customize->add_control(
	'ostrich_blog_make_menu_sticky',
	array(
		'section'		=> 'ostrich_blog_header_section',
		'label'			=> esc_html__( 'Make menu sticky.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

// Header menu sticky enable settings
$wp_customize->add_setting(
	'ostrich_blog_header_style',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'header-1'
	)
);

$wp_customize->add_control(
	'ostrich_blog_header_style',
	array(
		'section'		=> 'ostrich_blog_header_section',
		'label'			=> esc_html__( 'Select Header Style', 'ostrich-blog' ),
		'type'			=> 'select',
		'choices'		=> array( 
				'header-1' => esc_html__( 'Header 1', 'ostrich-blog' ),
				'header-2' => esc_html__( 'Header 2', 'ostrich-blog' ),
		 	)
	)
);


$wp_customize->add_setting(
	'ostrich_blog_header_display',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'ads',
	)
);

$wp_customize->add_control(
	'ostrich_blog_header_display',
	array(
		'section'		=> 'ostrich_blog_header_section',
		'label'			=> esc_html__( 'Header Display Option', 'ostrich-blog' ),
		'type'			=> 'select',
		'active_callback'	=> 'ostrich_blog_if_header_style',
		'choices'		=> array( 
				'social-menu' => esc_html__( 'Social Menu', 'ostrich-blog' ),
				'none' => esc_html__( 'Nothing', 'ostrich-blog' ),
				'ads' => esc_html__( 'Add Banner Image', 'ostrich-blog' ),
		 	)
	)
);

$wp_customize->add_setting(
	'ostrich_blog_nav_search',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true
	)
);

$wp_customize->add_control(
	'ostrich_blog_nav_search',
	array(
		'section'		=> 'ostrich_blog_header_section',
		'label'			=> esc_html__( 'Enable Search Form', 'ostrich-blog' ),
		'type'			=> 'checkbox',
		'active_callback'	=> 'ostrich_blog_if_header_nav_search',
	)
);

// ads image setting and control.
$wp_customize->add_setting( 'ostrich_blog_header_ads_image', array(
	'sanitize_callback' => 'ostrich_blog_sanitize_image',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ostrich_blog_header_ads_image',
	array(
	'label'       		=> esc_html__( 'Ads Image', 'ostrich-blog' ),
	'description' 		=> sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'ostrich-blog' ), 810, 120 ),
	'section'     		=> 'ostrich_blog_header_section',
	'active_callback'	=> 'ostrich_blog_if_header_ads',
) ) );

// ads link setting and control
$wp_customize->add_setting( 'ostrich_blog_header_ads_image_url', array(
	'sanitize_callback' => 'esc_url_raw',
) );

$wp_customize->add_control( 'ostrich_blog_header_ads_image_url', array(
	'label'           	=> esc_html__( 'Ads Url', 'ostrich-blog' ),
	'section'        	=> 'ostrich_blog_header_section',
	'type'				=> 'url',
	'active_callback'	=> 'ostrich_blog_if_header_ads',
) );
