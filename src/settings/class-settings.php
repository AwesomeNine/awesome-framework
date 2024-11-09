<?php
/**
 * Setting class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Settings;

use Awesome9\Framework\Screens\Screen;

/**
 * Setting class.
 */
abstract class Settings extends Screen {

	/**
	 * Tabs.
	 *
	 * @var array
	 */
	protected $tabs = [];

	/**
	 * Get option name.
	 *
	 * @return string
	 */
	abstract public function get_option_name(): string;

	/**
	 * Register the options
	 *
	 * @return void
	 */
	abstract public function register_options(): void;

	/**
	 * Defines the configuration settings.
	 *
	 * @return array An array representing the configuration settings.
	 */
	public function define_configuration(): array {
		return [];
	}

	/**
	 * Register screen into WordPress admin area.
	 *
	 * @return void
	 */
	public function register_screen(): void {
		add_action( 'admin_init', [ $this, 'register' ] );
		add_action( 'admin_footer', [ $this, 'enqueue_javscript' ], 999 );
	}

	/**
	 * Register the tabs, sections and settings.
	 *
	 * @return void
	 */
	public function register(): void {
		$this->register_setting();
		$this->register_options();

		foreach ( $this->tabs as $tab ) {
			$tab->register();
		}
	}

	/**
	 * Registers the settings with the specified configuration.
	 *
	 * @return void
	 */
	public function register_setting() {
		$args = $this->define_configuration();

		if ( ! is_array( $args ) ) {
			$args = [];
		}

		$args['sanitize_callback'] = [ $this, 'sanitize' ];
		register_setting( $this->get_option_name(), $this->get_option_name(), $args );
	}

	/**
	 * Enqueue JavaScript
	 *
	 * @return void
	 */
	public function enqueue_javscript(): void {
		?>
		<script>
			jQuery(document).ready(function($) {
				const tablist = $('a', '.settings-tablist');
				tablist.on( 'click', function() {
					const button = $(this);
					const target = button.attr('href');

					tablist.removeClass('active');
					button.addClass('active');

					$('.settings-tab-contents > div').hide();
					$(target).show();

					return false;
				});
				tablist.eq(0).trigger('click');
			});
		</script>
		<?php
	}

	/**
	 * Add tab.
	 *
	 * @param array $args The tab arguments.
	 *
	 * @return Tab
	 */
	public function add_tab( $args ): Tab {
		$args['page'] = $this->get_option_name();
		$tabs         = new Tab( $args );
		$this->tabs[] = $tabs;

		return $tabs;
	}

	/**
	 * Display screen content.
	 *
	 * @return void
	 */
	public function display(): void {
		require_once dirname( __DIR__, 2 ) . '/views/settings/page.php';
	}
}
