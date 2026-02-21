<?php
/**
 * Form group input
 *
 * @package Awesome9\Framework\Form
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Form;

defined( 'ABSPATH' ) || exit;

/**
 * Field group class
 */
class Field_Group extends Field {

	/**
	 * Render field
	 *
	 * @return void
	 */
	public function render() {
		// Early bail!!
		if ( ! $this->get( 'fields' ) ) {
			return;
		}

		foreach ( $this->get( 'fields' ) as $field ) {
			$object = Form::get_field_type( $field );

			if ( $object ) {
				$object->render_field();
			}
		}
	}
}
