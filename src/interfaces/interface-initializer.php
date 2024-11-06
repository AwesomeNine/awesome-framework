<?php
/**
 * An interface for registering initializer with WordPress.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Interfaces;

defined( 'ABSPATH' ) || exit;

/**
 * Initializer interface.
 */
interface Initializer_Interface {

	/**
	 * Runs this initializer.
	 *
	 * @return void
	 */
	public function initialize(): void;
}
