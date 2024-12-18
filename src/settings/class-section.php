<?php
/**
 * Section class for managing settings sections.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Settings;

use Awesome9\Framework\Traits\Arguments;
use Awesome9\Framework\Utilities\HTML;

/**
 * Represents a settings section in the WordPress admin.
 */
class Section {

	use Arguments;

	/**
	 * Fields within the section.
	 *
	 * @var Field[]
	 */
	private array $fields = [];

	/**
	 * Constructor.
	 *
	 * @param array $args The section arguments.
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
	 * Add a field to the section.
	 *
	 * @param array $args The field arguments.
	 *
	 * @return self
	 */
	public function add_field( array $args ): self {
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
	 * Set default arguments for the section.
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
	 * Register the section with WordPress.
	 *
	 * @return void
	 */
	private function register(): void {
		\add_settings_section(
			$this->get( 'id' ),
			$this->get( 'title' ),
			null,
			$this->get( 'page' )
		);
	}

	/**
	 * Validate required section arguments.
	 *
	 * @return void
	 *
	 * @throws \InvalidArgumentException If required arguments are missing.
	 */
	private function validate_args(): void {
		$required = [ 'id', 'title', 'page' ];
		foreach ( $required as $key ) {
			if ( empty( $this->args[ $key ] ) ) {
				throw new \InvalidArgumentException( sprintf( 'Missing required argument: %s', $key ) ); // phpcs:ignore
			}
		}
	}
}
