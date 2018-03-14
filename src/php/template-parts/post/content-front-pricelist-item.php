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

<?php
  $icon_id = get_post_meta(get_the_ID(), 'trail-icon', true);
  $icon_tag = wp_get_attachment_image($icon_id, array(112, 112), false);
  $price_red = get_post_meta(get_the_ID(), 'trail-pricereduced', true);
  $price_full = get_post_meta(get_the_ID(), 'trail-pricefull', true);
  $price_red_cond = get_post_meta(get_the_ID(), 'trail-pricereducedcond', true);
  $price_full_cond = get_post_meta(get_the_ID(), 'trail-pricefullcond', true);
  $price_single = $price_red != '' ? $price_red : $price_full;
  $price_is_single = $price_red == '' || $price_full == '';
?>

<div class="trail-pricelist-item container-fluid" id="pricelist-<?php the_ID(); ?>">
  <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
    <div class="trail-icon">
      <div class="trail-icon-wrapper"><?php echo $icon_tag; ?></div>
    </div>
    <div class="trail-details">
      <div class="inner-row">
        <div class="trail-title"><h5><?php the_title(); ?></h5></div>
        <?php if (!$price_is_single): ?>
          <div class="trail-pricereduced"><?php echo $price_red; if ($price_red_cond != ''){ echo "<span>".$price_red_cond."</span>";} ?></div>
          <div class="trail-pricefull"><?php echo $price_full; if ($price_full_cond != ''){ echo "<span>".$price_full_cond."</span>";} ?></div>
        <?php else: ?>
          <div class="trail-pricesingle"><?php echo $price_single; ?></div>
        <?php endif; ?>
      </div>
    </div>
  </a>
</div><!-- #pricelist-<?php the_ID(); ?> -->
