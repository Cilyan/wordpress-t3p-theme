<?php
/**
 * Displays content for front page
 *
 * @package t3p
 */

?>

<?php
  if ( has_post_thumbnail() ) {
    $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 't3p-featured-image' );

    // Calculate aspect ratio: h / w * 100%.
    $ratio = $thumbnail[2] / $thumbnail[1] * 100;

    $style  = "background-image: url(" . esc_url( $thumbnail[0] ) . ");";
    $style .= " min-height: " . esc_attr( $ratio ) . "%;";
    $style = 'style="' . $style . '"';
  }
  else {
    $style  = "";
  }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'front-article' ); ?> <?php echo $style; ?> >

  <div class="container">
    <div class="panel-content">
      <div class="wrap">
        <?php /* t3p_edit_link( get_the_ID() );*/ ?>

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
