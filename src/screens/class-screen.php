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
 * Abstract Screen class for managing admin screens in WordPress.
 */
abstract class Screen {

	/**
	 * The hook assigned to the screen.
	 *
	 * @var string
	 */
	private string $hook = '';

	/**
	 * List of tabs for the screen.
	 *
	 * @var array
	 */
	private array $tabs = [];

	/* Page Hook Api --------------- */

	/**
	 * Get the screen hook.
	 *
	 * @return string Hook assigned to the screen.
	 */
	public function get_hook(): string {
		return $this->hook;
	}

	/**
	 * Set the screen hook.
	 *
	 * @param string $hook Hook to be set for the screen.
	 *
	 * @return void
	 */
	public function set_hook( string $hook ): void {
		$this->hook = $hook;
	}

	/* Screen API ------------------- */

	/**
	 * Get the unique identifier for the screen.
	 *
	 * @return string Unique screen ID.
	 */
	abstract public function get_id(): string;

	/**
	 * Register the screen in the WordPress admin area.
	 *
	 * @return void
	 */
	abstract public function register_screen(): void;

	/**
	 * Enqueue assets such as scripts or styles for the screen.
	 *
	 * @return void
	 */
	public function enqueue_assets(): void {}

	/**
	 * Display the content of the screen.
	 *
	 * @return void
	 */
	public function display(): void {}

	/**
	 * Get the order of the screen.
	 *
	 * @return int Order value for the screen. Default is 10.
	 */
	public function get_order(): int {
		return 10;
	}

	/* Tabs API ------------------- */

	/**
	 * Get the tabs defined for the screen.
	 *
	 * @return array List of tabs.
	 */
	public function get_tabs(): array {
		return $this->tabs;
	}

	/**
	 * Set the tabs for the screen.
	 *
	 * @param array $tabs Array of tabs to set.
	 *
	 * @return void
	 */
	public function set_tabs( array $tabs ): void {
		$this->tabs = $tabs;
	}

	/**
	 * Get the current active tab ID.
	 *
	 * @return string Active tab ID.
	 */
	public function get_current_tab_id(): string {
		$first = array_key_first( $this->tabs );

		return Params::get( 'sub_page', $first );
	}

	/**
	 * Before tab content.
	 *
	 * @return void
	 */
	public function before_tab_content(): void {}

	/**
	 * After tab content.
	 *
	 * @return void
	 */
	public function after_tab_content(): void {}

	/**
	 * Render the content of the current tab.
	 *
	 * @param array $args Arguments for rendering the tab content.
	 *
	 * @return void
	 */
	public function get_tab_content( array $args = [] ): void {
		$active = $this->get_current_tab_id();
		$tab    = $this->tabs[ $active ] ?? null;

		if ( ! $tab ) {
			return;
		}

		$this->before_tab_content();

		if ( isset( $tab['callback'] ) ) {
			call_user_func( $tab['callback'] );
		} elseif ( isset( $tab['filename'] ) ) {
			include $tab['filename'];
		}

		$this->after_tab_content();
	}

	/* Header API ------------------- */

	/**
	 * Define the arguments for the screen header.
	 *
	 * @return array Associative array of header arguments.
	 */
	public function define_header_args(): array {
		return [];
	}

	/**
	 * Get the parsed arguments for the screen header.
	 *
	 * @return array Parsed header arguments.
	 */
	public function get_header_args(): array {
		return wp_parse_args(
			$this->define_header_args(),
			[
				'title'            => get_admin_page_title(),
				'breadcrumb_title' => get_admin_page_title(),
				'breadcrumb'       => true,
				'manual_url'       => '',
			]
		);
	}

	/**
	 * Add actions to the header
	 *
	 * @return void
	 */
	public function header_actions(): void {}
}
