<?php
/**
 * Textarea class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Toolkit;

use Awesome9\Framework\Toolkit;
use Awesome9\Framework\Utilities\HTML;

defined( 'ABSPATH' ) || exit;

/**
 * Textarea class
 */
class Textarea {

	/**
	 * Displays a textarea input.
	 *
	 * @param string $id    The ID of the input.
	 * @param string $label The title of the input.
	 * @param array  $args  Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function render( $id, $label, $args ): void {
		$args = wp_parse_args(
			$args,
			[
				'id'            => $id,
				'name'          => $id,
				'value'         => '',
				'placeholder'   => '',
				'class'         => '',
				'style'         => '',
				'wrapper_class' => '',
				'description'   => '',
				'rows'          => 4,
				'cols'          => 50,
			]
		);

		$field_attrs = [
			'id'          => $args['id'],
			'name'        => $args['name'],
			'placeholder' => $args['placeholder'],
			'style'       => $args['style'],
			'class'       => HTML::classnames( 'awesome9-form__input input-textarea', $args['class'] ),
			'rows'        => $args['rows'],
			'cols'        => $args['cols'],
		];

		Toolkit::input_wrap( $id, $label, $args );
		?>
		<textarea <?php echo HTML::build_attributes( array_filter( $field_attrs ) ); // phpcs:ignore ?>><?php echo esc_textarea( $args['value'] ); ?></textarea>
		<?php
		Toolkit::input_wrap( $id, $label, $args );
	}
}
