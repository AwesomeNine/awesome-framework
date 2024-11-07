<?php
/**
 * Text class.
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
 * Text class
 */
class Text {

	/**
	 * Displays a text input.
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
				'type'          => 'text',
				'description'   => '',
			]
		);

		$field_attrs = [
			'id'          => $args['id'],
			'name'        => $args['name'],
			'value'       => $args['value'],
			'placeholder' => $args['placeholder'],
			'type'        => $args['type'],
			'style'       => $args['style'],
			'class'       => HTML::classnames( 'awesome9-form__input input-text', $args['class'] ),
		];

		Toolkit::input_wrap( $id, $label, $args );
		?>
		<input <?php echo HTML::build_attributes( array_filter( $field_attrs ) ); // phpcs:ignore ?>>
		<?php
		Toolkit::input_wrap( $id, $label, $args );
	}
}
