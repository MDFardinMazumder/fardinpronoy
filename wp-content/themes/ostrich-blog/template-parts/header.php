<?php 
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Theme Header
 */

?> 
  <header id="masthead" class="site-header <?php echo esc_attr( get_theme_mod( 'ostrich_blog_header_style') ) ; ?> <?php echo esc_attr( get_theme_mod( 'ostrich_blog_header_display') ) ; ?>" role="banner">

       <div class="wrapper"> 
   
        
        <?php if ( get_theme_mod( 'ostrich_blog_header_style' ) == 'header-2' ): ?>
                <div class="header-banner">     
        <?php endif ?>
                    
                <div class="site-branding">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="site-logo">
                            <?php the_custom_logo(); ?>
                        </div><!-- .site-logo -->
                    <?php endif; ?>
                    <?php if ( get_theme_mod( 'ostrich_blog_header_text_display', true ) == true ): ?>
                        <div id="site-identity">
                            <?php
                            if ( is_front_page() ) : ?>
                                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                            <?php else : ?>
                                <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                            <?php
                            endif;

                            $description = get_bloginfo( 'description', 'display' );
                            if ( $description || is_customize_preview() ) : ?>
                                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                            <?php
                            endif; ?>
                        </div><!-- .site-branding -->
                    <?php endif ?>
                    
                </div>
                <?php if ( get_theme_mod( 'ostrich_blog_header_display', 'ads' ) !== 'none' && get_theme_mod( 'ostrich_blog_header_style', 'header-1' ) == 'header-2' ): ?>
                    <div class="site-advertisement">
                        <?php if ( get_theme_mod( 'ostrich_blog_header_display', 'ads' ) == 'ads' ): ?>
                            <a href="<?php echo esc_url( get_theme_mod( 'ostrich_blog_header_ads_image_url', '#' ) ) ; ?>"><img src="<?php echo esc_url( get_theme_mod( 'ostrich_blog_header_ads_image', '' ) ); ?>" height="200" ></a>
                        <?php endif ?>
                        
                        <?php if ( get_theme_mod( 'ostrich_blog_header_display' ) == 'social-menu' ): ?>
                            <ul id="secondary-menu" class="menu nav-menu" aria-expanded="false">
                                <?php if (  has_nav_menu('social') ): ?>                                 
                                        <li class="social-menu-item">
                                            <?php 
                                                wp_nav_menu( array(
                                                    'theme_location' => 'social',
                                                    'menu_class'     => 'social-icons',
                                                    'container_class' => 'social-menu',
                                                    'depth'          => 1,
                                                    'link_before'    => '<span class="screen-reader-text">',
                                                    'link_after'     => '</span>' . ostrich_blog_get_svg( array( 'icon' => 'chain' ) ),
                                                ) );
                                            ?>
                                        </li>
                                <?php elseif( current_user_can( 'edit_theme_options' ) ): ?>
                                    <li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php echo esc_html__( 'Add a menu', 'ostrich-blog' );?></a></li>
                                <?php endif; ?>                           
                            </ul>
                        <?php endif ?>
                        
                    </div><!-- .site-advertisement -->
                <?php endif; ?>
                
            
        <?php if ( get_theme_mod( 'ostrich_blog_header_style' ) == 'header-2' ): ?>
            </div>    
        <?php endif ?>
        
        
        
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
            <svg viewBox="0 0 40 40" class="icon-menu">
                <g>
                    <rect y="7" width="40" height="2"/>
                    <rect y="19" width="40" height="2"/>
                    <rect y="31" width="40" height="2"/>
                </g>
            </svg>
            <svg viewBox="0 0 612 612" class="icon-close">
                <polygon points="612,36.004 576.521,0.603 306,270.608 35.478,0.603 0,36.004 270.522,306.011 0,575.997 35.478,611.397 
                306,341.411 576.521,611.397 612,575.997 341.459,306.011"/>
            </svg>
        </button>
        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <nav id="site-navigation" class="main-navigation <?php echo ( get_theme_mod( 'ostrich_blog_header_style' ) == 'header-3' ) ? 'header-3-nav' : ''; ?>" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'ostrich-blog' );?>">
                
                <?php
                    wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'menu nav-menu',                    
                ) );
                ?>
            </nav><!-- #site-navigation -->
        <?php elseif( current_user_can( 'edit_theme_options' ) ): ?>
            <nav class="main-navigation" id="site-navigation">
                <ul id="primary-menu" class="menu nav-menu">
                    <li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php echo esc_html__( 'Add a menu', 'ostrich-blog' );?></a></li>
                </ul>
            </nav>
        <?php endif; ?> 

       </div > 

</header><!-- #masthead -->



