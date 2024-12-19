<?php
/**
 * Ui Toolkit - Modal.
 *
 * @since   1.0.0
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 */

use Awesome9\Framework\Toolkit;

$modal_id = 'default-modal';
ob_start();
Toolkit::modal(
	$modal_id,
	[
		'button_label'       => 'Launch it!',
		'button_classnames'  => 'awesome9-button awesome9-button--primary',
		'content_classnames' => 'drawer--sidebar shadow-lg shadow-gray-200',
	]
);
?>
<h3>Here is the modal!</h3>
<p class="lede">Created with pure CSS, and probably non-functional in many browsers.</p>
<p>The <span class="button button--inline">launch</span> button is a <span class="code">&lt;label&gt;</span> attached to a radio <span class="code">&lt;input&gt;</span>. Clicking the label toggles the radio input. Using the <span class="code">:checked</span> pseudo-selector and the <span class="code">+</span> sibling selector, the <span class="code">.modal__wrapper</span> is made visible when the radio is checked.</p>
<p>The close button in a second label/radio input with the same name attribute, so when it is clicked, the launch button loses its :checked state and the modal goes back to <span class="code">display: none</span>.<p>
<?php
Toolkit::modal( $modal_id );

$default_modal      = ob_get_clean();
$default_modal_code = "<?php
Toolkit::modal(
	$modal_id,
	[
		'button_label'       => 'Launch it!',
		'button_classnames'  => 'awesome9-button awesome9-button--primary',
		'content_classnames' => 'drawer--sidebar shadow-lg shadow-gray-200',
	]
);
?>
<h1>Here is the modal!</h2>
<p>Content goes here.</p>
<?php
Toolkit::modal( $modal_id );";
?>
<div class="awesome9-ui">
	<?php
	Toolkit::html_card(
		'Modal',
		$default_modal,
		$default_modal_code
	);
	?>
</div>
