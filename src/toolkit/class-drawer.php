<?php
/**
 * Drawer class.
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
 * Drawer class
 */
class Drawer {

	/**
	 * Display a Drawer.
	 *
	 * @param string $drawer_id The ID of the drawer.
	 * @param array  $args      Optional. Additional arguments for the drawer.
	 *
	 * @return void
	 */
	public static function render( $drawer_id, $args = [] ): void {
		static $drawer_ids = [];

		if ( isset( $drawer_ids[ $drawer_id ] ) ) {
			unset( $drawer_ids[ $drawer_id ] );
			echo '</div></div><!-- end of drawer -->';
			return;
		}

		$drawer_ids[ $drawer_id ] = true;

		$args  = wp_parse_args(
			$args,
			[
				'button_label'        => '',
				'button_classnames'   => '',
				'use_backdrop'        => false,
				'content_classnames'  => '',
				'backdrop_classnames' => HTML::classnames( 'awesome9-state__backdrop', 'awesome9-drawer__backdrop' ),
			]
		);
		$attrs = [
			'tabindex'        => '-1',
			'aria-labelledby' => $drawer_id . '--label',
			'aria-hidden'     => 'true',
			'class'           => HTML::classnames( 'awesome9-state__content', 'awesome9-drawer__content', $args['content_classnames'] ),
		];
		?>
		<div class="awesome9-drawer">
			<?php Toolkit::state_button( $drawer_id, $args['button_label'], $args['button_classnames'] ); ?>
			<?php Toolkit::state_controller( 'drawer', $drawer_id ); ?>
			<?php if ( $args['use_backdrop'] ) : ?>
			<label class="<?php echo $args['backdrop_classnames']; // phpcs:ignore ?>" for="<?php echo esc_attr( $drawer_id ); ?>"></label>
			<?php endif; ?>
			<div <?php echo HTML::build_attributes( $attrs ); // phpcs:ignore ?>>
		<?php
	}

	/**
	 * Drawer close button.
	 *
	 * @param string $drawer_id  The ID of the drawer.
	 * @param string $classnames Optional. Additional classnames for the drawer close button.
	 *
	 * @return void
	 */
	public static function render_close_button( $drawer_id, $classnames = '' ): void {
		Toolkit::state_close_button( $drawer_id, HTML::classnames( 'awesome9-drawer__close', $classnames ) );
	}
}
