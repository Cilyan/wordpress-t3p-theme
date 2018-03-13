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

    $style  = "background-image: url(" . esc_url( $thumbnail[0] ) . ");";
    $style = 'style="' . $style . '"';
  }
  else {
    $style  = "";
  }
?>

<section id="panel<?php echo $t3pcounter; ?>" <?php post_class('front-panel front-panel-separator'); ?> <?php echo $style; ?> >

  <div class="container">

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

  </div><!-- .container -->

</section><!-- #post-## -->
