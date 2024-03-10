<?php
/**
 * Class that manages plugin option pages.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Options;

use Awesome9\Framework\Utilities\Params;

defined( 'ABSPATH' ) || exit;

/**
 * Option_Page class
 */
class Option_Page {

	/**
	 * Option page tabs.
	 *
	 * @var array
	 */
	private $tabs = [];

	/**
	 * Add tab.
	 *
	 * @param string $slug Tab slug.
	 * @param array  $args Tab arguments.
	 *
	 * @return void
	 */
	public function add_tab( $slug, $args ) {
		$this->tabs[ $slug ] = $args;
	}

	/**
	 * Get tabs.
	 *
	 * @return array
	 */
	public function get_tabs() {
		return $this->tabs;
	}

	/**
	 * Render option page.
	 *
	 * @return void
	 */
	public function render(): void {
		require_once $this->get_view( 'form' );
	}

	/**
	 * Render tabs navigantion.
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
				$active_class = $active_tab === $slug ? 'is-active bg-white text-blue-700' : '';
				$icon_class = $active_tab === $slug ? ' text-blue-700' : '';
				?>
				<div class="awesome9-tab-nav-item">
					<a href="#<?php echo esc_attr( $slug ); ?>" class="flex items-center text-base no-underline py-2 px-5 rounded-md text-gray-700 <?php echo esc_attr( $active_class ); ?>" data-tab="<?php echo esc_attr( $slug ); ?>">
						<span class="text-icons mt-0.5 <?php echo esc_attr( $tab['icon'] . $icon_class  ); ?>" area-hidden="true"></span>
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
	 * Render tab content.
	 *
	 * @return void
	 */
	public function render_tab_content(): void {
		$tabs       = $this->get_tabs();
		$active_tab = $this->get_active_tab();

		foreach ( $tabs as $slug => $tab ) {
			$active_class = $active_tab == $slug ? ' is-active' : '';
			?>
			<div id="<?php echo esc_attr( $slug ); ?>" class="awesome9-tab-content<?php echo esc_attr( $active_class ); ?>">
			<?php require $this->get_view( 'blocks/' . $tab['template'] ); ?>
			</div>
			<?php
		}
	}

	/**
	 * Get view file path.
	 *
	 * @param string $template Template name.
	 *
	 * @return void
	 */
	private function get_view( $template ): string {
		return __DIR__ . '/views/' . $template . '.php';
	}

	/**
	 * Get active tab.
	 *
	 * @return string
	 */
	private function get_active_tab(): string {
		$tabs = array_keys( $this->get_tabs() );
		return Params::get( 'tab_page', current( $tabs ) );
	}
}
