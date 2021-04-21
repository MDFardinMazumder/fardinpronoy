<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * partial refresh
 * 
 */

/**
 * Selective refresh for lifestyle title.
 */
function ostrich_blog_lifestyle_partial_title() {
	return esc_html( get_theme_mod( 'ostrich_blog_lifestyle_title' ) );
}


/**
 * Selective refresh for blog title.
 */
function ostrich_blog_blog_partial_title() {
	return esc_html( get_theme_mod( 'ostrich_blog_blog_title' ) );
}

/**
 * Selective refresh for blog btn title.
 */
function ostrich_blog_blog_partial_btn_title() {
	return esc_html( get_theme_mod( 'ostrich_blog_blog_btn_title' ) );
}

