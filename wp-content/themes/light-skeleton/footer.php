<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package light_skeleton
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer ">
		<div class="site-info container">
           Copyright &copy; <?php echo date( Y ); ?> - <?php bloginfo( 'name' ); ?>.
            <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'light-skeleton' ) ); ?>"><?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'light-skeleton' ), 'WordPress' );
			?></a>

        </div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
