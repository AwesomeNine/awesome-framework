<?php
/**
 * Section page frame.
 *
 * @since   1.0.0
 * @package Awesome9\Framework
 * @author  Awesome9 <info@awesome9.co>
 */

?>
<div id="<?php echo esc_attr( $this->get( 'wrapper_id' ) ); ?>" class="<?php echo esc_attr( $this->get( 'wrapper_class' ) ); ?>">
	<div class="settings-option-group-title">
		<?php echo esc_html( $this->get( 'title' ) ); ?>
	</div>

	<div class="settings-option-group-items">
		<?php foreach ( $this->fields as $field ) : ?>
			<?php $field->display(); ?>
		<?php endforeach; ?>
	</div>
</div>
