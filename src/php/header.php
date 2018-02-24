<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package t3p
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
  <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 't3p' ); ?></a>

  <?php get_template_part( 'template-parts/header/site', 'branding'); ?>

  <?php get_template_part( 'template-parts/navigation/navigation', 'top'); ?>

  <?php get_template_part( 'template-parts/header/header', 'image'); ?>

  <a href="javascript:" id="totop"><span><?php echo t3p_get_svg( array( 'icon' => 'chevron-up' ) ); ?></span></a>

  <div id="content" class="site-content">
