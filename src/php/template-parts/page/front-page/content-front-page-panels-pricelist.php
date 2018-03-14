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

<section id="subscribe" <?php post_class( 'front-panel' ); ?> <?php echo $style; ?> >

  <div class="container">
    <header class="entry-header">
      <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
      <?php t3p_edit_link( get_the_ID() ); ?>
    </header><!-- .entry-header -->

    <?php
    // Save current post content for later
    /* translators: %s: Name of current post */
    $content = get_the_content(
      sprintf(
        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 't3p' ),
        get_the_title()
      )
    );
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
            'key'     => 'trail-displaypricelist',
            'value'   => 'yes',
            'compare' => '=',
          ),
        ),
      )
    );
    ?>

    <div class="trails-subscription-row">
      <?php if ( $trails->have_posts() ) : ?>

        <div class="trails-pricelist">
            <?php
            while ( $trails->have_posts() ) :
              $trails->the_post();
              get_template_part( 'template-parts/post/content', 'front-pricelist-item' );
            endwhile;
            wp_reset_postdata();
            ?>
        </div><!-- .trails-pricelist -->
      <?php endif; ?>

      <div class="trails-pricelist-post">
        <div class="trails-pricelist-post-content">
          <div class="entry-content">
            <?php
              echo $content;
            ?>
          </div><!-- .entry-content -->
          <div class="register-button">
            <a href="http://chrono.geofp.com/l3p2018/signin/index.php" id=""><?php _e('I Register Now', 't3p'); ?></a>
          </div>
        </div>
      </div>
    </div>

  </div><!-- .container -->

</section><!-- #post-## -->
