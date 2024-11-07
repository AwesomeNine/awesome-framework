<?php
/**
 * Ui Toolkit - Accordion.
 *
 * @since   1.0.0
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 */

use Awesome9\Framework\Toolkit;

$accordion_checkbox = '<div class="awesome9-accordion-group">
	<div class="accordion">
		<input type="checkbox" name="accordion-1" id="cb1" checked>
		<label for="cb1" class="accordion__header">Accordion Item 1</label>
		<div class="accordion__content">
			<p>This is the content of the first accordion item. You can add any HTML content here, including text, images, and links.</p>
		</div>
	</div>
	<div class="accordion">
		<input type="checkbox" name="accordion-1" id="cb2">
		<label for="cb2" class="accordion__header">Accordion Item 2</label>
		<div class="accordion__content">
			<p>This is the content of the second accordion item. Enjoy the smooth transition as you expand and collapse.</p>
		</div>
	</div>
	<div class="accordion">
		<input type="checkbox" name="accordion-1" id="cb3">
		<label for="cb3" class="accordion__header">Accordion Item 3</label>
		<div class="accordion__content">
			<p>This is the content of the third accordion item. Feel free to customize the styles and make it your own.</p>
		</div>
	</div>
</div>';

$accordion_radio = '<div class="awesome9-accordion-group">
	<div class="accordion">
		<input type="radio" name="accordion-1" id="rb1" checked>
		<label for="rb1" class="accordion__header">Accordion Item 1</label>
		<div class="accordion__content">
			<p>This is the content of the first accordion item. You can add any HTML content here, including text, images, and links.</p>
		</div>
	</div>
	<div class="accordion">
		<input type="radio" name="accordion-1" id="rb2">
		<label for="rb2" class="accordion__header">Accordion Item 2</label>
		<div class="accordion__content">
			<p>This is the content of the second accordion item. Enjoy the smooth transition as you expand and collapse.</p>
		</div>
	</div>
	<div class="accordion">
		<input type="radio" name="accordion-1" id="rb3">
		<label for="rb3" class="accordion__header">Accordion Item 3</label>
		<div class="accordion__content">
			<p>This is the content of the third accordion item. Feel free to customize the styles and make it your own.</p>
		</div>
	</div>
</div>';
?>
<div class="awesome9-ui">
	<?php
	Toolkit::html_card( 'Default accordion', $accordion_checkbox );
	Toolkit::html_card( 'Accordion toggle one at a time', $accordion_radio );
	?>
</div>
