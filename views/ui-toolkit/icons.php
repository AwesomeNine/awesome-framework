<?php
/**
 * Ui Toolkit - Icons.
 *
 * @since   1.0.0
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 */

use Awesome9\Framework\Toolkit;

ob_start();
Toolkit::spinner();
$default_spinner = ob_get_clean();

ob_start();
echo '<div class="flex gap-x-8">';
Toolkit::spinner( 'text-indigo-600 w-8 h-8' );
Toolkit::spinner( 'text-gray-900 w-8 h-8' );
Toolkit::spinner( 'text-red-600 w-8 h-8' );
Toolkit::spinner( 'text-yellow-600 w-8 h-8' );
Toolkit::spinner( 'text-green-600 w-8 h-8' );
Toolkit::spinner( 'text-blue-600 w-8 h-8' );
Toolkit::spinner( 'text-emerald-500 w-8 h-8' );
Toolkit::spinner( 'text-purple-500 w-8 h-8' );
echo '</div>';
$color_spinner = ob_get_clean();

ob_start();
echo '<div class="flex items-center gap-x-8">';
Toolkit::spinner( 'text-red-600 w-4 h-4' );
Toolkit::spinner( 'text-red-600 w-6 h-6' );
Toolkit::spinner( 'text-red-600 w-8 h-8' );
Toolkit::spinner( 'text-red-600 w-10 h-10' );
echo '</div>';
$size_spinner = ob_get_clean();
?>
<div class="awesome9-ui">
	<?php
	Toolkit::html_card(
		'Spinner',
		$default_spinner,
		'<?php Toolkit::spinner(); ?>'
	);
	?>
	<?php
	Toolkit::html_card(
		'Color variants',
		$color_spinner,
		'<?php Toolkit::spinner( \'text-blue-600\' ); ?>'
	);
	Toolkit::html_card(
		'Size variants',
		$size_spinner,
		'<?php Toolkit::spinner( \'w-8 h-8\' ); ?>'
	);
	?>
</div>
