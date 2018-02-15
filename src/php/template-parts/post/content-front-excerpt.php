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

<article id="post-<?php the_ID(); ?>" <?php post_class("front-excerpt"); ?>>
  <div class="post_wrapper">
    <?php
      $day = esc_html( get_the_date( 'd' ) );
      $month = esc_html( get_the_date( 'M' ) );
    ?>
    <div class="datemonth"><span class="date-day"><?php echo $day; ?></span><span class="date-month"><?php echo $month; ?></span></div>

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
  </div>

</article><!-- #post-<?php the_ID(); ?> -->
