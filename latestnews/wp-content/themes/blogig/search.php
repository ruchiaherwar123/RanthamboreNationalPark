<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Blogig
 */

use Blogig\CustomizerDefault as BD;
$search_page_sidebar_layout = BD\blogig_get_customizer_option( 'search_page_sidebar_layout' );
get_header();

if( in_array( $search_page_sidebar_layout, ['left-sidebar','both-sidebar'] )  ) get_sidebar('left');
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'blogig' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
				<div class="blogig_search_page">
					<?php get_search_form(); ?>
				</div>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
if( in_array( $search_page_sidebar_layout, ['right-sidebar','both-sidebar'] )  ) get_sidebar();
get_footer();
