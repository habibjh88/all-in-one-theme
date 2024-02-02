<?php
/**
 * Template part for displaying banner content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package newsfit
 */

$pid = get_the_ID();
$image = get_the_post_thumbnail_url($pid, 'full');
$bg_css = "background-image: url($image)";
?>

<div class="page-main-banner" style="<?php echo esc_attr($bg_css) ?>">
	<div class="main-banner-content">
		<h1 class="page-title"><?php echo get_the_title($pid) ?></h1>
	</div>
	<div class="header-scroll-bounce"></div>
</div>
