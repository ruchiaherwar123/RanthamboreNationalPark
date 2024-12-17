<?php
/**
 * Header hooks and functions
 * 
 * @package Blogig
 * @since 1.0.0
 */
use Blogig\CustomizerDefault as BD;

if( ! function_exists( 'blogig_header_site_branding_part' ) ) :
    /**
     * Header site branding element
     * 
     * @since 1.0.0
     */
    function blogig_header_site_branding_part() {
        ?>
            <div class="site-branding">
                <?php
                    $site_title_tag_for_frontpage = BD\blogig_get_customizer_option( 'site_title_tag_for_frontpage' );
                    $site_title_tag_for_innerpage = BD\blogig_get_customizer_option( 'site_title_tag_for_innerpage' );
                    $site_description_show_hide = BD\blogig_get_customizer_option( 'blogdescription_option' );
                    the_custom_logo();
                    if ( is_front_page() ) :
                        echo '<'. esc_html( $site_title_tag_for_frontpage ) .' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'. esc_html( $site_title_tag_for_frontpage ) .'>';
                    else :
                        echo '<'. esc_html( $site_title_tag_for_innerpage ) .' class="site-title"><a href="'. esc_url( home_url( '/' ) ) .'" rel="home">'. get_bloginfo( 'name' ) .'</a></'. esc_html( $site_title_tag_for_innerpage ) .'>';
                    endif;
                    $blogig_description = get_bloginfo( 'description', 'display' );
                    if( $site_description_show_hide ) :
                        if ( $blogig_description || is_customize_preview() ) echo '<p class="site-description">'. $blogig_description .'</p>';
                    endif;
                ?>
            </div><!-- .site-branding -->
        <?php
    }
    add_action( 'blogig_header__site_branding_section_hook', 'blogig_header_site_branding_part', 10 );
endif;

if( ! function_exists( 'blogig_header_menu_part' ) ) :
    /**
     * Header menu element
     * 
     * @since 1.0.0
     */
    function blogig_header_menu_part() {
        $sub_menu_mobile_option = BD\blogig_get_customizer_option( 'sub_menu_mobile_option' );
        $nav_classes = 'hover-effect--' . BD\blogig_get_customizer_option( 'blogig_header_menu_hover_effect' );
        if( ! $sub_menu_mobile_option ) $nav_classes .= ' sub-menu-hide-on-mobile';

      ?>
        <nav id="site-navigation" class="main-navigation <?php echo esc_attr( $nav_classes ); ?>">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <div id="blogig-menu-burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <span class="menu-txt"><?php esc_html_e( 'Menu', 'blogig' ); ?></span>
            </button>
            <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'header-menu',
                        'container_class' =>    'blogig-primary-menu-container'
                    )
                );
            ?>
        </nav><!-- #site-navigation -->
      <?php
    }
    add_action( 'blogig_header__menu_section_hook', 'blogig_header_menu_part', 10 );
 endif;

 if( ! function_exists( 'blogig_header_custom_button_part' ) ) :
    /**
     * Header custom button element
     * 
     * @since 1.0.0
     */
    function blogig_header_custom_button_part() {
        if( ! BD\blogig_get_customizer_option( 'blogig_header_custom_button_option' ) ) return;
        $custom_button_redirect_link = BD\blogig_get_customizer_option( 'blogig_custom_button_redirect_href_link' );
        $custom_button_label = BD\blogig_get_customizer_option( 'blogig_custom_button_label' );
        $custom_button_icon = BD\blogig_get_customizer_option( 'blogig_custom_button_icon' );
        $custom_button_target = BD\blogig_get_customizer_option( 'blogig_custom_button_target' );
        $custom_button_icon_context = BD\blogig_get_customizer_option( 'blogig_custom_button_icon_prefix_suffix' );
        $custom_button_text_option = BD\blogig_get_customizer_option( 'show_custom_button_text_mobile_option' );
        $mobile_button_text_class = ( ! $custom_button_text_option ) ? ' hide-on-mobile' : '';
        ?>
            <a class="header-custom-button" href="<?php echo esc_url( $custom_button_redirect_link ); ?>" target="<?php echo esc_attr( $custom_button_target ); ?>">
                <?php
                    if( $custom_button_icon_context == 'prefix' ) :
                        if( $custom_button_icon['type'] == 'icon' ) {
                            if( $custom_button_icon['value'] != 'fas fa-ban' ) echo '<span class="custom-button-icon"><i class="'. esc_attr( $custom_button_icon['value'] ) .'"></i></span>';
                        } else {
                            if( $custom_button_icon['type'] != 'none' ) echo '<span class="custom-button-icon">'. wp_get_attachment_image( $custom_button_icon['value'], 'full' ) .'</span>';
                        }
                    endif;

                    if( $custom_button_label ) echo '<span class="custom-button-label'. esc_attr( $mobile_button_text_class ) .'">' . esc_html( $custom_button_label ) .'</span>';

                    if( $custom_button_icon_context == 'suffix' ) :
                        if( $custom_button_icon['type'] == 'icon' ) {
                            if( $custom_button_icon['value'] != 'fas fa-ban' ) echo '<span class="custom-button-icon icon_after"><i class="'. esc_attr( $custom_button_icon['value'] ) .'"></i></span>';
                        } else {
                            if( $custom_button_icon['type'] != 'none' ) echo '<span class="custom-button-icon icon_after">'. wp_get_attachment_image( $custom_button_icon['value'], 'full' ) .'</span>';
                        }
                    endif;
                ?>
            </a>
        <?php
    }
    add_action( 'blogig_header__custom_button_section_hook', 'blogig_header_custom_button_part', 10 );
 endif;

 if( ! function_exists( 'blogig_header_live_search_part' ) ) :
    /**
     * Header live search element
     * 
     * @since 1.0.0
     */
    function blogig_header_live_search_part() {
        if( ! BD\blogig_get_customizer_option( 'blogig_header_live_search_option' ) ) return;
        ?>
            <div class="search-wrap">
                <button class="search-trigger"><i class="fas fa-search"></i></button>
                <div class="search-form-wrap">
                    <?php echo get_search_form(); ?>
                    <button class="search-form-close"><i class="fas fa-times"></i></button>
                </div>
            </div>
        <?php
    }
    add_action( 'blogig_header__custom_button_section_hook', 'blogig_header_live_search_part', 10 );
 endif;

 if( ! function_exists( 'blogig_header_theme_mode_part' ) ) :
    /**
     * Header theme mode element
     * 
     * @since 1.0.0
     */
    function blogig_header_theme_mode_part() {
        if( ! BD\blogig_get_customizer_option( 'blogig_theme_mode_option' ) ) return;
        $light_mode_icon_args = BD\blogig_get_customizer_option( 'blogig_theme_mode_light_icon' );
        $dark_mode_icon_args = BD\blogig_get_customizer_option( 'blogig_theme_mode_dark_icon' );
        $light_mode_icon_class = ( array_key_exists( 'value', $light_mode_icon_args ) && is_array( $light_mode_icon_args ) ) ? $light_mode_icon_args['value'] : '';
        $dark_mode_icon_class = ( array_key_exists( 'value', $dark_mode_icon_args ) && is_array( $dark_mode_icon_args ) ) ? $dark_mode_icon_args['value'] : '';
        ?>
            <div class="mode-toggle-wrap">
                <span class="mode-toggle">
                    <?php 
                        blogig_theme_mode_switch( $light_mode_icon_args, 'light' );
                        blogig_theme_mode_switch( $dark_mode_icon_args, 'dark' );
                    ?>
                </span>
            </div>
        <?php
    }
    add_action( 'blogig_header__custom_button_section_hook', 'blogig_header_theme_mode_part' );
 endif;

 if( ! function_exists( 'blogig_header_canvas_menu_part' ) ) :
    /**
     * Header canvas menu element
     * 
     * @since 1.0.0
     */
    function blogig_header_canvas_menu_part() {
        if( ! BD\blogig_get_customizer_option( 'canvas_menu_enable_disable_option' ) ) return;
        $canvas_menu_icon = BD\blogig_get_customizer_option( 'canvas_menu_icon_picker' );
        ?>
            <div class="blogig-canvas-menu">
                <span class="canvas-menu-icon">
                    <?php 
                        if( $canvas_menu_icon['type'] == 'icon' ) : 
                            echo '<i class="'. esc_attr( $canvas_menu_icon['value'] ) .'"></i>';
                        else:
                            echo '<img src="'. esc_url( wp_get_attachment_image_url( $canvas_menu_icon['value'] ) ) .'">';
                        endif;
                    ?>
                </span>
                <div class="canvas-menu-sidebar">
                    <?php if( is_active_sidebar( 'canvas-menu-sidebar' ) ) dynamic_sidebar( 'canvas-menu-sidebar' ); ?>
                </div>
            </div>
        <?php
    }
    add_action( 'blogig_header__custom_button_section_hook', 'blogig_header_canvas_menu_part' );
 endif;
 

 if( ! function_exists( 'blogig_header_advertisement_part' ) ) :
    /**
     * Blogig main banner element
     * 
     * @since 1.0.0
     */
    function blogig_header_advertisement_part() {
        $advertisement_repeater = BD\blogig_get_customizer_option( 'blogig_advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $header_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_header' ) ) return ( $element->item_checkbox_header == true && $element->item_option == 'show' ) ? $element : '';
        }));
        if( empty( $header_advertisement ) ) return;
        $image_option = array_column( $header_advertisement, 'item_image_option' );
        $alignment = array_column( $header_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <section class="blogig-advertisement-section-header blogig-advertisement <?php echo esc_html( $elementClass ); ?>">
                <div class="blogig-container">
                    <div class="row">
                        <div class="advertisement-wrap">
                            <?php
                                if( ! empty( $advertisement_repeater_decoded ) ) :
                                    foreach( $header_advertisement as $field ) :
                                        ?>
                                        <div class="advertisement">
                                            <a href="<?php echo esc_url( $field->item_url ); ?>" target="<?php echo esc_attr( $field->item_target ); ?>" rel="<?php echo esc_attr( $field->item_rel_attribute ); ?>">
                                                <img src="<?php echo esc_url( wp_get_attachment_image_url( $field->item_image, 'full' ) ); ?>">
                                            </a>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogig_header_after_hook', 'blogig_header_advertisement_part', 10 );
 endif;

 if( ! function_exists( 'blogig_footer_advertisement_part' ) ) :
    /**
     * Blogig main banner element
     * 
     * @since 1.0.0
     */
    function blogig_footer_advertisement_part() {
        $advertisement_repeater = BD\blogig_get_customizer_option( 'blogig_advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $footer_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_stick_with_footer' ) ) return ( $element->item_checkbox_stick_with_footer == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( empty( $footer_advertisement ) ) return;
        $image_option = array_column( $footer_advertisement, 'item_image_option' );
        $alignment = array_column( $footer_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <section class="blogig-advertisement-section-footer blogig-advertisement <?php echo esc_html( $elementClass ); ?>">
                <div class="blogig-container">
                    <div class="row">
                        <div class="advertisement-wrap">
                            <?php
                                if( ! empty( $advertisement_repeater_decoded ) ) :
                                    foreach( $footer_advertisement as $field ) :
                                        ?>
                                        <div class="advertisement">
                                            <a href="<?php echo esc_url( $field->item_url ); ?>" target="<?php echo esc_attr( $field->item_target ); ?>" rel="<?php echo esc_attr( $field->item_rel_attribute ); ?>">
                                                <img src="<?php echo esc_url( wp_get_attachment_image_url( $field->item_image, 'full' ) ); ?>">
                                            </a>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogig_before_footer_hook', 'blogig_footer_advertisement_part' );
 endif;

 if( ! function_exists( 'blogig_before_content_advertisement_part' ) ) :
    /**
     * Blogig main banner element
     * 
     * @since 1.0.0
     */
    function blogig_before_content_advertisement_part() {
        $advertisement_repeater = BD\blogig_get_customizer_option( 'blogig_advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $before_content_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_before_post_content' ) ) return ( $element->item_checkbox_before_post_content == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( empty( $before_content_advertisement ) ) return;
        $image_option = array_column( $before_content_advertisement, 'item_image_option' );
        $alignment = array_column( $before_content_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <section class="blogig-advertisement-section-before-content blogig-advertisement <?php echo esc_html( $elementClass ); ?>">
                <div class="blogig-container">
                    <div class="row">
                        <div class="advertisement-wrap">
                            <?php
                                if( ! empty( $advertisement_repeater_decoded ) ) :
                                    foreach( $before_content_advertisement as $field ) :
                                        ?>
                                        <div class="advertisement">
                                            <a href="<?php echo esc_url( $field->item_url ); ?>" target="<?php echo esc_attr( $field->item_target ); ?>" rel="<?php echo esc_attr( $field->item_rel_attribute ); ?>">
                                                <img src="<?php echo esc_url( wp_get_attachment_image_url( $field->item_image, 'full' ) ); ?>">
                                            </a>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogig_before_single_content_hook', 'blogig_before_content_advertisement_part' );
 endif;

 if( ! function_exists( 'blogig_after_content_advertisement_part' ) ) :
    /**
     * Blogig main banner element
     * 
     * @since 1.0.0
     */
    function blogig_after_content_advertisement_part() {
        $advertisement_repeater = BD\blogig_get_customizer_option( 'blogig_advertisement_repeater' );
        $advertisement_repeater_decoded = json_decode( $advertisement_repeater );
        $after_content_advertisement = array_values(array_filter( $advertisement_repeater_decoded, function( $element ) {
            if( property_exists( $element, 'item_checkbox_after_post_content' ) ) return ( $element->item_checkbox_after_post_content == true && $element->item_option == 'show' ) ? $element : ''; 
        }));
        if( empty( $after_content_advertisement ) ) return;
        $image_option = array_column( $after_content_advertisement, 'item_image_option' );
        $alignment = array_column( $after_content_advertisement, 'item_alignment' );
        $elementClass = 'alignment--' . $alignment[0];
        $elementClass .= ' image-option--' . ( ( $image_option[0] == 'full_width' ) ? 'full-width' : 'original' );
        ?>
            <section class="blogig-advertisement-section-after-content blogig-advertisement <?php echo esc_html( $elementClass ); ?>">
                <div class="blogig-container">
                    <div class="row">
                        <div class="advertisement-wrap">
                            <?php
                                if( ! empty( $advertisement_repeater_decoded ) ) :
                                    foreach( $after_content_advertisement as $field ) :
                                        ?>
                                        <div class="advertisement">
                                            <a href="<?php echo esc_url( $field->item_url ); ?>" target="<?php echo esc_attr( $field->item_target ); ?>" rel="<?php echo esc_attr( $field->item_rel_attribute ); ?>">
                                                <img src="<?php echo esc_url( wp_get_attachment_image_url( $field->item_image, 'full' ) ); ?>">
                                            </a>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogig_after_single_content_hook', 'blogig_after_content_advertisement_part' );
 endif;