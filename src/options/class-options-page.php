<?php
/**
 * Class that manages plugin option pages.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Options;

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

	public function render_tabs() {
		$tabs = $this->get_tabs();
		?>
		<div class="nav-tab-wrapper">
			<?php
			foreach ( $tabs as $slug => $tab ) {
				?>
				<a href="#<?php echo esc_attr( $slug ); ?>" class="nav-tab"><?php echo esc_html( $tab['title'] ); ?></a>
				<?php
			}
			?>
		</div>
		<?php
	}

	public function render_tab_content() {
		$tabs = $this->get_tabs();
		?>
		<div class="tab-content">
			<?php
			foreach ( $tabs as $slug => $tab ) {
				require $this->get_view( $tab['template'] );
				?>

				<?php
			}
			?>
		</div>
		<?php
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
}
