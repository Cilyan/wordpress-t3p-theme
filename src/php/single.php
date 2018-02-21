<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package t3p
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <div class="container main-container">

      <?php
      /* Start the Loop */
      while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/post/content', get_post_format() );

        t3p_the_post_navigation(
          array(
            'prev_text' => '<i class="fa fa-angle-left"></i>%thumbnail' . __( 'Previous Post', 't3p' ) . '<br><span>%title</span>',
            'next_text' => '<i class="fa fa-angle-right"></i>%thumbnail' . __( 'Next Post', 't3p' ) . '<br><span>%title</span>',
          )
        );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>

    </div><!-- .container -->
  </main><!-- #main -->
</div><!-- #primary -->
<?php /* get_sidebar(); */ ?>


<?php
get_footer();
