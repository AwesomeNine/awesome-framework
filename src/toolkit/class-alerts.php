<?php
/**
 * Alert class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Toolkit;

use Awesome9\Framework\Toolkit;
use Awesome9\Framework\Utilities\Str;
use Awesome9\Framework\Utilities\HTML;

defined( 'ABSPATH' ) || exit;

/**
 * Alerts class
 */
class Alerts {

	/**
	 * Displays an alert message.
	 *
	 * @param string $content    The content of the alert.
	 * @param string $title      Optional. The title of the alert.
	 * @param string $type       Optional. The type of the alert (e.g., 'default', 'info', 'success', 'warning', 'error').
	 * @param string $icon       Optional. The icon of the alert.
	 * @param string $classnames Optional. Additional classes for the alert.
	 *
	 * @return void
	 */
	public static function render( $content, $title = '', $type = 'default', $icon = '', $classnames = '' ): void {
		if ( ! Toolkit::is_accent_allowed( $type ) ) {
			$type = 'default';
		}

		if ( Str::is_non_empty( $icon ) && 'default' === $icon ) {
			$icon = 'default' === $type ? 'info' : $type;
			$icon = Toolkit::get_svg( "{$icon}.svg", 'resources/img/icons/' );
		}

		$classnames = HTML::classnames( 'awesome9-alert', 'awesome9-alert--' . $type, $classnames );
		?>
		<div class="<?php echo esc_attr( $classnames ); ?>">
			<?php if ( '' !== $icon ) : ?>
			<div class="awesome9-alert__icon">
				<?php echo $icon; // phpcs:ignore ?>
			</div>
			<?php endif; ?>

			<div class="awesome9-alert__content">
				<?php if ( '' !== $title ) : ?>
				<header><?php echo esc_html( ucfirst( $title ) ); ?></header>
				<?php endif; ?>
				<p><?php echo $content; // phpcs:ignore ?></p>
			</div>
		</div>
		<?php
	}
}
