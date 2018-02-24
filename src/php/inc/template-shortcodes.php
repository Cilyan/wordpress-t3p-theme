<?php
/**
 * Additional features available in the editor
 *
 * @package t3p
 */

function block_shortcode( $atts, $content = null ) {
  $a = shortcode_atts( array(
    'image' => '',
    'color' => '',
  ), $atts );
  $style = '';
  $classes = '';

  if ($a['image'] != '') {
    $style .= "background-image: url('" . $a['image'] . "');";
    $classes .= " with-background-cover";
  }

  if ($a['color'] != '') {
    $style .= "background-color: " . $a['color'] . ";";
  }

  $html = '<div class="container block-shortcode">' . do_shortcode($content) . '</div>';

  if ($style != '') {
    $style = 'style="' . $style . '"';
  }
  if ($style != '' || $classes != '') {
    $html = '<div class="fw-container'. $classes . '" ' . $style . '>' . $html . '</div>';
  }

  return $html;
}

add_shortcode( 'block', 'block_shortcode' );

function row_shortcode( $atts, $content = null ) {
  // $a = shortcode_atts( array(
  //   'title' => 'My Title',
  //   'foo' => 123,
  // ), $atts );
   return '<div class="row">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'row', 'row_shortcode' );

function col_shortcode( $atts, $content = null ) {
   return '<div class="col-sm">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'col', 'col_shortcode' );

function rounded_shortcode( $atts, $content = null ) {
   return '<div class="rounded">' . do_shortcode($content) . '</div>';
}

add_shortcode( 'rounded', 'rounded_shortcode' );

 ?>
