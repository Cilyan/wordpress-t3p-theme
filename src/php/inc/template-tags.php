<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package t3p
 */

if ( ! function_exists( 't3p_posted_on' ) ) :
  /**
   * Prints HTML with meta information for the current post-date/time and author.
   */
  function t3p_posted_on() {

    // Get the author name; wrap it in a link.
    $byline = sprintf(
      /* translators: %s: post author */
      __( 'by %s', 't3p' ),
      '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
    );

    // Finally, let's write all of this to the page.
    echo '<span class="posted-on">' . t3p_time_link() . '</span><span class="byline"> ' . $byline . '</span>';
  }
endif;


if ( ! function_exists( 't3p_time_link' ) ) :
  /**
   * Gets a nicely formatted string for the published date.
   */
  function t3p_time_link() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
      $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf(
      $time_string,
      get_the_date( DATE_W3C ),
      get_the_date(),
      get_the_modified_date( DATE_W3C ),
      get_the_modified_date()
    );

    // Wrap the time string in a link, and preface it with 'Posted on'.
    return sprintf(
      /* translators: %s: post date */
      __( '<span class="screen-reader-text">Posted on</span> %s', 't3p' ),
      '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
    );
  }
endif;


if ( ! function_exists( 't3p_entry_footer' ) ) :
  /**
   * Prints HTML with meta information for the categories, tags and comments.
   */
  function t3p_entry_footer() {

    /* translators: used between list items, there is a space after the comma */
    $separate_meta = __( ', ', 't3p' );

    // Get Categories for posts.
    $categories_list = get_the_category_list( $separate_meta );

    // Get Tags for posts.
    $tags_list = get_the_tag_list( '', $separate_meta );

    // We don't want to output .entry-footer if it will be empty, so make sure its not.
    if ( ( ( t3p_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {

      echo '<footer class="entry-footer">';

      if ( 'post' === get_post_type() ) {
        if ( ( $categories_list && t3p_categorized_blog() ) || $tags_list ) {
          echo '<span class="cat-tags-links">';

            // Make sure there's more than one category before displaying.
          if ( $categories_list && t3p_categorized_blog() ) {
            echo '<span class="cat-links">' . t3p_get_svg( array( 'icon' => 'folder-open' ) ) . '<span class="screen-reader-text">' . __( 'Categories', 't3p' ) . '</span>' . $categories_list . '</span>';
          }

          if ( $tags_list && ! is_wp_error( $tags_list ) ) {
            echo '<span class="tags-links">' . t3p_get_svg( array( 'icon' => 'hashtag' ) ) . '<span class="screen-reader-text">' . __( 'Tags', 't3p' ) . '</span>' . $tags_list . '</span>';
          }

          echo '</span>';
        }
      }

      t3p_edit_link();

      echo '</footer> <!-- .entry-footer -->';
    }
  }
endif;


if ( ! function_exists( 't3p_edit_link' ) ) :
  /**
   * Returns an accessibility-friendly link to edit a post or page.
   *
   * This also gives us a little context about what exactly we're editing
   * (post or page?) so that users understand a bit more where they are in terms
   * of the template hierarchy and their content. Helpful when/if the single-page
   * layout with multiple posts/pages shown gets confusing.
   */
  function t3p_edit_link() {
    edit_post_link(
      sprintf(
        /* translators: %s: Name of current post */
        __( 'Edit<span class="screen-reader-text"> "%s"</span>', 't3p' ),
        get_the_title()
      ),
      '<span class="edit-link">',
      '</span>'
    );
  }
endif;

/**
 * Display a front page section.
 *
 * @param WP_Customize_Partial $partial Partial associated with a selective refresh request.
 * @param integer              $id Front page section to display.
 */
function t3p_front_page_section( $partial = null, $id = 0 ) {
  if ( is_a( $partial, 'WP_Customize_Partial' ) ) {
    // Find out the id and set it up during a selective refresh.
    global $t3pcounter;
    $id                     = str_replace( 'panel_', '', $partial->id );
    $t3pcounter = $id;
  }

  global $post; // Modify the global post object before setting up post data.
  if ( get_theme_mod( 'panel_' . $id ) ) {
    $post = get_post( get_theme_mod( 'panel_' . $id ) );
    setup_postdata( $post );
    set_query_var( 'panel', $id );

    get_template_part( 'template-parts/page/content', 'front-page-panels' );

    wp_reset_postdata();
  } elseif ( is_customize_preview() ) {
    // The output placeholder anchor.
    echo '<article class="panel-placeholder panel t3p-panel t3p-panel' . $id . '" id="panel' . $id . '"><span class="t3p-panel-title">' . sprintf( __( 'Front Page Section %1$s Placeholder', 't3p' ), $id ) . '</span></article>';
  }
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function t3p_categorized_blog() {
  $category_count = get_transient( 't3p_categories' );

  if ( false === $category_count ) {
    // Create an array of all the categories that are attached to posts.
    $categories = get_categories(
      array(
        'fields'     => 'ids',
        'hide_empty' => 1,
        // We only need to know if there is more than one category.
        'number'     => 2,
      )
    );

    // Count the number of categories that are attached to the posts.
    $category_count = count( $categories );

    set_transient( 't3p_categories', $category_count );
  }

  // Allow viewing case of 0 or 1 categories in post preview.
  if ( is_preview() ) {
    return true;
  }

  return $category_count > 1;
}

function t3p_get_footer_background() {
  if (get_theme_mod('t3p_footer_background')) {
    echo get_theme_mod('t3p_footer_background');
  }
  else {
    echo esc_url(get_template_directory_uri()) . '/assets/images/footer_background.jpg';
  }
}


/**
 * Flush out the transients used in t3p_categorized_blog.
 */
function t3p_category_transient_flusher() {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }
  // Like, beat it. Dig?
  delete_transient( 't3p_categories' );
}
add_action( 'edit_category', 't3p_category_transient_flusher' );
add_action( 'save_post', 't3p_category_transient_flusher' );

/**
 * Retrieves the adjacent post link.
 *
 * Can be either next post link or previous.
 *
 * @since 3.7.0
 *
 * @param string       $format         Link anchor format.
 * @param string       $link           Link permalink format.
 * @param bool         $in_same_term   Optional. Whether link should be in a same taxonomy term. Default false.
 * @param array|string $excluded_terms Optional. Array or comma-separated list of excluded terms IDs. Default empty.
 * @param bool         $previous       Optional. Whether to display link to previous or next post. Default true.
 * @param string       $taxonomy       Optional. Taxonomy, if $in_same_term is true. Default 'category'.
 * @return string The link URL of the previous or next post in relation to the current post.
 */
function t3p_get_adjacent_post_link($format, $link, $in_same_term = false, $excluded_terms = '', $previous = true, $taxonomy = 'category')
{
  if ($previous && is_attachment()) {
    $post = get_post(get_post()->post_parent);
  } else {
    $post = get_adjacent_post($in_same_term, $excluded_terms, $previous, $taxonomy);
  }

  if (! $post) {
    $output = '';
  } else {
    $title = $post->post_title;

    if (empty($post->post_title)) {
      $title = $previous ? __('Previous Post') : __('Next Post');
    }

    /** This filter is documented in wp-includes/post-template.php */
    $title = apply_filters('the_title', $title, $post->ID);

    $thumbnail = get_the_post_thumbnail($post, array(150, 150));

    $date = mysql2date(get_option('date_format'), $post->post_date);
    $rel = $previous ? 'prev' : 'next';

    $string = '<a href="' . get_permalink($post) . '" rel="'.$rel.'">';
    $inlink = str_replace('%title', $title, $link);
    $inlink = str_replace('%date', $date, $inlink);
    $inlink = str_replace('%thumbnail', $thumbnail, $inlink);
    $inlink = $string . $inlink . '</a>';

    $output = str_replace('%link', $inlink, $format);
  }

  $adjacent = $previous ? 'previous' : 'next';

  /**
   * Filters the adjacent post link.
   *
   * The dynamic portion of the hook name, `$adjacent`, refers to the type
   * of adjacency, 'next' or 'previous'.
   *
   * @since 2.6.0
   * @since 4.2.0 Added the `$adjacent` parameter.
   *
   * @param string  $output   The adjacent post link.
   * @param string  $format   Link anchor format.
   * @param string  $link     Link permalink format.
   * @param WP_Post $post     The adjacent post.
   * @param string  $adjacent Whether the post is previous or next.
   */
  return apply_filters("{$adjacent}_post_link", $output, $format, $link, $post, $adjacent);
}

function t3p_get_the_post_navigation( $args = array() ) {
  $args = wp_parse_args( $args, array(
    'prev_text'          => '%title',
    'next_text'          => '%title',
    'in_same_term'       => false,
    'excluded_terms'     => '',
    'taxonomy'           => 'category',
    'screen_reader_text' => __( 'Post navigation' ),
  ) );

  $navigation = '';

  $previous = t3p_get_adjacent_post_link(
    '<div class="nav-previous">%link</div>',
    $args['prev_text'],
    $args['in_same_term'],
    $args['excluded_terms'],
    true, /* previous */
    $args['taxonomy']
  );

  $next = t3p_get_adjacent_post_link(
    '<div class="nav-next">%link</div>',
    $args['next_text'],
    $args['in_same_term'],
    $args['excluded_terms'],
    false, /* next */
    $args['taxonomy']
  );

  // Only add markup if there's somewhere to navigate to.
  if ( $previous || $next ) {
      $navigation = _navigation_markup('<span class="middle">&nbsp;</span>' . $previous . $next, 'post-navigation', $args['screen_reader_text'] );
  }

  return $navigation;
}

function t3p_the_post_navigation( $args = array() ) {
  echo t3p_get_the_post_navigation( $args );
}
