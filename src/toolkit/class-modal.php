<?php
/**
 * Modal class.
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
 * Modal class
 */
class Modal {

	/**
	 * Display a Modal.
	 *
	 * @param string $modal_id The ID of the modal.
	 * @param array  $args      Optional. Additional arguments for the modal.
	 *
	 * @return void
	 */
	public static function render( $modal_id, $args = [] ): void {
		static $modal_ids = [];

		if ( isset( $modal_ids[ $modal_id ] ) ) {
			unset( $modal_ids[ $modal_id ] );
			echo '</div></div></div><!-- end of modal -->';
			return;
		}

		$modal_ids[ $modal_id ] = true;

		$args = wp_parse_args(
			$args,
			[
				'size'              => 'md',
				'button_label'      => '',
				'button_classnames' => '',
				'close_classnames'  => '',
			]
		);

		?>
		<div class="<?php echo HTML::classnames( 'awesome9-modal', 'awesome9-modal--' . $args['size'] ); // phpcs:ignore ?>">
			<?php Toolkit::state_button( $modal_id, $args['button_label'], $args['button_classnames'] ); ?>
			<?php Toolkit::state_controller( 'modal', $modal_id ); ?>
			<div class="awesome9-modal__overlay">
				<label for="<?php echo esc_attr( $modal_id ); ?>" class="awesome9-modal__overlay__close"></label>
				<div class="awesome9-modal__content">
					<?php Toolkit::state_close_button( $modal_id, HTML::classnames( 'awesome9-modal__close', $args['close_classnames'] ) ); ?>
		<?php
	}
}
