<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */



$btn = $attr = '';

if ( !empty( $btnurl['url'] ) ) {
	$attr  = 'href="' . $btnurl['url'] . '"';
	$attr .= !empty( $btnurl['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $btnurl['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
if ( !empty( $btntext ) ) {
	$btn = '<a class="item-btn" ' . $attr . '>' . $btntext . '</a>';
}
?>
<div class="newsfit-btn">
    <?php echo wp_kses_post( $btn ); ?>
</div>