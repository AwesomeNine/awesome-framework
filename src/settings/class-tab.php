<?php
/**
 * Tab class for managing settings tab sections.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Settings;

use Awesome9\Framework\Traits\Arguments;

/**
 * Handles the addition of sections and rendering for the settings tab.
 */
class Tab {

	use Arguments;

	/**
	 * Sections within the tab.
	 *
	 * @var Section[]
	 */
	private array $sections = [];

	/**
	 * Constructor.
	 *
	 * @param array $args The arguments for the tab.
	 */
	public function __construct( array $args ) {
		$this->args = $args;
	}

	/**
	 * Add a section to the tab.
	 *
	 * @param array $args The arguments for the section.
	 *
	 * @return Section The created Section instance.
	 */
	public function add_section( array $args ): Section {
		// Ensure the section has the page argument inherited from the tab.
		$args['page'] = $this->get( 'page' );

		// Create a new section and add it to the sections array.
		$section          = new Section( $args );
		$this->sections[] = $section;

		return $section;
	}

	/**
	 * Render and display the tab along with its sections.
	 *
	 * @return void
	 */
	public function display(): void {
		if ( empty( $this->sections ) ) {
			echo '<p>No sections to display.</p>';
		}

		foreach ( $this->sections as $section ) {
			$section->display();
		}
	}
}
