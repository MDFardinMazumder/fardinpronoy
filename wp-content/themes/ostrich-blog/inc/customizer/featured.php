<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Featured section
 */
$wp_customize->add_section(
	'ostrich_blog_featured',
	array(
		'title' => esc_html__( 'Featured Post', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_home_panel',
	)
);

// featured enable settings
$wp_customize->add_setting(
	'ostrich_blog_featured',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'disable'
	)
);

$wp_customize->add_control(
	'ostrich_blog_featured',
	array(
		'section'		=> 'ostrich_blog_featured',
		'label'			=> esc_html__( 'Content type:', 'ostrich-blog' ),
		'description'			=> esc_html__( 'Choose where you want to render the content from.', 'ostrich-blog' ),
		'type'			=> 'select',
		'choices'		=> array( 
				'disable' => esc_html__( '--Disable--', 'ostrich-blog' ),
				'page' => esc_html__( 'Page', 'ostrich-blog' )
		 	)
	)
);
$wp_customize->add_setting(
	'ostrich_blog_featured_btn_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => esc_html__( 'Read More', 'ostrich-blog' ),
		'transport'	=> 'postMessage',
	)
);

$wp_customize->add_control(
	'ostrich_blog_featured_btn_title',
	array(
		'section'		=> 'ostrich_blog_featured',
		'label'			=> esc_html__( 'Btn Title:', 'ostrich-blog' ),
		'active_callback'	=> 'ostrich_blog_if_featured_page',
	)
);

$wp_customize->selective_refresh->add_partial( 
	'ostrich_blog_featured_btn_title', 
	array(
        'selector'            => '#featured .section-btn_title',
		'render_callback'     => 'ostrich_blog_fashion_partial_btn_title',
	) 
);


// featured page setting
$wp_customize->add_setting(
	'ostrich_blog_featured_page',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_dropdown_pages',
		'default' => 0,
	)
);

$wp_customize->add_control(
	'ostrich_blog_featured_page',
	array(
		'section'		=> 'ostrich_blog_featured',
		'label'			=> esc_html__( 'Page ', 'ostrich-blog' ),
		'type'			=> 'dropdown-pages',
		'active_callback' => 'ostrich_blog_if_featured_page'
	)
);
