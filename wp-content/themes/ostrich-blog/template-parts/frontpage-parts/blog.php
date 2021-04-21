<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Blog Section
 */
// Get the content type.
$blog = get_theme_mod( 'ostrich_blog_blog', 'disable' );
$blog_num = 5;
// Bail if the section is disabled.
if ( 'disable' === $blog ) {
    return;
}
if ( $blog !== 'recent' ) {
    // Query if the content type is either post or page.
   
    $cat_content_id = get_theme_mod( 'ostrich_blog_blog_cat' );
    $args = array(
        'cat' => $cat_content_id,
        'posts_per_page' =>  absint( $blog_num ),
    );
    
}
?>

<div id="inner-content-wrapper" class="page-section no-padding-top">
    <div class="wrapper">
        <div class="section-header">
           <h2 class="section-title"><?php echo esc_html( get_theme_mod( 'ostrich_blog_blog_title', __('More Articles', 'ostrich-blog') ) ); ?></h2>
        </div><!-- .section-header -->
        <?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
            <div id="primary" class="content-area">
        <?php } ?>
            <main id="main" class="site-main" role="main">
                <div class="archive-blog-wrapper clear">
                <?php
                if ( $blog == 'recent' ) {
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' =>  absint( $blog_num ),
                    );
                }
                $query = new WP_Query( $args );
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                         $banner_thumbnail = !empty( get_the_post_thumbnail_url( ) ) ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri(). '/assets/img/no-featured-image.jpg';
                    ?>
                    <article class="has-post-thumbnail">
                        <div class="featured-image" style="background-image: url('<?php echo esc_url( $banner_thumbnail ) ; ?>');">
                            <a href="<?php the_permalink(); ?>" class="post-thumbnail-link"></a>
                        </div><!-- .featured-image -->
                        <div class="entry-container">
                            <span class="cat-links">
                                <?php the_category( '', '' ); ?>
                            </span>
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </header>
                            <div class="entry-content">
                                <p>
                                    <?php echo esc_html(wp_trim_words( get_the_content(), 20, '  ...' )); ?>
                                </p>
                            </div><!-- .entry-content -->
                            <div class="entry-meta">
                                <?php ostrich_blog_posted_on() ; ?>
                            </div><!-- .entry-meta -->
                        </div><!-- .entry-container -->
                    </article>
                    <?php
                    }
                }
                wp_reset_postdata();
                ?>
                </div><!-- .archive-blog-wrapper -->
                <?php if ( get_theme_mod( 'ostrich_blog_blog_btn_url', '' ) !== '' ): ?>
                    <div class="read-more">
                        <a href="<?php echo esc_url( get_theme_mod( 'ostrich_blog_blog_btn_url' ) ) ;?>" class="btn">
                            <?php echo esc_html( get_theme_mod( 'ostrich_blog_blog_btn_title', __('Load More', 'ostrich-blog') ) ); ?>
                        </a>
                    </div>
                <?php endif ?>
            </main><!-- #main -->
            <?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
                </div><!-- #primary -->
            <?php } ?>
        <?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
        <aside id="secondary" class="widget-area" role="complementary">
            <?php
                dynamic_sidebar( 'blog-sidebar' );
            ?>
        </aside><!-- #secondary -->
    <?php } ?>
    </div><!-- .wrapper -->
</div><!-- #inner-content-wrapper-->
