<?php
/**
 * Displays footer widgets if assigned
 *
 * @package t3p
 */

?>

<?php
if (is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) ) :
?>

  <aside class="widget-area row" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 't3p' ); ?>">
    <?php
    if (is_active_sidebar( 'sidebar-2' ) ) {
    ?>
      <div class="widget-column footer-widget-1 col-md-5">
        <?php dynamic_sidebar( 'sidebar-2' ); ?>
      </div>
    <?php
    }
    if (is_active_sidebar( 'sidebar-3' ) ) {
    ?>
      <div class="widget-column footer-widget-2 col-md-7">
        <?php dynamic_sidebar( 'sidebar-3' ); ?>
      </div>
    <?php } ?>
  </aside><!-- .widget-area -->

<?php endif; ?>
