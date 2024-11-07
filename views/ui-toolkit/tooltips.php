<?php
/**
 * Ui Toolkit - Tooltips.
 *
 * @since   1.0.0
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 */

use Awesome9\Framework\Toolkit;

ob_start();
echo '<div class="flex gap-x-10 py-4">';
Toolkit::tooltip( 'Tooltip on top', 'This is a tooltip' );
Toolkit::tooltip( 'Tooltip on right', 'This is a tooltip', [ 'position' => 'right' ] );
Toolkit::tooltip( 'Tooltip on bottom', 'This is a tooltip', [ 'position' => 'bottom' ] );
Toolkit::tooltip( 'Tooltip on left', 'This is a tooltip', [ 'position' => 'left' ] );
echo '</div>';
$tooltip = ob_get_clean();

$tooltip_code = "<?php
Toolkit::tooltip( 'Tooltip on top', 'This is a tooltip' );
Toolkit::tooltip( 'Tooltip on right', 'This is a tooltip', [ 'position' => 'right' ] );
Toolkit::tooltip( 'Tooltip on bottom', 'This is a tooltip', [ 'position' => 'bottom' ] );
Toolkit::tooltip( 'Tooltip on left', 'This is a tooltip', [ 'position' => 'left' ] );";
?>
<div class="awesome9-ui">
	<?php
	Toolkit::html_card(
		__( 'Tooltips', 'awesome9' ),
		$tooltip,
		$tooltip_code
	);
	?>
</div>
