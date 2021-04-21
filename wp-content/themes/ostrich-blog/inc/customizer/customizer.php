<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Theme Customizer
 */
function ostrich_blog_get_default_mods() {
	$ostrich_blog_default_mods = array(
		// Footer copyright
		'ostrich_blog_copyright_txt' => esc_html__( 'Copyright &copy; [the-year] [site-link]  |  ', 'ostrich-blog' ),
	);

	return apply_filters( 'ostrich_blog_default_mods', $ostrich_blog_default_mods );
}

require get_template_directory() . '/inc/customizer/class-go-pro.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ostrich_blog_customize_register( $wp_customize ) {

	// Custom Controller
	require get_parent_theme_file_path( '/inc/customizer/custom-controller.php' );

	$default = ostrich_blog_get_default_mods();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'ostrich_blog_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'ostrich_blog_customize_partial_blogdescription',
		) );
	}


	//Color Panel

	// Header tagline color setting
	$wp_customize->add_setting(	
		'ostrich_blog_header_tagline',
		array(
			'sanitize_callback' => 'ostrich_blog_sanitize_hex_color',
			'default' => '#929292',
			'transport'	=> 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control( 
		$wp_customize,
			'ostrich_blog_header_tagline',
			array(
				'section'		=> 'colors',
				'label'			=> esc_html__( 'Site tagline Color:', 'ostrich-blog' ),
			)
		)
	);

	// Header tagline color setting
	$wp_customize->add_setting(	
		'ostrich_blog_theme_color_scheme',
		array(
			'sanitize_callback' => 'ostrich_blog_sanitize_select',
			'default' => 'lite-version',
		)
	);

	$wp_customize->add_control( 'ostrich_blog_theme_color_scheme',
		array(
			'section'		=> 'colors',
			'type'			=> 'radio',
			'label'			=> esc_html__( 'Theme color scheme:', 'ostrich-blog' ),
			'choices'			=> array( 
				'lite-version' => esc_html__( 'Lite', 'ostrich-blog' ), 
				'dark-version' => esc_html__( 'Dark', 'ostrich-blog' ), 
			),
		)
	);


	// Header text display setting
	$wp_customize->add_setting(	
		'ostrich_blog_header_text_display',
		array(
			'sanitize_callback' => 'ostrich_blog_sanitize_checkbox',
			'default' => true,
			'transport'	=> 'postMessage',
		)
	);

	$wp_customize->add_control(
		'ostrich_blog_header_text_display',
		array(
			'section'		=> 'title_tagline',
			'type'			=> 'checkbox',
			'label'			=> esc_html__( 'Display Site Title and Tagline', 'ostrich-blog' ),
		)
	);

	// Your latest posts title setting
	$wp_customize->add_setting(	
		'ostrich_blog_your_latest_posts_title',
		array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => esc_html__( 'Blogs', 'ostrich-blog' ),
			'transport'	=> 'postMessage',
		)
	);

	$wp_customize->add_control(
		'ostrich_blog_your_latest_posts_title',
		array(
			'section'		=> 'static_front_page',
			'label'			=> esc_html__( 'Title:', 'ostrich-blog' ),
			'active_callback' => 'ostrich_blog_is_latest_posts'
		)
	);

	$wp_customize->selective_refresh->add_partial( 
		'ostrich_blog_your_latest_posts_title', 
		array(
	        'selector'            => '.home.blog #page-header .page-title',
			'render_callback'     => 'ostrich_blog_your_latest_posts_partial_title',
    	) 
    );



  $wp_customize->add_setting( 'ostrich_blog_enable_content', array(
	'sanitize_callback'   => 'ostrich_blog_sanitize_checkbox',
	'default'             => false,
	) );

	$wp_customize->add_control( 'ostrich_blog_enable_content', array(
		'label'       	=> esc_html__( 'Enable Content', 'ostrich-blog' ),
		'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'ostrich-blog' ),
		'section'     	=> 'static_front_page',
		'type'        	=> 'checkbox',
	) );

	/**
	 * 
	 * Front Section
	 * 
	 */ 

	// Home sections panel
	$wp_customize->add_panel(
		'ostrich_blog_home_panel',
		array(
			'title' => esc_html__( 'Homepage Options', 'ostrich-blog' ),
			'priority' => 105
		)
	);

    require get_parent_theme_file_path( '/inc/customizer/banner.php' );

    require get_parent_theme_file_path( '/inc/customizer/featured.php' );

	require get_parent_theme_file_path( '/inc/customizer/lifestyle.php' );

    require get_parent_theme_file_path( '/inc/customizer/slider.php' );
      
    require get_parent_theme_file_path( '/inc/customizer/blog.php' );

 


	// Theme Options
	require get_parent_theme_file_path( '/inc/customizer/theme-option.php' );
}
add_action( 'customize_register', 'ostrich_blog_customize_register' );


// Sanitize Callback
require get_parent_theme_file_path( '/inc/customizer/sanitize-callback.php' );

// active Callback
require get_parent_theme_file_path( '/inc/customizer/active-callback.php' );

// Partial Refresh
require get_parent_theme_file_path( '/inc/customizer/partial-refresh.php' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ostrich_blog_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ostrich_blog_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ostrich_blog_customize_preview_js() {
	wp_enqueue_script( 'ostrich-blog-customizer', get_theme_file_uri( '/assets/js/customizer.js' ), array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ostrich_blog_customize_preview_js' );

/**
 * Binds JS handlers for Customizer controls.
 */
function ostrich_blog_customize_control_js() {


	wp_enqueue_style( 'ostrich-blog-customize-style', get_theme_file_uri( '/assets/css/customize-controls.css' ), array(), '20151215' );

	wp_enqueue_script( 'ostrich-blog-customize-control', get_theme_file_uri( '/assets/js/customize-control.js' ), array( 'jquery', 'customize-controls' ), '20151215', true );
	$localized_data = array( 
		'refresh_msg' => esc_html__( 'Refresh the page after Save and Publish.', 'ostrich-blog' ),
		'reset_msg' => esc_html__( 'Warning!!! This will reset all the settings. Refresh the page after Save and Publish to reset all.', 'ostrich-blog' ),
	);

	wp_localize_script( 'ostrich-blog-customize-control', 'localized_data', $localized_data );
}
add_action( 'customize_controls_enqueue_scripts', 'ostrich_blog_customize_control_js' );
