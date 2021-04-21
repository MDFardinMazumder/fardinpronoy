<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Template Function
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ostrich_blog_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Header color scheme 
	$theme_color_scheme = get_theme_mod( 'ostrich_blog_theme_color_scheme');
	$classes[] =  esc_attr( $theme_color_scheme );

	// When  color scheme is light or dark.
	$color_scheme = get_theme_mod( 'ostrich_blog_color_scheme', 'default' );
	$classes[] = esc_attr( $color_scheme ) . '-version';
	
	// When global archive layout is checked.
	if ( is_archive() || ostrich_blog_is_latest_posts() || is_404() || is_search() ) {
		$archive_sidebar = get_theme_mod( 'ostrich_blog_archive_sidebar', 'right' ); 
		$classes[] = esc_attr( $archive_sidebar ) . '-sidebar';
	} else if ( is_single() ) { // When global post sidebar is checked.
    	$ostrich_blog_post_sidebar_meta = get_post_meta( get_the_ID(), 'ostrich-blog-select-sidebar', true );
    	if ( ! empty( $ostrich_blog_post_sidebar_meta ) ) {
			$classes[] = esc_attr( $ostrich_blog_post_sidebar_meta ) . '-sidebar';
    	} else {
			$global_post_sidebar = get_theme_mod( 'ostrich_blog_global_post_layout', 'right' ); 
			$classes[] = esc_attr( $global_post_sidebar ) . '-sidebar';
    	}
	} elseif ( ostrich_blog_is_frontpage_blog() || is_page() ) {
		if ( ostrich_blog_is_frontpage_blog() ) {
			$page_id = get_option( 'page_for_posts' );
		} else {
			$page_id = get_the_ID();
		}

    	$ostrich_blog_page_sidebar_meta = get_post_meta( $page_id, 'ostrich-blog-select-sidebar', true );
		if ( ! empty( $ostrich_blog_page_sidebar_meta ) ) {
			$classes[] = esc_attr( $ostrich_blog_page_sidebar_meta ) . '-sidebar';
		} else {
			$global_page_sidebar = get_theme_mod( 'ostrich_blog_global_page_layout', 'right' ); 
			$classes[] = esc_attr( $global_page_sidebar ) . '-sidebar';
		}
	}

    if ( get_theme_mod( 'ostrich_blog_make_menu_sticky', false ) ) {
        $classes[] = 'menu-sticky';
    }
    
	// Site layout classes
	$site_layout = get_theme_mod( 'ostrich_blog_site_layout', 'wide' );
	$classes[] = esc_attr( $site_layout ) . '-layout';


    $classes[] = esc_attr( 'homepage-design' );

	return $classes;
}
add_filter( 'body_class', 'ostrich_blog_body_classes' );

function ostrich_blog_post_classes( $classes ) {
	if ( ostrich_blog_is_page_displays_posts() ) {
		// Search 'has-post-thumbnail' returned by default and remove it.
		$key = array_search( 'has-post-thumbnail', $classes );
		unset( $classes[ $key ] );
		
		$archive_img_enable = get_theme_mod( 'ostrich_blog_enable_archive_featured_img', true );

		if( has_post_thumbnail() && $archive_img_enable ) {
			$classes[] = 'has-post-thumbnail';
		} else {
			$classes[] = 'no-post-thumbnail';
		}
	}
  
	return $classes;
}
add_filter( 'post_class', 'ostrich_blog_post_classes' );

/**
 * Excerpt length
 * 
 * @since themeostrich 1.0.0
 * @return Excerpt length
 */
function ostrich_blog_excerpt_length( $length ){
	if ( is_admin() ) {
		return $length;
	}

	$length = get_theme_mod( 'ostrich_blog_archive_excerpt_length', 60 );
	return $length;
}
add_filter( 'excerpt_length', 'ostrich_blog_excerpt_length', 999 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ostrich_blog_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ostrich_blog_pingback_header' );

/**
 * Get an array of post id and title.
 * 
 */
function ostrich_blog_get_post_choices() {
	$choices = array( '' => esc_html__( '--Select--', 'ostrich-blog' ) );
	$args = array( 'numberposts' => -1, );
	$posts = get_posts( $args );

	foreach ( $posts as $post ) {
		$id = $post->ID;
		$title = $post->post_title;
		$choices[ $id ] = $title;
	}

	return $choices;
    wp_reset_postdata();
}

/**
 * Get an array of cat id and title.
 * 
 */
function ostrich_blog_get_post_cat_choices() {
  $choices = array( '' => esc_html__( '--Select--', 'ostrich-blog' ) );
	$cats = get_categories();

	foreach ( $cats as $cat ) {
		$id = $cat->term_id;
		$title = $cat->name;
		$choices[ $id ] = $title;
	}

	return $choices;
}

/**
 * Checks to see if we're on the homepage or not.
 */
function ostrich_blog_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Checks to see if Static Front Page is set to "Your latest posts".
 */
function ostrich_blog_is_latest_posts() {
	return ( is_front_page() && is_home() );
}

/**
 * Checks to see if Static Front Page is set to "Posts page".
 */
function ostrich_blog_is_frontpage_blog() {
	return ( is_home() && ! is_front_page() );
}

/**
 * Checks to see if the current page displays any kind of post listing.
 */
function ostrich_blog_is_page_displays_posts() {
	return ( ostrich_blog_is_frontpage_blog() || is_search() || is_archive() || ostrich_blog_is_latest_posts() );
}

/**
 * Shows a breadcrumb for all types of pages.  This is a wrapper function for the Breadcrumb_Trail class,
 * which should be used in theme templates.
 *
 * @since  1.0.0
 * @access public
 * @param  array $args Arguments to pass to Breadcrumb_Trail.
 * @return void
 */
function ostrich_blog_breadcrumb( $args = array() ) {
	$breadcrumb = apply_filters( 'breadcrumb_trail_object', null, $args );

	if ( ! is_object( $breadcrumb ) )
		$breadcrumb = new Breadcrumb_Trail( $args );

	return $breadcrumb->trail();
}

/**
 * Pagination in archive/blog/search pages.
 */
function ostrich_blog_posts_pagination() { 
	$archive_pagination = get_theme_mod( 'ostrich_blog_archive_pagination_type', 'numeric' );
	if ( 'disable' === $archive_pagination ) {
		return;
	}
	if ( 'numeric' === $archive_pagination ) {
		the_posts_pagination( array(
            'prev_text'          => ostrich_blog_get_svg( array( 'icon' => 'left-arrow' ) ),
            'next_text'          => ostrich_blog_get_svg( array( 'icon' => 'left-arrow' ) ),
        ) );
	} elseif ( 'older_newer' === $archive_pagination ) {
        the_posts_navigation( array(
            'prev_text'          => ostrich_blog_get_svg( array( 'icon' => 'left' ) ) . '<span>'. esc_html__( 'Older', 'ostrich-blog' ) .'</span>',
            'next_text'          => '<span>'. esc_html__( 'Newer', 'ostrich-blog' ) .'</span>' . ostrich_blog_get_svg( array( 'icon' => 'right' ) ),
        )  );
	}
}

function ostrich_blog_get_svg_by_url( $url = false ) {
	if ( ! $url ) {
		return false;
	}

	$social_icons = ostrich_blog_social_links_icons();

	foreach ( $social_icons as $attr => $value ) {
		if ( false !== strpos( $url, $attr ) ) {
			return ostrich_blog_get_svg( array( 'icon' => esc_attr( $value ) ) );
		}
	}
}

if ( ! function_exists( 'ostrich_blog_the_excerpt' ) ) :

  /**
   * Generate excerpt.
   *
   * @since 1.0.0
   *
   * @param int     $length Excerpt length in words.
   * @param WP_Post $post_obj WP_Post instance (Optional).
   * @return string Excerpt.
   */
  function ostrich_blog_the_excerpt( $length = 0, $post_obj = null ) {

    global $post;

    if ( is_null( $post_obj ) ) {
      $post_obj = $post;
    }

    $length = absint( $length );

    if ( 0 === $length ) {
      return;
    }

    $source_content = $post_obj->post_content;

    if ( ! empty( $post_obj->post_excerpt ) ) {
      $source_content = $post_obj->post_excerpt;
    }

    $source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
    $trimmed_content = wp_trim_words( $source_content, $length, '&hellip;' );
    return $trimmed_content;

  }

endif;

function ostrich_blog_get_section_content( $section_name, $content_type, $content_count ){

    $content = array();


    if (  in_array( $content_type, array( 'post', 'page' ) ) ) {
    $content_id = array();
    if ( 'post' === $content_type ) {
        for ( $i=1; $i <= $content_count; $i++ ) { 
            $content_id[] = get_theme_mod( "smooth_blog_pro_{$section_name}_{$content_type}_" . $i );
            } 
    }else {
        for ( $i=1; $i <= $content_count; $i++ ) { 
            $content_id[] = get_theme_mod( "smooth_blog_pro_{$section_name}_{$content_type}_" . $i );
        }
    }
    $args = array(
        'post_type' => $content_type,
        'post__in' => (array)$content_id,   
        'orderby'   => 'post__in',
        'posts_per_page' => absint( $content_count ),
        'ignore_sticky_posts' => true,
    );

    } else {
        $cat_content_id = get_theme_mod( "smooth_blog_pro_{$section_name}_{$content_type}" );
        $args = array(
            'cat' => $cat_content_id,   
            'posts_per_page' =>  absint( $content_count ),
        );
    }

    $query = new WP_Query( $args );
    if ( $query->have_posts() ) {
        $i = 0;
        while ( $query->have_posts() ) {
            $query->the_post();

            $content[$i]['id'] = get_the_id();
            $content[$i]['title'] = get_the_title();
            $content[$i]['url'] = get_the_permalink();
            $content[$i]['content'] = get_the_content();
            $i++;
        }
        wp_reset_postdata();
    }

    return $content;
}

function ostrich_blog_custom_color_scheme() {
    if ( 'custom' != get_theme_mod( 'ostrich_blog_color_scheme' ) ) {
        return;
    }
    $color = get_theme_mod( 'ostrich_blog_custom_color_scheme', '#ff8737' );
    $custom_css = '
        /*--------------------------------------------------------------
        # Background Color
        --------------------------------------------------------------*/
        .backtotop,
        .pagination .page-numbers.current,
        .pagination .page-numbers:hover,
        .pagination .page-numbers:focus,
        .widget_search form.search-form .search-submit:hover,
        .widget_search form.search-form .search-submit:focus,
        input[type="submit"],
        #secondary .jetpack_subscription_widget input[type="submit"]:hover,
        #secondary .jetpack_subscription_widget input[type="submit"]:focus,
        #secondary .widget.widget_posts_filter ul.tabs li.active a,
        .widget_tag_cloud .tagcloud a,
        #secondary .widget_tag_cloud .tagcloud a,
        .reply a,
        .btn:hover,
        .btn:focus,
        #featured-posts article .entry-container .post-categories a,
        .second-design #breaking-news .news-title,
        .homepage-design .section-title {
            background-color: ' . esc_attr( $color ) . ';
        }

        /*--------------------------------------------------------------
        # Color
        --------------------------------------------------------------*/
        a,
        .main-navigation ul.nav-menu li.current-menu-item > a,
        .main-navigation ul.nav-menu li:hover > a,
        .main-navigation a:hover,
        .main-navigation ul.nav-menu > li > a:hover,
        .post-navigation a:hover, 
        .posts-navigation a:hover,
        .post-navigation a:focus, 
        .posts-navigation a:focus,
        #secondary a:hover,
        #secondary a:focus,
        #secondary-sidebar a:hover,
        #secondary-sidebar a:focus,
        #secondary .posted-on a,
        #secondary-sidebar .post-categories a,
        .posted-on a:hover,
        .posted-on a:focus,
        .comment-meta .url:hover,
        .comment-meta .url:focus,
        .comment-metadata a:hover,
        .comment-metadata a:focus,
        .entry-title a:hover,
        .entry-title a:focus,
        .byline a:hover,
        .byline a:focus,
        span.tags-links a:hover,
        span.tags-links a:focus,
        .dark-version .main-navigation ul.nav-menu li.current-menu-item > a, 
        .dark-version .main-navigation ul.nav-menu li:hover > a,
        #colophon ul li a:hover,
        #colophon ul li a:focus {
            color: ' . esc_attr( $color ) . ';
        }

        /*--------------------------------------------------------------
        # Fill
        --------------------------------------------------------------*/
        .loader-container svg,
        .main-navigation ul.nav-menu li:hover > svg,
        .main-navigation li.menu-item-has-children:hover > a > svg,
        .main-navigation li.menu-item-has-children > a:hover > svg,
        .main-navigation ul.nav-menu > li.current-menu-item > a > svg,
        .main-navigation ul.nav-menu > li > a.search:hover svg.icon-search,
        .main-navigation ul.nav-menu > li > a.search:focus svg.icon-search,
        .main-navigation li.search-menu a:hover svg,
        .main-navigation li.search-menu a:focus svg,
        .main-navigation li.search-menu a.search-active svg,
        .widget svg,
        .navigation.posts-navigation a:hover svg, 
        .navigation.post-navigation a:hover svg,
        .navigation.posts-navigation a:focus svg, 
        .navigation.post-navigation a:focus svg {
            fill: ' . esc_attr( $color ) . ';
        }

        /*--------------------------------------------------------------
        # Border Color
        --------------------------------------------------------------*/
        .pagination .page-numbers.current,
        .pagination .page-numbers:hover,
        .pagination .page-numbers:focus,
        .btn:hover,
        .btn:focus,
        .dark-version .btn:hover,
        .dark-version .btn:focus {
            border-color: ' . esc_attr( $color ) . ';
        }

        .homepage-design .section-header {
            border-bottom-color: ' . esc_attr( $color ) . ';
        }

        /*--------------------------------------------------------------
        # Responsive
        --------------------------------------------------------------*/
        @media screen and (min-width: 1024px) {
            .dark-version .main-navigation ul.nav-menu > li:hover > a > svg, 
            .dark-version .main-navigation ul.nav-menu > li.current-menu-item > a > svg,
            .main-navigation ul.nav-menu > li:hover > a > svg,
            .main-navigation ul.nav-menu > li.current-menu-item > a > svg {
                fill: ' . esc_attr( $color ) . ';
            }
            #masthead .main-navigation ul.nav-menu li.current-menu-item > a,
            #masthead .main-navigation ul.nav-menu > li > a:hover,
            .main-navigation ul.nav-menu ul li.current-menu-item > a,
            .main-navigation ul.nav-menu ul li:hover > a,
            .main-navigation ul.nav-menu ul li:focus > a {
                color: ' . esc_attr( $color ) . ';
            }
        }

        /*--------------------------------------------------------------
        # Preloader
        --------------------------------------------------------------*/
        @keyframes preloader {
            0% {height:5px;transform:translateY(0px);background: ' . esc_attr( $color ) . ';}
            25% {height:30px;transform:translateY(15px);background: ' . esc_attr( $color ) . ';}
            50% {height:5px;transform:translateY(0px);background: ' . esc_attr( $color ) . ';}
            100% {height:5px;transform:translateY(0px);background: ' . esc_attr( $color ) . ';}
        }
        ';
    wp_add_inline_style( 'ostrich-blog-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'ostrich_blog_custom_color_scheme' );

// Add auto p to the palces where get_the_excerpt is being called.
add_filter( 'get_the_excerpt', 'wpautop' );