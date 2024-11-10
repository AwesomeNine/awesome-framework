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
use Awesome9\Framework\Utilities\HTML;

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
		$this->set_defaults();
		$this->register();
	}

	/**
	 * Adds fields to the section.
	 *
	 * @param array $args The field arguments.
	 *
	 * @return Section
	 */
	public function add_field( $args ): Section {
		$args = wp_parse_args(
			$args,
			[
				'id'      => '',
				'title'   => '',
				'section' => $this->get( 'id' ),
				'page'    => $this->get( 'page' ),
			]
		);

		$this->fields[] = new Field( $args );

		return $this;
	}

	/**
	 * Render the section.
	 *
	 * @return void
	 */
	public function display(): void {
		require dirname( __DIR__, 2 ) . '/views/settings/section.php';
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
				'wrapper_id'    => 'section-id-' . $this->get( 'id' ),
				'wrapper_class' => HTML::classnames(
					'settings-option-group',
					$this->get( 'template' ) ? 'option-group-tmpl-' . $this->get( 'template' ) : 'option-group-tmpl-default',
				),
			]
		);
	}

	/**
	 * Register the section into WordPress.
	 *
	 * @return void
	 */
	private function register() {
		\add_settings_section(
			$this->get( 'id' ),
			$this->get( 'title' ),
			null,
			$this->get( 'page' )
		);
	}
}
