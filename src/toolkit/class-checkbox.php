<?php
/**
 * Checkbox class.
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
 * Checkbox class
 */
class Checkbox {
	/**
	 * Displays a checkbox input.
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
				'options'           => [],
				'multiple'          => false,
				'inline'            => false,
				'class'             => '',
				'wrapper_class'     => '',
				'description'       => '',
				'custom_attributes' => [],
			]
		);

		Toolkit::input_wrap( $id, $label, $args );
		?>
		<div class="<?php echo HTML::classnames( 'input-checkboxes', [ 'input-inline' => $args['inline'] ] ); // phpcs:ignore ?>">
			<?php
			foreach ( $args['options'] as $key => $value ) :
				$checkbox_id = $args['id'] . '-' . $key;
				$attrs       = [
					'id'      => $checkbox_id,
					'name'    => $args['multiple'] ? $args['name'] . '[]' : $args['name'] . '-' . $key,
					'type'    => 'checkbox',
					'value'   => $key,
					'checked' => in_array( $key, (array) $args['value'], true ),
				];
				?>
			<div class="input-checkbox">
				<input <?php echo HTML::build_attributes( array_filter( $attrs ) ); // phpcs:ignore ?>>
				<label for="<?php echo esc_attr( $checkbox_id ); ?>">
					<?php echo esc_html( $value ); ?>
				</label>
			</div>
			<?php endforeach; ?>
		</div>
		<?php
		Toolkit::input_wrap( $id, $label, $args );
	}
}
