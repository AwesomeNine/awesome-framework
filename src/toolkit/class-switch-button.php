<?php
/**
 * Switch class.
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
 * Switch class
 */
class Switch_Button {

	/**
	 * Displays a switch input.
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
				'wrapper_class' => '',
				'description'   => '',
				'label_on'      => '',
				'label_off'     => '',
			]
		);

		$field_attrs = [
			'id'    => $args['id'],
			'name'  => $args['name'],
			'value' => $args['value'],
			'type'  => 'checkbox',
			'class' => 'awesome9-form__input',
		];

		Toolkit::input_wrap( $id, $label, $args );
		?>
		<div class="input-switch">
			<?php if ( $args['label_off'] ) : ?>
			<span class="input-switch__label"><?php echo esc_html( $args['label_off'] ); ?></span>
			<?php endif; ?>
			<label for="<?php echo esc_attr( $args['id'] ); ?>">
				<input <?php echo HTML::build_attributes( array_filter( $field_attrs ) ); // phpcs:ignore ?>>
				<div class="input-switch__button"></div>
			</label>
			<?php if ( $args['label_on'] ) : ?>
			<span class="input-switch__label"><?php echo esc_html( $args['label_on'] ); ?></span>
			<?php endif; ?>
		</div>
		<?php
		Toolkit::input_wrap( $id, $label, $args );
	}
}
