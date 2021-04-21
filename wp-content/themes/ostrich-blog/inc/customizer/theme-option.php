<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * advance setting
 */

$wp_customize->add_panel(
	'ostrich_blog_general_panel',
	array(
		'title' => esc_html__( 'Theme Options', 'ostrich-blog' ),
		'priority' => 107
	)
);


// Header section
$wp_customize->add_section(
	'ostrich_blog_header_section',
	array(
		'title' => esc_html__( 'Header', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_general_panel',
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


/**
 * General settings
 */
// General settings
$wp_customize->add_section(
	'ostrich_blog_general_section',
	array(
		'title' => esc_html__( 'General', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_general_panel',
	)
);

// Breadcrumb enable setting
$wp_customize->add_setting(
	'ostrich_blog_breadcrumb_enable',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_breadcrumb_enable',
	array(
		'section'		=> 'ostrich_blog_general_section',
		'label'			=> esc_html__( 'Enable breadcrumb.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

// Backtop enable setting
$wp_customize->add_setting(
	'ostrich_blog_back_to_top_enable',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_back_to_top_enable',
	array(
		'section'		=> 'ostrich_blog_general_section',
		'label'			=> esc_html__( 'Enable Scroll up.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

/**
 * Global Layout
 */
// Global Layout
$wp_customize->add_section(
	'ostrich_blog_global_layout',
	array(
		'title' => esc_html__( 'Global Layout', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_general_panel',
	)
);

// Global site layout setting
$wp_customize->add_setting(
	'ostrich_blog_site_layout',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'wide',
		'transport'	=> 'postMessage',
	)
);

$wp_customize->add_control(
	'ostrich_blog_site_layout',
	array(
		'section'		=> 'ostrich_blog_global_layout',
		'label'			=> esc_html__( 'Site layout', 'ostrich-blog' ),
		'type'			=> 'radio',
		'choices'		=> array( 
			'boxed' => esc_html__( 'Boxed', 'ostrich-blog' ), 
			'wide' => esc_html__( 'Wide', 'ostrich-blog' ), 
			'frame' => esc_html__( 'Frame', 'ostrich-blog' ), 
		),
	)
);

// Global archive layout setting
$wp_customize->add_setting(
	'ostrich_blog_archive_sidebar',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'right',
	)
);

$wp_customize->add_control(
	'ostrich_blog_archive_sidebar',
	array(
		'section'		=> 'ostrich_blog_global_layout',
		'label'			=> esc_html__( 'Archive Sidebar', 'ostrich-blog' ),
		'description'			=> esc_html__( 'This option works on all archive pages like: 404, search, date, category, "Your latest posts" and so on.', 'ostrich-blog' ),
		'type'			=> 'radio',
		'choices'		=> array( 
			'left' => esc_html__( 'Left', 'ostrich-blog' ), 
			'right' => esc_html__( 'Right', 'ostrich-blog' ), 
			'no' => esc_html__( 'No Sidebar', 'ostrich-blog' ), 
		),
	)
);

// Global page layout setting
$wp_customize->add_setting(
	'ostrich_blog_global_page_layout',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'right',
	)
);

$wp_customize->add_control(
	'ostrich_blog_global_page_layout',
	array(
		'section'		=> 'ostrich_blog_global_layout',
		'label'			=> esc_html__( 'Global page sidebar', 'ostrich-blog' ),
		'description'			=> esc_html__( 'This option works only on single pages including "Posts page". This setting can be overridden for single page from the metabox too.', 'ostrich-blog' ),
		'type'			=> 'radio',
		'choices'		=> array( 
			'left' => esc_html__( 'Left', 'ostrich-blog' ), 
			'right' => esc_html__( 'Right', 'ostrich-blog' ), 
			'no' => esc_html__( 'No Sidebar', 'ostrich-blog' ), 
		),
	)
);

// Global post layout setting
$wp_customize->add_setting(
	'ostrich_blog_global_post_layout',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'right',
	)
);

$wp_customize->add_control(
	'ostrich_blog_global_post_layout',
	array(
		'section'		=> 'ostrich_blog_global_layout',
		'label'			=> esc_html__( 'Global post sidebar', 'ostrich-blog' ),
		'description'			=> esc_html__( 'This option works only on single posts. This setting can be overridden for single post from the metabox too.', 'ostrich-blog' ),
		'type'			=> 'radio',
		'choices'		=> array( 
			'left' => esc_html__( 'Left', 'ostrich-blog' ), 
			'right' => esc_html__( 'Right', 'ostrich-blog' ), 
			'no' => esc_html__( 'No Sidebar', 'ostrich-blog' ), 
		),
	)
);

/**
 * Blog/Archive section 
 */
// Blog/Archive section 
$wp_customize->add_section(
	'ostrich_blog_archive_settings',
	array(
		'title' => esc_html__( 'Archive/Blog', 'ostrich-blog' ),
		'description' => esc_html__( 'Settings for archive pages including blog page too.', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_general_panel',
	)
);

// Archive excerpt length setting
$wp_customize->add_setting(
	'ostrich_blog_archive_excerpt_length',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_number_range',
		'default' => 20,
	)
);

$wp_customize->add_control(
	'ostrich_blog_archive_excerpt_length',
	array(
		'section'		=> 'ostrich_blog_archive_settings',
		'label'			=> esc_html__( 'Excerpt more length:', 'ostrich-blog' ),
		'type'			=> 'number',
		'input_attrs'   => array( 'min' => 5 ),
	)
);

// Date enable setting
$wp_customize->add_setting(
	'ostrich_blog_enable_archive_date',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_archive_date',
	array(
		'section'		=> 'ostrich_blog_archive_settings',
		'label'			=> esc_html__( 'Enable date.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

// Category enable setting
$wp_customize->add_setting(
	'ostrich_blog_enable_archive_cat',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_archive_cat',
	array(
		'section'		=> 'ostrich_blog_archive_settings',
		'label'			=> esc_html__( 'Enable category.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

// blog image enable setting
$wp_customize->add_setting(
	'ostrich_blog_enable_archive_featured_img',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_archive_featured_img',
	array(
		'section'		=> 'ostrich_blog_archive_settings',
		'label'			=> esc_html__( 'Enable featured image.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

// Content type setting
$wp_customize->add_setting(
	'ostrich_blog_enable_archive_content_type',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'excerpt',
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_archive_content_type',
	array(
		'section'		=> 'ostrich_blog_archive_settings',
		'label'			=> esc_html__( 'Content type:', 'ostrich-blog' ),
		'choices'		=> array(
			'full-content' => esc_html__( 'Full content', 'ostrich-blog' ), 
			'excerpt' => esc_html__( 'Excerpt', 'ostrich-blog' ), 
		),
		'type'			=> 'radio',
	)
);

// Pagination type setting
$wp_customize->add_setting(
	'ostrich_blog_archive_pagination_type',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_select',
		'default' => 'numeric',
	)
);

$archive_pagination_description = '';
$archive_pagination_choices = array( 
			'disable' => esc_html__( '--Disable--', 'ostrich-blog' ),
			'numeric' => esc_html__( 'Numeric', 'ostrich-blog' ),
			'older_newer' => esc_html__( 'Older / Newer', 'ostrich-blog' ),
		);
if ( ! class_exists( 'JetPack' ) ) {
	$archive_pagination_description = sprintf( esc_html__( 'We recommend to install %1$sJetpack%2$s and enable %3$sInfinite Scroll%4$s feature for automatic loading of posts.', 'ostrich-blog' ), '<a target="_blank" href="http://wordpress.org/plugins/jetpack">', '</a>', '<b>', '</b>' );
} else {
	$archive_pagination_choices['infinite_scroll'] = esc_html__( 'Infinite Load', 'ostrich-blog' );
}
$wp_customize->add_control(
	'ostrich_blog_archive_pagination_type',
	array(
		'section'		=> 'ostrich_blog_archive_settings',
		'label'			=> esc_html__( 'Pagination type:', 'ostrich-blog' ),
		'description'			=>  $archive_pagination_description,
		'type'			=> 'select',
		'choices'		=> $archive_pagination_choices,
	)
);

/**
 * Single setting section 
 */
// Single setting section 
$wp_customize->add_section(
	'ostrich_blog_single_settings',
	array(
		'title' => esc_html__( 'Single Posts', 'ostrich-blog' ),
		'description' => esc_html__( 'Settings for all single posts.', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_general_panel',
	)
);

// Date enable setting
$wp_customize->add_setting(
	'ostrich_blog_enable_single_date',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_single_date',
	array(
		'section'		=> 'ostrich_blog_single_settings',
		'label'			=> esc_html__( 'Enable date.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

// Category enable setting
$wp_customize->add_setting(
	'ostrich_blog_enable_single_cat',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_single_cat',
	array(
		'section'		=> 'ostrich_blog_single_settings',
		'label'			=> esc_html__( 'Enable category.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

// Tag enable setting
$wp_customize->add_setting(
	'ostrich_blog_enable_single_tag',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_single_tag',
	array(
		'section'		=> 'ostrich_blog_single_settings',
		'label'			=> esc_html__( 'Enable tags.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

// Comment enable setting
$wp_customize->add_setting(
	'ostrich_blog_enable_single_comment',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_single_comment',
	array(
		'section'		=> 'ostrich_blog_single_settings',
		'label'			=> esc_html__( 'Enable comment.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);


// Author enable setting
$wp_customize->add_setting(
	'ostrich_blog_enable_single_author',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_single_author',
	array(
		'section'		=> 'ostrich_blog_single_settings',
		'label'			=> esc_html__( 'Enable author.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);



// Featured image enable setting
$wp_customize->add_setting(
	'ostrich_blog_enable_single_featured_img',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_single_featured_img',
	array(
		'section'		=> 'ostrich_blog_single_settings',
		'label'			=> esc_html__( 'Enable featured image.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

// Pagination enable setting
$wp_customize->add_setting(
	'ostrich_blog_enable_single_pagination',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_single_pagination',
	array(
		'section'		=> 'ostrich_blog_single_settings',
		'label'			=> esc_html__( 'Enable pagination.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

/**
 * Single pages setting section 
 */
// Single pages setting section 
$wp_customize->add_section(
	'ostrich_blog_single_page_settings',
	array(
		'title' => esc_html__( 'Single Pages', 'ostrich-blog' ),
		'description' => esc_html__( 'Settings for all single pages.', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_general_panel',
	)
);

// Featured image enable setting
$wp_customize->add_setting(
	'ostrich_blog_enable_single_page_featured_img',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_single_page_featured_img',
	array(
		'section'		=> 'ostrich_blog_single_page_settings',
		'label'			=> esc_html__( 'Enable featured image.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

/**
 * Reset all settings
 */
// Reset settings section
$wp_customize->add_section(
	'ostrich_blog_reset_sections',
	array(
		'title' => esc_html__( 'Reset all', 'ostrich-blog' ),
		'description' => esc_html__( 'Reset all settings to default.', 'ostrich-blog' ),
		'panel' => 'ostrich_blog_general_panel',
	)
);

// Reset sortable order setting
$wp_customize->add_setting(
	'ostrich_blog_reset_settings',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => false,
		'transport'	=> 'postMessage',
	)
);

$wp_customize->add_control(
	'ostrich_blog_reset_settings',
	array(
		'section'		=> 'ostrich_blog_reset_sections',
		'label'			=> esc_html__( 'Reset all settings?', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

/**
 *
 *
 * Footer copyright
 *
 *
 */
// Footer copyright
$wp_customize->add_section(
	'ostrich_blog_footer_section',
	array(
		'title' => esc_html__( 'Footer', 'ostrich-blog' ),
		'priority' => 106,
		'panel' => 'ostrich_blog_general_panel',
	)
);


// Footer text enable setting
$wp_customize->add_setting(
	'ostrich_blog_enable_footer_text',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
		'default' => true,
	)
);

$wp_customize->add_control(
	'ostrich_blog_enable_footer_text',
	array(
		'section'		=> 'ostrich_blog_footer_section',
		'label'			=> esc_html__( 'Enable footer text.', 'ostrich-blog' ),
		'type'			=> 'checkbox',
	)
);

// Footer copyright setting
$wp_customize->add_setting(
	'ostrich_blog_copyright_txt',
	array(
		'sanitize_callback' => 'ostrich_blog_sanitize_html',
		'default' => $default['ostrich_blog_copyright_txt'],
		'transport'	=> 'postMessage',
	)
);

$wp_customize->add_control(
	'ostrich_blog_copyright_txt',
	array(
		'section'		=> 'ostrich_blog_footer_section',
		'label'			=> esc_html__( 'Copyright text:', 'ostrich-blog' ),
		'type'			=> 'textarea',
		'active_callback' => 'ostrich_blog_if_footer_text_enable',
	)
);
