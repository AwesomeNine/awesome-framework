<?php
/**
 * Field class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Settings;

use Awesome9\Framework\Toolkit;
use Awesome9\Framework\Traits\Arguments;
use Awesome9\Framework\Utilities\HTML;

/**
 * Field class.
 */
class Field {

	use Arguments;

	/**
	 * Constructor.
	 *
	 * @param array $args The section arguments.
	 */
	public function __construct( $args ) {
		$this->args = $args;
		$this->set_defaults();
		$this->register();
	}

	/**
	 * Render the tab.
	 *
	 * @return void
	 */
	public function display(): void {
		$method = 'display_' . $this->get( 'type' );

		if ( method_exists( $this, $method ) ) {
			$this->$method();
			return;
		}

		call_user_func( [ Toolkit::class, 'input_' . $this->get( 'type' ) ], $this->get( 'id' ), $this->get( 'title' ), $this->args );
	}

	/**
	 * Register the sections.
	 *
	 * @return void
	 */
	private function register(): void {
		\add_settings_field(
			$this->get( 'id' ),
			$this->get( 'title' ),
			[ $this, 'display' ],
			$this->get( 'page' ),
			$this->get( 'section' ),
			$this->args
		);
	}

	/**
	 * Set the default arguments.
	 *
	 * @return void
	 */
	private function set_defaults(): void {
		$this->args = wp_parse_args(
			$this->args,
			[
				'pos_desc'      => 'left',
				'wrapper_id'    => $this->get_wrapper_id(),
				'wrapper_class' => $this->get_wrapper_class(),
			]
		);
	}

	/**
	 * Get the wrapper ID.
	 *
	 * @return string
	 */
	private function get_wrapper_id(): string {
		return 'option-id-' . $this->get( 'id' );
	}

	/**
	 * Get the wrapper class.
	 *
	 * @return string
	 */
	private function get_wrapper_class(): string {
		return HTML::classnames(
			'settings-option-field',
			'option-type-' . $this->get( 'type' ),
			$this->get( 'wrapper-classnames' )
		);
	}
}
