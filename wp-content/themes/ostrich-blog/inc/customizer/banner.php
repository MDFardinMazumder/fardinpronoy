<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * banner section
 */

$wp_customize->add_section(
	'ostrich_blog_banner',
	array(
		'title' => esc_html__( 'Banner', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_home_panel',
	)
);

// banner enable settings
$wp_customize->add_setting(
	'ostrich_blog_banner',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'disable'
	)
);

$wp_customize->add_control(
	'ostrich_blog_banner',
	array(
		'section'		=> 'ostrich_blog_banner',
		'label'			=> esc_html__( 'Content type:', 'ostrich-blog' ),
		'description'			=> esc_html__( 'Choose where you want to render the content from.', 'ostrich-blog' ),
		'type'			=> 'select',
		'choices'		=> array( 
				'disable' => esc_html__( '--Disable--', 'ostrich-blog' ),
				'post' => esc_html__( 'Post', 'ostrich-blog' ),
				'page' => esc_html__( 'Page', 'ostrich-blog' ),
		 	)
	)
);


for ($i=1; $i <= 6 ; $i++) { 
	// banner post setting
	$wp_customize->add_setting(
		'ostrich_blog_banner_post_'.$i,
		array(
			'sanitize_callback' => 'ostrich_blog_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'ostrich_blog_banner_post_'.$i,
		array(
			'section'		=> 'ostrich_blog_banner',
			'label'			=> esc_html__( 'Post ', 'ostrich-blog' ).$i,
			'active_callback' => 'ostrich_blog_if_banner_post',
			'type'			=> 'select',
			'choices'		=> ostrich_blog_get_post_choices(),
		)
	);

	// banner page setting
	$wp_customize->add_setting(
		'ostrich_blog_banner_page_'.$i,
		array(
			'sanitize_callback' => 'ostrich_blog_sanitize_dropdown_pages',
			'default' => 0,
		)
	);

	$wp_customize->add_control(
		'ostrich_blog_banner_page_'.$i,
		array(
			'section'		=> 'ostrich_blog_banner',
			'label'			=> esc_html__( 'Page ', 'ostrich-blog' ).$i,
			'type'			=> 'dropdown-pages',
			'active_callback' => 'ostrich_blog_if_banner_page'
		)
	);
}