<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogig
 */

echo '</div></div></div><!-- #blogig-main-wrap -->';

do_action( 'blogig_before_footer_hook' );
?>
	<footer id="colophon" class="site-footer dark_bk">
		<?php
			/**
			 * Function - blogig_footer_sections_html
			 * 
			 * @since 1.0.0
			 * 
			 */
			blogig_footer_sections_html();
			
			/**
			 * Function - blogig_bottom_footer_sections_html
			 * 
			 * @since 1.0.0
			 * 
			 */
			blogig_bottom_footer_sections_html();
		?>
	</footer><!-- #colophon -->
	<?php
		/**
		* hook - blogig_after_footer_hook
		*
		* @hooked - blogig_scroll_to_top
		*
		*/
		if( has_action( 'blogig_after_footer_hook' ) ) {
			do_action( 'blogig_after_footer_hook' );
		}
	?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
