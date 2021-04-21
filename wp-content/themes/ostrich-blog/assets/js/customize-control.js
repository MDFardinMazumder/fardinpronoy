/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

(function( $, api ) {
    wp.customize.bind('ready', function() {
    	// Show message on change.
        var ostrich_blog_settings = ['ostrich_blog_slider_num', 'ostrich_blog_services_num', 'ostrich_blog_projects_num', 'ostrich_blog_testimonial_num', 'ostrich_blog_blog_section_num', 'ostrich_blog_reset_settings', 'ostrich_blog_testimonial_num', 'ostrich_blog_partner_num'];
        _.each( ostrich_blog_settings, function( ostrich_blog_setting ) {
            wp.customize( ostrich_blog_setting, function( setting ) {
                var ostrich_blogNotice = function( value ) {
                    var name = 'needs_refresh';
                    if ( value && ostrich_blog_setting == 'ostrich_blog_reset_settings' ) {
                        setting.notifications.add( 'needs_refresh', new wp.customize.Notification(
                            name,
                            {
                                type: 'warning',
                                message: localized_data.reset_msg,
                            }
                        ) );
                    } else if( value ){
                        setting.notifications.add( 'reset_name', new wp.customize.Notification(
                            name,
                            {
                                type: 'info',
                                message: localized_data.refresh_msg,
                            }
                        ) );
                    } else {
                        setting.notifications.remove( name );
                    }
                };

                setting.bind( ostrich_blogNotice );
            });
        });

        /* === Radio Image Control === */
        api.controlConstructor['radio-color'] = api.Control.extend( {
            ready: function() {
                var control = this;

                $( 'input:radio', control.container ).change(
                    function() {
                        control.setting.set( $( this ).val() );
                    }
                );
            }
        } );


        // Deep linking for counter section to about section.
        jQuery('.ostrich-blog-edit').click(function(e) {
            e.preventDefault();
            var jump_to = jQuery(this).attr( 'data-jump' );
            wp.customize.section( jump_to ).focus()
        });

    });
})( jQuery, wp.customize );
