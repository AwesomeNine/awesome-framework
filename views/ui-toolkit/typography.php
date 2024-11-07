<?php
/**
 * Ui Toolkit - Typography.
 *
 * @since   1.0.0
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 */

use Awesome9\Framework\Toolkit;

$headings = '<h1>Heading 1</h1>

<h2>Heading 2</h2>

<h3>Heading 3</h3>

<h4>Heading 4</h4>

<h5>Heading 5</h5>

<h6>Heading 6</h6>';

$paragraphs = '<p class="awesome9-lead">Well, let me tell you something. Y\'know that little stamp, the one that says
"New York Public Library"? Well that may not mean anything to you, but that means a lot to me.</p>

<p class="awesome9-description">This is a paragraph.</p>

<p>This is a paragraph.</p>';
?>
<div class="awesome9-ui max-w-screen-lg">
	<?php
	Toolkit::html_card(
		'Headings',
		$headings
	);

	Toolkit::html_card(
		'Paragraphs',
		$paragraphs
	);
	?>

	<div class="awesome9-card">
		<header>
			<h4>Links</h4>
		</header>
		<div class="awesome9-card__content">
			<a href="https://example.com">This is a link</a>
		</div>
	</div>

	<div class="awesome9-card">
		<header>
			<h4>Lists</h4>
		</header>
		<div class="awesome9-card__content">
			<ul class="awesome9-list">
				<li>Unordered List Item</li>
				<li>Unordered List Item</li>
			</ul>
			<ol class="awesome9-list">
				<li>Ordered List Item</li>
				<li>Ordered List Item</li>
			</ol>
		</div>
	</div>

</div>
