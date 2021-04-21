<?php
/*Blog Page Settings*/
$wp_customize->add_section(
	'blog_page_settings',
	array(
		'priority'       => 6,
		'panel'          => 'faith-blog',
		'title'          => __( 'Blog Settings', 'faith-blog' ),
		'description'    => __( 'Customize Blog Page', 'faith-blog' ),
		'capability'     => 'edit_theme_options',
	)
);


$wp_customize->add_setting(
	'grid_column',
	array(
		'default' => 'col-sm-4',
		'transport'            => 'refresh', // Options: refresh or postMessage.
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'faith_blog_sanitize_radio'
	)
);
$wp_customize->add_control(
	'grid_column',
	array(
		'label'       => __( 'Grid Column', 'faith-blog' ),
		'section'     => 'blog_page_settings',
		'type'        => 'radio',
		'choices'  => array(
			'col-sm-3'  => __( '4 Colmun', 'faith-blog' ),
			'col-sm-4' => __( '3 Column', 'faith-blog' ),
			'col-sm-6' => __( '2 Column', 'faith-blog' ),
		),
	)
);
$wp_customize->add_setting(
	'blog_page_sidebar',
	array(
		'default' => 'no',
		'transport'            => 'refresh', // Options: refresh or postMessage.
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'faith_blog_sanitize_radio'
	)
);
$wp_customize->add_control(
	'blog_page_sidebar',
	array(
		'label'       => __( 'Blog & Archive Page Sidebar', 'faith-blog' ),
		'section'     => 'blog_page_settings',
		'type'        => 'radio',
		'choices'  => array(
			'left'  => __( 'Left Sidebar', 'faith-blog' ),
			'right' => __( 'Right Sidebar', 'faith-blog' ),
			'no' => __( 'No Sidebar', 'faith-blog' ),
		),
	)
);


$wp_customize->add_setting(
	'blog_page_pagination',
	array(
		'default' => 'center',
		'transport'            => 'refresh', // Options: refresh or postMessage.
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'faith_blog_sanitize_radio'
	)
);
$wp_customize->add_control(
	'blog_page_pagination',
	array(
		'label'       => __( 'Pagination Alignment', 'faith-blog' ),
		'section'     => 'blog_page_settings',
		'type'        => 'radio',
		'choices'  => array(
			'left'  => __( 'Left', 'faith-blog' ),
			'right' => __( 'Right', 'faith-blog' ),
			'center' => __( 'center', 'faith-blog' ),
		),
	)
);
