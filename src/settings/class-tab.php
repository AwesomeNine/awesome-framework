<?php
/**
 * Tab class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Settings;

use Awesome9\Framework\Traits\Arguments;

/**
 * Tab class.
 */
class Tab {

	use Arguments;

	/**
	 * Sections.
	 *
	 * @var array
	 */
	private $sections = [];

	/**
	 * Constructor.
	 *
	 * @param array $args The section arguments.
	 */
	public function __construct( $args ) {
		$this->args = $args;
	}

	/**
	 * Add section.
	 *
	 * @param array $args The section arguments.
	 *
	 * @return Section
	 */
	public function add_section( $args ): Section {
		$args['page']     = $this->get( 'page' );
		$section          = new Section( $args );
		$this->sections[] = $section;

		return $section;
	}

	/**
	 * Render the tab.
	 *
	 * @return void
	 */
	public function display(): void {
		foreach ( $this->sections as $section ) {
			$section->display();
		}
	}
}
