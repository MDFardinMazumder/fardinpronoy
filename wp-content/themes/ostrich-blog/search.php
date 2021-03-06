<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package themeostrich
 */

get_header(); ?>
		
	<div id="page-site-header" class="relative">	
		    <div class="wrapper">
				<?php the_custom_header_markup(); ?>	
		        <header class="page-header">
		            <h1 class="page-title"><?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'ostrich-blog' ), '<span>' . get_search_query() . '</span>' );
					?></h1>
		        </header>
		        <?php  
		        $breadcrumb_enable = get_theme_mod( 'ostrich_blog_breadcrumb_enable', true );
		        if ( $breadcrumb_enable ) : 
		            ?>
		            <div id="breadcrumb-list">
		                    <?php echo ostrich_blog_breadcrumb( array( 'show_on_front'   => false, 'show_browse' => false ) ); ?>
		            </div><!-- #breadcrumb-list -->
		        <?php endif; ?>
		    </div><!-- .wrapper -->
		</div><!-- #page-site-header -->

    	<div id="inner-content-wrapper" class="wrapper page-section">
			<div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
    	        	<?php 
    	    		$archive_sidebar = get_theme_mod( 'ostrich_blog_archive_sidebar', 'right' ); 
    	    		$col = ( 'no' === $archive_sidebar ) ? 3 : 2;
    	        	?>
                    <div id="ostrich-blog-infinite-scroll" class="archive-blog-wrapper list-layout clear">
						<?php
						/* Start the Loop */
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_format() );

							endwhile;

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>
					</div><!-- .posts-wrapper -->
					<?php ostrich_blog_posts_pagination();?>
				</main><!-- #main -->
			</div><!-- #primary -->
			
			<?php get_sidebar(); ?>
				
		</div>

<?php
get_footer();
