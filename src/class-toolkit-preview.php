<?php
/**
 * Toolkit preview class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework;

use Awesome9\Framework\Screens\Screen;

defined( 'ABSPATH' ) || exit;

/**
 * Toolkit preview class
 */
class Toolkit_Preview extends Screen {

	/**
	 * Path to view files.
	 *
	 * @var string
	 */
	public string $path = '';

	/**
	 * Get the unique identifier for the screen.
	 *
	 * @return string Unique screen ID.
	 */
	public function get_id(): string {
		return 'toolkit-preview';
	}

	/**
	 * Register the screen in the WordPress admin area.
	 *
	 * @return void
	 */
	public function register_screen(): void {
		$hook = add_menu_page(
			__( 'Toolkit Preview', 'awesome9' ),
			__( 'Toolkit Preview', 'awesome9' ),
			'manage_options',
			$this->get_id(),
			[ $this, 'display' ],
			'dashicons-admin-tools',
			99
		);
		$this->set_hook( $hook );
		$this->set_tabs( $this->initialize_tabs() );
	}

	/**
	 * Enqueue assets such as scripts or styles for the screen.
	 *
	 * @return void
	 */
	public function enqueue_assets(): void {
		wp_enqueue_style( 'ui-toolkit' );
	}

	/**
	 * Display the content of the screen.
	 *
	 * @return void
	 */
	public function display(): void {
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
	 * Initialize tabs.
	 *
	 * @return array
	 */
	private function initialize_tabs(): array {
		$path = dirname( __DIR__ ) . '/views/ui-toolkit';
		return [
			'typography'    => [
				'label'    => __( 'Typography', 'awesome9' ),
				'filename' => $path . '/typography.php',
			],
			'color-palette' => [
				'label'    => __( 'Colors', 'awesome9' ),
				'filename' => $path . '/color-palette.php',
			],
			'buttons'       => [
				'label'    => __( 'Buttons', 'awesome9' ),
				'filename' => $path . '/buttons.php',
			],
			'forms'         => [
				'label'    => __( 'Forms', 'awesome9' ),
				'filename' => $path . '/forms.php',
			],
			'icons'         => [
				'label'    => __( 'Icons', 'awesome9' ),
				'filename' => $path . '/icons.php',
			],
			'cards'         => [
				'label'    => __( 'Cards', 'awesome9' ),
				'filename' => $path . '/cards.php',
			],
			'alerts'        => [
				'label'    => __( 'Alerts', 'awesome9' ),
				'filename' => $path . '/alerts.php',
			],
			'modal'         => [
				'label'    => __( 'Modal', 'awesome9' ),
				'filename' => $path . '/modal.php',
			],
			'drawer'        => [
				'label'    => __( 'Drawer', 'awesome9' ),
				'filename' => $path . '/drawer.php',
			],
			'tabs'          => [
				'label'    => __( 'Tabs', 'awesome9' ),
				'filename' => $path . '/tabs.php',
			],
			'accordions'    => [
				'label'    => __( 'Accordions', 'awesome9' ),
				'filename' => $path . '/accordions.php',
			],
			'tooltips'      => [
				'label'    => __( 'Tooltips', 'awesome9' ),
				'filename' => $path . '/tooltips.php',
			],
		];
	}
}
