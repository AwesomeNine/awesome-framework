<?php
/**
 * Button class.
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
 * Button class
 */
class Button {

	/**
	 * Displays a button.
	 *
	 * @param string $text  The text of the button.
	 * @param string $type  The type of the button (e.g., 'primary', 'secondary').
	 * @param string $size  Optional. The size of the button (e.g., 'small', 'medium', 'large').
	 * @param array  $attrs Optional. Additional attributes for the button.
	 *
	 * @return void
	 */
	public static function render( $text, $type = 'primary', $size = 'medium', $attrs = [] ): void {
		$attrs          = wp_parse_args( $attrs, [ 'class' => [] ] );
		$type           = Toolkit::is_accent_allowed( $type ) ? $type : 'primary';
		$attrs['class'] = HTML::classnames( $attrs['class'], 'awesome9-button', 'awesome9-button--' . $type, 'awesome9-button--' . $size );
		?>
		<button <?php echo HTML::build_attributes( $attrs ); // phpcs:ignore ?>>
			<?php echo esc_html( $text ); ?>
		</button>
		<?php
	}
}
