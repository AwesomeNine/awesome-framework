<?php
/**
 * Conditional utilities
 *
 * @package Awesome9\Installation
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Utilities;

defined( 'ABSPATH' ) || exit;

/**
 * Conditional class.
 */
class Conditional {

	/**
	 * Determines whether the current request is an autosave
	 *
	 * @return bool
	 */
	public static function wp_doing_autosave(): bool {
		return defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE;
	}

	/**
	 * Is REST request
	 *
	 * @return bool
	 */
	public static function is_rest() {
		$request = Params::server( 'REQUEST_URI' );
		if ( empty( $request ) ) {
			return false;
		}

		return false !== strpos( $request, trailingslashit( rest_get_url_prefix() ) );
	}
}
