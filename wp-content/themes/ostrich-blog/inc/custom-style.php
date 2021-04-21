<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Custom Style
 */
function ostrich_blog_header_text_style() {
	// If we get this far, we have custom styles. Let's do this.
	$header_text_display = get_theme_mod( 'ostrich_blog_header_text_display' );
	?>
	<style type="text/css">

	.site-title a{
		color: #<?php echo esc_attr( get_header_textcolor() ); ?>;
	}
	.site-description {
		color: <?php echo esc_attr( get_theme_mod( 'ostrich_blog_header_tagline', '#2e2e2e' ) ); ?>;
	}

	<?php if ( get_theme_mod( 'ostrich_blog_topbar_menu' ) == false ): ?>
		.main-navigation .social-menu-item:after {
		    display: none;
		}
	<?php endif ?>

	<?php if ( get_theme_mod( 'ostrich_blog_topbar_search' ) == false ): ?>
		#top-navigation .icon-wrapper span a:after {
		    display: none;
		}
	<?php endif ?>



	/*header styles*/

	<?php if ( get_theme_mod( 'ostrich_blog_header_style' ) == 'header-2' ): ?>
		.site-branding{
			width: <?php echo ( get_theme_mod( 'ostrich_blog_header_display', 'ads' ) == 'none' ) ? '100%' : '40%'; ?>;
		}
	
		#masthead nav {
			border-top: 2px solid #000;
			width: 100%;
		} 
		
		@media screen and (min-width: 1024px){
		.main-navigation ul.nav-menu{
				float: none;
			}
		}

	<?php endif ?>


	<?php if ( !is_active_sidebar( 'blog-sidebar' ) ) { ?>
		.second-design.home .archive-blog-wrapper article:nth-child(2n+1) {
		    clear: none;
		}
		.second-design.home .archive-blog-wrapper article {
    		width: 33.33%;
    	}	
	<?php } ?>	

	<?php if ( !empty(get_theme_mod( 'ostrich_blog_header_media_video_code' ) ) ): ?>
		#page-site-header {
			padding: 0px;
		}

		#page-site-header iframe{
			top: 0px;
		    left: 0px;
		    right: 0px;
		    width: 100%;
		    max-height: 600px;
		    border: none;
		    height: -webkit-fill-available;
		}

		#page-site-header .wrapper{
			top:80%;
		}
		#page-site-header .page-title{
			position: relative;
		}
		#page-site-header #breadcrumb-list{
			position: relative;
		}
	<?php endif ?>	

	
	</style>

	<?php
}
add_action( 'wp_head', 'ostrich_blog_header_text_style' );