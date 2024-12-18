<?php
/**
 * Argument traits.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Traits;

use Awesome9\Framework\Utilities\Arr;

/**
 * Provides methods to manage and retrieve arguments.
 */
trait Arguments {
	/**
	 * Tab arguments.
	 *
	 * @var array
	 */
	private array $args = [];

	/**
	 * Retrieve a value from the arguments array.
	 *
	 * @param string $key     The key to retrieve from the arguments array.
	 * @param mixed  $default The default value to return if the key does not exist. Default is null.
	 *
	 * @return mixed The value from the arguments array if the key exists, otherwise the default value.
	 */
	public function get( string $key, $default = null ) {
		return Arr::get( $this->args, $key, $default );
	}

	/**
	 * Set a value in the arguments array.
	 *
	 * @param string $key   The key to set in the arguments array.
	 * @param mixed  $value The value to set in the arguments array.
	 *
	 * @return void
	 */
	public function set( string $key, $value ): void {
		Arr::set( $this->args, $key, $value );
	}
}
