<?php
/**
 * Displays header video
 *
 * @package t3p
 */

$t3p_main_options = get_option('t3p_main_options');

?>
<!-- Page Header -->
<header class="masthead-video" style="background-image: url('<?php header_image(); ?>')">
  <div class="tv">
    <div class="screen mute" id="tv"></div>
  </div>
  <div class="cover">
    <div class="partners">
      <img src="<?php echo get_template_directory_uri() . "/assets/images/logo-nb.png"; ?>" alt="">
      <img src="<?php echo get_template_directory_uri() . "/assets/images/logo-is.png"; ?>" alt="">
      <img src="<?php echo get_template_directory_uri() . "/assets/images/logo-cd31.png"; ?>" alt="">
      <img src="<?php echo get_template_directory_uri() . "/assets/images/logo-oc.png"; ?>" alt="">
    </div>
    <div class="container main-container">
      <?php
        $header_content_post = get_post( get_theme_mod( 'front_page_header_content' ) );
        $header_content_post_content = $header_content_post->post_content;
        $header_content_post_content = apply_filters('the_content', $header_content_post_content);
        $header_content_post_content = str_replace(']]>', ']]&gt;', $header_content_post_content);
        echo $header_content_post_content;
       ?>
    </div>
  </div>
</header>
<section class="header-counter">
  <div class="container main-container">
    <div class="header-counter-content">
      <div class="counter">
        <?php if ( $t3p_main_options['t3p_main_field_countdown_enabled'] == "yes" ): ?>
          <p class="counter-label" id="counter-label"><?php _e('Start in', 't3p'); ?></p>
          <div id="t3p-counter">
            <p class="counter-element-days"><span id="t3p-counter-days">00</span><span class="counter-element-label"><?php _e('days', 't3p'); ?></span></p>
            <p><span id="t3p-counter-hours">00</span><span class="counter-element-label"><?php _e('hours', 't3p'); ?></span></p>
            <p class="counter-separator">:</p>
            <p><span id="t3p-counter-minutes">00</span><span class="counter-element-label"><?php _e('minutes', 't3p'); ?></span></p>
            <p class="counter-separator">:</p>
            <p><span id="t3p-counter-seconds">00</span><span class="counter-element-label"><?php _e('seconds', 't3p'); ?></span></p>
          </div>
        <?php else: ?>
          <div id="t3p-counter">
            <p><?php echo $t3p_main_options['t3p_main_field_countdown_replacement']; ?></p>
          </div>
        <?php endif; ?>
      </div>
      <div class="register">
        <?php if ( $t3p_main_options['t3p_main_field_register_enabled'] == "yes" ): ?>
          <a href="#subscribe" id="subscribe-link"><?php _e('Register Now', 't3p'); ?></a>
        <?php else: ?>
          <a href="#discover" id="subscribe-link"><?php _e('Discover More', 't3p'); ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
