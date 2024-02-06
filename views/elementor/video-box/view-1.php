<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$img_url = wp_get_attachment_image_src( $image['id'], 'full' );
$img_bg  = '';
if ( $img_url ) {
	$img_bg = "background-image:url(" . esc_attr( $img_url[0] ) . ")";
}
?>
<div class="rt-video-icon-wrapper style-<?php echo esc_attr( $layout ) ?>">
	<div class="video-icon-inner" style="<?php echo esc_attr( $img_bg ) ?>">
		<a class="popup-youtube video-popup-icon" href="<?php echo esc_url( $video_url ) ?>"></a>
		<?php if ( $button_text ) : ?>
			<a class="btn btn-primary popup-youtube button-text" href="<?php echo esc_url( $video_url ) ?>">
				<?php echo esc_html( $button_text ) ?>
			</a>
		<?php endif; ?>
	</div>
</div>

