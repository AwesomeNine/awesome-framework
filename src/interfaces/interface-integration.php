<?php
/**
 * An interface for registering integrations with WordPress.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Interfaces;

defined( 'ABSPATH' ) || exit;

/**
 * Integration interface.
 */
interface Integration_Interface {

	/**
	 * Hook into WordPress.
	 */
	public function hooks();
}
