<?php
/**
 * Displays top navigation
 *
 * @package t3p
 */

?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="site-navigation">
  <div class="container">
    <a class="navbar-brand site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php
      wp_nav_menu( array(
          'theme_location'    => 'menu-primary',
          'depth'             => 2,
          'container'         => 'div',
          'container_class'   => 'collapse navbar-collapse',
          'container_id'      => 'navbarResponsive',
          'menu_class'        => 'navbar-nav ml-auto',
          'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
          'walker'            => new WP_Bootstrap_Navwalker())
      );
    ?>
  </div>
</nav>
