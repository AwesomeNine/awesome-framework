<?php
/**
 * Form raw input
 *
 * @package Awesome9\Framework\Form
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Form;

defined( 'ABSPATH' ) || exit;

/**
 * Field raw class
 */
class Field_Raw extends Field {

	/**
	 * Render field
	 *
	 * @return void
	 */
	public function render() {
		$callback = $this->get( 'callback' );
		if ( is_callable( $callback ) ) {
			$callback();
		}
	}
}
