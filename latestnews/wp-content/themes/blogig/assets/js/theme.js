jQuery(document).ready(function($) {
   // handle preloader
   function blogigPreloader( timeOut = 3000 ) {
        setTimeout(function() {
            $('body .blogig_loading_box').hide();
        }, timeOut);
    }
    blogigPreloader()

    // header - live search
    var subscribeSection = $('.subscribe-section')
    if( subscribeSection.length > 0 ) {
        subscribeSection.on( 'click', '.search-trigger', function(){
            var _this = $(this)
            _this.siblings().show()
            _this.parent().addClass('toggled')
            _this.siblings().find('.search-field').focus()
        })

        // close search popup
        var closeButton = subscribeSection.find('.search-form-wrap')
        if( closeButton.length > 0 ) {
            closeButton.on('click', '.search-form-close', function(){
                var _thisButton = $(this), parentElement = _thisButton.parents('.search-wrap')
                parentElement.removeClass('toggled')
                _thisButton.parent().hide()
            })
        }

        // on ESC button click
        $(document).on('keydown', function( event ){
            if( event.keyCode == 27 ) {
                closeButton.hide()
                closeButton.parent().removeClass('toggled')
            }
        })
    }

    // check for dark mode drafts
    if( localStorage.getItem( "themeMode" ) != null ) {
        if( localStorage.getItem("themeMode") == "dark" ) {
            $('body').addClass( 'blogig-dark-mode' ).removeClass('blogig-light-mode')
        } else {
            $('body').addClass( 'blogig-light-mode' ).removeClass('blogig-dark-mode')
        }
    }
    
    // header - theme mode
    var themeModeContainer = $('.mode-toggle-wrap')
    if( themeModeContainer.length > 0 ) {
        themeModeContainer.on( 'click', '.mode-toggle', function(){
            var _this = $(this), bodyElement = _this.parents('body')
            if( bodyElement.hasClass('blogig-dark-mode') ) {
                localStorage.setItem( 'themeMode', 'light' )
                bodyElement.removeClass('blogig-dark-mode').addClass('blogig-light-mode')
            } else {
                localStorage.setItem( 'themeMode', 'dark' )
                bodyElement.removeClass('blogig-light-mode').addClass('blogig-dark-mode')
            }
        })
    }

    // header - canvas menu
    var canvasMenuContainer = $('.blogig-canvas-menu')
    if( canvasMenuContainer.length > 0 ) {
        canvasMenuContainer.on( 'click', '.canvas-menu-icon', function() {
            var _this = $(this), bodyElement = _this.parents('body')
            bodyElement.toggleClass('blogig-model-open');
            onElementOutsideClick( _this.siblings(), function(){
                bodyElement.removeClass( 'blogig-model-open' )
            })
        })
    }

    // on element outside click function
    function onElementOutsideClick( currentElement, callback ) {
        $(document).mouseup(function( e ) {
            var container = $(currentElement);
            if ( !container.is(e.target) && container.has(e.target).length === 0) callback();
        })
    }

    // full-width banner
    var fullWidthBannerContainer = $('.blogig-main-banner-section')
    if( fullWidthBannerContainer.length > 0 ) {
        var mainBannerWrapper = fullWidthBannerContainer.find('.main-banner-wrap')
        var prevIcon = ( blogigObject.prevIcon.type == 'icon' ) ? '<i class="'+ blogigObject.prevIcon.value +'"></i>' : '<img src="'+ blogigObject.prevIcon.url +'">'
        var nextIcon = ( blogigObject.nextIcon.type == 'icon' ) ? '<i class="'+ blogigObject.nextIcon.value +'"></i>' : '<img src="'+ blogigObject.nextIcon.url +'">'
        mainBannerWrapper.slick({
            arrows: true,
            fade: (blogigObject.fade == 1),
            infinite: false,
            autoplay: true,
            centerMode: (blogigObject.centerMode == 1),
            centerPadding: '80px',
            autoplaySpeed: parseInt( blogigObject.autoplaySpeed ),
            speed: parseInt( blogigObject.speed ),
            prevArrow: '<button type="button" class="slick-prev">' + prevIcon + '</button>',
            nextArrow: '<button type="button" class="slick-next">' + nextIcon + '</button>',
            responsive: [
              {
                breakpoint: 800,
                settings: {
                  centerMode: false,
                  centerPadding: '0px'
                },
              }
            ]

        })
    }

    // carousel
    var carouselContainer = $('.blogig-carousel-section')
    if( carouselContainer.length > 0 ) {
        var carouselWrapper = carouselContainer.find('.carousel-wrap')
        var prevIcon = ( blogigObject.carouselPrevIcon.type == 'icon' ) ? '<i class="'+ blogigObject.carouselPrevIcon.value +'"></i>' : '<img src="'+ blogigObject.carouselPrevIcon.url +'">'
        var nextIcon = ( blogigObject.carouselNextIcon.type == 'icon' ) ? '<i class="'+ blogigObject.carouselNextIcon.value +'"></i>' : '<img src="'+ blogigObject.carouselNextIcon.url +'">'
        carouselWrapper.slick({
            arrows: true,
            fade: false,
            infinite: false,
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: parseInt( blogigObject.carouselSlideToShow ),
            slidesToScroll: parseInt( blogigObject.slidesToScroll ),
            speed: 3000,
            prevArrow: '<button type="button" class="slick-prev">'+ prevIcon +'</button>',
            nextArrow: '<button type="button" class="slick-next">'+ nextIcon +'</button>',
            responsive: [
              {
                breakpoint: 1100,
                settings: {
                  slidesToShow: 3,
                },
              },
              {
                breakpoint: 940,
                settings: {
                  slidesToShow: 2,
                },
              },
              {
                breakpoint: 700,
                settings: {
                  slidesToShow: 1,
                },
              }
            ]
        
        })
    }

    // scripts for archive pages
    if( blogigObject.isArchive ) {
        // archive masonry layout 
        var masonryContainer = $("body.archive--masonry-layout #primary .blogig-inner-content-wrap")
        masonryContainer.masonry({
            // options
            itemSelector: 'article.post, .blogig-advertisement-block',
            gutter: 30
        })

        // handle the post gallery post format
        var postGalleryElems = $("body #primary article.format-gallery .post-thumbnail-wrapper .thumbnail-gallery-slider")
        if( postGalleryElems.length > 0 ) {
            postGalleryElems.each(function() {
                var thisGallery = $(this)
                thisGallery.slick({
                    arrows: true,
                    fade: true,
                    infinite: true,
                    autoplay: false,
                    prevArrow: '<button type="button" class="slick-prev"><i class="fa-solid fa-arrow-left-long"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="fa-solid fa-arrow-right-long"></i></button>'
                })
            })
        }
    }

    // back to top script
    if( $( "#blogig-scroll-to-top" ).length ) {
        var scrollContainer = $( "#blogig-scroll-to-top" );
        $(window).scroll(function() {
            if ( $(this).scrollTop() > 800 ) {
                scrollContainer.addClass('show');
            } else {
                scrollContainer.removeClass('show');
            }
        });
        scrollContainer.click(function(event) {
            event.preventDefault();
            // Animate the scrolling motion.
            $("html, body").animate({scrollTop:0},"slow");
        });
    }

    // post format - gallery
    var gallery = $('.wp-block-gallery')
    if( gallery.length > 0 ) {
        if( blogigObject.singleGalleryLightbox != 1 ) return
        gallery.each(function(){
            var _this = $(this)
            var findImageSrc = _this.find('.wp-block-image img')
            var srcArgs = []
            findImageSrc.each(function(){
                srcArgs.push({
                    src: $(this).attr('src'),
                    type: 'image'
                })
            })
            _this.magnificPopup({
                items: srcArgs,
                gallery: {
                    enabled: true
                },
                type: 'image'
            })
        })
    }

    // main header sticky
    if( blogigObject.headerSticky ) {
        $(window).on('scroll', function(){
            var scroll = $(window).scrollTop()
            var mainHeaderContainer = $('.main-header')
            if( scroll >= 200 ) {
                mainHeaderContainer.addClass('header-sticky--enabled').removeClass('header-sticky--disabled')
            } else {
                mainHeaderContainer.addClass('header-sticky--disabled').removeClass('header-sticky--enabled')
            }
        })
    }
})