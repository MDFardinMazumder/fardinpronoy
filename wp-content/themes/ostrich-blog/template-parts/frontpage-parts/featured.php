<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Featured Section
 */

// Get the content type.
$featured = get_theme_mod( 'ostrich_blog_featured', 'disable' );

// Bail if the section is disabled.
if ( 'disable' === $featured ) {
	return;
}
$content_id = array();

$content_id[] = get_theme_mod( "ostrich_blog_featured_{$featured}");

$args = array(
    'post_type' => $featured,
    'post__in' => $content_id, 
    'posts_per_page' => -1,  
);
?>
<div id="featured-posts" class="page-section no-padding-top">
    <div class="wrapper">
    	<?php
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
                $banner_thumbnail = !empty( get_the_post_thumbnail_url( ) ) ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri(). '/assets/img/no-featured-image.jpg';
		?>
        <article>
            <div class="featured-image" style="background-image: url('<?php echo esc_url( $banner_thumbnail ) ; ?>');"></div>
            <div class="entry-container">
                <div class="entry-meta">
                    <span class="cat-links">
                        <?php the_category( '', '' ) ?>
                    </span><!-- .cat-links -->
                </div>

                <header class="entry-header">
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title() ; ?></a></h2>
                </header>

                <div class="entry-content">
                   <p><?php echo esc_html(wp_trim_words( get_the_content(), 50, '  ...' )); ?></p>
                </div>
                
                <?php if ( !empty( get_theme_mod( 'ostrich_blog_featured_btn_title', __( 'Read More', 'ostrich-blog') ) ) ): ?>
                    <div class="read-more">
                        <a href="<?php the_permalink() ; ?>" class="btn">
                            <?php echo esc_html( get_theme_mod( 'ostrich_blog_featured_btn_title', __( 'Read More', 'ostrich-blog') ) ); ?>
                        </a>
                    </div>
                <?php endif ?>
                
            </div><!-- .entry-container -->
        </article>
        <?php	} }	wp_reset_postdata(); ?>
    </div>
</div><!-- #featured-posts -->