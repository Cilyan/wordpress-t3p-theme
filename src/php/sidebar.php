<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package t3p
 */

if ( is_active_sidebar( 'sidebar-1' ) ) :
?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 't3p' ); ?>">
  <?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->

<?
endif;
