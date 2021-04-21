<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package themeostrich
 */

if ( is_archive() || ostrich_blog_is_latest_posts() || is_404() || is_search() ) {
	$archive_sidebar = get_theme_mod( 'ostrich_blog_archive_sidebar', 'right' ); 
	if ( 'no' === $archive_sidebar ) {
		return;
	}
} elseif ( is_single() ) {
    $ostrich_blog_post_sidebar_meta = get_post_meta( get_the_ID(), 'ostrich-blog-select-sidebar', true );
	$global_post_sidebar = get_theme_mod( 'ostrich_blog_global_post_layout', 'right' ); 

	if ( ! empty( $ostrich_blog_post_sidebar_meta ) && ( 'no' === $ostrich_blog_post_sidebar_meta ) ) {
		return;
	} elseif ( empty( $ostrich_blog_post_sidebar_meta ) && 'no' === $global_post_sidebar ) {
		return;
	}
} elseif ( ostrich_blog_is_frontpage_blog() || is_page() ) {
	if ( ostrich_blog_is_frontpage_blog() ) {
		$page_id = get_option( 'page_for_posts' );
	} else {
		$page_id = get_the_ID();
	}
	
    $ostrich_blog_page_sidebar_meta = get_post_meta( $page_id, 'ostrich-blog-select-sidebar', true );
	$global_page_sidebar = get_theme_mod( 'ostrich_blog_global_page_layout', 'right' ); 

	if ( ! empty( $ostrich_blog_page_sidebar_meta ) && ( 'no' === $ostrich_blog_page_sidebar_meta ) ) {
		return;
	} elseif ( empty( $ostrich_blog_page_sidebar_meta ) && 'no' === $global_page_sidebar ) {
		return;
	}
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
