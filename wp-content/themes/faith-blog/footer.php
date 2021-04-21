<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package faith based blog
 */
?>

</div><!-- #content -->

<?php

$getfooter_column = get_theme_mod( 'footer_column', 'four' );
$footerlayout = 'four';
if ('four' === $getfooter_column) {
	$footerlayout = 'four';
}elseif ('two' === $getfooter_column) {
	$footerlayout = 'two';
}
$footer_default_class = 'footer-area section-padding yellowbg';
$transparent_footer_bg = get_theme_mod( 'transparent_footer_bg', false );
if (true === $transparent_footer_bg) {
	$footer_default_class = 'footer-area section-padding';
}
if ( is_active_sidebar('footer-1') || is_active_sidebar( 'footer-2' ) || is_active_sidebar('footer-3') || is_active_sidebar('footer-4') ) :
?>

	<div class="<?php echo esc_attr($footer_default_class);?>">
	    <div class="container">
	        <div class="row justify-content-center">
	        	<?php get_template_part( 'template-parts/footer/footer', $footerlayout ); ?>
	       	</div>
	    </div>
	</div>
<?php endif;
do_action( 'faith_blog_footer_credit' );
?>
	
	<div class="scrooltotop">
		<a href="#" class="fa fa-angle-up"></a>
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
