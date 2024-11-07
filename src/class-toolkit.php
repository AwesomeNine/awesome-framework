<?php
/**
 * Toolkit class.
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework;

use Awesome9\Framework\Utilities\Str;
use Awesome9\Framework\Utilities\HTML;
use Awesome9\Framework\Toolkit as Components;

defined( 'ABSPATH' ) || exit;

/**
 * Toolkit class
 */
class Toolkit {

	/**
	 * Allowed accents.
	 *
	 * @var array
	 */
	const ACCENTS = [
		'default',
		'primary',
		'secondary',
		'info',
		'success',
		'warning',
		'error',
	];

	/**
	 * Allowed positions.
	 *
	 * @var array
	 */
	const POSITIONS = [ 'top', 'right', 'bottom', 'left' ];

	/**
	 * Displays an alert message.
	 *
	 * @param string $content    The content of the alert.
	 * @param string $title      Optional. The title of the alert.
	 * @param string $type       Optional. The type of the alert (e.g., 'default', 'info', 'success', 'warning', 'error').
	 * @param string $icon       Optional. The icon of the alert.
	 * @param string $classnames Optional. Additional classes for the alert.
	 *
	 * @return void
	 */
	public static function alerts( $content, $title = '', $type = 'default', $icon = '', $classnames = '' ): void {
		Components\Alerts::render( $content, $title, $type, $icon, $classnames );
	}

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
	public static function button( $text, $type = 'primary', $size = 'medium', $attrs = [] ): void {
		Components\Button::render( $text, $type, $size, $attrs );
	}

	/**
	 * Display a Drawer.
	 *
	 * @param string $drawer_id The ID of the drawer.
	 * @param array  $args      Optional. Additional arguments for the drawer.
	 *
	 * @return void
	 */
	public static function drawer( $drawer_id, $args = [] ): void {
		Components\Drawer::render( $drawer_id, $args );
	}

	/**
	 * Drawer close button.
	 *
	 * @param string $drawer_id  The ID of the drawer.
	 * @param string $classnames Optional. Additional classnames for the drawer close button.
	 *
	 * @return void
	 */
	public static function drawer_close_button( $drawer_id, $classnames = '' ): void {
		Components\Drawer::render_close_button( $drawer_id, $classnames );
	}

	/**
	 * Displays a checkbox input.
	 *
	 * @param string $id    The ID of the input.
	 * @param string $label The title of the input.
	 * @param array  $args  Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function input_checkbox( $id, $label, $args ): void {
		Components\Checkbox::render( $id, $label, $args );
	}

	/**
	 * Displays a date input.
	 *
	 * @param string $id    The ID of the input.
	 * @param string $label The title of the input.
	 * @param array  $args  Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function input_date( $id, $label, $args ): void {
		$args['type'] = 'date';
		static::input_text( $id, $label, $args );
	}

	/**
	 * Displays a email input.
	 *
	 * @param string $id    The ID of the input.
	 * @param string $label The title of the input.
	 * @param array  $args  Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function input_email( $id, $label, $args ): void {
		$args['type'] = 'email';
		static::input_text( $id, $label, $args );
	}

	/**
	 * Displays a file input.
	 *
	 * @param string $id    The ID of the input.
	 * @param string $label The title of the input.
	 * @param array  $args  Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function input_file( $id, $label, $args ): void {
		Components\File::render( $id, $label, $args );
	}

	/**
	 * Displays a number input.
	 *
	 * @param string $id    The ID of the input.
	 * @param string $label The title of the input.
	 * @param array  $args  Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function input_number( $id, $label, $args ): void {
		$args['type'] = 'number';
		static::input_text( $id, $label, $args );
	}

	/**
	 * Displays a password input.
	 *
	 * @param string $id    The ID of the input.
	 * @param string $label The title of the input.
	 * @param array  $args  Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function input_password( $id, $label, $args ): void {
		$args['type'] = 'password';
		static::input_text( $id, $label, $args );
	}

	/**
	 * Displays a radio input.
	 *
	 * @param string $id    The ID of the input.
	 * @param string $label The title of the input.
	 * @param array  $args  Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function input_radio( $id, $label, $args ): void {
		Components\Radio::render( $id, $label, $args );
	}

	/**
	 * Displays a text input.
	 *
	 * @param string $id    The ID of the input.
	 * @param string $label The title of the input.
	 * @param array  $args  Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function input_text( $id, $label, $args ): void {
		Components\Text::render( $id, $label, $args );
	}

	/**
	 * Displays a textarea input.
	 *
	 * @param string $id    The ID of the input.
	 * @param string $label The title of the input.
	 * @param array  $args  Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function input_textarea( $id, $label, $args ): void {
		Components\Textarea::render( $id, $label, $args );
	}

	/**
	 * Displays a switch input.
	 *
	 * @param string $id    The ID of the input.
	 * @param string $label The title of the input.
	 * @param array  $args  Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function input_switch( $id, $label, $args ): void {
		Components\Switch_Button::render( $id, $label, $args );
	}

	/**
	 * Displays a select input.
	 *
	 * @param string $id    The ID of the input.
	 * @param string $label The title of the input.
	 * @param array  $args  Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function input_select( $id, $label, $args ): void {
		Components\Select::render( $id, $label, $args );
	}

	/**
	 * Display a Modal.
	 *
	 * @param string $modal_id The ID of the modal.
	 * @param array  $args      Optional. Additional arguments for the modal.
	 *
	 * @return void
	 */
	public static function modal( $modal_id, $args = [] ): void {
		Components\Modal::render( $modal_id, $args );
	}

	/**
	 * Displays a spinner.
	 *
	 * @param string $classnames Optional. Additional CSS class names for the spinner.
	 * @param bool   $inline     Optional. Whether to display the spinner inline.
	 *
	 * @return void
	 */
	public static function spinner( $classnames = '', $inline = false ): void {
		Components\Spinner::render( $classnames, $inline );
	}

	/**
	 * Displays a set of tabs.
	 *
	 * @param array  $tabs      An array of tabs to display.
	 * @param string $active    The ID of the active tab.
	 * @param string $classnames Optional. Additional classnames for the tabs container.
	 *
	 * @return void
	 */
	public static function tabs( $tabs, $active, $classnames = '' ): void {
		Components\Tabs::render( $tabs, $active, $classnames );
	}

	/**
	 * Displays a tooltip.
	 *
	 * @param string $text    The text to display.
	 * @param string $tooltip The tooltip content.
	 * @param array  $args    Optional. Additional arguments for the tooltip.
	 *
	 * @return void
	 */
	public static function tooltip( $text, $tooltip, $args = [] ): void {
		Components\Tooltip::render( $text, $tooltip, $args );
	}

	/* Helpers --------*/

	/**
	 * Displays a card.
	 *
	 * @param string $title   The title of the card.
	 * @param string $content The content of the card.
	 * @param string $code    Optional. The code to display.
	 * @param string $language Optional. The language of the code.
	 *
	 * @return void
	 */
	public static function html_card( $title, $content, $code = '', $language = 'html' ): void {
		if ( Str::is_empty( $code ) ) {
			$code = $content;
		}

		?>
		<div class="awesome9-card with-sections">
			<header>
				<h4><?php echo $title; // phpcs:ignore ?></h4>
			</header>
			<div class="awesome9-card__content">
				<div class="awesome9-card__section">
					<?php echo $content; // phpcs:ignore ?>
				</div>
				<div class="awesome9-card__section !py-3 bg-gray-100">
					<h6><?php echo strtoupper( $language ); // phpcs:ignore ?></h6>
				</div>
				<div class="awesome9-card__section bg-gray-50">
					<pre><code class="language-<?php echo esc_attr( $language ); ?>"><?php echo esc_html( $code ); ?></code></pre>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Checks if an accent is allowed.
	 *
	 * @param string $accent The accent to check.
	 *
	 * @return bool
	 */
	public static function is_accent_allowed( $accent ): bool {
		return in_array( $accent, static::ACCENTS, true );
	}

	/**
	 * Checks if a position is allowed.
	 *
	 * @param string $position The position to check.
	 *
	 * @return bool
	 */
	public static function is_position_allowed( $position ): bool {
		return in_array( $position, static::POSITIONS, true );
	}

	/**
	 * Get SVG content as string
	 *
	 * @param string $file   File name.
	 * @param string $folder Folder name if not default.
	 *
	 * @return string
	 */
	public static function get_svg( $file, $folder = 'vendor/awesome9/framework/resources/img/' ): string {
		$file_url = AWESOME9_FRAMEWORK_BASE_URL . $folder . $file;

		return file_get_contents( $file_url ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	}

	/**
	 * Display an input wrap.
	 *
	 * @param string $input_id The ID of the input.
	 * @param string $label    Optional. The label of the input.
	 * @param array  $args     Optional. Additional arguments for the input.
	 *
	 * @return void
	 */
	public static function input_wrap( $input_id, $label = '', $args = [] ): void {
		static $input_ids = [];

		if ( isset( $input_ids[ $input_id ] ) ) {
			unset( $input_ids[ $input_id ] );
			?>
				<?php if ( $args['description'] ) : ?>
					<p class="awesome9-form__help"><?php echo $args['description']; // phpcs:ignore ?></p>
					<?php endif; ?>
				</div>
			</div>
			<?php
			return;
		}

		$input_ids[ $input_id ] = true;

		$wrap_classnames = HTML::classnames( 'awesome9-form__row', $args['wrapper_class'] );
		?>
		<div class="<?php echo $wrap_classnames; // phpcs:ignore ?>">
			<div class="awesome9-form__label">
				<label for="<?php echo esc_attr( $args['id'] ); ?>"><?php echo esc_html( $label ); ?></label>
			</div>
			<div class="awesome9-form__input-wrap">
		<?php
	}

	/* CSS State using checkbox and radio buttons --------*/

	/**
	 * Displays state button.
	 *
	 * @param string $elem_id    The ID of the element.
	 * @param string $label      The label of the button.
	 * @param string $classnames Optional. Additional classnames for the button.
	 *
	 * @return void
	 */
	public static function state_button( $elem_id, $label, $classnames = '' ): void {
		$attrs = [
			'for'           => $elem_id,
			'aria-haspopup' => 'true',
			'role'          => 'button',
			'aria-controls' => 'menu',
			'class'         => $classnames,
			'id'            => $elem_id . '__opener',
		];
		?>
		<label <?php echo HTML::build_attributes( $attrs ); // phpcs:ignore ?>"><?php echo esc_html( $label ); ?></label>
		<?php
	}

	/**
	 * State controller.
	 *
	 * @param string $type   The type of the element i.e. drawer, modal.
	 * @param string $elem_id The ID of the element.
	 *
	 * @return void
	 */
	public static function state_controller( $type, $elem_id ): void {
		$input_attrs = [
			'id'    => $elem_id,
			'class' => HTML::classnames( 'awesome9-state__controller', "awesome9-{$type}__controller" ),
			'type'  => 'checkbox',
			'data-menu',
			'hidden',
		];
		printf( '<input %s>', HTML::build_attributes( $input_attrs ) ); // phpcs:ignore
	}

	/**
	 * State close button.
	 *
	 * @param string $elem_id    The ID of the element.
	 * @param string $classnames Optional. Additional classnames for the close button.
	 *
	 * @return void
	 */
	public static function state_close_button( $elem_id, $classnames = '' ): void {
		$attrs = [
			'for'   => $elem_id,
			'role'  => 'button',
			'class' => HTML::classnames( 'awesome9-state__close', $classnames ),
		];
		?>
		<label <?php echo HTML::build_attributes( $attrs ); // phpcs:ignore ?>>
			<?php echo static::get_svg( 'icons/state-close.svg' ); // phpcs:ignore ?>
			<span class="sr-only"><?php esc_html_e( 'Close menu' ); // phpcs:ignore ?></span>
		</label>
		<?php
	}
}
