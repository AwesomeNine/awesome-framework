<?php
/**
 * Section class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Settings;

use Awesome9\Framework\Traits\Arguments;

/**
 * Section class.
 */
class Section {

	use Arguments;

	/**
	 * Fields.
	 *
	 * @var array
	 */
	private $fields = [];

	/**
	 * Constructor.
	 *
	 * @param array $args The section arguments.
	 */
	public function __construct( $args ) {
		$this->args = $args;
	}

	/**
	 * Adds fields to the section.
	 *
	 * @param array $args The field arguments.
	 *
	 * @return void
	 */
	public function add_field( $args ) {
		$args['section']  = $this->get( 'id' );
		$args['callback'] = [ $this, 'render_field' ];
		$this->fields[]   = $args;
	}

	/**
	 * Register the section into WordPress.
	 *
	 * @return void
	 */
	public function register() {
		\add_settings_section(
			$this->get( 'id' ),
			$this->get( 'title' ),
			null,
			$this->get( 'page' )
		);

		foreach ( $this->fields as $field ) {
			\add_settings_field(
				$field['id'],
				$field['title'],
				$field['callback'],
				$this->args['page'],
				$this->args['id'],
				$field
			);
		}
	}

	/**
	 * Render the section.
	 *
	 * @return void
	 */
	public function display(): void {
		echo $this->get( 'title' );
	}
}
