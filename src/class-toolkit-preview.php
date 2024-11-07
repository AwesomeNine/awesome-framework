<?php
/**
 * Toolkit preview class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework;

use Awesome9\Framework\Utilities\Params;
use Awesome9\Framework\Interfaces\Integration_Interface;

defined( 'ABSPATH' ) || exit;

/**
 * Toolkit class
 */
class Toolkit_Preview implements Integration_Interface {

	/**
	 * Tabs.
	 *
	 * @var array
	 */
	public $tabs = [];

	/**
	 * Path.
	 *
	 * @var string
	 */
	public $path = '';

	/**
	 * Hook into WordPress.
	 *
	 * @return void
	 */
	public function hooks(): void {
		add_action( 'admin_menu', [ $this, 'add_page' ] );
		$this->path = dirname( __DIR__ ) . '/views/ui-toolkit';
		$this->tabs = [
			'typography'    => [
				'label'    => __( 'Typography', 'awesome9' ),
				'filename' => '/typography.php',
			],
			'color-palette' => [
				'label'    => __( 'Colors', 'awesome9' ),
				'filename' => '/color-palette.php',
			],
			'buttons'       => [
				'label'    => __( 'Buttons', 'awesome9' ),
				'filename' => '/buttons.php',
			],
			'forms'         => [
				'label'    => __( 'Forms', 'awesome9' ),
				'filename' => '/forms.php',
			],
			'icons'         => [
				'label'    => __( 'Icons', 'awesome9' ),
				'filename' => '/icons.php',
			],
			'cards'         => [
				'label'    => __( 'Cards', 'awesome9' ),
				'filename' => '/cards.php',
			],
			'alerts'        => [
				'label'    => __( 'Alerts', 'awesome9' ),
				'filename' => '/alerts.php',
			],
			'modal'         => [
				'label'    => __( 'Modal', 'awesome9' ),
				'filename' => '/modal.php',
			],
			'drawer'        => [
				'label'    => __( 'Drawer', 'awesome9' ),
				'filename' => '/drawer.php',
			],
			'tabs'          => [
				'label'    => __( 'Tabs', 'awesome9' ),
				'filename' => '/tabs.php',
			],
			'accordions'    => [
				'label'    => __( 'Accordions', 'awesome9' ),
				'filename' => '/accordions.php',
			],
			'tooltips'      => [
				'label'    => __( 'Tooltips', 'awesome9' ),
				'filename' => '/tooltips.php',
			],
		];
	}

	/**
	 * Add page.
	 *
	 * @return void
	 */
	public function add_page(): void {
		add_menu_page(
			__( 'Toolkit Preview', 'awesome9' ),
			__( 'Toolkit Preview', 'awesome9' ),
			'manage_options',
			'toolkit-preview',
			[ $this, 'render_page' ],
			'dashicons-admin-tools',
			99
		);
	}

	/**
	 * Render page.
	 *
	 * @return void
	 */
	public function render_page(): void {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Toolkit Preview', 'awesome9' ); ?></h1>
			<?php
				$this->get_tabs_menu();
				$this->get_tab_content();
			?>
		</div>
		<?php
	}

	/**
	 * Get current tab id.
	 *
	 * @return string
	 */
	public function get_current_tab_id(): string {
		$first = current( array_keys( $this->tabs ) );

		return Params::get( 'sub_page', $first );
	}

	/**
	 * Render tabs menu
	 *
	 * @param array $args Arguments to be used in the template.
	 *
	 * @return void
	 */
	public function get_tabs_menu( $args = [] ): void {
		$tabs   = $this->tabs;
		$active = $this->get_current_tab_id();

		Toolkit::tabs( $tabs, $active );
	}

	/**
	 * Render tabs content
	 *
	 * @param array $args Arguments to be used in the template.
	 *
	 * @return void
	 */
	public function get_tab_content( $args = [] ): void {
		$active = $this->get_current_tab_id();

		echo '<div class="awesome9-tab-content">';
		include $this->path . $this->tabs[ $active ]['filename'];
		echo '</div>';
	}
}
