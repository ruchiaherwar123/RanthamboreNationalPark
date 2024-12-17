<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Blogig
 */
use Blogig\CustomizerDefault as BD;
$error_page_sidebar_layout = BD\blogig_get_customizer_option( 'error_page_sidebar_layout' );
get_header();

if( in_array( $error_page_sidebar_layout, ['left-sidebar','both-sidebar'] )  ) get_sidebar('left');
?>
	<main id="primary" class="site-main">
		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'blogig' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<?php
					$error_page_image = BD\blogig_get_customizer_option( 'error_page_image' );
					if( $error_page_image != 0 ) {
						echo wp_get_attachment_image( $error_page_image, 'full' );
					}
				?>
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'blogig' ); ?></p>
				<div class="back_to_home_btn">
					<a href="<?php echo esc_url( home_url() ); ?>">
						<i class="fa-solid fa-tent-arrow-turn-left"></i><?php echo esc_html__( 'Back To Home', 'blogig' ); ?></a>
				</div>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->
	</main><!-- #main -->

<?php
if( in_array( $error_page_sidebar_layout, ['right-sidebar','both-sidebar'] )  ) get_sidebar();
get_footer();