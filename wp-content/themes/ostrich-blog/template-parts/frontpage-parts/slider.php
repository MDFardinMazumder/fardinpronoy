<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Slider Section
 */

// Get the content type.
$post_slider = get_theme_mod( 'ostrich_blog_post_slider', 'disable' );
$post_slider_num	= 6 ;
// Bail if the section is disabled.
if ( 'disable' === $post_slider ) {
	return;
}


$content_id = array();
if ( 'post' === $post_slider ) {
    for ( $i=1; $i <= $post_slider_num; $i++ ) { 
        $content_id[] = get_theme_mod( "ostrich_blog_post_slider_{$post_slider}_" . $i );
		} 
}else {
    for ( $i=1; $i <= $post_slider_num; $i++ ) { 
        $content_id[] = get_theme_mod( "ostrich_blog_post_slider_{$post_slider}_" . $i );
	}
}
$args = array(
    'post_type' => $post_slider,
    'post__in' => (array)$content_id,   
    'orderby'   => 'post__in',
    'posts_per_page' => absint( $post_slider_num ),
    'ignore_sticky_posts' => true,
);


?>
<div id="thumbnail-post-slider">
    <div class="wrapper">
        <div class="thumbnail-wrapper" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite": true, "speed": 1000, "dots": false, "arrows":true, "autoplay": false, "draggable": true, "fade": false }'>
        <?php

        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
        	while ( $query->have_posts() ) {
        		$query->the_post();
                $banner_thumbnail = !empty( get_the_post_thumbnail_url( ) ) ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri(). '/assets/img/no-featured-image.jpg';
        ?>
			<article>
                <div class="featured-image">
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $banner_thumbnail ); ?>" height= '120px' width= '120px' ></a>
                </div><!-- .featured-image -->

                <div class="entry-container">
                    <div class="entry-meta">
                        <?php ostrich_blog_posted_on() ; ?>
                    </div><!-- .entry-meta -->

                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </header>
                </div><!-- .entry-container -->
            </article>

        <?php	}
        	wp_reset_postdata();
        }
        			
        ?>
		</div><!-- .grid-item -->
    </div><!-- .wrapper -->
</div>
