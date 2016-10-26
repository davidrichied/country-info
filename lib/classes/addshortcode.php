<?php
class Country_Info_AddShortcode {

	public function __construct() {}

	/**
	 * Static Singleton Factory Method
	 *
	 * @since  4.1
	 * @return Tribe__Events__Shortcode__Event_Details
	 */
	public static function instance() {
		static $instance;

		if ( ! $instance ) {
			$instance = new self;
		}

		return $instance;
	}

	/**
	 * Add the necessary hooks at the correct moment in WordPress
	 *
	 * @since  4.1
	 * @return  void
	 */
	public static function hook() {
		$myself = self::instance();

		add_action( 'init', array( $myself, 'add_shortcode' ) );
	}
	/**
	 * This will be called at hook "init" to allow other plugins and themes to hook to shortcode easily
	 *
	 * @since 4.1
	 * @return void
	 */
	public function add_shortcode() {
		add_shortcode( 'd2l_co_info', array( $this, 'do_shortcode' ) );
	}

	/**
	 * Actually create the shortcode output
	 *
	 * @since  4.1
	 *
	 * @param  array $args    The Shortcode arguments
	 *
	 * @return string
	 */
	public function do_shortcode( $args ) {

		// Start to record the Output
		ob_start(); ?>

	<div id="country_code_widget">
		<input type="text" id="co-search-input">
		<button type="submit" id="search-country">Submit</button>
		<label id="country-code-placeholder"></label>
	</div><?php

		// Save it to a variable
		$html = ob_get_clean();


		return $html;
	}

}