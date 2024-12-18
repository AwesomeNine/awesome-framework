<?php
/**
 * Class that manages plugin option pages.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Options;

use Awesome9\Framework\Utilities\HTML;
use Awesome9\Framework\Utilities\Params;

defined( 'ABSPATH' ) || exit;

/**
 * Manages option pages and their tabs.
 */
class Options_Page {

	/**
	 * Tabs for the option page.
	 *
	 * @var array
	 */
	private array $tabs = [];

	/**
	 * Add a tab to the options page.
	 *
	 * @param string $slug Unique slug for the tab.
	 * @param array  $args Arguments for the tab (title, icon, template, etc.).
	 *
	 * @return void
	 */
	public function add_tab( string $slug, array $args ): void {
		$this->tabs[ $slug ] = $args;
	}

	/**
	 * Retrieve all tabs.
	 *
	 * @return array List of tabs.
	 */
	public function get_tabs(): array {
		return $this->tabs;
	}

	/**
	 * Render the entire options page.
	 *
	 * @return void
	 */
	public function render(): void {
		require_once $this->get_view( 'form' );
	}

	/**
	 * Render the tabs navigation menu.
	 *
	 * @return void
	 */
	public function render_tabs(): void {
		$tabs       = $this->get_tabs();
		$active_tab = $this->get_active_tab();
		?>
		<div class="awesome9-tab-nav space-y-2">
			<?php
			foreach ( $tabs as $slug => $tab ) :
				$is_current = $active_tab === $slug;
				$tab_class  = HTML::classnames(
					'flex items-center text-base no-underline py-2 px-5 rounded-md text-gray-700',
					[ 'is-active bg-white text-blue-700' => $is_current ]
				);
				$icon_class = HTML::classnames(
					'text-icons mt-0.5',
					$tab['icon'],
					[ 'text-blue-700' => $is_current ]
				);
				?>
				<div class="awesome9-tab-nav-item">
					<a href="#<?php echo esc_attr( $slug ); ?>" class="<?php echo esc_attr( $tab_class ); ?>" data-tab="<?php echo esc_attr( $slug ); ?>">
						<span class="<?php echo esc_attr( $icon_class ); ?>" area-hidden="true"></span>
						<span class="ml-3 d-none d-lg-block flex-1">
							<?php echo esc_html( $tab['title'] ); ?>
						</span>
					</a>
				</div>
				<?php
			endforeach;
			?>
		</div>
		<?php
	}

	/**
	 * Render the content for all tabs.
	 *
	 * @return void
	 */
	public function render_tab_content(): void {
		$tabs       = $this->get_tabs();
		$active_tab = $this->get_active_tab();

		foreach ( $tabs as $slug => $tab ) {
			$active_class = $active_tab === $slug ? ' is-active' : '';
			?>
			<div id="<?php echo esc_attr( $slug ); ?>" class="awesome9-tab-content<?php echo esc_attr( $active_class ); ?>">
			<?php require $this->get_view( 'blocks/' . $tab['template'] ); ?>
			</div>
			<?php
		}
	}

	/**
	 * Get the file path for a view template.
	 *
	 * @param string $template Name of the template file.
	 *
	 * @return string Path to the view file or null if it doesn't exist.
	 */
	private function get_view( string $template ): string {
		return __DIR__ . '/views/' . $template . '.php';
	}

	/**
	 * Retrieve the currently active tab.
	 *
	 * @return string The slug of the active tab.
	 */
	private function get_active_tab(): string {
		$tabs = array_keys( $this->get_tabs() );
		return Params::get( 'tab_page', current( $tabs ) );
	}
}
