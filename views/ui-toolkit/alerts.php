<?php
/**
 * Ui Toolkit - Alerts Components
 *
 * @since   1.0.0
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 */

use Awesome9\Framework\Toolkit;

ob_start();
Toolkit::alert( '<strong>Alert</strong> Your account was registered!' );
Toolkit::alert( '<strong>Success</strong> Your subscription payment is successful', '', 'success' );
Toolkit::alert( '<strong>Info</strong> Your subscription payment is in processing', '', 'info' );
Toolkit::alert( '<strong>Warning</strong> Your subscription payment is pending', '', 'warning' );
Toolkit::alert( '<strong>Danger</strong> Your subscription payment is failed', '', 'error' );
$alerts = ob_get_clean();

$alert_code = "<?php
Toolkit::alert( '<strong>Alert</strong> Your account was registered!' );
Toolkit::alert( '<strong>Success</strong> Your subscription payment is successful', '', 'success' );
Toolkit::alert( '<strong>Info</strong> Your subscription payment is in processing', '', 'info' );
Toolkit::alert( '<strong>Warning</strong> Your subscription payment is pending', '', 'warning' );
Toolkit::alert( '<strong>Danger</strong> Your subscription payment is failed', '', 'error' );
?>";

ob_start();
Toolkit::alert( '<strong>Alert</strong> Your account was registered!', '', '', '', 'with-border' );
Toolkit::alert( '<strong>Success</strong> Your subscription payment is successful', '', 'success', '', 'with-border' );
Toolkit::alert( '<strong>Info</strong> Your subscription payment is in processing', '', 'info', '', 'with-border' );
Toolkit::alert( '<strong>Warning</strong> Your subscription payment is pending', '', 'warning', '', 'with-border' );
Toolkit::alert( '<strong>Danger</strong> Your subscription payment is failed', '', 'error', '', 'with-border' );
$bordered_alerts = ob_get_clean();

$bordered_alerts_code = "<?phpToolkit::alert( '<strong>Alert</strong> Your account was registered!', '', '', '', 'with-border' );
Toolkit::alert( '<strong>Success</strong> Your subscription payment is successful', '', 'success', '', 'with-border' );
Toolkit::alert( '<strong>Info</strong> Your subscription payment is in processing', '', 'info', '', 'with-border' );
Toolkit::alert( '<strong>Warning</strong> Your subscription payment is pending', '', 'warning', '', 'with-border' );
Toolkit::alert( '<strong>Danger</strong> Your subscription payment is failed', '', 'error', '', 'with-border' );
?>";

ob_start();
Toolkit::alert( 'Your account was registered!', 'Alert', '', '', 'with-border' );
Toolkit::alert( 'Your subscription payment is successful', 'Success', 'success', '', 'with-border' );
Toolkit::alert( 'Your subscription payment is in processing', 'Info', 'info', '', 'with-border' );
Toolkit::alert( 'Your subscription payment is pending', 'Warning', 'warning', '', 'with-border' );
Toolkit::alert( 'Your subscription payment is failed', 'Danger', 'error', '', 'with-border' );
$title_alerts = ob_get_clean();

$title_alerts_code = "<?php
Toolkit::alert( 'Your account was registered!', 'Alert', '', '', 'with-border' );
Toolkit::alert( 'Your subscription payment is successful', 'Success', 'success', '', 'with-border' );
Toolkit::alert( 'Your subscription payment is in processing', 'Info', 'info', '', 'with-border' );
Toolkit::alert( 'Your subscription payment is pending', 'Warning', 'warning', '', 'with-border' );
Toolkit::alert( 'Your subscription payment is failed', 'Danger', 'error', '', 'with-border' );
?>";

ob_start();
Toolkit::alert( 'Your account was registered!', 'Alert', '', 'default', 'with-border' );
Toolkit::alert( 'Your subscription payment is successful', 'Success', 'success', 'default', 'with-border' );
Toolkit::alert( 'Your subscription payment is in processing', 'Info', 'info', 'default', 'with-border' );
Toolkit::alert( 'Your subscription payment is pending', 'Warning', 'warning', 'default', 'with-border' );
Toolkit::alert( 'Your subscription payment is failed', 'Danger', 'error', 'default', 'with-border' );
$icon_alerts = ob_get_clean();

$icon_alerts_code = "<?php
Toolkit::alert( 'Your account was registered!', 'Alert', '', 'default', 'with-border' );
Toolkit::alert( 'Your subscription payment is successful', 'Success', 'success', 'default', 'with-border' );
Toolkit::alert( 'Your subscription payment is in processing', 'Info', 'info', 'default', 'with-border' );
Toolkit::alert( 'Your subscription payment is pending', 'Warning', 'warning', 'default', 'with-border' );
Toolkit::alert( 'Your subscription payment is failed', 'Danger', 'error', 'default', 'with-border' );
?>";
?>
<div class="awesome9-ui">
	<?php
	Toolkit::html_card(
		'Default Alert',
		$alerts,
		$alert_code,
		'php'
	);

	Toolkit::html_card(
		'Bordered Alert',
		$bordered_alerts,
		$bordered_alerts_code,
		'php'
	);

	Toolkit::html_card(
		'Alert With Title',
		$title_alerts,
		$title_alerts_code,
		'php'
	);

	Toolkit::html_card(
		'Alert With Icon',
		$icon_alerts,
		$icon_alerts_code,
		'php'
	);
	?>
</div>
