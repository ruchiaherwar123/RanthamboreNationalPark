<?php
/**
 * Blogig Customizer
 *
 * @package Blogig
 */
use Blogig\CustomizerDefault as BD;
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blogig_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_section( 'background_image' )->title = esc_html__( 'Background', 'blogig' );
	$wp_customize->get_section( 'background_image' )->priority = 90;
    $wp_customize->remove_control( 'background_color' );

	$wp_customize->register_control_type( 'Blogig_WP_Radio_Image_Control' );
	$wp_customize->register_control_type( 'Blogig_WP_Editor_Control' );

	require get_template_directory() . '/inc/customizer/custom-controls/editor-control/editor-control.php'; // editor-control
	require get_template_directory() . '/inc/customizer/custom-controls/radio-image/radio-image.php'; // radio-image
	require get_template_directory() . '/inc/customizer/custom-controls/repeater/repeater.php'; // repeater
	require get_template_directory() . '/inc/customizer/custom-controls/redirect-control/redirect-control.php'; // redirect-control
	require get_template_directory() . '/inc/customizer/custom-controls/section-heading/section-heading.php'; // section-heading
	require get_template_directory() . '/inc/customizer/base.php'; // base
	require get_template_directory() . '/inc/customizer/custom-controls/section-heading-toggle/section-heading-toggle.php'; // section-heading-toggle
	require get_template_directory() . '/inc/customizer/custom-controls/icon-picker/icon-picker.php'; // icon picker

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'blogig_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'blogig_customize_partial_blogdescription',
			)
		);
	}

	// preset color picker control
    class Blogig_WP_Preset_Color_Picker_Control extends Blogig_WP_Base_Control {
        // control type
        public $type = 'preset-color-picker';
        public $variable = '--blogig-global-preset-color-1';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            if( $this->variable ) {
                $this->json['variable'] = $this->variable;
            }
        }
    }

	// preset gradient picker control
    class Blogig_WP_Preset_Gradient_Picker_Control extends Blogig_WP_Base_Control {
        // control type
        public $type = 'preset-gradient-picker';
        public $variable = '--blogig-global-preset-gradient-color-1';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            if( $this->variable ) {
                $this->json['variable'] = $this->variable;
            }
        }
    }

	// radio tab control
    class Blogig_WP_Responsive_Multiselect_Tab_Control extends Blogig_WP_Base_Control {
        // control type
        public $type = 'responsive-multiselect-tab';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
        }
    }

	// responsive range control
	class Blogig_WP_Responsive_Range_Control extends Blogig_WP_Base_Control {
		// control type
		public $type = 'responsive-range';

		/**
		 * Add custom JSON parameters to use in the JS template
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json() {
			parent::to_json();
			$this->json['input_attrs'] = $this->input_attrs;
		}
	}

	// Normal range control
	class Blogig_WP_Range_Control extends Blogig_WP_Base_Control {
		// control type
		public $type = 'range';

		/**
		 * Add custom JSON parameters to use in the JS template.
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json() {
			parent::to_json();
			$this->json['input_attrs'] = $this->input_attrs;
		}
	}

	//section tab control = renders section tab control
	class Blogig_WP_Section_Tab_Control extends Blogig_WP_Base_Control {
		//control type
		public $type = 'section-tab';

		/**
		 * Add custom JSON parameters to use in the JS template
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json() {
			parent::to_json();
			$this->json['choices'] = $this->choices;
		}
	}

	// tab group control
	class Blogig_WP_Default_Color_Control extends WP_Customize_Color_Control {
		/**
		 * Additional variable
		 */
		public $tab = 'general';

		/**
		 * Add custom JSON parameters to use in the JS template
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json() {
			parent::to_json();
			if( $this->tab && $this->type != 'section-tab' ) :
				$this->json['tab'] = $this->tab;
			endif;
		}
	}

	// code editor control
	class Blogig_WP_Customize_Code_Editor_Control extends WP_Customize_Code_Editor_Control {
		/**
		 * Additional variable
		 */
		public $tab = 'general';

		/**
		 * Add custom JSON parameters to use in the JS template
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json() {
			parent::to_json();
			if( $this->tab && $this->type != 'section-tab' ) :
				$this->json['tab'] = $this->tab;
			endif;
		}
	}

	// Typography Control
	class Blogig_WP_Typography_Control extends Blogig_WP_Base_Control {
		//control type
		public $type = 'typography';
		public $fields;

		/**
		 * Add custom JSON parameters to use in the JS template
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json(){
			parent::to_json();
			$this->json['fields'] = $this->fields;
		}
	}

	// Toggle Control
	class Blogig_WP_Toggle_Control extends Blogig_WP_Base_Control {
		//conrol type
		public $type = 'toggle-button';
	}

	 // simple toggle control 
	 class Blogig_WP_Simple_Toggle_Control extends Blogig_WP_Base_Control {
        // control type
        public $type = 'simple-toggle';
    }

	// categories multiselect control
    class Blogig_WP_Categories_Multiselect_Control extends Blogig_WP_Base_Control {
        // control type
        public $type = 'categories-multiselect';
		
        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
        }
    }

	// posts multiselect control
    class Blogig_WP_Posts_Multiselect_Control extends Blogig_WP_Base_Control {
        // control type
        public $type = 'posts-multiselect';

        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
        }
    }

	//Icon-Text Control
	class Blogig_WP_Icon_Text_Control extends Blogig_WP_Base_Control {
		// Control Type
		public $type = 'icon-text';
		public $icons;
		
		/**
		 * Add custom JSON paramter to use in the JS template
		 * 
		 * @since 1.0.0
		 * @access public
		 * @return void
		 */
		public function to_json() {
			parent::to_json();
			$this->json['icons'] = $this->icons;
		}
	}

	// Color group picker control - renders color and hover color control
    class Blogig_WP_Color_Group_Picker_Control extends Blogig_WP_Base_Control {
        // control type
        public $type = 'color-group-picker';
    }

	// Color group picker control - renders color and hover color control
    class Blogig_WP_Background_Color_Group_Picker_Control extends Blogig_WP_Base_Control {
        // control type
        public $type = 'background-color-group-picker';
    }

	// Color group picker control - renders color and hover color control
    class Blogig_WP_Spacing_Control extends Blogig_WP_Base_Control {
        // control type
        public $type = 'spacing';
    }

	// Color Group Control
	class Blogig_WP_Color_Group_Control extends Blogig_WP_Base_Control {
		public $type = 'color-group';
	}

	// color picker control
    class Blogig_WP_Color_Picker_Control extends Blogig_WP_Base_Control {
        // control type
        public $type = 'color-picker';
    }

	// Radio Tab Control
	class Blogig_WP_Radio_Tab_Control extends Blogig_WP_Base_Control {
		// control type
		public $type = 'radio-tab';

		/**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
        }
	}

	// info box control
    class Blogig_WP_Info_Box_Control extends Blogig_WP_Base_Control {
        // control type
        public $type = 'info-box';
        
        /**
         * Add custom JSON parameters to use in the JS template.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            $this->json['choices'] = $this->choices;
        }
    }

	// Border Control
	class Blogig_WP_Border_Control extends Blogig_WP_Base_Control {
		// control type
		public $type = 'border';
		
	}

	// site background color
    $wp_customize->add_setting( 'site_background_color', array(
        'default'   => BD\blogig_get_customizer_default( 'site_background_color' ),
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 
        new Blogig_WP_Color_Group_Control( $wp_customize, 'site_background_color', array(
            'label'	      => esc_html__( 'Background Color', 'blogig' ),
            'section'     => 'background_image',
            'settings'    => 'site_background_color',
            'priority'  => 1
        ))
    );

	// site background color
    $wp_customize->add_setting( 'site_background_animation', array(
        'default'   => BD\blogig_get_customizer_default( 'site_background_animation' ),
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control( 'site_background_animation', array(
		'label'	      => esc_html__( 'Background animation', 'blogig' ),
		'section'     => 'background_image',
		'settings'    => 'site_background_animation',
		'type'	=>	'select',
		'choices'	=>	[
			'none'	=>	esc_html__( 'None', 'blogig' ),
			'one'	=>	esc_html__( 'Animation 1', 'blogig' ),
			'two'	=>	esc_html__( 'Animation 2', 'blogig' )
		],
		'priority'  => 1
	));

	// animation object color
	$wp_customize->add_setting( 'animation_object_color', [
		'default'   => BD\blogig_get_customizer_default( 'animation_object_color' ),
		'transport' => 'postMessage',
		'sanitize_callback' => 'blogig_sanitize_color_picker_control'
	]);
	$wp_customize->add_control( 
		new Blogig_WP_Color_Picker_Control( $wp_customize, 'animation_object_color', [
			'label'	      => esc_html__( 'Animation object color', 'blogig' ),
			'section'     => 'background_image',
			'settings'    => 'animation_object_color',
			'priority'  => 1
		])
	);
}
add_action( 'customize_register', 'blogig_customize_register' );

add_filter( BLOGIG_PREFIX . 'unique_identifier', function($identifier) {
    $bc_delimeter = '-';
    $bc_prefix = 'customize';
    $bc_sufix = 'control';
    $identifier_id = [$bc_prefix,$identifier,$bc_sufix];
    return implode($bc_delimeter,$identifier_id);
});

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function blogig_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function blogig_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blogig_customize_preview_js() {
	wp_enqueue_script( 'blogig-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), BLOGIG_VERSION, true );
}
add_action( 'customize_preview_init', 'blogig_customize_preview_js' );

// Get list of image sizes
function blogig_get_image_sizes_option_array_for_customizer() {
	$sizes_lists = [];
	$images_sizes = get_intermediate_image_sizes();
	if( $images_sizes ) {
		foreach( $images_sizes as $size ) {
			$sizes_lists[$size] = $size;
		}
	}
	return $sizes_lists;
}

require get_template_directory() . '/inc/customizer/handlers.php';
require get_template_directory() . '/inc/customizer/sanitize-functions.php';
require get_template_directory() . '/inc/customizer/customizer-up.php'; // customizer up

if( ! function_exists( 'blogig_customize_selective_refresh' ) ) :
	/**
     * Adds partial refresh for the customizer preview
     * 
     */
    function blogig_customize_selective_refresh( $wp_customize ) {
		// archive read more button label
		$wp_customize->selective_refresh->add_partial(
			'archive_button_icon',
			array(
				'selector'        => '.post-button .button-icon',
				'render_callback' => 'blogig_customizer_read_more_button',
			)
		);
	}
	add_action( 'customize_register', 'blogig_customize_selective_refresh' );
endif;

// global button label
function blogig_customizer_read_more_button() {
    $archive_button_icon = BD\blogig_get_customizer_option( 'archive_button_icon' );
	$icon_html = blogig_get_icon_control_html($archive_button_icon);
	if( $icon_html ) return $icon_html;
	return;
}

if( ! function_exists( 'blogig_get_all_fontawesome_icons' ) ) :
	/**
	 * All fontawesome icons array - 6.4.2
	 * 
	 * @since 1.0.0
	 * 
	 */
	function blogig_get_all_fontawesome_icons() {
        return ["fa-brands fa-500px","fa-brands fa-accessible-icon" ,"fa-brands fa-accusoft", "fa-solid fa-address-book", "fa-regular fa-address-book" ,"fa-solid fa-address-card", "fa-regular fa-address-card" ,"fa-solid fa-adjust" ,"fa-brands fa-adn" ,"fa-brands fa-adversal" ,"fa-brands fa-affiliatetheme" ,"fa-brands fa-algolia" ,"fa-solid fa-align-center" ,"fa-solid fa-align-justify" ,"fa-solid fa-align-left" ,"fa-solid fa-align-right" ,"fa-brands fa-amazon" ,"fa-solid fa-ambulance" ,"fa-solid fa-american-sign-language-interpreting" ,"fa-brands fa-amilia" ,"fa-solid fa-anchor" ,"fa-brands fa-android" ,"fa-brands fa-angellist" ,"fa-solid fa-angle-double-down" ,"fa-solid fa-angle-double-left" ,"fa-solid fa-angle-double-right" ,"fa-solid fa-angle-double-up" ,"fa-solid fa-angle-down" ,"fa-solid fa-angle-left" ,"fa-solid fa-angle-right" ,"fa-solid fa-angle-up" ,"fa-brands fa-angrycreative" ,"fa-brands fa-angular" ,"fa-brands fa-app-store" ,"fa-brands fa-app-store-ios" ,"fa-brands fa-apper" ,"fa-brands fa-apple" ,"fa-brands fa-apple-pay" ,"fa-solid fa-archive" ,"fa-solid fa-arrow-alt-circle-down", "fa-regular fa-arrow-alt-circle-down" ,"fa-solid fa-arrow-alt-circle-left", "fa-brands fa-tiktok", "fa-regular fa-arrow-alt-circle-left" ,"fa-solid fa-arrow-alt-circle-right", "fa-regular fa-arrow-alt-circle-right" ,"fa-solid fa-arrow-alt-circle-up", "fa-regular fa-arrow-alt-circle-up" ,"fa-solid fa-arrow-circle-down" ,"fa-solid fa-arrow-circle-left" ,"fa-solid fa-arrow-circle-right" ,"fa-solid fa-arrow-circle-up" ,"fa-solid fa-arrow-down" ,"fa-solid fa-arrow-left" ,"fa-solid fa-arrow-right" ,"fa-solid fa-arrow-up" ,"fa-solid fa-arrows-alt" ,"fa-solid fa-arrows-alt-h" ,"fa-solid fa-arrows-alt-v" ,"fa-solid fa-assistive-listening-systems" ,"fa-solid fa-asterisk" ,"fa-brands fa-asymmetrik" ,"fa-solid fa-at" ,"fa-brands fa-audible" ,"fa-solid fa-audio-description" ,"fa-brands fa-autoprefixer" ,"fa-brands fa-avianex" ,"fa-brands fa-aviato" ,"fa-brands fa-aws" ,"fa-solid fa-backward" ,"fa-solid fa-balance-scale" ,"fa-solid fa-ban" ,"fa-brands fa-bandcamp" ,"fa-solid fa-barcode" ,"fa-solid fa-bars" ,"fa-solid fa-bath" ,"fa-solid fa-battery-empty" ,"fa-solid fa-battery-full" ,"fa-solid fa-battery-half" ,"fa-solid fa-battery-quarter" ,"fa-solid fa-battery-three-quarters" ,"fa-solid fa-bed" ,"fa-solid fa-beer" ,"fa-brands fa-behance" ,"fa-brands fa-behance-square" ,"fa-solid fa-bell", "fa-regular fa-bell" ,"fa-solid fa-bell-slash", "fa-regular fa-bell-slash" ,"fa-solid fa-bicycle" ,"fa-brands fa-bimobject" ,"fa-solid fa-binoculars" ,"fa-solid fa-birthday-cake" ,"fa-brands fa-bitbucket" ,"fa-brands fa-bitcoin" ,"fa-brands fa-bity" ,"fa-brands fa-black-tie" ,"fa-brands fa-blackberry" ,"fa-solid fa-blind" ,"fa-brands fa-blogger" ,"fa-brands fa-blogger-b" ,"fa-brands fa-bluetooth" ,"fa-brands fa-bluetooth-b" ,"fa-solid fa-bold" ,"fa-solid fa-bolt" ,"fa-solid fa-bomb" ,"fa-solid fa-book" ,"fa-solid fa-bookmark", "fa-regular fa-bookmark" ,"fa-solid fa-braille" ,"fa-solid fa-briefcase" ,"fa-brands fa-btc" ,"fa-solid fa-bug" ,"fa-solid fa-building", "fa-regular fa-building" ,"fa-solid fa-bullhorn" ,"fa-solid fa-bullseye" ,"fa-brands fa-buromobelexperte" ,"fa-solid fa-bus" ,"fa-brands fa-buysellads" ,"fa-solid fa-calculator" ,"fa-solid fa-calendar", "fa-regular fa-calendar" ,"fa-solid fa-calendar-alt", "fa-regular fa-calendar-alt" ,"fa-solid fa-calendar-check", "fa-regular fa-calendar-check" ,"fa-solid fa-calendar-minus", "fa-regular fa-calendar-minus" ,"fa-solid fa-calendar-plus", "fa-regular fa-calendar-plus" ,"fa-solid fa-calendar-times", "fa-regular fa-calendar-times" ,"fa-solid fa-camera" ,"fa-solid fa-camera-retro" ,"fa-solid fa-car" ,"fa-solid fa-caret-down" ,"fa-solid fa-caret-left" ,"fa-solid fa-caret-right" ,"fa-solid fa-caret-square-down", "fa-regular fa-caret-square-down" ,"fa-solid fa-caret-square-left", "fa-regular fa-caret-square-left" ,"fa-solid fa-caret-square-right", "fa-regular fa-caret-square-right" ,"fa-solid fa-caret-square-up", "fa-regular fa-caret-square-up" ,"fa-solid fa-caret-up" ,"fa-solid fa-cart-arrow-down" ,"fa-solid fa-cart-plus" ,"fa-brands fa-cc-amex" ,"fa-brands fa-cc-apple-pay" ,"fa-brands fa-cc-diners-club" ,"fa-brands fa-cc-discover" ,"fa-brands fa-cc-jcb" ,"fa-brands fa-cc-mastercard" ,"fa-brands fa-cc-paypal" ,"fa-brands fa-cc-stripe" ,"fa-brands fa-cc-visa" ,"fa-brands fa-centercode" ,"fa-solid fa-certificate" ,"fa-solid fa-chart-area" ,"fa-solid fa-chart-bar", "fa-regular fa-chart-bar" ,"fa-solid fa-chart-line" ,"fa-solid fa-chart-pie" ,"fa-solid fa-check" ,"fa-solid fa-check-circle", "fa-regular fa-check-circle" ,"fa-solid fa-check-square", "fa-regular fa-check-square" ,"fa-solid fa-chevron-circle-down" ,"fa-solid fa-chevron-circle-left" ,"fa-solid fa-chevron-circle-right" ,"fa-solid fa-chevron-circle-up" ,"fa-solid fa-chevron-down" ,"fa-solid fa-chevron-left" ,"fa-solid fa-chevron-right" ,"fa-solid fa-chevron-up" ,"fa-solid fa-child" ,"fa-brands fa-chrome" ,"fa-solid fa-circle", "fa-regular fa-circle" ,"fa-solid fa-circle-notch" ,"fa-solid fa-clipboard", "fa-regular fa-clipboard" ,"fa-solid fa-clock", "fa-regular fa-clock" ,"fa-solid fa-clone", "fa-regular fa-clone" ,"fa-solid fa-closed-captioning", "fa-regular fa-closed-captioning" ,"fa-solid fa-cloud" ,"fa-solid fa-cloud-download-alt" ,"fa-solid fa-cloud-upload-alt" ,"fa-brands fa-cloudscale" ,"fa-brands fa-cloudsmith" ,"fa-brands fa-cloudversify" ,"fa-solid fa-code" ,"fa-solid fa-code-branch" ,"fa-brands fa-codepen" ,"fa-brands fa-codiepie" ,"fa-solid fa-coffee" ,"fa-solid fa-cog" ,"fa-solid fa-cogs" ,"fa-solid fa-columns" ,"fa-solid fa-comment", "fa-regular fa-comment" ,"fa-solid fa-comment-alt", "fa-regular fa-comment-alt" ,"fa-solid fa-comments", "fa-regular fa-comments" ,"fa-solid fa-compass", "fa-regular fa-compass" ,"fa-solid fa-compress" ,"fa-brands fa-connectdevelop" ,"fa-brands fa-contao" ,"fa-solid fa-copy", "fa-regular fa-copy" ,"fa-solid fa-copyright", "fa-regular fa-copyright" ,"fa-brands fa-cpanel" ,"fa-brands fa-creative-commons" ,"fa-solid fa-credit-card", "fa-regular fa-credit-card" ,"fa-solid fa-crop" ,"fa-solid fa-crosshairs" ,"fa-brands fa-css3" ,"fa-brands fa-css3-alt" ,"fa-solid fa-cube" ,"fa-solid fa-cubes" ,"fa-solid fa-cut" ,"fa-brands fa-cuttlefish" ,"fa-brands fa-d-and-d" ,"fa-brands fa-dashcube" ,"fa-solid fa-database" ,"fa-solid fa-deaf" ,"fa-brands fa-delicious" ,"fa-brands fa-deploydog" ,"fa-brands fa-deskpro" ,"fa-solid fa-desktop" ,"fa-brands fa-deviantart" ,"fa-brands fa-digg" ,"fa-brands fa-digital-ocean" ,"fa-brands fa-discord" ,"fa-brands fa-discourse" ,"fa-brands fa-dochub" ,"fa-brands fa-docker" ,"fa-solid fa-dollar-sign" ,"fa-solid fa-dot-circle", "fa-regular fa-dot-circle" ,"fa-solid fa-download" ,"fa-brands fa-draft2digital" ,"fa-brands fa-dribbble" ,"fa-brands fa-dribbble-square" ,"fa-brands fa-dropbox" ,"fa-brands fa-drupal" ,"fa-brands fa-dyalog" ,"fa-brands fa-earlybirds" ,"fa-brands fa-edge" ,"fa-solid fa-edit", "fa-regular fa-edit" ,"fa-solid fa-eject" ,"fa-solid fa-ellipsis-h" ,"fa-solid fa-ellipsis-v" ,"fa-brands fa-ember" ,"fa-brands fa-empire" ,"fa-solid fa-envelope", "fa-regular fa-envelope" ,"fa-solid fa-envelope-open", "fa-regular fa-envelope-open" ,"fa-solid fa-envelope-square" ,"fa-brands fa-envira" ,"fa-solid fa-eraser" ,"fa-brands fa-erlang" ,"fa-brands fa-etsy" ,"fa-solid fa-euro-sign" ,"fa-solid fa-exchange-alt" ,"fa-solid fa-exclamation" ,"fa-solid fa-exclamation-circle" ,"fa-solid fa-exclamation-triangle" ,"fa-solid fa-expand" ,"fa-solid fa-expand-arrows-alt" ,"fa-brands fa-expeditedssl" ,"fa-solid fa-external-link-alt" ,"fa-solid fa-external-link-square-alt" ,"fa-solid fa-eye" ,"fa-solid fa-eye-dropper" ,"fa-solid fa-eye-slash", "fa-regular fa-eye-slash" ,"fa-brands fa-facebook" ,"fa-brands fa-facebook-f" ,"fa-brands fa-facebook-messenger" ,"fa-brands fa-facebook-square" ,"fa-solid fa-fast-backward" ,"fa-solid fa-fast-forward" ,"fa-solid fa-fax" ,"fa-solid fa-female" ,"fa-solid fa-fighter-jet" ,"fa-solid fa-file", "fa-regular fa-file" ,"fa-solid fa-file-alt", "fa-regular fa-file-alt" ,"fa-solid fa-file-archive", "fa-regular fa-file-archive" ,"fa-solid fa-file-audio", "fa-regular fa-file-audio" ,"fa-solid fa-file-code", "fa-regular fa-file-code" ,"fa-solid fa-file-excel", "fa-regular fa-file-excel" ,"fa-solid fa-file-image", "fa-regular fa-file-image" ,"fa-solid fa-file-pdf", "fa-regular fa-file-pdf" ,"fa-solid fa-file-powerpoint", "fa-regular fa-file-powerpoint" ,"fa-solid fa-file-video", "fa-regular fa-file-video" ,"fa-solid fa-file-word", "fa-regular fa-file-word" ,"fa-solid fa-film" ,"fa-solid fa-filter" ,"fa-solid fa-fire" ,"fa-solid fa-fire-extinguisher" ,"fa-brands fa-firefox" ,"fa-brands fa-first-order" ,"fa-brands fa-firstdraft" ,"fa-solid fa-flag", "fa-regular fa-flag" ,"fa-solid fa-flag-checkered" ,"fa-solid fa-flask" ,"fa-brands fa-flickr" ,"fa-brands fa-fly" ,"fa-solid fa-folder", "fa-regular fa-folder" ,"fa-solid fa-folder-open", "fa-regular fa-folder-open" ,"fa-solid fa-font" ,"fa-brands fa-font-awesome" ,"fa-brands fa-font-awesome-alt" ,"fa-brands fa-font-awesome-flag" ,"fa-brands fa-fonticons" ,"fa-brands fa-fonticons-fi" ,"fa-brands fa-fort-awesome" ,"fa-brands fa-fort-awesome-alt" ,"fa-brands fa-forumbee" ,"fa-solid fa-forward" ,"fa-brands fa-foursquare" ,"fa-brands fa-free-code-camp" ,"fa-brands fa-freebsd" ,"fa-solid fa-frown", "fa-regular fa-frown" ,"fa-solid fa-futbol", "fa-regular fa-futbol" ,"fa-solid fa-gamepad" ,"fa-solid fa-gavel" ,"fa-solid fa-gem", "fa-regular fa-gem" ,"fa-solid fa-genderless" ,"fa-brands fa-get-pocket" ,"fa-brands fa-gg" ,"fa-brands fa-gg-circle" ,"fa-solid fa-gift" ,"fa-brands fa-git" ,"fa-brands fa-git-square" ,"fa-brands fa-github" ,"fa-brands fa-github-alt" ,"fa-brands fa-github-square" ,"fa-brands fa-gitkraken" ,"fa-brands fa-gitlab" ,"fa-brands fa-gitter" ,"fa-solid fa-glass-martini" ,"fa-brands fa-glide" ,"fa-brands fa-glide-g" ,"fa-solid fa-globe" ,"fa-brands fa-gofore" ,"fa-brands fa-goodreads" ,"fa-brands fa-goodreads-g" ,"fa-brands fa-google" ,"fa-brands fa-google-drive" ,"fa-brands fa-google-play" ,"fa-brands fa-google-plus" ,"fa-brands fa-google-plus-g" ,"fa-brands fa-google-plus-square" ,"fa-brands fa-google-wallet" ,"fa-solid fa-graduation-cap" ,"fa-brands fa-gratipay" ,"fa-brands fa-grav" ,"fa-brands fa-gripfire" ,"fa-brands fa-grunt" ,"fa-brands fa-gulp" ,"fa-solid fa-h-square" ,"fa-brands fa-hacker-news" ,"fa-brands fa-hacker-news-square" ,"fa-solid fa-hand-lizard", "fa-regular fa-hand-lizard" ,"fa-solid fa-hand-paper", "fa-regular fa-hand-paper" ,"fa-solid fa-hand-peace", "fa-regular fa-hand-peace" ,"fa-solid fa-hand-point-down", "fa-regular fa-hand-point-down" ,"fa-solid fa-hand-point-left", "fa-regular fa-hand-point-left" ,"fa-solid fa-hand-point-right", "fa-regular fa-hand-point-right" ,"fa-solid fa-hand-point-up", "fa-regular fa-hand-point-up" ,"fa-solid fa-hand-pointer", "fa-regular fa-hand-pointer" ,"fa-solid fa-hand-rock", "fa-regular fa-hand-rock" ,"fa-solid fa-hand-scissors", "fa-regular fa-hand-scissors" ,"fa-solid fa-hand-spock", "fa-regular fa-hand-spock" ,"fa-solid fa-handshake", "fa-regular fa-handshake" ,"fa-solid fa-hashtag" ,"fa-solid fa-hdd", "fa-regular fa-hdd" ,"fa-solid fa-heading" ,"fa-solid fa-headphones" ,"fa-solid fa-heart", "fa-regular fa-heart" ,"fa-solid fa-heartbeat" ,"fa-brands fa-hire-a-helper" ,"fa-solid fa-history" ,"fa-solid fa-home" ,"fa-brands fa-hooli" ,"fa-solid fa-hospital", "fa-regular fa-hospital" ,"fa-brands fa-hotjar" ,"fa-solid fa-hourglass", "fa-regular fa-hourglass" ,"fa-solid fa-hourglass-end" ,"fa-solid fa-hourglass-half" ,"fa-solid fa-hourglass-start" ,"fa-brands fa-houzz" ,"fa-brands fa-html5" ,"fa-brands fa-hubspot" ,"fa-solid fa-i-cursor" ,"fa-solid fa-id-badge", "fa-regular fa-id-badge" ,"fa-solid fa-id-card", "fa-regular fa-id-card" ,"fa-solid fa-image", "fa-regular fa-image" ,"fa-solid fa-images", "fa-regular fa-images" ,"fa-brands fa-imdb" ,"fa-solid fa-inbox" ,"fa-solid fa-indent" ,"fa-solid fa-industry" ,"fa-solid fa-info" ,"fa-solid fa-info-circle" ,"fa-brands fa-instagram" ,"fa-brands fa-internet-explorer" ,"fa-brands fa-ioxhost" ,"fa-solid fa-italic" ,"fa-brands fa-itunes" ,"fa-brands fa-itunes-note" ,"fa-brands fa-jenkins" ,"fa-brands fa-joget" ,"fa-brands fa-joomla" ,"fa-brands fa-js" ,"fa-brands fa-js-square" ,"fa-brands fa-jsfiddle" ,"fa-solid fa-key" ,"fa-solid fa-keyboard", "fa-regular fa-keyboard" ,"fa-brands fa-keycdn" ,"fa-brands fa-kickstarter" ,"fa-brands fa-kickstarter-k" ,"fa-solid fa-language" ,"fa-solid fa-laptop" ,"fa-brands fa-laravel" ,"fa-brands fa-lastfm" ,"fa-brands fa-lastfm-square" ,"fa-solid fa-leaf" ,"fa-brands fa-leanpub" ,"fa-solid fa-lemon", "fa-regular fa-lemon" ,"fa-brands fa-less" ,"fa-solid fa-level-down-alt" ,"fa-solid fa-level-up-alt" ,"fa-solid fa-life-ring", "fa-regular fa-life-ring" ,"fa-solid fa-lightbulb", "fa-regular fa-lightbulb" ,"fa-brands fa-line" ,"fa-solid fa-link" ,"fa-brands fa-linkedin" ,"fa-brands fa-linkedin-in" ,"fa-brands fa-linode" ,"fa-brands fa-linux" ,"fa-solid fa-lira-sign" ,"fa-solid fa-list" ,"fa-solid fa-list-alt", "fa-regular fa-list-alt" ,"fa-solid fa-list-ol" ,"fa-solid fa-list-ul" ,"fa-solid fa-location-arrow" ,"fa-solid fa-lock" ,"fa-solid fa-lock-open" ,"fa-solid fa-long-arrow-alt-down" ,"fa-solid fa-long-arrow-alt-left" ,"fa-solid fa-long-arrow-alt-right" ,"fa-solid fa-long-arrow-alt-up" ,"fa-solid fa-low-vision" ,"fa-brands fa-lyft" ,"fa-brands fa-magento" ,"fa-solid fa-magic" ,"fa-solid fa-magnet" ,"fa-solid fa-male" ,"fa-solid fa-map", "fa-regular fa-map" ,"fa-solid fa-map-marker" ,"fa-solid fa-map-marker-alt" ,"fa-solid fa-map-pin" ,"fa-solid fa-map-signs" ,"fa-solid fa-mars" ,"fa-solid fa-mars-double" ,"fa-solid fa-mars-stroke" ,"fa-solid fa-mars-stroke-h" ,"fa-solid fa-mars-stroke-v" ,"fa-brands fa-maxcdn" ,"fa-brands fa-medapps" ,"fa-brands fa-medium" ,"fa-brands fa-medium-m" ,"fa-solid fa-medkit" ,"fa-brands fa-medrt" ,"fa-brands fa-meetup" ,"fa-solid fa-meh", "fa-regular fa-meh" ,"fa-solid fa-mercury" ,"fa-solid fa-microchip" ,"fa-solid fa-microphone" ,"fa-solid fa-microphone-slash" ,"fa-brands fa-microsoft" ,"fa-solid fa-minus" ,"fa-solid fa-minus-circle" ,"fa-solid fa-minus-square", "fa-regular fa-minus-square" ,"fa-brands fa-mix" ,"fa-brands fa-mixcloud" ,"fa-brands fa-mizuni" ,"fa-solid fa-mobile" ,"fa-solid fa-mobile-alt" ,"fa-brands fa-modx" ,"fa-brands fa-monero" ,"fa-solid fa-money-bill-alt", "fa-regular fa-money-bill-alt" ,"fa-solid fa-moon", "fa-regular fa-moon" ,"fa-solid fa-motorcycle" ,"fa-solid fa-mouse-pointer" ,"fa-solid fa-music" ,"fa-brands fa-napster" ,"fa-solid fa-neuter" ,"fa-solid fa-newspaper", "fa-regular fa-newspaper" ,"fa-brands fa-nintendo-switch" ,"fa-brands fa-node" ,"fa-brands fa-node-js" ,"fa-brands fa-npm" ,"fa-brands fa-ns8" ,"fa-brands fa-nutritionix" ,"fa-solid fa-object-group", "fa-regular fa-object-group" ,"fa-solid fa-object-ungroup", "fa-regular fa-object-ungroup" ,"fa-brands fa-odnoklassniki" ,"fa-brands fa-odnoklassniki-square" ,"fa-brands fa-opencart" ,"fa-brands fa-openid" ,"fa-brands fa-opera" ,"fa-brands fa-optin-monster" ,"fa-brands fa-osi" ,"fa-solid fa-outdent" ,"fa-brands fa-page4" ,"fa-brands fa-pagelines" ,"fa-solid fa-paint-brush" ,"fa-brands fa-palfed" ,"fa-solid fa-paper-plane", "fa-regular fa-paper-plane" ,"fa-solid fa-paperclip" ,"fa-solid fa-paragraph" ,"fa-solid fa-paste" ,"fa-brands fa-patreon" ,"fa-solid fa-pause" ,"fa-solid fa-pause-circle", "fa-regular fa-pause-circle" ,"fa-solid fa-paw" ,"fa-brands fa-paypal" ,"fa-solid fa-pen-square" ,"fa-solid fa-pencil-alt" ,"fa-solid fa-percent" ,"fa-brands fa-periscope" ,"fa-brands fa-phabricator" ,"fa-brands fa-phoenix-framework" ,"fa-solid fa-phone" ,"fa-solid fa-phone-square" ,"fa-solid fa-phone-volume" ,"fa-brands fa-pied-piper" ,"fa-brands fa-pied-piper-alt" ,"fa-brands fa-pied-piper-pp" ,"fa-brands fa-pinterest" ,"fa-brands fa-pinterest-p" ,"fa-brands fa-pinterest-square" ,"fa-solid fa-plane" ,"fa-solid fa-play" ,"fa-solid fa-play-circle", "fa-regular fa-play-circle" ,"fa-brands fa-playstation" ,"fa-solid fa-plug" ,"fa-solid fa-plus" ,"fa-solid fa-plus-circle" ,"fa-solid fa-plus-square", "fa-regular fa-plus-square" ,"fa-solid fa-podcast" ,"fa-solid fa-pound-sign" ,"fa-solid fa-power-off" ,"fa-solid fa-print" ,"fa-brands fa-product-hunt" ,"fa-brands fa-pushed" ,"fa-solid fa-puzzle-piece" ,"fa-brands fa-python" ,"fa-brands fa-qq" ,"fa-solid fa-qrcode" ,"fa-solid fa-question" ,"fa-solid fa-question-circle", "fa-regular fa-question-circle" ,"fa-brands fa-quora" ,"fa-solid fa-quote-left" ,"fa-solid fa-quote-right" ,"fa-solid fa-random" ,"fa-brands fa-ravelry" ,"fa-brands fa-react" ,"fa-brands fa-rebel" ,"fa-solid fa-recycle" ,"fa-brands fa-red-river" ,"fa-brands fa-reddit" ,"fa-brands fa-reddit-alien" ,"fa-brands fa-reddit-square" ,"fa-solid fa-redo" ,"fa-solid fa-redo-alt" ,"fa-solid fa-registered", "fa-regular fa-registered" ,"fa-brands fa-rendact" ,"fa-brands fa-renren" ,"fa-solid fa-reply" ,"fa-solid fa-reply-all" ,"fa-brands fa-replyd" ,"fa-brands fa-resolving" ,"fa-solid fa-retweet" ,"fa-solid fa-road" ,"fa-solid fa-rocket" ,"fa-brands fa-rocketchat" ,"fa-brands fa-rockrms" ,"fa-solid fa-rss" ,"fa-solid fa-rss-square" ,"fa-solid fa-ruble-sign" ,"fa-solid fa-rupee-sign" ,"fa-brands fa-safari" ,"fa-brands fa-sass" ,"fa-solid fa-save", "fa-regular fa-save" ,"fa-brands fa-schlix" ,"fa-brands fa-scribd" ,"fa-solid fa-search" ,"fa-solid fa-search-minus" ,"fa-solid fa-search-plus" ,"fa-brands fa-searchengin" ,"fa-brands fa-sellcast" ,"fa-brands fa-sellsy" ,"fa-solid fa-server" ,"fa-brands fa-servicestack" ,"fa-solid fa-share" ,"fa-solid fa-share-alt" ,"fa-solid fa-share-alt-square" ,"fa-solid fa-share-square", "fa-regular fa-share-square" ,"fa-solid fa-shekel-sign" ,"fa-solid fa-shield-alt" ,"fa-solid fa-ship" ,"fa-brands fa-shirtsinbulk" ,"fa-solid fa-shopping-bag" ,"fa-solid fa-shopping-basket" ,"fa-solid fa-shopping-cart" ,"fa-solid fa-shower" ,"fa-solid fa-sign-in-alt" ,"fa-solid fa-sign-language" ,"fa-solid fa-sign-out-alt" ,"fa-solid fa-signal" ,"fa-brands fa-simplybuilt" ,"fa-brands fa-sistrix" ,"fa-solid fa-sitemap" ,"fa-brands fa-skyatlas" ,"fa-brands fa-skype" ,"fa-brands fa-slack" ,"fa-brands fa-slack-hash" ,"fa-solid fa-sliders-h" ,"fa-brands fa-slideshare" ,"fa-solid fa-smile", "fa-regular fa-smile" ,"fa-brands fa-snapchat" ,"fa-brands fa-snapchat-ghost" ,"fa-brands fa-snapchat-square" ,"fa-solid fa-snowflake", "fa-regular fa-snowflake" ,"fa-solid fa-sort" ,"fa-solid fa-sort-alpha-down" ,"fa-solid fa-sort-alpha-up" ,"fa-solid fa-sort-amount-down" ,"fa-solid fa-sort-amount-up" ,"fa-solid fa-sort-down" ,"fa-solid fa-sort-numeric-down" ,"fa-solid fa-sort-numeric-up" ,"fa-solid fa-sort-up" ,"fa-brands fa-soundcloud" ,"fa-solid fa-space-shuttle" ,"fa-brands fa-speakap" ,"fa-solid fa-spinner" ,"fa-brands fa-spotify" ,"fa-solid fa-square", "fa-regular fa-square" ,"fa-brands fa-stack-exchange" ,"fa-brands fa-stack-overflow" ,"fa-solid fa-star", "fa-regular fa-star" ,"fa-solid fa-star-half", "fa-regular fa-star-half" ,"fa-brands fa-staylinked" ,"fa-brands fa-steam" ,"fa-brands fa-steam-square" ,"fa-brands fa-steam-symbol" ,"fa-solid fa-step-backward" ,"fa-solid fa-step-forward" ,"fa-solid fa-stethoscope" ,"fa-brands fa-sticker-mule" ,"fa-solid fa-sticky-note", "fa-regular fa-sticky-note" ,"fa-solid fa-stop" ,"fa-solid fa-stop-circle", "fa-regular fa-stop-circle" ,"fa-brands fa-strava" ,"fa-solid fa-street-view" ,"fa-solid fa-strikethrough" ,"fa-brands fa-stripe" ,"fa-brands fa-stripe-s" ,"fa-brands fa-studiovinari" ,"fa-brands fa-stumbleupon" ,"fa-brands fa-stumbleupon-circle" ,"fa-solid fa-subscript" ,"fa-solid fa-subway" ,"fa-solid fa-suitcase" ,"fa-solid fa-sun", "fa-regular fa-sun" ,"fa-brands fa-superpowers" ,"fa-solid fa-superscript" ,"fa-brands fa-supple" ,"fa-solid fa-sync" ,"fa-solid fa-sync-alt" ,"fa-solid fa-table" ,"fa-solid fa-tablet" ,"fa-solid fa-tablet-alt" ,"fa-solid fa-tachometer-alt" ,"fa-solid fa-tag" ,"fa-solid fa-tags" ,"fa-solid fa-tasks" ,"fa-solid fa-taxi" ,"fa-brands fa-telegram" ,"fa-brands fa-telegram-plane" ,"fa-brands fa-tencent-weibo" ,"fa-solid fa-terminal" ,"fa-solid fa-text-height" ,"fa-solid fa-text-width" ,"fa-solid fa-th" ,"fa-solid fa-th-large" ,"fa-solid fa-th-list" ,"fa-brands fa-themeisle" ,"fa-solid fa-thermometer-empty" ,"fa-solid fa-thermometer-full" ,"fa-solid fa-thermometer-half" ,"fa-solid fa-thermometer-quarter" ,"fa-solid fa-thermometer-three-quarters" ,"fa-solid fa-thumbs-down", "fa-regular fa-thumbs-down" ,"fa-solid fa-thumbs-up", "fa-regular fa-thumbs-up" ,"fa-solid fa-thumbtack" ,"fa-solid fa-ticket-alt" ,"fa-solid fa-times" ,"fa-solid fa-times-circle", "fa-regular fa-times-circle" ,"fa-solid fa-tint" ,"fa-solid fa-toggle-off" ,"fa-solid fa-toggle-on" ,"fa-solid fa-trademark" ,"fa-solid fa-train" ,"fa-solid fa-transgender" ,"fa-solid fa-transgender-alt" ,"fa-solid fa-trash" ,"fa-solid fa-trash-alt", "fa-regular fa-trash-alt" ,"fa-solid fa-tree" ,"fa-brands fa-trello" ,"fa-brands fa-tripadvisor" ,"fa-solid fa-trophy" ,"fa-solid fa-truck" ,"fa-solid fa-tty" ,"fa-brands fa-tumblr" ,"fa-brands fa-tumblr-square" ,"fa-solid fa-tv" ,"fa-brands fa-twitch" ,"fa-brands fa-twitter" ,"fa-brands fa-twitter-square", "fa-brands fa-x-twitter", "fa-brands fa-square-x-twitter", "fa-brands fa-typo3" ,"fa-brands fa-uber" ,"fa-brands fa-uikit" ,"fa-solid fa-umbrella" ,"fa-solid fa-underline" ,"fa-solid fa-undo" ,"fa-solid fa-undo-alt" ,"fa-brands fa-uniregistry" ,"fa-solid fa-universal-access" ,"fa-solid fa-university" ,"fa-solid fa-unlink" ,"fa-solid fa-unlock" ,"fa-solid fa-unlock-alt" ,"fa-brands fa-untappd" ,"fa-solid fa-upload" ,"fa-brands fa-usb" ,"fa-solid fa-user", "fa-regular fa-user" ,"fa-solid fa-user-circle", "fa-regular fa-user-circle" ,"fa-solid fa-user-md" ,"fa-solid fa-user-plus" ,"fa-solid fa-user-secret" ,"fa-solid fa-user-times" ,"fa-solid fa-users" ,"fa-brands fa-ussunnah" ,"fa-solid fa-utensil-spoon" ,"fa-solid fa-utensils" ,"fa-brands fa-vaadin" ,"fa-solid fa-venus" ,"fa-solid fa-venus-double" ,"fa-solid fa-venus-mars" ,"fa-brands fa-viacoin" ,"fa-brands fa-viadeo" ,"fa-brands fa-viadeo-square" ,"fa-brands fa-viber" ,"fa-solid fa-video" ,"fa-brands fa-vimeo" ,"fa-brands fa-vimeo-square" ,"fa-brands fa-vimeo-v" ,"fa-brands fa-vine" ,"fa-brands fa-vk" ,"fa-brands fa-vnv" ,"fa-solid fa-volume-down" ,"fa-solid fa-volume-off" ,"fa-solid fa-volume-up" ,"fa-brands fa-vuejs" ,"fa-brands fa-weibo" ,"fa-brands fa-weixin" ,"fa-brands fa-whatsapp" ,"fa-brands fa-whatsapp-square" ,"fa-solid fa-wheelchair" ,"fa-brands fa-whmcs" ,"fa-solid fa-wifi" ,"fa-brands fa-wikipedia-w" ,"fa-solid fa-window-close", "fa-regular fa-window-close" ,"fa-solid fa-window-maximize", "fa-regular fa-window-maximize" ,"fa-solid fa-window-minimize" ,"fa-solid fa-window-restore", "fa-regular fa-window-restore" ,"fa-brands fa-windows" ,"fa-solid fa-won-sign" ,"fa-brands fa-wordpress" ,"fa-brands fa-wordpress-simple" ,"fa-brands fa-wpbeginner" ,"fa-brands fa-wpexplorer" ,"fa-brands fa-wpforms" ,"fa-solid fa-wrench" ,"fa-brands fa-xbox" ,"fa-brands fa-xing" ,"fa-brands fa-xing-square" ,"fa-brands fa-y-combinator" ,"fa-brands fa-yahoo" ,"fa-brands fa-yandex" ,"fa-brands fa-yandex-international" ,"fa-brands fa-yelp" ,"fa-solid fa-yen-sign","fa-brands fa-yoast","fa-brands fa-youtube"];
    }
endif;