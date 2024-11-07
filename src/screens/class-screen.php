<?php
/**
 * Screen base class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Screens;

use Awesome9\Framework\Toolkit;
use Awesome9\Framework\Utilities\Params;

defined( 'ABSPATH' ) || exit;

/**
 * Abstracts Screen.
 */
abstract class Screen {

	/**
	 * Hold hook.
	 *
	 * @var string
	 */
	private $hook = '';

	/**
	 * Hold tabs.
	 *
	 * @var array
	 */
	private $tabs = [];

	/**
	 * Hold manager.
	 *
	 * @var Manager
	 */
	private $manager = null;

	/**
	 * Screen constructor.
	 *
	 * @param object $manager Manager object.
	 */
	public function __construct( $manager ) {
		$this->manager = $manager;
	}

	/* Page Hook ------------------- */

	/**
	 * Get the hook.
	 *
	 * @return string
	 */
	public function get_hook(): string {
		return $this->hook;
	}

	/**
	 * Set the hook.
	 *
	 * @param string $hook Hook to set.
	 *
	 * @return void
	 */
	public function set_hook( $hook ): void {
		$this->hook = $hook;
	}

	/* Screen API ------------------- */

	/**
	 * Screen unique id.
	 *
	 * @return string
	 */
	abstract public function get_id(): string;

	/**
	 * Register screen into WordPress admin area.
	 *
	 * @return void
	 */
	abstract public function register_screen(): void;

	/**
	 * Enqueue assets
	 *
	 * @return void
	 */
	public function enqueue_assets(): void {}

	/**
	 * Display screen content.
	 *
	 * @return void
	 */
	public function display(): void {}

	/**
	 * Get the order value.
	 *
	 * @return int The order value, which is 10.
	 */
	public function get_order(): int {
		return 10;
	}

	/* Tabs API ------------------- */

	/**
	 * Get the tabs.
	 *
	 * @return array
	 */
	public function get_tabs(): array {
		return $this->tabs;
	}

	/**
	 * Set the tabs.
	 *
	 * @param array $tabs Array of screen tabs.
	 *
	 * @return void
	 */
	public function set_tabs( $tabs ): void {
		$this->tabs = $tabs;
	}

	/**
	 * Get current tab id.
	 *
	 * @return string
	 */
	public function get_current_tab_id(): string {
		$first = current( array_keys( $this->tabs ) );

		return Params::get( 'sub_page', $first );
	}

	/**
	 * Render tabs menu
	 *
	 * @param array $args Arguments to be used in the template.
	 *
	 * @return void
	 */
	public function get_tabs_menu( $args = [] ): void {
		Toolkit::tabs( $this->get_tabs(), $this->get_current_tab_id(), ...$args );
	}

	/**
	 * Render tabs content
	 *
	 * @param array $args Arguments to be used in the template.
	 *
	 * @return void
	 */
	public function get_tab_content( $args = [] ): void {
		$active = $this->get_current_tab_id();
		$tab    = $this->get_tabs()[ $active ];

		$this->manager->render_tab_content( $active, $tab, $args );
	}

	/* Header API ------------------- */

	/**
	 * Get page header arguments
	 *
	 * @return array
	 */
	public function define_header_args(): array {
		return [];
	}

	/**
	 * Get page header arguments
	 *
	 * @return array
	 */
	public function get_header_args(): array {
		$wp_screen = get_current_screen();
		return wp_parse_args(
			$this->define_header_args(),
			[
				'title'            => get_admin_page_title(),
				'breadcrumb_title' => get_admin_page_title(),
				'breadcrumb'       => true,
				'manual_url'       => '',
				'screen'           => $wp_screen,
			]
		);
	}
}
