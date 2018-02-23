<?php
/**
 * Additional features available in the editor
 *
 * @package t3p
 */

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

 ?>
