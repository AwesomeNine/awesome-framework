<?php
/**
 * Tabs class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Toolkit;

use Awesome9\Framework\Utilities\HTML;

defined( 'ABSPATH' ) || exit;

/**
 * Tabs class
 */
class Tabs {

	/**
	 * Displays a set of tabs.
	 *
	 * @param array  $tabs      An array of tabs to display.
	 * @param string $active    The ID of the active tab.
	 * @param string $classnames Optional. Additional classnames for the tabs container.
	 *
	 * @return void
	 */
	public static function render( $tabs, $active, $classnames = '' ): void {
		?>
		<div class="<?php echo HTML::classnames( 'awesome9-header-tabs', $classnames ); // phpcs:ignore ?>">
			<?php foreach ( $tabs as $tab_id => $tab_data ) : ?>
			<a href="<?php echo esc_url( add_query_arg( 'sub_page', $tab_id ) ); ?>"<?php echo $active === $tab_id ? 'class="is-active"' : ''; ?>>
				<?php echo esc_html( $tab_data['label'] ); ?>
			</a>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
