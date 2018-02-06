<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package t3p
 */

?>

	</div><!-- #content -->

  <footer id="colophon" class="site-footer" role="contentinfo" style="background-image: url('<?php t3p_get_footer_background(); ?>')">
    <div class="container">
      <?php
      get_template_part( 'template-parts/footer/footer', 'widgets' );

      if ( has_nav_menu( 'social' ) ) :
      ?>
        <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 't3p' ); ?>">
          <?php
            wp_nav_menu(
              array(
                'theme_location' => 'social',
                'menu_class'     => 'social-links-menu',
                'depth'          => 1,
                'link_before'    => '<span class="screen-reader-text">',
                'link_after'     => '</span>' . t3p_get_svg( array( 'icon' => 'chain' ) ),
              )
            );
          ?>
        </nav><!-- .social-navigation -->
      <?php
      endif;

      get_template_part( 'template-parts/footer/site', 'info' );
      ?>
    </div><!-- .container -->
  </footer><!-- #colophon -->

</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
