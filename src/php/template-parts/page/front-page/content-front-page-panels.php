<?php
/**
 * Template part for displaying pages on front page
 *
 * @package t3p
 */

global $t3pcounter;

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

<section id="panel<?php echo $t3pcounter; ?>" <?php post_class( 'front-panel' ); ?> <?php echo $style; ?> >

  <div class="container">
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

  </div><!-- .container -->

</section><!-- #post-## -->
