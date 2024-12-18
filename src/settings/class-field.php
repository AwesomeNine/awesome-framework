<?php
/**
 * Field class for managing settings fields.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Settings;

use Awesome9\Framework\Toolkit;
use Awesome9\Framework\Utilities\HTML;
use Awesome9\Framework\Traits\Arguments;

/**
 * Represents a settings field in the admin settings page.
 */
class Field {

	use Arguments;

	/**
	 * Constructor.
	 *
	 * @param array $args The field arguments.
	 *
	 * @throws \InvalidArgumentException If required arguments are missing.
	 */
	public function __construct( array $args ) {
		$this->args = $args;
		$this->validate_args();
		$this->set_defaults();
		$this->register();
	}

	/**
	 * Render the field.
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
	 * Register the field with WordPress settings API.
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
	 * Validate required arguments.
	 *
	 * @return void
	 *
	 * @throws \InvalidArgumentException If required arguments are missing.
	 */
	private function validate_args(): void {
		$required = [ 'id', 'title', 'type', 'page', 'section' ];
		foreach ( $required as $key ) {
			if ( empty( $this->args[ $key ] ) ) {
				throw new \InvalidArgumentException( sprintf( 'Missing required argument: %s', $key ) ); // phpcs:ignore
			}
		}
	}

	/**
	 * Set default arguments for the field.
	 *
	 * @return void
	 */
	private function set_defaults(): void {
		$this->args = wp_parse_args(
			$this->args,
			[
				'pos_desc'      => 'left',
				'wrapper_id'    => 'option-id-' . $this->get( 'id' ),
				'wrapper_class' => HTML::classnames(
					'settings-option-field',
					'option-type-' . $this->get( 'type' ),
					$this->get( 'wrapper-classnames' )
				),
			]
		);
	}
}
