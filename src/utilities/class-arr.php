<?php
/**
 * Array utilities
 *
 * @package Awesome9\Framework\Utilities
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Utilities;

use ArrayAccess;

defined( 'ABSPATH' ) || exit;

/**
 * Array class.
 */
class Arr {

	/**
	 * Determine whether the given value is array accessible.
	 *
	 * @param mixed $value Value to check.
	 *
	 * @return bool
	 */
	public static function accessible( $value ) {
		return is_array( $value ) || $value instanceof ArrayAccess;
	}

	/**
	 * Add an element to an array using "dot" notation if it doesn't exist.
	 *
	 * @param  array            $arr   Array to add to.
	 * @param  string|int|float $key   Key.
	 * @param  mixed            $value Value.
	 *
	 * @return array
	 */
	public static function add( $arr, $key, $value ) {
		if ( null === static::get( $arr, $key ) ) {
			static::set( $arr, $key, $value );
		}

		return $arr;
	}

	/**
	 * Determine if the given key exists in the provided array.
	 *
	 * @param ArrayAccess|array $arr Array to check key in.
	 * @param string|int        $key Key to check for.
	 *
	 * @return bool
	 */
	public static function exists( $arr, $key ) {
		if ( $arr instanceof ArrayAccess ) {
			return $arr->offsetExists( $key );
		}

		if ( is_float( $key ) ) {
			$key = (string) $key;
		}

		return array_key_exists( $key, $arr );
	}

	/**
	 * Create an array from string.
	 *
	 * @param string $string    The string to split.
	 * @param string $separator Specifies where to break the string.
	 *
	 * @return array Returns an array after applying the function to each one.
	 */
	public static function from_string( $string, $separator = ',' ) {
		return array_values( array_filter( array_map( 'trim', explode( $separator, $string ) ) ) );
	}

	/**
	 * Get an item from an array using "dot" notation.
	 *
	 * @param \ArrayAccess|array $arr     Array to use.
	 * @param string|int|null    $key     Key to get.
	 * @param mixed              $default Default value if not found.
	 *
	 * @return mixed
	 */
	public static function get( $arr, $key, $default = null ) {
		if ( ! static::accessible( $arr ) ) {
			return $default;
		}

		if ( null === $key ) {
			return $arr;
		}

		if ( static::exists( $arr, $key ) ) {
			return $arr[ $key ];
		}

		if ( ! str_contains( $key, '.' ) ) {
			return $arr[ $key ] ?? $default;
		}

		foreach ( explode( '.', $key ) as $segment ) {
			if ( static::accessible( $arr ) && static::exists( $arr, $segment ) ) {
				$arr = $arr[ $segment ];
			} else {
				return $default;
			}
		}

		return $arr;
	}

	/**
	 * Check if an item or items exist in an array using "dot" notation.
	 *
	 * @param \ArrayAccess|array $arr  Array to use.
	 * @param string|array       $keys Keys to check.
	 *
	 * @return bool
	 */
	public static function has( $arr, $keys ) {
		$keys = (array) $keys;

		if ( ! $arr || [] === $keys ) {
			return false;
		}

		foreach ( $keys as $key ) {
			$subkey_array = $arr;

			if ( static::exists( $arr, $key ) ) {
				continue;
			}

			foreach ( explode( '.', $key ) as $segment ) {
				if ( static::accessible( $subkey_array ) && static::exists( $subkey_array, $segment ) ) {
					$subkey_array = $subkey_array[ $segment ];
				} else {
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * Determine if any of the keys exist in an array using "dot" notation.
	 *
	 * @param \ArrayAccess|array $arr  Array to use.
	 * @param string|array       $keys Keys to check.
	 *
	 * @return bool
	 */
	public static function has_any( $arr, $keys ) {
		if ( null === $keys ) {
			return false;
		}

		$keys = (array) $keys;

		if ( ! $arr ) {
			return false;
		}

		if ( [] === $keys ) {
			return false;
		}

		foreach ( $keys as $key ) {
			if ( static::has( $arr, $key ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Insert a single array item inside another array at a set position
	 *
	 * @param array $arr      Array to modify. Is passed by reference, and no return is needed.
	 * @param array $new      New array to insert.
	 * @param int   $position Position in the main array to insert the new array.
	 */
	public static function insert( &$arr, $new, $position ) {
		$before = array_slice( $arr, 0, $position - 1 );
		$after  = array_diff_key( $arr, $before );
		$arr    = array_merge( $before, $new, $after );
	}

	/**
	 * Pluck an array of values from an array.
	 *
	 * @param iterable              $arr   Array to pluck from.
	 * @param string|array|int|null $value Value index dot notation.
	 * @param string|array|null     $key   Key index dot notation.
	 *
	 * @return array
	 */
	public static function pluck( $arr, $value, $key = null ) {
		$results = [];

		[$value, $key] = static::explode_pluck_parameters( $value, $key );

		foreach ( $arr as $item ) {
			$item_value = static::get( $item, $value );

			// If the key is "null", we will just append the value to the array and keep
			// looping. Otherwise we will key the array using the value of the key we
			// received from the developer. Then we'll return the final array form.
			if ( null === $key ) {
				$results[] = $item_value;
			} else {
				$item_key = static::get( $item, $key );

				if ( is_object( $item_key ) && method_exists( $item_key, '__toString' ) ) {
					$item_key = (string) $item_key;
				}

				$results[ $item_key ] = $item_value;
			}
		}

		return $results;
	}

	/**
	 * Push an item onto the beginning of an array.
	 *
	 * @param array $arr   Array to prepend to.
	 * @param mixed $value Value.
	 * @param mixed $key   Key.
	 *
	 * @return array
	 */
	public static function prepend( $arr, $value, $key = null ) {
		if ( 2 === func_num_args() ) {
			array_unshift( $arr, $value );
		} else {
			$arr = [ $key => $value ] + $arr;
		}

		return $arr;
	}

	/**
	 * Set an array item to a given value using "dot" notation.
	 *
	 * If no key is given to the method, the entire array will be replaced.
	 *
	 * @param array           $arr   Array to set into.
	 * @param string|int|null $key   Key.
	 * @param mixed           $value Value.
	 *
	 * @return array
	 */
	public static function set( &$arr, $key, $value ) {
		if ( null === $key ) {
			$arr = $value;
			return $arr;
		}

		$keys = explode( '.', $key );

		foreach ( $keys as $i => $key ) {
			if ( 1 === count( $keys ) ) {
				break;
			}

			unset( $keys[ $i ] );

			// If the key doesn't exist at this depth, we will just create an empty array
			// to hold the next value, allowing us to create the arrays to hold final
			// values at the correct depth. Then we'll keep digging into the array.
			if ( ! isset( $arr[ $key ] ) || ! is_array( $arr[ $key ] ) ) {
				$arr[ $key ] = [];
			}

			$arr = &$arr[ $key ];
		}

		$arr[ array_shift( $keys ) ] = $value;

		return $arr;
	}

	/**
	 * Sort the array in descending order using the given callback or "dot" notation.
	 *
	 * @param array $arr Array to sort.
	 *
	 * @return array
	 */
	public static function sort_desc( $arr ) {
		arsort( $arr, SORT_REGULAR );

		return $arr;
	}

	/**
	 * Filter the array using the given callback.
	 *
	 * @param array    $arr      Array to filter.
	 * @param callable $callback Callback to run on array.
	 *
	 * @return array
	 */
	public static function where( $arr, callable $callback ) {
		return array_filter( $arr, $callback, ARRAY_FILTER_USE_BOTH );
	}

	/**
	 * Filter items where the value is not null.
	 *
	 * @param array $arr Array to filter.
	 *
	 * @return array
	 */
	public static function where_not_null( $arr ): array {
		return static::where( $arr, fn ( $value ) => null !== $value );
	}

	/**
	 * Explode the "value" and "key" arguments passed to "pluck".
	 *
	 * @param string|array      $value Value array.
	 * @param string|array|null $key   Key array.
	 *
	 * @return array
	 */
	protected static function explode_pluck_parameters( $value, $key ) {
		$value = is_string( $value ) ? explode( '.', $value ) : $value;

		$key = null === $key || is_array( $key ) ? $key : explode( '.', $key );

		return [ $value, $key ];
	}
}
