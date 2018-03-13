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

<section id="panel<?php echo $t3pcounter; ?>" <?php post_class( 'front-panel' ); ?> <?php echo $style; ?> ><!-- Trails -->

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

    <?php
    // Show three most recent posts.
    $trails = new WP_Query(
      array(
        'post_type'           => 'trail',
        'post_status'         => 'publish',
        'orderby'             => 'meta_value_num',
        'order'               => 'ASC',
        'meta_key'            => 'trail-priority',
        'meta_type'           => 'NUMERIC',
        'meta_query' => array(
          array(
            'key'     => 'trail-displayfront',
            'value'   => 'yes',
            'compare' => '=',
          ),
        ),
      )
    );
    ?>

    <?php if ( $trails->have_posts() ) : ?>

      <div class="trails-showcase">

        <?php
        $t3p_trail_showcase_count = 0;
        while ( $trails->have_posts() ) :
          $t3p_trail_showcase_count += 1;
          if ($t3p_trail_showcase_count > 2) {
            echo "<div class='breaker'></div>\n";
            $t3p_trail_showcase_count = 1;
          }
          $trails->the_post();
          get_template_part( 'template-parts/post/content', 'front-trail' );
        endwhile;
        wp_reset_postdata();
        ?>
      </div><!-- .recent-posts -->
    <?php endif; ?>

  </div><!-- .container -->

</section><!-- #post-## -->
