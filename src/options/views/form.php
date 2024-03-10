<?php
/**
 * Template for settings form
 *
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Options;

defined( 'ABSPATH' ) || exit;
?>

<div class="max-w-screen-lg mx-auto">
	<form id="awesome9-option-form">
		<input type="hidden" name="action" value="typsense9_option_save">
		<div class="grid grid-cols-12 gap-x-4">
			<div class="col-span-2">
				<?php $this->render_tabs(); ?>
			</div>
			<div class="col-span-10">
				<?php $this->render_tab_content();?>
			</div>
		</div>
	</form>
</div>
<?php
//phpcs:ignore -- contain safe data
// echo $this->view_template( 'common/modal-confirm.php', array() );
?>
