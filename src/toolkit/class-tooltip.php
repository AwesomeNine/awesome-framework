<?php
/**
 * Tooltip class.
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
 * Tooltip class
 */
class Tooltip {

	/**
	 * Displays a tooltip.
	 *
	 * @param string $text    The text to display.
	 * @param string $tooltip The tooltip content.
	 * @param array  $args    Optional. Additional arguments for the tooltip.
	 *
	 * @return void
	 */
	public static function render( $text, $tooltip, $args = [] ): void {
		$args = wp_parse_args(
			$args,
			[
				'position' => 'top',
			]
		);

		$position = Toolkit::is_position_allowed( $args['position'] ) ? $args['position'] : 'top';
		$wrapper  = HTML::classnames( 'awesome9-tooltip', 'awesome9-tooltip--' . $position );

		?>
		<div class="<?php echo $wrapper; // phpcs:ignore ?>">
			<span class="awesome9-tooltip__controller"><?php echo $text; // phpcs:ignore ?></span>
			<div class="awesome9-tooltip__content" role="tooltip">
				<span class="awesome9-tooltip__backdrop"></span>
				<?php echo $tooltip; // phpcs:ignore ?>
			</div>
		</div>
		<?php
	}
}
