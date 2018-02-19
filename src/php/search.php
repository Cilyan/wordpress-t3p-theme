<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package t3p
 */

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <div class="container main-container">

      <header class="page-header">
        <?php if ( have_posts() ) : ?>
          <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 't3p' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
        <?php else : ?>
          <h1 class="page-title"><?php _e( 'Nothing Found', 't3p' ); ?></h1>
        <?php endif; ?>
      </header><!-- .page-header -->

    <?php
    if ( have_posts() ) :
      /* Start the Loop */
      while ( have_posts() ) :
        the_post();

        /**
         * Run the loop for the search to output the results.
         * If you want to overload this in a child theme then include a file
         * called content-search.php and that will be used instead.
         */
        get_template_part( 'template-parts/post/content', 'excerpt' );

      endwhile; // End of the loop.

      the_posts_pagination(
        array(
          'prev_text'          => t3p_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 't3p' ) . '</span>',
          'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 't3p' ) . '</span>' . t3p_get_svg( array( 'icon' => 'arrow-right' ) ),
          'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 't3p' ) . ' </span>',
        )
      );

    else :
    ?>

      <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 't3p' ); ?></p>
      <?php
        get_search_form();

    endif;
    ?>

    </div><!-- .container -->
  </main><!-- #main -->
</div><!-- #primary -->
<?php /*get_sidebar();*/ ?>

<?php
get_footer();
