<?php
/**
 * Form size input
 *
 * @package Awesome9\Framework\Form
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Form;

defined( 'ABSPATH' ) || exit;

/**
 * Field size class
 */
class Field_Size extends Field {

	/**
	 * Render field
	 *
	 * @return void
	 */
	public function render() {
		$name  = $this->get( 'name' );
		$value = $this->get( 'value' );
		?>
		<p class="<?php echo esc_attr( $this->get( 'class' ) ); ?>">
			<?php if ( $name['width'] ) : ?>
			<label><?php esc_html_e( 'Width', 'advanced-ads-framework' ); ?>
			<input type="number" value="<?php echo esc_attr( $value['width'] ); ?>" name="<?php echo esc_attr( $name['width'] ); ?>"> px</label>&nbsp;
			<?php endif; ?>

			<?php if ( $name['height'] ) : ?>
			<label><?php esc_html_e( 'Height', 'advanced-ads-framework' ); ?>
			<input type="number" value="<?php echo esc_attr( $value['height'] ); ?>" name="<?php echo esc_attr( $name['height'] ); ?>"> px</label>
			<?php endif; ?>
		</p>
		<?php
	}
}
