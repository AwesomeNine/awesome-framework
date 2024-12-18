<?php
/**
 * Setting class for managing WordPress admin settings screens.
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
	 * Tabs registered for the settings screen.
	 *
	 * @var Tab[]
	 */
	protected array $tabs = [];

	/**
	 * Get the option name for the settings.
	 *
	 * @return string The option name.
	 */
	abstract public function get_option_name(): string;

	/**
	 * Register options for the settings.
	 *
	 * @return void
	 */
	abstract public function register_options(): void;

	/**
	 * Define the configuration settings.
	 *
	 * Override this method to provide specific settings configuration.
	 *
	 * @return array Configuration settings.
	 */
	public function define_configuration(): array {
		return [];
	}

	/**
	 * Register the screen in the WordPress admin area.
	 *
	 * @return void
	 */
	public function register_screen(): void {
		add_action( 'admin_init', [ $this, 'register' ] );
		add_action( 'admin_footer', [ $this, 'enqueue_javscript' ], 999 );
	}

	/**
	 * Register the settings, tabs, and options.
	 *
	 * @return void
	 */
	public function register(): void {
		$this->register_setting();
		$this->register_options();
	}

	/**
	 * Register the settings with the specified configuration.
	 *
	 * @return void
	 */
	public function register_setting() {
		$args = $this->define_configuration();

		// Ensure arguments are always an array.
		if ( ! is_array( $args ) ) {
			$args = [];
		}

		// Add a default sanitize callback if none exists.
		$args['sanitize_callback'] = $args['sanitize_callback'] ?? [ $this, 'sanitize' ];

		register_setting( $this->get_option_name(), $this->get_option_name(), $args );
	}

	/**
	 * Enqueue JavaScript for tab switching functionality.
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

					$('.settings-tab-pages > div').hide();
					$(target).show();

					return false;
				});
				tablist.eq(0).trigger('click');
			});
		</script>
		<?php
	}

	/**
	 * Add a tab to the settings screen.
	 *
	 * @param array $args The tab arguments.
	 *
	 * @return Tab The created tab instance.
	 */
	public function add_tab( $args ): Tab {
		$args['page'] = $this->get_option_name();
		$tab          = new Tab( $args );
		$this->tabs[] = $tab;

		return $tab;
	}

	/**
	 * Display the settings screen content.
	 *
	 * @return void
	 */
	public function display(): void {
		require_once dirname( __DIR__, 2 ) . '/views/settings/page.php';
	}
}
