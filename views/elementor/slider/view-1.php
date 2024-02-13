<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

$dataSlick = [
	'dots'           => true,
	'arrows'         => false,
	'fade'           => true,
	'speed'          => 300,
	'autoplay'       => true,
	'autoplaySpeed'  => 55000,
	'adaptiveHeight' => true,
];


?>

<div class="rt-el-main-carousel <?php echo esc_attr( $layout ) ?>">
	<div class="rt-slick rt-carousel" data-slick="<?php echo htmlspecialchars( wp_json_encode( $dataSlick ) ) ?>">

		<?php foreach ( $items as $item ):
			$target = $item['button_link']['is_external'] ? ' target="_blank"' : '';
			$nofollow = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
			$url = $item['button_link']['url'] ?? '';
			?>
			<div class="slick-item">
				<div class="slider-content">
					<?php
					if ( $item['image']['id'] ) {
						echo "<div class='slider-img'>";
						echo wp_get_attachment_image( $item['image']['id'], 'full' );
						echo "<div class='overlay'></div>";
						echo "</div>";
					}
					?>
					<div class="content-inner">
						<?php if ( $item['title'] ): ?>
							<h3 class="item-title"><?php echo newsfit_html($item['title']); ?></h3>
						<?php endif; ?>

						<div class="item-content">
							<?php echo newsfit_html( $item['content'] ); ?>
						</div>

						<?php if ( $item['button_text'] ) : ?>
							<?php printf( "<a class='btn btn-primary' href='%s' %s %s >%s</a>", $url, $target, $nofollow, $item['button_text'] ); ?>
						<?php endif; ?>
					</div>

				</div>
			</div>
		<?php endforeach; ?>

	</div>
</div>

