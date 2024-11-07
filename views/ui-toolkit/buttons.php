<?php
/**
 * Ui Toolkit - Buttons
 *
 * @since   1.0.0
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 */

use Awesome9\Framework\Toolkit;

ob_start();
echo '<div class="demo-buttons">';
Toolkit::button( 'Primary Small', 'primary', 'small' );
Toolkit::button( 'Primary Medium', 'primary' );
Toolkit::button( 'Primary Large', 'primary', 'large' );
echo '</div>';
$buttons = ob_get_clean();

$buttons_code = "<?php
Toolkit::button( 'Primary Small', 'primary', 'small' );
Toolkit::button( 'Primary Medium', 'primary' );
Toolkit::button( 'Primary Large', 'primary', 'large' );";

ob_start();
echo '<div class="demo-buttons">';
Toolkit::button( 'Secondary Small', 'secondary', 'small' );
Toolkit::button( 'Secondary Medium', 'secondary' );
Toolkit::button( 'Secondary Large', 'secondary', 'large' );
echo '</div>';
$secondary_buttons = ob_get_clean();

$secondary_buttons_code = "<?php
Toolkit::button( 'Secondary Small', 'secondary', 'small' );
Toolkit::button( 'Secondary Medium', 'secondary' );
Toolkit::button( 'Secondary Large', 'secondary', 'large' );";

ob_start();
echo '<div class="demo-buttons">';
Toolkit::button( 'Success', 'success' );
Toolkit::button( 'Info', 'info' );
Toolkit::button( 'Warning', 'warning' );
Toolkit::button( 'Error', 'error' );
echo '</div>';
$button_accent = ob_get_clean();

$button_accent_code = "<?php
Toolkit::button( 'Success', 'success' );
Toolkit::button( 'Info', 'info' );
Toolkit::button( 'Warning', 'warning' );
Toolkit::button( 'Error', 'error' );";

ob_start();
echo '<div class="demo-buttons">';
Toolkit::button( 'Success', 'success', '', [ 'disabled' => 'disabled' ] );
Toolkit::button( 'Info', 'info', '', [ 'disabled' => 'disabled' ] );
Toolkit::button( 'Warning', 'warning', '', [ 'disabled' => 'disabled' ] );
Toolkit::button( 'Error', 'error', '', [ 'disabled' => 'disabled' ] );
echo '</div>';
$button_state = ob_get_clean();

$button_state_code = "<?php
Toolkit::button( 'Success', 'success', '', [ 'disabled' => 'disabled' ] );
Toolkit::button( 'Info', 'info', '', [ 'disabled' => 'disabled' ] );
Toolkit::button( 'Warning', 'warning', '', [ 'disabled' => 'disabled' ] );
Toolkit::button( 'Error', 'error', '', [ 'disabled' => 'disabled' ] );";
?>
<div class="awesome9-ui">
	<?php
	Toolkit::html_card(
		'Primary Button',
		$buttons,
		$buttons_code
	);

	Toolkit::html_card(
		'Secondary Button',
		$secondary_buttons,
		$secondary_buttons_code
	);

	Toolkit::html_card(
		'Button Accent',
		$button_accent,
		$button_accent_code
	);

	Toolkit::html_card(
		'Button State',
		$button_state,
		$button_state_code
	);
	?>

</div>
