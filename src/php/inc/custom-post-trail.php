<?php

// Register Custom Post Type
function t3p_trail_create_post_type() {

  $labels = array(
    'name'                  => _x('Trails', 'Post Type General Name', 't3p'),
    'singular_name'         => _x('Trail', 'Post Type Singular Name', 't3p'),
    'menu_name'             => __('Trails', 't3p'),
    'name_admin_bar'        => __('Trail', 't3p'),
    'archives'              => __('Trail Archives', 't3p'),
    'attributes'            => __('Trail Attributes', 't3p'),
    'parent_item_colon'     => __('Parent Trail:', 't3p'),
    'all_items'             => __('All Trails', 't3p'),
    'add_new_item'          => __('Add New Trail', 't3p'),
    'add_new'               => __('Add New', 't3p'),
    'new_item'              => __('New Trail', 't3p'),
    'edit_item'             => __('Edit Trail', 't3p'),
    'update_item'           => __('Update Trail', 't3p'),
    'view_item'             => __('View Trail', 't3p'),
    'view_items'            => __('View Trails', 't3p'),
    'search_items'          => __('Search Trail', 't3p'),
    'not_found'             => __('Trail Not found', 't3p'),
    'not_found_in_trash'    => __('Trail Not found in Trash', 't3p'),
    'insert_into_item'      => __('Insert into trail', 't3p'),
    'uploaded_to_this_item' => __('Uploaded to this trail', 't3p'),
    'items_list'            => __('Trails list', 't3p'),
    'items_list_navigation' => __('Trails list navigation', 't3p'),
    'filter_items_list'     => __('Filter trails list', 't3p'),
  );
  $rewrite = array(
    'slug'                  => 'trail',
    'with_front'            => true,
    'pages'                 => true,
    'feeds'                 => true,
  );
  $args = array(
    'label'                 => __('Trail', 't3p'),
    'description'           => __('A special page to describe a trail', 't3p'),
    'labels'                => $labels,
    'supports'              => array('title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'excerpt'),
    'taxonomies'            => array(),
    'hierarchical'          => true,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 20,
    'menu_icon'             => 'data:image/svg+xml;base64,' . base64_encode(file_get_contents(get_parent_theme_file_path('/inc/trail-icon.svg'))),
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => 'trails',
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'rewrite'               => $rewrite,
    'capability_type'       => 'page',
    'register_meta_box_cb'  => 't3p_trail_add_metaboxes',
  );
  register_post_type('trail', $args);

}

add_action('init', 't3p_trail_create_post_type', 0);

function t3p_trail_add_metaboxes($post) {
  add_meta_box(
    't3p_trail_meta',
    __('Trail Options', 't3p'),
    't3p_trail_add_metaboxes_content',
    null,
    'normal',
    'high'
  );
}

function t3p_trail_add_metaboxes_content($post) {
  wp_nonce_field(basename(__FILE__), 't3p_nonce');
  $stored_meta = get_post_meta($post->ID);

  $icon_upload_link = esc_url(get_upload_iframe_src('image', $post->ID));
  if (isset($stored_meta['trail-icon'])) {
    $icon_url = wp_get_attachment_image_src($stored_meta['trail-icon'][0], array(128, 128));
    $icon_set = is_array($icon_url);
  }
  else {
    $icon_set = false;
  }

  ?>
  <p class="post-attributes-label-wrapper">
    <label for="t3p-meta-trail-length" class="t3p-trail-attributes-label"><?php _e('Icon', 't3p')?></label>
  </p>
  <p class="hide-if-no-js">
    <a id="t3p-trail-icon-set" href="<?php echo $icon_upload_link ?>">
      <?php if ($icon_set) : ?>
          <img src="<?php echo $icon_url[0] ?>" alt="" />
      <?php else:
          _e('Set trail icon', 't3p');
            endif; ?>
    </a>
  </p>
  <p class="hide-if-no-js howto-t3p <?php if (!$icon_set) {echo 'hidden';} ?>" id="t3p-trail-icon-desc">
    <?php _e('Click on icon to change or update.', 't3p') ?>
  </p>
  <p class="hide-if-no-js">
    <a class="delete-custom-img <?php if (!$icon_set) {echo 'hidden';} ?>" id="t3p-trail-icon-remove" href="#"><?php _e('Remove this image', 't3p') ?></a>
  </p>
  <input type="hidden" name="trail-icon" id="t3p-meta-trail-icon" value="<?php if ($icon_set) echo $stored_meta['trail-icon'][0]; else echo "-1"; ?>" />

  <p class="post-attributes-label-wrapper">
    <label for="t3p-meta-trail-length" class="t3p-trail-attributes-label"><?php _e('Length of the trail', 't3p')?></label>
  </p>
  <input type="text" name="trail-length" id="t3p-meta-trail-length" placeholder="<?php _e('50 km', 't3p')?>" value="<?php if (isset ($stored_meta['trail-length'])) echo $stored_meta['trail-length'][0]; ?>" />

  <p class="post-attributes-label-wrapper">
    <label for="t3p-meta-trail-vertclimb" class="t3p-trail-attributes-label"><?php _e('Vertical Climb (D+)', 't3p')?></label>
  </p>
  <input type="text" name="trail-vertclimb" id="t3p-meta-trail-vertclimb" placeholder="<?php _e('1500 m', 't3p')?>" value="<?php if (isset ($stored_meta['trail-vertclimb'])) echo $stored_meta['trail-vertclimb'][0]; ?>" />

  <p class="post-attributes-label-wrapper">
    <label for="t3p-meta-trail-vertdrop" class="t3p-trail-attributes-label"><?php _e('Vertical Drop (D-)', 't3p')?></label>
  </p>
  <input type="text" name="trail-vertdrop" id="t3p-meta-trail-vertdrop" placeholder="<?php _e('1500 m', 't3p')?>" value="<?php if (isset ($stored_meta['trail-vertdrop'])) echo $stored_meta['trail-vertdrop'][0]; ?>" />

  <p class="post-attributes-label-wrapper">
    <label for="t3p-meta-trail-itra" class="t3p-trail-attributes-label"><?php _e('ITRA Points', 't3p')?></label>
  </p>
  <input type="text" name="trail-itra" id="t3p-meta-trail-itra" placeholder="<?php _e('4 points', 't3p')?>" value="<?php if (isset ($stored_meta['trail-itra'])) echo $stored_meta['trail-itra'][0]; ?>" />

  <p class="post-attributes-label-wrapper">
    <label for="t3p-meta-trail-pricereduced" class="t3p-trail-attributes-label"><?php _e('Reduced Price', 't3p')?></label>
  </p>
  <input type="text" name="trail-pricereduced" id="t3p-meta-trail-pricereduced" placeholder="<?php _e('20 £', 't3p')?>" value="<?php if (isset ($stored_meta['trail-pricereduced'])) echo $stored_meta['trail-pricereduced'][0]; ?>" />

  <p class="post-attributes-label-wrapper">
    <label for="t3p-meta-trail-pricefull" class="t3p-trail-attributes-label"><?php _e('Full Price', 't3p')?></label>
  </p>
  <input type="text" name="trail-pricefull" id="t3p-meta-trail-pricefull" placeholder="<?php _e('25 £', 't3p')?>" value="<?php if (isset ($stored_meta['trail-pricefull'])) echo $stored_meta['trail-pricefull'][0]; ?>" />

  <p class="post-attributes-label-wrapper">
    <label for="t3p-meta-trail-displayfront" class="t3p-trail-attributes-label"><?php _e('Display on front page', 't3p')?></label>
  </p>
  <input type="checkbox" name="trail-displayfront" id="t3p-meta-trail-displayfront"  value="yes" <?php if (isset ($stored_meta['trail-displayfront'])) checked($stored_meta['trail-displayfront'][0], 'yes'); ?> /><em><?php _e('If checked, the trail will be displayed as a nice block on the front page', 't3p') ?></em>

  <p class="post-attributes-label-wrapper">
    <label for="t3p-meta-trail-displaypricelist" class="t3p-trail-attributes-label"><?php _e('Display in price list', 't3p')?></label>
  </p>
  <input type="checkbox" name="trail-displaypricelist" id="t3p-meta-trail-displaypricelist"  value="yes" <?php if (isset ($stored_meta['trail-displaypricelist'])) checked($stored_meta['trail-displaypricelist'][0], 'yes'); ?> /><em><?php _e('If checked, the trail will be present in the list next to the "register" button', 't3p') ?></em>

  <p class="post-attributes-label-wrapper">
    <label for="t3p-meta-trail-priority" class="t3p-trail-attributes-label"><?php _e('Priority', 't3p')?></label>
  </p>
  <p class="hide-if-no-js howto-t3p" id="t3p-trail-icon-desc">
    <?php _e('This value orders the trails on the front page. Lower values are presented first.', 't3p') ?>
  </p>
  <input type="text" name="trail-priority" id="t3p-meta-trail-priority" placeholder="0" value="<?php if (isset ($stored_meta['trail-priority'])) echo $stored_meta['trail-priority'][0]; ?>" />

  <?php
}

function t3p_trail_save_metaboxes($post_id) {
  // Checks save status
  $is_autosave = wp_is_post_autosave($post_id);
  $is_revision = wp_is_post_revision($post_id);
  $is_valid_nonce = (isset($_POST['t3p_nonce']) && wp_verify_nonce($_POST['t3p_nonce'], basename(__FILE__))) ? 'true' : 'false';
  $can_edit = current_user_can('edit_page', $post_id);

  // Exits script depending on save status
  if ($is_autosave || $is_revision || !$is_valid_nonce || !$can_edit) {
    return;
  }

  $is_trail = get_post($post_id)->post_type == 'trail';
  if (!$is_trail) {
    return;
  }

  // Checks for input and sanitizes/saves if needed
  if(isset($_POST['trail-icon'])) {
    $icon_id = intval($_POST['trail-icon']);
    if ($icon_id == -1) {
      $is_ok = true;
    }
    else {
      $icon_url = wp_get_attachment_image_src($icon_id, 'full');
      $is_ok = is_array($icon_url);
    }
    if ($is_ok)
    {
      update_post_meta($post_id, 'trail-icon', $icon_id);
    }
  }
  if(isset($_POST['trail-length'])) {
    update_post_meta($post_id, 'trail-length', sanitize_text_field($_POST['trail-length']));
  }
  if(isset($_POST['trail-vertclimb'])) {
    update_post_meta($post_id, 'trail-vertclimb', sanitize_text_field($_POST['trail-vertclimb']));
  }
  if(isset($_POST['trail-vertdrop'])) {
    update_post_meta($post_id, 'trail-vertdrop', sanitize_text_field($_POST['trail-vertdrop']));
  }
  if(isset($_POST['trail-itra'])) {
    update_post_meta($post_id, 'trail-itra', sanitize_text_field($_POST['trail-itra']));
  }
  if(isset($_POST['trail-pricereduced'])) {
    update_post_meta($post_id, 'trail-pricereduced', sanitize_text_field($_POST['trail-pricereduced']));
  }
  if(isset($_POST['trail-pricefull'])) {
    update_post_meta($post_id, 'trail-pricefull', sanitize_text_field($_POST['trail-pricefull']));
  }
  if(isset($_POST['trail-displayfront'])) {
    update_post_meta($post_id, 'trail-displayfront', 'yes');
  }
  else {
    update_post_meta($post_id, 'trail-displayfront', '');
  }
  if(isset($_POST['trail-displaypricelist'])) {
    update_post_meta($post_id, 'trail-displaypricelist', 'yes');
  }
  else {
    update_post_meta($post_id, 'trail-displaypricelist', '');
  }
  if(isset($_POST['trail-priority'])) {
    update_post_meta($post_id, 'trail-priority', intval($_POST['trail-priority']));
  }
}
add_action('save_post', 't3p_trail_save_metaboxes');

function t3p_trail_admin_scripts($hook_suffix) {
  if (get_current_screen()->post_type != 'trail') {
    return;
  }

  wp_enqueue_media();
  wp_register_script('trail_script', get_template_directory_uri() . '/assets/script/admin-trail.js', array('jquery'), null, true);
  wp_localize_script('trail_script', 'trail_icon_params',
    array(
      'title' => __('Choose or Upload an Icon', 't3p'),
      'button' => __('Use this icon', 't3p'),
      'set_icon_text' => __('Set trail icon', 't3p')
    )
 );
  wp_enqueue_script('trail_script');
  wp_enqueue_style('trail_styles', get_template_directory_uri() . '/assets/styles/admin-trail.css');
}
add_action('admin_enqueue_scripts', 't3p_trail_admin_scripts');
