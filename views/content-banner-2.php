<?php
/**
 * Template part for displaying banner content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newsfit
 */

$pid      = get_the_ID();
$image    = get_the_post_thumbnail_url( $pid, 'full' );
$bg_css   = "background-image: url($image)";
$subtitle = newsfit_option( 'rt_home_subtitle' );
$class    = is_front_page() ? 'is-front-page' : '';
?>
<div class="page-main-banner <?php echo esc_attr( $class ); ?>" style="<?php echo esc_attr( $bg_css ) ?>">
	<div class="main-banner-content">
		<h1 class="page-title"><?php echo get_the_title( $pid ) ?></h1>
	</div>
	<a class="header-scroll-bounce" href="#site-navigation"></a>
</div>
