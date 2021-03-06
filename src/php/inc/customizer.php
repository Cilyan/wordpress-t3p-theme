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

  // Masthead video background properties
  $wp_customize->add_section(
    'front_page_video', array(
      'title'    => __( 'Front Page Video', 't3p' ),
      'priority' => 131, // Before Additional CSS.
    )
  );

  $wp_customize->add_setting(
    'front_page_video_id',
    array(
      'default' => '',
    )
  );

  $wp_customize->add_setting(
    'front_page_video_start',
    array(
      'default' => '',
      'sanitize_callback' => 'absint',
    )
  );

  $wp_customize->add_setting(
    'front_page_video_end',
    array(
      'default' => '',
      'sanitize_callback' => 'absint',
    )
  );

  $wp_customize->add_setting(
    'front_page_video_quality',
    array(
      'default' => 'default'
    )
  );

  $wp_customize->add_setting(
    'front_page_header_content',
    array(
      'default'           => false,
      'sanitize_callback' => 'absint',
      //'transport'         => 'postMessage',
    )
  );

  $wp_customize->add_control(
    'front_page_video_id',
    array(
      'label' => __('Video ID', 't3p'),
      'description' => __('You can find the video ID in the URL of the video: https://www.youtube.com/watch?v=<b>VIDEO_ID</b> or https://www.youtube.com/v/<b>VIDEO_ID</b>', 't3p'),
      'section' => 'front_page_video',
      'type' => 'text', // Can be either text, email, url, number, hidden, or date
      'input_attrs' => array(
        'placeholder' => '6iiA64ElaO0',
      )
    )
  );

  $wp_customize->add_control(
    'front_page_video_start',
    array(
      'label' => __('Start', 't3p'),
      'description' => esc_html__('Allows to start the video at a specific time (in seconds)', 't3p'),
      'section' => 'front_page_video',
      'type' => 'number', // Can be either text, email, url, number, hidden, or date
      'input_attrs' => array(
        'placeholder' => '0',
      )
    )
  );

  $wp_customize->add_control(
    'front_page_video_end',
    array(
      'label' => __('End', 't3p'),
      'description' => esc_html__('Allows to stop the video at a specific time (in seconds), 0 to play till the end', 't3p'),
      'section' => 'front_page_video',
      'type' => 'number', // Can be either text, email, url, number, hidden, or date
      'input_attrs' => array(
        'placeholder' => '0',
      )
    )
  );

  $wp_customize->add_control(
    'front_page_video_quality',
    array(
      'label' => __('Recommended Quality', 't3p'),
      'description' => esc_html__('The video quality suggested to the YouTube player. The player may decide otherwise. Recommended is "Automatic", that way the player will select the best suitable option depending on the client.', 't3p'),
      'section' => 'front_page_video',
      'type' => 'select',
      'choices' => array(
        'default' => __('Automatic', 't3p'),
        'small' => __('Small', 't3p'),
        'medium' => __('Medium', 't3p'),
        'large' => __('Large', 't3p'),
        'hd720' => __('720p', 't3p'),
        'hd1080' => __('1080p', 't3p'),
        'highres' => __('High Resolution', 't3p'),
      )
    )
  );

  $wp_customize->add_control(
    'front_page_header_content',
    array(
      /* translators: %d is the front page section number */
      'label'           => __( 'Front Page Header Content', 't3p' ),
      'description'     => __( 'Page that will be used as the content displayed over the header image/video', 't3p' ),
      'section'         => 'front_page_video',
      'type'            => 'dropdown-pages',
      'allow_addition'  => true,
      //'active_callback' => 't3p_is_static_front_page',
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
      'priority' => 132, // Before Additional CSS.
    )
  );

  // Create a setting and control for each of the sections available in the theme.
  for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
    $wp_customize->add_setting(
      'panel_format_' . $i,
      array(
        'default' => 'none'
      )
    );

    $wp_customize->add_setting(
      'panel_' . $i, array(
        'default'           => false,
        'sanitize_callback' => 'absint',
        //'transport'         => 'postMessage',
      )
    );

    $wp_customize->add_control(
      'panel_format_' . $i,
      array(
        /* translators: %d is the front page section number */
        'label' => sprintf( __( 'Front Page Section %d Format', 't3p' ), $i ),
        'description' => ( 1 !== $i ? '' : __( 'Select the section that shall appear in each panel. Then select a page to provide the content.', 't3p' ) ),
        'section' => 'front_page_options',
        'type' => 'select',
        'choices' => array(
          'none' => __('Not Used', 't3p'),
          'single' => __('Page Content Alone', 't3p'),
          'trails' => __('Presentation of Trails', 't3p'),
          'pricelist' => __('Price List and Subscription', 't3p'),
          'news' => __('Latest News', 't3p'),
          'separator' => __('Separator', 't3p'),
        )
      )
    );

    $wp_customize->add_control(
      'panel_' . $i, array(
        /* translators: %d is the front page section number */
        'label'           => sprintf( __( 'Front Page Section %d Content', 't3p' ), $i ),
        'description'     => ( 1 !== $i ? '' : __( 'Page that will provide content for the section. The featured image is used as background of the section.', 't3p' ) ),
        'section'         => 'front_page_options',
        'type'            => 'dropdown-pages',
        'allow_addition'  => true,
        'active_callback' => 't3p_is_static_front_page',
      )
    );

    //$wp_customize->selective_refresh->add_partial(
    //  'panel_' . $i, array(
    //    'selector'            => '#panel' . $i,
    //    'render_callback'     => 't3p_front_page_section',
    //    'container_inclusive' => true,
    //  )
    //);
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
  wp_enqueue_script( 't3p-customizer', get_template_directory_uri() . '/assets/script/customizer.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 't3p_customize_preview_js' );
