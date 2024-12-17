<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Blogig
 */
use Blogig\CustomizerDefault as BD;

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blogig_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}
	
	if( is_archive() || is_home() ) {
		$archive_post_layout = BD\blogig_get_customizer_option( 'archive_post_layout' );
		$archive_sidebar_layout = BD\blogig_get_customizer_option( 'archive_sidebar_layout' );
		$archive_post_column = BD\blogig_get_customizer_option( 'archive_post_column' );
		$classes[] = 'archive-desktop-column--' . esc_attr( blogig_convert_number_to_numeric_string( $archive_post_column['desktop'] ) );
		$classes[] = 'archive-tablet-column--' . esc_attr( blogig_convert_number_to_numeric_string( $archive_post_column['tablet'] ) );
		$classes[] = 'archive-mobile-column--' . esc_attr( blogig_convert_number_to_numeric_string( $archive_post_column['smartphone'] ) );
		$classes[] = 'archive--' . esc_attr( $archive_post_layout ) . '-layout';
		$classes[] = 'archive--' . esc_attr( $archive_sidebar_layout );
	}

	if( is_single() ) {
		$single_sidebar_layout = BD\blogig_get_customizer_option( 'single_sidebar_layout' );
		$classes[] = 'single-post--layout-one';
		$classes[] = 'single--' . esc_attr( $single_sidebar_layout );
	}

	if( is_search() ) {
		$search_page_sidebar_layout = BD\blogig_get_customizer_option( 'search_page_sidebar_layout' );
		$archive_post_layout = BD\blogig_get_customizer_option( 'archive_post_layout' );
		$archive_post_column = BD\blogig_get_customizer_option( 'archive_post_column' );
		$classes[] = 'archive-desktop-column--' . esc_attr( blogig_convert_number_to_numeric_string( $archive_post_column['desktop'] ) );
		$classes[] = 'archive-tablet-column--' . esc_attr( blogig_convert_number_to_numeric_string( $archive_post_column['tablet'] ) );
		$classes[] = 'archive-mobile-column--' . esc_attr( blogig_convert_number_to_numeric_string( $archive_post_column['smartphone'] ) );
		$classes[] = 'search-page--' . $search_page_sidebar_layout;
		$classes[] = 'archive--' . esc_attr( $archive_post_layout ) . '-layout';
	}

	if( is_404() ) {
		$error_page_sidebar_layout = BD\blogig_get_customizer_option( 'error_page_sidebar_layout' );
		$classes[] = 'error-page--' . $error_page_sidebar_layout;
	}

	if( is_page() ) {
		$page_settings_sidebar_layout = BD\blogig_get_customizer_option( 'page_settings_sidebar_layout' );
		$classes[] = 'page--' . $page_settings_sidebar_layout;
	}

	$website_layout = BD\blogig_get_customizer_option ('website_layout');
	if( $website_layout ) {
		$classes[] = $website_layout;
	}
	
	$title_hover = BD\blogig_get_customizer_option( 'post_title_hover_effects' );
	$classes[] = 'title-hover--' . esc_attr( $title_hover );

	$image_hover = BD\blogig_get_customizer_option( 'site_image_hover_effects' );
	$classes[] = 'image-hover--' . esc_attr( $image_hover );
	$classes[] = 'blogig-canvas-position--left';

	$global_sidebar_option = BD\blogig_get_customizer_option( 'sidebar_sticky_option' );
	$classes[] = 'blogig-stickey-sidebar--'. esc_attr( $global_sidebar_option ? 'enabled' : 'disabled' );
	$classes[] = ' blogig_font_typography';
	$classes[] = 'blogig-light-mode';

	$site_background_animation = BD\blogig_get_customizer_option( 'site_background_animation' );
	$classes[] = 'background-animation--' . $site_background_animation;

	return $classes;
}
add_filter( 'body_class', 'blogig_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function blogig_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'blogig_pingback_header' );

if( ! function_exists( 'blogig_get_multicheckbox_categories_simple_array' ) ) :
	/**
	 * Return array of categories prepended with "*" key.
	 * 
	 */
	function blogig_get_multicheckbox_categories_simple_array() {
		$categories_list = get_categories(['number'=>6]);
		$cats_array = [];
		foreach( $categories_list as $cat ) :
			$cats_array[] = array( 
				'value'	=> esc_html( $cat->term_id ),
				'label'	=> esc_html(str_replace(array('\'', '"'), '', $cat->name))  . ' (' .absint( $cat->count ). ')'
			);
		endforeach;
		return $cats_array;
	}
endif;

if( ! function_exists( 'blogig_get_multicheckbox_posts_simple_array' ) ) :
	/**
	 * Return array of posts prepended with "*" key.
	 * 
	 */
	function blogig_get_multicheckbox_posts_simple_array() {
		$posts_list = get_posts(array('numberposts'=>6));
		$posts_array = [];
		foreach( $posts_list as $postItem ) :
			$posts_array[] = array( 
				'value'	=> esc_html( $postItem->ID ),
				'label'	=> esc_html(str_replace(array('\'', '"'), '', $postItem->post_title))
			);
		endforeach;
		return $posts_array;
	}
endif;

if( ! function_exists( 'blogig_get_categories_html' ) ) :
	/**
	 * Return categories in <ul> <li> form
	 * 
	 * @since 1.0.0
	 */
	function blogig_get_categories_html() {
		$blogig_categoies = get_categories( [ 'object_ids' => get_the_ID() ] );
		$post_cagtegories_html = '<ul class="post-categories">';
		foreach( $blogig_categoies as $category_key => $category_value ) :
			$post_cagtegories_html .= '<li class="cat-item item-'. ( $category_key + 1 ) .'">'. esc_html( $category_value->name ) .'</li>';
		endforeach;
		$post_cagtegories_html .= '</ul>';
		return $post_cagtegories_html;
	}
endif;

if( ! function_exists( 'blogig_post_order_args' ) ) :
	/**
	 * Return post order args
	 * 
	 * @since 1.0.0
	 */
	function blogig_post_order_args() {
		return [
			'date-desc' =>  esc_html__( 'Newest - Oldest', 'blogig' ),
			'date-asc' =>  esc_html__( 'Oldest - Newest', 'blogig' ),
			'title-asc' =>  esc_html__( 'A - Z', 'blogig' ),
			'title-desc' =>  esc_html__( 'Z - A', 'blogig' ),
			'rand-desc' =>  esc_html__( 'Random', 'blogig' ),
			'modified-desc' =>  esc_html__( 'Newsest - Oldest( modified )', 'blogig' ),
			'modified-asc' =>  esc_html__( 'Oldest - Newest( modified )', 'blogig' ),
			'comment_count-desc' =>  esc_html__( 'Posts with most comments first', 'blogig' ),
			'comment_count-asc' =>  esc_html__( 'Posts with least comments first', 'blogig' )
		];
	}
endif;

if( ! function_exists( 'blogig_get_image_sizes_option_array' ) ) :
	/**
	 * Get list of image sizes
	 * 
	 * @since 1.0.0
	 * @package Blogig
	 */
	function blogig_get_image_sizes_option_array() {
		$image_sizes = get_intermediate_image_sizes();
		foreach( $image_sizes as $image_size ) :
			$sizes[$image_size] = $image_size;
		endforeach;
		return $sizes;
	}
endif;

add_filter( 'get_the_archive_title_prefix', 'blogig_prefix_string' );
function blogig_prefix_string($prefix) {
	return apply_filters( 'blogig_archive_page_title_prefix', false );
}

if( ! function_exists( 'blogig_widget_control_get_tags_options' ) ) :
	/**
	 * @since 1.0.0
	 * @package Blogig
	 */
	function blogig_widget_control_get_tags_options() {
        check_ajax_referer( 'blogig_widget_nonce', 'security' );
        $searchKey = isset( $_POST['search'] ) ? sanitize_text_field( wp_unslash( $_POST['search'] ) ): '';
        $to_exclude = isset( $_POST['exclude'] ) ? sanitize_text_field( wp_unslash( $_POST['exclude'] ) ): '';
        $type = isset( $_POST['type'] ) ? sanitize_text_field( $_POST['type'] ): '';
		if( $type == 'category' ) :
			$posts_list = get_categories( [ 'number' => 4, 'search' => esc_html( $searchKey ), 'exclude' => explode( ',', $to_exclude ) ] );
		elseif( $type == 'tag' ) :
			$posts_list = get_tags( [ 'number' => 4, 'search' => esc_html( $searchKey ), 'exclude' => explode( ',', $to_exclude ) ] );
		elseif( $type == 'user' ):
			$posts_list = new \WP_User_Query([ 'number' => 4, 'search' => esc_html( $searchKey ), 'exclude' => explode( ',', $to_exclude ) ]);
			if( ! empty( $posts_list->get_results() ) ):
				foreach( $posts_list->get_results() as $user ) :
					$user_array[] = [
						'id'	=>	$user->ID,
						'text'	=>	$user->display_name
					];
				endforeach;
				wp_send_json_success( $user_array );
			else:
				wp_send_json_success( '' );
			endif;
		else:
			$posts_query = new \WP_Query([
				'post_type' =>  'post',
				'post_status'=>  'publish',
				'posts_per_page'    =>  6,
				'post__not_in' => explode( ',', $to_exclude ),
				's' => esc_html( $searchKey )
			]);
			if( $posts_query->have_posts() ) :
				while( $posts_query->have_posts() ) :
					$posts_query->the_post();
					$post_array[] =	[
						'id'	=>	get_the_ID(),
						'text'	=>	get_the_title()
					];
				endwhile;
				wp_send_json_success( $post_array );
			endif;
		endif;
		if( ! empty( $posts_list ) ) :
			foreach( $posts_list as $postItem ) :
				$posts_array[] = [	
					'id'	=> esc_html( $postItem->term_taxonomy_id ),
					'text'	=> esc_html( $postItem->name .'('. $postItem->count .')' )
				];
			endforeach;
			wp_send_json_success( $posts_array );
		endif;
        wp_die();
    }
	add_action( 'wp_ajax_blogig_widget_control_get_tags_options', 'blogig_widget_control_get_tags_options' );
	
endif;

if( ! function_exists( 'blogig_customizer_social_icons' ) ) :
	/**
	 * Function to get social icons from customizer
	 * 
	 * @since 1.0.0
	 * @package Blogig
	 */
	function blogig_customizer_social_icons() {
		$social_icons_target = BD\blogig_get_customizer_option( 'social_icons_target' );
		$social_icons = BD\blogig_get_customizer_option( 'social_icons' );
		$social_icons_decode = json_decode( $social_icons );
		echo '<div class="blogig-social-icon">';
			foreach( $social_icons_decode as $social_icon ) :
				if( $social_icon->item_option == 'show' ) echo '<a href="'. esc_url( $social_icon->icon_url ) .'"><i class="'. esc_attr( $social_icon->icon_class ) .'"></i></a>';
			endforeach;
		echo '</div>';
	}
endif;

require get_template_directory() . '/inc/extras/helpers.php';
require get_template_directory() . '/inc/extras/extras.php';
require get_template_directory() . '/inc/widgets/widgets.php'; // widget handlers
require get_template_directory() . '/inc/hooks/hooks.php'; // hooks handlers

/**
 * GEt appropriate color value
 * 
 * @since 1.0.0
 */
if(! function_exists('blogig_get_color_format')):
    function blogig_get_color_format($color) {
      if( str_contains( $color, '--blogig-global-preset' ) ) {
        return( 'var( ' .esc_html( $color ). ' )' );
      } else {
        return $color;
      }
    }
endif;

if( ! function_exists( 'blogig_current_styles' ) ) :
	/**
	 * Generates the current changes in styling of the theme.
	 * 
	 * @package Blogig
	 * @since 1.0.0
	 */
	function blogig_current_styles() {
		// enqueue inline style
		ob_start();
			// preset colors
			$bcPresetCode = function($var,$id) {
				blogig_assign_preset_var($var,$id);
			};
			$bcPresetCode( "--blogig-global-preset-color-1", "preset_color_1" );$bcPresetCode( "--blogig-global-preset-color-2", "preset_color_2" );$bcPresetCode( "--blogig-global-preset-color-3", "preset_color_3" );$bcPresetCode( "--blogig-global-preset-color-4", "preset_color_4" );$bcPresetCode( "--blogig-global-preset-color-5", "preset_color_5" );$bcPresetCode( "--blogig-global-preset-color-6", "preset_color_6" );$bcPresetCode( "--blogig-global-preset-color-7", "preset_color_7" );$bcPresetCode( "--blogig-global-preset-color-8", "preset_color_8" );$bcPresetCode( "--blogig-global-preset-color-9", "preset_color_9" );$bcPresetCode( "--blogig-global-preset-color-10", "preset_color_10" );$bcPresetCode( "--blogig-global-preset-color-11", "preset_color_11" );$bcPresetCode( "--blogig-global-preset-color-12", "preset_color_12" );$bcPresetCode( "--blogig-global-preset-gradient-color-1", "preset_gradient_1" );$bcPresetCode( "--blogig-global-preset-gradient-color-2", "preset_gradient_2" );$bcPresetCode( "--blogig-global-preset-gradient-color-3", "preset_gradient_3" );$bcPresetCode( "--blogig-global-preset-gradient-color-4", "preset_gradient_4" );$bcPresetCode( "--blogig-global-preset-gradient-color-5", "preset_gradient_5" );$bcPresetCode( "--blogig-global-preset-gradient-color-6", "preset_gradient_6" );$bcPresetCode( "--blogig-global-preset-gradient-color-7", "preset_gradient_7" );$bcPresetCode( "--blogig-global-preset-gradient-color-8", "preset_gradient_8" );$bcPresetCode( "--blogig-global-preset-gradient-color-9", "preset_gradient_9" );$bcPresetCode( "--blogig-global-preset-gradient-color-10", "preset_gradient_10" );$bcPresetCode( "--blogig-global-preset-gradient-color-11", "preset_gradient_11" );$bcPresetCode( "--blogig-global-preset-gradient-color-12", "preset_gradient_12" );
			/** Value Change With Responsive **/
			// Logo Width
			blogig_value_change_responsive('body .site-branding img', 'blogig_site_logo_width','width');
			blogig_value_change_responsive('body .bottom-inner-wrapper .footer-logo img', 'bottom_footer_logo_width','width');
			/** Color Group (no Gradient) (Variable) **/
			$bcColorAssign = function($var,$id) {
				blogig_assign_var($var,$id);
			};
			blogig_assign_var('--blogig-global-preset-theme-color','theme_color');
			/** Text Color (Variable) **/
			blogig_variable_color('--blogig-scroll-text-color','stt_color_group');
			blogig_variable_color('--blogig-menu-color', 'header_menu_color');
			blogig_variable_color('--blogig-animation-object-color', 'animation_object_color');
			blogig_variable_color('--blogig-custom-button-color', 'blogig_custom_button_text_color');
			blogig_variable_color('--blogig-custom-button-icon-color', 'blogig_custom_button_icon_color');
			blogig_variable_color_single('--blogig-animation-object-color','animation_object_color');
			/** Background Color (Variable) **/
			blogig_variable_bk_color('--blogig-scroll-top-bk-color','stt_background_color_group');
			
			blogig_initial_bk_color ('body .blogig-you-may-missed-inner-wrap','you_may_have_missed_background_color_group');

			blogig_variable_color_single('--blogig-youmaymissed-block-font-color','you_may_have_missed_title_color');

			// Category Bk Color
			blogig_category_bk_colors_styles();
			blogig_tags_bk_colors_styles();
			/* Typography (Variable) */
			$bTypoCode = function($identifier,$id) {
				blogig_get_typo_style($identifier,$id);
			};
			$bTypoCode( "--blogig-site-title", 'site_title_typo' );
			$bTypoCode( "--blogig-site-description", 'site_description_typo' );
			$bTypoCode("--blogig-menu", 'main_menu_typo');
			$bTypoCode("--blogig-submenu", 'main_menu_sub_menu_typo');
			$bTypoCode("--blogig-custom-button", 'blogig_custom_button_text_typography');
			$bTypoCode("--blogig-post-title-font","archive_title_typo");
			$bTypoCode("--blogig-post-content-font","archive_excerpt_typo");
			$bTypoCode("--blogig-date-font","archive_date_typo");
			$bTypoCode("--blogig-readtime-font","archive_read_time_typo");
			$bTypoCode("--blogig-comment-font","archive_comment_typo");
			$bTypoCode("--blogig-readmore-font","archive_button_typo");
			$bTypoCode("--blogig-category-font","archive_category_typo");
			$bTypoCode("--blogig-author-font","archive_author_typo");
			$bTypoCode("--blogig-widget-block-font","sidebar_block_title_typography");
			$bTypoCode("--blogig-widget-title-font","sidebar_post_title_typography");
			$bTypoCode("--blogig-widget-date-font","sidebar_date_typography");
			$bTypoCode("--blogig-widget-category-font","sidebar_category_typography");
			$bTypoCode("--blogig-author-font", "archive_author_typo");

			$bTypoCode("--blogig-youmaymissed-block-font", "you_may_have_missed_design_section_title_typography");
			$bTypoCode("--blogig-youmaymissed-post-title-font", "you_may_have_missed_design_post_title_typography");

			$bTypoCode("--blogig-youmaymissed-post-category-font", "you_may_have_missed_design_post_categories_typography");
			$bTypoCode("--blogig-youmaymissed-post-author-font", "you_may_have_missed_design_post_author_typography");
			$bTypoCode("--blogig-youmaymissed-post-date-font", "you_may_have_missed_design_post_date_typography");
			/* typo vale change */
			blogig_get_typo_style_value('.blogig-main-banner-section .main-banner-wrap .post-elements .post-title', 'main_banner_design_post_title_typography');
			blogig_get_typo_style_value('.blogig-main-banner-section .post-categories .cat-item a','main_banner_design_post_categories_typography');
			blogig_get_typo_style_value('.blogig-main-banner-section .main-banner-wrap .post-elements .post-excerpt','main_banner_design_post_excerpt_typography');
			blogig_get_typo_style_value('.blogig-main-banner-section .main-banner-wrap .post-elements .post-date','main_banner_design_post_date_typography');
			blogig_get_typo_style_value('.blogig-main-banner-section .main-banner-wrap .byline','main_banner_design_post_author_typography');

			blogig_get_typo_style_value('.blogig-carousel-section .carousel-wrap .post-elements .post-title', 'carousel_design_post_title_typography');
			blogig_get_typo_style_value('.blogig-carousel-section .post-categories .cat-item a','carousel_design_post_categories_typography');
			blogig_get_typo_style_value('.blogig-carousel-section .carousel-wrap .post-elements .post-excerpt','carousel_design_post_excerpt_typography');
			blogig_get_typo_style_value('.blogig-carousel-section .carousel-wrap .post-elements .post-date','carousel_design_post_date_typography');
			blogig_get_typo_style_body_value('body.blogig_font_typography.archive.category .page-header .page-title','archive_category_info_box_title_typo');
			blogig_get_typo_style_body_value('body.blogig_font_typography.archive.category .page-header .archive-description','archive_category_info_box_description_typo');
			blogig_get_typo_style_body_value('body.blogig_font_typography.archive.tag .page-header .page-title','archive_tag_info_box_title_typo');
			blogig_get_typo_style_body_value('body.blogig_font_typography.archive.tag .page-header .archive-description','archive_tag_info_box_description_typo');
			blogig_get_typo_style_body_value('body.blogig_font_typography.archive.author .page-header .page-title','archive_author_info_box_title_typo');
			blogig_get_typo_style_body_value('body.blogig_font_typography.archive.author .page-header .archive-description','archive_author_info_box_description_typo');
			blogig_get_typo_style_body_value('body.single-post.blogig_font_typography .site-main article .entry-title','single_title_typo');
			blogig_get_typo_style_body_value('body.single-post.blogig_font_typography .site-main article .entry-content','single_content_typo');
			blogig_get_typo_style_body_value('body.single-post.blogig_font_typography .site-main article .post-meta-wrap .byline','single_author_typo');
			blogig_get_typo_style_body_value('body.single-post.blogig_font_typography #primary .blogig-inner-content-wrap .post-inner .post-meta .post-date','single_date_typo');
			blogig_get_typo_style_body_value('body.single-post.blogig_font_typography #primary .blogig-inner-content-wrap .post-inner .post-meta  .post-read-time','single_read_time_typo');
			blogig_get_typo_style_body_value('body.single-post.blogig_font_typography #primary .blogig-inner-content-wrap .post-inner .post-meta  .post-comments-num','single_read_time_typo');
			blogig_get_typo_style_body_value('body.single-post.blogig_font_typography #primary article .post-categories .cat-item a','single_category_typo');
			blogig_get_typo_style_body_value('body.page.blogig_font_typography #blogig-main-wrap #primary article .entry-title','page_title_typo');
			blogig_get_typo_style_body_value('body.page-template-default.blogig_font_typography article .entry-content','page_content_typo');



			blogig_get_typo_style_body_value('body article h1','heading_one_typo');
			blogig_get_typo_style_body_value('body article h2','heading_two_typo');
			blogig_get_typo_style_body_value('body article h3','heading_three_typo');
			blogig_get_typo_style_body_value('body article h4','heading_four_typo');
			blogig_get_typo_style_body_value('body article h5','heading_five_typo');
			blogig_get_typo_style_body_value('body article h6','heading_six_typo');
			/* Image Ratio */
			blogig_image_ratio('body .blogig-main-banner-section article.post-item .post-thumb','main_banner_responsive_image_ratio');
			blogig_image_ratio('body .blogig-carousel-section article.post-item .post-thumb','carousel_responsive_image_ratio');
			blogig_image_ratio_variable('--blogig-post-image-ratio','archive_responsive_image_ratio');
			blogig_image_ratio_variable('--blogig-list-post-image-ratio','archive_responsive_image_ratio');
			blogig_image_ratio_variable('--blogig-single-post-image-ratio','single_responsive_image_ratio');
			blogig_image_ratio_variable('--blogig-single-page-image-ratio', 'page_responsive_image_ratio' );

			blogig_image_ratio_variable('--blogig-youmaymissed-image-ratio','you_may_have_missed_responsive_image_ratio');
			/* Main banner background color */
			$background_image = get_theme_mod( 'background_image' );
			if( ! $background_image ) :
				blogig_get_background_style('body.blogig_font_typography:before','site_background_color');
			else:
				echo 'body:before{ display: none; }';
			endif;
			blogig_get_background_style('body.blogig_font_typography .main-header.header-sticky--enabled','site_background_color');
		$current_styles = ob_get_clean();
		return apply_filters( 'blogig_current_styles', wp_strip_all_tags($current_styles) );
	}
endif;

if( ! function_exists( 'blogig_custom_excerpt_more' ) ) :
	/**
	 * Filters the excerpt content
	 * 
	 * @since 1.0.0
	 */
	function blogig_custom_excerpt_more($more) {
		if( is_admin() ) return $more;
		return '';
	}
	add_filter('excerpt_more', 'blogig_custom_excerpt_more');
endif;

if( ! function_exists( 'blogig_random_post_archive_advertisement_part' ) ) :
    /**
     * Blogig main banner element
     * 
     * @since 1.0.0
     */
    function blogig_random_post_archive_advertisement_part( $ads_rendered ) {
        $advertisement_repeater = BD\blogig_get_customizer_option( 'blogig_advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $random_post_archive_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_random_post_archives' ) ) return ( $element->item_checkbox_random_post_archives == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( ! isset( $random_post_archive_advertisement ) || empty( $random_post_archive_advertisement ) ) return;
        $image_option = array_column( $random_post_archive_advertisement, 'item_image_option' );
        $alignment = array_column( $random_post_archive_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
		if( $random_post_archive_advertisement ) :
			?>
				<div class="blogig-advertisement-block <?php echo esc_html( $elementClass ); ?>">
					<a href="<?php echo esc_url( $random_post_archive_advertisement[$ads_rendered]->item_url ); ?>" target="<?php echo esc_attr( $random_post_archive_advertisement[$ads_rendered]->item_target ); ?>" rel="<?php echo esc_attr( $random_post_archive_advertisement[$ads_rendered]->item_rel_attribute ); ?>">
						<img src="<?php echo esc_url( wp_get_attachment_image_url( $random_post_archive_advertisement[$ads_rendered]->item_image, 'full' ) ); ?>">
					</a>
				</div>
			<?php
		endif;
    }
 endif;

 if( ! function_exists( 'blogig_random_post_archive_advertisement_number' ) ) :
    /**
     * Blogig archive ads number
     * 
     * @since 1.0.0
     */
    function blogig_random_post_archive_advertisement_number() {
        $advertisement_repeater = BD\blogig_get_customizer_option( 'blogig_advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $random_post_archive_advertisement = array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_random_post_archives' ) ) return ( $element->item_checkbox_random_post_archives == true && $element->item_option == 'show' ) ? $element : ''; 
        });
        return sizeof( $random_post_archive_advertisement );
    }
 endif;

if( ! function_exists( 'blogig_algorithm_to_push_ads_in_archive' ) ) :
	/**
	 * Algorithm to push ads into archive
	 * 
	 * @since 1.0.0
	 */
	function blogig_algorithm_to_push_ads_in_archive() {
		global $wp_query;
		$archive_ads_number = blogig_random_post_archive_advertisement_number();
		if( $archive_ads_number <= 0 ) return;
		$max_number_of_pages = absint( $wp_query->max_num_pages );
		$paged = absint( ( get_query_var( 'paged' ) == 0 ) ? 0 : ( get_query_var( 'paged' ) - 1 ) );
		$count = 1;
		$ads_id = 0;
		$loop_var = 0;
		for( $i = $archive_ads_number ; $i > 0; $i-- ) :
			if( $count <= $max_number_of_pages ):
				$ads_to_render_in_a_single_page = ceil( $i / $max_number_of_pages );
				$ads_to_render_by_page[] = ceil( $i / $max_number_of_pages );
				$ads_to_render = [];
				if( $ads_to_render_in_a_single_page > 1 ) :
					$to_loop = $ads_id + $ads_to_render_in_a_single_page;
					for( $j = $ads_id; $j < $to_loop; $j++ ) :
						if( ! in_array( $ads_id, $ads_to_render ) ) $ads_to_render[] = $ads_id;
						$ads_id++;
					endfor;
					$ads_to_render_in_current_page[$loop_var] = $ads_to_render;
				else:
					$ads_to_render_in_current_page[$loop_var] = $ads_id;
					$ads_id++;
				endif;
				$count++;
				$loop_var++;
			endif;
		endfor;
		$current_page_count = absint( $wp_query->post_count );
		$ads_of_current_page = $ads_to_render_in_current_page[$paged];
		$ads_count = is_array( $ads_of_current_page ) ? sizeof( $ads_of_current_page ) : 1;
		$random_numbers = [];
		for( $i = 0; $i < $ads_count; $i++ ) :
			if( ! in_array( $i, $random_numbers ) ) :
				$random_numbers[] = rand( 0, ( $current_page_count - 1 ) );
			else:
				$random_numbers[] = rand( 0, ( $current_page_count - 1 ) );
			endif;
		endfor;
		return [
			'random_numbers'	=>	$random_numbers,
			'ads_to_render'	=>	$ads_of_current_page
		];
	}
 endif;