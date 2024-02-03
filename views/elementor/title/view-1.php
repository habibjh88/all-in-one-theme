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

?>
<div class="section-title-wrapper">

	<div class="title-inner-wrapper">

		<!--Top Sub Title-->
		<?php if ( $top_sub_title ): ?>
			<div class="top-sub-title-wrap">
				<h2 class="top-sub-title">
					<?php echo esc_html( $top_sub_title ); ?>
				</h2>
			</div>
		<?php endif; ?>

		<!--Main Title-->
		<?php if ( $title ): ?>
		<<?php echo esc_attr( $main_title_tag ) ?> class="main-title"><?php echo wp_kses_post( $title ); ?></<?php echo esc_attr( $main_title_tag ) ?>>
	<?php endif; ?>

	<!--Description-->
	<?php if ( $description ): ?>
		<div class="description"><?php echo wp_kses_post( $description ); ?></div>
	<?php endif; ?>
</div>
</div>
