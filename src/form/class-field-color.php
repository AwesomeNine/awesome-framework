<?php
/**
 * Form color input
 *
 * @package Awesome9\Framework\Form
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Form;

defined( 'ABSPATH' ) || exit;

/**
 * Field color class
 */
class Field_Color extends Field {

	/**
	 * Render field
	 *
	 * @return void
	 */
	public function render() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		?>
		<input class="<?php echo esc_attr( $this->get( 'class' ) ); ?>" name="<?php echo esc_attr( $this->get( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $this->get( 'value' ) ); ?>" />
		<?php
	}
}
