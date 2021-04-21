<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Banner Section
 */

// Get the content type.
$banner = get_theme_mod( 'ostrich_blog_banner', 'disable' );
// Bail if the section is disabled.
if ( 'disable' === $banner ) {
	return;
}

	$content_id = array();
	if ( 'post' === $banner ) {
        for ( $i=1; $i <= 6; $i++ ) { 
            $content_id[] = get_theme_mod( "ostrich_blog_banner_{$banner}_" . $i );
			} 
	}else {
        for ( $i=1; $i <= 6; $i++ ) { 
            $content_id[] = get_theme_mod( "ostrich_blog_banner_{$banner}_" . $i );
		}
	}
	$args = array(
	    'post_type' => $banner,
	    'post__in' => (array)$content_id,   
	    'orderby'   => 'post__in',
	    'posts_per_page' => 6,
	    'ignore_sticky_posts' => true,
	);

?>
<div id="posts-banner" class="relative">
    <div class="wrapper">
        <div class="grid">
        <?php
        if ( $banner == 'recent' ) {
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                );
            }
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
            $i = 1;
        	while ( $query->have_posts() && $i <= 6 ) {
        		$query->the_post();
                $banner_thumbnail = !empty( get_the_post_thumbnail_url( ) ) ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri(). '/assets/img/no-featured-image.jpg';
        ?>
			<article class="grid-item ">
                <div class="featured-image" style="background-image: url(<?php echo esc_url( $banner_thumbnail ); ?>);">
                    <a href="<?php the_permalink(); ?>" class="post-thumbnail-link"></a>
                </div>
                <div class="entry-container">
                	<span class="cat-links">
                		<?php the_category( '', '' ) ?>
                	</span>
                    
                    <header class="entry-header">
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </header>
                    <div class="entry-meta">
                        <?php ostrich_blog_posted_on() ; ?>
                    </div><!-- .entry-meta -->
                </div><!-- .entry-container -->
            </article>

        <?php $i++;	}
        	wp_reset_postdata();
        } ?>
		</div><!-- .grid-item -->
    </div><!-- .wrapper -->
</div>
