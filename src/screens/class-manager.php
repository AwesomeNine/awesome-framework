<?php
/**
 * Screen Manager class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Screens;

use Awesome9\Framework\Interfaces\Integration_Interface;

defined( 'ABSPATH' ) || exit;

/**
 * Manager class.
 */
abstract class Manager implements Integration_Interface {

	/**
	 * Hold screens
	 *
	 * @var array
	 */
	private $screens = [];

	/**
	 * Hold screen hooks
	 *
	 * @var array
	 */
	private $screen_ids = null;

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public function hooks(): void {
		add_action( 'admin_menu', [ $this, 'add_pages' ], 15 );
		add_filter( 'admin_body_class', [ $this, 'add_body_class' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'current_screen' ], 10, 0 );
		add_action( 'in_admin_header', [ $this, 'add_custom_header' ], 25 );
	}

	/**
	 * Define the body class for the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	abstract protected function define_body_class(): string;

	/**
	 * Define the screens for the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	abstract protected function define_screens(): void;

	/**
	 * Render tab content
	 *
	 * @param string $active Active tab.
	 * @param array  $tab    Tab object.
	 * @param array  $args   Arguments to be used in the template.
	 *
	 * @return void
	 */
	abstract public function render_tab_content( $active, $tab, $args ): void;

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function add_pages(): void {
		foreach ( $this->get_screens() as $screen ) {
			$screen->register_screen();
			$this->screen_ids[ $screen->get_hook() ] = $screen->get_id();
		}
	}

	/**
	 * Add a custom class to the body tag of Advanced Ads screens.
	 *
	 * @param string $classes Space-separated class list.
	 *
	 * @return string
	 */
	public function add_body_class( string $classes ): string {
		if ( $this->is_screen() ) {
			$classes .= ' ' . $this->define_body_class();
		}

		return $classes;
	}

	/**
	 * Enqueue styles and scripts for current screen
	 *
	 * @return void
	 */
	public function current_screen(): void {
		if ( $this->is_screen() ) {
			$screen = $this->get_current_screen();
			$screen->enqueue_assets();
			do_action( 'advanced-ads-screen-' . $screen->get_id(), $screen );
		}
	}

	/**
	 * Add custom header to the plugin screens.
	 *
	 * @return string
	 */
	public function define_header_view(): string {
		return '';
	}

	/**
	 * Add plugin custom header.
	 *
	 * @return void
	 */
	public function add_custom_header(): void {
		if ( $this->is_screen() && $this->define_header_view() ) {
			$current_screen = $this->get_current_screen();
			extract( $current_screen->get_header_args(), EXTR_SKIP ); // phpcs:ignore WordPress.PHP.DontExtract

			include_once $this->define_header_view();
		}
	}

	/**
	 * Add a screen to the list of screens
	 *
	 * @param string $screen Screen class name.
	 *
	 * @return void
	 */
	public function add_screen( string $screen ): void {
		$screen = new $screen( $this );

		$this->screens[ $screen->get_id() ] = $screen;
	}

	/**
	 * Get screens
	 *
	 * @return array
	 */
	public function get_screens(): array {
		if ( ! empty( $this->screens ) ) {
			return $this->screens;
		}

		$this->define_screens();

		// Order screens using the order property.
		uasort(
			$this->screens,
			static function ( $a, $b ) {
				$order_a = $a->get_order();
				$order_b = $b->get_order();

				if ( $order_a === $order_b ) {
					return 0;
				}

				return ( $order_a < $order_b ) ? -1 : 1;
			}
		);

		return $this->screens;
	}

	/**
	 * Get screen ids
	 *
	 * @return array
	 */
	public function get_screen_ids(): array {
		return $this->screen_ids;
	}

	/**
	 * Check if the current screen is plugin screen.
	 *
	 * @return bool
	 */
	public function is_screen(): bool {
		return array_key_exists( get_current_screen()->id, $this->get_screen_ids() );
	}

	/**
	 * Get current screen
	 *
	 * @return null|Screen
	 */
	public function get_current_screen() {
		$screen_id = $this->get_screen_ids()[ get_current_screen()->id ] ?? null;

		return $screen_id ? $this->screens[ $screen_id ] : null;
	}
}
