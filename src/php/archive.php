<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package t3p
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <div class="container main-container">

      <?php if ( have_posts() ) : ?>
        <header class="page-header">
          <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="taxonomy-description">', '</div>' );
          ?>
        </header><!-- .page-header -->
      <?php endif; ?>

    <?php
    if ( have_posts() ) :
    ?>
      <?php
      /* Start the Loop */
      while ( have_posts() ) :
        the_post();

        /*
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        get_template_part( 'template-parts/post/content', get_post_format() );

      endwhile;

      the_posts_pagination(
        array(
          'prev_text'          => t3p_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 't3p' ) . '</span>',
          'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 't3p' ) . '</span>' . t3p_get_svg( array( 'icon' => 'arrow-right' ) ),
          'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 't3p' ) . ' </span>',
        )
      );

    else :

      get_template_part( 'template-parts/post/content', 'none' );

    endif;
    ?>
    </div><!-- .container -->
  </main><!-- #main -->
</div><!-- #primary -->
<?php /* get_sidebar(); */ ?>

<?php
get_footer();
