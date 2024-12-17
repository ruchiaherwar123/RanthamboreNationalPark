<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Blogig
 */
use Blogig\CustomizerDefault as BD;
$single_sidebar_layout = BD\blogig_get_customizer_option( 'single_sidebar_layout' );
get_header();

if( in_array( $single_sidebar_layout, ['left-sidebar','both-sidebar'] )  ) get_sidebar('left');
?>
	<main id="primary" class="site-main">
		<?php
			echo '<div class="blogig-inner-content-wrap">'; //inner-content-wrap
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'single' );
				endwhile; // End of the loop.
			echo '</div><!-- .blogig-inner-content-wrap -->'; //inner-content-wrap
		?>
	</main><!-- #main -->
<?php
if( in_array( $single_sidebar_layout, ['right-sidebar','both-sidebar'] )  ) get_sidebar();
get_footer();