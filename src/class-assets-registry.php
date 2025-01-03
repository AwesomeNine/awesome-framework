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
use Awesome9\Framework\Utilities\Str;

defined( 'ABSPATH' ) || exit;

/**
 * Assets Registry.
 *
 * This class abstracts the process of registering, enqueuing, dequeuing, deregistering, and inline scripting or styling
 * for assets like CSS and JavaScript.
 *
 * Script functions:
 *
 * @method void enqueue_script(string $handle)
 * @method void dequeue_script(string $handle)
 * @method void deregister_script(string $handle)
 * @method bool register_script(string $handle, string|false $src, string[] $deps = [], string|bool|null $ver = false, array|bool $args = [])
 * @method bool inline_script(string $handle, string $data, string $position = 'after')
 * @method bool is_script(string $handle, string $status = 'enqueued')
 * @method bool localize_script(string $handle, string $object_name, array $l10n)
 *
 * Style functions:
 *
 * @method void enqueue_style(string $handle)
 * @method void dequeue_style(string $handle)
 * @method void deregister_style(string $handle)
 * @method bool register_style(string $handle, string|false $src, string[] $deps = [], string|bool|null $ver = false, string $media = 'all')
 * @method bool inline_style(string $handle, string $data, )
 * @method bool is_style(string $handle, string $status = 'enqueued')
 */
abstract class Assets_Registry implements Integration_Interface {

	/**
	 * Base URL for plugin local assets.
	 *
	 * @return string Base URL for assets.
	 */
	abstract public function get_base_url(): string;

	/**
	 * Prefix to use in handle to make it unique.
	 *
	 * @return string Prefic for assets.
	 */
	abstract public function get_prefix(): string;

	/**
	 * Version for plugin local assets.
	 *
	 * @return string Version of the assets.
	 */
	abstract public function get_version(): string;

	/**
	 * Magic method for handling dynamic asset operations like enqueue, dequeue, register, and inline.
	 *
	 * @param string $name      The name of the method.
	 * @param array  $arguments The arguments passed to the method.
	 *
	 * @return mixed The result of the action or null if the function does not exist.
	 */
	public function __call( $name, $arguments ) {
		if ( preg_match( '/^(enqueue|dequeue|register|deregister|is|inline|localize)_(script|style)$/', $name, $matches ) ) {
			$action    = $matches[1];
			$type      = $matches[2];
			$handle    = $this->prefix_it( $arguments[0] );
			$func      = $this->resolve_function( $action . '_' . $type );
			$func_args = [ $handle ];

			switch ( $action ) {
				case 'register':
					$func_args[] = $this->resolve_url( $arguments[1] );
					$func_args[] = isset( $arguments[2] ) && is_array( $arguments[2] ) && ! empty( $arguments[2] )
						? array_map( [ $this, 'prefix_dep' ], $arguments[2] ) : [];
					$func_args[] = isset( $arguments[3] ) && ! empty( $arguments[3] ) ? $arguments[3] : $this->get_version();
					$func_args[] = $arguments[4] ?? ( 'script' === $type ? true : 'all' );
					break;
				case 'is':
					$func_args[] = $arguments[1] ?? 'enqueued';
					break;
				case 'inline':
					$func_args[] = $arguments[1] ?? '';
					if ( 'script' === $type ) {
						$func_args[] = $arguments[2] ?? 'after';
					}
					break;
				case 'localize':
					$func_args[] = $arguments[1] ?? 'unknown';
					$func_args[] = $arguments[2] ?? [];
					break;
				default:
					break;
			}

			if ( ! function_exists( $func ) ) {
				trigger_error( "Function $func does not exist.", E_USER_WARNING ); // phpcs:ignore
				return null;
			}

			return call_user_func_array( $func, $func_args );
		}
	}

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public function hooks(): void {
		add_action( 'admin_head', [ $this, 'enqueue_colors' ], 0 );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ], 0 );
		add_action( 'admin_enqueue_scripts', [ $this, 'register_assets' ], 0 );
	}

	/**
	 * Enqueue colors for the admin area.
	 *
	 * @return void
	 */
	public function enqueue_colors(): void {
		static $awesome_colors = false;
		// Early bail!!
		if ( $awesome_colors ) {
			return;
		}
		$awesome_colors = true;
		?>
		<style>
			:root {
				--awesome-color-primary: 110, 68, 255;
				--awesome-color-primary-hover: 148, 122, 241;
				--awesome-color-secondary: 65, 69, 79;
				--awesome-color-info: 96, 165, 250;
				--awesome-color-success: 16, 185, 129;
				--awesome-color-warning: 250, 204, 21;
				--awesome-color-danger: 244, 67, 55;
				--awesome-border-color: 205, 207, 213;
			}
		</style>
		<?php
	}

	/**
	 * Register assets for both scripts and styles.
	 *
	 * @return void
	 */
	public function register_assets(): void {
		$this->register_styles();
		$this->register_scripts();
	}

	/**
	 * Prefix the handle to ensure asset uniqueness.
	 *
	 * @param string $handle Name of the asset.
	 *
	 * @return string Prefixed handle.
	 */
	public function prefix_it( $handle ): string {
		return $this->get_prefix() . '-' . $handle;
	}

	/**
	 * Register styles.
	 *
	 * @return void
	 */
	public function register_styles(): void {}

	/**
	 * Register scripts.
	 *
	 * @return void
	 */
	public function register_scripts(): void {}

	/**
	 * Resolves the URL for an asset.
	 *
	 * If the provided URL is an absolute URL or protocol-relative, it is returned as-is.
	 * Otherwise, the base URL is prepended to the relative path.
	 *
	 * @param string $src The asset source URL.
	 *
	 * @return string The resolved URL.
	 */
	private function resolve_url( string $src ): string {
		if ( preg_match( '/^(https?:)?\/\//', $src ) ) {
			return $src;
		}

		return $this->get_base_url() . $src;
	}

	/**
	 * Resolves the WordPress function name for a specific asset action.
	 *
	 * @param string $name The name of the action (e.g., register_script).
	 *
	 * @return string The corresponding WordPress function name.
	 */
	private function resolve_function( $name ): string {
		$method_map = [
			'is_script'     => 'script_is',
			'is_style'      => 'style_is',
			'inline_script' => 'add_inline_script',
			'inline_style'  => 'add_inline_style',
		];

		$name = $method_map[ $name ] ?? $name;

		return 'wp_' . $name;
	}

	/**
	 * Prefix the dependency to ensure it's uniquely identified.
	 *
	 * @param string $dep Dependency handle.
	 *
	 * @return string Prefixed dependency handle.
	 */
	private function prefix_dep( $dep ): string {
		if ( Str::starts_with( '_pre_', $dep ) ) {
			$dep = str_replace( '_pre_', '', $dep );
			$dep = $this->prefix_it( $dep );
		}

		return $dep;
	}
}
