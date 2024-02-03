<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 * top_sub_title
 * title
 * subtitle
 * bg_title
 * top_title_icon
 *
 */
$btn_url = $button_url['url'] ?? '#';
?>

<div class="newsfit-image-box-wrapper style-<?php echo esc_attr( $layout ) ?>">
	<header>
		<div class="image-wrapper">
			<a class="image-link" href="<?php echo esc_url( $btn_url ) ?>">
				<?php echo wp_get_attachment_image( $image['id'], 'full' ); ?>
			</a>
			<?php if ( $button_label ): ?>
				<a class="image-button btn btn-primary" href="<?php echo esc_url( $btn_url ) ?>"><?php echo wp_kses_post( $button_label ); ?></a>
			<?php endif; ?>
		</div>
	</header>

	<footer>
		<span class="pipe"></span>
		<?php if ( $title ): ?>
		<<?php echo esc_attr( $main_title_tag ) ?> class="main-title">
		<a class="image-link" href="<?php echo esc_url( $btn_url ) ?>">
			<?php echo wp_kses_post( $title ); ?>
		</a>
	</<?php echo esc_attr( $main_title_tag ) ?>>
	<?php endif; ?>

	<?php if ( $description ): ?>
		<div class="description"><?php echo wp_kses_post( $description ); ?></div>
	<?php endif; ?>
	</footer>
</div>
