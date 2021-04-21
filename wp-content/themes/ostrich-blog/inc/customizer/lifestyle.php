<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * lifestyle section
 */

$wp_customize->add_section(
	'ostrich_blog_lifestyle',
	array(
		'title' => esc_html__( 'Lifestyle', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_home_panel',
	)
);

// lifestyle enable settings
$wp_customize->add_setting(
	'ostrich_blog_lifestyle',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'disable'
	)
);

$wp_customize->add_control(
	'ostrich_blog_lifestyle',
	array(
		'section'		=> 'ostrich_blog_lifestyle',
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
$wp_customize->add_setting(
	'ostrich_blog_lifestyle_title',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default' => esc_html__( 'lifestyle Posts', 'ostrich-blog' ),
		'transport'	=> 'postMessage',
	)
);

$wp_customize->add_control(
	'ostrich_blog_lifestyle_title',
	array(
		'section'		=> 'ostrich_blog_lifestyle',
		'label'			=> esc_html__( 'Title:', 'ostrich-blog' ),
		'active_callback'	=> 'ostrich_blog_if_lifestyle_enabled',
	)
);

$wp_customize->selective_refresh->add_partial( 
	'ostrich_blog_lifestyle_title', 
	array(
        'selector'            => '#lifestyle .section-title',
		'render_callback'     => 'ostrich_blog_lifestyle_partial_title',
	) 
);



for ($i=1; $i <= 6 ; $i++) { 
	// lifestyle post setting
	$wp_customize->add_setting(
		'ostrich_blog_lifestyle_post_'.$i,
		array(
			'sanitize_callback' => 'ostrich_blog_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'ostrich_blog_lifestyle_post_'.$i,
		array(
			'section'		=> 'ostrich_blog_lifestyle',
			'label'			=> esc_html__( 'Post ', 'ostrich-blog' ).$i,
			'active_callback' => 'ostrich_blog_if_lifestyle_post',
			'type'			=> 'select',
			'choices'		=> ostrich_blog_get_post_choices(),
		)
	);

	// lifestyle page setting
	$wp_customize->add_setting(
		'ostrich_blog_lifestyle_page_'.$i,
		array(
			'sanitize_callback' => 'ostrich_blog_sanitize_dropdown_pages',
			'default' => 0,
		)
	);

	$wp_customize->add_control(
		'ostrich_blog_lifestyle_page_'.$i,
		array(
			'section'		=> 'ostrich_blog_lifestyle',
			'label'			=> esc_html__( 'Page ', 'ostrich-blog' ).$i,
			'type'			=> 'dropdown-pages',
			'active_callback' => 'ostrich_blog_if_lifestyle_page'
		)
	);
}
