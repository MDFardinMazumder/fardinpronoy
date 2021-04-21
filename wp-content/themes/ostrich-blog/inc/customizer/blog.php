<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * blog section
 */
$wp_customize->add_section(
	'ostrich_blog_blog',
	array(
		'title' => esc_html__( 'Blog Post', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_home_panel',
	)
);
// blog enable settings
$wp_customize->add_setting(
	'ostrich_blog_blog',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'disable'
	)
);
$wp_customize->add_control(
	'ostrich_blog_blog',
	array(
		'section'		=> 'ostrich_blog_blog',
		'label'			=> esc_html__( 'Content type:', 'ostrich-blog' ),
		'description'			=> esc_html__( 'Choose where you want to render the content from.', 'ostrich-blog' ),
		'type'			=> 'select',
		'choices'		=> array(
				'disable' => esc_html__( '--Disable--', 'ostrich-blog' ),
				'cat' => esc_html__( 'Category', 'ostrich-blog' ),
				'recent' => esc_html__( 'Recent', 'ostrich-blog' ),
		 	)
	)
);

$wp_customize->add_setting(
	'ostrich_blog_blog_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => esc_html__( 'More Articles', 'ostrich-blog' ),
		'transport'	=> 'postMessage',
	)
);
$wp_customize->add_control(
	'ostrich_blog_blog_title',
	array(
		'section'		=> 'ostrich_blog_blog',
		'label'			=> esc_html__( 'Section Title:', 'ostrich-blog' ),
		'active_callback' => 'ostrich_blog_if_blog_enabled'
	)
);
$wp_customize->selective_refresh->add_partial(
	'ostrich_blog_blog_title',
	array(
        'selector'            => '#inner-content-wrapper .section-title',
		'render_callback'     => 'ostrich_blog_blog_partial_title',
	)
);
$wp_customize->add_setting(
	'ostrich_blog_blog_btn_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => esc_html__( 'Load More', 'ostrich-blog' ),
		'transport'	=> 'postMessage',
	)
);
$wp_customize->add_control(
	'ostrich_blog_blog_btn_title',
	array(
		'section'		=> 'ostrich_blog_blog',
		'label'			=> esc_html__( 'Btn Title:', 'ostrich-blog' ),
		'active_callback' => 'ostrich_blog_if_blog_enabled'
	)
);
$wp_customize->selective_refresh->add_partial(
	'ostrich_blog_blog_btn_title',
	array(
        'selector'            => '#inner-content-wrapper .read-more a',
		'render_callback'     => 'ostrich_blog_blog_partial_btn_title',
	)
);
$wp_customize->add_setting(
	'ostrich_blog_blog_btn_url',
	array(
		'sanitize_callback' => 'esc_url_raw',
	)
);
$wp_customize->add_control(
	'ostrich_blog_blog_btn_url',
	array(
		'section'		=> 'ostrich_blog_blog',
		'label'			=> esc_html__( 'Btn Url:', 'ostrich-blog' ),
		'type'			=> 'url',
		'active_callback' => 'ostrich_blog_if_blog_enabled'
	)
);


// blog category setting
$wp_customize->add_setting(
	'ostrich_blog_blog_cat',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
	)
);
$wp_customize->add_control(
	'ostrich_blog_blog_cat',
	array(
		'section'		=> 'ostrich_blog_blog',
		'label'			=> esc_html__( 'Category:', 'ostrich-blog' ),
		'active_callback' => 'ostrich_blog_if_blog_cat',
		'type'			=> 'select',
		'choices'		=> ostrich_blog_get_post_cat_choices(),
	)
);