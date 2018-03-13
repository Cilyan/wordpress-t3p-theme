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

<article id="post-<?php the_ID(); ?>" <?php post_class("trail-showcase"); ?>>
  <div class="post_wrapper">
    <?php
      $icon_id = get_post_meta(get_the_ID(), 'trail-icon', true);
      $icon_tag = wp_get_attachment_image($icon_id, array(112, 112), false);
      if ($icon_tag != ""):
    ?>
      <div class="trail-icon-container"><?php echo $icon_tag; ?></div>
    <?php endif; ?>

    <div class="post_image">
      <?php if (has_post_thumbnail()): ?>
      <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail(); ?>
      </a>
      <?php endif; ?>
    </div>

    <div class="post_content">
      <h2 class="postitle">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
      </h2>
      <div class="post_meta">
        <?php
          t3p_the_trail_meta('length', 'milestone');
          t3p_the_trail_meta('vertclimb', 'vertclimb');
          t3p_the_trail_meta('itra', 'itra');
        ?>
        <?php if ( get_edit_post_link() ) : ?>
          <div class="meta_edit meta_element">
            <span><?php echo t3p_get_svg( array( 'icon' => 'edit' ) ); ?></span>
            <?php t3p_edit_link(); ?>
          </div>
        <?php endif; ?>
      </div>
      <?php the_excerpt(); ?>
    </div>
  </div>

</article><!-- #post-<?php the_ID(); ?> -->
