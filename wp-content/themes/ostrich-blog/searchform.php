<?php
/**
 * Template for displaying search forms
 *
 * @package themeostrich Themes
 * @subpackage themeostrich
 * @since themeostrich 1.0.0
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'ostrich-blog' ) ?></span>
        <input type="search" class="search-field"
            placeholder="<?php echo esc_attr_x( 'Search ...', 'placeholder', 'ostrich-blog' ) ?>"
            value="<?php echo get_search_query() ?>" name="s"
            title="<?php echo esc_attr_x( 'Search for:', 'label', 'ostrich-blog' ) ?>" />
    </label>
    <button type="submit" class="search-submit"
        value="<?php echo esc_attr_x( 'Search', 'submit button', 'ostrich-blog' ) ?>"><?php echo ostrich_blog_get_svg( array( 'icon' => 'search' ) );?></button>
</form>