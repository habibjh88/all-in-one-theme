<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package newsfit
 */
?>
	<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php wp_head(); ?>
	</head>

<body <?php body_class(); ?>>
<?php wp_body_open();
$header_style = newsfit_option( 'rt_header_style' );
?>

<div id="page" class="site">
	<div id="rt-sticky-placeholder"></div>
	<header id="masthead" class="site-header" role="banner">
		<?php
		if ( $header_style != '2' ) :
			get_template_part( 'views/header/header', 'topbar' );
		endif;
		?>
		<?php get_template_part( 'views/header/header', $header_style ); ?>
		<?php get_template_part( 'views/header/offcanvas', 'drawer' ); ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
<?php
if ( $header_style == 2 ) {
	get_template_part( 'views/content', 'banner-2' );
} else {
	get_template_part( 'views/content', 'banner' );
}
