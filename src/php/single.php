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

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;

        the_post_navigation(
          array(
            'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 't3p' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 't3p' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . t3p_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
            'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 't3p' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 't3p' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . t3p_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
          )
        );

      endwhile; // End of the loop.
      ?>

    </div><!-- .container -->
  </main><!-- #main -->
</div><!-- #primary -->
<?php /* get_sidebar(); */ ?>


<?php
get_footer();
