<?php
use Blogig\CustomizerDefault as BD;

/**
 * Binds JS handlers to make theme customizer preview reload changes asynchronously
 */
add_action( 'customize_preview_init', function() {
    wp_enqueue_script(
        'blogig-customizer-preview',
        get_template_directory_uri() .'/inc/customizer/assets/customizer-preview.min.js',
        ['customize-preview'],
        BLOGIG_VERSION,
        true
    );

    // localize scripts
    wp_localize_script(
        'blogig-customizer-preview',
        'blogigPreviewObject', 
        [
            '_wpnonce'  =>  wp_create_nonce( 'blogig-customizer-nonce' ),
            'ajaxUrl'   =>  admin_url( 'admin-ajax.php' ),
            'totalCats' => get_categories() ? get_categories() : [],
            'totalTags' => get_tags() ? get_tags() : []
        ]
    );
});

add_action( 'customize_controls_enqueue_scripts', function(){
    $buildControlsDeps = apply_filters(  'blogig_customizer_build_controls_dependencies', 
        [
            'react',
            'wp-blocks',
            'wp-editor',
            'wp-element',
            'wp-i18n',
            'wp-polyfill',
            'jquery',
            'wp-components'
        ]
    );

    wp_enqueue_style(
        'blogig-customizer-control',
        get_template_directory_uri() .'/inc/customizer/assets/customizer-controls.min.css',
        ['wp-components'],
        BLOGIG_VERSION,
        'all'
    );
    wp_enqueue_style( 'fontawesome', get_template_directory_uri() .'/assets/external/fontawesome/css/all.min.css', [], '6.4.2', 'all' );

    wp_enqueue_script(
        'blogig-customizer-control',
        get_template_directory_uri() .'/inc/customizer/assets/customizer-extends.min.js',
        $buildControlsDeps,
        BLOGIG_VERSION,
        true
    );
    wp_localize_script(
        'blogig-customizer-control',
        'customizerControlsObject', [
            'categories'    =>  blogig_get_multicheckbox_categories_simple_array(),
            'posts' =>  blogig_get_multicheckbox_posts_simple_array(),
            '_wpnonce'  =>  wp_create_nonce( 'blogig-customizer-controls-live-nonce' ),
            'ajaxUrl'   =>  admin_url( 'admin-ajax.php' )
        ]
    );
});

if( !function_exists( 'blogig_customizer_about_theme_panel' ) ) :
    /**
     * Register blog archive section settings
     * 
     */
    function blogig_customizer_about_theme_panel( $wp_customize ) {
        /**
         * About theme section
         * 
         * @since 1.0.0
         */
        $wp_customize->add_section( BLOGIG_PREFIX . 'about_section', array(
            'title' => esc_html__( 'About Theme', 'blogig' ),
            'priority'  => 1
        ));

        // upgrade info box
        $wp_customize->add_setting( 'upgrade_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Info_Box_Control( $wp_customize, 'upgrade_info', array(
                'label'	      => esc_html__( 'Premium Version', 'blogig' ),
                'description' => esc_html__( 'Our premium version of blogig includes unlimited news sections with advanced control fields. No limititation on any field and dedicated support.', 'blogig' ),
                'section'     => BLOGIG_PREFIX . 'about_section',
                'settings'    => 'upgrade_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View Premium', 'blogig' ),
                        'url'   => esc_url( '//blazethemes.com/theme/blogig-pro/' )
                    )
                )
            ))
        );

        // theme documentation info box
        $wp_customize->add_setting( 'site_documentation_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Info_Box_Control( $wp_customize, 'site_documentation_info', array(
                'label'	      => esc_html__( 'Theme Documentation', 'blogig' ),
                'description' => esc_html__( 'We have well prepared documentation which includes overall instructions and recommendations that are required in this theme.', 'blogig' ),
                'section'     => BLOGIG_PREFIX . 'about_section',
                'settings'    => 'site_documentation_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'View Documentation', 'blogig' ),
                        'url'   => esc_url( '//doc.blazethemes.com/blogig' )
                    )
                )
            ))
        );

        // theme documentation info box
        $wp_customize->add_setting( 'site_support_info', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Info_Box_Control( $wp_customize, 'site_support_info', array(
                'label'	      => esc_html__( 'Theme Support', 'blogig' ),
                'description' => esc_html__( 'We provide 24/7 support regarding any theme issue. Our support team will help you to solve any kind of issue. Feel free to contact us.', 'blogig' ),
                'section'     => BLOGIG_PREFIX . 'about_section',
                'settings'    => 'site_support_info',
                'choices' => array(
                    array(
                        'label' => esc_html__( 'Support Form', 'blogig' ),
                        'url'   => esc_url( '//blazethemes.com/support' )
                    )
                )
            ))
        );
    }
    add_action( 'customize_register', 'blogig_customizer_about_theme_panel', 10 );
endif;

if( ! function_exists( 'blogig_customizer_site_identity_panel' ) ) :
    /**
     * Register site identity settings
     */
    function blogig_customizer_site_identity_panel( $wp_customize ) {
        /**
         * Register "Site Identity Options" panel
         */
        $wp_customize->add_panel( 'blogig_site_identity_panel', [
            'title' =>  esc_html__( 'Site Identity', 'blogig' ),
            'priority'  =>  6
        ]);

        $wp_customize->get_section( 'title_tagline' )->panel = 'blogig_site_identity_panel';
        $wp_customize->get_section( 'title_tagline' )->title = esc_html__( 'Logo & Site Icon', 'blogig' );

        $wp_customize->add_setting( 'blogig_site_logo_width', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_site_logo_width' ),
            'sanitize_callback' =>  'blogig_sanitize_responsive_range',
            'transport' =>  'postMessage'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Responsive_Range_Control( $wp_customize, 'blogig_site_logo_width',[
                'label' =>  esc_html__( 'Logo Width (px)', 'blogig' ),
                'section'   =>  'title_tagline',
                'settings'  =>  'blogig_site_logo_width',
                'unit'  =>  'px',
                'input_attrs'   =>  [
                    'max'   =>  400,
                    'min'   =>  1,
                    'step'  =>  1,
                    'reset' =>  true
                ]
            ])
        );

        $wp_customize->add_section( 'blogig_site_title_section', [
            'title' =>  esc_html__( 'Site Title & Tagline', 'blogig' ),
            'panel' =>  'blogig_site_identity_panel',
            'priority'  =>  30
        ]);

        // site title tag - for frontpage
        $wp_customize->add_setting( 'site_title_tag_for_frontpage', [
            'default'   =>  BD\blogig_get_customizer_default( 'site_title_tag_for_frontpage' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);

        $wp_customize->add_control( 'site_title_tag_for_frontpage', [
            'label'   =>  esc_html__( 'Site Title Tag (For Frontpage)', 'blogig' ),
            'type'  =>  'select',
            'section'   =>  'blogig_site_title_section',
            'settings'  =>  'site_title_tag_for_frontpage',
            'choices'   =>  [
                'h1'    =>  esc_html__( 'H1', 'blogig' ),
                'h2'    =>  esc_html__( 'H2', 'blogig' ),
                'h3'    =>  esc_html__( 'H3', 'blogig' ),
                'h4'    =>  esc_html__( 'H4', 'blogig' ),
                'h5'    =>  esc_html__( 'H5', 'blogig' ),
                'h6'    =>  esc_html__( 'H6', 'blogig' )
            ]
        ]);

        // site title tag - for innerpage
        $wp_customize->add_setting( 'site_title_tag_for_innerpage', [
            'default'   =>  BD\blogig_get_customizer_default( 'site_title_tag_for_innerpage' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);

        $wp_customize->add_control( 'site_title_tag_for_innerpage', [
            'label'   =>  esc_html__( 'Site Title Tag (For Innerpage)', 'blogig' ),
            'type'  =>  'select',
            'section'   =>  'blogig_site_title_section',
            'settings'  =>  'site_title_tag_for_innerpage',
            'choices'   =>  [
                'h1'    =>  esc_html__( 'H1', 'blogig' ),
                'h2'    =>  esc_html__( 'H2', 'blogig' ),
                'h3'    =>  esc_html__( 'H3', 'blogig' ),
                'h4'    =>  esc_html__( 'H4', 'blogig' ),
                'h5'    =>  esc_html__( 'H5', 'blogig' ),
                'h6'    =>  esc_html__( 'H6', 'blogig' )
            ]
        ]);

        $wp_customize->get_control( 'blogname' )->section = 'blogig_site_title_section';
        $wp_customize->get_control( 'blogdescription' )->section = 'blogig_site_title_section';
        $wp_customize->get_control( 'display_header_text' )->section = 'blogig_site_title_section';
        $wp_customize->get_control( 'display_header_text' )->label = esc_html__( 'Display site title', 'blogig' );
        
        $wp_customize->add_setting( 'site_title_section_tab', [
            'default'   =>  'general',
            'sanitize_callback' =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Section_Tab_Control( $wp_customize, 'site_title_section_tab', [
                'section'   =>  'blogig_site_title_section',
                'priority'  =>  1,
                'choices'   =>  [
                    [
                        'name'  =>  'general',
                        'title' =>  esc_html__( 'General', 'blogig' )
                    ],
                    [
                        'name'  =>  'design',
                        'title' =>  esc_html__( 'Design', 'blogig' )
                    ]
                ]
            ])
        );

        // blog description option
        $wp_customize->add_setting( 'blogdescription_option', [
            'default'   =>  true,
            'sanitize_callback' =>  'blogig_sanitize_checkbox',
            'transport' =>  'postMessage'
        ]);
        
        $wp_customize->add_control( 'blogdescription_option', [
            'label' =>  esc_html__( 'Display site description', 'blogig' ),
            'section'   =>  'blogig_site_title_section',
            'type'  =>  'checkbox',
            'priority'  =>  50
        ]);

        // site title custom css heading
        $wp_customize->add_setting( 'site_title_custom_css_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'site_title_custom_css_header', array(
                'label'	      => esc_html__( 'Custom Css', 'blogig' ),
                'section'     => 'blogig_site_title_section',
                'priority'  =>  100
            ))
        );

        // site title custom css code control
        $wp_customize->add_setting( 'site_title_custom_css', [
            'default'   =>  BD\blogig_get_customizer_default( 'site_title_custom_css' ),
            'sanitize_callback' =>  'blogig_sanitize_css_code_control',
            'capability'=> 'edit_css',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control(
            new WP_Customize_Code_Editor_Control( $wp_customize, 'site_title_custom_css', [
                'label' =>  esc_html__( 'Css code', 'blogig' ),
                'description' =>  esc_html__( 'Enter the valid css code. Type "{wrapper}" before every new line. "{wrapper}" will be replaced by main wrapper i.e ".site-branding-section"', 'blogig' ),
                'section'   =>  'blogig_site_title_section',
                'code_type'   => 'text/css',
                'priority'  =>  100,
                'input_attrs' => [
                    'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4'
                ]
            ])
        );

        $wp_customize->get_control( 'header_textcolor' )->section = 'blogig_site_title_section';
        $wp_customize->get_control( 'header_textcolor' )->priority = 60;
        $wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site Title Color', 'blogig' );

        //header text hover color
        $wp_customize->add_setting( 'site_title_hover_textcolor', [
            'sanitize_callback' =>  'sanitize_hex_color',
            'transport' =>  'postMessage'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Default_Color_Control( $wp_customize, 'site_title_hover_textcolor', [
                'label' =>  esc_html__( 'Site Title Hover Color', 'blogig' ),
                'section'   =>  'blogig_site_title_section',
                'settings'  =>  'site_title_hover_textcolor',
                'priority'  =>  70,
                'tab'   =>  'design'
            ])
        );

        // site description color
        $wp_customize->add_setting( 'site_description_color', [
            'sanitize_callback' =>  'sanitize_hex_color',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Default_Color_Control( $wp_customize, 'site_description_color', [
                'label' =>  esc_html__( 'Site Description Color', 'blogig' ),
                'section'   =>  'blogig_site_title_section',
                'settings'  =>  'site_description_color',
                'priority'  =>  70,
                'tab'   =>  'design'
            ])
        );

        // site title typo
        $wp_customize->add_setting( 'site_title_typo', [
            'default'   => BD\blogig_get_customizer_default( 'site_title_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'site_title_typo', [
                'label' =>  esc_html__( 'Site Title Typography', 'blogig' ),
                'section'   =>  'blogig_site_title_section',
                'settings'  =>  'site_title_typo',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        $wp_customize->add_setting( 'site_description_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'site_description_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'site_description_typo', [
                'label' =>  esc_html__( 'Site Description Typography', 'blogig' ),
                'section'   =>  'blogig_site_title_section',
                'settings'  =>  'site_description_typo',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ],
                'tab'   =>  'design'
            ])
        );
    }
    add_action( 'customize_register', 'blogig_customizer_site_identity_panel' );
endif;

if( ! function_exists( 'blogig_theme_header_panel' ) ) :
    /**
     * This is function for theme header panel
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_theme_header_panel( $wp_customize ) {
        $wp_customize->add_panel(
            'blogig_theme_header_panel',
            [
                'title' =>  __( 'Theme Header', 'blogig' ),
                'priority'  =>  50
            ]
        );

        // Menu Options Section
        $wp_customize->add_section( 'blogig_header_menu_options_section', [
            'panel' =>  'blogig_theme_header_panel',
            'title' =>  esc_html__( 'Menu Options', 'blogig' ),
            'priority'  =>  50
        ]);
        $wp_customize->add_setting( 'blogig_header_menu_typography', [
            'default'   =>  'design',
            'sanitize_callback' =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Section_Tab_Control( $wp_customize, 'blogig_header_menu_typography', [
                'label' =>  esc_html__( 'Typography', 'blogig' ),
                'section'   =>  'blogig_header_menu_options_section',
                'settings'  =>  'blogig_header_menu_typography',
                'choices'   =>  [
                    [
                        'name'  =>  'design',
                        'title' =>  esc_html__( 'Design', 'blogig' )
                    ],
                    [
                        'name'  =>  'general',
                        'title' =>  esc_html__( 'General', 'blogig' )
                    ]
                ]
            ])
        );

        // menu option - menu alignments
        $wp_customize->add_setting( 'menu_options_menu_alignment', array(
            'default'   =>  BD\blogig_get_customizer_default( 'menu_options_menu_alignment' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' =>  'postMessage'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Radio_Tab_Control( $wp_customize, 'menu_options_menu_alignment', array(
                'label'	      => esc_html__( 'Elements Alignment', 'blogig' ),
                'section'     => 'blogig_header_menu_options_section',
                'choices' => array(
                    array(
                        'value' => 'left',
                        'label' => esc_html__('Left', 'blogig' )
                    ),
                    array(
                        'value' => 'center',
                        'label' => esc_html__('Center', 'blogig' )
                    ),
                    array(
                        'value' => 'right',
                        'label' => esc_html__('Right', 'blogig' )
                    )
                )
            ))
        );

        // menu option - sticky header
        $wp_customize->add_setting( 'menu_options_sticky_header', array(
            'default'   =>  BD\blogig_get_customizer_default( 'menu_options_sticky_header' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'menu_options_sticky_header', array(
                'label'	      => esc_html__( 'Enable Header Section Sticky', 'blogig' ),
                'section'     => 'blogig_header_menu_options_section'
            ))
        );

        // menu option hover effects
        $wp_customize->add_setting( 'blogig_header_menu_hover_effect', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_header_menu_hover_effect' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control( 'blogig_header_menu_hover_effect', [
                'label' =>  esc_html__( 'Hover Effect', 'blogig' ),
                'section'   =>  'blogig_header_menu_options_section',
                'settings'  =>  'blogig_header_menu_hover_effect',
                'choices'   =>  [
                    'none'  =>  esc_html__( 'None', 'blogig' ),
                    'one'  =>  esc_html__( 'Effect 1', 'blogig' )
                ],
                'type'  =>  'select'
            ]
        );

        // header menu cutoff heading
        $wp_customize->add_setting( 'header_menu_cutoff_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'header_menu_cutoff_header', array(
                'label' => esc_html__( 'Menu Cutoff Setting', 'blogig' ),
                'section'   => 'blogig_header_menu_options_section',
                'tab'   => 'general'
            ))
        );

        // menu cutoff option
        $wp_customize->add_setting( 'menu_cutoff_option', array(
            'default'   =>  BD\blogig_get_customizer_default( 'menu_cutoff_option' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'menu_cutoff_option', array(
                'label'	      => esc_html__( 'Enable menu cutoff', 'blogig' ),
                'section'     => 'blogig_header_menu_options_section',
                'tab'   => 'general'
            ))
        );

        // menu cutoff after
        $wp_customize->add_setting( 'menu_cutoff_after', [
            'default'   =>  BD\blogig_get_customizer_default( 'menu_cutoff_after' ),
            'sanitize_callback' =>  'absint'
        ]);
        $wp_customize->add_control( 'menu_cutoff_after', [
            'label' =>  esc_html( 'Menu cutoff up to', 'blogig' ),
            'type'  =>  'number',
            'section'   =>  'blogig_header_menu_options_section',
            'tab'   => 'general',
            'input_attrs' => [
                'max'   => 100,
                'min'   => 1,
                'step'  => 1,
                'reset' => true
            ]
        ]);

        // menu cutoff more text
        $wp_customize->add_setting( 'menu_cutoff_text', [
            'default'   =>  BD\blogig_get_customizer_default( 'menu_cutoff_text' ),
            'sanitize_callback'  =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control( 'menu_cutoff_text', [
            'label' =>  esc_html__( 'Menu cutoff more text', 'blogig' ),
            'section'   =>  'blogig_header_menu_options_section',
            'type'  =>  'text',
            'tab'   => 'general'
        ]);

        // main banner menu options main menu text typography
        $wp_customize->add_setting( 'main_menu_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'main_menu_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'main_menu_typo', [
                'label' =>  esc_html__( 'Main Menu Typography', 'blogig' ),
                'section'   =>  'blogig_header_menu_options_section',
                'settings'  =>  'main_menu_typo',
                'tab'   =>  'design'
            ])
        );

        // main banner menu options sub menu text typography
        $wp_customize->add_setting( 'main_menu_sub_menu_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'main_menu_sub_menu_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'main_menu_sub_menu_typo', [
                'label' =>  esc_html__( 'Sub Menu Typography', 'blogig' ),
                'section'   =>  'blogig_header_menu_options_section',
                'settings'  =>  'main_menu_sub_menu_typo',
                'tab'   =>  'design'
            ])
        );

        $wp_customize->add_setting( 'header_menu_color', [
            'default'   =>  BD\blogig_get_customizer_default( 'header_menu_color' ),
            'sanitize_callback' =>  'blogig_sanitize_color_group_picker_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Color_Group_Picker_Control( $wp_customize, 'header_menu_color', array(
                'label'     => esc_html__( 'Text Color', 'blogig' ),
                'section'   => 'blogig_header_menu_options_section',
                'settings'  => 'header_menu_color',
                'tab'   => 'design'
            ))
        );

        // header menu custom css heading
        $wp_customize->add_setting( 'header_menu_custom_css_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'header_menu_custom_css_header', array(
                'label' => esc_html__( 'Custom Css', 'blogig' ),
                'tab'   => 'design',
                'section'   => 'blogig_header_menu_options_section'
            ))
        );

        // header menu custom css code control
        $wp_customize->add_setting( 'header_menu_custom_css', [
            'default'   =>  BD\blogig_get_customizer_default( 'header_menu_custom_css' ),
            'sanitize_callback' =>  'blogig_sanitize_css_code_control',
            'capability'=> 'edit_css',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Customize_Code_Editor_Control( $wp_customize, 'header_menu_custom_css', [
                'label' =>  esc_html__( 'Css code', 'blogig' ),
                'description' =>  esc_html__( 'Enter the valid css code. Type "{wrapper}" before every new line. "{wrapper}" will be replaced by main wrapper i.e "#site-navigation"', 'blogig' ),
                'section'   =>  'blogig_header_menu_options_section',
                'code_type'   => 'text/css',
                'tab'   => 'design',
                'input_attrs' => [
                    'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4'
                ]
            ])
        );

        // Live Search Section
        $wp_customize->add_section( 'blogig_header_live_search_section', [
            'panel' =>  'blogig_theme_header_panel',
            'title' =>  esc_html__( 'Search', 'blogig' ),
            'priority'  =>  50
        ]);
        $wp_customize->add_setting( 'blogig_header_live_search_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_header_live_search_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control( 
            new Blogig_WP_Toggle_control( $wp_customize, 'blogig_header_live_search_option', [
                'label' =>  esc_html__( 'Enable Search', 'blogig' ),
                'section'   =>  'blogig_header_live_search_section',
                'settings'  =>  'blogig_header_live_search_option'
            ])
        );

        // header search custom css heading
        $wp_customize->add_setting( 'header_search_custom_css_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'header_search_custom_css_header', array(
                'label'	      => esc_html__( 'Custom Css', 'blogig' ),
                'section'     => 'blogig_header_live_search_section'
            ))
        );
        // header search custom css code control
        $wp_customize->add_setting( 'header_search_custom_css', [
            'default'   =>  BD\blogig_get_customizer_default( 'header_search_custom_css' ),
            'sanitize_callback' =>  'blogig_sanitize_css_code_control',
            'capability'=> 'edit_css',
            'transport' => 'postMessage'
        ]);
        $wp_customize->add_control(
            new WP_Customize_Code_Editor_Control( $wp_customize, 'header_search_custom_css', [
                'label' =>  esc_html__( 'Css code', 'blogig' ),
                'description' =>  esc_html__( 'Enter the valid css code. Type "{wrapper}" before every new line. "{wrapper}" will be replaced by main wrapper i.e ".seearch-wrap"', 'blogig' ),
                'section'   =>  'blogig_header_live_search_section',
                'code_type'   => 'text/css',
                'input_attrs' => [
                    'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4'
                ]
            ])
        );

        // Custom Button Section
        $wp_customize->add_section( 'blogig_custom_button_section', [
            'panel' =>  'blogig_theme_header_panel',
            'title' =>  esc_html__( 'Custom Button', 'blogig' ),
            'priority'  =>  50
        ]);
        $wp_customize->add_setting( 'blogig_custom_button_section_tab', [
            'default'   =>  'general',
            'sanitize_callback' =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Section_Tab_Control( $wp_customize, 'blogig_custom_button_section_tab', [
                'section'   =>  'blogig_custom_button_section',
                'priority'  =>  1,
                'choices'   =>  [
                    [
                        'name'  =>  'general',
                        'title' =>  esc_html__( 'General', 'blogig' )
                    ],
                    [
                        'name'  =>  'design',
                        'title' =>  esc_html__( 'Design', 'blogig' )
                    ]
                ]
            ])
        );
        $wp_customize->add_setting( 'blogig_header_custom_button_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_header_custom_button_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'blogig_header_custom_button_option', [
                'label' =>  esc_html__( 'Show Custom Button', 'blogig' ),
                'section'   =>  'blogig_custom_button_section',
                'settings'  =>  'blogig_header_custom_button_option'
            ])
        );

        // custom button - button label
        $wp_customize->add_setting( 'blogig_custom_button_label', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_custom_button_label' ),
            'sanitize_callback'  =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control( 'blogig_custom_button_label', [
            'label' =>  esc_html__( 'Button Label', 'blogig' ),
            'section'   =>  'blogig_custom_button_section',
            'settings'  =>  'blogig_custom_button_label',
            'type'  =>  'text'
        ]);

        // custom button - button icon
        $wp_customize->add_setting( 'blogig_custom_button_icon', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_custom_button_icon' ),
            'sanitize_callback' =>  'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'blogig_custom_button_icon', [
                'label' =>  esc_html__( 'Button icon', 'blogig' ),
                'section'   =>  'blogig_custom_button_section',
                'settings'  =>  'blogig_custom_button_icon'
            ])
        );

        // custom button - redirect url
        $wp_customize->add_setting( 'blogig_custom_button_redirect_href_link', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_custom_button_redirect_href_link' ),
            'sanitize_callback'  =>  'blogig_sanitize_url'
        ]);
        $wp_customize->add_control(
            'blogig_custom_button_redirect_href_link', [
                'label' =>  esc_html__( 'Redirect URL', 'blogig' ),
                'description'   =>  esc_html__( 'Add url for the button to redirect', 'blogig' ),
                'section'   =>  'blogig_custom_button_section',
                'settings'  =>  'blogig_custom_button_redirect_href_link'
            ]
        );

        // custom button - button target
        $wp_customize->add_setting( 'blogig_custom_button_target', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_custom_button_target' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);
        $wp_customize->add_control( 'blogig_custom_button_target', [
            'label' =>  esc_html__( 'Button Target', 'blogig' ),
            'section'   =>  'blogig_custom_button_section',
            'settings'  =>  'blogig_custom_button_target',
            'type'  =>  'select',
            'choices'   =>  [
                '_blank' =>  esc_html__( 'Open in new tab', 'blogig' ),
                '_self' =>  esc_html__( 'Open in same tab', 'blogig' )
            ]
        ] );
        // main banner custom button text typography
        $wp_customize->add_setting( 'blogig_custom_button_text_typography', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_custom_button_text_typography' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'blogig_custom_button_text_typography', [
                'label' =>  esc_html__( 'Text Typography', 'blogig' ),
                'section'   =>  'blogig_custom_button_section',
                'settings'  =>  'blogig_custom_button_text_typography',
                'tab'   =>  'design'
            ])
        );

        // main banner custom button text color
        $wp_customize->add_setting( 'blogig_custom_button_text_color', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_custom_button_text_color' ),
            'sanitize_callback' =>  'blogig_sanitize_color_group_picker_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Color_Group_Picker_Control( $wp_customize, 'blogig_custom_button_text_color', [
                'label' =>  esc_html__( 'Text Color', 'blogig' ),
                'section'   =>  'blogig_custom_button_section',
                'settings'  =>  'blogig_custom_button_text_color',
                'tab'   =>  'design'
            ])
        );
        $wp_customize->add_setting( 'blogig_custom_button_icon_color', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_custom_button_icon_color' ),
            'sanitize_callback' =>  'blogig_sanitize_color_group_picker_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Color_Group_Picker_Control( $wp_customize, 'blogig_custom_button_icon_color', [
                'label' =>  esc_html__( 'Icon Color', 'blogig' ),
                'section'   =>  'blogig_custom_button_section',
                'settings'  =>  'blogig_custom_button_icon_color',
                'tab'   =>  'design'
            ])
        );

        // header custom button custom css heading
        $wp_customize->add_setting( 'header_custom_button_custom_css_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'header_custom_button_custom_css_header', array(
                'label'	      => esc_html__( 'Custom Css', 'blogig' ),
                'section'     => 'blogig_custom_button_section',
                'priority'  =>  100
            ))
        );
        // site title custom css code control
        $wp_customize->add_setting( 'header_custom_button_custom_css', [
            'default'   =>  BD\blogig_get_customizer_default( 'header_custom_button_custom_css' ),
            'sanitize_callback' =>  'blogig_sanitize_css_code_control',
            'capability'=> 'edit_css',
            'transport' => 'postMessage'
        ]);
        $wp_customize->add_control(
            new WP_Customize_Code_Editor_Control( $wp_customize, 'header_custom_button_custom_css', [
                'label' =>  esc_html__( 'Css code', 'blogig' ),
                'description' =>  esc_html__( 'Enter the valid css code. Type "{wrapper}" before every new line. "{wrapper}" will be replaced by main wrapper i.e ".header-custom-button"', 'blogig' ),
                'section'   =>  'blogig_custom_button_section',
                'code_type'   => 'text/css',
                'priority'  =>  100,
                'input_attrs' => [
                    'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4'
                ]
            ])
        );

        // theme mode section
        $wp_customize->add_section( 'blogig_theme_mode_section', [
            'panel' =>  'blogig_theme_header_panel',
            'title' =>  esc_html__( 'Theme Mode', 'blogig' ),
            'priority'  =>  50
        ]);
        $wp_customize->add_setting( 'blogig_theme_mode_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_theme_mode_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Toggle_Control( $wp_customize, 'blogig_theme_mode_option', [
                'label' =>  esc_html__( 'Theme Mode', 'blogig' ),
                'section'   =>  'blogig_theme_mode_section',
                'settings'  =>  'blogig_theme_mode_option'
            ])
        );

        // theme mode dark mode pick picker
        $wp_customize->add_setting( 'blogig_theme_mode_dark_icon', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_theme_mode_dark_icon' ),
            'sanitize_callback' =>  'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'blogig_theme_mode_dark_icon', [
                'label' =>  esc_html__( 'Choose Dark Icon', 'blogig' ),
                'section'   =>  'blogig_theme_mode_section',
                'settings'  =>  'blogig_theme_mode_dark_icon'
            ]) 
        );

        // theme mode dark mode pick picker
        $wp_customize->add_setting( 'blogig_theme_mode_light_icon', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_theme_mode_light_icon' ),
            'sanitize_callback' =>  'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'blogig_theme_mode_light_icon', [
                'label' =>  esc_html__( 'Choose Light Icon', 'blogig' ),
                'section'   =>  'blogig_theme_mode_section',
                'settings'  =>  'blogig_theme_mode_light_icon'
            ]) 
        );

        // Canvas Menu Section
        $wp_customize->add_section( 'blogig_canvas_menu_section', [
            'panel' =>  'blogig_theme_header_panel',
            'title' =>  esc_html__( 'Canvas Menu', 'blogig' ),
            'priority'  =>  50
        ]);

        // canvas enable disable option
        $wp_customize->add_setting( 'canvas_menu_enable_disable_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'canvas_menu_enable_disable_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control( 
            new Blogig_WP_Toggle_Control( $wp_customize, 'canvas_menu_enable_disable_option', [
                'label' =>  esc_html__( 'Enable Canvas Menu', 'blogig' ),
                'section'   =>  'blogig_canvas_menu_section',
                'settings'  =>  'canvas_menu_enable_disable_option'
            ])
        );

        // canvas icon
        $wp_customize->add_setting( 'canvas_menu_icon_picker', [
            'default'   =>  BD\blogig_get_customizer_default( 'canvas_menu_icon_picker' ),
            'sanitize_callback' =>  'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'canvas_menu_icon_picker', [
                'label' =>  esc_html__( 'Canvas Icon', 'blogig' ),
                'section'   =>  'blogig_canvas_menu_section',
                'settings'  =>  'canvas_menu_icon_picker'
            ])
        );
        
        // Redirect widgets link
        $wp_customize->add_setting( 'canvas_menu_redirects', array(
            'sanitize_callback' => 'blogig_sanitize_toggle_control',
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Redirect_Control( $wp_customize, 'canvas_menu_redirects', array(
                'label'	      => esc_html__( 'Widgets', 'blogig' ),
                'section'     => 'blogig_canvas_menu_section',
                'settings'    => 'canvas_menu_redirects',
                'tab'   => 'general',
                'choices'     => array(
                    'canvas-menu-sidebar' => array(
                        'type'  => 'section',
                        'id'    => 'sidebar-widgets-canvas-menu-sidebar',
                        'label' => esc_html__( 'Manage canvas menu widget', 'blogig' )
                    )
                ),
                'active_callback'   =>  function( $control ) {
                    return ( $control->manager->get_setting( 'canvas_menu_enable_disable_option' )->value() );
                }
                
            ))
        );

        // canvas menu custom css heading
        $wp_customize->add_setting( 'canvas_menu_custom_css_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'canvas_menu_custom_css_header', array(
                'label'	      => esc_html__( 'Custom Css', 'blogig' ),
                'section'     => 'blogig_canvas_menu_section'
            ))
        );
        // canvas menu custom css code control
        $wp_customize->add_setting( 'canvas_menu_custom_css', [
            'default'   =>  BD\blogig_get_customizer_default( 'canvas_menu_custom_css' ),
            'sanitize_callback' =>  'blogig_sanitize_css_code_control',
            'capability'=> 'edit_css',
            'transport' => 'postMessage'
        ]);
        $wp_customize->add_control(
            new WP_Customize_Code_Editor_Control( $wp_customize, 'canvas_menu_custom_css', [
                'label' =>  esc_html__( 'Css code', 'blogig' ),
                'description' =>  esc_html__( 'Enter the valid css code. Type "{wrapper}" before every new line. "{wrapper}" will be replaced by main wrapper i.e ".blogig-canvas-menu"', 'blogig' ),
                'section'   =>  'blogig_canvas_menu_section',
                'code_type'   => 'text/css',
                'input_attrs' => [
                    'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4'
                ]
            ])
        );
    }
    add_action( 'customize_register', 'blogig_theme_header_panel' );
endif;

if( ! function_exists( 'blogig_main_banner_panel' ) ) :
    /**
     * Function for main banner panel
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_main_banner_panel( $wp_customize ) {
        $wp_customize->add_section( 'main_banner_section', [
            'title' =>  esc_html__( 'Main Banner', 'blogig' ),
            'priority'  =>  70
        ]);

        // main section heading
        $wp_customize->add_setting( 'main_banner_section_heading', [
            'default'   =>  'general',
            'sanitize_callback' =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Section_Tab_Control( 
                $wp_customize,
                'main_banner_section_heading', 
                [
                    'section'   =>  'main_banner_section',
                    'priority'  =>  1,
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogig' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogig' )
                        ]
                    ]
                ]
            )
        );

        // main banner option
        $wp_customize->add_setting( 'main_banner_option', array(
            'default'   => BD\blogig_get_customizer_default( 'main_banner_option' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));

        $wp_customize->add_control( 
            new Blogig_WP_Toggle_Control( $wp_customize, 'main_banner_option', array(
                'label'	      => esc_html__( 'Show main banner', 'blogig' ),
                'section'     => 'main_banner_section',
                'settings'    => 'main_banner_option'
            ))
        );

        // main banner display in
        $wp_customize->add_setting( 'main_banner_render_in', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_render_in' ),
            'sanitize_callback'  =>  'blogig_sanitize_select_control'
        ));

        $wp_customize->add_control( 'main_banner_render_in', array(
            'label' =>  esc_html__( 'Display In', 'blogig' ),
            'section'   =>  'main_banner_section',
            'settings'  =>  'main_banner_render_in',
            'type'  =>  'select',
            'choices'   =>  [
                'front_page'    =>  esc_html__( 'Front Page', 'blogig' ),
                'posts_page'    =>  esc_html__( 'Posts Page', 'blogig' ),
                'both'    =>  esc_html__( 'Front and Posts Page', 'blogig' )
            ]
        ));
        
        // banner post query settings heading
        $wp_customize->add_setting( 'main_banner_post_query_settings_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'main_banner_post_query_settings_heading', array(
                'label'	      => esc_html__( 'Post Query', 'blogig' ),
                'section'     => 'main_banner_section'
            ))
        );

        // // main banner slider categories
        $wp_customize->add_setting( 'main_banner_slider_categories', array(
            'default' => BD\blogig_get_customizer_default( 'main_banner_slider_categories' ),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Categories_Multiselect_Control( $wp_customize, 'main_banner_slider_categories', array(
                'label'     => esc_html__( 'Posts Categories', 'blogig' ),
                'section'   => 'main_banner_section',
                'settings'  => 'main_banner_slider_categories',
                'choices'   => blogig_get_multicheckbox_categories_simple_array()
            ))
        );

        // banner posts to include
        $wp_customize->add_setting( 'main_banner_slider_posts_to_include', array(
            'default' => BD\blogig_get_customizer_default( 'main_banner_slider_posts_to_include' ),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Posts_Multiselect_Control( $wp_customize, 'main_banner_slider_posts_to_include', array(
                'label'     => esc_html__( 'Posts To Include', 'blogig' ),
                'section'   => 'main_banner_section',
                'settings'  => 'main_banner_slider_posts_to_include',
                'choices'   => blogig_get_multicheckbox_posts_simple_array()
            ))
        );
        
        // main banner post order
        $wp_customize->add_setting( 'main_banner_post_order', [
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_post_order' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);

        $wp_customize->add_control( 'main_banner_post_order', [
            'label' =>  esc_html( 'Post Order', 'blogig' ),
            'type'  =>  'select',
            'priority'  =>  10,
            'section'   =>  'main_banner_section',
            'settings'  =>  'main_banner_post_order',
            'choices'   =>  blogig_post_order_args()
        ]);

        // main banner no of posts to show
        $wp_customize->add_setting( 'main_banner_no_of_posts_to_show', [
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_no_of_posts_to_show' ),
            'sanitize_callback' =>  'absint'
        ]);

        $wp_customize->add_control( 'main_banner_no_of_posts_to_show', [
            'label' =>  esc_html( 'No of posts to show', 'blogig' ),
            'type'  =>  'number',
            'priority'  =>  10,
            'section'   =>  'main_banner_section',
            'settings'  =>  'main_banner_no_of_posts_to_show',
            'input_attrs' => [
                'max'   => 4,
                'min'   => 1,
                'step'  => 1,
                'reset' => true
            ]
        ]);

        // main banner hide post with no featured image
        $wp_customize->add_setting( 'main_banner_hide_post_with_no_featured_image', [
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_hide_post_with_no_featured_image' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'main_banner_hide_post_with_no_featured_image', [
                'label' =>  esc_html__( 'Hide posts with no featured image', 'blogig' ),
                'section'   =>  'main_banner_section',
                'settings'  =>  'main_banner_hide_post_with_no_featured_image'
            ])
        );

        // main banner slider settings
        $wp_customize->add_setting( 'main_banner_post_elements_settings_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'main_banner_post_elements_settings_heading', array(
                'label'	      => esc_html__( 'Post Elements Settings', 'blogig' ),
                'section'     => 'main_banner_section'
            ))
        );

        // main banner post element show title
        $wp_customize->add_setting( 'main_banner_post_elements_show_title', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_post_elements_show_title' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'main_banner_post_elements_show_title', array(
                'label'	      => esc_html__( 'Show Title', 'blogig' ),
                'section'     => 'main_banner_section',
                'settings'  =>  'main_banner_post_elements_show_title'
            ))
        );

         // main banner post title html tag
         $wp_customize->add_setting( 'main_banner_design_post_title_html_tag', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_design_post_title_html_tag' ),
            'sanitize_callback' => 'blogig_sanitize_select_control'
        ));
        
        $wp_customize->add_control( 'main_banner_design_post_title_html_tag', array(
            'label'	      => esc_html__( 'Title Tag', 'blogig' ),
            'section'     => 'main_banner_section',
            'settings'    => 'main_banner_design_post_title_html_tag',
            'tab'   =>  'design',
            'type'  =>  'select',
            'choices'   =>  [
                'h1'    =>  esc_html__( 'H1', 'blogig' ),
                'h2'    =>  esc_html__( 'H2', 'blogig' ),
                'h3'    =>  esc_html__( 'H3', 'blogig' ),
                'h4'    =>  esc_html__( 'H4', 'blogig' ),
                'h5'    =>  esc_html__( 'H5', 'blogig' ),
                'h6'    =>  esc_html__( 'H6', 'blogig' )
            ]
        ));

        // main banner post element show categories
        $wp_customize->add_setting( 'main_banner_post_elements_show_categories', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_post_elements_show_categories' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'main_banner_post_elements_show_categories', array(
                'label'	      => esc_html__( 'Show Categories', 'blogig' ),
                'section'     => 'main_banner_section',
                'settings'  =>  'main_banner_post_elements_show_categories'
            ))
        );

        // main banner post element show date
        $wp_customize->add_setting( 'main_banner_post_elements_show_date', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_post_elements_show_date' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'main_banner_post_elements_show_date', array(
                'label'	      => esc_html__( 'Show Date', 'blogig' ),
                'section'     => 'main_banner_section',
                'settings'  =>  'main_banner_post_elements_show_date'
            ))
        );

        // main banner post element show author
        $wp_customize->add_setting( 'main_banner_post_elements_show_author', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_post_elements_show_author' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'main_banner_post_elements_show_author', array(
                'label'	      => esc_html__( 'Show Author', 'blogig' ),
                'section'     => 'main_banner_section',
                'settings'  =>  'main_banner_post_elements_show_author'
            ))
        );
        
        // main banner date icon
        $wp_customize->add_setting( 'main_banner_date_icon', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_date_icon' ),
            'sanitize_callback' => 'blogig_sanitize_icon_picker_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'main_banner_date_icon', array(
                'label'	      => esc_html__( 'Date Icon', 'blogig' ),
                'section'     => 'main_banner_section',
                'settings'  =>  'main_banner_date_icon'
            ))
        );

        // main banner post element alignment
        $wp_customize->add_setting( 'main_banner_post_elements_alignment', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_post_elements_alignment' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Radio_Tab_Control( $wp_customize, 'main_banner_post_elements_alignment', array(
                'label'	      => esc_html__( 'Elements Alignment', 'blogig' ),
                'section'     => 'main_banner_section',
                'choices' => array(
                    array(
                        'value' => 'left',
                        'label' => esc_html__('Left', 'blogig' )
                    ),
                    array(
                        'value' => 'center',
                        'label' => esc_html__('Center', 'blogig' )
                    ),
                    array(
                        'value' => 'right',
                        'label' => esc_html__('Right', 'blogig' )
                    )
                )
            ))
        );

        // main banner slider settings
        $wp_customize->add_setting( 'main_banner_slider_settings_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'main_banner_slider_settings_heading', array(
                'label' => esc_html__( 'Slider Settings', 'blogig' ),
                'section'   => 'main_banner_section',
                'initial'   => false
            ))
        );
        
        // main banner slider prev arrow
        $wp_customize->add_setting( 'main_banner_slider_prev_arrow', [
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_slider_prev_arrow' ),
            'sanitize_callback'  => 'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'main_banner_slider_prev_arrow', [
                'label' =>  esc_html__( 'Prev Arrow', 'blogig' ),
                'section'   =>  'main_banner_section',
                'settings'  =>  'main_banner_slider_prev_arrow'
            ])
        );

        // main banner slider next arrow
        $wp_customize->add_setting( 'main_banner_slider_next_arrow', [
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_slider_next_arrow' ),
            'sanitize_callback'  => 'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'main_banner_slider_next_arrow', [
                'label' =>  esc_html__( 'Next Arrow', 'blogig' ),
                'section'   =>  'main_banner_section',
                'settings'  =>  'main_banner_slider_next_arrow'
            ])
        );
        
        // main banner show fade
        $wp_customize->add_setting( 'main_banner_show_fade', [
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_show_fade' ),
            'sanitize_callback'  => 'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'main_banner_show_fade', [
                'label' =>  esc_html__( 'Show Fade', 'blogig' ),
                'section'   =>  'main_banner_section',
                'settings'  =>  'main_banner_show_fade'
            ])
        );

        // main banner center mode
        $wp_customize->add_setting( 'main_banner_center_mode', [
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_center_mode' ),
            'sanitize_callback'  => 'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Toggle_Control( $wp_customize, 'main_banner_center_mode', [
                'label' =>  esc_html__( 'Enable Center Mode', 'blogig' ),
                'section'   =>  'main_banner_section',
                'settings'  =>  'main_banner_center_mode',
                'description'   =>  esc_html__( 'Center Mode is not compatible when slider fade is enabled', 'blogig' )
            ])
        );
        
        // main banner image settings
        $wp_customize->add_setting( 'main_banner_image_setting_heading', [
            'sanitize_callback' =>  'sanitize_text_field'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'main_banner_image_setting_heading', [
                'label' =>  esc_html__( 'Image Settings', 'blogig' ),
                'settings'  =>  'main_banner_image_setting_heading',
                'section'   =>  'main_banner_section',
                'initial'   =>  false
            ])
        );

        // main banner image sizes
        $wp_customize->add_setting( 'main_banner_image_sizes', [
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_image_sizes' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);

        $wp_customize->add_control( 'main_banner_image_sizes', [
            'label' =>  esc_html__( 'Image Sizes', 'blogig' ),
            'type'  =>  'select',
            'settings'  =>  'main_banner_image_sizes',
            'section'   =>  'main_banner_section',
            'choices'   =>  blogig_get_image_sizes_option_array_for_customizer()
        ]);

        // main banner image ratio
        $wp_customize->add_setting( 'main_banner_responsive_image_ratio', [
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_responsive_image_ratio' ),
            'sanitize_callback' =>  'blogig_sanitize_responsive_range',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Responsive_Range_Control( $wp_customize, 'main_banner_responsive_image_ratio', [
                'label' =>  esc_html__( 'Image Ratio', 'blogig' ),
                'settings'  =>  'main_banner_responsive_image_ratio',
                'section'   =>  'main_banner_section',
                'unit'  =>  'px',
                'input_attrs'   =>  [
                    'min'   =>  0,
                    'max'   =>  2,
                    'step'  =>  0.1,
                    'reset'    =>  true
                ]
            ])
        );

        // main banner custom css heading
        $wp_customize->add_setting( 'main_banner_custom_css_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'main_banner_custom_css_header', array(
                'label'	      => esc_html__( 'Custom Css', 'blogig' ),
                'section'     => 'main_banner_section'
            ))
        );

        // main banner custom css code control
        $wp_customize->add_setting( 'main_banner_custom_css', [
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_custom_css' ),
            'sanitize_callback' =>  'blogig_sanitize_css_code_control',
            'capability'=> 'edit_css',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control(
            new WP_Customize_Code_Editor_Control( $wp_customize, 'main_banner_custom_css', [
                'label' =>  esc_html__( 'Css code', 'blogig' ),
                'description' =>  esc_html__( 'Enter the valid css code. Type "{wrapper}" before every new line. "{wrapper}" will be replaced by main wrapper i.e ".blogig-main-banner-section"', 'blogig' ),
                'section'   =>  'main_banner_section',
                'code_type'   => 'text/css',
                'input_attrs' => [
                    'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4'
                ]
            ])
        );

        // main banner -> design -> typography
        $wp_customize->add_setting( 'main_banner_design_typography', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'main_banner_design_typography', array(
                'label'	      => esc_html__( 'Typography', 'blogig' ),
                'section'     => 'main_banner_section',
                'settings'    => 'main_banner_design_typography',
                'tab'   =>  'design'
            ))
        );

        // main banner post title typography
        $wp_customize->add_setting( 'main_banner_design_post_title_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_design_post_title_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'main_banner_design_post_title_typography', array(
                'label'	      => esc_html__( 'Title Typo', 'blogig' ),
                'section'     => 'main_banner_section',
                'settings'    => 'main_banner_design_post_title_typography',
                'tab'   =>  'design'
            ))
        );

        // main banner post excerpt typography
        $wp_customize->add_setting( 'main_banner_design_post_excerpt_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_design_post_excerpt_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'main_banner_design_post_excerpt_typography', array(
                'label'	      => esc_html__( 'Excerpt Typo', 'blogig' ),
                'section'     => 'main_banner_section',
                'settings'    => 'main_banner_design_post_excerpt_typography',
                'tab'   =>  'design'
            ))
        );

        // main banner post categories typography
        $wp_customize->add_setting( 'main_banner_design_post_categories_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_design_post_categories_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'main_banner_design_post_categories_typography', array(
                'label'	      => esc_html__( 'Category Typo', 'blogig' ),
                'section'     => 'main_banner_section',
                'settings'    => 'main_banner_design_post_categories_typography',
                'tab'   =>  'design'
            ))
        );

        // main banner post date typography
        $wp_customize->add_setting( 'main_banner_design_post_date_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_design_post_date_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'main_banner_design_post_date_typography', array(
                'label'	      => esc_html__( 'Date Typo', 'blogig' ),
                'section'     => 'main_banner_section',
                'settings'    => 'main_banner_design_post_date_typography',
                'tab'   =>  'design'
            ))
        );

        // main banner post author typography
        $wp_customize->add_setting( 'main_banner_design_post_author_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'main_banner_design_post_author_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'main_banner_design_post_author_typography', array(
                'label'	      => esc_html__( 'Author Typo', 'blogig' ),
                'section'     => 'main_banner_section',
                'settings'    => 'main_banner_design_post_author_typography',
                'tab'   =>  'design'
            ))
        );
    }
    add_action( 'customize_register', 'blogig_main_banner_panel' );
endif;

if( ! function_exists( 'blogig_carousel_panel' ) ) :
    /**
     * Function for carousel panel
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_carousel_panel( $wp_customize ) {
        $wp_customize->add_section( 'carousel_section', [
            'title' =>  esc_html__( 'Carousel', 'blogig' ),
            'priority'  =>  70
        ]);

        // main section heading
        $wp_customize->add_setting( 'carousel_section_heading', [
            'default'   =>  'general',
            'sanitize_callback' =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Section_Tab_Control( 
                $wp_customize,
                'carousel_section_heading', 
                [
                    'section'   =>  'carousel_section',
                    'priority'  =>  1,
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogig' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogig' )
                        ]
                    ]
                ]
            )
        );

        // carousel option
        $wp_customize->add_setting( 'carousel_option', array(
            'default'   => BD\blogig_get_customizer_default( 'carousel_option' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));

        $wp_customize->add_control( 
            new Blogig_WP_Toggle_Control( $wp_customize, 'carousel_option', array(
                'label'	      => esc_html__( 'Show carousel', 'blogig' ),
                'section'     => 'carousel_section',
                'settings'    => 'carousel_option'
            ))
        );

        // carousel display in
        $wp_customize->add_setting( 'carousel_render_in', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_render_in' ),
            'sanitize_callback'  =>  'blogig_sanitize_select_control'
        ));

        $wp_customize->add_control( 'carousel_render_in', array(
            'label' =>  esc_html__( 'Display In', 'blogig' ),
            'section'   =>  'carousel_section',
            'settings'  =>  'carousel_render_in',
            'type'  =>  'select',
            'choices'   =>  [
                'front_page'    =>  esc_html__( 'Front Page', 'blogig' ),
                'posts_page'    =>  esc_html__( 'Posts Page', 'blogig' ),
                'both'    =>  esc_html__( 'Front and Posts Page', 'blogig' )
            ]
        ));

        // carousel no of columns
        $wp_customize->add_setting( 'carousel_no_of_columns', [
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_no_of_columns' ),
            'sanitize_callback' =>  'absint'
        ]);

        $wp_customize->add_control( 'carousel_no_of_columns', [
            'label' =>  esc_html__( 'No of Columns', 'blogig' ),
            'type'  =>  'number',
            'section'   =>  'carousel_section',
            'settings'  =>  'carousel_no_of_columns',
            'input_attrs'   =>  [
                'min'   =>  2,
                'max'   =>  3,
                'step'  =>  1,
                'reset' =>  true
            ]
        ]);

        // carousel post query settings heading
        $wp_customize->add_setting( 'carousel_post_query_settings_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'carousel_post_query_settings_heading', array(
                'label'	      => esc_html__( 'Post Query', 'blogig' ),
                'section'     => 'carousel_section'
            ))
        );

        // carousel slider categories
        $wp_customize->add_setting( 'carousel_slider_categories', array(
            'default' => BD\blogig_get_customizer_default( 'carousel_slider_categories' ),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Categories_Multiselect_Control( $wp_customize, 'carousel_slider_categories', array(
                'label'     => esc_html__( 'Posts Categories', 'blogig' ),
                'section'   => 'carousel_section',
                'settings'  => 'carousel_slider_categories',
                'choices'   => blogig_get_multicheckbox_categories_simple_array()
            ))
        );

        // carousel posts to include
        $wp_customize->add_setting( 'carousel_slider_posts_to_include', array(
            'default' => BD\blogig_get_customizer_default( 'carousel_slider_posts_to_include' ),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Posts_Multiselect_Control( $wp_customize, 'carousel_slider_posts_to_include', array(
                'label'     => esc_html__( 'Posts To Include', 'blogig' ),
                'section'   => 'carousel_section',
                'settings'  => 'carousel_slider_posts_to_include',
                'choices'   => blogig_get_multicheckbox_posts_simple_array()
            ))
        );
        
        // carousel post order
        $wp_customize->add_setting( 'carousel_post_order', [
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_post_order' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);

        $wp_customize->add_control( 'carousel_post_order', [
            'label' =>  esc_html( 'Post Order', 'blogig' ),
            'type'  =>  'select',
            'priority'  =>  10,
            'section'   =>  'carousel_section',
            'settings'  =>  'carousel_post_order',
            'choices'   =>  blogig_post_order_args()
        ]);

        // carousel no of posts to show
        $wp_customize->add_setting( 'carousel_no_of_posts_to_show', [
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_no_of_posts_to_show' ),
            'sanitize_callback' =>  'absint'
        ]);

        $wp_customize->add_control( 'carousel_no_of_posts_to_show', [
            'label' =>  esc_html( 'No of posts to show', 'blogig' ),
            'type'  =>  'number',
            'priority'  =>  10,
            'section'   =>  'carousel_section',
            'settings'  =>  'carousel_no_of_posts_to_show',
            'input_attrs'    => [
                'min'   => 1,
                'max'   => 6,
                'step'  => 1
            ]
        ]);

        // carousel hide post with no featured image
        $wp_customize->add_setting( 'carousel_hide_post_with_no_featured_image', [
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_hide_post_with_no_featured_image' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'carousel_hide_post_with_no_featured_image', [
                'label' =>  esc_html__( 'Hide posts with no featured image', 'blogig' ),
                'section'   =>  'carousel_section',
                'settings'  =>  'carousel_hide_post_with_no_featured_image'
            ])
        );

        // carousel slider settings
        $wp_customize->add_setting( 'carousel_post_elements_settings_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'carousel_post_elements_settings_heading', array(
                'label'	      => esc_html__( 'Post Elements Settings', 'blogig' ),
                'section'     => 'carousel_section'
            ))
        );

        // carousel post element show title
        $wp_customize->add_setting( 'carousel_post_elements_show_title', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_post_elements_show_title' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'carousel_post_elements_show_title', array(
                'label'	      => esc_html__( 'Show Title', 'blogig' ),
                'section'     => 'carousel_section',
                'settings'  =>  'carousel_post_elements_show_title'
            ))
        );

        // carousel post title html tag
        $wp_customize->add_setting( 'carousel_design_post_title_html_tag', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_design_post_title_html_tag' ),
            'sanitize_callback' => 'blogig_sanitize_select_control'
        ));
        
        $wp_customize->add_control( 'carousel_design_post_title_html_tag', array(
            'label'	      => esc_html__( 'Title Tag', 'blogig' ),
            'section'     => 'carousel_section',
            'settings'    => 'carousel_design_post_title_html_tag',
            'tab'   =>  'design',
            'type'  =>  'select',
            'choices'   =>  [
                'h1'    =>  esc_html__( 'H1', 'blogig' ),
                'h2'    =>  esc_html__( 'H2', 'blogig' ),
                'h3'    =>  esc_html__( 'H3', 'blogig' ),
                'h4'    =>  esc_html__( 'H4', 'blogig' ),
                'h5'    =>  esc_html__( 'H5', 'blogig' ),
                'h6'    =>  esc_html__( 'H6', 'blogig' )
            ]
        ));

        // carousel post element show categories
        $wp_customize->add_setting( 'carousel_post_elements_show_categories', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_post_elements_show_categories' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'carousel_post_elements_show_categories', array(
                'label'	      => esc_html__( 'Show Categories', 'blogig' ),
                'section'     => 'carousel_section',
                'settings'  =>  'carousel_post_elements_show_categories'
            ))
        );

        // carousel post element show date
        $wp_customize->add_setting( 'carousel_post_elements_show_date', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_post_elements_show_date' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'carousel_post_elements_show_date', array(
                'label'	      => esc_html__( 'Show Date', 'blogig' ),
                'section'     => 'carousel_section',
                'settings'  =>  'carousel_post_elements_show_date'
            ))
        );

        // carousel post element show author
        $wp_customize->add_setting( 'carousel_post_elements_show_author', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_post_elements_show_author' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'carousel_post_elements_show_author', array(
                'label'	      => esc_html__( 'Show Author', 'blogig' ),
                'section'     => 'carousel_section',
                'settings'  =>  'carousel_post_elements_show_author'
            ))
        );

        // carousel date icon
        $wp_customize->add_setting( 'carousel_date_icon', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_date_icon' ),
            'sanitize_callback' => 'blogig_sanitize_icon_picker_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'carousel_date_icon', array(
                'label'	      => esc_html__( 'Choose Date Icon', 'blogig' ),
                'section'     => 'carousel_section',
                'settings'  =>  'carousel_date_icon'
            ))
        );

        // carousel post element alignment
        $wp_customize->add_setting( 'carousel_post_elements_alignment', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_post_elements_alignment' ),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Radio_Tab_Control( $wp_customize, 'carousel_post_elements_alignment', array(
                'label'	      => esc_html__( 'Elements Alignment', 'blogig' ),
                'section'     => 'carousel_section',
                'choices' => array(
                    array(
                        'value' => 'left',
                        'label' => esc_html__('Left', 'blogig' )
                    ),
                    array(
                        'value' => 'center',
                        'label' => esc_html__('Center', 'blogig' )
                    ),
                    array(
                        'value' => 'right',
                        'label' => esc_html__('Right', 'blogig' )
                    )
                )
            ))
        );

        // carousel slider settings
        $wp_customize->add_setting( 'carousel_slider_settings_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'carousel_slider_settings_heading', array(
                'label'	      => esc_html__( 'Slider Settings', 'blogig' ),
                'section'     => 'carousel_section'
            ))
        );
        
        // carousel slider prev arrow
        $wp_customize->add_setting( 'carousel_slider_prev_arrow', [
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_slider_prev_arrow' ),
            'sanitize_callback'  => 'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'carousel_slider_prev_arrow', [
                'label' =>  esc_html__( 'Prev Arrow', 'blogig' ),
                'section'   =>  'carousel_section',
                'settings'  =>  'carousel_slider_prev_arrow'
            ])
        );

        // carousel slider next arrow
        $wp_customize->add_setting( 'carousel_slider_next_arrow', [
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_slider_next_arrow' ),
            'sanitize_callback'  => 'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'carousel_slider_next_arrow', [
                'label' =>  esc_html__( 'Next Arrow', 'blogig' ),
                'section'   =>  'carousel_section',
                'settings'  =>  'carousel_slider_next_arrow'
            ])
        );

        // carousel slider slides to scroll
        $wp_customize->add_setting( 'carousel_slides_to_scroll', [
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_slides_to_scroll' ),
            'sanitize_callback' =>  'absint'
        ]);

        $wp_customize->add_control( 'carousel_slides_to_scroll', [
            'label' =>  esc_html__( 'Slides to Scroll', 'blogig' ),
            'type'  =>  'number',
            'section'   =>  'carousel_section',
            'settings'  =>  'carousel_slides_to_scroll',
            'input_attrs'   =>  [
                'min'   =>  1,
                'max'   =>  3,
                'step'  =>  1,
                'reset' =>  true
            ]
        ]);

        // carousel image settings
        $wp_customize->add_setting( 'carousel_image_setting_heading', [
            'sanitize_callback' =>  'sanitize_text_field'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'carousel_image_setting_heading', [
                'label' =>  esc_html__( 'Image Settings', 'blogig' ),
                'settings'  =>  'carousel_image_setting_heading',
                'section'   =>  'carousel_section'
            ])
        );

        // carousel image sizes
        $wp_customize->add_setting( 'carousel_image_sizes', [
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_image_sizes' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);

        $wp_customize->add_control( 'carousel_image_sizes', [
            'label' =>  esc_html__( 'Image Sizes', 'blogig' ),
            'type'  =>  'select',
            'settings'  =>  'carousel_image_sizes',
            'section'   =>  'carousel_section',
            'choices'   =>  blogig_get_image_sizes_option_array_for_customizer()
        ]);

        // carousel image ratio
        $wp_customize->add_setting( 'carousel_responsive_image_ratio', [
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_responsive_image_ratio' ),
            'sanitize_callback' =>  'blogig_sanitize_responsive_range',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Responsive_Range_Control( $wp_customize, 'carousel_responsive_image_ratio', [
                'label' =>  esc_html__( 'Image Ratio', 'blogig' ),
                'settings'  =>  'carousel_responsive_image_ratio',
                'section'   =>  'carousel_section',
                'unit'  =>  'px',
                'input_attrs'   =>  [
                    'min'   =>  0,
                    'max'   =>  2,
                    'step'  =>  0.1,
                    'reset'    =>  true
                ]
            ])
        );

        // carousel custom css heading
        $wp_customize->add_setting( 'carousel_custom_css_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'carousel_custom_css_header', array(
                'label'	      => esc_html__( 'Custom Css', 'blogig' ),
                'section'     => 'carousel_section'
            ))
        );

        // carousel custom css code control
        $wp_customize->add_setting( 'carousel_custom_css', [
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_custom_css' ),
            'sanitize_callback' =>  'blogig_sanitize_css_code_control',
            'capability'=> 'edit_css',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control(
            new WP_Customize_Code_Editor_Control( $wp_customize, 'carousel_custom_css', [
                'label' =>  esc_html__( 'Css code', 'blogig' ),
                'description' =>  esc_html__( 'Enter the valid css code. Type "{wrapper}" before every new line. "{wrapper}" will be replaced by main wrapper i.e ".blogig-main-banner-section"', 'blogig' ),
                'section'   =>  'carousel_section',
                'code_type'   => 'text/css',
                'input_attrs' => [
                    'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4'
                ]
            ])
        );

        // carousel -> design tab -> typography
        $wp_customize->add_setting( 'carousel_design_typography', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'carousel_design_typography', array(
                'label'	      => esc_html__( 'Typography', 'blogig' ),
                'section'     => 'carousel_section',
                'settings'    => 'carousel_design_typography',
                'tab'   =>  'design'
            ))
        );

        // carousel post title typography
        $wp_customize->add_setting( 'carousel_design_post_title_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_design_post_title_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'carousel_design_post_title_typography', array(
                'label'	      => esc_html__( 'Title Typo', 'blogig' ),
                'section'     => 'carousel_section',
                'settings'    => 'carousel_design_post_title_typography',
                'tab'   =>  'design'
            ))
        );

        // carousel post excerpt typography
        $wp_customize->add_setting( 'carousel_design_post_excerpt_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_design_post_excerpt_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'carousel_design_post_excerpt_typography', array(
                'label'	      => esc_html__( 'Excerpt Typo', 'blogig' ),
                'section'     => 'carousel_section',
                'settings'    => 'carousel_design_post_excerpt_typography',
                'tab'   =>  'design'
            ))
        );

        // carousel post categories typography
        $wp_customize->add_setting( 'carousel_design_post_categories_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_design_post_categories_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'carousel_design_post_categories_typography', array(
                'label'	      => esc_html__( 'Category Typo', 'blogig' ),
                'section'     => 'carousel_section',
                'settings'    => 'carousel_design_post_categories_typography',
                'tab'   =>  'design'
            ))
        );

         // carousel post date typography
         $wp_customize->add_setting( 'carousel_design_post_date_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_design_post_date_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'carousel_design_post_date_typography', array(
                'label'	      => esc_html__( 'Date Typo', 'blogig' ),
                'section'     => 'carousel_section',
                'settings'    => 'carousel_design_post_date_typography',
                'tab'   =>  'design'
            ))
        );

         // carousel post date typography
         $wp_customize->add_setting( 'carousel_design_post_author_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'carousel_design_post_author_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'carousel_design_post_author_typography', array(
                'label'	      => esc_html__( 'Author Typo', 'blogig' ),
                'section'     => 'carousel_section',
                'settings'    => 'carousel_design_post_author_typography',
                'tab'   =>  'design'
            ))
        );
    }
    add_action( 'customize_register', 'blogig_carousel_panel' );
endif;

if( !function_exists( 'blogig_customizer_colors_panel' ) ) :
    /**
     * Register colors options settings
     * 
     */
    function blogig_customizer_colors_panel( $wp_customize ) {
        // Front sections panel
        $wp_customize->add_panel( 'blogig_colors_panel', array(
            'title' => esc_html__( 'Colors', 'blogig' ),
            'priority'  => 20
        ));

        // presets section
        $wp_customize->add_section('theme_presets_section',[
                'title' =>  esc_html__( 'Theme Colors / Presets', 'blogig' ),
                'panel' =>  'blogig_colors_panel',
                'priority' =>  10
            ]
        );

        // theme colors header
        $wp_customize->add_setting( 'theme_colors_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'theme_colors_heading', array(
                'label' => esc_html__( 'Theme Colors', 'blogig' ),
                'section'   => 'theme_presets_section'
            ))
        );

        // primary preset color
        $wp_customize->add_setting( 'theme_color', array(
            'default'   => BD\blogig_get_customizer_default( 'theme_color' ),
            'sanitize_callback' => 'blogig_sanitize_color_picker_control',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'theme_color', array(
                'label'	      => esc_html__( 'Theme Color', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'theme_color',
                'variable'   => '--blogig-global-preset-theme-color'
            ))
        );

        // gradient theme color
        $wp_customize->add_setting( 'gradient_theme_color', array(
            'default'   => BD\blogig_get_customizer_default( 'gradient_theme_color' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'gradient_theme_color', array(
                'label'	      => esc_html__( 'Gradient Theme Color', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'gradient_theme_color',
                'variable'   => '--blogig-global-preset-gradient-theme-color'
            ))
        );

        // preset colors header
        $wp_customize->add_setting( 'preset_colors_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'preset_colors_heading', array(
                'label' => esc_html__( 'Solid Presets', 'blogig' ),
                'section'   => 'theme_presets_section',
                'initial'   => false
            ))
        );

        // primary preset color
        $wp_customize->add_setting( 'preset_color_1', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_color_1' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'preset_color_1', array(
                'label'	      => esc_html__( 'Color 1', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_color_1',
                'variable'   => '--blogig-global-preset-color-1'
            ))
        );

        // secondary preset color
        $wp_customize->add_setting( 'preset_color_2', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_color_2' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'preset_color_2', array(
                'label'	      => esc_html__( 'Color 2', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_color_2',
                'variable'   => '--blogig-global-preset-color-2'
            ))
        );

        // tertiary preset color
        $wp_customize->add_setting( 'preset_color_3', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_color_3' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'preset_color_3', array(
                'label'	      => esc_html__( 'Color 3', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_color_3',
                'variable'   => '--blogig-global-preset-color-3'
            ))
        );

        // primary preset link color
        $wp_customize->add_setting( 'preset_color_4', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_color_4' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'preset_color_4', array(
                'label'	      => esc_html__( 'Color 4', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_color_4',
                'variable'   => '--blogig-global-preset-color-4'
            ))
        );

        // secondary preset link color
        $wp_customize->add_setting( 'preset_color_5', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_color_5' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'preset_color_5', array(
                'label'	      => esc_html__( 'Color 5', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_color_5',
                'variable'   => '--blogig-global-preset-color-5'
            ))
        );
        
        // tertiary preset link color
        $wp_customize->add_setting( 'preset_color_6', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_color_6' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'preset_color_6', array(
                'label'	      => esc_html__( 'Color 6', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_color_6',
                'variable'   => '--blogig-global-preset-color-6'
            ))
        );

        // tertiary preset link color
        $wp_customize->add_setting( 'preset_color_7', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_color_7' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'preset_color_7', array(
                'label'       => esc_html__( 'Color 7', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_color_7',
                'variable'   => '--blogig-global-preset-color-7'
            ))
        );

        // tertiary preset link color
        $wp_customize->add_setting( 'preset_color_8', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_color_8' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'preset_color_8', array(
                'label'       => esc_html__( 'Color 8', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_color_8',
                'variable'   => '--blogig-global-preset-color-8'
            ))
        );

        // tertiary preset link color
        $wp_customize->add_setting( 'preset_color_9', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_color_9' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'preset_color_9', array(
                'label'       => esc_html__( 'Color 9', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_color_9',
                'variable'   => '--blogig-global-preset-color-9'
            ))
        );

        // tertiary preset link color
        $wp_customize->add_setting( 'preset_color_10', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_color_10' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'preset_color_10', array(
                'label'       => esc_html__( 'Color 10', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_color_10',
                'variable'   => '--blogig-global-preset-color-10'
            ))
        );

        // tertiary preset link color
        $wp_customize->add_setting( 'preset_color_11', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_color_11' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'preset_color_11', array(
                'label'       => esc_html__( 'Color 11', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_color_11',
                'variable'   => '--blogig-global-preset-color-11'
            ))
        );

        // tertiary preset link color
        $wp_customize->add_setting( 'preset_color_12', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_color_12' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Color_Picker_Control( $wp_customize, 'preset_color_12', array(
                'label'       => esc_html__( 'Color 12', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_color_12',
                'variable'   => '--blogig-global-preset-color-12'
            ))
        );

        // gradient preset colors header
        $wp_customize->add_setting( 'gradient_preset_colors_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'gradient_preset_colors_heading', array(
                'label'	      => esc_html__( 'Gradient Presets', 'blogig' ),
                'section'     => 'theme_presets_section',
                'initial'   => false
            ))
        );

        // gradient color 1
        $wp_customize->add_setting( 'preset_gradient_1', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_gradient_1' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'preset_gradient_1', array(
                'label'	      => esc_html__( 'Gradient 1', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_gradient_1',
                'variable'   => '--blogig-global-preset-gradient-color-1'
            ))
        );
        
        // gradient color 2
        $wp_customize->add_setting( 'preset_gradient_2', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_gradient_2' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'preset_gradient_2', array(
                'label'	      => esc_html__( 'Gradient 2', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_gradient_2',
                'variable'   => '--blogig-global-preset-gradient-color-2'
            ))
        );

        // gradient color 3
        $wp_customize->add_setting( 'preset_gradient_3', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_gradient_3' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'preset_gradient_3', array(
                'label'	      => esc_html__( 'Gradient 3', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_gradient_3',
                'variable'   => '--blogig-global-preset-gradient-color-3'
            ))
        );

        // gradient color 4
        $wp_customize->add_setting( 'preset_gradient_4', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_gradient_4' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'preset_gradient_4', array(
                'label'	      => esc_html__( 'Gradient 4', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_gradient_4',
                'variable'   => '--blogig-global-preset-gradient-color-4'
            ))
        );

        // gradient color 5
        $wp_customize->add_setting( 'preset_gradient_5', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_gradient_5' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'preset_gradient_5', array(
                'label'	      => esc_html__( 'Gradient 5', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_gradient_5',
                'variable'   => '--blogig-global-preset-gradient-color-5'
            ))
        );

        // gradient color 6
        $wp_customize->add_setting( 'preset_gradient_6', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_gradient_6' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'preset_gradient_6', array(
                'label'	      => esc_html__( 'Gradient 6', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_gradient_6',
                'variable'   => '--blogig-global-preset-gradient-color-6'
            ))
        );

        // gradient color 7
        $wp_customize->add_setting( 'preset_gradient_7', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_gradient_7' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'preset_gradient_7', array(
                'label'       => esc_html__( 'Gradient 7', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_gradient_7',
                'variable'   => '--blogig-global-preset-gradient-color-7'
            ))
        );

        // gradient color 8
        $wp_customize->add_setting( 'preset_gradient_8', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_gradient_8' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'preset_gradient_8', array(
                'label'       => esc_html__( 'Gradient 8', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_gradient_8',
                'variable'   => '--blogig-global-preset-gradient-color-8'
            ))
        );

        // gradient color 9
        $wp_customize->add_setting( 'preset_gradient_9', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_gradient_9' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'preset_gradient_9', array(
                'label'       => esc_html__( 'Gradient 9', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_gradient_9',
                'variable'   => '--blogig-global-preset-gradient-color-9'
            ))
        );

        // gradient color 10
        $wp_customize->add_setting( 'preset_gradient_10', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_gradient_10' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'preset_gradient_10', array(
                'label'       => esc_html__( 'Gradient 10', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_gradient_10',
                'variable'   => '--blogig-global-preset-gradient-color-10'
            ))
        );

        // gradient color 11
        $wp_customize->add_setting( 'preset_gradient_11', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_gradient_11' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'preset_gradient_11', array(
                'label'       => esc_html__( 'Gradient 11', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_gradient_11',
                'variable'   => '--blogig-global-preset-gradient-color-11'
            ))
        );

        // gradient color 12
        $wp_customize->add_setting( 'preset_gradient_12', array(
            'default'   => BD\blogig_get_customizer_default( 'preset_gradient_12' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Preset_Gradient_Picker_Control( $wp_customize, 'preset_gradient_12', array(
                'label'       => esc_html__( 'Gradient 12', 'blogig' ),
                'section'     => 'theme_presets_section',
                'settings'    => 'preset_gradient_12',
                'variable'   => '--blogig-global-preset-gradient-color-12'
            ))
        );

        // section- category colors section
        $wp_customize->add_section( 'blogig_category_colors_section', array(
            'title' => esc_html__( 'Category Colors', 'blogig' ),
            'panel' => 'blogig_colors_panel',
            'priority'  => 20
        ));

        $totalCats = get_categories();
        if( $totalCats ) :
            foreach( $totalCats as $singleCat ) :
                // banner post query settings heading
                $wp_customize->add_setting( 'category_' .absint($singleCat->term_id). '_color_heading', array(
                    'sanitize_callback' => 'sanitize_text_field'
                ));
                $wp_customize->add_control(
                    new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'category_' .absint($singleCat->term_id). '_color_heading', array(
                        'label'	      => esc_html( $singleCat->name ),
                        'section'     => 'blogig_category_colors_section'
                    ))
                );

                // category colors control
                $wp_customize->add_setting( 'category_' .absint($singleCat->term_id). '_color', [
                    'default'   =>  BD\blogig_get_customizer_default( 'category_' .absint($singleCat->term_id). '_color' ),
                    'sanitize_callback' =>  'blogig_sanitize_color_group_picker_control',
                    'transport' =>  'postMessage'
                ]);
                $wp_customize->add_control(
                    new Blogig_WP_Color_Group_Picker_Control( $wp_customize, 'category_' .absint($singleCat->term_id). '_color', array(
                        'label'     => esc_html__( 'Text Color', 'blogig' ),
                        'section'   => 'blogig_category_colors_section'
                    ))
                );

                // background colors control
                $wp_customize->add_setting( 'category_background_' .absint($singleCat->term_id). '_color', [
                    'default'   =>  BD\blogig_get_customizer_default( 'category_background_' .absint($singleCat->term_id). '_color' ),
                    'sanitize_callback' =>  'sanitize_text_field',
                    'transport' =>  'postMessage'
                ]);
                $wp_customize->add_control(
                    new Blogig_WP_Background_Color_Group_Picker_Control( $wp_customize, 'category_background_' .absint($singleCat->term_id). '_color', array(
                        'label'     => esc_html__( 'Background', 'blogig' ),
                        'section'   => 'blogig_category_colors_section'
                    ))
                );
            endforeach;
        endif;

        // section- tag colors section
        $wp_customize->add_section( 'blogig_tag_colors_section', array(
            'title' => esc_html__( 'Tag Colors', 'blogig' ),
            'panel' => 'blogig_colors_panel',
            'priority'  => 30
        ));

        $totalTags = get_tags();
        if( $totalTags ) :
            foreach( $totalTags as $singleTag ) :
                // banner post query settings heading
                $wp_customize->add_setting( 'tag_' .absint($singleTag->term_id). '_color_heading', array(
                    'sanitize_callback' => 'sanitize_text_field'
                ));
                $wp_customize->add_control(
                    new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'tag_' .absint($singleTag->term_id). '_color_heading', array(
                        'label'	      => esc_html( $singleTag->name ),
                        'section'     => 'blogig_tag_colors_section'
                    ))
                );

                // tag colors control
                $wp_customize->add_setting( 'tag_' .absint($singleTag->term_id). '_color', [
                    'default'   =>  BD\blogig_get_customizer_default( 'tag_' .absint($singleTag->term_id). '_color' ),
                    'sanitize_callback' =>  'blogig_sanitize_color_group_picker_control',
                    'transport' =>  'postMessage'
                ]);
                $wp_customize->add_control(
                    new Blogig_WP_Color_Group_Picker_Control( $wp_customize, 'tag_' .absint($singleTag->term_id). '_color', array(
                        'label'     => esc_html__( 'Text Color', 'blogig' ),
                        'section'   => 'blogig_tag_colors_section'
                    ))
                );

                // background colors control
                $wp_customize->add_setting( 'tag_background_' .absint($singleTag->term_id). '_color', [
                    'default'   =>  BD\blogig_get_customizer_default( 'tag_background_' .absint($singleTag->term_id). '_color' ),
                    'sanitize_callback' =>  'sanitize_text_field',
                    'transport' =>  'postMessage'
                ]);
                $wp_customize->add_control(
                    new Blogig_WP_Background_Color_Group_Picker_Control( $wp_customize, 'tag_background_' .absint($singleTag->term_id). '_color', array(
                        'label'     => esc_html__( 'Background', 'blogig' ),
                        'section'   => 'blogig_tag_colors_section'
                    ))
                );
            endforeach;
        endif;
    }
    add_action( 'customize_register', 'blogig_customizer_colors_panel' );
endif;

if( !function_exists( 'blogig_customizer_global_panel' ) ) :
    /**
     * Register global options settings
     * 
     */
    function blogig_customizer_global_panel( $wp_customize ) {
        /**
         * Global panel
         * 
         * @package Blogig
         * @since 1.0.0
         */
        $wp_customize->add_panel( 'blogig_global_panel', array(
            'title' => esc_html__( 'Global', 'blogig' ),
            'priority'  => 6
        ));

        // section- seo/misc settings section
        $wp_customize->add_section( 'blogig_seo_misc_section', array(
            'title' => esc_html__( 'SEO / Misc', 'blogig' ),
            'panel' => 'blogig_global_panel'
        ));

        // site schema ready option
        $wp_customize->add_setting( 'site_schema_ready', array(
            'default'   => BD\blogig_get_customizer_default( 'site_schema_ready' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control',
            'transport'    => 'postMessage'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Toggle_Control( $wp_customize, 'site_schema_ready', array(
                'label'	      => esc_html__( 'Make website schema ready', 'blogig' ),
                'section'     => 'blogig_seo_misc_section',
                'settings'    => 'site_schema_ready'
            ))
        );

        // site date to show
        $wp_customize->add_setting( 'site_date_to_show', array(
            'sanitize_callback' => 'blogig_sanitize_select_control',
            'default'   => BD\blogig_get_customizer_default( 'site_date_to_show' )
        ));
        $wp_customize->add_control( 'site_date_to_show', array(
            'type'      => 'select',
            'section'   => 'blogig_seo_misc_section',
            'label'     => esc_html__( 'Date to display', 'blogig' ),
            'description' => esc_html__( 'Whether to show date published or modified date.', 'blogig' ),
            'choices'   => array(
                'published'  => __( 'Published date', 'blogig' ),
                'modified'   => __( 'Modified date', 'blogig' )
            )
        ));

        // site date format
        $wp_customize->add_setting( 'site_date_format', array(
            'sanitize_callback' => 'blogig_sanitize_select_control',
            'default'   => BD\blogig_get_customizer_default( 'site_date_format' )
        ));
        $wp_customize->add_control( 'site_date_format', array(
            'type'      => 'select',
            'section'   => 'blogig_seo_misc_section',
            'label'     => esc_html__( 'Date format', 'blogig' ),
            'description' => esc_html__( 'Date format applied to single and archive pages.', 'blogig' ),
            'choices'   => array(
                'theme_format'  => __( 'Default by theme', 'blogig' ),
                'default'   => __( 'Wordpress default date', 'blogig' )
            )
        ));

        // notices header
        $wp_customize->add_setting( 'blogig_disable_admin_notices_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Section_Heading_Control( $wp_customize, 'blogig_disable_admin_notices_heading', array(
                'label'	      => esc_html__( 'Admin Settings', 'blogig' ),
                'section'     => 'blogig_seo_misc_section',
                'settings'    => 'blogig_disable_admin_notices_heading'
            ))
        );

        // site notices option
        $wp_customize->add_setting( 'blogig_disable_admin_notices', array(
            'default'   => BD\blogig_get_customizer_default( 'blogig_disable_admin_notices' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control',
            'transport'    => 'postMessage'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Toggle_Control( $wp_customize, 'blogig_disable_admin_notices', array(
                'label'	      => esc_html__( 'Disabled the theme admin notices', 'blogig' ),
                'description'	      => esc_html__( 'This will hide all the notices or any message shown by the theme like review notices, upgrade log, change log notices', 'blogig' ),
                'section'     => 'blogig_seo_misc_section',
                'settings'    => 'blogig_disable_admin_notices'
            ))
        );

        // section- preloader section
        $wp_customize->add_section( 'blogig_preloader_section', array(
            'title' => esc_html__( 'Preloader', 'blogig' ),
            'panel' => 'blogig_global_panel'
        ));
        
        // preloader option
        $wp_customize->add_setting( 'preloader_option', array(
            'default'   => BD\blogig_get_customizer_default('preloader_option'),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'preloader_option', array(
                'label'	      => esc_html__( 'Enable site preloader', 'blogig' ),
                'section'     => 'blogig_preloader_section',
                'settings'    => 'preloader_option'
            ))
        );

        // section- website layout section
        $wp_customize->add_section( 'blogig_website_layout_section', array(
            'title' => esc_html__( 'Website Layout', 'blogig' ),
            'panel' => 'blogig_global_panel'
        ));
        
        // website layout heading
        $wp_customize->add_setting( 'website_layout_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Section_Heading_Control( $wp_customize, 'website_layout_header', array(
                'label'	      => esc_html__( 'Website Layout', 'blogig' ),
                'section'     => 'blogig_website_layout_section',
                'settings'    => 'website_layout_header'
            ))
        );

        // website layout
        $wp_customize->add_setting( 'website_layout',
            array(
            'default'           => BD\blogig_get_customizer_default( 'website_layout' ),
            'sanitize_callback' => 'blogig_sanitize_select_control',
            )
        );
        $wp_customize->add_control( 
            new Blogig_WP_Radio_Image_Control( $wp_customize, 'website_layout',
            array(
                'section'  => 'blogig_website_layout_section',
                'choices'  => array(
                    'boxed--layout' => array(
                        'label' => esc_html__( 'Boxed', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/boxed-width.png'
                    ),
                    'full-width--layout' => array(
                        'label' => esc_html__( 'Full Width', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/full-width.png'
                    )
                )
            )
        ));
        
        // section- animation section
        $wp_customize->add_section( 'blogig_animation_section', array(
            'title' => esc_html__( 'Animation / Hover Effects', 'blogig' ),
            'panel' => 'blogig_global_panel'
        ));
        
        // post title animation effects 
        $wp_customize->add_setting( 'post_title_hover_effects', array(
            'sanitize_callback' => 'blogig_sanitize_select_control',
            'default'   => BD\blogig_get_customizer_default( 'post_title_hover_effects' ),
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control( 'post_title_hover_effects', array(
            'type'      => 'select',
            'section'   => 'blogig_animation_section',
            'label'     => esc_html__( 'Post title hover effects', 'blogig' ),
            'description' => esc_html__( 'Applied to post titles listed in archive pages.', 'blogig' ),
            'choices'   => array(
                'none' => __( 'None', 'blogig' ),
                'one'  => __( 'Effect one', 'blogig' ),
                'two'  => __( 'Effect Two', 'blogig' )    
            )
        ));

        // site image animation effects 
        $wp_customize->add_setting( 'site_image_hover_effects', array(
            'sanitize_callback' => 'blogig_sanitize_select_control',
            'default'   => BD\blogig_get_customizer_default( 'site_image_hover_effects' ),
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control( 'site_image_hover_effects', array(
            'type'      => 'select',
            'section'   => 'blogig_animation_section',
            'label'     => esc_html__( 'Image hover effects', 'blogig' ),
            'description' => esc_html__( 'Applied to post thumbanails listed in archive pages.', 'blogig' ),
            'choices'   => array(
                'none' => __( 'None', 'blogig' ),
                'one'  => __( 'Effect One', 'blogig' ),
                'two'  => __( 'Effect Two', 'blogig' )
            )
        ));

        // section- social icons section
        $wp_customize->add_section( 'blogig_social_icons_section', array(
            'title' => esc_html__( 'Social Icons', 'blogig' ),
            'panel' => 'blogig_global_panel'
        ));
        
        // social icons setting heading
        $wp_customize->add_setting( 'social_icons_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Section_Heading_Control( $wp_customize, 'social_icons_settings_header', array(
                'label'	      => esc_html__( 'Social Icons Settings', 'blogig' ),
                'section'     => 'blogig_social_icons_section',
                'settings'    => 'social_icons_settings_header'
            ))
        );

        // social icons target attribute value
        $wp_customize->add_setting( 'social_icons_target', array(
            'sanitize_callback' => 'blogig_sanitize_select_control',
            'default'   => BD\blogig_get_customizer_default( 'social_icons_target' ),
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control( 'social_icons_target', array(
            'type'      => 'select',
            'section'   => 'blogig_social_icons_section',
            'label'     => esc_html__( 'Social Icon Link Open in', 'blogig' ),
            'description' => esc_html__( 'Sets the target attribute according to the value.', 'blogig' ),
            'choices'   => array(
                '_blank' => esc_html__( 'Open link in new tab', 'blogig' ),
                '_self'  => esc_html__( 'Open link in same tab', 'blogig' )
            )
        ));

        // social icons items
        $wp_customize->add_setting( 'social_icons', array(
            'default'   => BD\blogig_get_customizer_default( 'social_icons' ),
            'sanitize_callback' => 'blogig_sanitize_repeater_control',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Custom_Repeater( $wp_customize, 'social_icons', array(
                'label'         => esc_html__( 'Social Icons', 'blogig' ),
                'description'   => esc_html__( 'Hold bar icon and drag vertically to re-order the icons', 'blogig' ),
                'section'       => 'blogig_social_icons_section',
                'settings'      => 'social_icons',
                'row_label'     => 'inherit-icon_class',
                'add_new_label' => esc_html__( 'Add New Icon', 'blogig' ),
                'fields'        => array(
                    'icon_class'   => array(
                        'type'          => 'fontawesome-icon-picker',
                        'label'         => esc_html__( 'Social Icon', 'blogig' ),
                        'description'   => esc_html__( 'Select from dropdown.', 'blogig' ),
                        'default'       => esc_attr( 'fab fa-instagram' )

                    ),
                    'icon_url'  => array(
                        'type'      => 'url',
                        'label'     => esc_html__( 'URL for icon', 'blogig' ),
                        'default'   => ''
                    ),
                    'item_option'             => 'show'
                )
            ))
        );
        
        // site title custom css heading
        $wp_customize->add_setting( 'social_icon_custom_css_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'social_icon_custom_css_header', array(
                'label'	      => esc_html__( 'Custom Css', 'blogig' ),
                'section'     => 'blogig_social_icons_section'
            ))
        );

        // site title custom css code control
        $wp_customize->add_setting( 'social_icon_custom_css', [
            'default'   =>  BD\blogig_get_customizer_default( 'social_icon_custom_css' ),
            'sanitize_callback' =>  'blogig_sanitize_css_code_control',
            'capability'=> 'edit_css',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control(
            new WP_Customize_Code_Editor_Control( $wp_customize, 'social_icon_custom_css', [
                'label' =>  esc_html__( 'Css code', 'blogig' ),
                'description' =>  esc_html__( 'Enter the valid css code. Type "{wrapper}" before every new line. "{wrapper}" will be replaced by main wrapper i.e ".blogig-social-icon"', 'blogig' ),
                'section'   =>  'blogig_social_icons_section',
                'code_type'   => 'text/css',
                'input_attrs' => [
                    'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4'
                ]
            ])
        );

        // section- breadcrumb options section
        $wp_customize->add_section( 'blogig_breadcrumb_options_section', array(
            'title' => esc_html__( 'Breadcrumb Options', 'blogig' ),
            'panel' => 'blogig_global_panel'
        ));

        // breadcrumb option
        $wp_customize->add_setting( 'site_breadcrumb_option', array(
            'default'   => BD\blogig_get_customizer_default( 'site_breadcrumb_option' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'site_breadcrumb_option', array(
                'label'	      => esc_html__( 'Show breadcrumb trails', 'blogig' ),
                'section'     => 'blogig_breadcrumb_options_section',
                'settings'    => 'site_breadcrumb_option'
            ))
        );

        // breadcrumb type 
        $wp_customize->add_setting( 'site_breadcrumb_type', array(
            'sanitize_callback' => 'blogig_sanitize_select_control',
            'default'   => BD\blogig_get_customizer_default( 'site_breadcrumb_type' )
        ));
        $wp_customize->add_control( 'site_breadcrumb_type', array(
            'type'      => 'select',
            'section'   => 'blogig_breadcrumb_options_section',
            'label'     => esc_html__( 'Breadcrumb type', 'blogig' ),
            'description' => esc_html__( 'If you use other than "default" one you will need to install and activate respective plugins Breadcrumb NavXT, Yoast SEO and Rank Math SEO', 'blogig' ),
            'choices'   => array(
                'default' => __( 'Default', 'blogig' ),
                'bcn'  => __( 'NavXT', 'blogig' ),
                'yoast'  => __( 'Yoast SEO', 'blogig' ),
                'rankmath'  => __( 'Rank Math', 'blogig' )
            )
        ));

        // breadcrumb custom css heading
        $wp_customize->add_setting( 'breadcrumb_custom_css_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'breadcrumb_custom_css_header', array(
                'label'	      => esc_html__( 'Custom Css', 'blogig' ),
                'section'     => 'blogig_breadcrumb_options_section'
            ))
        );

        // breadcrumb custom css code control
        $wp_customize->add_setting( 'breadcrumb_custom_css', [
            'default'   =>  BD\blogig_get_customizer_default( 'breadcrumb_custom_css' ),
            'sanitize_callback' =>  'blogig_sanitize_css_code_control',
            'capability'=> 'edit_css',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control(
            new WP_Customize_Code_Editor_Control( $wp_customize, 'breadcrumb_custom_css', [
                'label' =>  esc_html__( 'Css code', 'blogig' ),
                'description' =>  esc_html__( 'Enter the valid css code. Type "{wrapper}" before every new line. "{wrapper}" will be replaced by main wrapper i.e ".blogig-breadcrumb-wrap"', 'blogig' ),
                'section'   =>  'blogig_breadcrumb_options_section',
                'code_type'   => 'text/css',
                'input_attrs' => [
                    'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4'
                ]
            ])
        );

        // section- scroll to top options
        $wp_customize->add_section( 'blogig_stt_options_section', array(
            'title' => esc_html__( 'Scroll To Top', 'blogig' ),
            'panel' => 'blogig_global_panel'
        ));

        // scroll to top section tab
        $wp_customize->add_setting( 'stt_section_tab', array(
            'sanitize_callback' => 'sanitize_text_field',
            'default'   => 'general'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Section_Tab_Control( $wp_customize, 'stt_section_tab', array(
                'section'     => 'blogig_stt_options_section',
                'choices'  => array(
                    array(
                        'name'  => 'general',
                        'title'  => esc_html__( 'General', 'blogig' )
                    ),
                    array(
                        'name'  => 'design',
                        'title'  => esc_html__( 'Design', 'blogig' )
                    )
                )
            ))
        );

        // scroll to top option
        $wp_customize->add_setting( 'blogig_scroll_to_top_option', array(
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_scroll_to_top_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Toggle_Control( $wp_customize, 'blogig_scroll_to_top_option', array(
                'label' =>  esc_html__( 'Show Scroll to Top', 'blogig' ),
                'section'   =>  'blogig_stt_options_section'
            ))
        );

        // scroll to top - button label
        $wp_customize->add_setting( 'stt_text', [
            'default'   =>  BD\blogig_get_customizer_default( 'stt_text' ),
            'sanitize_callback'  =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control( 'stt_text', [
            'label' =>  esc_html__( 'Button Label', 'blogig' ),
            'section'   =>  'blogig_stt_options_section',
            'settings'  =>  'stt_text',
            'type'  =>  'text'
        ]);

        // scroll to top - button icon
        $wp_customize->add_setting( 'stt_icon', [
            'default'   =>  BD\blogig_get_customizer_default( 'stt_icon' ),
            'sanitize_callback' =>  'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'stt_icon', [
                'label' =>  esc_html__( 'Button icon', 'blogig' ),
                'section'   =>  'blogig_stt_options_section',
                'settings'  =>  'stt_icon'
            ])
        );

        // scroll to top align
        $wp_customize->add_setting( 'stt_alignment', array(
            'default' => BD\blogig_get_customizer_default( 'stt_alignment' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Radio_Tab_Control( $wp_customize, 'stt_alignment', array(
                'label'	      => esc_html__( 'Button Align', 'blogig' ),
                'section'     => 'blogig_stt_options_section',
                'settings'    => 'stt_alignment',
                'choices' => array(
                    array(
                        'value' => 'left',
                        'label' => esc_html__('Left', 'blogig' )
                    ),
                    array(
                        'value' => 'center',
                        'label' => esc_html__('Center', 'blogig' )
                    ),
                    array(
                        'value' => 'right',
                        'label' => esc_html__('Right', 'blogig' )
                    )
                )
            ))
        );

        // scroll to top custom css heading
        $wp_customize->add_setting( 'scroll_to_top_custom_css_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'scroll_to_top_custom_css_header', array(
                'label'	      => esc_html__( 'Custom Css', 'blogig' ),
                'section'     => 'blogig_stt_options_section'
            ))
        );

        // scroll to top custom css code control
        $wp_customize->add_setting( 'scroll_to_top_custom_css', [
            'default'   =>  BD\blogig_get_customizer_default( 'scroll_to_top_custom_css' ),
            'sanitize_callback' =>  'blogig_sanitize_css_code_control',
            'capability'=> 'edit_css',
            'transport' => 'postMessage'
        ]);
        $wp_customize->add_control(
            new WP_Customize_Code_Editor_Control( $wp_customize, 'scroll_to_top_custom_css', [
                'label' =>  esc_html__( 'Css code', 'blogig' ),
                'description' =>  esc_html__( 'Enter the valid css code. Type "{wrapper}" before every new line. "{wrapper}" will be replaced by main wrapper i.e "#blogig-scroll-to-top"', 'blogig' ),
                'section'   =>  'blogig_stt_options_section',
                'code_type'   => 'text/css',
                'input_attrs' => [
                    'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4'
                ]
            ])
        );

        // stt label color
        $wp_customize->add_setting( 'stt_color_group', array(
            'default'   => BD\blogig_get_customizer_default( 'stt_color_group' ),
            'sanitize_callback' => 'blogig_sanitize_color_group_picker_control',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Color_Group_Picker_Control( $wp_customize, 'stt_color_group', array(
                'label'     => esc_html__( 'Icon Text', 'blogig' ),
                'section'   => 'blogig_stt_options_section',
                'settings'  => 'stt_color_group',
                'tab'   => 'design'
            ))
        );

        // breadcrumb link color
        $wp_customize->add_setting( 'stt_background_color_group', array(
            'default'   => BD\blogig_get_customizer_default( 'stt_background_color_group' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Background_Color_Group_Picker_Control( $wp_customize, 'stt_background_color_group', array(
                'label'     => esc_html__( 'Background', 'blogig' ),
                'section'   => 'blogig_stt_options_section',
                'settings'  => 'stt_background_color_group',
                'tab'   => 'design'
            ))
        );

        // section- sidebar options
        $wp_customize->add_section( 'blogig_global_sidebar_sticky_section', array(
            'title' => esc_html__( 'Sidebar Sticky', 'blogig' ),
            'panel' => 'blogig_global_panel'
        ));

        $wp_customize->add_setting( 'sidebar_sticky_option', array(
            'default'   =>  BD\blogig_get_customizer_default( 'sidebar_sticky_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control',
            'transport' =>  'postMessage'
        ));

        $wp_customize->add_control( 
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'sidebar_sticky_option', array(
                'label'	      => esc_html__( 'Enable Sidebar Sticky', 'blogig' ),
                'section'     => 'blogig_global_sidebar_sticky_section'
            ))
        );
    }
    add_action( 'customize_register', 'blogig_customizer_global_panel', 10 );
endif;

if( ! function_exists( 'blogig_blog_archive_panel' ) ) :
    /**
     * Function for theme blog / archives panel
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_blog_archive_panel( $wp_customize ) {
        $wp_customize->add_panel(
            'blog_archive_panel',
            [
                'title' =>  __( 'Blog / Archives', 'blogig' ),
                'priority'  =>  80
            ]
        );

        // archive layouts page
        $wp_customize->add_section( 'archive_general_section', [
            'title' =>  esc_html__( 'General Settings', 'blogig' ),
            'panel'  =>  'blog_archive_panel',
            'priority'  =>  10
        ]);

        // archive section heading
        $wp_customize->add_setting( 'archive_section_heading', [
            'default'   =>  'general',
            'sanitize_callback' =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Section_Tab_Control( $wp_customize, 'archive_section_heading', 
                [
                    'section'   =>  'archive_general_section',
                    'priority'  =>  1,
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogig' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogig' )
                        ]
                    ]
                ]
            )
        );

        // archive layouts settings heading
        $wp_customize->add_setting( 'archive_layouts_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'archive_layouts_settings_header', array(
                'label'	      => esc_html__( 'Layouts Settings', 'blogig' ),
                'section'     => 'archive_general_section'
            ))
        );

        // archive posts column
        $wp_customize->add_setting( 'archive_post_column', array(
            'default'   => BD\blogig_get_customizer_default( 'archive_post_column' ),
            'sanitize_callback' => 'blogig_sanitize_responsive_range',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Responsive_Range_Control( $wp_customize, 'archive_post_column', array(
                'label' => esc_html__( 'No. of columns', 'blogig' ),
                'section'   => 'archive_general_section',
                'settings'  => 'archive_post_column',
                'unit'  => 'px',
                'input_attrs' => [
                    'max'   => 3,
                    'min'   => 1,
                    'step'  => 1,
                    'reset' => true
                ]
            ))
        );
        
        // archive posts layout
        $wp_customize->add_setting( 'archive_post_layout', array(
            'default'           => BD\blogig_get_customizer_default( 'archive_post_layout' ),
            'sanitize_callback' => 'blogig_sanitize_select_control',
        ));
        $wp_customize->add_control(
            new Blogig_WP_Radio_Image_Control( $wp_customize, 'archive_post_layout', [
                'label' =>  __( 'Archive Layout', 'blogig' ),
                'section'   =>  'archive_general_section',
                'choices'  => array(
                    'grid' => array(
                        'label' => esc_html__( 'Grid', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/archive-grid.png'
                    ),
                    'list' => array(
                        'label' => esc_html__( 'List', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/archive-list.png'
                    ),
                    'masonry' => array(
                        'label' => esc_html__( 'Masonry', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/archive-masonry.png'
                    )
                )
            ])
        );

        // archive sidebar layout
        $wp_customize->add_setting( 'archive_sidebar_layout', array(
            'default'           => BD\blogig_get_customizer_default( 'archive_sidebar_layout' ),
            'sanitize_callback' => 'blogig_sanitize_select_control',
        ));
        $wp_customize->add_control(
            new Blogig_WP_Radio_Image_Control( $wp_customize, 'archive_sidebar_layout', [
                'label' =>  __( 'Sidebar Layout', 'blogig' ),
                'section'   =>  'archive_general_section',
                'choices'  => array(
                    'right-sidebar' => array(
                        'label' => esc_html__( 'Right Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/right-sidebar.png'
                    ),
                    'left-sidebar' => array(
                        'label' => esc_html__( 'Left Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/left-sidebar.png'
                    ),
                    'both-sidebar' => array(
                        'label' => esc_html__( 'Both Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/both-sidebar.png'
                    ),
                    'no-sidebar' => array(
                        'label' => esc_html__( 'No Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/no-sidebar.png'
                    )
                )
            ])
        );
        
        // archive elements settings heading
        $wp_customize->add_setting( 'archive_elements_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'archive_elements_settings_header', array(
                'label'	      => esc_html__( 'Elements Settings', 'blogig' ),
                'section'     => 'archive_general_section'
            ))
        );
        
        // archive post elements alignment
        $wp_customize->add_setting( 'archive_post_elements_alignment', array(
            'default' => BD\blogig_get_customizer_default( 'archive_post_elements_alignment' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Radio_Tab_Control( $wp_customize, 'archive_post_elements_alignment', array(
                'label'	      => esc_html__( 'Elements Alignment', 'blogig' ),
                'section'     => 'archive_general_section',
                'choices' => array(
                    array(
                        'value' => 'left',
                        'label' => esc_html__('Left', 'blogig' )
                    ),
                    array(
                        'value' => 'center',
                        'label' => esc_html__('Center', 'blogig' )
                    ),
                    array(
                        'value' => 'right',
                        'label' => esc_html__('Right', 'blogig' )
                    )
                )
            ))
        );

        // post title option
        $wp_customize->add_setting( 'archive_title_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_title_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'archive_title_option', [
                'label' =>  esc_html__( 'Show post title', 'blogig' ),
                'section'   =>  'archive_general_section'
            ])
        );

        // post title tag
        $wp_customize->add_setting( 'archive_title_tag', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_title_tag' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);
        $wp_customize->add_control( 'archive_title_tag', [
                'label' =>  esc_html__( 'Title Tag', 'blogig' ),
                'section'   =>  'archive_general_section',
                'type'  =>  'select',
                'choices'   =>  apply_filters( 'blogig_get_title_tags_array_filter', [] )
            ]
        );

        // post excerpt option
        $wp_customize->add_setting( 'archive_excerpt_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_excerpt_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'archive_excerpt_option', [
                'label' =>  esc_html__( 'Show post excerpt', 'blogig' ),
                'section'   =>  'archive_general_section'
            ])
        );

        // post category option
        $wp_customize->add_setting( 'archive_category_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_category_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'archive_category_option', [
                'label' =>  esc_html__( 'Show post category', 'blogig' ),
                'section'   =>  'archive_general_section'
            ])
        );

        // post date option
        $wp_customize->add_setting( 'archive_date_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_date_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'archive_date_option', [
                'label' =>  esc_html__( 'Show post date', 'blogig' ),
                'section'   =>  'archive_general_section'
            ])
        );

        // archive date icon
        $wp_customize->add_setting( 'archive_date_icon', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_date_icon' ),
            'sanitize_callback'   =>  'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'archive_date_icon', 
                [
                    'label' =>  esc_html__( 'Date Icon', 'blogig' ),
                    'section'   =>  'archive_general_section'
                ]
            )
        );

        // post read time option
        $wp_customize->add_setting( 'archive_read_time_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_read_time_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'archive_read_time_option', [
                'label' =>  esc_html__( 'Show post read time', 'blogig' ),
                'section'   =>  'archive_general_section'
            ])
        );
        
        // archive read time icon
        $wp_customize->add_setting( 'archive_read_time_icon', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_read_time_icon' ),
            'sanitize_callback'   =>  'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'archive_read_time_icon', 
                [
                    'label' =>  esc_html__( 'Read Time Icon', 'blogig' ),
                    'section'   =>  'archive_general_section'
                ]
            )
        );

        // post comments option
        $wp_customize->add_setting( 'archive_comments_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_comments_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'archive_comments_option', [
                'label' =>  esc_html__( 'Show comments number', 'blogig' ),
                'section'   =>  'archive_general_section'
            ])
        );
        
        // archive read time icon
        $wp_customize->add_setting( 'archive_comments_icon', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_comments_icon' ),
            'sanitize_callback'   =>  'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'archive_comments_icon', 
                [
                    'label' =>  esc_html__( 'Comments Icon', 'blogig' ),
                    'section'   =>  'archive_general_section'
                ]
            )
        );

        // post author option
        $wp_customize->add_setting( 'archive_author_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_author_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'archive_author_option', [
                'label' =>  esc_html__( 'Show author', 'blogig' ),
                'section'   =>  'archive_general_section'
            ])
        );

        // post button option
        $wp_customize->add_setting( 'archive_button_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_button_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'archive_button_option', [
                'label' =>  esc_html__( 'Show button', 'blogig' ),
                'section'   =>  'archive_general_section'
            ])
        );

        // post button text
        $wp_customize->add_setting( 'archive_button_text', array(
            'default' => BD\blogig_get_customizer_default( 'archive_button_text' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' =>  'postMessage'
        ));
        $wp_customize->add_control( 'archive_button_text', array(
            'label'     => esc_html__( 'Button Text', 'blogig' ),
            'type'      => 'text',
            'section'   => 'archive_general_section'
        ));

        // archive button icon
        $wp_customize->add_setting( 'archive_button_icon', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_button_icon' ),
            'sanitize_callback'   =>  'blogig_sanitize_icon_picker_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'archive_button_icon', 
                [
                    'label' =>  esc_html__( 'Button Icon', 'blogig' ),
                    'section'   =>  'archive_general_section'
                ]
            )
        );

        // archive image settings
        $wp_customize->add_setting( 'archive_image_setting_heading', [
            'sanitize_callback' =>  'sanitize_text_field'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'archive_image_setting_heading', [
                'label' =>  esc_html__( 'Image Settings', 'blogig' ),
                'settings'  =>  'archive_image_setting_heading',
                'section'   =>  'archive_general_section'
            ])
        );

        // archive image sizes
        $wp_customize->add_setting( 'archive_image_size', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_image_size' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);

        $wp_customize->add_control( 'archive_image_size', [
            'label' =>  esc_html__( 'Image Sizes', 'blogig' ),
            'type'  =>  'select',
            'settings'  =>  'archive_image_size',
            'section'   =>  'archive_general_section',
            'choices'   =>  blogig_get_image_sizes_option_array_for_customizer()
        ]);

        // archive image ratio
        $wp_customize->add_setting( 'archive_responsive_image_ratio', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_responsive_image_ratio' ),
            'sanitize_callback' =>  'blogig_sanitize_responsive_range',
            'transport' =>  'postMessage'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Responsive_Range_Control( $wp_customize, 'archive_responsive_image_ratio', [
                'label' =>  esc_html__( 'Image Ratio', 'blogig' ),
                'settings'  =>  'archive_responsive_image_ratio',
                'section'   =>  'archive_general_section',
                'unit'  =>  'px',
                'input_attrs'   =>  [
                    'min'   =>  0,
                    'max'   =>  2,
                    'step'  =>  0.1,
                    'reset'    =>  true
                ]
            ])
        );

        // archive typography heading
        $wp_customize->add_setting( 'archive_typography_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'archive_typography_header', array(
                'label' => esc_html__( 'Typography', 'blogig' ),
                'section'   => 'archive_general_section',
                'tab'   => 'design'
            ))
        );

        // archive 
        $wp_customize->add_setting( 'archive_title_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_title_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_title_typo', [
                'label' =>  esc_html__( 'Post Title', 'blogig' ),
                'section'   =>  'archive_general_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // archive excerpt typo
        $wp_customize->add_setting( 'archive_excerpt_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_excerpt_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_excerpt_typo', [
                'label' =>  esc_html__( 'Excerpt Typo', 'blogig' ),
                'section'   =>  'archive_general_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // archive category typo
        $wp_customize->add_setting( 'archive_category_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_category_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_category_typo', [
                'label' =>  esc_html__( 'Category Typo', 'blogig' ),
                'section'   =>  'archive_general_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // archive date typo
        $wp_customize->add_setting( 'archive_date_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_date_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_date_typo', [
                'label' =>  esc_html__( 'Date Typo', 'blogig' ),
                'section'   =>  'archive_general_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // archive author typo
        $wp_customize->add_setting( 'archive_author_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_author_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_author_typo', [
                'label' =>  esc_html__( 'Author Typo', 'blogig' ),
                'section'   =>  'archive_general_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // archive read time typo
        $wp_customize->add_setting( 'archive_read_time_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_read_time_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_read_time_typo', [
                'label' =>  esc_html__( 'Read Time Typo', 'blogig' ),
                'section'   =>  'archive_general_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // archive comment typo
        $wp_customize->add_setting( 'archive_comment_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_comment_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_comment_typo', [
                'label' =>  esc_html__( 'Comment Typo', 'blogig' ),
                'section'   =>  'archive_general_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // archive button typo
        $wp_customize->add_setting( 'archive_button_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_button_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_button_typo', [
                'label' =>  esc_html__( 'Button Typo', 'blogig' ),
                'section'   =>  'archive_general_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // category archive page
        $wp_customize->add_section( 'category_archive_section', [
            'title' =>  esc_html__( 'Category Page', 'blogig' ),
            'panel'  =>  'blog_archive_panel',
            'priority'  =>  20
        ]);

        // category archive section heading
        $wp_customize->add_setting( 'category_archive_section_heading', [
            'default'   =>  'general',
            'sanitize_callback' =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Section_Tab_Control( $wp_customize, 'category_archive_section_heading',
                [
                    'section'   =>  'category_archive_section',
                    'priority'  =>  1,
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogig' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogig' )
                        ]
                    ]
                ]
            )
        );

        // show or hide category info box
        $wp_customize->add_setting( 'archive_category_info_box_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_category_info_box_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Toggle_Control( $wp_customize, 'archive_category_info_box_option', [
                'label' =>  esc_html__( 'Show category info box', 'blogig' ),
                'section'   =>  'category_archive_section'
            ])
        );

        // info box typography settings heading
        $wp_customize->add_setting( 'archive_category_info_box_typography_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Control( $wp_customize, 'archive_category_info_box_typography_heading', array(
                'label' => esc_html__( 'Typography', 'blogig' ),
                'tab'   =>  'design',
                'section'   => 'category_archive_section'
            ))
        );

        // archive category info box 
        $wp_customize->add_setting( 'archive_category_info_box_title_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_category_info_box_title_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_category_info_box_title_typo', [
                'label' =>  esc_html__( 'Category Title', 'blogig' ),
                'section'   =>  'category_archive_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // archive category info box description typo
        $wp_customize->add_setting( 'archive_category_info_box_description_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_category_info_box_description_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_category_info_box_description_typo', [
                'label' =>  esc_html__( 'Category Description Typo', 'blogig' ),
                'section'   =>  'category_archive_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // tag archive page
        $wp_customize->add_section( 'tag_archive_section', [
            'title' =>  esc_html__( 'Tag Page', 'blogig' ),
            'panel'  =>  'blog_archive_panel',
            'priority'  =>  20
        ]);

        // tag archive section heading
        $wp_customize->add_setting( 'tag_archive_section_heading', [
            'default'   =>  'general',
            'sanitize_callback' =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Section_Tab_Control( $wp_customize, 'tag_archive_section_heading',
                [
                    'section'   =>  'tag_archive_section',
                    'priority'  =>  1,
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogig' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogig' )
                        ]
                    ]
                ]
            )
        );

        // show or hide tag info box
        $wp_customize->add_setting( 'archive_tag_info_box_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_tag_info_box_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Toggle_Control( $wp_customize, 'archive_tag_info_box_option', [
                'label' =>  esc_html__( 'Show tag info box', 'blogig' ),
                'section'   =>  'tag_archive_section'
            ])
        );

        // archive tag info box 
        $wp_customize->add_setting( 'archive_tag_info_box_title_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_tag_info_box_title_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_tag_info_box_title_typo', [
                'label' =>  esc_html__( 'Tag Title', 'blogig' ),
                'section'   =>  'tag_archive_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // archive tag info box description typo
        $wp_customize->add_setting( 'archive_tag_info_box_description_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_tag_info_box_description_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_tag_info_box_description_typo', [
                'label' =>  esc_html__( 'Tag Description Typo', 'blogig' ),
                'section'   =>  'tag_archive_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // author archive page
        $wp_customize->add_section( 'author_archive_section', [
            'title' =>  esc_html__( 'Author Page', 'blogig' ),
            'panel'  =>  'blog_archive_panel',
            'priority'  =>  20
        ]);

        // author archive section heading
        $wp_customize->add_setting( 'author_archive_section_heading', [
            'default'   =>  'general',
            'sanitize_callback' =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Section_Tab_Control( $wp_customize, 'author_archive_section_heading',
                [
                    'section'   =>  'author_archive_section',
                    'priority'  =>  1,
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogig' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogig' )
                        ]
                    ]
                ]
            )
        );

        // show or hide author info box
        $wp_customize->add_setting( 'archive_author_info_box_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_author_info_box_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Toggle_Control( $wp_customize, 'archive_author_info_box_option', [
                'label' =>  esc_html__( 'Show author info box', 'blogig' ),
                'section'   =>  'author_archive_section'
            ])
        );

        // info box typography settings heading
        $wp_customize->add_setting( 'archive_author_info_box_typography_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Control( $wp_customize, 'archive_author_info_box_typography_heading', array(
                'label' => esc_html__( 'Typography', 'blogig' ),
                'tab'   =>  'design',
                'section'   => 'author_archive_section'
            ))
        );

        // archive author info box 
        $wp_customize->add_setting( 'archive_author_info_box_title_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_author_info_box_title_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_author_info_box_title_typo', [
                'label' =>  esc_html__( 'Author Name', 'blogig' ),
                'section'   =>  'author_archive_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // archive author info box description typo
        $wp_customize->add_setting( 'archive_author_info_box_description_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_author_info_box_description_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'archive_author_info_box_description_typo', [
                'label' =>  esc_html__( 'Author Description Typo', 'blogig' ),
                'section'   =>  'author_archive_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // pagination setting section
        $wp_customize->add_section( 'pagination_settings_section', [
            'title' =>  esc_html__( 'Pagination Settings', 'blogig' ),
            'panel'  =>  'blog_archive_panel',
            'priority'  =>  30
        ]);

        // pagination type
        $wp_customize->add_setting( 'archive_pagination_type', [
            'default'   =>  BD\blogig_get_customizer_default( 'archive_pagination_type' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);
        $wp_customize->add_control( 'archive_pagination_type', [
                'label' =>  esc_html__( 'Pagination Type', 'blogig' ),
                'section'   =>  'pagination_settings_section',
                'type'  =>  'select',
                'choices'   =>  apply_filters( 'blogig_get_pagination_type_array_filter', [
                    'default'   => esc_html__( 'Default', 'blogig' ),
                    'number'    => esc_html__( 'Number', 'blogig' )
                ])
            ]
        );
    }
add_action( 'customize_register', 'blogig_blog_archive_panel' );
endif;

if( ! function_exists( 'blogig_blog_single_panel' ) ) :
    /**
     * Function for theme blog single panel
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_blog_single_panel( $wp_customize ) {
        $wp_customize->add_section(
            'blog_single_section',
            [
                'title' =>  __( 'Single Post', 'blogig' ),
                'priority'  =>  80
            ]
        );

        // single section heading
        $wp_customize->add_setting( 'single_section_heading', [
            'default'   =>  'general',
            'sanitize_callback' =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Section_Tab_Control( $wp_customize, 'single_section_heading', 
                [
                    'section'   =>  'blog_single_section',
                    'priority'  =>  1,
                    'choices'   =>  [
                        [
                            'name'  =>  'general',
                            'title' =>  esc_html__( 'General', 'blogig' )
                        ],
                        [
                            'name'  =>  'design',
                            'title' =>  esc_html__( 'Design', 'blogig' )
                        ]
                    ]
                ]
            )
        );

        // single layouts settings heading
        $wp_customize->add_setting( 'single_layouts_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'single_layouts_settings_header', array(
                'label'	      => esc_html__( 'Layouts Settings', 'blogig' ),
                'section'     => 'blog_single_section'
            ))
        );

        // single sidebar layout
        $wp_customize->add_setting( 'single_sidebar_layout', array(
            'default'           => BD\blogig_get_customizer_default( 'single_sidebar_layout' ),
            'sanitize_callback' => 'blogig_sanitize_select_control',
        ));
        $wp_customize->add_control(
            new Blogig_WP_Radio_Image_Control( $wp_customize, 'single_sidebar_layout', [
                'label' =>  __( 'Sidebar Layout', 'blogig' ),
                'section'   =>  'blog_single_section',
                'choices'  => array(
                    'right-sidebar' => array(
                        'label' => esc_html__( 'Right Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/right-sidebar.png'
                    ),
                    'left-sidebar' => array(
                        'label' => esc_html__( 'Left Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/left-sidebar.png'
                    ),
                    'both-sidebar' => array(
                        'label' => esc_html__( 'Both Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/both-sidebar.png'
                    ),
                    'no-sidebar' => array(
                        'label' => esc_html__( 'No Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/no-sidebar.png'
                    )
                )
            ])
        );
        
        // single elements settings heading
        $wp_customize->add_setting( 'single_elements_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'single_elements_settings_header', array(
                'label'	      => esc_html__( 'Elements Settings', 'blogig' ),
                'section'     => 'blog_single_section'
            ))
        );

        // post title tag
        $wp_customize->add_setting( 'single_title_tag', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_title_tag' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);
        $wp_customize->add_control( 'single_title_tag', [
                'label' =>  esc_html__( 'Title Tag', 'blogig' ),
                'section'   =>  'blog_single_section',
                'type'  =>  'select',
                'choices'   =>  apply_filters( 'blogig_get_title_tags_array_filter', [] )
            ]
        );

        // single date icon
        $wp_customize->add_setting( 'single_date_icon', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_date_icon' ),
            'sanitize_callback'   =>  'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'single_date_icon', 
                [
                    'label' =>  esc_html__( 'Date Icon', 'blogig' ),
                    'section'   =>  'blog_single_section'
                ]
            )
        );

        // single read time icon
        $wp_customize->add_setting( 'single_read_time_icon', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_read_time_icon' ),
            'sanitize_callback'   =>  'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'single_read_time_icon', 
                [
                    'label' =>  esc_html__( 'Read Time Icon', 'blogig' ),
                    'section'   =>  'blog_single_section'
                ]
            )
        );
        
        // single read time icon
        $wp_customize->add_setting( 'single_comments_icon', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_comments_icon' ),
            'sanitize_callback'   =>  'blogig_sanitize_icon_picker_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'single_comments_icon', 
                [
                    'label' =>  esc_html__( 'Comments Icon', 'blogig' ),
                    'section'   =>  'blog_single_section'
                ]
            )
        );

        // single gallery lightbox option
        $wp_customize->add_setting( 'single_gallery_lightbox_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_gallery_lightbox_option' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'single_gallery_lightbox_option', [
                'label' =>  esc_html__( 'Show lightbox', 'blogig' ),
                'section'   =>  'blog_single_section'
            ])
        );

        // single image settings
        $wp_customize->add_setting( 'single_image_setting_heading', [
            'sanitize_callback' =>  'sanitize_text_field'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'single_image_setting_heading', [
                'label' =>  esc_html__( 'Image Settings', 'blogig' ),
                'settings'  =>  'single_image_setting_heading',
                'section'   =>  'blog_single_section',
                'initial'   =>  false
            ])
        );

        // single image sizes
        $wp_customize->add_setting( 'single_image_size', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_image_size' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);

        $wp_customize->add_control( 'single_image_size', [
            'label' =>  esc_html__( 'Image Sizes', 'blogig' ),
            'type'  =>  'select',
            'settings'  =>  'single_image_size',
            'section'   =>  'blog_single_section',
            'choices'   =>  blogig_get_image_sizes_option_array_for_customizer()
        ]);

        // single image ratio
        $wp_customize->add_setting( 'single_responsive_image_ratio', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_responsive_image_ratio' ),
            'sanitize_callback' =>  'blogig_sanitize_responsive_range',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Responsive_Range_Control( $wp_customize, 'single_responsive_image_ratio', [
                'label' =>  esc_html__( 'Image Ratio', 'blogig' ),
                'settings'  =>  'single_responsive_image_ratio',
                'section'   =>  'blog_single_section',
                'unit'  =>  'px',
                'input_attrs'   =>  [
                    'min'   =>  0,
                    'max'   =>  2,
                    'step'  =>  0.1,
                    'reset'    =>  true
                ]
            ])
        );

        // single post related articles heading
        $wp_customize->add_setting( 'single_post_related_posts_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'single_post_related_posts_header', array(
                'label' => esc_html__( 'Related Posts', 'blogig' ),
                'section'   => 'blog_single_section',
                'initial'   => false
            ))
        );

        // related articles option
        $wp_customize->add_setting( 'single_post_related_posts_option', array(
            'default'   => BD\blogig_get_customizer_default( 'single_post_related_posts_option' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control',
            'transport' => 'refresh'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'single_post_related_posts_option', array(
                'label'	      => esc_html__( 'Show related articles', 'blogig' ),
                'section'     => 'blog_single_section',
                'settings'    => 'single_post_related_posts_option'
            ))
        );

        // related articles title
        $wp_customize->add_setting( 'single_post_related_posts_title', array(
            'default' => BD\blogig_get_customizer_default( 'single_post_related_posts_title' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control( 'single_post_related_posts_title', array(
            'type'      => 'text',
            'section'   => 'blog_single_section',
            'label'     => esc_html__( 'Related articles title', 'blogig' )
        ));

        // single typography heading
        $wp_customize->add_setting( 'single_typography_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'single_typography_header', array(
                'label' => esc_html__( 'Typography', 'blogig' ),
                'section'   => 'blog_single_section',
                'tab'   => 'design'
            ))
        );

        // single title typo
        $wp_customize->add_setting( 'single_title_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_title_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'single_title_typo', [
                'label' =>  esc_html__( 'Title Typo', 'blogig' ),
                'section'   =>  'blog_single_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // single excerpt typo
        $wp_customize->add_setting( 'single_content_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_content_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'single_content_typo', [
                'label' =>  esc_html__( 'Content Typo', 'blogig' ),
                'section'   =>  'blog_single_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // single category typo
        $wp_customize->add_setting( 'single_category_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_category_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'single_category_typo', [
                'label' =>  esc_html__( 'Category Typo', 'blogig' ),
                'section'   =>  'blog_single_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // single date typo
        $wp_customize->add_setting( 'single_date_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_date_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'single_date_typo', [
                'label' =>  esc_html__( 'Date Typo', 'blogig' ),
                'section'   =>  'blog_single_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // single author typo
        $wp_customize->add_setting( 'single_author_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_author_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'single_author_typo', [
                'label' =>  esc_html__( 'Author Typo', 'blogig' ),
                'section'   =>  'blog_single_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // single read time typo
        $wp_customize->add_setting( 'single_read_time_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'single_read_time_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'single_read_time_typo', [
                'label' =>  esc_html__( 'Read Time Typo', 'blogig' ),
                'section'   =>  'blog_single_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );
    }
    add_action( 'customize_register', 'blogig_blog_single_panel' );
endif;

if( ! function_exists( 'blogig_page_setting_panel' ) ) :
    /**
     * Function for theme page setting panel
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_page_setting_panel( $wp_customize ) {
        $wp_customize->add_panel(
            'page_setting_panel',
            [
                'title' =>  __( 'Page Settings', 'blogig' ),
                'priority'  =>  85
            ]
        );

        // page settings section
        $wp_customize->add_section('page_settings_section',[
            'title' =>  esc_html__( 'Page Settings', 'blogig' ),
            'panel' =>  'page_setting_panel',
            'priority' =>  10
        ]);

        // scroll to top section tab
        $wp_customize->add_setting( 'page_settings_section_tab', array(
            'sanitize_callback' => 'sanitize_text_field',
            'default'   => 'general'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Section_Tab_Control( $wp_customize, 'page_settings_section_tab', array(
                'section'     => 'page_settings_section',
                'choices'  => array(
                    array(
                        'name'  => 'general',
                        'title'  => esc_html__( 'General', 'blogig' )
                    ),
                    array(
                        'name'  => 'design',
                        'title'  => esc_html__( 'Design', 'blogig' )
                    )
                )
            ))
        );

        // page settings sidebar layout
        $wp_customize->add_setting( 'page_settings_sidebar_layout', array(
            'default'           => BD\blogig_get_customizer_default( 'page_settings_sidebar_layout' ),
            'sanitize_callback' => 'blogig_sanitize_select_control',
        ));
        $wp_customize->add_control(
            new Blogig_WP_Radio_Image_Control( $wp_customize, 'page_settings_sidebar_layout', [
                'label' =>  __( 'Sidebar Layout', 'blogig' ),
                'section'   =>  'page_settings_section',
                'choices'  => array(
                    'right-sidebar' => array(
                        'label' => esc_html__( 'Right Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/right-sidebar.png'
                    ),
                    'left-sidebar' => array(
                        'label' => esc_html__( 'Left Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/left-sidebar.png'
                    ),
                    'both-sidebar' => array(
                        'label' => esc_html__( 'Both Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/both-sidebar.png'
                    ),
                    'no-sidebar' => array(
                        'label' => esc_html__( 'No Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/no-sidebar.png'
                    )
                )
            ])
        );
        
        // page title tag
        $wp_customize->add_setting( 'page_title_tag', [
            'default'   =>  BD\blogig_get_customizer_default( 'page_title_tag' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);
        $wp_customize->add_control( 'page_title_tag', [
                'label' =>  esc_html__( 'Title Tag', 'blogig' ),
                'section'   =>  'page_settings_section',
                'type'  =>  'select',
                'choices'   =>  apply_filters( 'blogig_get_title_tags_array_filter', [] )
            ]
        );

        // page image settings
        $wp_customize->add_setting( 'page_image_setting_heading', [
            'sanitize_callback' =>  'sanitize_text_field'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'page_image_setting_heading', [
                'label' =>  esc_html__( 'Image Settings', 'blogig' ),
                'settings'  =>  'page_image_setting_heading',
                'section'   =>  'page_settings_section',
                'initial'   =>  false
            ])
        );

        // page image sizes
        $wp_customize->add_setting( 'page_image_size', [
            'default'   =>  BD\blogig_get_customizer_default( 'page_image_size' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);

        $wp_customize->add_control( 'page_image_size', [
            'label' =>  esc_html__( 'Image Sizes', 'blogig' ),
            'type'  =>  'select',
            'settings'  =>  'page_image_size',
            'section'   =>  'page_settings_section',
            'choices'   =>  blogig_get_image_sizes_option_array_for_customizer()
        ]);

        // page image ratio
        $wp_customize->add_setting( 'page_responsive_image_ratio', [
            'default'   =>  BD\blogig_get_customizer_default( 'page_responsive_image_ratio' ),
            'sanitize_callback' =>  'blogig_sanitize_responsive_range'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Responsive_Range_Control( $wp_customize, 'page_responsive_image_ratio', [
                'label' =>  esc_html__( 'Image Ratio', 'blogig' ),
                'settings'  =>  'page_responsive_image_ratio',
                'section'   =>  'page_settings_section',
                'unit'  =>  'px',
                'input_attrs'   =>  [
                    'min'   =>  0,
                    'max'   =>  2,
                    'step'  =>  0.1,
                    'reset'    =>  true
                ]
            ])
        );
        
        // page typography heading
        $wp_customize->add_setting( 'page_typography_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'page_typography_header', array(
                'label' => esc_html__( 'Typography', 'blogig' ),
                'section'   => 'page_settings_section',
                'tab'   => 'design'
            ))
        );

        // page title typo
        $wp_customize->add_setting( 'page_title_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'page_title_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'page_title_typo', [
                'label' =>  esc_html__( 'Page Title Typo', 'blogig' ),
                'section'   =>  'page_settings_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // page content typo
        $wp_customize->add_setting( 'page_content_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'page_content_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'page_content_typo', [
                'label' =>  esc_html__( 'Page Content Typo', 'blogig' ),
                'section'   =>  'page_settings_section',
                'tab'   =>  'design',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // error page settings section
        $wp_customize->add_section('error_page_settings_section', [
            'title' =>  esc_html__( '404 Page', 'blogig' ),
            'panel' =>  'page_setting_panel',
            'priority' =>  30
        ]);

        // 404 sidebar layout
        $wp_customize->add_setting( 'error_page_sidebar_layout', array(
            'default'           => BD\blogig_get_customizer_default( 'error_page_sidebar_layout' ),
            'sanitize_callback' => 'blogig_sanitize_select_control',
        ));
        $wp_customize->add_control(
            new Blogig_WP_Radio_Image_Control( $wp_customize, 'error_page_sidebar_layout', [
                'label' =>  __( 'Sidebar Layout', 'blogig' ),
                'section'   =>  'error_page_settings_section',
                'choices'  => array(
                    'right-sidebar' => array(
                        'label' => esc_html__( 'Right Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/right-sidebar.png'
                    ),
                    'left-sidebar' => array(
                        'label' => esc_html__( 'Left Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/left-sidebar.png'
                    ),
                    'both-sidebar' => array(
                        'label' => esc_html__( 'Both Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/both-sidebar.png'
                    ),
                    'no-sidebar' => array(
                        'label' => esc_html__( 'No Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/no-sidebar.png'
                    )
                )
            ])
        );
        
        // 404 image field
        $wp_customize->add_setting( 'error_page_image', array(
            'default' => BD\blogig_get_customizer_default( 'error_page_image' ),
            'sanitize_callback' => 'absint',
        ));
        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'error_page_image', array(
            'section' => 'error_page_settings_section',
            'mime_type' => 'image',
            'label' => esc_html__( '404 Image', 'blogig' ),
            'description' => esc_html__( 'Upload image that shows you are on 404 error page', 'blogig' )
        )));

        // search page settings - section
        $wp_customize->add_section( 'search_page_settings', array(
            'title' =>  esc_html__( 'Search Page', 'blogig' ),   
            'panel' =>  'page_setting_panel',
            'priority'  =>   30
        ));

        // search page settings
        $wp_customize->add_setting( 'search_page_sidebar_layout', array(
            'default'           => BD\blogig_get_customizer_default( 'search_page_sidebar_layout' ),
            'sanitize_callback' => 'blogig_sanitize_select_control',
        ));
        $wp_customize->add_control(
            new Blogig_WP_Radio_Image_Control( $wp_customize, 'search_page_sidebar_layout', [
                'label' =>  __( 'Sidebar Layout', 'blogig' ),
                'section'   =>  'search_page_settings',
                'choices'  => array(
                    'right-sidebar' => array(
                        'label' => esc_html__( 'Right Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/right-sidebar.png'
                    ),
                    'left-sidebar' => array(
                        'label' => esc_html__( 'Left Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/left-sidebar.png'
                    ),
                    'both-sidebar' => array(
                        'label' => esc_html__( 'Both Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/both-sidebar.png'
                    ),
                    'no-sidebar' => array(
                        'label' => esc_html__( 'No Sidebar', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/no-sidebar.png'
                    )
                )
            ])
        );
    }
    add_action( 'customize_register', 'blogig_page_setting_panel' );
endif;

if( !function_exists( 'blogig_customizer_you_may_have_missed_panel' ) ) :
    /**
     * Register footer You May Have Missed Section settings
     * 
     */
    function blogig_customizer_you_may_have_missed_panel( $wp_customize ) {
        /**
         * Theme You May Have Missed Section
         * 
         * panel - blogig_customizer_you_may_have_missed_panel
         */
        $wp_customize->add_section( 'blogig_customizer_you_may_have_missed_section', array(
            'title' => esc_html__( 'You May Have Missed', 'blogig' ),
            'priority'  => 85
        ));

        // section tab
        $wp_customize->add_setting( 'you_may_have_missed_section_tab', [
            'default'   =>  'general',
            'sanitize_callback' =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Section_Tab_Control( $wp_customize, 'you_may_have_missed_section_tab', [
                'section'   =>  'blogig_customizer_you_may_have_missed_section',
                'priority'  =>  1,
                'choices'   =>  [
                    [
                        'name'  =>  'general',
                        'title' =>  esc_html__( 'General', 'blogig' )
                    ],
                    [
                        'name'  =>  'design',
                        'title' =>  esc_html__( 'Design', 'blogig' )
                    ]
                ]
            ])
        );

        // Footer Option
        $wp_customize->add_setting( 'you_may_have_missed_section_option', array(
            'default'   => BD\blogig_get_customizer_default( 'you_may_have_missed_section_option' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Toggle_Control( $wp_customize, 'you_may_have_missed_section_option', array(
                'label'	      => esc_html__( 'Enable you may have missed section', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'tab'   => 'general'
            ))
        );

        // you may have missed show section title
        $wp_customize->add_setting( 'you_may_have_missed_title_option', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_title_option' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'you_may_have_missed_title_option', array(
                'label'	      => esc_html__( 'Show section title', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section'
            ))
        );

        // // you may have missed section title
        $wp_customize->add_setting( 'you_may_have_missed_title', [
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_title' ),
            'sanitize_callback'  =>  'sanitize_text_field'
        ]);
        $wp_customize->add_control( 'you_may_have_missed_title', [
            'label' =>  esc_html__( 'Section title', 'blogig' ),
            'section'   =>  'blogig_customizer_you_may_have_missed_section',
            'type'  =>  'text',
            'tab'   => 'general'
        ]);

        // you may have missed post query settings heading
        $wp_customize->add_setting( 'you_may_have_missed_post_query_settings_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'you_may_have_missed_post_query_settings_heading', array(
                'label'	      => esc_html__( 'Post Query', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section'
            ))
        );

        // you may have missed slider categories
        $wp_customize->add_setting( 'you_may_have_missed_categories', array(
            'default' => BD\blogig_get_customizer_default( 'you_may_have_missed_categories' ),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Categories_Multiselect_Control( $wp_customize, 'you_may_have_missed_categories', array(
                'label'     => esc_html__( 'Posts Categories', 'blogig' ),
                'section'   => 'blogig_customizer_you_may_have_missed_section',
                'settings'  => 'you_may_have_missed_categories',
                'choices'   => blogig_get_multicheckbox_categories_simple_array()
            ))
        );

        // you may have missed posts to include
        $wp_customize->add_setting( 'you_may_have_missed_posts_to_include', array(
            'default' => BD\blogig_get_customizer_default( 'you_may_have_missed_posts_to_include' ),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Posts_Multiselect_Control( $wp_customize, 'you_may_have_missed_posts_to_include', array(
                'label'     => esc_html__( 'Posts To Include', 'blogig' ),
                'section'   => 'blogig_customizer_you_may_have_missed_section',
                'settings'  => 'you_may_have_missed_posts_to_include',
                'choices'   => blogig_get_multicheckbox_posts_simple_array()
            ))
        );
        
        // you may have missed post order
        $wp_customize->add_setting( 'you_may_have_missed_post_order', [
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_post_order' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);

        $wp_customize->add_control( 'you_may_have_missed_post_order', [
            'label' =>  esc_html( 'Post Order', 'blogig' ),
            'type'  =>  'select',
            'priority'  =>  10,
            'section'   =>  'blogig_customizer_you_may_have_missed_section',
            'settings'  =>  'you_may_have_missed_post_order',
            'choices'   =>  blogig_post_order_args()
        ]);

        // you may have missed no of posts to show
        $wp_customize->add_setting( 'you_may_have_missed_no_of_posts_to_show', [
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_no_of_posts_to_show' ),
            'sanitize_callback' =>  'absint'
        ]);

        $wp_customize->add_control( 'you_may_have_missed_no_of_posts_to_show', [
            'label' =>  esc_html( 'No of posts to show', 'blogig' ),
            'type'  =>  'number',
            'priority'  =>  10,
            'section'   =>  'blogig_customizer_you_may_have_missed_section',
            'settings'  =>  'you_may_have_missed_no_of_posts_to_show',
            'input_attrs'    => [
                'min'   => 1,
                'max'   => 4,
                'step'  => 1
            ]
        ]);

        // you may have missed hide post with no featured image
        $wp_customize->add_setting( 'you_may_have_missed_hide_post_with_no_featured_image', [
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_hide_post_with_no_featured_image' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'you_may_have_missed_hide_post_with_no_featured_image', [
                'label' =>  esc_html__( 'Hide posts with no featured image', 'blogig' ),
                'section'   =>  'blogig_customizer_you_may_have_missed_section',
                'settings'  =>  'you_may_have_missed_hide_post_with_no_featured_image'
            ])
        );

        // you may have missed slider settings
        $wp_customize->add_setting( 'you_may_have_missed_post_elements_settings_heading', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'you_may_have_missed_post_elements_settings_heading', array(
                'label'	      => esc_html__( 'Post Elements Settings', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section'
            ))
        );

        // you may have missed post element show title
        $wp_customize->add_setting( 'you_may_have_missed_post_elements_show_title', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_post_elements_show_title' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'you_may_have_missed_post_elements_show_title', array(
                'label'	      => esc_html__( 'Show Title', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'settings'  =>  'you_may_have_missed_post_elements_show_title'
            ))
        );

        // you may have missed post title html tag
        $wp_customize->add_setting( 'you_may_have_missed_design_post_title_html_tag', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_design_post_title_html_tag' ),
            'sanitize_callback' => 'blogig_sanitize_select_control'
        ));
        
        $wp_customize->add_control( 'you_may_have_missed_design_post_title_html_tag', array(
            'label'	      => esc_html__( 'Title Tag', 'blogig' ),
            'section'     => 'blogig_customizer_you_may_have_missed_section',
            'settings'    => 'you_may_have_missed_design_post_title_html_tag',
            'tab'   =>  'design',
            'type'  =>  'select',
            'choices'   =>  [
                'h1'    =>  esc_html__( 'H1', 'blogig' ),
                'h2'    =>  esc_html__( 'H2', 'blogig' ),
                'h3'    =>  esc_html__( 'H3', 'blogig' ),
                'h4'    =>  esc_html__( 'H4', 'blogig' ),
                'h5'    =>  esc_html__( 'H5', 'blogig' ),
                'h6'    =>  esc_html__( 'H6', 'blogig' )
            ]
        ));

        // you may have missed post element show categories
        $wp_customize->add_setting( 'you_may_have_missed_post_elements_show_categories', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_post_elements_show_categories' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'you_may_have_missed_post_elements_show_categories', array(
                'label'	      => esc_html__( 'Show Categories', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'settings'  =>  'you_may_have_missed_post_elements_show_categories'
            ))
        );

        // you may have missed post element show date
        $wp_customize->add_setting( 'you_may_have_missed_post_elements_show_date', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_post_elements_show_date' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'you_may_have_missed_post_elements_show_date', array(
                'label'	      => esc_html__( 'Show Date', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'settings'  =>  'you_may_have_missed_post_elements_show_date'
            ))
        );

        // you may have missed post element show author
        $wp_customize->add_setting( 'you_may_have_missed_post_elements_show_author', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_post_elements_show_author' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'you_may_have_missed_post_elements_show_author', array(
                'label'	      => esc_html__( 'Show Author', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'settings'  =>  'you_may_have_missed_post_elements_show_author'
            ))
        );

        // you may have missed date icon
        $wp_customize->add_setting( 'you_may_have_missed_date_icon', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_date_icon' ),
            'sanitize_callback' => 'blogig_sanitize_icon_picker_control'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Icon_Picker_Control( $wp_customize, 'you_may_have_missed_date_icon', array(
                'label'	      => esc_html__( 'Choose Date Icon', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'settings'  =>  'you_may_have_missed_date_icon'
            ))
        );

        // you may have missed post element alignment
        $wp_customize->add_setting( 'you_may_have_missed_post_elements_alignment', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_post_elements_alignment' ),
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Radio_Tab_Control( $wp_customize, 'you_may_have_missed_post_elements_alignment', array(
                'label'	      => esc_html__( 'Elements Alignment', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'choices' => array(
                    array(
                        'value' => 'left',
                        'label' => esc_html__('Left', 'blogig' )
                    ),
                    array(
                        'value' => 'center',
                        'label' => esc_html__('Center', 'blogig' )
                    ),
                    array(
                        'value' => 'right',
                        'label' => esc_html__('Right', 'blogig' )
                    )
                )
            ))
        );

        // you may have missed image settings
        $wp_customize->add_setting( 'you_may_have_missed_image_setting_heading', [
            'sanitize_callback' =>  'sanitize_text_field'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'you_may_have_missed_image_setting_heading', [
                'label' =>  esc_html__( 'Image Settings', 'blogig' ),
                'settings'  =>  'you_may_have_missed_image_setting_heading',
                'section'   =>  'blogig_customizer_you_may_have_missed_section'
            ])
        );

        // you may have missed image sizes
        $wp_customize->add_setting( 'you_may_have_missed_image_sizes', [
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_image_sizes' ),
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ]);

        $wp_customize->add_control( 'you_may_have_missed_image_sizes', [
            'label' =>  esc_html__( 'Image Sizes', 'blogig' ),
            'type'  =>  'select',
            'settings'  =>  'you_may_have_missed_image_sizes',
            'section'   =>  'blogig_customizer_you_may_have_missed_section',
            'choices'   =>  blogig_get_image_sizes_option_array_for_customizer()
        ]);

        // you may have missed image ratio
        $wp_customize->add_setting( 'you_may_have_missed_responsive_image_ratio', [
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_responsive_image_ratio' ),
            'sanitize_callback' =>  'blogig_sanitize_responsive_range',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Responsive_Range_Control( $wp_customize, 'you_may_have_missed_responsive_image_ratio', [
                'label' =>  esc_html__( 'Image Ratio', 'blogig' ),
                'settings'  =>  'you_may_have_missed_responsive_image_ratio',
                'section'   =>  'blogig_customizer_you_may_have_missed_section',
                'unit'  =>  'px',
                'input_attrs'   =>  [
                    'min'   =>  0,
                    'max'   =>  2,
                    'step'  =>  0.1,
                    'reset'    =>  true
                ]
            ])
        );

        // animation object color
        $wp_customize->add_setting( 'you_may_have_missed_title_color', [
            'default'   => BD\blogig_get_customizer_default( 'you_may_have_missed_title_color' ),
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogig_sanitize_color_picker_control'
        ]);
        $wp_customize->add_control( 
            new Blogig_WP_Color_Picker_Control( $wp_customize, 'you_may_have_missed_title_color', [
                'label'	      => esc_html__( 'Section Title color', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'settings'    => 'you_may_have_missed_title_color',
                'tab'   =>  'design'
            ])
        );
        
        // you may have missed -> design tab -> typography
        $wp_customize->add_setting( 'you_may_have_missed_design_typography', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'you_may_have_missed_design_typography', array(
                'label'	      => esc_html__( 'Typography', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'settings'    => 'you_may_have_missed_design_typography',
                'tab'   =>  'design'
            ))
        );

        // you may have missed section title typography
        $wp_customize->add_setting( 'you_may_have_missed_design_section_title_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_design_section_title_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'you_may_have_missed_design_section_title_typography', array(
                'label'	      => esc_html__( 'Section Title Typo', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'tab'   =>  'design'
            ))
        );

        // you may have missed post title typography
        $wp_customize->add_setting( 'you_may_have_missed_design_post_title_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_design_post_title_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'you_may_have_missed_design_post_title_typography', array(
                'label'	      => esc_html__( 'Title Typo', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'settings'    => 'you_may_have_missed_design_post_title_typography',
                'tab'   =>  'design'
            ))
        );


        // you may have missed post categories typography
        $wp_customize->add_setting( 'you_may_have_missed_design_post_categories_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_design_post_categories_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'you_may_have_missed_design_post_categories_typography', array(
                'label'	      => esc_html__( 'Category Typo', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'settings'    => 'you_may_have_missed_design_post_categories_typography',
                'tab'   =>  'design'
            ))
        );

         // you may have missed post date typography
         $wp_customize->add_setting( 'you_may_have_missed_design_post_date_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_design_post_date_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'you_may_have_missed_design_post_date_typography', array(
                'label'	      => esc_html__( 'Date Typo', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'settings'    => 'you_may_have_missed_design_post_date_typography',
                'tab'   =>  'design'
            ))
        );

         // you may have missed post date typography
         $wp_customize->add_setting( 'you_may_have_missed_design_post_author_typography', array(
            'default'   =>  BD\blogig_get_customizer_default( 'you_may_have_missed_design_post_author_typography' ),
            'sanitize_callback' => 'blogig_sanitize_typo_control',
            'transport' => 'postMessage'
        ));
        
        $wp_customize->add_control( 
            new Blogig_WP_Typography_Control( $wp_customize, 'you_may_have_missed_design_post_author_typography', array(
                'label'	      => esc_html__( 'Author Typo', 'blogig' ),
                'section'     => 'blogig_customizer_you_may_have_missed_section',
                'settings'    => 'you_may_have_missed_design_post_author_typography',
                'tab'   =>  'design'
            ))
        );
    }
add_action( 'customize_register', 'blogig_customizer_you_may_have_missed_panel', 10 );
endif;

if( !function_exists( 'blogig_customizer_footer_panel' ) ) :
    /**
     * Register footer options settings
     * 
     */
    function blogig_customizer_footer_panel( $wp_customize ) {
        /**
         * Theme Footer Section
         * 
         * panel - blogig_footer_panel
         */
        $wp_customize->add_section( 'blogig_footer_section', array(
            'title' => esc_html__( 'Theme Footer', 'blogig' ),
            'priority'  => 85
        ));
        
        // Footer Option
        $wp_customize->add_setting( 'footer_option', array(
            'default'   => BD\blogig_get_customizer_default( 'footer_option' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control',
            'transport'   => 'postMessage'
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Toggle_Control( $wp_customize, 'footer_option', array(
                'label'	      => esc_html__( 'Enable footer section', 'blogig' ),
                'section'     => 'blogig_footer_section',
                'settings'    => 'footer_option',
                'tab'   => 'general'
            ))
        );

        // Add the footer layout control.
        $wp_customize->add_setting( 'footer_widget_column', array(
            'default'           => BD\blogig_get_customizer_default( 'footer_widget_column' ),
            'sanitize_callback' => 'blogig_sanitize_select_control',
            'transport'   => 'postMessage'
            )
        );
        $wp_customize->add_control( new Blogig_WP_Radio_Image_Control(
            $wp_customize,
            'footer_widget_column',
            array(
                'section'  => 'blogig_footer_section',
                'tab'   => 'general',
                'choices'  => array(
                    'column-one' => array(
                        'label' => esc_html__( 'Column One', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/footer_column_one.png'
                    ),
                    'column-two' => array(
                        'label' => esc_html__( 'Column Two', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/footer_column_two.png'
                    ),
                    'column-three' => array(
                        'label' => esc_html__( 'Column Three', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/footer_column_three.png'
                    ),
                    'column-four' => array(
                        'label' => esc_html__( 'Column Four', 'blogig' ),
                        'url'   => '%s/assets/images/customizer/footer_column_four.png'
                    )
                )
            )
        ));
        
        // Redirect widgets link
        $wp_customize->add_setting( 'footer_widgets_redirects', array(
            'sanitize_callback' => 'blogig_sanitize_toggle_control',
        ));
        $wp_customize->add_control( 
            new Blogig_WP_Redirect_Control( $wp_customize, 'footer_widgets_redirects', array(
                'label'	      => esc_html__( 'Widgets', 'blogig' ),
                'section'     => 'blogig_footer_section',
                'settings'    => 'footer_widgets_redirects',
                'tab'   => 'general',
                'choices'     => array(
                    'footer-column-one' => array(
                        'type'  => 'section',
                        'id'    => 'sidebar-widgets-footer-sidebar--column-1',
                        'label' => esc_html__( 'Manage footer widget one', 'blogig' )
                    ),
                    'footer-column-two' => array(
                        'type'  => 'section',
                        'id'    => 'sidebar-widgets-footer-sidebar--column-2',
                        'label' => esc_html__( 'Manage footer widget two', 'blogig' )
                    ),
                    'footer-column-three' => array(
                        'type'  => 'section',
                        'id'    => 'sidebar-widgets-footer-sidebar--column-3',
                        'label' => esc_html__( 'Manage footer widget three', 'blogig' )
                    ),
                    'footer-column-four' => array(
                        'type'  => 'section',
                        'id'    => 'sidebar-widgets-footer-sidebar--column-4',
                        'label' => esc_html__( 'Manage footer widget four', 'blogig' )
                    )
                )
            ))
        );

        // footer custom css heading
        $wp_customize->add_setting( 'footer_custom_css_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'footer_custom_css_header', array(
                'label'	      => esc_html__( 'Custom Css', 'blogig' ),
                'section'     => 'blogig_footer_section'
            ))
        );

        // bottom footer custom css code control
        $wp_customize->add_setting( 'footer_custom_css', [
            'default'   =>  BD\blogig_get_customizer_default( 'footer_custom_css' ),
            'sanitize_callback' =>  'blogig_sanitize_css_code_control',
            'capability'=> 'edit_css',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control(
            new WP_Customize_Code_Editor_Control( $wp_customize, 'footer_custom_css', [
                'label' =>  esc_html__( 'Css code', 'blogig' ),
                'description' =>  esc_html__( 'Enter the valid css code. Type "{wrapper}" before every new line. "{wrapper}" will be replaced by main wrapper i.e "footer#colophon"', 'blogig' ),
                'section'   =>  'blogig_footer_section',
                'code_type'   => 'text/css',
                'input_attrs' => [
                    'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4'
                ]
            ])
        );
    }
    add_action( 'customize_register', 'blogig_customizer_footer_panel', 10 );
endif;

if( !function_exists( 'blogig_customizer_bottom_footer_panel' ) ) :
    /**
     * Register bottom footer options settings
     * 
     */
    function blogig_customizer_bottom_footer_panel( $wp_customize ) {
        /**
         * Bottom Footer Section
         * 
         * panel - blogig_footer_panel
         */
        $wp_customize->add_section( 'blogig_bottom_footer_section', array(
            'title' => esc_html__( 'Bottom Footer', 'blogig' ),
            'priority'  => 85
        ));

        // Bottom Footer Option
        $wp_customize->add_setting( 'bottom_footer_option', array(
            'default'         => BD\blogig_get_customizer_default( 'bottom_footer_option' ),
            'sanitize_callback' => 'blogig_sanitize_toggle_control'
        ));
    
        $wp_customize->add_control( 
            new Blogig_WP_Toggle_Control( $wp_customize, 'bottom_footer_option', array(
                'label'	      => esc_html__( 'Enable bottom footer', 'blogig' ),
                'section'     => 'blogig_bottom_footer_section',
                'settings'    => 'bottom_footer_option'
            ))
        );

        // bottom footer copyright settings
         $wp_customize->add_setting( 'bottom_footer_copyright_setting_heading', [
            'sanitize_callback' =>  'sanitize_text_field'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'bottom_footer_copyright_setting_heading', [
                'label' =>  esc_html__( 'Copyright Settings', 'blogig' ),
                'settings'  =>  'bottom_footer_copyright_setting_heading',
                'section'   =>  'blogig_bottom_footer_section',
                'initial'   =>  false
            ])
        );
        
        // copyright text
        $wp_customize->add_setting( 'bottom_footer_site_info', array(
            'default'    => BD\blogig_get_customizer_default( 'bottom_footer_site_info' ),
            'sanitize_callback' => 'wp_kses_post'
        ));
        $wp_customize->add_control( 'bottom_footer_site_info', array(
                'label'	      => esc_html__( 'Copyright Text', 'blogig' ),
                'type'  => 'textarea',
                'description' => esc_html__( 'Add %year% to retrieve current year.', 'blogig' ),
                'section'     => 'blogig_bottom_footer_section'
            )
        );

        // bottom footer Logo settings
        $wp_customize->add_setting( 'bottom_footer_logo_setting_heading', [
            'sanitize_callback' =>  'sanitize_text_field'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'bottom_footer_logo_setting_heading', [
                'label' =>  esc_html__( 'Logo Settings', 'blogig' ),
                'settings'  =>  'bottom_footer_logo_setting_heading',
                'section'   =>  'blogig_bottom_footer_section',
                'initial'   =>  false
            ])
        );

        // footer logo show/hide option
        $wp_customize->add_setting( 'bottom_footer_show_logo', array(
            'default'   =>  BD\blogig_get_customizer_default( 'bottom_footer_show_logo' ),
            'sanitize_callback' =>  'blogig_sanitize_toggle_control',
            'transport' =>  'refresh'
        ));

        $wp_customize->add_control( 
            new Blogig_WP_Simple_Toggle_Control( $wp_customize, 'bottom_footer_show_logo', array(
                'label'	      => esc_html__( 'Show Logo', 'blogig' ),
                'section'     => 'blogig_bottom_footer_section'
            ))
        );

        // footer logo from header or custom
        $wp_customize->add_setting( 'bottom_footer_header_or_custom', array(
            'default'   =>  BD\blogig_get_customizer_default( 'bottom_footer_header_or_custom' ),   
            'sanitize_callback' =>  'blogig_sanitize_select_control'
        ));

        $wp_customize->add_control( 'bottom_footer_header_or_custom', array(
                'label' =>  esc_html__( 'Logo From', 'blogig' ),
                'section'   =>  'blogig_bottom_footer_section',
                'settings'  =>  'bottom_footer_header_or_custom',
                'choices'   =>  [
                    'header'  =>  esc_html__( 'Default Site Logo', 'blogig' ),
                    'custom'  =>  esc_html__( 'Custom', 'blogig' )
                ],
                'type'  =>  'select'
        ));

        // footer logo option
         $wp_customize->add_setting( 'bottom_footer_logo_option', array(
            'default' => BD\blogig_get_customizer_default( 'bottom_footer_logo_option' ),
            'sanitize_callback' => 'absint',
        ));

        $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'bottom_footer_logo_option', array(
            'section' => 'blogig_bottom_footer_section',
            'mime_type' => 'image',
            'label' => esc_html__( 'Footer Logo', 'blogig' ),
            'description' => esc_html__( 'Upload image for bottom footer', 'blogig' ),
            'active_callback'   =>  function( $control ) {
                return ( $control->manager->get_setting( 'bottom_footer_header_or_custom' )->value() == 'custom' );
            }
        )));

        // footer logo width
        $wp_customize->add_setting( 'bottom_footer_logo_width', [
            'default'   =>  BD\blogig_get_customizer_default( 'bottom_footer_logo_width' ),
            'sanitize_callback' =>  'blogig_sanitize_responsive_range',
            'transport' =>  'postMessage'
        ]);

        $wp_customize->add_control(
            new Blogig_WP_Responsive_Range_Control( $wp_customize, 'bottom_footer_logo_width',[
                'label' =>  esc_html__( 'Logo Width (px)', 'blogig' ),
                'section'   =>  'blogig_bottom_footer_section',
                'settings'  =>  'bottom_footer_logo_width',
                'unit'  =>  'px',
                'input_attrs'   =>  [
                    'max'   =>  400,
                    'min'   =>  1,
                    'step'  =>  1,
                    'reset' =>  true
                ]
            ])
        );

        // bottom footer custom css heading
        $wp_customize->add_setting( 'bottom_footer_custom_css_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'bottom_footer_custom_css_header', array(
                'label'	      => esc_html__( 'Custom Css', 'blogig' ),
                'section'     => 'blogig_bottom_footer_section'
            ))
        );

        // bottom footer custom css code control
        $wp_customize->add_setting( 'bottom_footer_custom_css', [
            'default'   =>  BD\blogig_get_customizer_default( 'bottom_footer_custom_css' ),
            'sanitize_callback' =>  'blogig_sanitize_css_code_control',
            'capability'=> 'edit_css',
            'transport' => 'postMessage'
        ]);

        $wp_customize->add_control(
            new WP_Customize_Code_Editor_Control( $wp_customize, 'bottom_footer_custom_css', [
                'label' =>  esc_html__( 'Css code', 'blogig' ),
                'description' =>  esc_html__( 'Enter the valid css code. Type "{wrapper}" before every new line. "{wrapper}" will be replaced by main wrapper i.e ".bottom-footer"', 'blogig' ),
                'section'   =>  'blogig_bottom_footer_section',
                'code_type'   => 'text/css',
                'input_attrs' => [
                    'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4'
                ]
            ])
        );
    }
    add_action( 'customize_register', 'blogig_customizer_bottom_footer_panel', 10 );
endif;

if( !function_exists( 'blogig_customizer_typography_panel' ) ) :
    /**
     * Register bottom footer options settings
     * 
     */
    function blogig_customizer_typography_panel( $wp_customize ) {
        /**
         * Typography Section
         * 
         * panel - blogig_typography_panel
         */
        $wp_customize->add_section( 'blogig_typography_section', array(
            'title' => esc_html__( 'Typography', 'blogig' ),
            'priority'  => 30
        ));

        // heading one typo
        $wp_customize->add_setting( 'heading_one_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'heading_one_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'heading_one_typo', [
                'label' =>  esc_html__( 'Heading 1', 'blogig' ),
                'section'   =>  'blogig_typography_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // heading two typo
        $wp_customize->add_setting( 'heading_two_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'heading_two_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'heading_two_typo', [
                'label' =>  esc_html__( 'Heading 2', 'blogig' ),
                'section'   =>  'blogig_typography_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // heading three typo
        $wp_customize->add_setting( 'heading_three_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'heading_three_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'heading_three_typo', [
                'label' =>  esc_html__( 'Heading 3', 'blogig' ),
                'section'   =>  'blogig_typography_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // heading four typo
        $wp_customize->add_setting( 'heading_four_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'heading_four_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'heading_four_typo', [
                'label' =>  esc_html__( 'Heading 4', 'blogig' ),
                'section'   =>  'blogig_typography_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // heading five typo
        $wp_customize->add_setting( 'heading_five_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'heading_five_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'heading_five_typo', [
                'label' =>  esc_html__( 'Heading 5', 'blogig' ),
                'section'   =>  'blogig_typography_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // heading six typo
        $wp_customize->add_setting( 'heading_six_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'heading_six_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'heading_six_typo', [
                'label' =>  esc_html__( 'Heading 6', 'blogig' ),
                'section'   =>  'blogig_typography_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );
    }
    add_action( 'customize_register', 'blogig_customizer_typography_panel', 10 );
endif;

if( ! function_exists( 'blogig_advertisement_section' ) ) :
    /**
     * Register advertisement options settings
     */
    function blogig_advertisement_section( $wp_customize ) {
        /**
         * Advertisement Section
         * 
         * section - blogig_advertisement_section
         */
        $wp_customize->add_section( 'blogig_advertisement_section', [
            'title' =>  esc_html__( 'Advertisement', 'blogig' ),
            'priority'  =>  10
        ]);

        // advertisement - repeater
        $wp_customize->add_setting( 'blogig_advertisement_repeater', [
            'default'   =>  BD\blogig_get_customizer_default( 'blogig_advertisement_repeater' ),
            'sanitize_callback' =>  'blogig_sanitize_repeater_control'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Custom_Repeater( $wp_customize, 'blogig_advertisement_repeater', [
                'label'         => esc_html__( 'Advertisements', 'blogig' ),
                'description'   => esc_html__( 'Hold bar icon and drag vertically to re-order the icons', 'blogig' ),
                'section'       => 'blogig_advertisement_section',
                'settings'      => 'blogig_advertisement_repeater',
                'row_label'     => esc_html__( 'Advertisement', 'blogig' ),
                'add_new_label' => esc_html__( 'Add New Advertisement', 'blogig' ),
                'fields'        => [
                    'item_image'   => [
                        'type'          => 'image',
                        'label'         => esc_html__( 'Image', 'blogig' ),
                        'default'       => 0
                    ],
                    'item_url'  => [
                        'type'      => 'url',
                        'label'     => esc_html__( 'URL', 'blogig' ),
                        'default'   => ''
                    ],
                    'item_target'   =>  [
                        'type'  =>  'select',
                        'label' =>  esc_html__( 'Target', 'blogig' ),
                        'default'   =>  '_self',
                        'options'   =>  [
                            '_blank'    =>  esc_html__( 'Show in new tab', 'blogig' ),
                            '_self'    =>  esc_html__( 'Show in same tab', 'blogig' )
                        ]
                    ],
                    'item_rel_attribute'    =>  [
                        'type'  =>  'select',
                        'label' =>  esc_html__( 'Rel', 'blogig' ),
                        'default'   =>  'opener',
                        'options'   =>  [
                            'nofollow'  =>  esc_html__( 'No follow', 'blogig' ),
                            'noopener'  =>  esc_html__( 'No opener', 'blogig' ),
                            'noreferrer'  =>  esc_html__( 'No referrer', 'blogig' )
                        ]
                    ],
                    'item_heading'  =>  [
                        'type'  =>  'heading',
                        'label' =>  esc_html__( 'Display Area', 'blogig' )
                    ],
                    'item_checkbox_header' =>  [
                        'type'  =>  'checkbox',
                        'label' =>  esc_html__( 'Header', 'blogig' ),  
                        'default'   =>  false
                    ],
                    'item_checkbox_before_post_content' =>  [
                        'type'  =>  'checkbox',
                        'label' =>  esc_html__( 'Before post content', 'blogig' ),  
                        'default'   =>  false
                    ],
                    'item_checkbox_after_post_content' =>  [
                        'type'  =>  'checkbox',
                        'label' =>  esc_html__( 'After post content', 'blogig' ),  
                        'default'   =>  false
                    ],
                    'item_checkbox_random_post_archives' =>  [
                        'type'  =>  'checkbox',
                        'label' =>  esc_html__( 'Random post archives', 'blogig' ),  
                        'default'   =>  false
                    ],
                    'item_checkbox_stick_with_footer' =>  [
                        'type'  =>  'checkbox',
                        'label' =>  esc_html__( 'Stick with footer', 'blogig' ),  
                        'default'   =>  false
                    ],
                    'item_alignment'    =>   [
                        'type'  =>  'alignment',
                        'label' =>  esc_html__( 'Ad Alignment', 'blogig' ),
                        'default'   =>  'left',
                        'options'   =>  [
                            'left'  =>  esc_html__( 'Left', 'blogig' ),
                            'center'  =>  esc_html__( 'Center', 'blogig' ),
                            'right'  =>  esc_html__( 'Right', 'blogig' )
                        ]
                    ],
                    'item_image_option' =>  [
                        'type'  =>  'select',
                        'label' =>  esc_html__( 'Image Option', 'blogig' ),
                        'default'   =>  'original',
                        'options'   =>  [
                            'full_width'  =>  esc_html__( 'Full Width', 'blogig' ),
                            'original'  =>  esc_html__( 'Original', 'blogig' )
                        ]
                    ],
                    'item_option'             => 'show'
                ]
            ])
        );
    }
    add_action( 'customize_register', 'blogig_advertisement_section' );
endif;

if( !function_exists( 'blogig_customizer_widgets_panel' ) ) :
    /**
     * Register widgets styles settings
     * 
     */
    function blogig_customizer_widgets_panel( $wp_customize ) {
        /**
         * Widget Styles Section
         * 
         * panel - blogig_widget_styles_panel
         */
        $wp_customize->add_section( 'blogig_widget_styles_section', array(
            'title' => esc_html__( 'Widget Styles', 'blogig' ),
            'priority'  => 30
        ));

        // Widget styles settings heading
        $wp_customize->add_setting( 'widget_styles_sidebar_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'widget_styles_sidebar_settings_header', array(
                'label'	      => esc_html__( 'Sidebar Typography', 'blogig' ),
                'section'     => 'blogig_widget_styles_section'
            ))
        );

        // block title typo
        $wp_customize->add_setting( 'sidebar_block_title_typography', [
            'default'   =>  BD\blogig_get_customizer_default( 'sidebar_block_title_typography' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'sidebar_block_title_typography', [
                'label' =>  esc_html__( 'Block Title', 'blogig' ),
                'section'   =>  'blogig_widget_styles_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // post title typo
        $wp_customize->add_setting( 'sidebar_post_title_typography', [
            'default'   =>  BD\blogig_get_customizer_default( 'sidebar_post_title_typography' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'sidebar_post_title_typography', [
                'label' =>  esc_html__( 'Post Title', 'blogig' ),
                'section'   =>  'blogig_widget_styles_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // post category typo
        $wp_customize->add_setting( 'sidebar_category_typography', [
            'default'   =>  BD\blogig_get_customizer_default( 'sidebar_category_typography' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'sidebar_category_typography', [
                'label' =>  esc_html__( 'Category', 'blogig' ),
                'section'   =>  'blogig_widget_styles_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // post category typo
        $wp_customize->add_setting( 'sidebar_date_typography', [
            'default'   =>  BD\blogig_get_customizer_default( 'sidebar_date_typography' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'sidebar_date_typography', [
                'label' =>  esc_html__( 'Date', 'blogig' ),
                'section'   =>  'blogig_widget_styles_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        $wp_customize->add_setting( 'widget_styles_headings_settings_header', array(
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control(
            new Blogig_WP_Section_Heading_Toggle_Control( $wp_customize, 'widget_styles_headings_settings_header', array(
                'label'	      => esc_html__( 'Heading Typography', 'blogig' ),
                'section'     => 'blogig_widget_styles_section'
            ))
        );

        // heading one typo
        $wp_customize->add_setting( 'sidebar_heading_one_typography', [
            'default'   =>  BD\blogig_get_customizer_default( 'sidebar_heading_one_typography' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'sidebar_heading_one_typography', [
                'label' =>  esc_html__( 'Heading 1', 'blogig' ),
                'section'   =>  'blogig_widget_styles_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // heading two typo
        $wp_customize->add_setting( 'sidebar_heading_two_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'sidebar_heading_two_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'sidebar_heading_two_typo', [
                'label' =>  esc_html__( 'Heading 2', 'blogig' ),
                'section'   =>  'blogig_widget_styles_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // heading three typo
        $wp_customize->add_setting( 'sidebar_heading_three_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'sidebar_heading_three_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'sidebar_heading_three_typo', [
                'label' =>  esc_html__( 'Heading 3', 'blogig' ),
                'section'   =>  'blogig_widget_styles_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // heading four typo
        $wp_customize->add_setting( 'sidebar_heading_four_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'sidebar_heading_four_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'sidebar_heading_four_typo', [
                'label' =>  esc_html__( 'Heading 4', 'blogig' ),
                'section'   =>  'blogig_widget_styles_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // heading five typo
        $wp_customize->add_setting( 'sidebar_heading_five_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'sidebar_heading_five_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'sidebar_heading_five_typo', [
                'label' =>  esc_html__( 'Heading 5', 'blogig' ),
                'section'   =>  'blogig_widget_styles_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );

        // heading six typo
        $wp_customize->add_setting( 'sidebar_heading_six_typo', [
            'default'   =>  BD\blogig_get_customizer_default( 'sidebar_heading_six_typo' ),
            'sanitize_callback' =>  'blogig_sanitize_typo_control',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control(
            new Blogig_WP_Typography_Control( $wp_customize, 'sidebar_heading_six_typo', [
                'label' =>  esc_html__( 'Heading 6', 'blogig' ),
                'section'   =>  'blogig_widget_styles_section',
                'fields'    =>  [ 'font_family', 'font_weight', 'font_size', 'line_height', 'letter_spacing', 'text_transform', 'text_decoration' ]
            ])
        );
    }
    add_action( 'customize_register', 'blogig_customizer_widgets_panel', 10 );
endif;

if( !function_exists( 'blogig_customizer_mobile_options_panel' ) ) :
    /**
     * Register mobile options settings
     * 
     */
    function blogig_customizer_mobile_options_panel( $wp_customize ) {
        /**
         * Mobile Options Section
         * 
         * panel - blogig_mobile_options_panel
         */
        $wp_customize->add_section( 'blogig_mobile_options_section', array(
            'title' => esc_html__( 'Mobile Options', 'blogig' ),
            'priority'  => 30
        ));

        // sub menu mobile option
        $wp_customize->add_setting( 'show_background_animation_on_mobile', [
            'default'   =>  BD\blogig_get_customizer_default( 'show_background_animation_on_mobile' ),
            'sanitize_callback' =>  'blogig_sanitize_checkbox',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control( 'show_background_animation_on_mobile', [
            'label' =>  esc_html__( 'Show background animation on mobile', 'blogig' ),
            'type'  =>  'checkbox',
            'section'   =>  'blogig_mobile_options_section'
        ]);

        // sub menu mobile option
        $wp_customize->add_setting( 'sub_menu_mobile_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'sub_menu_mobile_option' ),
            'sanitize_callback' =>  'blogig_sanitize_checkbox',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control( 'sub_menu_mobile_option', [
            'label' =>  esc_html__( 'Show sub menu on mobile', 'blogig' ),
            'type'  =>  'checkbox',
            'section'   =>  'blogig_mobile_options_section'
        ]);

        // scroll to top mobile option
        $wp_customize->add_setting( 'scroll_to_top_mobile_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'scroll_to_top_mobile_option' ),
            'sanitize_callback' =>  'blogig_sanitize_checkbox',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control( 'scroll_to_top_mobile_option', [
            'label' =>  esc_html__( 'Show scroll to top on mobile', 'blogig' ),
            'type'  =>  'checkbox',
            'section'   =>  'blogig_mobile_options_section'
        ]);

        // show custom button text mobile option
        $wp_customize->add_setting( 'show_custom_button_text_mobile_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'show_custom_button_text_mobile_option' ),
            'sanitize_callback' =>  'blogig_sanitize_checkbox',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control( 'show_custom_button_text_mobile_option', [
            'label' =>  esc_html__( 'Show custom button text on mobile', 'blogig' ),
            'type'  =>  'checkbox',
            'section'   =>  'blogig_mobile_options_section'
        ]);

        // show readmore button mobile option
        $wp_customize->add_setting( 'show_readmore_button_mobile_option', [
            'default'   =>  BD\blogig_get_customizer_default( 'show_readmore_button_mobile_option' ),
            'sanitize_callback' =>  'blogig_sanitize_checkbox',
            'transport' =>  'postMessage'
        ]);
        $wp_customize->add_control( 'show_readmore_button_mobile_option', [
            'label' =>  esc_html__( 'Show readmore button on mobile', 'blogig' ),
            'type'  =>  'checkbox',
            'section'   =>  'blogig_mobile_options_section'
        ]);
    }
    add_action( 'customize_register', 'blogig_customizer_mobile_options_panel', 10 );
endif;

// extract to the customizer js
$blogigAddAction = function() {
    $action_prefix = "wp_ajax_" . "blogig_";
    // retrieve posts with search key
    add_action( $action_prefix . 'get_multicheckbox_posts_simple_array', function() {
        check_ajax_referer( 'blogig-customizer-controls-live-nonce', 'security' );
        $searchKey = isset($_POST['search']) ? sanitize_text_field(wp_unslash($_POST['search'])): '';
        $posts_list = get_posts(array('numberposts'=>10, 's'=>esc_html($searchKey)));
        foreach( $posts_list as $postItem ) :
            $posts_array[] = array( 
                'value'	=> esc_html( $postItem->ID ),
                'label'	=> esc_html( $postItem->post_title )
            );
        endforeach;
        wp_send_json_success($posts_array);
        wp_die();
    });
    // retrieve categories with search key
    add_action( $action_prefix . 'get_multicheckbox_categories_simple_array', function() {
        check_ajax_referer( 'blogig-customizer-controls-live-nonce', 'security' );
        $searchKey = isset($_POST['search']) ? sanitize_text_field(wp_unslash($_POST['search'])): '';
        $categories_list = get_categories(array('number'=>10, 'search'=>esc_html($searchKey)));
        foreach( $categories_list as $categoryItem ) :
            $categories_array[] = array( 
                'value'	=> esc_html( $categoryItem->term_id ),
                'label'	=> esc_html( $categoryItem->name ) . ' (' . absint( $categoryItem->count ) . ')'
            );
        endforeach;
        wp_send_json_success($categories_array);
        wp_die();
    });
    // typography fonts url
    add_action( $action_prefix . 'typography_fonts_url', function() {
        check_ajax_referer( 'blogig-customizer-nonce', 'security' );
		// enqueue inline style
		ob_start();
			echo esc_url( blogig_typo_fonts_url() );
        $blogig_typography_fonts_url = ob_get_clean();
		echo apply_filters( 'blogig_typography_fonts_url', esc_url($blogig_typography_fonts_url) );
		wp_die();
	});
};
$blogigAddAction();