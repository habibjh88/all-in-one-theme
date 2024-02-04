<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */


?>

<div class="rt-el-testimonial-carousel <?php echo esc_attr( $layout ) ?>">
	<div class="rt-slick">

		<?php foreach ( $items as $item ): ?>
			<div class="slick-item">
				<div class="testimonial-content">
					<?php
					if ( $item['image']['id'] ) {
						echo "<div class='testimonial-img'>";
						echo wp_get_attachment_image( $item['image']['id'] );
						echo "</div>";
					}
					?>
					<div class="content-inner">
						<?php if ( $item['title'] ): ?>
							<h3 class="item-title"><?php echo esc_html( $item['title'] ); ?></h3>
						<?php endif; ?>

						<div class="item-content">
							<?php echo esc_html( $item['content'] ); ?>
						</div>

						<?php if ( $item['name'] ) : ?>
							<h3 class="item-name"><?php echo esc_html( $item['name'] ); ?></h3>
						<?php endif; ?>
					</div>

				</div>
			</div>
		<?php endforeach; ?>

	</div>
</div>

