<?php
/**
 * Ui Toolkit - Cards.
 *
 * @since   1.0.0
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 */

use Awesome9\Framework\Toolkit;

$boxes = '<div class="flex items-center gap-8">
	<div class="w-24 h-24 bg-white shadow-sm rounded-lg"></div>
	<div class="w-24 h-24 bg-white shadow-md rounded-lg"></div>
	<div class="w-24 h-24 bg-white shadow-lg rounded-lg"></div>
	<div class="w-24 h-24 bg-white shadow-xl rounded-lg"></div>
	<div class="w-24 h-24 bg-white shadow-2xl rounded-lg"></div>
</div>';
?>
<div class="awesome9-ui">
	<h2>Cards</h2>

	<div class="awesome9-card">
		<header>
			<h4>Card</h4>
		</header>
		<div class="awesome9-card__content">
			<h1>Heading 1</h1>
			<h2>Heading 2</h2>
			<h3>Heading 3</h3>
			<h4>Heading 4</h4>
			<h5>Heading 5</h5>
			<h6>Heading 6</h6>
		</div>
	</div>

	<div class="awesome9-card">
		<div class="awesome9-card__content">
			<h1>Heading 1</h1>
			<h2>Heading 2</h2>
			<h3>Heading 3</h3>
			<h4>Heading 4</h4>
			<h5>Heading 5</h5>
			<h6>Heading 6</h6>
		</div>
	</div>

	<div class="awesome9-card">
		<header>
			<h4>Card with Footer</h4>
		</header>
		<div class="awesome9-card__content">
			<h1>Heading 1</h1>
			<h2>Heading 2</h2>
			<h3>Heading 3</h3>
			<h4>Heading 4</h4>
			<h5>Heading 5</h5>
			<h6>Heading 6</h6>
		</div>
		<footer>
			<p>Card with Footer</p>
		</footer>
	</div>

	<div class="awesome9-card with-sections">
		<header>
			<h4>Card with Sections</h4>
		</header>
		<div class="awesome9-card__content">
			<div class="awesome9-card__section">
				<h1>Heading 1</h1>
				<h2>Heading 2</h2>
				<h3>Heading 3</h3>
				<h4>Heading 4</h4>
				<h5>Heading 5</h5>
				<h6>Heading 6</h6>
			</div>
			<div class="awesome9-card__section !py-3 bg-gray-100">
				<h6>HTML</h6>
			</div>
			<div class="awesome9-card__section bg-gray-50">
				<pre><code>&lt;h1&gt;Heading 1&lt;/h1&gt;</code></pre>
			</div>
		</div>
	</div>

	<?php
	Toolkit::html_card(
		'Box Shadows',
		$boxes
	);
	?>

</div>
