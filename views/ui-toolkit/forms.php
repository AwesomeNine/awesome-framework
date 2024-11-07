<?php
/**
 * Ui Toolkit - Forms.
 *
 * @since   1.0.0
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 */

use Awesome9\Framework\Toolkit;

ob_start();
Toolkit::input_text(
	'awesome9-text-input',
	'Text Input',
	[
		'placeholder' => 'Enter text',
		'description' => 'This is a text input field.',
	]
);
$text_input      = ob_get_clean();
$text_input_code = "<?php
Toolkit::input_text(
	'awesome9-text-input',
	'Text Input',
	[
		'placeholder' => 'Enter text',
		'description' => 'This is a text input field.',
	]
);";

ob_start();
Toolkit::input_password(
	'awesome9-password-input',
	'Password Input',
	[
		'placeholder' => 'Enter password',
		'description' => 'This is a password input field.',
	]
);
$password_input      = ob_get_clean();
$password_input_code = "<?php
Toolkit::input_password(
	'awesome9-password-input',
	'Password Input',
	[
		'placeholder' => 'Enter password',
		'description' => 'This is a password input field.',
	]
);";

ob_start();
Toolkit::input_email(
	'awesome9-email-input',
	'Email Input',
	[
		'placeholder' => 'Enter email',
		'description' => 'This is a email input field.',
	]
);
$email_input      = ob_get_clean();
$email_input_code = "<?php
Toolkit::input_email(
	'awesome9-email-input',
	'Password Input',
	[
		'placeholder' => 'Enter email',
		'description' => 'This is a email input field.',
	]
);";

ob_start();
Toolkit::input_number(
	'awesome9-number-input',
	'Email Input',
	[
		'placeholder' => 'Enter number',
		'description' => 'This is a number input field.',
	]
);
$number_input      = ob_get_clean();
$number_input_code = "<?php
Toolkit::input_number(
	'awesome9-number-input',
	'Password Input',
	[
		'placeholder' => 'Enter number',
		'description' => 'This is a number input field.',
	]
);";

ob_start();
Toolkit::input_select(
	'awesome9-select-input',
	'Select Input',
	[
		'value'       => 'option3',
		'options'     => [
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
		],
		'description' => 'This is a select input field.',
	]
);
$select_input      = ob_get_clean();
$select_input_code = "<?php
Toolkit::input_select(
	'awesome9-select-input',
	'Select Input',
	[
		'value'       => 'option3',
		'options'     => [
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
		],
		'description' => 'This is a select input field.',
	]
);";

ob_start();
Toolkit::input_checkbox(
	'awesome9-checkbox-input',
	'Checkbox Input',
	[
		'value'       => 'option3',
		'options'     => [
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
		],
		'description' => 'This is a checkbox input field.',
	]
);
Toolkit::input_checkbox(
	'awesome9-checkbox-input-inline',
	'Checkbox Input Inline',
	[
		'inline'      => true,
		'value'       => 'option3',
		'options'     => [
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
		],
		'description' => 'This is a checkbox input field.',
	]
);
$checkbox_input      = ob_get_clean();
$checkbox_input_code = "<?php
Toolkit::input_checkbox(
	'awesome9-checkbox-input',
	'Checkbox Input',
	[
		'value'       => 'option3',
		'options'     => [
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
		],
		'description' => 'This is a checkbox input field.',
	]
);

Toolkit::input_checkbox(
	'awesome9-checkbox-input-inline',
	'Checkbox Input Inline',
	[
		'inline'      => true,
		'value'       => 'option3',
		'options'     => [
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
		],
		'description' => 'This is a checkbox input field.',
	]
);";

ob_start();
Toolkit::input_radio(
	'awesome9-radio-input',
	'Radio Input',
	[
		'value'       => 'option3',
		'options'     => [
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
		],
		'description' => 'This is a radio input field.',
	]
);
Toolkit::input_radio(
	'awesome9-radio-input-inline',
	'Radio Input Inline',
	[
		'inline'      => true,
		'value'       => 'option3',
		'options'     => [
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
		],
		'description' => 'This is a radio input field.',
	]
);
$radio_input      = ob_get_clean();
$radio_input_code = "<?php
Toolkit::input_radio(
	'awesome9-radio-input',
	'Radio Input',
	[
		'value'       => 'option3',
		'options'     => [
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
		],
		'description' => 'This is a radio input field.',
	]
);

Toolkit::input_radio(
	'awesome9-radio-input-inline',
	'Radio Input Inline',
	[
		'inline'      => true,
		'value'       => 'option3',
		'options'     => [
			'option1' => 'Option 1',
			'option2' => 'Option 2',
			'option3' => 'Option 3',
		],
		'description' => 'This is a radio input field.',
	]
);";

ob_start();
Toolkit::input_textarea(
	'awesome9-textarea',
	'Textarea',
	[
		'placeholder' => 'Enter text',
		'description' => 'This is a textarea field.',
	]
);
$textarea      = ob_get_clean();
$textarea_code = "<?phpToolkit::input_textarea(
	'awesome9-textarea',
	'Textarea',
	[
		'placeholder' => 'Enter text',
		'description' => 'This is a textarea field.',
	]
);";

ob_start();
Toolkit::input_file(
	'awesome9-file-input',
	'File Input',
	[
		'description' => 'This is a file input field.',
	]
);
$file_input      = ob_get_clean();
$file_input_code = "<?php
Toolkit::input_file(
	'awesome9-file-input',
	'File Input',
	[
		'description' => 'This is a file input field.',
	]
);";

ob_start();
Toolkit::input_date(
	'awesome9-date-input',
	'Date Input',
	[
		'description' => 'This is a date input field.',
	]
);
$date_input      = ob_get_clean();
$date_input_code = "<?php
Toolkit::input_date(
	'awesome9-date-input',
	'Date Input',
	[
		'description' => 'This is a date input field.',
	]
);";

ob_start();
Toolkit::input_switch(
	'awesome9-switch-input',
	'Switch Input',
	[
		'description' => 'This is a switch input field.',
	]
);
Toolkit::input_switch(
	'awesome9-switch-input-labels',
	'Switch Input',
	[
		'description' => 'This is a switch input field with description.',
		'label_on'    => 'On',
		'label_off'   => 'Off',
	]
);
$switch_input      = ob_get_clean();
$switch_input_code = "<?php
Toolkit::input_switch(
	'awesome9-switch-input',
	'Switch Input',
	[
		'description' => 'This is a switch input field.',
	]
);";
?>
<div class="awesome9-ui-kit">
	<?php
	Toolkit::html_card(
		'Text Input',
		$text_input,
		$text_input_code,
		'php'
	);

	Toolkit::html_card(
		'Password Input',
		$password_input,
		$password_input_code,
		'php'
	);

	Toolkit::html_card(
		'Email Input',
		$email_input,
		$email_input_code,
		'php'
	);

	Toolkit::html_card(
		'Number Input',
		$number_input,
		$number_input_code,
		'php'
	);

	Toolkit::html_card(
		'Select Input',
		$select_input,
		$select_input_code,
		'php'
	);

	Toolkit::html_card(
		'Checkbox Input',
		$checkbox_input,
		$checkbox_input_code,
		'php'
	);

	Toolkit::html_card(
		'Radio Input',
		$radio_input,
		$radio_input_code,
		'php'
	);

	Toolkit::html_card(
		'Textarea',
		$textarea,
		$textarea_code,
		'php'
	);

	Toolkit::html_card(
		'File Input',
		$file_input,
		$file_input_code,
		'php'
	);

	Toolkit::html_card(
		'Date Input',
		$date_input,
		$date_input_code,
		'php'
	);

	Toolkit::html_card(
		'Switch Input',
		$switch_input,
		$switch_input_code,
		'php'
	);
	?>
</div>
