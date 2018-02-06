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
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function t3p_customize_preview_js() {
  wp_enqueue_script( 't3p-customizer', get_template_directory_uri() . '/script/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 't3p_customize_preview_js' );
