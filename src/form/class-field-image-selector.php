<?php
/**
 * Form image selector input
 *
 * @package Awesome9\Framework\Form
 * @author  Awesome9 <info@awesome9.co>
 * @since   1.0.0
 */

namespace Awesome9\Framework\Form;

use Awesome9\Framework\Utilities\HTML;

defined( 'ABSPATH' ) || exit;

/**
 * Field image selector class
 */
class Field_Image_Selector extends Field {

	/**
	 * Render field
	 *
	 * @return void
	 */
	public function render() {
		// Early bail!!
		if ( ! $this->get( 'options' ) ) {
			return;
		}

		$counter = 1;

		$wrap_class = HTML::classnames( 'awesome-image-selector', $this->get( 'class' ) );
		echo '<div class=" ' . esc_attr( $wrap_class ) . '">';

		foreach ( $this->get( 'options' ) as $data ) :
			$option_id   = $this->get( 'id' ) . '-' . ( $counter++ );
			$title       = $data['title'] ?? '';
			$description = $data['description'] ?? '';
			$image       = $data['image'] ?? '';
			$item_class  = HTML::classnames(
				'awesome-selector-item',
				$data['item_class'] ?? '',
				$image ? 'has-image' : 'no-image'
			);

			$input_attrs = [
				'type'  => 'radio',
				'id'    => $option_id,
				'name'  => $this->get( 'name' ),
				'value' => $data[ 'value' ],
			];

			if ( (string) $this->get( 'value' ) === (string) $data['value'] ) {
				$input_attrs['checked'] = 'checked';
			}

			?>
			<input <?php echo HTML::build_attributes( $input_attrs ); ?> />
			<label class="<?php echo esc_attr( $item_class ); ?>" for="<?php echo esc_attr( $option_id ); ?>">

				<?php if ( ! empty( $image ) ) : ?>
					<!-- tooltip meta (visible on hover/focus) -->
					<div class="awesome-tooltip-alt">
						<span class="awesome-tooltip-controller">
							<img class="awesome-selector-item-thumb" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
						</span>
						<div class="awesome-tooltip-content" role="tooltip">
							<div class="awesome-selector-item-title"><?php echo esc_html( $title ); ?></div>
							<div class="awesome-selector-item-description"><?php echo esc_html( $description ); ?></div>
						</div>
					</div>
				<?php else : ?>
					<!-- inline meta (hidden when image exists) -->
					<div class="awesome-selector-item-meta">
						<div class="awesome-selector-item-title"><?php echo esc_html( $title ); ?></div>
						<div class="awesome-selector-item-description"><?php echo esc_html( $description ); ?></div>
					</div>
				<?php endif; ?>
			</label>
			<?php
		endforeach;

		echo '</div>';
	}
}
