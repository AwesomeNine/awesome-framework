<?php
/**
 * Assets registry handles the registration of stylesheets and scripts required for plugin functionality.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework;

use Awesome9\Framework\Interfaces\Integration_Interface;

defined( 'ABSPATH' ) || exit;

/**
 * Assets Registry.
 */
abstract class Assets_Registry implements Integration_Interface {

	/**
	 * Version of plugin local asset.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * Prefix to use in handle to make it unique.
	 *
	 * @var string
	 */
	static public $prefix = 'awesome9';

	/**
	 * Hook to enqueue the assets.
	 *
	 * @var string
	 */
	public $hook = 'admin_enqueue_scripts';

	/**
	 * Base url
	 *
	 * @var string
	 */
	public $base_url = '';

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public function hooks(): void {
		add_action( $this->hook, [ $this, 'registry' ], 0 );
	}

	/**
	 * Register assets
	 *
	 * @return void
	 */
	abstract public function registry(): void;

	/**
	 * Enqueue stylesheet
	 *
	 * @param string $handle Name of the stylesheet.
	 *
	 * @return void
	 */
	public static function style( $handle ): void {
		wp_enqueue_style( self::prefix_it( $handle ) );
	}

	/**
	 * Enqueue script
	 *
	 * @param string $handle Name of the script.
	 *
	 * @return void
	 */
	public static function script( $handle ): void {
		wp_enqueue_script( self::prefix_it( $handle ) );
	}

	/**
	 * Prefix the handle
	 *
	 * @param string $handle Name of the asset.
	 *
	 * @return string
	 */
	public static function prefix_it( $handle ): string {
		return self::$prefix . '-' . $handle;
	}

	/**
	 * Register stylesheet
	 *
	 * @param string           $handle Name of the stylesheet. Should be unique.
	 * @param string|bool      $src    URL of the stylesheet.
	 * @param string[]         $deps   Optional. An array of registered stylesheet handles this stylesheet depends on.
	 * @param string|bool|null $ver    Optional. String specifying stylesheet version number.
	 * @param string           $media  Optional. The media for which this stylesheet has been defined.
	 *
	 * @return void
	 */
	protected function register_style( $handle, $src, $deps = [], $ver = false, $media = 'all' ) {
		if ( false === $ver ) {
			$ver = $this->version;
		}

		wp_register_style( self::prefix_it( $handle ), $this->base_url . $src, $deps, $ver, $media );
	}

	/**
	 * Register script
	 *
	 * @param string           $handle    Name of the stylesheet. Should be unique.
	 * @param string|bool      $src       URL of the stylesheet.
	 * @param string[]         $deps      Optional. An array of registered stylesheet handles this stylesheet depends on.
	 * @param string|bool|null $ver       Optional. String specifying stylesheet version number.
	 * @param bool             $in_footer Optional. The media for which this stylesheet has been defined.
	 *
	 * @return void
	 */
	protected function register_script( $handle, $src, $deps = [], $ver = false, $in_footer = false ) {
		if ( false === $ver ) {
			$ver = $this->version;
		}

		wp_register_script( self::prefix_it( $handle ), $this->base_url . $src, $deps, $ver, $in_footer );
	}
}
