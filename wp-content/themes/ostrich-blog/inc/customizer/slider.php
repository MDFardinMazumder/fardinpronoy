<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Posts Slider section
 */

$wp_customize->add_section(
	'ostrich_blog_post_slider',
	array(
		'title' => esc_html__( 'Post Thumbnail Slider', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_home_panel',
	)
);

// post_slider enable settings
$wp_customize->add_setting(
	'ostrich_blog_post_slider',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'disable'
	)
);

$wp_customize->add_control(
	'ostrich_blog_post_slider',
	array(
		'section'		=> 'ostrich_blog_post_slider',
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
	// post_slider post setting
	$wp_customize->add_setting(
		'ostrich_blog_post_slider_post_'.$i,
		array(
			'sanitize_callback' => 'ostrich_blog_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'ostrich_blog_post_slider_post_'.$i,
		array(
			'section'		=> 'ostrich_blog_post_slider',
			'label'			=> esc_html__( 'Post ', 'ostrich-blog' ).$i,
			'active_callback' => 'ostrich_blog_if_post_slider_post',
			'type'			=> 'select',
			'choices'		=> ostrich_blog_get_post_choices(),
		)
	);

	// post_slider page setting
	$wp_customize->add_setting(
		'ostrich_blog_post_slider_page_'.$i,
		array(
			'sanitize_callback' => 'ostrich_blog_sanitize_dropdown_pages',
			'default' => 0,
		)
	);

	$wp_customize->add_control(
		'ostrich_blog_post_slider_page_'.$i,
		array(
			'section'		=> 'ostrich_blog_post_slider',
			'label'			=> esc_html__( 'Page ', 'ostrich-blog' ).$i,
			'type'			=> 'dropdown-pages',
			'active_callback' => 'ostrich_blog_if_post_slider_page'
		)
	);
}
