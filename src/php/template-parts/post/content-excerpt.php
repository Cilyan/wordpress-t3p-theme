<?php
/**
 * Template part for displaying posts as excerpts
 *
 * Used in Search Results and in Index Page (Blog).
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package t3p
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class("excerpt"); ?>>
  <?php if (has_post_thumbnail()): ?>
  <div class="post_image">
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail(); ?>
    </a>
  </div>
  <?php endif; ?>

  <div class="post_content">
    <h2 class="postitle">
      <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
    </h2>
    <div class="post_meta">
      <?php if ( 'post' === get_post_type() && '' != get_the_date() ) : ?>
        <div class="meta_date meta_element">
          <span><?php echo t3p_get_svg( array( 'icon' => 'calendar' ) ); ?></span>
          <a><?php echo get_the_date(); ?></a>
        </div>
      <?php endif; ?>
      <div class="meta_author meta_element">
        <span><?php echo t3p_get_svg( array( 'icon' => 'person' ) ); ?></span>
        <a href="<?php the_author_link(); ?>"><?php the_author(); ?></a>
      </div>
      <?php if ( 'post' === get_post_type() ) : ?>
        <div class="meta_categories meta_element">
          <span class="meta_icon"><?php echo t3p_get_svg( array( 'icon' => 'categories' ) ); ?></span>
          <?php the_category(", ") ?>
        </div>
        <div class="meta_comments meta_element">
          <span><?php echo t3p_get_svg( array( 'icon' => 'comments' ) ); ?></span>
          <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a>
        </div>
      <?php endif; ?>
      <?php if ( get_edit_post_link() ) : ?>
        <div class="meta_edit meta_element">
          <span><?php echo t3p_get_svg( array( 'icon' => 'edit' ) ); ?></span>
          <?php t3p_edit_link(); ?>
        </div>
      <?php endif; ?>
    </div>
    <?php the_excerpt(); ?>
  </div>

  <div class="post_more_link">
    <a href="<?php the_permalink(); ?>"><?php esc_html_e('+ Read More','t3p'); ?></a>
  </div>

</article><!-- #post-<?php the_ID(); ?> -->
