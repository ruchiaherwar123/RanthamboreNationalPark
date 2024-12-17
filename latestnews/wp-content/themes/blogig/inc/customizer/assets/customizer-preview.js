/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

 ( function( $ ) {
	"use strict"
	const themeContstants = {
		prefix: 'blogig_'
	}
	const themeCalls = {
		blogigAjaxCall: function( action, id ) {
			$.ajax({
				method: "GET",
				url: blogigPreviewObject.ajaxUrl,
				data: ({
					action: action,
					_wpnonce: blogigPreviewObject._wpnonce
				}),
				success: function(response) {
					if( response ) {
						if( $( "head #" + id ).length > 0 ) {
							$( "head #" + id ).html( response )
						} else {
							$( "head" ).append( '<style id="' + id + '">' + response + '</style>' )
						}
					}
				}
			})
		},
		blogigGenerateTypoCss: function(selector,value) {
			var cssCode = ''
			if( value.font_family ) {
				cssCode += '.blogig_font_typography { ' + selector + '-family: ' + value.font_family.value + '; } '
			}
			if( value.font_weight ) {
				cssCode += '.blogig_font_typography { ' + selector + '-weight: ' + value.font_weight.value + '; } '
			}
			if( value.text_transform ) {
				cssCode += '.blogig_font_typography { ' + selector + '-texttransform: ' + value.text_transform + '; } '
			}
			if( value.text_decoration ) {
				cssCode += '.blogig_font_typography { ' + selector + '-textdecoration: ' + value.text_decoration + '; } '
			}
			if( value.font_size ) {
				if( value.font_size.desktop ) {
					cssCode += '.blogig_font_typography { ' + selector + '-size: ' + value.font_size.desktop + 'px; } '
				}
				if( value.font_size.tablet ) {
					cssCode += '.blogig_font_typography { ' + selector + '-size-tab: ' + value.font_size.tablet + 'px; } '
				}
				if( value.font_size.smartphone ) {
					cssCode += '.blogig_font_typography { ' + selector + '-size-mobile: ' + value.font_size.smartphone + 'px; } '
				}
			}
			if( value.line_height ) {
				if( value.line_height.desktop ) {
					cssCode += '.blogig_font_typography { ' + selector + '-lineheight: ' + value.line_height.desktop + 'px; } '
				}
				if( value.line_height.tablet ) {
					cssCode += '.blogig_font_typography { ' + selector + '-lineheight-tab: ' + value.line_height.tablet + 'px; } '
				}
				if( value.line_height.smartphone ) {
					cssCode += '.blogig_font_typography { ' + selector + '-lineheight-mobile: ' + value.line_height.smartphone + 'px; } '
				}
			}
			if( value.letter_spacing ) {
				if( value.letter_spacing.desktop ) {
					cssCode += '.blogig_font_typography { ' + selector + '-letterspacing: ' + value.letter_spacing.desktop + 'px; } '
				}
				if( value.letter_spacing.tablet ) {
					cssCode += '.blogig_font_typography { ' + selector + '-letterspacing-tab: ' + value.letter_spacing.tablet + 'px; } '
				}
				if( value.letter_spacing.smartphone ) {
					cssCode += '.blogig_font_typography { ' + selector + '-letterspacing-mobile: ' + value.letter_spacing.smartphone + 'px; } '
				}
			}
			return cssCode
		},
		blogigGenerateTypoCssWithSelector: function(selector,value) {
			var cssCode = ''
			if( value.font_family ) {
				cssCode += selector + ' { font-family: ' + value.font_family.value + '; } '
			}
			if( value.font_weight ) {
				cssCode += selector + ' { font-weight: ' + value.font_weight.value + '; } '
			}
			if( value.text_transform ) {
				cssCode += selector + ' { text-transform: ' + value.text_transform + '; } '
			}
			if( value.text_decoration ) {
				cssCode += selector + ' { text-decoration: ' + value.text_decoration + '; } '
			}
			if( value.font_size ) {
				if( value.font_size.desktop ) {
					cssCode += selector + ' { font-size: ' + value.font_size.desktop + 'px; } '
				}
				if( value.font_size.tablet ) {
					cssCode += '@media(max-width: 940px) { ' + selector + ' { font-size: ' + value.font_size.tablet + 'px; } } '
				}
				if( value.font_size.smartphone ) {
					cssCode += '@media(max-width: 610px) { ' + selector + ' { font-size: ' + value.font_size.smartphone + 'px; } } '
				}
			}
			if( value.line_height ) {
				if( value.line_height.desktop ) {
					cssCode += selector + ' { line-height: ' + value.line_height.desktop + 'px; } '
				}
				if( value.line_height.tablet ) {
					cssCode += '@media(max-width: 940px) { ' + selector + ' { line-height: ' + value.line_height.tablet + 'px; } } '
				}
				if( value.line_height.smartphone ) {
					cssCode += '@media(max-width: 610px) { ' + selector + ' { line-height: ' + value.line_height.smartphone + 'px; } } '
				}
			}
			if( value.letter_spacing ) {
				if( value.letter_spacing.desktop ) {
					cssCode += selector + ' { letter-spacing: ' + value.letter_spacing.desktop + 'px; } '
				}
				if( value.letter_spacing.tablet ) {
					cssCode += '@media(max-width: 940px) { ' + selector + ' { letter-spacing: ' + value.letter_spacing.tablet + 'px; } } '
				}
				if( value.letter_spacing.smartphone ) {
					cssCode += '@media(max-width: 610px) { ' + selector + ' { letter-spacing: ' + value.letter_spacing.smartphone + 'px; } } '
				}
			}
			return cssCode
		},
		blogigGenerateStyleTag: function( code, id ) {
			if( code ) {
				if( $( "head #" + id ).length > 0 ) {
					$( "head #" + id ).html( code )
				} else {
					$( "head" ).append( '<style id="' + id + '">' + code + '</style>' )
				}
			} else {
				$( "head #" + id ).remove()
			}
		},
		blogigGenerateLinkTag: function( action, id ) {
			$.ajax({
				method: "GET",
				url: blogigPreviewObject.ajaxUrl,
				data: ({
					action: action,
					_wpnonce: blogigPreviewObject._wpnonce
				}),
				success: function(response) {
					if( response ) {
						if( $( "head #" + id ).length > 0 ) {
							$( "head #" + id ).attr( "href", response )
						} else {
							$( "head" ).append( '<link rel="stylesheet" id="' + id + '" href="' + response + '"></link>' )
						}
					}
				}
			})
		}
	}

	// background color
	wp.customize( 'site_background_color', function( value ) {
		value.bind( function(to) {
			var value = JSON.parse( to )
			if( value ) {
				var cssCode = ''
				if( value.type == 'solid' ) {
					cssCode += 'body.blogig_font_typography:before, body.blogig_font_typography .main-header.header-sticky--enabled { background: ' + blogig_get_color_format(value[value.type]) + '}'
				} else {
					cssCode += 'body.blogig_font_typography:before, body.blogig_font_typography .main-header.header-sticky--enabled { background: ' + blogig_get_color_format(value[value.type]) + '}'
				}
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-body-background' )
			} else {
				themeCalls.blogigGenerateStyleTag( '', 'blogig-body-background' )
			}
		});
	});

	// background animation
	wp.customize( 'site_background_animation', function( value ) {
		value.bind( function( to ) {
			$('body').removeClass( 'background-animation--none background-animation--one background-animation--two background-animation--three' ).addClass( 'background-animation--' + to )
		});
	});

	// animation object color
	wp.customize( 'animation_object_color', function( value ) {
		value.bind( function(to) {
			helperFunctions.generateStyle(to, 'blogig-animation-object-color', '--blogig-animation-object-color')
		})
	})

	// background color
	wp.customize( 'background_image', function( value ) {
		value.bind( function(to) {
			var cssCode = ''
			if( to ) {
				cssCode += 'body:before{ display: none; }';
			} else {
				cssCode += 'body:before{ display: block; }';
			}
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-body-image-background' )
		});
	});

	// post title hover class
	wp.customize( 'post_title_hover_effects', function( value ) {
		value.bind( function(to) {
			$( "body" ).removeClass( "title-hover--none title-hover--one title-hover--two" )
			$( "body" ).addClass( "title-hover--" + to )
		});
	});

	// image hover class
	wp.customize( 'site_image_hover_effects', function( value ) {
		value.bind( function(to) {
			$( "body" ).removeClass( "image-hover--none image-hover--one image-hover--two" )
			$( "body" ).addClass( "image-hover--" + to )
		});
	});

	// theme color bind changes
	wp.customize( 'theme_color', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-color-style', '--blogig-global-preset-theme-color')
		});
	});

	// gradient theme color bind changes
	wp.customize( 'gradient_theme_color', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-1-style', '--blogig-global-preset-gradient-theme-color')
		});
	});

	// preset 1 bind changes
	wp.customize( 'preset_color_1', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-color-1-style', '--blogig-global-preset-color-1')
		});
	});

	// preset 2 bind changes
	wp.customize( 'preset_color_2', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-color-2-style', '--blogig-global-preset-color-2')
		});
	});

	// preset 3 bind changes
	wp.customize( 'preset_color_3', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-color-3-style', '--blogig-global-preset-color-3')
		});
	});

	// preset 4 bind changes
	wp.customize( 'preset_color_4', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-color-4-style', '--blogig-global-preset-color-4')
		});
	});

	// preset 5 bind changes
	wp.customize( 'preset_color_5', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-color-5-style', '--blogig-global-preset-color-5')
		});
	});

	// preset 6 bind changes
	wp.customize( 'preset_color_6', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-color-6-style', '--blogig-global-preset-color-6')
		});
	});

	// preset 7 bind changes
	wp.customize( 'preset_color_7', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-color-7-style', '--blogig-global-preset-color-7')
		});
	});

	// preset 8 bind changes
	wp.customize( 'preset_color_8', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-color-8-style', '--blogig-global-preset-color-8')
		});
	});

	// preset 9 bind changes
	wp.customize( 'preset_color_9', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-color-9-style', '--blogig-global-preset-color-9')
		});
	});

	// preset 10 bind changes
	wp.customize( 'preset_color_10', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-color-10-style', '--blogig-global-preset-color-10')
		});
	});

	// preset 11 bind changes
	wp.customize( 'preset_color_11', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-color-11-style', '--blogig-global-preset-color-11')
		});
	});

	// preset 12 bind changes
	wp.customize( 'preset_color_12', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-color-12-style', '--blogig-global-preset-color-12')
		});
	});

	// preset gradient 1 bind changes
	wp.customize( 'preset_gradient_1', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-1-style', '--blogig-global-preset-gradient-color-1')
		});
	});

	// preset gradient 2 bind changes
	wp.customize( 'preset_gradient_2', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-2-style', '--blogig-global-preset-gradient-color-2')
		});
	});

	// preset gradient 3 bind changes
	wp.customize( 'preset_gradient_3', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-3-style', '--blogig-global-preset-gradient-color-3')
		});
	});

	// preset gradient 4 bind changes
	wp.customize( 'preset_gradient_4', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-4-style', '--blogig-global-preset-gradient-color-4')
		});
	});

	// preset gradient 5 bind changes
	wp.customize( 'preset_gradient_5', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-5-style', '--blogig-global-preset-gradient-color-5')
		});
	});

	// preset gradient 6 bind changes
	wp.customize( 'preset_gradient_6', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-6-style', '--blogig-global-preset-gradient-color-6')
		});
	});

	// preset gradient 7 bind changes
	wp.customize( 'preset_gradient_7', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-7-style', '--blogig-global-preset-gradient-color-7')
		});
	});

	// preset gradient 8 bind changes
	wp.customize( 'preset_gradient_8', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-8-style', '--blogig-global-preset-gradient-color-8')
		});
	});

	// preset gradient 9 bind changes
	wp.customize( 'preset_gradient_9', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-9-style', '--blogig-global-preset-gradient-color-9')
		});
	});

	// preset gradient 10 bind changes
	wp.customize( 'preset_gradient_10', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-10-style', '--blogig-global-preset-gradient-color-10')
		});
	});

	// preset gradient 11 bind changes
	wp.customize( 'preset_gradient_11', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-11-style', '--blogig-global-preset-gradient-color-11')
		});
	});

	// preset gradient 12 bind changes
	wp.customize( 'preset_gradient_12', function( value ) {
		value.bind( function( to ) {
			helperFunctions.generateStyle(to, 'theme-preset-gradient-color-12-style', '--blogig-global-preset-gradient-color-12')
		});
	});

	// scroll to top align
	wp.customize( 'stt_alignment', function( value ) {
		value.bind( function(to) {
			$( "#blogig-scroll-to-top" ).removeClass( "align--left align--center align--right" )
			$( "#blogig-scroll-to-top" ).addClass( "align--" + to )
		});
	});

	// mobile option sub menu option
	wp.customize( 'sub_menu_mobile_option', function( value ) {
		value.bind( function(to) {
			if( to ) {
				$( "#site-navigation" ).removeClass( "sub-menu-hide-on-mobile" )
			} else {
				$( "#site-navigation" ).addClass( "sub-menu-hide-on-mobile" )
			}
		});
	});

	// mobile option scroll to top option
	wp.customize( 'scroll_to_top_mobile_option', function( value ) {
		value.bind( function(to) {
			if( to ) {
				$( "#blogig-scroll-to-top" ).removeClass( "hide-on-mobile" )
			} else {
				$( "#blogig-scroll-to-top" ).addClass( "hide-on-mobile" )
			}
		});
	});

	// mobile option show custom button text option
	wp.customize( 'show_custom_button_text_mobile_option', function( value ) {
		value.bind( function(to) {
			if( to ) {
				$( ".subscribe-section .header-custom-button .custom-button-label" ).removeClass( "hide-on-mobile" )
			} else {
				$( ".subscribe-section .header-custom-button .custom-button-label" ).addClass( "hide-on-mobile" )
			}
		});
	});

	// mobile option archive readmore button option
	wp.customize( 'show_readmore_button_mobile_option', function( value ) {
		value.bind( function(to) {
			if( to ) {
				$( "body.blog .blogig-article-inner .content-wrap .post-button, body.archive .blogig-article-inner .content-wrap .post-button, body.home .blogig-article-inner .content-wrap .post-button, body.search .blogig-article-inner .content-wrap .post-button" ).removeClass( "hide-on-mobile" )
			} else {
				$( "body.blog .blogig-article-inner .content-wrap .post-button, body.archive .blogig-article-inner .content-wrap .post-button, body.home .blogig-article-inner .content-wrap .post-button, body.search .blogig-article-inner .content-wrap .post-button" ).addClass( "hide-on-mobile" )
			}
		});
	});
	
	// single post related articles title option
	wp.customize( 'single_post_related_posts_title', function( value ) {
		value.bind( function(to) {
			if( $( ".single-related-posts-section-wrap" ).find('.blogig-block-title span').length > 0 ) {
				$( ".single-related-posts-section-wrap" ).find('.blogig-block-title span').text( to )
			} else {
				$( ".single-related-posts-section-wrap .single-related-posts-section" ).prepend('<h2 class="blogig-block-title"><span>'+ to +'</span></h2>')
			}
		});
	});

	// single post image ratio
	wp.customize( 'single_responsive_image_ratio', function( value ) {
		value.bind( function(to) {
			var cssCode = ''
			if( to.desktop ) {
				cssCode += 'body { --blogig-single-post-image-ratio: ' + to.desktop + ' }';
			}
			if( to.tablet ) {
				cssCode += 'body { --blogig-single-post-image-ratio-tab: ' + to.tablet + ' }';
			}
			if( to.smartphone ) {
				cssCode += 'body { --blogig-single-post-image-ratio-mobile: ' + to.smartphone + ' }';
			}
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-single-post-image-ratio' )
		});
	});

	// global sidebar sticky option
	wp.customize( 'sidebar_sticky_option', function( value ) {
		value.bind( function(to) {
			if( to ) {
				$("body").addClass( "blogig-sidebar--enabled" ).removeClass( "blogig-sidebar--disabled" )
			} else {
				$("body").removeClass( "blogig-sidebar--enabled" ).addClass( "blogig-sidebar--disabled" )
			}
		});
	});

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	});
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	});
	// blog description
	wp.customize( 'blogdescription_option', function( value ) {
		value.bind(function(to) {
			if( to ) {
				$( '.site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
			} else {
				$( '.site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			}
		})
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a' ).css( {
					color: to,
				} );
			}
		} );
	});

	// site title hover color
	wp.customize( 'site_title_hover_textcolor', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a:hover' ).css( {
				color: to,
			});
		} );
	});

	// site description color
	wp.customize( 'site_description_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).css( {
				color: to,
			});
		} );
	});

	// site title typo
	wp.customize( 'site_title_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-site-title'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-site-title-typo' )
		})
	})
	// site tagline typo
	wp.customize( 'site_description_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-site-description'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-site-tagline-typo' )
		})
	})

	// site logo width
	wp.customize( 'blogig_site_logo_width', function( value ) {
		value.bind( function(to) {
			if( to ) {
				var cssCode = ''
				if( to.desktop ) {
					cssCode += 'body .site-branding img{ width: ' + to.desktop +  'px} '
				}
				if( to.tablet ) {
					cssCode += '@media(max-width: 994px) { body .site-branding img{ width: ' + to.tablet +  'px} } '
				}
				if( to.smartphone ) {
					cssCode += '@media(max-width: 610px) { body .site-branding img{ width: ' + to.smartphone +  'px} } '
				}
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-site-logo-width' )
			} else {
				themeCalls.blogigGenerateStyleTag( '', 'blogig-site-logo-width' )
			}
		});
	});

	// scroll to top color
	wp.customize( 'stt_color_group', function( value ) {
		value.bind( function(to) {
			if( to ) {
				var cssCode = ''
				var selector = '--blogig-scroll-text-color'
				if( to.color ) {
					cssCode += 'body { ' + selector + ' : ' + blogig_get_color_format( to.color ) +  ' } '
				}
				if( to.hover ) {
					cssCode += 'body { ' + selector + '-hover : ' + blogig_get_color_format( to.hover ) +  ' } '
				}
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-scroll-to-top-style' )
			} else {
				themeCalls.blogigGenerateStyleTag( '', 'blogig-scroll-to-top-style' )
			}
		});
	});

	// scroll to top background color
	wp.customize( 'stt_background_color_group', function( value ) {
		value.bind( function(to) {
			var parsedValue = JSON.parse(to)
			if( parsedValue ) {
				var cssCode = ''
				var selector = '--blogig-scroll-top-bk-color'
				if( parsedValue.initial[parsedValue.initial.type] ) {
					cssCode += 'body { ' + selector + ' : ' + blogig_get_color_format( parsedValue.initial[parsedValue.initial.type] ) +  ' } '
				}
				if( parsedValue.hover[parsedValue.hover.type] ) {
					cssCode += 'body { ' + selector + '-hover : ' + blogig_get_color_format( parsedValue.hover[parsedValue.hover.type] ) +  ' } '
				}
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-scroll-to-top-background-style' )
			} else {
				themeCalls.blogigGenerateStyleTag( '', 'blogig-scroll-to-top-background-style' )
			}
		});
	});

	// var parsedCats = JSON.parse( blogigPreviewObject.totalCats )
	var parsedCats = blogigPreviewObject.totalCats
	if( parsedCats ) {
		var parsedCats = Object.keys(parsedCats).map(function (key) { return parsedCats[key]; });
		parsedCats.forEach(function(item) {
			wp.customize( 'category_' + item.term_id + '_color', function( value ) {
				value.bind( function(to) {
					var cssCode = ''
					if( to.color ) {
						cssCode += "body .post-categories .cat-item.cat-" + item.term_id + " a, body.archive.category.category-" + item.term_id + " #blogig-main-wrap .page-header .blogig-container i { color : " + blogig_get_color_format( to.color ) + "  } "
					}
					if( to.hover ) {
						cssCode += "body .post-categories .cat-item.cat-" + item.term_id + " a:hover, body.archive.category.category-" + item.term_id + " #blogig-main-wrap .page-header .blogig-container i:hover { color : " + blogig_get_color_format( to.hover ) + " } "
					}
					themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-category-' + item.term_id + '-style' )
				})
			})
			wp.customize( 'category_background_' + item.term_id + '_color', function( value ) {
				value.bind( function(to) {
					var parsedValue = JSON.parse( to )
					var cssCode = ''
					if( parsedValue ) {
						if( parsedValue.initial[parsedValue.initial.type] ) {
							cssCode += "body .post-categories .cat-item.cat-" + item.term_id + " a, body.archive.category.category-" + item.term_id + " #blogig-main-wrap .page-header .blogig-container i { background : " + blogig_get_color_format( parsedValue.initial[parsedValue.initial.type] ) + "; box-shadow: 0 3px 10px -2px " + blogig_get_color_format ( parsedValue.initial[parsedValue.initial.type] ) + " } "
						}
						if( parsedValue.hover[parsedValue.hover.type] ) {
							cssCode += "body .post-categories .cat-item.cat-" + item.term_id + " a:hover, body.archive.category.category-" + item.term_id + " #blogig-main-wrap .page-header .blogig-container i:hover { background : " + blogig_get_color_format( parsedValue.hover[parsedValue.hover.type] ) + "; box-shadow: 0 3px 10px -2px " + blogig_get_color_format ( parsedValue.hover[parsedValue.hover.type] ) + " } "
						}
						themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-category-background-' + item.term_id + '-style' )
					} else {
						themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-category-background-' + item.term_id + '-style' )
					}
				})
			})
		})
	}
	
	// var parsedTags = JSON.parse(blogigPreviewObject.totalTags)
	var parsedTags = blogigPreviewObject.totalTags
	if( parsedTags ) {
		var parsedTags = Object.keys(parsedTags).map(function (key) { return parsedTags[key]; });
		parsedTags.forEach(function(item) {
			wp.customize( 'tag_' + item.term_id + '_color', function( value ) {
				value.bind( function(to) {
					var cssCode = ''
					if( to.color ) {
						cssCode += "body .tags-wrap .tags-item.tag-" + item.term_id + " span, body.archive.tag.tag-" + item.term_id + " #blogig-main-wrap .page-header .blogig-container i { color : " + blogig_get_color_format( to.color ) + " } "
					}
					if( to.hover ) {
						cssCode += "body .tags-wrap .tags-item.tag-" + item.term_id + ":hover span, body.archive.tag.tag-" + item.term_id + " #blogig-main-wrap .page-header .blogig-container i:hover { color : " + blogig_get_color_format( to.hover ) + " } "
					}
					themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-tag-' + item.term_id + '-style' )
				})
			})
			wp.customize( 'tag_background_' + item.term_id + '_color', function( value ) {
				value.bind( function(to) {
					var parsedValue = JSON.parse( to )
					var cssCode = ''
					if( parsedValue ) {
						if( parsedValue.initial[parsedValue.initial.type] ) {
							cssCode += "body .tags-wrap .tags-item.tag-" + item.term_id + ", body.archive.tag.tag-" + item.term_id + " #blogig-main-wrap .page-header .blogig-container i { background : " + blogig_get_color_format( parsedValue.initial[parsedValue.initial.type] ) + "; box-shadow: 0px 3px 10px -2px "+ blogig_get_color_format( parsedValue.initial[parsedValue.initial.type] ) +" } "
						}
						if( parsedValue.hover[parsedValue.hover.type] ) {
							cssCode += "body .tags-wrap .tags-item.tag-" + item.term_id + ":hover, body.archive.tag.tag-" + item.term_id + " #blogig-main-wrap .page-header .blogig-container i:hover { background : " + blogig_get_color_format( parsedValue.hover[parsedValue.hover.type] ) + "; box-shadow: 0px 3px 10px -2px "+ blogig_get_color_format( parsedValue.hover[parsedValue.hover.type] ) + " } "
						}
						themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-tag-background-' + item.term_id + '-style' )
					} else {
						themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-tag-background-' + item.term_id + '-style' )
					}
				})
			})
		})
	}

	// header menu alignment
	wp.customize( 'menu_options_menu_alignment', function( value ) {
		value.bind( function(to) {
			$(".main-header").removeClass( "menu-aligment--right menu-aligment--center menu-aligment--left" )
			$(".main-header").addClass( "menu-aligment--" + to )
		})
	})

	// menu hover effects
	wp.customize( 'blogig_header_menu_hover_effect', function( value ) {
		value.bind( function(to) {
			$("#site-navigation").removeClass( "hover-effect--none hover-effect--one hover-effect--two hover-effect--three hover-effect--four" )
			$("#site-navigation").addClass( "hover-effect--" + to )
		})
	})

	// header menu color
	wp.customize( 'header_menu_color', function( value ) {
		value.bind( function(to) {
			var cssCode = ''
			var selector = '--blogig-menu-color'
			if( to.color ) {
				cssCode += "body { " + selector + " : " + blogig_get_color_format( to.color ) + " } "
			}
			if( to.hover ) {
				cssCode += "body { " + selector + "-hover : " + blogig_get_color_format( to.hover ) + " } "
			}
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-menu-style' )
		})
	})

	// main menu typo
	wp.customize( 'main_menu_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-menu'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-main-menu-typo' )
		})
	})

	// sub menu typo
	wp.customize( 'main_menu_sub_menu_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-submenu'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-main-sub-menu-typo' )
		})
	})

	// custom button typography
	wp.customize( 'blogig_custom_button_text_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-custom-button'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-custom-button-typo' )
		})
	})

	// custom button text color
	wp.customize( 'blogig_custom_button_text_color', function( value ) {
		value.bind( function(to) {
			var cssCode = ''
			var selector = '--blogig-custom-button-color'
			if( to.color ) {
				cssCode += "body { " + selector + " : " + blogig_get_color_format( to.color ) + " } "
			}
			if( to.hover ) {
				cssCode += "body { " + selector + "-hover : " + blogig_get_color_format( to.hover ) + " } "
			}
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-custom-button-text-color-style' )
		})
	})

	// custom button icon color
	wp.customize( 'blogig_custom_button_icon_color', function( value ) {
		value.bind( function(to) {
			var cssCode = ''
			var selector = '--blogig-custom-button-icon-color'
			if( to.color ) {
				cssCode += "body { " + selector + " : " + blogig_get_color_format( to.color ) + " } "
			}
			if( to.hover ) {
				cssCode += "body { " + selector + "-hover : " + blogig_get_color_format( to.hover ) + " } "
			}
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-custom-button-icon-color-style' )
		})
	})

	// banner elements alignment
	wp.customize( 'main_banner_post_elements_alignment', function( value ) {
		value.bind( function( to ) {
			$(".blogig-main-banner-section").removeClass("banner-align--right banner-align--center banner-align--left")
			$(".blogig-main-banner-section").addClass("banner-align--" + to)
		})
	})

	// banner image ratio
	wp.customize( 'main_banner_responsive_image_ratio', function( value ) {
		value.bind( function( to ) {
			var cssCode = ''
			if( to.desktop && to.desktop > 0 ) {
				cssCode += "body .blogig-main-banner-section article.post-item .post-thumb { padding-bottom : calc(" + to.desktop +  " * 100%) } "
			}
			if( to.tablet && to.tablet > 0) {
				cssCode += "@media(max-width: 940px) { body .blogig-main-banner-section article.post-item .post-thumb { padding-bottom : calc(" + to.tablet +  " * 100%) } } "
			}
			if( to.smartphone && to.smartphone > 0  ) {
				cssCode += "@media(max-width: 610px) { body .blogig-main-banner-section article.post-item .post-thumb { padding-bottom : calc(" + to.smartphone +  " * 100%) } } "
			}
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-banner-image-ratio' )
		})
	})
	
	// banner title typography
	wp.customize( 'main_banner_design_post_title_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '.blogig_font_typography .blogig-main-banner-section .main-banner-wrap .post-elements .post-title'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-banner-title-typo' )
		})
	})

	// banner excerpt typography
	wp.customize( 'main_banner_design_post_excerpt_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '.blogig_font_typography .blogig-main-banner-section .main-banner-wrap .post-elements .post-excerpt'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-banner-excerpt-typo' )
		})
	})

	// banner categories typography
	wp.customize( 'main_banner_design_post_categories_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '.blogig_font_typography .blogig-main-banner-section .post-categories .cat-item a'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-banner-categories-typo' )
		})
	})
	
	// banner date typography
	wp.customize( 'main_banner_design_post_date_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '.blogig_font_typography .blogig-main-banner-section .main-banner-wrap .post-elements .post-date'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-banner-date-typo' )
		})
	})

	// banner date typography
	wp.customize( 'main_banner_design_post_author_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '.blogig_font_typography .blogig-main-banner-section .main-banner-wrap .post-elements .author'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-banner-author-typo' )
		})
	})

	// carousel image ratio
	wp.customize( 'carousel_responsive_image_ratio', function( value ) {
		value.bind( function( to ) {
			var cssCode = ''
			if( to.desktop && to.desktop > 0 ) {
				cssCode += "body .blogig-carousel-section article.post-item .post-thumb { padding-bottom : calc(" + to.desktop +  " * 100%) } "
			}
			if( to.tablet && to.tablet > 0 ) {
				cssCode += "@media(max-width: 940px) { body .blogig-carousel-section article.post-item .post-thumb { padding-bottom : calc(" + to.tablet +  " * 100%) } } "
			}
			if( to.smartphone && to.smartphone > 0 ) {
				cssCode += "@media(max-width: 610px) { body .blogig-carousel-section article.post-item .post-thumb { padding-bottom : calc(" + to.smartphone +  " * 100%) } } "
			}
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-carousel-image-ratio' )
		})
	})
	
	// carousel title typography
	wp.customize( 'carousel_design_post_title_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '.blogig_font_typography .blogig-carousel-section .carousel-wrap .post-elements .post-title'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-carousel-title-typo' )
		})
	})

	// carousel excerpt typography
	wp.customize( 'carousel_design_post_excerpt_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '.blogig_font_typography .blogig-carousel-section .carousel-wrap .post-elements .post-excerpt'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-carousel-excerpt-typo' )
		})
	})

	// carousel categories typography
	wp.customize( 'carousel_design_post_categories_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '.blogig_font_typography .blogig-carousel-section .carousel-wrap .post-categories .cat-item a'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-carousel-categories-typo' )
		})
	})

	// carousel date typography
	wp.customize( 'carousel_design_post_date_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '.blogig_font_typography .blogig-carousel-section .carousel-wrap .post-elements .post-date'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-carousel-date-typo' )
		})
	})

	// carousel author typography
	wp.customize( 'carousel_design_post_author_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '.blogig_font_typography .blogig-carousel-section .carousel-wrap .post-elements .author'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-carousel-date-typo' )
		})
	})

	// carousel image ratio
	wp.customize( 'you_may_have_missed_responsive_image_ratio', function( value ) {
		value.bind( function( to ) {
			var cssCode = ''
			if( to.desktop && to.desktop > 0 ) {
				cssCode += "body .blogig-carousel-section article.post-item .post-thumb { padding-bottom : calc(" + to.desktop +  " * 100%) } "
			}
			if( to.tablet && to.tablet > 0 ) {
				cssCode += "@media(max-width: 940px) { body .blogig-carousel-section article.post-item .post-thumb { padding-bottom : calc(" + to.tablet +  " * 100%) } } "
			}
			if( to.smartphone && to.smartphone > 0 ) {
				cssCode += "@media(max-width: 610px) { body .blogig-carousel-section article.post-item .post-thumb { padding-bottom : calc(" + to.smartphone +  " * 100%) } } "
			}
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-carousel-image-ratio' )
		})
	})

	// you may have missed section title color
	wp.customize( 'you_may_have_missed_title_color', function( value ) {
		value.bind( function(to) {
			var cssCode = ''
			var selector = '--blogig-youmaymissed-block-font-color'
			if( to ) {
				cssCode += "body { " + selector + " : " + blogig_get_color_format( to ) + " } "
			}
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-you-may-have-missed-section-title-style' )
		})
	})

	// you may have missed section title typography
	wp.customize( 'you_may_have_missed_design_section_title_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-youmaymissed-block-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-you-may-have-missed-section-title-typo' )
		})
	})

	// you may have missed post title typography
	wp.customize( 'you_may_have_missed_design_post_title_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-youmaymissed-post-title-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-you-may-have-missed-post-title-typo' )
		})
	})

	// you may have missed post categories typography
	wp.customize( 'you_may_have_missed_design_post_categories_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-youmaymissed-post-category-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-you-may-have-missed-post-categories-typo' )
		})
	})

	// you may have missed post author typography
	wp.customize( 'you_may_have_missed_design_post_author_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-youmaymissed-post-author-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-you-may-have-missed-post-author-typo' )
		})
	})

	// you may have missed post date typography
	wp.customize( 'you_may_have_missed_design_post_date_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-youmaymissed-post-date-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-you-may-have-missed-post-date-typo' )
		})
	})

	// archive posts column
	wp.customize( 'archive_post_column', function( value ) {
		value.bind( function( to ) {
			if( to.desktop ) {
				$("body").removeClass( "archive-desktop-column--one archive-desktop-column--two archive-desktop-column--three" )
				$("body").addClass( "archive-desktop-column--" + blogig_get_numeric_string( to.desktop ) )
			}
			if( to.tablet ) {
				$("body").removeClass( "archive-tablet-column--one archive-tablet-column--two archive-tablet-column--three" )
				$("body").addClass( "archive-tablet-column--" + blogig_get_numeric_string( to.tablet ) )
			}
			if( to.smartphone ) {
				$("body").removeClass( "archive-mobile-column--one archive-mobile-column--two archive-mobile-column--three" )
				$("body").addClass( "archive-mobile-column--" + blogig_get_numeric_string( to.smartphone ) )
			}
		})
	})

	// archive posts elements alignment
	wp.customize( 'archive_post_elements_alignment', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				$("body.archive .blogig-inner-content-wrap, body.blog .blogig-inner-content-wrap, body.home .blogig-inner-content-wrap, body.search .blogig-inner-content-wrap").removeClass( "archive-align--left archive-align--center archive-align--right" )
				$("body.archive .blogig-inner-content-wrap, body.blog .blogig-inner-content-wrap, body.home .blogig-inner-content-wrap, body.search .blogig-inner-content-wrap").addClass( "archive-align--" + to )
			}
		})
	})

	// archive posts image ratio
	wp.customize( 'archive_responsive_image_ratio', function( value ) {
		value.bind( function( to ) {
			var cssCode = ''
			var selector = '--blogig-post-image-ratio'
			var listSelector = '--blogig-list-post-image-ratio'
			if( to.desktop && to.desktop > 0 ) {
				cssCode += 'body { ' + selector + ': ' + to.desktop + ' }'
				cssCode += 'body { ' + listSelector + ': ' + to.desktop + ' }'
			}
			if( to.tablet && to.tablet > 0) {
				cssCode += 'body { ' + selector + '-tablet: ' + to.tablet + ' }'
				cssCode += 'body { ' + listSelector + '-tablet: ' + to.tablet + ' }'
			}
			if( to.smartphone && to.smartphone > 0  ) {
				cssCode += 'body { ' + selector + '-mobile: ' + to.smartphone + ' }'
				cssCode += 'body { ' + listSelector + '-mobile: ' + to.smartphone + ' }'
			}

			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-posts-image-ratio' )
		})
	})

	// archive button text
	wp.customize( 'archive_button_text', function( value ) {
		value.bind( function( to ) {
			$(".button-text").text(to)
		})
	})

	// archive title typo
	wp.customize( 'archive_title_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-post-title-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-title-typo' )
		})
	})

	// archive excerpt typo
	wp.customize( 'archive_excerpt_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-post-content-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-excerpt-typo' )
		})
	})

	// archive category typo
	wp.customize( 'archive_category_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-category-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-category-typo' )
		})
	})

	// archive date typo
	wp.customize( 'archive_date_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-date-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-date-typo' )
		})
	})

	// archive author typo
	wp.customize( 'archive_author_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-author-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-author-typo' )
		})
	})

	// archive read time typo
	wp.customize( 'archive_read_time_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-readtime-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-read-time-typo' )
		})
	})

	// archive comment typo
	wp.customize( 'archive_comment_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-comment-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-comment-typo' )
		})
	})

	// archive button typo
	wp.customize( 'archive_button_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-readmore-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-readmore-typo' )
		})
	})

	// archive category box typo
	wp.customize( 'archive_category_info_box_title_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.blogig_font_typography.archive.category .page-header .page-title'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-category-page-title-typo' )
		})
	})

	// archive category description typo
	wp.customize( 'archive_category_info_box_description_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.blogig_font_typography.archive.category .page-header .archive-description'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-category-page-description-typo' )
		})
	})

	// archive tag page title typo
	wp.customize( 'archive_tag_info_box_title_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.blogig_font_typography.archive.tag .page-header .page-title'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-tag-page-title-typo' )
		})
	})

	// archive tag page description typo
	wp.customize( 'archive_tag_info_box_description_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.blogig_font_typography.archive.tag .page-header .archive-description'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-tag-page-description-typo' )
		})
	})

	// archive author page title typo
	wp.customize( 'archive_author_info_box_title_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.blogig_font_typography.archive.author .page-header .page-title'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-author-page-title-typo' )
		})
	})

	// archive author page description typo
	wp.customize( 'archive_author_info_box_description_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.blogig_font_typography.archive.author .page-header .archive-description'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-archive-author-page-description-typo' )
		})
	})

	// single title typo
	wp.customize( 'single_title_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.single-post.blogig_font_typography .site-main article .entry-title'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-single-title-typo' )
		})
	})

	// single content typo
	wp.customize( 'single_content_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.single-post.blogig_font_typography .site-main article .entry-content'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-single-content-typo' )
		})
	})

	// single category typo
	wp.customize( 'single_category_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.single-post.blogig_font_typography #primary article .post-categories .cat-item a'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-single-category-typo' )
		})
	})

	// single date typo
	wp.customize( 'single_date_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.single-post.blogig_font_typography #primary .blogig-inner-content-wrap .post-meta .post-date'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-single-date-typo' )
		})
	})

	// single author typo
	wp.customize( 'single_author_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.single-post.blogig_font_typography .site-main article .post-meta-wrap .byline'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-single-author-typo' )
		})
	})

	// single read time typo
	wp.customize( 'single_read_time_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.single-post.blogig_font_typography #primary .blogig-inner-content-wrap .post-meta .post-read-time'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-single-read-time-typo' )
		})
	})

	// page title typo
	wp.customize( 'page_title_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.page #blogig-main-wrap #primary article .entry-title'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-page-title-typo' )
		})
	})

	// page content typo
	wp.customize( 'page_content_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body.page-template-default article .entry-content'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-page-content-typo' )
		})
	})

	// heading one typo
	wp.customize( 'heading_one_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body article h1'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-heading-one-typo' )
		})
	})

	// heading two typo
	wp.customize( 'heading_two_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body article h2'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-heading-two-typo' )
		})
	})

	// heading three typo
	wp.customize( 'heading_three_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body article h3'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-heading-three-typo' )
		})
	})

	// heading four typo
	wp.customize( 'heading_four_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body article h4'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-heading-four-typo' )
		})
	})

	// heading five typo
	wp.customize( 'heading_five_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body article h5'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-heading-five-typo' )
		})
	})

	// heading six typo
	wp.customize( 'heading_six_typo', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = 'body article h6'
			cssCode = themeCalls.blogigGenerateTypoCssWithSelector(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-heading-six-typo' )
		})
	})

	// sidebar block title typo
	wp.customize( 'sidebar_block_title_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-widget-block-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-sidebar-block-title-typo' )
		})
	})

	// sidebar post title typo
	wp.customize( 'sidebar_post_title_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-widget-title-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-sidebar-post-title-typo' )
		})
	})

	// sidebar post category typo
	wp.customize( 'sidebar_category_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-widget-category-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-sidebar-post-category-typo' )
		})
	})

	// sidebar post date typo
	wp.customize( 'sidebar_date_typography', function( value ) {
		value.bind( function( to ) {
			ajaxFunctions.typoFontsEnqueue()
			var cssCode = ''
			var selector = '--blogig-widget-date-font'
			cssCode = themeCalls.blogigGenerateTypoCss(selector,to)
			themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-sidebar-post-date-typo' )
		})
	})

	// site title custom css
	wp.customize( 'site_title_custom_css', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				var cssCode = ''
				cssCode += to.replace( "{wrapper}", ".site-branding-section" )
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-site-title-custom-css' )
			}
		})
	})

	// social icon custom css
	wp.customize( 'social_icon_custom_css', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				var cssCode = ''
				cssCode += to.replace( "{wrapper}", ".blogig-social-icon" )
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-social-icon-custom-css' )
			}
		})
	})

	// breadcrumb custom css
	wp.customize( 'breadcrumb_custom_css', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				var cssCode = ''
				cssCode += to.replace( "{wrapper}", ".blogig-breadcrumb-wrap" )
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-breadcrumb-custom-css' )
			}
		})
	})

	// scroll to top custom css
	wp.customize( 'scroll_to_top_custom_css', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				var cssCode = ''
				cssCode += to.replace( "{wrapper}", "#blogig-scroll-to-top" )
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-scroll-to-top-custom-css' )
			}
		})
	})

	// scroll to top custom css
	wp.customize( 'header_menu_custom_css', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				var cssCode = ''
				cssCode += to.replace( "{wrapper}", "#site-navigation" )
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-header-menu-custom-css' )
			}
		})
	})

	// header search custom css
	wp.customize( 'header_search_custom_css', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				var cssCode = ''
				cssCode += to.replace( "{wrapper}", ".search-wrap" )
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-header-search-custom-css' )
			}
		})
	})

	// header custom button custom css
	wp.customize( 'header_custom_button_custom_css', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				var cssCode = ''
				cssCode += to.replace( "{wrapper}", ".header-custom-button" )
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-header-custom-button-custom-css' )
			}
		})
	})

	// canvas menu custom css
	wp.customize( 'canvas_menu_custom_css', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				var cssCode = ''
				cssCode += to.replace( "{wrapper}", ".blogig-canvas-menu" )
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-canvas-menu-custom-css' )
			}
		})
	})

	// main banner custom css
	wp.customize( 'main_banner_custom_css', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				var cssCode = ''
				cssCode += to.replace( "{wrapper}", ".blogig-main-banner-section" )
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-main-banner-custom-css' )
			}
		})
	})

	// carousel custom css
	wp.customize( 'carousel_custom_css', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				var cssCode = ''
				cssCode += to.replace( "{wrapper}", ".blogig-carousel-section" )
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-carousel-custom-css' )
			}
		})
	})

	// footer custom css
	wp.customize( 'footer_custom_css', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				var cssCode = ''
				cssCode += to.replace( "{wrapper}", "footer#colophon" )
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-footer-custom-css' )
			}
		})
	})

	// bottom footer custom css
	wp.customize( 'bottom_footer_custom_css', function( value ) {
		value.bind( function( to ) {
			if( to ) {
				var cssCode = ''
				cssCode += to.replace( "{wrapper}", ".bottom-footer" )
				themeCalls.blogigGenerateStyleTag( cssCode, 'blogig-bottom-footer-custom-css' )
			}
		})
	})

	// check if string is variable and formats 
	function blogig_get_color_format(color) {
		if( color.indexOf( '--blogig-global-preset' ) != -1 ) {
			return( 'var( ' + color + ' )' );
		} else {
			return color;
		}
	}

	// converts integer to string for attibutes value 
	function blogig_get_numeric_string(int) {
		switch( int ) {
			case 2:
				return "two";
				break;
			case 3:
				return "three";
				break;
			case 4:
				return "four";
				break;
			case 5:
				return "five";
				break;
			case 6:
				return "six";
				break;
			default:
				return "one";
		}
	}

	// constants
	const ajaxFunctions = {
		typoFontsEnqueue: function() {
			var action = themeContstants.prefix + "typography_fonts_url",id ="customizer-typo-fonts-css"
			themeCalls.blogigGenerateLinkTag( action, id )
		}
	}

	// constants
	const helperFunctions = {
		generateStyle: function(color, id, variable) {
			if(color) {
				if( id == 'theme-color-style' ) {
					var styleText = 'body { ' + variable + ': ' + blogig_get_color_format(color) + '}';
				} else {
					var styleText = 'body { ' + variable + ': ' + blogig_get_color_format(color) + '}';
				}
				if( $( "head #" + id ).length > 0 ) {
					$( "head #" + id).text( styleText )
				} else {
					$( "head" ).append( '<style id="' + id + '">' + styleText + '</style>' )
				}
			}
		}
	}
}( jQuery ) );