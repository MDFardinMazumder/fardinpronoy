<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * active callbacks.
 * 
 */

function ostrich_blog_if_header_style( $control ) {
	return 'header-2' == $control->manager->get_setting( 'ostrich_blog_header_style' )->value();
}

function ostrich_blog_if_header_nav_search( $control ) {
	return 'header-1' != $control->manager->get_setting( 'ostrich_blog_header_style' )->value();
}

function ostrich_blog_if_header_ads( $control ) {
	return 'ads' == $control->manager->get_setting( 'ostrich_blog_header_display' )->value() && 'header-2' == $control->manager->get_setting( 'ostrich_blog_header_style' )->value() ;
}



/**
 * Check if the banner is enabled
 */
function ostrich_blog_if_banner_enabled( $control ) {
	return 'disable' != $control->manager->get_setting( 'ostrich_blog_banner' )->value();
}

/**
 * Check if the banner is page
 */
function ostrich_blog_if_banner_page( $control ) {
	return 'page' === $control->manager->get_setting( 'ostrich_blog_banner' )->value();
}

/**
 * Check if the banner is post
 */
function ostrich_blog_if_banner_post( $control ) {
	return 'post' === $control->manager->get_setting( 'ostrich_blog_banner' )->value();
}


/**
 * Check if the post_slider is enabled
 */
function ostrich_blog_if_post_slider_enabled( $control ) {
	return 'disable' != $control->manager->get_setting( 'ostrich_blog_post_slider' )->value();
}

/**
 * Check if the post_slider is page
 */
function ostrich_blog_if_post_slider_page( $control ) {
	return 'page' === $control->manager->get_setting( 'ostrich_blog_post_slider' )->value();
}

/**
 * Check if the recent is post
 */
function ostrich_blog_if_post_slider_post( $control ) {
	return 'post' === $control->manager->get_setting( 'ostrich_blog_post_slider' )->value();
}


/**
 * Check if the lifestyle is enabled
 */
function ostrich_blog_if_lifestyle_enabled( $control ) {
	return 'disable' != $control->manager->get_setting( 'ostrich_blog_lifestyle' )->value();
}


/**
 * Check if the lifestyle is page
 */
function ostrich_blog_if_lifestyle_page( $control ) {
	return 'page' === $control->manager->get_setting( 'ostrich_blog_lifestyle' )->value();
}

/**
 * Check if the lifestyle is post
 */
function ostrich_blog_if_lifestyle_post( $control ) {
	return 'post' === $control->manager->get_setting( 'ostrich_blog_lifestyle' )->value();
}


/**
 * Check if the featured is page
 */
function ostrich_blog_if_featured_page( $control ) {
	return 'page' === $control->manager->get_setting( 'ostrich_blog_featured' )->value();
}

/**
 * Check if the blog is enabled
 */
function ostrich_blog_if_blog_enabled( $control ) {
	return 'disable' != $control->manager->get_setting( 'ostrich_blog_blog' )->value();
}

/**
 * Check if the blog is custom
 */
function ostrich_blog_if_blog_cat( $control ) {
	return 'cat' === $control->manager->get_setting( 'ostrich_blog_blog' )->value();
}

/**
 * Check if the footer text is enabled
 */
function ostrich_blog_if_footer_text_enable( $control ) {
	return $control->manager->get_setting( 'ostrich_blog_enable_footer_text' )->value();
}

/**
 * Check if custom color scheme is enabled
 */
function ostrich_blog_if_custom_color_scheme( $control ) {
	return 'custom' === $control->manager->get_setting( 'ostrich_blog_color_scheme' )->value();
}
