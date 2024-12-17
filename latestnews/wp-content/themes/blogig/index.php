<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogig
 */
use Blogig\CustomizerDefault as BD;
$archive_sidebar_layout = BD\blogig_get_customizer_option( 'archive_sidebar_layout' );
$elementClass = ' archive-align--' . BD\blogig_get_customizer_option('archive_post_elements_alignment');
get_header();

if( in_array( $archive_sidebar_layout, ['left-sidebar','both-sidebar'] )  ) get_sidebar('left');
?>
	<main id="primary" class="site-main">
		<?php
		if ( have_posts() ) :
			if ( is_home() && ! is_front_page() ) :
				?>
				<header class="page-header">
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			$ads_info = blogig_algorithm_to_push_ads_in_archive();
			$count = 0;
			echo '<div class="blogig-inner-content-wrap'. esc_attr( $elementClass ) .'">'; //inner-content-wrap
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();
					if( ! is_null( $ads_info ) ) :
						if( in_array( $wp_query->current_post, $ads_info['random_numbers'] ) ) :
							blogig_random_post_archive_advertisement_part( is_array( $ads_info['ads_to_render'] ) ? $ads_info['ads_to_render'][$count] : $ads_info['ads_to_render'] );
							$count++;
						endif;
					endif;
					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/archive/content', blogig_get_post_format() );
				endwhile;
			echo '</div>'; //  end: blogig-inner-content-wrap

			/**
			 * hook - blogig_pagination_link_hook
			 * 
			 * @package Blogig
			 * @since 1.0.0
			 */
			do_action( 'blogig_pagination_link_hook' );
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
	</main><!-- #main -->

<?php
if( in_array( $archive_sidebar_layout, ['right-sidebar','both-sidebar'] )  ) get_sidebar();
get_footer();