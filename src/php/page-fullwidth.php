<?php
/**
 * Template Name: Full Width Page
 *
 * The template for displaying pages in full-width format.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package t3p
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <div>
      <?php
      while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/page/content', 'page-fullwidth' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>
    </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
