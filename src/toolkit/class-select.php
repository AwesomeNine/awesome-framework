<?php
/**
 * Select class.
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
 * Select class
 */
class Select {

	/**
	 * Displays a select input.
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
				'id'                => $id,
				'name'              => $id,
				'value'             => '',
				'placeholder'       => '',
				'options'           => [],
				'class'             => '',
				'style'             => '',
				'wrapper_class'     => '',
				'description'       => '',
				'custom_attributes' => [],
			]
		);

		$select_attrs = [
			'id'          => $args['id'],
			'name'        => $args['name'],
			'placeholder' => $args['placeholder'],
			'style'       => $args['style'],
			'class'       => HTML::classnames( 'awesome9-form__input input-select', $args['class'] ),
		];
		$select_attrs = array_merge( $select_attrs, (array) $args['custom_attributes'] );
		Toolkit::input_wrap( $id, $label, $args );
		?>
		<select <?php echo HTML::build_attributes( array_filter( $select_attrs ) ); // phpcs:ignore ?>>
		<?php
		foreach ( $args['options'] as $key => $value ) {
			printf(
				'<option value="%s"%s>%s</option>',
				esc_attr( $key ),
				selected( $key, $args['value'], false ),
				esc_html( $value )
			);
		}
		?>
		</select>
		<?php
		Toolkit::input_wrap( $id, $label, $args );
	}
}
