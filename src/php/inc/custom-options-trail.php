<?php
/**
 * Declares an administration options page to fill-in settings specific to
 * the T3P management.
 */

/**
 * custom option and settings
 */
function t3p_settings_init()
{
  // register a new setting for "t3p_main" options page
  register_setting(
    't3p_main',
    't3p_main_options',
    [
      'default' => [
        't3p_main_field_date_start' => '2018-07-22',
        't3p_main_field_time_start' => '07:30',
      ],
      'sanitize_callback' => 't3p_main_options_sanitize'
    ]
  );

  // "Dates" section
  add_settings_section(
    't3p_main_section_dates',
    __('Dates', 't3p'),
    't3p_main_section_dates_cb',
    't3p_main'
  );

  // Main date and time of first trail
  add_settings_field(
    't3p_main_field_date_start',
    __('Trail date', 't3p'),
    't3p_main_field_date_start_cb',
    't3p_main',
    't3p_main_section_dates',
    [
      'label_for' => 't3p_main_field_date_start',
      'class' => 't3p_row',
    ]
  );

  add_settings_field(
    't3p_main_field_time_start',
    __('Main trail start time', 't3p'),
    't3p_main_field_time_start_cb',
    't3p_main',
    't3p_main_section_dates',
    [
      'label_for' => 't3p_main_field_time_start',
      'class' => 't3p_row',
    ]
  );
}
add_action('admin_init', 't3p_settings_init');

/**
 * custom option and settings:
 * callback functions
 */

function t3p_main_section_dates_cb($args)
{
  ?>
  <p id="<?php echo esc_attr($args['id']); ?>"><?php esc_html_e( 'Define the main date and time of the trails', 't3p' ); ?></p>
  <?php
}

function t3p_main_field_date_start_cb($args)
{
  // get the value of the setting we've registered with register_setting()
  $options = get_option('t3p_main_options');
  // output the field
  ?>
    <input
      type="text"
      id="<?php echo esc_attr($args['label_for']); ?>"
      name="t3p_main_options[<?php echo esc_attr($args['label_for']); ?>]"
      value="<?php echo $options[ $args['label_for'] ]?>"
    >
 <?php
}

function t3p_main_field_time_start_cb($args)
{
  // get the value of the setting we've registered with register_setting()
  $options = get_option('t3p_main_options');
  // output the field
  ?>
    <input
      type="text"
      id="<?php echo esc_attr($args['label_for']); ?>"
      name="t3p_main_options[<?php echo esc_attr($args['label_for']); ?>]"
      value="<?php echo $options[ $args['label_for'] ]?>"
    >
 <?php
}

/**
 * Include new settings page in the Settings top-level menu
 */
function t3p_options_page()
{
  add_submenu_page(
    'options-general.php',
    __('T3P Options', 't3p'),
    __('T3P Options', 't3p'),
    'manage_options',
    't3p_main',
    't3p_main_options_page_html'
  );
}
add_action('admin_menu', 't3p_options_page');

/**
 * top level menu:
 * callback functions
 */
function t3p_main_options_page_html()
{
  // check user capabilities
  if (! current_user_can('manage_options')) {
    return;
  }

  ?>
    <div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" method="post">
    <?php
      // output security fields for the registered setting "wporg"
      settings_fields('t3p_main');
      // output setting sections and their fields
      // (sections are registered for "wporg", each field is registered to a specific section)
      do_settings_sections('t3p_main');
      // output save settings button
      submit_button('Save Settings');
    ?>
    </form>
    </div>
  <?php
}

function t3p_main_options_sanitize($input) {
  // Fill return array with old values. That way, if a data is not valid, it
  // will not be saved (old value is saved instead)
  $new_input = get_option('t3p_main_options');
  // Loop through the input and sanitize each of the values
  foreach ( $input as $key => $val ) {
    switch ( $key ) {
      case 't3p_main_field_date_start':
        $san_val = sanitize_text_field($val);
        if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $san_val)) {
          $ok = true;
          try {
            $date = new DateTime($san_val);
          } catch (Exception $e) {
            $ok = false;
          }
          if ($ok === true) {
            $new_input[ $key ] = $san_val;
          }
          else {
            add_settings_error(
              't3p_main_field_date_start',
              't3p_main_field_date_start',
              __('Invalid start date', 't3p'),
              'error'
            );
          }
        }
        else {
          add_settings_error(
            't3p_main_field_date_start',
            't3p_main_field_date_start',
            __('Invalid start date format', 't3p'),
            'error'
          );
        }
        break;
      case 't3p_main_field_time_start':
        $san_val = sanitize_text_field($val);
        if (preg_match("/^[0-9]{2}:[0-9]{2}$/", $san_val)) {
          $new_input[ $key ] = $san_val;
        }
        else {
          add_settings_error(
            't3p_main_field_time_start',
            't3p_main_field_time_start',
            __('Invalid start time format', 't3p'),
            'error'
          );
        }
        break;
    }
  }
  return $new_input;
}

function t3p_options_admin_scripts($hook_suffix) {
  if (get_current_screen()->id != 't3p_main') {
    //return;
  }

//  wp_enqueue_media();
  wp_register_script(
    'admin_options_script',
    get_template_directory_uri() . '/assets/script/admin-trail-options.js',
    array('jquery', 'jquery-ui-datepicker'),
    null,
    true
  );
//  wp_localize_script('admin_options_script', 'trail_icon_params',
//    array(
//      'title' => __('Choose or Upload an Icon', 't3p'),
//      'button' => __('Use this icon', 't3p'),
//      'set_icon_text' => __('Set trail icon', 't3p')
//    )
// );
  wp_enqueue_script('admin_options_script');

  $wp_scripts = wp_scripts();
  wp_enqueue_style(
    'jquery-ui-theme-smoothness',
    sprintf(
      '//ajax.googleapis.com/ajax/libs/jqueryui/%s/themes/smoothness/jquery-ui.css', // working for https as well now
      $wp_scripts->registered['jquery-ui-core']->ver
    )
  );
//  wp_enqueue_style('trail_styles', get_template_directory_uri() . '/assets/styles/admin-trail-options.css');
}
add_action('admin_enqueue_scripts', 't3p_options_admin_scripts');
