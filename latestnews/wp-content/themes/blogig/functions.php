<?php
/**
 * Blogig functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blogig
 */
use Blogig\CustomizerDefault as BD;
if ( ! defined( 'BLOGIG_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	$theme_info = wp_get_theme();
	define( 'BLOGIG_VERSION', $theme_info->get( 'Version' ) );
}

if ( ! defined( 'BLOGIG_PREFIX' ) ) {
	// Replace the prefix of theme if changed.
	define( 'BLOGIG_PREFIX', 'blogig_' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blogig_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Blogig, use a find and replace
		* to change 'blogig' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'blogig', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'blogig' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'blogig_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Add support for post formats
	add_theme_support( 
		'post-formats', 
		array( 
			'image',
			'gallery',
			'video',
			'audio',
			'quote'
		)
	);

}
add_action( 'after_setup_theme', 'blogig_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blogig_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blogig_content_width', 640 );
}
add_action( 'after_setup_theme', 'blogig_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function blogig_scripts() {
	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
	wp_enqueue_style( 'blogig-typo-fonts', wptt_get_webfont_url( blogig_typo_fonts_url() ), array(), null );
	wp_enqueue_style( 'blogig-style', get_stylesheet_uri(), array(), BLOGIG_VERSION );
	wp_add_inline_style( 'blogig-style', blogig_current_styles() );
	// wp_add_inline_style( 'blogig-style', blogig_custom_styles() );
	wp_enqueue_style( 'blogig-main', get_template_directory_uri() . '/assets/css/main.css', [], BLOGIG_VERSION, 'all' );
	wp_enqueue_style( 'blogig-responsive', get_template_directory_uri() . '/assets/css/responsive.css', [], BLOGIG_VERSION, 'all' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() .'/assets/external/fontawesome/css/all.min.css', [], '6.4.2', 'all' );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() .'/assets/external/magnific-popup/magnific-popup.css', [], '6.4.2', 'all' );
	wp_style_add_data( 'blogig-style', 'rtl', 'replace' );

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/external/slick/slick.min.js', array(), BLOGIG_VERSION, true );
	wp_enqueue_script( 'blogig-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), BLOGIG_VERSION, true );
	wp_enqueue_script( 'blogig-js', get_template_directory_uri() . '/assets/js/theme.js', ['jquery','jquery-masonry'], BLOGIG_VERSION, true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/external/magnific-popup/magnific-popup.js', [], BLOGIG_VERSION, true );
	wp_enqueue_media();

	wp_localize_script( 'blogig-js', 'blogigObject', [
		'isArchive'	=> ( is_archive() || is_home() || ( BD\blogig_get_customizer_option( 'archive_post_layout' ) == 'masonry' ) ),
		'fade'	=> BD\blogig_get_customizer_option( 'main_banner_show_fade' ),
		'autoplaySpeed'	=> 2000,
		'speed'	=> 3000,
		'showArrowOnHover'	=> false,
		'centerMode'	=> BD\blogig_get_customizer_option( 'main_banner_center_mode' ),
		'itemGap'	=> 10,
		'prevIcon'	=> blogig_parse_icon_picker_value( BD\blogig_get_customizer_option( 'main_banner_slider_prev_arrow' ) ),
		'nextIcon'	=> blogig_parse_icon_picker_value( BD\blogig_get_customizer_option( 'main_banner_slider_next_arrow' ) ),
		'carouselSlideToShow'	=> BD\blogig_get_customizer_option( 'carousel_no_of_columns' ),
		'slidesToScroll'	=> BD\blogig_get_customizer_option( 'carousel_slides_to_scroll' ),
		'carouselPrevIcon'	=> blogig_parse_icon_picker_value( BD\blogig_get_customizer_option( 'carousel_slider_prev_arrow' ) ),
		'carouselNextIcon'	=> blogig_parse_icon_picker_value( BD\blogig_get_customizer_option( 'carousel_slider_next_arrow' ) ),
		'themeModeLightIcon'	=>	BD\blogig_get_customizer_option( 'blogig_theme_mode_light_icon' ),
		'themeModeDarkIcon'	=>	BD\blogig_get_customizer_option( 'blogig_theme_mode_dark_icon' ),
		'singleGalleryLightbox'	=>	BD\blogig_get_customizer_option( 'single_gallery_lightbox_option' ),
		'headerSticky'	=>	BD\blogig_get_customizer_option( 'menu_options_sticky_header' ),
		'menuCutoffOption'	=>	BD\blogig_get_customizer_option( 'menu_cutoff_option' ),
		'menuCutoffAfter'	=>	BD\blogig_get_customizer_option( 'menu_cutoff_after' ),
		'menuCutoffText'	=>	BD\blogig_get_customizer_option( 'menu_cutoff_text' )
	]);

	wp_localize_script( 'blogig-navigation', 'blogigNavigatioObject', [
		'menuCutoffOption'	=>	BD\blogig_get_customizer_option( 'menu_cutoff_option' ),
		'menuCutoffAfter'	=>	BD\blogig_get_customizer_option( 'menu_cutoff_after' ),
		'menuCutoffText'	=>	BD\blogig_get_customizer_option( 'menu_cutoff_text' )
	]);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blogig_scripts' );


// include files
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/theme-starter.php'; // theme starter functions.
require get_template_directory() . '/inc/customizer/customizer.php';
include get_template_directory() . '/inc/styles.php';
include get_template_directory() . '/inc/admin/class-theme-info.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if( !function_exists( 'blogig_typo_fonts_url' ) ) :
	/**
	 * Filter and Enqueue typography fonts
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_typo_fonts_url() {
		$filter = BLOGIG_PREFIX . 'typo_combine_filter';
		$action = function( $filter, $id ) {
			return apply_filters(
				$filter,
				$id
			);
		};
		
		// site identity -> site title & tagline
		$site_title_typo_value = $action($filter, 'site_title_typo');
		$site_description_typo_value = $action($filter, 'site_description_typo');
		// typography section
		$heading_one_typo_value = $action($filter, 'heading_one_typo');
		$heading_two_typo_value = $action($filter, 'heading_two_typo');
		$heading_three_typo_value = $action($filter, 'heading_three_typo');
		$heading_four_typo_value = $action($filter, 'heading_four_typo');
		$heading_five_typo_value = $action($filter, 'heading_five_typo');
		$heading_six_typo_value = $action($filter, 'heading_six_typo');
		// widget styles - sidebar typo
		$sidebar_block_title_typography_value = $action($filter, 'sidebar_block_title_typography');
		$sidebar_post_title_typography_value = $action($filter, 'sidebar_post_title_typography');
		$sidebar_category_typography_value = $action($filter, 'sidebar_category_typography');
		$sidebar_date_typography_value = $action($filter, 'sidebar_date_typography');
		// widget styles - heading typo
		$sidebar_heading_one_typography_value = $action($filter, 'sidebar_heading_one_typography');
		$sidebar_heading_two_typo_value = $action($filter, 'sidebar_heading_two_typo');
		$sidebar_heading_three_typo_value = $action($filter, 'sidebar_heading_three_typo');
		$sidebar_heading_four_typo_value = $action($filter, 'sidebar_heading_four_typo');
		$sidebar_heading_five_typo_value = $action($filter, 'sidebar_heading_five_typo');
		$sidebar_heading_six_typo_value = $action($filter, 'sidebar_heading_six_typo');
		// menu options
		$main_menu_typo_value = $action($filter, 'main_menu_typo');
		$main_menu_sub_menu_typo_value = $action($filter, 'main_menu_sub_menu_typo');
		// custom button
		$blogig_custom_button_text_typography_value = $action($filter, 'blogig_custom_button_text_typography');
		// main banner
		$main_banner_design_post_title_typography_value = $action($filter, 'main_banner_design_post_title_typography');
		$main_banner_design_post_excerpt_typography_value = $action($filter, 'main_banner_design_post_excerpt_typography');
		$main_banner_design_post_categories_typography_value = $action($filter, 'main_banner_design_post_categories_typography');
		$main_banner_design_post_date_typography_value = $action($filter, 'main_banner_design_post_date_typography');
		$main_banner_design_post_author_typography_value = $action($filter, 'main_banner_design_post_author_typography');
		// carousel
		$carousel_design_post_title_typography_value = $action($filter, 'carousel_design_post_title_typography');
		$carousel_design_post_excerpt_typography_value = $action($filter, 'carousel_design_post_excerpt_typography');
		$carousel_design_post_categories_typography_value = $action($filter, 'carousel_design_post_categories_typography');
		$carousel_design_post_date_typography_value = $action($filter, 'carousel_design_post_date_typography');
		$carousel_design_post_author_typography_value = $action($filter, 'carousel_design_post_author_typography');
		// Blog / Archives -> General Settings
		$archive_title_typo_value = $action($filter, 'archive_title_typo');
		$archive_excerpt_typo_value = $action($filter, 'archive_excerpt_typo');
		$archive_category_typo_value = $action($filter, 'archive_category_typo');
		$archive_date_typo_value = $action($filter, 'archive_date_typo');
		$archive_author_typo_value = $action($filter, 'archive_author_typo');
		$archive_read_time_typo_value = $action($filter, 'archive_read_time_typo');
		$archive_button_typo_value = $action($filter, 'archive_button_typo');
		// Blog / Archives -> Category page
		$archive_category_info_box_title_typo_value = $action($filter, 'archive_category_info_box_title_typo');
		$archive_category_info_box_description_typo_value = $action($filter, 'archive_category_info_box_description_typo');
		// Blog / Archives -> Tag page
		$archive_tag_info_box_title_typo_value = $action($filter, 'archive_tag_info_box_title_typo');
		$archive_tag_info_box_description_typo_value = $action($filter, 'archive_tag_info_box_description_typo');
		// Blog / Archives -> Author page
		$archive_author_info_box_title_typo_value = $action($filter, 'archive_author_info_box_title_typo');
		$archive_author_info_box_description_typo_value = $action($filter, 'archive_author_info_box_description_typo');
		// single post
		$single_title_typo_value = $action($filter, 'single_title_typo');
		$single_content_typo_value = $action($filter, 'single_content_typo');
		$single_category_typo_value = $action($filter, 'single_category_typo');
		$single_date_typo_value = $action($filter, 'single_date_typo');
		$single_author_typo_value = $action($filter, 'single_author_typo');
		$single_read_time_typo_value = $action($filter, 'single_read_time_typo');
		// page settings -> page settings
		$page_title_typo_value = $action($filter, 'page_title_typo');
		$page_content_typo_value = $action($filter, 'page_content_typo');
		
		$typo1 = "Montserrat:300,400,500,700,900";
		$typo2 = "Poppins:300,400,500,700,900";
		
		$get_fonts = apply_filters( 'blogig_get_fonts_toparse', [ $typo1, $typo2, $site_title_typo_value, $site_description_typo_value, $heading_one_typo_value, $heading_two_typo_value, $heading_three_typo_value, $heading_four_typo_value, $heading_five_typo_value, $heading_six_typo_value, $sidebar_block_title_typography_value, $sidebar_post_title_typography_value, $sidebar_category_typography_value, $sidebar_date_typography_value, $sidebar_heading_one_typography_value, $sidebar_heading_two_typo_value, $sidebar_heading_three_typo_value, $sidebar_heading_four_typo_value, $sidebar_heading_five_typo_value, $sidebar_heading_six_typo_value, $main_menu_typo_value, $main_menu_sub_menu_typo_value, $blogig_custom_button_text_typography_value, $main_banner_design_post_title_typography_value, $main_banner_design_post_excerpt_typography_value, $main_banner_design_post_categories_typography_value, $main_banner_design_post_date_typography_value, $main_banner_design_post_author_typography_value, $carousel_design_post_title_typography_value, $carousel_design_post_excerpt_typography_value, $carousel_design_post_categories_typography_value, $carousel_design_post_date_typography_value, $carousel_design_post_author_typography_value, $archive_title_typo_value, $archive_category_info_box_title_typo_value, $archive_category_info_box_description_typo_value, $archive_tag_info_box_title_typo_value, $archive_tag_info_box_description_typo_value, $archive_author_info_box_title_typo_value, $archive_author_info_box_description_typo_value, $single_title_typo_value, $single_content_typo_value, $single_category_typo_value, $single_date_typo_value, $single_author_typo_value, $single_read_time_typo_value, $page_title_typo_value, $page_content_typo_value ] );
		$font_weight_array = array();

		foreach ( $get_fonts as $fonts ) {
			$each_font = explode( ':', $fonts );
			if ( ! isset ( $font_weight_array[$each_font[0]] ) ) {
				$font_weight_array[$each_font[0]][] = $each_font[1];
			} else {
				if ( ! in_array( $each_font[1], $font_weight_array[$each_font[0]] ) ) {
					$font_weight_array[$each_font[0]][] = $each_font[1];
				}
			}
		}
		$final_font_array = array();
		foreach ( $font_weight_array as $font => $font_weight ) {
			$each_font_string = $font.':'.implode( ',', $font_weight );
			$final_font_array[] = $each_font_string;
		}

		$final_font_string = implode( '|', $final_font_array );
		$google_fonts_url = '';
		$subsets   = 'cyrillic,cyrillic-ext';
		if ( $final_font_string ) {
			$query_args = array(
				'family' => urlencode( $final_font_string ),
				'subset' => urlencode( $subsets )
			);
			$google_fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}
		return $google_fonts_url;
	}
endif;

if( ! function_exists( 'blogig_parse_icon_picker_value' ) ) :
	/**
	 * Function to return image url for icon picker
	 */
	function blogig_parse_icon_picker_value( $control ) {
		if( $control['type'] == 'svg' ) :
			$control['url'] = wp_get_attachment_image_url( $control['value'], 'full' );
		endif;
		return $control;
	}
endif;

if( ! function_exists( 'blogig_set_transient' ) ) :
	/**
	 * Set transient required for theme
	 * 
	 * @package 1.0.0
	 * @since 1.0.0
	 */
	function blogig_set_transient() {
		set_transient( 'blogig_show_review_notice', 'hide', WEEK_IN_SECONDS );
	}
add_action( 'after_switch_theme', 'blogig_set_transient' );
endif;