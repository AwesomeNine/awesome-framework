<?php
/**
 * String utilities
 *
 * @package Awesome9\Framework\Utilities
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Utilities;

defined( 'ABSPATH' ) || exit;

/**
 * Str class.
 */
class Str {
	/**
	 * Validates whether the passed variable is a empty string.
	 *
	 * @param mixed $variable The variable to validate.
	 *
	 * @return bool Whether or not the passed value is a non-empty string.
	 */
	public static function is_empty( $variable ): bool {
		return ! is_string( $variable ) || empty( $variable );
	}

	/**
	 * Validates whether the passed variable is a non-empty string.
	 *
	 * @param mixed $variable The variable to validate.
	 *
	 * @return bool Whether or not the passed value is a non-empty string.
	 */
	public static function is_non_empty( $variable ): bool {
		return is_string( $variable ) && '' !== $variable;
	}

	/**
	 * Check if the string contains the given value.
	 *
	 * @param string $needle      The sub-string to search for.
	 * @param string $haystack    The string to search.
	 * @param bool   $ignore_case Whether to ignore case.
	 *
	 * @return bool
	 */
	public static function contains( $needle, $haystack, $ignore_case = false ): bool {
		if ( $ignore_case ) {
			$needle   = strtolower( $needle );
			$haystack = strtolower( $haystack );
		}

		return self::is_non_empty( $needle ) ? mb_strpos( $haystack, $needle ) !== false : false;
	}

	/**
	 * Check if the string end with the given value.
	 *
	 * @param string $needle   The sub-string to search for.
	 * @param string $haystack The string to search.
	 *
	 * @return bool
	 */
	public static function ends_with( $needle, $haystack ): bool {
		return static::is_empty( $needle ) || mb_substr( $haystack, -static::length( $needle ) ) === (string) $needle;
	}

	/**
	 * Return the length of the given string.
	 *
	 * @param string      $value    The string to get the length of.
	 * @param string|null $encoding The encoding to use.
	 *
	 * @return int
	 */
	public static function length( $value, $encoding = null ): int {
		if ( $encoding ) {
			return mb_strlen( $value, $encoding );
		}

		return mb_strlen( $value );
	}

	/**
	 * Check if the string begins with the given value.
	 *
	 * @param string $needle   The sub-string to search for.
	 * @param string $haystack The string to search.
	 *
	 * @return bool
	 */
	public static function starts_with( $needle, $haystack ): bool {
		return static::is_empty( $needle ) || mb_substr( $haystack, 0, static::length( $needle ) ) === (string) $needle;
	}

	/**
	 * Wrapper for mb_strtoupper which see's if supported first.
	 *
	 * @param string      $str      String to format.
	 * @param string|null $encoding Encoding to use.
	 *
	 * @return string
	 */
	public static function to_upper( $str, $encoding = 'UTF-8' ) {
		$str = $str ?? '';
		return $encoding ? mb_strtoupper( $str, $encoding ) : mb_strtoupper( $str );
	}

	/**
	 * Make a string lowercase.
	 * Try to use mb_strtolower() when available.
	 *
	 * @param string      $str      String to format.
	 * @param string|null $encoding Encoding to use.
	 *
	 * @return string
	 */
	public static function to_lower( $str, $encoding = 'UTF-8' ) {
		$str = $str ?? '';
		return $encoding ? mb_strtolower( $str, $encoding ) : mb_strtolower( $str );
	}
}
