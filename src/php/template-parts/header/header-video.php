<?php
/**
 * Displays header video
 *
 * @package t3p
 */

?>
<!-- Page Header -->
<header class="masthead masthead-video" style="background-image: url('<?php header_image(); ?>')">
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
