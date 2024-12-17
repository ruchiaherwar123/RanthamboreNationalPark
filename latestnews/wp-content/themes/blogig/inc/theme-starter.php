<?php
/**
 * INcludes theme defaults and starter functions
 * 
 * @package Blogig
 * @since 1.0.0
 */
namespace Blogig\CustomizerDefault;

if( ! function_exists( 'blogig_get_customizer_option' ) ) :
    /**
     * Gets customizer "theme mod" value
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_get_customizer_option( $control_id ) {
        return get_theme_mod( $control_id, blogig_get_customizer_default( $control_id ) );
    }
endif;

if( !function_exists( 'blogig_get_multiselect_tab_option' ) ) :
    /**
     * Gets customizer "multiselect combine tab" value
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_get_multiselect_tab_option( $key ) {
        $value = blogig_get_customizer_option( $key );
        if( !$value["desktop"] && !$value["tablet"] && !$value["mobile"] ) return apply_filters( "blogig_get_multiselect_tab_option", false );
        return apply_filters( "blogig_get_multiselect_tab_option", true );
    }
 endif;

if( !function_exists( 'blogig_get_customizer_default' ) ) :
    /**
     * Gets customizer "theme_mods" value
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_get_customizer_default($key) {
        $array_defaults = apply_filters( 'blogig_get_customizer_defaults', [
            'theme_color'   => '#3858E9',
            'gradient_theme_color'   => 'linear-gradient(135deg,#f9f9f9 0,#f0f0f0 100%)',
            'site_background_color'  => json_encode(array(
                'type'  => 'gradient',
                'solid' => '#F0F1F2',
                'gradient'  => 'linear-gradient(130deg, #f9f9f9 0%, #f0f0f0 100%)'
            )),
            'site_background_animation' =>  'two',
            'animation_object_color' => '--blogig-global-preset-theme-color',
            'preset_color_1'    => '#64748b',
            'preset_color_2'    => '#27272a',
            'preset_color_3'    => '#ef4444',
            'preset_color_4'    => '#eab308',
            'preset_color_5'    => '#84cc16',
            'preset_color_6'    => '#22c55e',
            'preset_color_7'    => '#06b6d4',
            'preset_color_8'    => '#0284c7',
            'preset_color_9'    => '#6366f1',
            'preset_color_10'    => '#84cc16',
            'preset_color_11'    => '#a855f7',
            'preset_color_12'    => '#f43f5e',
            'preset_gradient_1'   => 'linear-gradient( 135deg, #62cff4 10%, #2c67f2 100%)',
            'preset_gradient_2' => 'linear-gradient( 135deg, #FF512F 10%, #F09819 100%)',
            'preset_gradient_3'  => 'linear-gradient( 135deg, #00416A 10%, #E4E5E6 100%)',
            'preset_gradient_4'   => 'linear-gradient( 135deg, #CE9FFC 10%, #7367F0 100%)',
            'preset_gradient_5' => 'linear-gradient( 135deg, #90F7EC 10%, #32CCBC 100%)',
            'preset_gradient_6'  => 'linear-gradient( 135deg, #81FBB8 10%, #28C76F 100%)',
            'preset_gradient_7'   => 'linear-gradient( 135deg, #EB3349 10%, #F45C43 100%)',
            'preset_gradient_8' => 'linear-gradient( 135deg, #FFF720 10%, #3CD500 100%)',
            'preset_gradient_9'  => 'linear-gradient( 135deg, #FF96F9 10%, #C32BAC 100%)',
            'preset_gradient_10'   => 'linear-gradient( 135deg, #69FF97 10%, #00E4FF 100%)',
            'preset_gradient_11' => 'linear-gradient( 135deg, #3C8CE7 10%, #00EAFF 100%)',
            'preset_gradient_12'  => 'linear-gradient( 135deg, #FF7AF5 10%, #513162 100%)',
            'sub_menu_mobile_option'    => true,
            'scroll_to_top_mobile_option'    => false,
            'show_custom_button_text_mobile_option'  =>  false,
            'show_readmore_button_mobile_option'  =>  false,
            'show_background_animation_on_mobile'  =>  false,
            'website_layout'    => 'full-width--layout',
            'social_icons_target' => '_blank',
            'social_icons' => json_encode(array(
                array(
                    'icon_class'    => 'fab fa-facebook-f',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ),
                array(
                    'icon_class'    => 'fab fa-instagram',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ),
                array(
                    'icon_class'    => 'fa-brands fa-x-twitter',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                ),
                array(
                    'icon_class'    => 'fab fa-youtube',
                    'icon_url'      => '',
                    'item_option'   => 'show'
                )
            )),
            'blogig_scroll_to_top_option' =>  true,
            'stt_text'  =>  esc_html__( '', 'blogig' ),
            'stt_icon'  =>  [
                'type'  =>  'icon',
                'value' =>  'fas fa-angle-up'
            ],
            'stt_alignment' => 'right',
            'stt_color_group' => array( 'color'   => "#fff", 'hover'   => "#fff" ),
            'stt_background_color_group' => json_encode([
                'initial'   => [
                    'type'  => 'solid',
                    'solid' => '#333333',
                    'gradient'  => null
                ],
                'hover'   => [
                    'type'  => 'solid',
                    'solid' => '#222222',
                    'gradient'  => null
                ]
            ]),
            'sidebar_sticky_option' =>  false,
            'preloader_option'  => false,
            'post_title_hover_effects'  => 'one',
            'site_image_hover_effects'  => 'one',
            'site_breadcrumb_option'    => true,
            'site_breadcrumb_type'  => 'default',
            'site_schema_ready' => true,
            'site_schema_ready' => true,
            'site_date_format'  => 'theme_format',
            'site_date_to_show' => 'published',
            'blogig_disable_admin_notices'   => false,

            'site_title_hover_textcolor'=> '#141414',
            'site_description_color'    => '#242424',
            'site_title_tag_for_frontpage'  =>  'h1',
            'site_title_tag_for_innerpage'  =>  'h2',
            'main_banner_option'    => false,
            'main_banner_slider_categories' => '[]',
            'main_banner_slider_posts_to_include' => '[]',
            'site_title_typo'   =>  [
                'font_family'   => [ 'value' => 'EB Garamond', 'label' => 'EB Garamond' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700' ],
                'font_size'   => [
                    'desktop' => 38,
                    'tablet' => 38,
                    'smartphone' => 35
                ],
                'line_height'   => array(
                    'desktop' => 45,
                    'tablet' => 45,
                    'smartphone' => 40,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'site_description_typo'   =>  [
                'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Normal 400' ],
                'font_size'   => [
                    'desktop' => 16,
                    'tablet' => 16,
                    'smartphone' => 16
                ],
                'line_height'   => array(
                    'desktop' => 22,
                    'tablet' => 22,
                    'smartphone' => 22,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0,
                    'tablet' => 0,
                    'smartphone' => 0
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'blogig_header_custom_button_option'  =>  true,
            'blogig_custom_button_label'  =>  esc_html__( 'Subscribe', 'blogig' ),
            'blogig_custom_button_icon' => [
                'type'  =>  'icon',
                'value' =>  'fas fa-bell'
            ],
            'blogig_custom_button_redirect_href_link' =>  home_url(),
            'blogig_custom_button_target' =>  '_self',
            'blogig_custom_button_text_typography' =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 14,
                    'tablet' => 14,
                    'smartphone' => 14
                ],
                'line_height'   => array(
                    'desktop' => 22,
                    'tablet' => 22,
                    'smartphone' => 22,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'blogig_custom_button_text_color' =>  [ 'color'   => "#ffffff", 'hover'   => "#ffffff" ],
            'blogig_custom_button_icon_color' =>  [ 'color'   => "#ffffff", 'hover'   => "#ffffff" ],
            'blogig_header_live_search_option'    =>  true,
            'blogig_header_subscribe_option'  =>  true,
            'blogig_subscribe_redirect_href_link' =>  '',
            'blogig_subscribe_button_color_group' =>  [ 'color'   => "#ffffff", 'hover'   => "#ffffff" ],
            'blogig_theme_mode_option'    =>  true,
            'blogig_theme_mode_dark_icon'    =>  [
                'type'  =>  'icon',
                'value' =>  'fas fa-moon'
            ],
            'blogig_theme_mode_light_icon'    =>  [
                'type'  =>  'icon',
                'value' =>  'fas fa-sun'
            ],
            'menu_options_menu_alignment'   =>  'center',
            'menu_cutoff_option'    => true,
            'menu_cutoff_after'   =>  7,
            'menu_cutoff_text'   =>  esc_html__( 'More', 'blogig' ),
            'menu_options_sticky_header'    =>  false,
            'blogig_header_menu_hover_effect' =>  'one',
            'main_menu_typo'  =>  [
                'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Normal 500' ],
                'font_size'   => [
                    'desktop' => 16,
                    'tablet' => 16,
                    'smartphone' => 16
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'main_menu_sub_menu_typo'  =>  [
                'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Normal 500' ],
                'font_size'   => [
                    'desktop' => 15,
                    'tablet' => 15,
                    'smartphone' => 15
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'header_menu_color'    =>   [ 'color' => '#333333', 'hover' => '#333333' ],
            'header_menu_top_border'    => [ "type"  => "solid", "width"   => "1", "color"   => "#213FD4" ],
            'header_menu_background_color_group' => json_encode([
                'type'  => 'solid',
                'solid' => null,
                'gradient'  => null
            ]),
            'archive_pagination_type'   => 'number',
            'archive_post_column'    => [
                'desktop'   => 1,
                'tablet'    => 1,
                'smartphone'    => 1
            ],
            'archive_post_layout'   => 'list',
            'archive_sidebar_layout'=> 'right-sidebar',
            'archive_post_elements_alignment'=> 'center',
            'archive_title_option'  => true,
            'archive_title_tag'  => 'h2',
            'archive_excerpt_option'  => true,
            'archive_category_option'  => true,
            'archive_date_option'  => true,
            'archive_date_icon'  => [
                'type'  => 'icon',
                'value' => 'far fa-calendar'
            ],
            'archive_read_time_option'  => true,
            'archive_read_time_icon'  => [
                'type'  => 'icon',
                'value' => 'fas fa-fire-flame-curved'
            ],
            'archive_comments_option'  => true,
            'archive_comments_icon'  => [
                'type'  => 'icon',
                'value' => 'far fa-comment'
            ],
            'archive_author_option'  => true,
            'archive_button_option'  => true,
            'archive_button_text'   => esc_html__( 'Read More', 'blogig' ),
            'archive_button_icon'  => [
                'type'  => 'icon',
                'value' => 'fas fa-chevron-right'
            ],
            'archive_image_size'  =>  'large',
            'archive_responsive_image_ratio'    =>  [
                'desktop'   => 0.65,
                'tablet'    => 0.65,
                'smartphone'    => 0.8
            ],
            'archive_title_typo'  => [
                'font_family'   => [ 'value' => 'EB Garamond', 'label' => 'EB Garamond' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 25,
                    'tablet' => 23,
                    'smartphone' => 23
                ],
                'line_height'   => array(
                    'desktop' => 30,
                    'tablet' => 30,
                    'smartphone' => 30,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'archive_excerpt_typo'  => [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Normal 400' ],
                'font_size'   => [
                    'desktop' => 14,
                    'tablet' => 14,
                    'smartphone' => 14
                ],
                'line_height'   => array(
                    'desktop' => 22,
                    'tablet' => 22,
                    'smartphone' => 22,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'archive_category_typo'  => [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 12,
                    'tablet' => 12,
                    'smartphone' => 12
                ],
                'line_height'   => array(
                    'desktop' => 18,
                    'tablet' => 18,
                    'smartphone' => 18,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.1,
                    'tablet' => 0.1,
                    'smartphone' => 0.1
                ),
                'text_transform'    => 'capitalize',
                'text_decoration'    => 'none'
            ],
            'archive_date_typo'  => [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Normal 500' ],
                'font_size'   => [
                    'desktop' => 13,
                    'tablet' => 13,
                    'smartphone' => 13
                ],
                'line_height'   => array(
                    'desktop' => 20,
                    'tablet' => 20,
                    'smartphone' => 20,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.2,
                    'tablet' => 0.2,
                    'smartphone' => 0.2
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'archive_author_typo'  => [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Normal 500' ],
                'font_size'   => [
                    'desktop' => 13,
                    'tablet' => 13,
                    'smartphone' => 13
                ],
                'line_height'   => array(
                    'desktop' => 20,
                    'tablet' => 20,
                    'smartphone' => 20,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'capitalize',
                'text_decoration'    => 'none'
            ],
            'archive_read_time_typo'  => [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Normal 400' ],
                'font_size'   => [
                    'desktop' => 13,
                    'tablet' => 13,
                    'smartphone' => 13
                ],
                'line_height'   => array(
                    'desktop' => 18,
                    'tablet' => 18,
                    'smartphone' => 18,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'archive_comment_typo'  => [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Normal 400' ],
                'font_size'   => [
                    'desktop' => 13,
                    'tablet' => 13,
                    'smartphone' => 13
                ],
                'line_height'   => array(
                    'desktop' => 20,
                    'tablet' => 20,
                    'smartphone' => 20,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'archive_button_typo'  => [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 13,
                    'tablet' => 13,
                    'smartphone' => 13
                ],
                'line_height'   => array(
                    'desktop' => 20,
                    'tablet' => 20,
                    'smartphone' => 20,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'capitalize',
                'text_decoration'    => 'none'
            ],
            'archive_category_info_box_option'  => true,
            'archive_category_info_box_icon'  => [
                'type'  => 'icon',
                'value' => 'fas fa-layer-group'
            ],
            'archive_category_info_box_title_typo'    => [
                'font_family'   => [ 'value' => 'EB Garamond', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 30,
                    'tablet' => 30,
                    'smartphone' => 30
                ],
                'line_height'   => array(
                    'desktop' => 33,
                    'tablet' => 33,
                    'smartphone' => 33,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'archive_category_info_box_description_typo'    => [
                'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Normal 400' ],
                'font_size'   => [
                    'desktop' => 16,
                    'tablet' => 16,
                    'smartphone' => 16
                ],
                'line_height'   => array(
                    'desktop' => 30,
                    'tablet' => 30,
                    'smartphone' => 30,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'archive_tag_info_box_option'  => true,
            'archive_tag_info_box_icon'  => [
                'type'  => 'icon',
                'value' => 'fas fa-tag'
            ],
            'archive_tag_info_box_title_typo'    => [
                'font_family'   => [ 'value' => 'EB Garamond', 'label' => 'EB Garamond' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'Bold 600' ],
                'font_size'   => [
                    'desktop' => 30,
                    'tablet' => 30,
                    'smartphone' => 30
                ],
                'line_height'   => array(
                    'desktop' => 33,
                    'tablet' => 33,
                    'smartphone' => 33,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'archive_tag_info_box_description_typo'    => [
                'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Normal 400' ],
                'font_size'   => [
                    'desktop' => 16,
                    'tablet' => 16,
                    'smartphone' => 16
                ],
                'line_height'   => array(
                    'desktop' => 30,
                    'tablet' => 30,
                    'smartphone' => 30,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'archive_author_info_box_option'  => true,
            'archive_author_info_box_title_typo'    => [
                'font_family'   => [ 'value' => 'EB Garamond', 'label' => 'EB Garamond' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'Bold 600' ],
                'font_size'   => [
                    'desktop' => 30,
                    'tablet' => 30,
                    'smartphone' => 30
                ],
                'line_height'   => array(
                    'desktop' => 33,
                    'tablet' => 33,
                    'smartphone' => 33,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'uppercase',
                'text_decoration'    => 'none'
            ],
            'archive_author_info_box_description_typo'    => [
                'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Normal 400' ],
                'font_size'   => [
                    'desktop' => 16,
                    'tablet' => 16,
                    'smartphone' => 16
                ],
                'line_height'   => array(
                    'desktop' => 30,
                    'tablet' => 30,
                    'smartphone' => 30,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'single_sidebar_layout'=> 'right-sidebar',
            'single_post_elements_alignment'=> 'center',
            'single_title_tag'  => 'h2',
            'single_date_icon'  => [
                'type'  => 'icon',
                'value' => 'far fa-calendar'
            ],
            'single_read_time_icon'  => [
                'type'  => 'icon',
                'value' => 'fas fa-fire-flame-curved'
            ],
            'single_comments_icon'  => [
                'type'  => 'icon',
                'value' => 'far fa-comment'
            ],
            'single_gallery_lightbox_option'  => true,
            'single_image_size'  =>  'large',
            'single_responsive_image_ratio'    =>  [
                'desktop'   => 0.55,
                'tablet'    => 0.55,
                'smartphone'    => 0.55
            ],
            'single_post_related_posts_option'  => true,
            'single_post_related_posts_title'   => esc_html__( 'Related Articles', 'blogig' ),
            'single_title_typo'  => [
                'font_family'   => [ 'value' => 'EB Garamond', 'label' => 'EB Garamond' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700' ],
                'font_size'   => [
                    'desktop' => 25,
                    'tablet' => 25,
                    'smartphone' => 25
                ],
                'line_height'   => array(
                    'desktop' => 34,
                    'tablet' => 34,
                    'smartphone' => 34,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'single_content_typo'  => [
                'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Bold 400' ],
                'font_size'   => [
                    'desktop' => 16,
                    'tablet' => 16,
                    'smartphone' => 16
                ],
                'line_height'   => array(
                    'desktop' => 34,
                    'tablet' => 34,
                    'smartphone' => 34,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'single_category_typo'  => [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 15,
                    'tablet' => 15,
                    'smartphone' => 15
                ],
                'line_height'   => array(
                    'desktop' => 22,
                    'tablet' => 22,
                    'smartphone' => 22,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.5,
                    'tablet' => 0.5,
                    'smartphone' => 0.5
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'single_date_typo'  => [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 15,
                    'tablet' => 15,
                    'smartphone' => 15
                ],
                'line_height'   => array(
                    'desktop' => 20,
                    'tablet' => 20,
                    'smartphone' => 20,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'single_author_typo'  => [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 15,
                    'tablet' => 15,
                    'smartphone' => 15
                ],
                'line_height'   => array(
                    'desktop' => 22,
                    'tablet' => 22,
                    'smartphone' => 22,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'single_read_time_typo'  => [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 15,
                    'tablet' => 15,
                    'smartphone' => 15
                ],
                'line_height'   => array(
                    'desktop' => 22,
                    'tablet' => 22,
                    'smartphone' => 22,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'page_settings_sidebar_layout'  =>  'right-sidebar',
            'page_title_tag'  => 'h1',
            'page_image_size'  =>  'large',
            'page_responsive_image_ratio'    =>  [
                'desktop'   => 0.55,
                'tablet'    => 0.55,
                'smartphone'    => 0.55
            ],
            'page_title_typo'  => [
                'font_family'   => [ 'value' => 'EB Garamond', 'label' => 'EB Garamond' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'Bold 600' ],
                'font_size'   => [
                    'desktop' => 34,
                    'tablet' => 34,
                    'smartphone' => 34
                ],
                'line_height'   => array(
                    'desktop' => 45,
                    'tablet' => 45,
                    'smartphone' => 45,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'page_content_typo'  => [
                'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Normal 400' ],
                'font_size'   => [
                    'desktop' => 16,
                    'tablet' => 16,
                    'smartphone' => 16
                ],
                'line_height'   => array(
                    'desktop' => 34,
                    'tablet' => 34,
                    'smartphone' => 34,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'blogig_header_menu_typography'   =>  [
                'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 45,
                    'tablet' => 43,
                    'smartphone' => 40
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0,
                    'tablet' => 0,
                    'smartphone' => 0
                ),
                'text_transform'    => 'uppercase',
                'text_decoration'    => 'none'
            ],
            'blogig_site_logo_width'  =>  [
                'desktop'   => 230,
                'tablet'    => 200,
                'smartphone'    => 200
            ],
            'blogig_custom_button_icon_prefix_suffix' =>  'prefix',
            'canvas_menu_enable_disable_option' =>  false,
            'canvas_menu_icon_picker'   =>  [
                'type'  =>  'icon',
                'value' =>  'fa-solid fa-align-right'
            ],
            'main_banner_option'    => false,
            'main_banner_render_in' =>  'front_page',
            'main_banner_no_of_posts_to_show'   =>  4,
            'main_banner_hide_post_with_no_featured_image'  =>  false,
            'main_banner_post_order'    =>  'date-desc',
            'main_banner_slider_prev_arrow'   =>  [
                'type'  =>  'icon',
                'value' =>  'fa-solid fa-arrow-left-long'
            ],
            'main_banner_slider_next_arrow'   =>  [
                'type'  =>  'icon',
                'value' =>  'fa-solid fa-arrow-right-long'
            ],
            'main_banner_show_fade' =>  true,
            'main_banner_center_mode'   =>  false,
            'main_banner_post_elements_show_title'  =>  true,
            'main_banner_post_elements_show_categories'  =>  true,
            'main_banner_post_elements_show_date'  =>  false,
            'main_banner_post_elements_show_author'  =>  false,
            'main_banner_date_icon' =>  [
                'type'  =>  'icon',
                'value' =>  'fas fa-calendar'
            ],
            'main_banner_post_elements_alignment'  =>  'center',
            'main_banner_image_sizes'  =>  'large',
            'main_banner_responsive_image_ratio'    =>  [
                'desktop'   => 0.42,
                'tablet'    => 0.8,
                'smartphone'    => 0.9
            ],
            'main_banner_design_post_title_typography'  =>  [
                'font_family'   => [ 'value' => 'EB Garamond', 'label' => 'EB Garamond' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'Bold 600' ],
                'font_size'   => [
                    'desktop' => 34,
                    'tablet' => 28,
                    'smartphone' => 22
                ],
                'line_height'   => array(
                    'desktop' => 50,
                    'tablet' => 36,
                    'smartphone' => 30,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'main_banner_design_post_title_html_tag'    =>  'h2',
            'main_banner_design_post_categories_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Bold 400' ],
                'font_size'   => [
                    'desktop' => 13,
                    'tablet' => 13,
                    'smartphone' => 13
                ],
                'line_height'   => array(
                    'desktop' => 20,
                    'tablet' => 20,
                    'smartphone' => 20,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0,
                    'tablet' => 0,
                    'smartphone' => 0
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'main_banner_design_post_date_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 14,
                    'tablet' => 14,
                    'smartphone' => 14
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'main_banner_design_post_author_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 14,
                    'tablet' => 14,
                    'smartphone' => 14
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'main_banner_design_post_excerpt_typography'  =>  [
                'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Normal 400' ],
                'font_size'   => [
                    'desktop' => 15,
                    'tablet' => 15,
                    'smartphone' => 15
                ],
                'line_height'   => array(
                    'desktop' => 27,
                    'tablet' => 27,
                    'smartphone' => 27,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'carousel_option'    => true,
            'carousel_render_in'    =>  'front_page',
            'carousel_no_of_columns'    =>  3,
            'carousel_slider_categories' => '[]',
            'carousel_slider_posts_to_include' => '[]',
            'carousel_no_of_posts_to_show'   =>  5,
            'carousel_hide_post_with_no_featured_image'  =>  false,
            'carousel_post_order'    =>  'date-desc',
            'carousel_slider_prev_arrow'   =>  [
                'type'  =>  'icon',
                'value' =>  'fa-solid fa-arrow-left-long'
            ],
            'carousel_slider_next_arrow'   =>  [
                'type'  =>  'icon',
                'value' =>  'fa-solid fa-arrow-right-long'
            ],
            'carousel_slides_to_scroll'    =>  1,
            'carousel_post_elements_show_title'  =>  true,
            'carousel_post_elements_show_categories'  =>  true,
            'carousel_post_elements_show_date'  =>  false,
            'carousel_post_elements_show_author'  =>  false,
            'carousel_date_icon' =>  [
                'type'  =>  'icon',
                'value' =>  'fas fa-calendar'
            ],
            'carousel_post_elements_alignment'  =>  'center',
            'carousel_image_sizes'  =>  'large',
            'carousel_responsive_image_ratio'    =>  [
                'desktop'   => 1.1,
                'tablet'    => 0.8,
                'smartphone'    => 0.9
            ],
            'carousel_design_post_title_typography'  =>  [
                'font_family'   => [ 'value' => 'EB Garamond', 'label' => 'EB Garamond' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'Bold 600' ],
                'font_size'   => [
                    'desktop' => 24,
                    'tablet' => 22,
                    'smartphone' => 20
                ],
                'line_height'   => array(
                    'desktop' => 34,
                    'tablet' => 30,
                    'smartphone' => 28,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'carousel_design_post_title_html_tag'    =>  'h2',
            'carousel_design_post_categories_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 12,
                    'tablet' => 12,
                    'smartphone' => 12
                ],
                'line_height'   => array(
                    'desktop' => 18,
                    'tablet' => 18,
                    'smartphone' => 18,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'carousel_design_post_date_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 14,
                    'tablet' => 14,
                    'smartphone' => 14
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'carousel_design_post_author_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 45,
                    'tablet' => 43,
                    'smartphone' => 40
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0,
                    'tablet' => 0,
                    'smartphone' => 0
                ),
                'text_transform'    => 'uppercase',
                'text_decoration'    => 'none'
            ],
            'carousel_design_post_excerpt_typography'  =>  [
                'font_family'   => [ 'value' => 'Inter', 'label' => 'Inter' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Bold 400' ],
                'font_size'   => [
                    'desktop' => 15,
                    'tablet' => 15,
                    'smartphone' => 15
                ],
                'line_height'   => array(
                    'desktop' => 27,
                    'tablet' => 27,
                    'smartphone' => 27,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'error_page_image'  => 0,
            'error_page_sidebar_layout'    =>  'right-sidebar',
            'search_page_sidebar_layout'    =>  'right-sidebar',
            'you_may_have_missed_section_option' => true,
            'you_may_have_missed_title_option' => true,
            'you_may_have_missed_title' => esc_html__( 'You May Have Missed', 'blogig' ),
            'you_may_have_missed_categories' => '[]',
            'you_may_have_missed_posts_to_include' => '[]',
            'you_may_have_missed_no_of_posts_to_show'   =>  4,
            'you_may_have_missed_hide_post_with_no_featured_image'  =>  false,
            'you_may_have_missed_post_order'    =>  'rand-desc',
            'you_may_have_missed_post_elements_show_title'  =>  true,
            'you_may_have_missed_post_elements_show_categories'  =>  true,
            'you_may_have_missed_post_elements_show_date'  =>  true,
            'you_may_have_missed_post_elements_show_author'  =>  true,
            'you_may_have_missed_date_icon' =>  [
                'type'  =>  'icon',
                'value' =>  'far fa-calendar'
            ],
            'you_may_have_missed_post_elements_alignment'  =>  'center',
            'you_may_have_missed_image_sizes'  =>  'large',
            'you_may_have_missed_responsive_image_ratio'    =>  [
                'desktop'   => 1,
                'tablet'    => 0.8,
                'smartphone'    => 0.7
            ],
            'you_may_have_missed_title_color'   => '#ffffff',
            'you_may_have_missed_background_color_group'  => json_encode(array(
                'type'  => 'solid',
                'solid' => '--blogig-global-preset-theme-color',
                'gradient'  => null
            )),
            'you_may_have_missed_design_section_title_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 18,
                    'tablet' => 18,
                    'smartphone' => 18
                ],
                'line_height'   => array(
                    'desktop' => 32,
                    'tablet' => 32,
                    'smartphone' => 32,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'you_may_have_missed_design_post_title_typography'  =>  [
                'font_family'   => [ 'value' => 'EB Garamond', 'label' => 'EB Garamond' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 20,
                    'tablet' => 20,
                    'smartphone' => 20
                ],
                'line_height'   => array(
                    'desktop' => 30,
                    'tablet' => 30,
                    'smartphone' => 30,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'you_may_have_missed_design_post_title_html_tag'    =>  'h2',
            'you_may_have_missed_design_post_categories_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 12,
                    'tablet' => 12,
                    'smartphone' => 12
                ],
                'line_height'   => array(
                    'desktop' => 18,
                    'tablet' => 18,
                    'smartphone' => 18,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'you_may_have_missed_design_post_date_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 12,
                    'tablet' => 12,
                    'smartphone' => 12
                ],
                'line_height'   => array(
                    'desktop' => 20,
                    'tablet' => 20,
                    'smartphone' => 20,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'you_may_have_missed_design_post_author_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 12,
                    'tablet' => 12,
                    'smartphone' => 12
                ],
                'line_height'   => array(
                    'desktop' => 20,
                    'tablet' => 20,
                    'smartphone' => 20,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'capitalize',
                'text_decoration'    => 'none'
            ],
            'footer_option' => false,
            'footer_widget_column'  => 'column-three',
            'bottom_footer_option'  => true,
            'bottom_footer_site_info'   => esc_html__( 'Blogig - Blog WordPress Theme %year%.', 'blogig' ),
            'bottom_footer_show_logo'   =>  false,
            'bottom_footer_header_or_custom'    =>  'header',
            'bottom_footer_logo_option'   =>  0,
            'bottom_footer_logo_width'  =>  [
                'desktop'   => 230,
                'tablet'    => 200,
                'smartphone'    => 200
            ],
            'heading_one_typo'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700' ],
                'font_size'   => [
                    'desktop' => 34,
                    'tablet' => 34,
                    'smartphone' => 34
                ],
                'line_height'   => array(
                    'desktop' => 44,
                    'tablet' => 44,
                    'smartphone' => 44,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'heading_two_typo'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700' ],
                'font_size'   => [
                    'desktop' => 28,
                    'tablet' => 28,
                    'smartphone' => 28
                ],
                'line_height'   => array(
                    'desktop' => 35,
                    'tablet' => 35,
                    'smartphone' => 35,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'heading_three_typo'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'Bold 600' ],
                'font_size'   => [
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24
                ],
                'line_height'   => array(
                    'desktop' => 31,
                    'tablet' => 31,
                    'smartphone' => 31,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.4,
                    'tablet' => 0.4,
                    'smartphone' => 0.4
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'heading_four_typo'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'Bold 600' ],
                'font_size'   => [
                    'desktop' => 18,
                    'tablet' => 18,
                    'smartphone' => 18
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0,
                    'tablet' => 0,
                    'smartphone' => 0
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'heading_five_typo'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'Bold 600' ],
                'font_size'   => [
                    'desktop' => 16,
                    'tablet' => 16,
                    'smartphone' => 16
                ],
                'line_height'   => array(
                    'desktop' => 22,
                    'tablet' => 22,
                    'smartphone' => 22,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'heading_six_typo'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '600', 'label' => 'Bold 600' ],
                'font_size'   => [
                    'desktop' => 14,
                    'tablet' => 14,
                    'smartphone' => 14
                ],
                'line_height'   => array(
                    'desktop' => 20,
                    'tablet' => 20,
                    'smartphone' => 20,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.6,
                    'tablet' => 0.6,
                    'smartphone' => 0.6
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'sidebar_block_title_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Normal 400' ],
                'font_size'   => [
                    'desktop' => 18,
                    'tablet' => 18,
                    'smartphone' => 18
                ],
                'line_height'   => array(
                    'desktop' => 32,
                    'tablet' => 32,
                    'smartphone' => 32,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'uppercase',
                'text_decoration'    => 'none'
            ],
            'sidebar_post_title_typography'  =>  [
                'font_family'   => [ 'value' => 'EB Garamond', 'label' => 'EB Garamond' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 18,
                    'tablet' => 18,
                    'smartphone' => 18
                ],
                'line_height'   => array(
                    'desktop' => 25,
                    'tablet' => 25,
                    'smartphone' => 25,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'sidebar_category_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '500', 'label' => 'Bold 500' ],
                'font_size'   => [
                    'desktop' => 12,
                    'tablet' => 12,
                    'smartphone' => 12
                ],
                'line_height'   => array(
                    'desktop' => 20,
                    'tablet' => 20,
                    'smartphone' => 20,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.5,
                    'tablet' => 0.5,
                    'smartphone' => 0.5
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'sidebar_date_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '400', 'label' => 'Bold 400' ],
                'font_size'   => [
                    'desktop' => 14,
                    'tablet' => 14,
                    'smartphone' => 14
                ],
                'line_height'   => array(
                    'desktop' => 20,
                    'tablet' => 20,
                    'smartphone' => 20,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0.3,
                    'tablet' => 0.3,
                    'smartphone' => 0.3
                ),
                'text_transform'    => 'unset',
                'text_decoration'    => 'none'
            ],
            'sidebar_heading_one_typography'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700' ],
                'font_size'   => [
                    'desktop' => 45,
                    'tablet' => 43,
                    'smartphone' => 40
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0,
                    'tablet' => 0,
                    'smartphone' => 0
                ),
                'text_transform'    => 'uppercase',
                'text_decoration'    => 'none'
            ],
            'sidebar_heading_two_typo'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700' ],
                'font_size'   => [
                    'desktop' => 45,
                    'tablet' => 43,
                    'smartphone' => 40
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0,
                    'tablet' => 0,
                    'smartphone' => 0
                ),
                'text_transform'    => 'uppercase',
                'text_decoration'    => 'none'
            ],
            'sidebar_heading_three_typo'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700' ],
                'font_size'   => [
                    'desktop' => 45,
                    'tablet' => 43,
                    'smartphone' => 40
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0,
                    'tablet' => 0,
                    'smartphone' => 0
                ),
                'text_transform'    => 'uppercase',
                'text_decoration'    => 'none'
            ],
            'sidebar_heading_four_typo'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700' ],
                'font_size'   => [
                    'desktop' => 45,
                    'tablet' => 43,
                    'smartphone' => 40
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0,
                    'tablet' => 0,
                    'smartphone' => 0
                ),
                'text_transform'    => 'uppercase',
                'text_decoration'    => 'none'
            ],
            'sidebar_heading_five_typo'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700' ],
                'font_size'   => [
                    'desktop' => 45,
                    'tablet' => 43,
                    'smartphone' => 40
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0,
                    'tablet' => 0,
                    'smartphone' => 0
                ),
                'text_transform'    => 'uppercase',
                'text_decoration'    => 'none'
            ],
            'sidebar_heading_six_typo'  =>  [
                'font_family'   => [ 'value' => 'Roboto', 'label' => 'Roboto' ],
                'font_weight'   => [ 'value' => '700', 'label' => 'Bold 700' ],
                'font_size'   => [
                    'desktop' => 45,
                    'tablet' => 43,
                    'smartphone' => 40
                ],
                'line_height'   => array(
                    'desktop' => 24,
                    'tablet' => 24,
                    'smartphone' => 24,
                ),
                'letter_spacing'   => array(
                    'desktop' => 0,
                    'tablet' => 0,
                    'smartphone' => 0
                ),
                'text_transform'    => 'uppercase',
                'text_decoration'    => 'none'
            ],
            // advertisement
            'blogig_advertisement_repeater'   =>  json_encode([
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show',
                    'item_target'   =>  '_blank',
                    'item_rel_attribute'    =>  'nofollow',
                    'item_heading'  =>  esc_html__( 'Display Area', 'blogig' ),
                    'item_checkbox_header'  =>  false,
                    'item_checkbox_before_post_content'  => false,
                    'item_checkbox_after_post_content'  =>  false,
                    'item_checkbox_random_post_archives'  =>    false,
                    'item_checkbox_stick_with_footer'  =>   false,
                    'item_alignment'    =>  'left',
                    'item_image_option' =>  'full_width'
                ],
                [
                    'item_image'    => 0,
                    'item_url'      => home_url(),
                    'item_option'   => 'show',
                    'item_target'   =>  '_blank',
                    'item_rel_attribute'    =>  'nofollow',
                    'item_heading'  =>  esc_html__( 'Display Area', 'blogig' ),
                    'item_checkbox_header'  =>  false,
                    'item_checkbox_before_post_content'  => false,
                    'item_checkbox_after_post_content'  =>  false,
                    'item_checkbox_random_post_archives'  =>    false,
                    'item_checkbox_stick_with_footer'  =>   false,
                    'item_alignment'    =>  'left',
                    'item_image_option' =>  'full_width'
                ]
            ]),
            'blogdescription_option'    =>  false,
            'site_title_custom_css' => '',
            'social_icon_custom_css' => '',
            'breadcrumb_custom_css' => '',
            'scroll_to_top_custom_css' => '',
            'header_menu_custom_css' => '',
            'header_search_custom_css' => '',
            'header_custom_button_custom_css' => '',
            'canvas_menu_custom_css' => '',
            'main_banner_custom_css' => '',
            'carousel_custom_css'   => '',
            'footer_custom_css'   => '',
            'bottom_footer_custom_css'   => ''
        ]);
        $totalCats = get_categories();
        if( $totalCats ) :
            foreach( $totalCats as $singleCat ) :
                $array_defaults['category_' .absint($singleCat->term_id). '_color'] = ['color'   => "#fff", 'hover'   => "#fff"];
                $array_defaults['category_background_' .absint($singleCat->term_id). '_color'] = json_encode([
                    'initial'    => [
                            'type'  => 'solid',
                            'solid' => '--blogig-global-preset-theme-color',
                            'gradient' => null
                    ],
                    'hover'    => [
                        'type'  => 'solid',
                        'solid' => '#213FD4',
                        'gradient' => null
                    ]
                ]);
            endforeach;
        endif;
        $totalTags = get_tags();
        if( $totalTags ) :
            foreach( $totalTags as $singleTag ) :
                $array_defaults['tag_' .absint($singleTag->term_id). '_color'] = ['color'   => "#fff", 'hover'   => "#fff"];
                $array_defaults['tag_background_' .absint($singleTag->term_id). '_color'] = json_encode([
                    'initial'    => [
                            'type'  => 'solid',
                            'solid' => '--blogig-global-preset-theme-color',
                            'gradient' => null
                    ],
                    'hover'    => [
                        'type'  => 'solid',
                        'solid' => '#213FD4',
                        'gradient' => null
                    ]
                ]);
            endforeach;
        endif;
        return $array_defaults[$key];
    }
endif;
