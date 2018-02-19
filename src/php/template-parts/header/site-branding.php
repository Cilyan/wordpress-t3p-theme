<?php
/**
 * Displays header site branding
 *
 * @package t3p
 */
 /* the_custom_logo(); */

?>

<div id="logo-overlay">
  <div class="container">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
        <div class="logo-overlay-block">
          <h3 class="site-title"><?php bloginfo( 'name' ); ?></h3>
          <?php
          $description = get_bloginfo( 'description', 'display' );
          if ( $description || is_customize_preview() ) : ?>
            <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
          <?php
          endif; ?>
      </div>
    </a>
  </div>
</div>
