<?php
/**
 * Ui Toolkit - Drawer.
 *
 * @since   1.0.0
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 */

use Awesome9\Framework\Toolkit;

/* Default drawer ----------- */
ob_start();
$drawer_id = 'menu-opener';
Toolkit::drawer(
	$drawer_id,
	[
		'button_label'       => 'OPEN MENU',
		'button_classnames'  => 'awesome9-button awesome9-button__primary',
		'content_classnames' => 'border shadow-md',
	]
);
?>
	<h2 class="pt-6">Notification </h2>
	<?php Toolkit::drawer_close_button( $drawer_id ); ?>
	<div class="py-6">
		<div class="flex gap-3 mb-4">
			<img src="https://pagedone.io/asset/uploads/1704349514.png" alt="Hailey image" class="w-12 h-12">
			<div>
				<h5 class="text-gray-900 !text-sm leading-snug mb-1">Hailey Garza <span class="text-gray-500">added new tags to Ease Design System</span>
				</h5>
				<h6 class="text-gray-500 !text-xs !font-normal leading-[18px]">Account | Friday, 10:03 AM</h6>
			</div>
		</div>

		<div class="flex gap-3">
			<img src="https://pagedone.io/asset/uploads/1704351103.png" alt="Brandon image" class="w-12 h-12">
			<div>
				<h5 class="text-gray-900 !text-sm leading-snug mb-1">Brandon Newman <span class="text-gray-500">Liked your Pagedone 045-favourites-2h ago</span>
				</h5>
				<h6 class="text-gray-500 !text-xs !font-normal leading-[18px]">Friday, 10:03 AM</h6>
			</div>
		</div>
	</div>
<?php
Toolkit::drawer( $drawer_id );
$drawer = ob_get_clean();

$drawer_code = '$drawer_id = \'menu-opener\';
Toolkit::drawer(
	$drawer_id,
	[
		\'button_label\'       => \'OPEN MENU\',
		\'button_classnames\'  => \'awesome9-button awesome9-button__primary\',
		\'content_classnames\' => \'border shadow-md\',
	]
);

	<h2 class="pt-6">Notification </h2>
	<?php Toolkit::drawer_close_button( $drawer_id ); ?>
	<!-- Content starts here -->
<?php Toolkit::drawer( $drawer_id ); ?>';

/* Sidebar drawer ----------- */
ob_start();
$drawer_id = 'sidebar-drawer';
Toolkit::drawer(
	$drawer_id,
	[
		'button_label'       => 'OPEN MENU',
		'button_classnames'  => 'awesome9-button awesome9-button__primary',
		'content_classnames' => 'drawer--sidebar shadow-lg shadow-gray-200',
	]
);
?>
	<h2 class="pt-6">Notification </h2>
	<?php Toolkit::drawer_close_button( $drawer_id ); ?>
	<div class="py-6">
		<div class="flex gap-3 mb-4">
			<img src="https://pagedone.io/asset/uploads/1704349514.png" alt="Hailey image" class="w-12 h-12">
			<div>
				<h5 class="text-gray-900 !text-sm leading-snug mb-1">Hailey Garza <span class="text-gray-500">added new tags to Ease Design System</span>
				</h5>
				<h6 class="text-gray-500 !text-xs !font-normal leading-[18px]">Account | Friday, 10:03 AM</h6>
			</div>
		</div>

		<div class="flex gap-3">
			<img src="https://pagedone.io/asset/uploads/1704351103.png" alt="Brandon image" class="w-12 h-12">
			<div>
				<h5 class="text-gray-900 !text-sm leading-snug mb-1">Brandon Newman <span class="text-gray-500">Liked your Pagedone 045-favourites-2h ago</span>
				</h5>
				<h6 class="text-gray-500 !text-xs !font-normal leading-[18px]">Friday, 10:03 AM</h6>
			</div>
		</div>
	</div>
<?php
Toolkit::drawer( $drawer_id );

$drawer_sidebar      = ob_get_clean();
$drawer_sidebar_code = '<?php
$drawer_id = \'sidebar-drawer\';
Toolkit::drawer(
	$drawer_id,
	[
		\'button_label\'       => \'OPEN MENU\',
		\'button_classnames\'  => \'awesome9-button awesome9-button__primary\',
		\'content_classnames\' => \'drawer--sidebar shadow-lg shadow-gray-200\',
	]
);
?>

	<h2 class="pt-6">Notification </h2>
	<?php Toolkit::drawer_close_button( $drawer_id ); ?>
	<!-- Content starts here -->
<?php Toolkit::drawer( $drawer_id ); ?>';

/* Use backdrop ----------- */
ob_start();
$drawer_id = 'menu-backdrop';
Toolkit::drawer(
	$drawer_id,
	[
		'button_label'       => 'OPEN MENU',
		'button_classnames'  => 'awesome9-button awesome9-button__primary',
		'content_classnames' => 'border shadow-md',
		'use_backdrop'       => true,
	]
);
?>
	<div class="py-6">
		<div class="flex gap-3 mb-4">
			<img src="https://pagedone.io/asset/uploads/1704349514.png" alt="Hailey image" class="w-12 h-12">
			<div>
				<h5 class="text-gray-900 !text-sm leading-snug mb-1">Hailey Garza <span class="text-gray-500">added new tags to Ease Design System</span>
				</h5>
				<h6 class="text-gray-500 !text-xs !font-normal leading-[18px]">Account | Friday, 10:03 AM</h6>
			</div>
		</div>

		<div class="flex gap-3">
			<img src="https://pagedone.io/asset/uploads/1704351103.png" alt="Brandon image" class="w-12 h-12">
			<div>
				<h5 class="text-gray-900 !text-sm leading-snug mb-1">Brandon Newman <span class="text-gray-500">Liked your Pagedone 045-favourites-2h ago</span>
				</h5>
				<h6 class="text-gray-500 !text-xs !font-normal leading-[18px]">Friday, 10:03 AM</h6>
			</div>
		</div>
	</div>
<?php
Toolkit::drawer( $drawer_id );
$drawer_backdrop = ob_get_clean();

$drawer_backdrop_code = '<?php
$drawer_id = \'menu-backdrop\';
Toolkit::drawer(
	$drawer_id,
	[
		\'button_label\'       => \'OPEN MENU\',
		\'button_classnames\'  => \'awesome9-button awesome9-button__primary\',
		\'content_classnames\' => \'border shadow-md\',
		\'use_backdrop\'       => true,
	]
);
?>

	<h2 class="pt-6">Notification </h2>
	<?php Toolkit::drawer_close_button( $drawer_id ); ?>
	<!-- Content starts here -->
<?php Toolkit::drawer( $drawer_id ); ?>';
?>
<div class="awesome9-ui">
	<?php
	Toolkit::html_card(
		'Drawer',
		$drawer,
		$drawer_code
	);

	Toolkit::html_card(
		'Drawer Sidebar',
		$drawer_sidebar,
		$drawer_sidebar_code
	);

	Toolkit::html_card(
		'Drawer with Backdrop',
		$drawer_backdrop,
		$drawer_backdrop_code
	);
	?>
</div>
