<?php
/**
 * Radio class.
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
 * Radio class
 */
class Radio {

	/**
	 * Displays a radio input.
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
				'class'             => '',
				'inline'            => false,
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
				$radio_id = $args['id'] . '-' . $key;
				$attrs    = [
					'id'      => $radio_id,
					'name'    => $args['name'],
					'type'    => 'radio',
					'value'   => $key,
					'checked' => in_array( $key, (array) $args['value'], true ),
				];
				?>
			<div class="input-radio">
				<input <?php echo HTML::build_attributes( $attrs ); // phpcs:ignore ?>>
				<label for="<?php echo esc_attr( $radio_id ); ?>">
					<span class="input-radio__button"></span>
					<?php echo esc_html( $value ); ?>
				</label>
			</div>
			<?php endforeach; ?>
		</div>
		<?php
		Toolkit::input_wrap( $id, $label, $args );
	}
}
