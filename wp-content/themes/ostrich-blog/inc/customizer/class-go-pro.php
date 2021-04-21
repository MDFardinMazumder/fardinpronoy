<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  ostrich-blog 1.0.0
 * @access public
 */
final class Ostrich_Blog_Go_Pro {

	/**
	 * Returns the instance.
	 *
	 * @since ostrich-blog 1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since ostrich-blog 1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since ostrich-blog 1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since ostrich-blog 1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require get_template_directory() . '/inc/customizer/section-go-pro.php';

		// Register custom section types.
		$manager->register_section_type( 'Ostrich_Blog_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Ostrich_Blog_Customize_Section_Pro(
				$manager,
				'ostrich-blog',
				array(
					'title'    => esc_html__( 'Ostrich Blog Pro','ostrich-blog' ),
					'pro_text' => esc_html__( 'Buy Pro','ostrich-blog' ),
					'pro_url'  => esc_url( 'https://themeostrich.com/downloads/ostrich-blog-pro/' )
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since ostrich-blog 1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'ostrich-blog-go-pro-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/go-pro-customize-controls.js', array( 'customize-controls' ) );

	}
}

// Doing this customizer thang!
Ostrich_Blog_Go_Pro::get_instance();
