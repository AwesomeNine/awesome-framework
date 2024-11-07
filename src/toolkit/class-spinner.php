<?php
/**
 * Spinner class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Toolkit;

use Awesome9\Framework\Utilities\HTML;
use Awesome9\Framework\Utilities\Str;

defined( 'ABSPATH' ) || exit;

/**
 * Spinner class
 */
class Spinner {

	/**
	 * Displays a spinner.
	 *
	 * @param string $classnames Optional. Additional CSS class names for the spinner.
	 * @param bool   $inline     Optional. Whether to display the spinner inline.
	 *
	 * @return void
	 */
	public static function render( $classnames = '', $inline = false ): void {
		$classnames = HTML::classnames(
			'stroke-current animate-spin',
			Str::contains( 'w-', $classnames ) && Str::contains( 'h-', $classnames ) ? '' : 'w-6 h-6',
			$classnames
		);
		?>
		<div role="status" aria-label="loading"<?php echo $inline ? ' class="inline-block"' : ''; ?>>
			<svg class="<?php echo $classnames; // phpcs:ignore ?>" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<g clip-path="url(#clip0_9023_61563)">
					<path d="M14.6437 2.05426C11.9803 1.2966 9.01686 1.64245 6.50315 3.25548C1.85499 6.23817 0.504864 12.4242 3.48756 17.0724C6.47025 21.7205 12.6563 23.0706 17.3044 20.088C20.4971 18.0393 22.1338 14.4793 21.8792 10.9444" stroke="stroke-current" stroke-width="1.4" stroke-linecap="round" class="my-path"></path>
				</g>
				<defs>
					<clipPath id="clip0_9023_61563">
						<rect width="24" height="24" fill="white"></rect>
					</clipPath>
				</defs>
			</svg>
			<span class="sr-only">Loading...</span>
		</div>
		<?php
	}
}
