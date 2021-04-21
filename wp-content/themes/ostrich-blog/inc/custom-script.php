<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Custom Script
`*/
function ostrich_blog_custom_script(){
?>
	<script type="text/javascript">
		
		jQuery(document).ready(function($) {
			<?php if ( get_theme_mod( 'ostrich_blog_header_style' ) == 'header-2' ): ?>
				// Initial state
			    var scrollPos = 0;
			    // adding scroll event
			    window.addEventListener('scroll', function(){
			      // detects new state and compares it with the new one
			      if ((document.body.getBoundingClientRect()).top > scrollPos)
			            $('#masthead .wrapper').css("display", "block");
				        $('#site-navigation').css("border-top", "2px solid #000");

			        // saves the new position for iteration.
			        scrollPos = (document.body.getBoundingClientRect()).top;
			    });

			    $(window).scroll(function() {
			    	
					if ($(this).scrollTop() > 1) {
			            $('.menu-sticky #masthead .wrapper').css("display", "none");
			            $('.menu-sticky #site-navigation').css("border-bottom", "none");
			            $('.menu-sticky #site-navigation').css("border-top", "none");
			        }
			        	 
			    });
			<?php endif ?>
			 
		});
	</script>
<?php
}

add_action( 'wp_footer', 'ostrich_blog_custom_script' );