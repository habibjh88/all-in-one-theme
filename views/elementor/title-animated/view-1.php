<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */


?>
<div class="section-heading">
	<h2 class="heading-title"><span class="title-typejs" data-options="<?php echo esc_attr( $options ); ?>"></span>&nbsp;</h2>
	<?php if ( $subtitle ): ?>
		<p class="heading-subtitle"><?php echo wp_kses_post( $subtitle ); ?></p>
	<?php endif; ?>
</div>