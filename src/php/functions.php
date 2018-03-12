<?php
/**
 * t3p functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package t3p
 */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function t3p_setup() {
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   * If you're building a theme based on t3p, use a find and replace
   * to change 't3p' to the name of your theme in all the template files.
   */
  load_theme_textdomain( 't3p', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   *
   * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
   */
  add_theme_support( 'post-thumbnails' );

  add_image_size( 't3p-featured-image', 2000, 1200, true );

  add_image_size( 't3p-thumbnail-avatar', 100, 100, true );

  // Set the default content width.
  $GLOBALS['content_width'] = 960;

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'menu-primary' => esc_html__( 'Primary', 't3p' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support(
    'html5', array(
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
    )
  );

  /*
   * Enable support for Post Formats.
   *
   * See: https://codex.wordpress.org/Post_Formats
   */
  add_theme_support(
    'post-formats', array(
      'aside',
      'image',
      'video',
      'quote',
      'link',
      'gallery',
      'audio',
    )
  );

  // Add theme support for Custom Logo.
  add_theme_support(
    'custom-logo', array(
      'width'      => 250,
      'height'     => 250,
      'flex-width' => true,
    'flex-height' => true,
    )
  );

  // Add theme support for selective refresh for widgets.
  add_theme_support( 'customize-selective-refresh-widgets' );

}

add_action( 'after_setup_theme', 't3p_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function t3p_content_width() {
  $GLOBALS['content_width'] = apply_filters( 't3p_content_width', 960 );
}
add_action( 'template_redirect', 't3p_content_width', 0 );


/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function t3p_resource_hints( $urls, $relation_type ) {
  if ( wp_style_is( 't3p-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
    $urls[] = array(
      'href' => 'https://fonts.gstatic.com',
      'crossorigin',
    );
  }

  return $urls;
}
add_filter( 'wp_resource_hints', 't3p_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function t3p_widgets_init() {
  // register_sidebar(
  //   array(
  //     'name'          => __( 'Blog Sidebar', 't3p' ),
  //     'id'            => 'sidebar-1',
  //     'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 't3p' ),
  //     'before_widget' => '<section id="%1$s" class="widget %2$s">',
  //     'after_widget'  => '</section>',
  //     'before_title'  => '<h2 class="widget-title">',
  //     'after_title'   => '</h2>',
  //   )
  // );

  register_sidebar(
    array(
      'name'          => __( 'Footer 1', 't3p' ),
      'id'            => 'sidebar-2',
      'description'   => __( 'Add widgets here to appear in your footer.', 't3p' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );

  register_sidebar(
    array(
      'name'          => __( 'Footer 2', 't3p' ),
      'id'            => 'sidebar-3',
      'description'   => __( 'Add widgets here to appear in your footer.', 't3p' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );
}
add_action( 'widgets_init', 't3p_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @param string $link Link to single post/page.
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function t3p_excerpt_more( $link ) {
  if ( is_admin() ) {
    return $link;
  }

  if ( is_home() ) {
    $link = "";
  }
  else {
    $link = sprintf(
      '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
      esc_url( get_permalink( get_the_ID() ) ),
      /* translators: %s: Name of current post */
      sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 't3p' ), get_the_title( get_the_ID() ) )
    );
  }

  return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 't3p_excerpt_more' );

/**
 * Enqueue scripts and styles.
 */
function t3p_scripts() {
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Lato|Roboto|Roboto+Condensed');

  wp_enqueue_style('t3p-style', get_stylesheet_uri());

  wp_enqueue_script('t3p-main', get_template_directory_uri() . '/assets/script/main.js', array('jquery'), null, true);

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script('comment-reply');
  }

  if (is_front_page()) {
    wp_register_script('t3p-frontpage', get_template_directory_uri() . '/assets/script/frontpage.js', array('jquery'), null, true);

    $masthead_video_props = array(
      'videoId' => get_theme_mod('front_page_video_id'), // 'o--eZThXHYU',
      'startSeconds' => get_theme_mod('front_page_video_start'), // 79,
      'endSeconds' => get_theme_mod('front_page_video_end'), // 250,
      'suggestedQuality' => get_theme_mod('front_page_video_quality'), // 'hd720'
    );

    wp_localize_script( 't3p-frontpage', 'masthead_video_props', $masthead_video_props);

    $race_start = new DateTime('2018-07-22 07:30', new DateTimeZone('Europe/Paris'));
    $countdown_props = array(
      'start_timestamp' => $race_start->getTimestamp() * 1000,
    );

    wp_localize_script( 't3p-frontpage', 'countdown_props', $countdown_props);

    wp_enqueue_script('t3p-frontpage');
  }
}
add_action( 'wp_enqueue_scripts', 't3p_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function t3p_content_image_sizes_attr( $sizes, $size ) {
  $width = $size[0];

  if ( 720 <= $width ) {
    $sizes = '(max-width: 576px) 540px, (max-width: 768px) 720px, (max-width: 992px) 960px, 1140px';
  }

  if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
    if ( (! is_page()) && 720 <= $width ) {
      $sizes = '(max-width: 576px) 540px, (max-width: 768px) 720px, (max-width: 992px) 960px, 1140px';
    }
  }

  return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 't3p_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function t3p_header_image_tag( $html, $header, $attr ) {
  if ( isset( $attr['sizes'] ) ) {
    $html = str_replace( $attr['sizes'], '100vw', $html );
  }
  return $html;
}
add_filter( 'get_header_image_tag', 't3p_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function t3p_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
  if ( is_archive() || is_search() ) {
    $attr['sizes'] = '(max-width: 576px) 540px, (max-width: 768px) 180px, (max-width: 992px) 240px, 285px';
  } else {
    $attr['sizes'] = '100vw';
  }

  return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 't3p_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function t3p_front_page_template( $template ) {
  return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 't3p_front_page_template' );

if ( ! function_exists( 't3p_excerpt_length' ) ) {
  /**
   * Filter the except length to 30 characters.
   * Returns default on admin side
   *
   * @return int - modified excerpt length.
   */
  function t3p_excerpt_length( $length ) {
    return is_admin() ? $length : 30;
  }
}
add_filter( 'excerpt_length', 't3p_excerpt_length', 999 );

/*
 * Fix problems with <p> tags and shortcodes.
 */
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12);

/**
 * Custom Post Type for Trails
 */
require get_parent_theme_file_path( '/inc/custom-post-trail.php' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * Bootstrap Navbar Menu Walker
 */
require get_parent_theme_file_path( '/inc/class-wp-bootstrap-navwalker.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

/**
 * Shortcodes for editor.
 */
require get_parent_theme_file_path( '/inc/template-shortcodes.php' );

// /**
//  * Load Jetpack compatibility file.
//  */
// if ( defined( 'JETPACK__VERSION' ) ) {
//   require get_template_directory() . '/inc/jetpack.php';
// }
