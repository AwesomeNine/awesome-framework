<?php
/**
 * Setting page frame.
 *
 * @since   1.0.0
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 */

?>
<div class="settings-wrap wrap flex">
	<div class="settings-sidebar">
		<ul class="settings-tablist">
			<?php foreach ( $this->tabs as $tab ) : // phpcs:ignore ?>
				<li>
					<a href="#tab-<?php echo esc_attr( $tab->get( 'id' ) ); ?>">
						<span class="<?php echo esc_attr( $tab->get( 'icon' ) ); ?>"></span>
						<?php echo esc_html( $tab->get( 'title' ) ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="settings-tab-pages">
		<?php foreach ( $this->tabs as $tab ) : // phpcs:ignore ?>
			<div id="tab-<?php echo esc_attr( $tab->get( 'id' ) ); ?>" class="settings-tab-page">
				<h2 class="settings-tab-page-title">
					<?php echo esc_html( $tab->get( 'title' ) ); ?>
				</h2>

				<div class="settings-tab-page-content">
					<?php $tab->display(); ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
