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
		foreach ( $this->get_screens() as $renderer ) {
			$renderer->register_screen();
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
		$screen_ids = $this->get_screen_ids();
		$wp_screen  = get_current_screen();

		if ( in_array( $wp_screen->id, $screen_ids, true ) ) {
			$classes .= ' ' . $this->define_body_class();
		}

		return $classes;
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
		if ( null !== $this->screen_ids ) {
			return $this->screen_ids;
		}

		$screens = $this->get_screens();

		foreach ( $screens as $screen ) {
			$this->screen_ids[] = $screen->get_hook();
		}

		return $this->screen_ids;
	}
}
