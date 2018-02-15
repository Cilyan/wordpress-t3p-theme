<?php
/**
 * Displays content for front page
 *
 * @package t3p
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 't3p-panel ' ); ?> >
  
  <?php
  if ( has_post_thumbnail() ) :
    $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 't3p-featured-image' );

    // Calculate aspect ratio: h / w * 100%.
    $ratio = $thumbnail[2] / $thumbnail[1] * 100;
    ?>

    <div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
      <div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
    </div><!-- .panel-image -->

  <?php endif; ?>

  <div class="container">
    <div class="panel-content">
      <div class="wrap">
        <header class="entry-header">
          <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

          <?php t3p_edit_link( get_the_ID() ); ?>

        </header><!-- .entry-header -->

        <div class="entry-content">
          <?php
            /* translators: %s: Name of current post */
            the_content(
              sprintf(
                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 't3p' ),
                get_the_title()
              )
            );
          ?>
        </div><!-- .entry-content -->

      </div><!-- .wrap -->
    </div><!-- .panel-content -->
  </div>
</article><!-- #post-## -->
