<?php
/**
 * An interface for registering routes with WordPress.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Interfaces;

defined( 'ABSPATH' ) || exit;

/**
 * Routes interface.
 */
interface Routes_Interface {

	/**
	 * Registers routes with WordPress.
	 *
	 * @return void
	 */
	public function register_routes(): void;
}
