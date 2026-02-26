<?php
/**
 * Form selector input
 *
 * @package Awesome9\Framework\Form
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Form;

defined( 'ABSPATH' ) || exit;

/**
 * Field selector class
 */
class Field_Selector extends Field {

	/**
	 * Render field
	 *
	 * @return void
	 */
	public function render() {
		?>
		<div id="awesome-frontend-element-<?php echo esc_attr( $this->get( 'placement_id' ) ); ?>">
			<input type="text" class="awesome-frontend-element" name="<?php echo esc_attr( $this->get( 'name' ) ); ?>" value="<?php echo esc_attr( $this->get( 'value' ) ); ?>" />
			<button style="display:none; color: red;" type="button" class="awesome-deactivate-frontend-picker button">
				stop selection
			</button>
			<button type="button" class="awesome-activate-frontend-picker button" data-placementid="<?php echo esc_attr( $this->get( 'placement_id' ) ); ?>" data-action="edit-placement">
				select position
			</button>
		</div>
		<?php
	}
}
