<?php
/**
 * t3p Theme Customizer
 *
 * @package t3p
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function t3p_customize_register( $wp_customize ) {
  $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

  $wp_customize->selective_refresh->add_partial(
    'blogname', array(
      'selector'        => '.site-title',
      'render_callback' => 't3p_customize_partial_blogname',
    )
  );
  $wp_customize->selective_refresh->add_partial(
    'blogdescription', array(
      'selector'        => '.site-description',
      'render_callback' => 't3p_customize_partial_blogdescription',
    )
  );

  /**
   * Theme options.
   */
  $wp_customize->add_section(
    'theme_options', array(
      'title'    => __( 'Theme Options', 't3p' ),
      'priority' => 130, // Before Additional CSS.
    )
  );

  $wp_customize->add_setting(
    't3p_footer_background', array(
      'default' => esc_url(get_template_directory_uri()) . '/assets/images/footer_background.jpg'
    )
  );

  $wp_customize->add_control(
  new WP_Customize_Image_Control(
    $wp_customize,
    't3p_footer_background',
      array(
      'label'      => __( 'Footer Background', 't3p' ),
      'section'    => 'theme_options',
      'settings'   => 't3p_footer_background',
      )
    )
  );

  /**
   * Filter number of front page sections in t3p.
   *
   * @param int $num_sections Number of front page sections.
   */
  $num_sections = apply_filters( 't3p_front_page_sections', 4 );

  $wp_customize->add_section(
    'front_page_options', array(
      'title'    => __( 'Front Page Options', 't3p' ),
      'priority' => 131, // Before Additional CSS.
    )
  );

  // Create a setting and control for each of the sections available in the theme.
  for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
    $wp_customize->add_setting(
      'panel_' . $i, array(
        'default'           => false,
        'sanitize_callback' => 'absint',
        //'transport'         => 'postMessage',
      )
    );

    $wp_customize->add_control(
      'panel_' . $i, array(
        /* translators: %d is the front page section number */
        'label'           => sprintf( __( 'Front Page Section %d Content', 't3p' ), $i ),
        'description'     => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'twentyseventeen' ) ),
        'section'         => 'front_page_options',
        'type'            => 'dropdown-pages',
        'allow_addition'  => true,
        'active_callback' => 't3p_is_static_front_page',
      )
    );

    $wp_customize->selective_refresh->add_partial(
      'panel_' . $i, array(
        'selector'            => '#panel' . $i,
        'render_callback'     => 't3p_front_page_section',
        'container_inclusive' => true,
      )
    );
  }
}
add_action( 'customize_register', 't3p_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function t3p_customize_partial_blogname() {
  bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function t3p_customize_partial_blogdescription() {
  bloginfo( 'description' );
}

/**
 * Return whether we're previewing the front page and it's a static page.
 */
function t3p_is_static_front_page() {
  return ( is_front_page() && ! is_home() );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function t3p_customize_preview_js() {
  wp_enqueue_script( 't3p-customizer', get_template_directory_uri() . '/script/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 't3p_customize_preview_js' );
