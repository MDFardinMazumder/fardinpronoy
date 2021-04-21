<?php
/**
 * themeostrich functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package themeostrich
 */

if ( ! function_exists( 'ostrich_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ostrich_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on themeostrich, use a find and replace
		 * to change 'ostrich-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ostrich-blog' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'ostrich-blog' ),
			'social' => esc_html__( 'Social', 'ostrich-blog' ),

		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ostrich_blog_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'custom-header', array(
		        'default-image'      => '%s/assets/img/header-image.jpg',
		        'default-text-color' => '000',
		       	'width'              => 1332, /* 16:9 Aspect Ratio */
				'height'             => 749,
		        'flex-width'         => true,
		        'flex-height'        => true,
		        'video'              => true,
		    ) );
		 // Register default headers.
		register_default_headers( array(
			'default-banner' => array(
				'url'           => '%s/assets/img/header-image.jpg',
				'thumbnail_url' => '%s/assets/img/header-image.jpg',
				'description'   => esc_html_x( 'Default Banner', 'Header image description', 'ostrich-blog' ),
			),

		) );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

    	/*
    	 * This theme styles the visual editor to resemble the theme style,
    	 * specifically font, colors, and column width.
     	 */
    	add_editor_style( array( 'assets/css/editor-style.css', ostrich_blog_fonts_url() ) );

    	
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'ostrich-blog' ),
		       	'shortName' => esc_html__( 'S', 'ostrich-blog' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'ostrich-blog' ),
		       	'shortName' => esc_html__( 'M', 'ostrich-blog' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'larger', 'ostrich-blog' ),
		       	'shortName' => esc_html__( 'L', 'ostrich-blog' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'huge', 'ostrich-blog' ),
		       	'shortName' => esc_html__( 'XL', 'ostrich-blog' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'ostrich_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ostrich_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ostrich_blog_content_width', 900 );
}
add_action( 'after_setup_theme', 'ostrich_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ostrich_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'ostrich-blog' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ostrich-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'ostrich-blog' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'ostrich-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


	for ( $i=1; $i <= 4; $i++ ) { 
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Widget Area ', 'ostrich-blog' )  . $i,
			'id'            => 'footer-' . $i,
			'description'   => esc_html__( 'Add widgets here.', 'ostrich-blog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'ostrich_blog_widgets_init' );

/**
 * Register custom fonts.
 */
function ostrich_blog_fonts_url() {
	$fonts_url = '';

	$font_families = array();
	
	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Montserrat, translate this to 'off'. Do not translate
	 * into your own language.
	 */


	$lora = _x( 'on', 'Lora font: on or off', 'ostrich-blog' );

	if ( 'off' !== $lora ) {
		$font_families[] = 'Lora:400,400i';
	}

	$Poppins = _x( 'on', 'Poppins font: on or off', 'ostrich-blog' );

	if ( 'off' !== $Poppins ) {
		$font_families[] = 'Poppins:400,500,600';
	}



	$Sen = _x( 'on', 'Sen font: on or off', 'ostrich-blog' );

	if ( 'off' !== $Sen ) {
		$font_families[] = 'Sen';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}

/**
 * Enqueue scripts and styles.
 */
function ostrich_blog_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'ostrich-blog-fonts', ostrich_blog_fonts_url(), array(), null );
	
	wp_enqueue_style( 'font-awesome', get_theme_file_uri() . '/assets/css/font-awesome.css', '', '4.7.0' );

	wp_enqueue_style( 'slick', get_theme_file_uri() . '/assets/css/slick.css', '', '1.8.0' );

	wp_enqueue_style( 'slick-theme', get_theme_file_uri() . '/assets/css/slick-theme.css', '', '1.8.0' );

	// blocks
	wp_enqueue_style( 'ostrich-blog-blocks', get_template_directory_uri() . '/assets/css/blocks.css' );

	wp_enqueue_style( 'ostrich-blog-style', get_stylesheet_uri() );


	wp_enqueue_script( 'packery-pkgd', get_theme_file_uri( '/assets/js/packery.pkgd.js' ), array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'slick-jquery', get_theme_file_uri( '/assets/js/slick.js' ), array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'ostrich-blog-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array(), '20151215', true );

	wp_enqueue_script( 'ostrich-blog-skip-link-focus-fix', get_theme_file_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'ostrich-blog-custom', get_theme_file_uri( '/assets/js/custom.js' ), array( 'jquery' ), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ostrich_blog_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since ostrich-blog 1.0.0
 */
function ostrich_blog_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'ostrich-blog-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'ostrich-blog-fonts', ostrich_blog_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'ostrich_blog_block_editor_styles' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Breadcrumb trail class.
 */
require get_parent_theme_file_path( '/inc/class-breadcrumb-trail.php' );


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_parent_theme_file_path() . '/inc/jetpack.php';
}

/**
 * Metabox
 */
require get_parent_theme_file_path( '/inc/metabox.php' );


/**
 * TGMPA call
 */
require get_parent_theme_file_path( '/inc/tgmpa/call.php' );

require get_parent_theme_file_path( '/inc/custom-style.php' );

require get_parent_theme_file_path( '/inc/custom-script.php' );

function return_blog_intro_text( $default_text ) {
    $default_text .= sprintf( '<p class="about-description">%1$s <a href="%2$s">%3$s</a></p>', esc_html__( 'Demo content files for Ostrich Blog Theme.', 'ostrich-blog' ),
    esc_url( 'https://bitbucket.org//totheme/ostrich-blog-demo/get/b9d785a32add.zip' ), esc_html__( 'Click here for Demo File download', 'ostrich-blog' ) );

    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'return_blog_intro_text' );



/**
 *
 * Reset all setting to default.
 *
 */
function ostrich_blog_reset_settings() {
    $reset_settings = get_theme_mod( 'ostrich_blog_reset_settings', false );
    if ( $reset_settings ) {
        remove_theme_mods();
    }
}
add_action( 'customize_save_after', 'ostrich_blog_reset_settings' );


if ( ! function_exists( 'ostrich_blog_exclude_sticky_posts' ) ) {
    function ostrich_blog_exclude_sticky_posts( $query ) {
        if ( ! is_admin() && $query->is_main_query() && $query->is_home() ) {
            $sticky_posts = get_option( 'sticky_posts' );  
            if ( ! empty( $sticky_posts ) ) {
            	$query->set('post__not_in', $sticky_posts );
            }
            $query->set('ignore_sticky_posts', true );
        }
    }
}
add_action( 'pre_get_posts', 'ostrich_blog_exclude_sticky_posts' );

