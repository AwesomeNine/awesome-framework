<?php
/**
 * Form select input
 *
 * @package Awesome9\Framework\Form
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Form;

use Awesome9\Framework\Utilities\HTML;

defined( 'ABSPATH' ) || exit;

/**
 * Field select class
 */
class Field_Select extends Field {

	/**
	 * Render field
	 *
	 * @return void
	 */
	public function render() {
		$value = $this->get( 'value' );
		$value = is_array( $value ) ? $value : [ $value ];

		$attrs = [
			'class' => HTML::classnames( 'regular-text', esc_attr( $this->get( 'class' ) ) ),
			'id'    => $this->get( 'id' ),
			'name'  => $this->get( 'name' ),
		];

		if ( $this->get( 'multiple', false ) ) {
			$attrs['multiple'] = 'multiple';
		}
		?>
		<select <?php echo HTML::build_attributes( $attrs ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<?php foreach ( $this->get( 'options' ) as $option ) : ?>
				<?php if ( isset( $option['items'] ) ) : ?>
				<optgroup label="<?php echo esc_attr( $option['label'] ); ?>">
					<?php
					foreach ( $option['items'] as $option ) {
						$this->render_option( $option, $value );
					}
					?>
				</optgroup>
				<?php else : ?>
					<?php $this->render_option( $option, $value ); ?>
				<?php endif; ?>
			<?php endforeach; ?>
		</select>
		<?php
	}

	/**
	 * Render option
	 *
	 * @param array $option Option data.
	 * @param mixed $value Current value.
	 *
	 * @return void
	 */
	private function render_option( $option, $value ) {
		$selected = in_array( $option['value'], $value, true );
		?>
		<option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $selected ); ?>>
			<?php echo esc_html( $option['label'] ); ?>
		</option>
		<?php
	}
}
