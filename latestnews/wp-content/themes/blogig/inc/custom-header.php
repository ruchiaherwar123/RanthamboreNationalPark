<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Blogig
 */

use Blogig\CustomizerDefault as BD;
/**
 * Set up the WordPress core custom header feature.
 *
 * @uses blogig_header_style()
 */
function blogig_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'blogig_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '#141414',
				'width'              => 1300,
				'height'             => 180,
				'flex-height'        => true,
				'wp-head-callback'   => 'blogig_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'blogig_custom_header_setup' );

if ( ! function_exists( 'blogig_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see blogig_custom_header_setup().
	 */
	function blogig_header_style() {
		$header_text_color = get_header_textcolor();
		$header_hover_textcolor = BD\blogig_get_customizer_option( 'site_title_hover_textcolor' );
		$site_description_color = BD\blogig_get_customizer_option( 'site_description_color' );

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-header .site-title a {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
			.site-header .site-description {
				color: <?php echo esc_attr( $site_description_color ); ?>;
			}
			.site-header .site-title a:hover {
				color: <?php echo esc_attr( $header_hover_textcolor ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;

if( ! function_exists( 'blogig_site_title_custom_styles' ) ) :
	/**
	 * Generates the custom site title css in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_site_title_custom_styles( $custom_css ) {
		$site_title_custom_css = BD\blogig_get_customizer_option( 'site_title_custom_css' );
		if( ! $site_title_custom_css ) return;
		?>
			<style type="text/css" id="blogig-site-title-custom-css">
				<?php
					echo wp_strip_all_tags( str_replace( '{wrapper}', '.site-branding-section', $site_title_custom_css ) );
				?>
			</style>
		<?php
	}
	add_action('wp_head', 'blogig_site_title_custom_styles');
endif;

if( ! function_exists( 'blogig_social_icons_custom_styles' ) ) :
	/**
	 * Generates the custom social icons css in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_social_icons_custom_styles( $custom_css ) {
		$social_icon_custom_css = BD\blogig_get_customizer_option( 'social_icon_custom_css' );
		if( ! $social_icon_custom_css ) return;
		?>
			<style type="text/css" id="blogig-social-icon-custom-css">
				<?php
					echo wp_strip_all_tags( str_replace( '{wrapper}', '.blogig-social-icon', $social_icon_custom_css ) );
				?>
			</style>
		<?php
	}
	add_action('wp_head', 'blogig_social_icons_custom_styles');
endif;

if( ! function_exists( 'blogig_breadcrumb_custom_styles' ) ) :
	/**
	 * Generates the custom breadcrumb css in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_breadcrumb_custom_styles( $custom_css ) {
		$breadcrumb_custom_css = BD\blogig_get_customizer_option( 'breadcrumb_custom_css' );
		if( ! $breadcrumb_custom_css ) return;
		?>
			<style type="text/css" id="blogig-breadcrumb-custom-css">
				<?php
					echo wp_strip_all_tags( str_replace( '{wrapper}', '.blogig-breadcrumb-wrap', $breadcrumb_custom_css ) );
				?>
			</style>
		<?php
	}
	add_action('wp_head', 'blogig_breadcrumb_custom_styles');
endif;

if( ! function_exists( 'blogig_scroll_to_top_custom_styles' ) ) :
	/**
	 * Generates the custom scroll to top css in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_scroll_to_top_custom_styles( $custom_css ) {
		$scroll_to_top_custom_css = BD\blogig_get_customizer_option( 'scroll_to_top_custom_css' );
		if( ! $scroll_to_top_custom_css ) return;
		?>
			<style type="text/css" id="blogig-scroll-to-top-custom-css">
				<?php
					echo wp_strip_all_tags( str_replace( '{wrapper}', '#blogig-scroll-to-top', $scroll_to_top_custom_css ) );
				?>
			</style>
		<?php
	}
	add_action('wp_head', 'blogig_scroll_to_top_custom_styles');
endif;

if( ! function_exists( 'blogig_header_menu_custom_styles' ) ) :
	/**
	 * Generates the custom header menu css in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_header_menu_custom_styles( $custom_css ) {
		$header_menu_custom_css = BD\blogig_get_customizer_option( 'header_menu_custom_css' );
		if( ! $header_menu_custom_css ) return;
		?>
			<style type="text/css" id="blogig-header-menu-custom-css">
				<?php
					echo wp_strip_all_tags( str_replace( '{wrapper}', '#site-navigation', $header_menu_custom_css ) );
				?>
			</style>
		<?php
	}
	add_action('wp_head', 'blogig_header_menu_custom_styles');
endif;

if( ! function_exists( 'blogig_header_search_custom_styles' ) ) :
	/**
	 * Generates the custom header search css in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_header_search_custom_styles( $custom_css ) {
		$header_search_custom_css = BD\blogig_get_customizer_option( 'header_search_custom_css' );
		if( ! $header_search_custom_css ) return;
		?>
			<style type="text/css" id="blogig-header-search-custom-css">
				<?php
					echo wp_strip_all_tags( str_replace( '{wrapper}', '.search-wrap', $header_search_custom_css ) );
				?>
			</style>
		<?php
	}
	add_action('wp_head', 'blogig_header_search_custom_styles');
endif;

if( ! function_exists( 'blogig_header_custom_button_custom_styles' ) ) :
	/**
	 * Generates the header custom button css in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_header_custom_button_custom_styles( $custom_css ) {
		$header_custom_button_custom_css = BD\blogig_get_customizer_option( 'header_custom_button_custom_css' );
		if( ! $header_custom_button_custom_css ) return;
		?>
			<style type="text/css" id="blogig-header-custom-button-custom-css">
				<?php
					echo wp_strip_all_tags( str_replace( '{wrapper}', '.header-custom-button', $header_custom_button_custom_css ) );
				?>
			</style>
		<?php
	}
	add_action('wp_head', 'blogig_header_custom_button_custom_styles');
endif;

if( ! function_exists( 'blogig_canvas_menu_custom_styles' ) ) :
	/**
	 * Generates the canvas menu css in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_canvas_menu_custom_styles( $custom_css ) {
		$canvas_menu_custom_css = BD\blogig_get_customizer_option( 'canvas_menu_custom_css' );
		if( ! $canvas_menu_custom_css ) return;
		?>
			<style type="text/css" id="blogig-canvas-menu-custom-css">
				<?php
					echo wp_strip_all_tags( str_replace( '{wrapper}', '.blogig-canvas-menu', $canvas_menu_custom_css ) );
				?>
			</style>
		<?php
	}
	add_action('wp_head', 'blogig_canvas_menu_custom_styles');
endif;

if( ! function_exists( 'blogig_main_banner_custom_styles' ) ) :
	/**
	 * Generates the main banner css in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_main_banner_custom_styles( $custom_css ) {
		$main_banner_custom_css = BD\blogig_get_customizer_option( 'main_banner_custom_css' );
		if( ! $main_banner_custom_css ) return;
		?>
			<style type="text/css" id="blogig-main-banner-custom-css">
				<?php
					echo wp_strip_all_tags( str_replace( '{wrapper}', '.blogig-main-banner-section', $main_banner_custom_css ) );
				?>
			</style>
		<?php
	}
	add_action('wp_head', 'blogig_main_banner_custom_styles');
endif;

if( ! function_exists( 'blogig_carousel_custom_styles' ) ) :
	/**
	 * Generates the carousel css in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_carousel_custom_styles( $custom_css ) {
		$carousel_custom_css = BD\blogig_get_customizer_option( 'carousel_custom_css' );
		if( ! $carousel_custom_css ) return;
		?>
			<style type="text/css" id="blogig-carousel-custom-css">
				<?php
					echo wp_strip_all_tags( str_replace( '{wrapper}', '.blogig-carousel-section', $carousel_custom_css ) );
				?>
			</style>
		<?php
	}
	add_action('wp_head', 'blogig_carousel_custom_styles');
endif;

if( ! function_exists( 'blogig_footer_custom_styles' ) ) :
	/**
	 * Generates the footer css in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_footer_custom_styles( $custom_css ) {
		$footer_custom_css = BD\blogig_get_customizer_option( 'footer_custom_css' );
		if( ! $footer_custom_css ) return;
		?>
			<style type="text/css" id="blogig-footer-custom-css">
				<?php
					echo wp_strip_all_tags( str_replace( '{wrapper}', 'footer#colophon', $footer_custom_css ) );
				?>
			</style>
		<?php
	}
	add_action('wp_head', 'blogig_footer_custom_styles');
endif;

if( ! function_exists( 'blogig_bottom_footer_custom_styles' ) ) :
	/**
	 * Generates the bottom footer css in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_bottom_footer_custom_styles( $custom_css ) {
		$bottom_footer_custom_css = BD\blogig_get_customizer_option( 'bottom_footer_custom_css' );
		if( ! $bottom_footer_custom_css ) return;
		?>
			<style type="text/css" id="blogig-bottom-footer-custom-css">
				<?php
					echo wp_strip_all_tags( str_replace( '{wrapper}', '.bottom-footer', $bottom_footer_custom_css ) );
				?>
			</style>
		<?php
	}
	add_action('wp_head', 'blogig_bottom_footer_custom_styles');
endif;