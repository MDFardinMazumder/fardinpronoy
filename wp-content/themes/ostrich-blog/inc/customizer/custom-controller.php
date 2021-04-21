<?php
/**
 * Ostrich Blog
 *
 * @package Ostrich Blog
 * Custom Controller
 */



/**
 * Radio color customize control.
 *
 * @since  3.0.0
 * @access public
 */
class Ostrich_Blog_Customize_Control_Radio_Color extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'radio-color';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// We need to make sure we have the correct color URL.
		foreach ( $this->choices as $value => $args )
			$this->choices[ $value ]['color'] = esc_attr( $args['color'] );

		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['value']   = $this->value();
		$this->json['id']      = $this->id;
	}

	/**
	 * Don't render the content via PHP.  This control is handled with a JS template.
	 *
	 * @since  4.0.0
	 * @access public
	 * @return bool
	 */
	protected function render_content() {}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( ! data.choices ) {
			return;
		} #>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<# _.each( data.choices, function( args, choice ) { #>
			<label>
				<input type="radio" value="{{ choice }}" name="_customize-{{ data.type }}-{{ data.id }}" {{{ data.link }}} <# if ( choice === data.value ) { #> checked="checked" <# } #> />

				<span class="screen-reader-text">{{ args.label }}</span>
				
				<# if ( 'custom' != choice ) { #>
					<span class="color-value" style="background-color: {{ args.color }}"></span>
				<# } else { #>
					<span class="color-value custom-color-value"></span>
				<# } #>
			</label>
		<# } ) #>
	<?php }
}

$wp_customize->register_control_type( 'ostrich_blog_Customize_Control_Radio_Color');

