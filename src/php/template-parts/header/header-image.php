<?php
/**
 * Displays header media
 *
 * @package t3p
 */

?>
<!-- Page Header -->
<header class="masthead" style="background-image: url('<?php header_image(); ?>')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
          <?php
          $description = get_bloginfo( 'description', 'display' );
          if ( $description || is_customize_preview() ) : ?>
          <span class="subheading site-description"><?php echo $description; /* WPCS: xss ok. */ ?></span>
          <?php
          endif; ?>
        </div>
      </div>
    </div>
  </div>
</header>
