<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogig
 */
use Blogig\CustomizerDefault as BD;
$page_settings_sidebar_layout = BD\blogig_get_customizer_option( 'page_settings_sidebar_layout' );
get_header();

if( in_array( $page_settings_sidebar_layout, ['left-sidebar','both-sidebar'] )  ) get_sidebar('left');
?>
	<main id="primary" class="site-main">
		<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
		?>
	</main><!-- #main -->
<?php
if( in_array( $page_settings_sidebar_layout, ['right-sidebar','both-sidebar'] )  ) get_sidebar();
get_footer();