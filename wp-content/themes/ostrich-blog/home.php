<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package themeostrich
 */

get_header(); ?>
 <div id="page-site-header" class="relative" >
    <div class="wrapper">
 	    <?php the_custom_header_markup(); ?>
        <header class="page-header">
        	<h2 class="page-title">
            	<?php 
            	if ( ostrich_blog_is_latest_posts() ) {
            		echo esc_html( get_theme_mod( 'ostrich_blog_your_latest_posts_title', esc_html__( 'Blogs', 'ostrich-blog' ) ) ); 
            	} elseif( ostrich_blog_is_frontpage_blog() ) {
            		single_post_title();
            	} 
            	?>
            </h2>
        </header>
        <?php  
        $breadcrumb_enable = get_theme_mod( 'ostrich_blog_breadcrumb_enable', true );
        if ( $breadcrumb_enable ) : 
            ?>
            <div id="breadcrumb-list" >
                <?php echo ostrich_blog_breadcrumb( array( 'show_on_front'   => false, 'show_browse' => false ) ); ?>
            </div><!-- #breadcrumb-list -->
        <?php endif; ?>
    </div><!-- .wrapper -->
</div><!-- #page-site-header -->

<div id="inner-content-wrapper" class="wrapper page-section">
		<div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
	        	<?php 
	        	$sticky_posts = get_option( 'sticky_posts' );  
	        	if ( ! empty( $sticky_posts ) ) :
	        	?>
                    <div id="ostrich-blog-infinite-scroll" class="archive-blog-wrapper list-layout clear">
    	        		<?php  
    						$sticky_query = new WP_Query( array(
    							'post__in'  => $sticky_posts,
    						) );

    						if ( $sticky_query->have_posts() ) :
    							/* Start the Loop */
    							while ( $sticky_query->have_posts() ) : $sticky_query->the_post();
    								get_template_part( 'template-parts/content', get_post_format() );
    							endwhile;
    							wp_reset_postdata();
    						endif;
    	        		?>
                    </div><!-- .blog-posts-wrapper/.sticky-post-wrapper -->
	        	<?php endif; 

        		$page_id = get_option( 'page_for_posts' );
        		
        	    $ostrich_blog_page_sidebar_meta = get_post_meta( $page_id, 'ostrich-blog-select-sidebar', true );
        		$global_page_sidebar = get_theme_mod( 'ostrich_blog_global_page_layout', 'right' ); 

        		if ( ! empty( $ostrich_blog_page_sidebar_meta ) && ( 'no' === $ostrich_blog_page_sidebar_meta ) ) {
        			$col = 3;
        		} elseif ( empty( $ostrich_blog_page_sidebar_meta ) && 'no' === $global_page_sidebar ) {
        			$col = 3;
        		} else {
        			$col = 2;
        		}
	        	?>
                
                <div class="archive-blog-wrapper list-layout clear">
					<?php
					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						wp_reset_postdata();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>
				</div><!-- .blog-posts-wrapper -->
				<?php ostrich_blog_posts_pagination();?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar();?>
</div>
<?php get_footer();
