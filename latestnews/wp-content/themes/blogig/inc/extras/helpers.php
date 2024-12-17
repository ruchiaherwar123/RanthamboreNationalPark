<?php
/**
 * Includes helper hooks and function of the theme
 * 
 * @package Blogig
 * @since 1.0.0
 */
use Blogig\CustomizerDefault as BD;

if( ! function_exists( 'blogig_header_html' ) ) :
    /**
     * Calls header hook
     * 
     * @since 1.0.0
     */
    function blogig_header_html() {
        require get_template_directory() . '/inc/hooks/header-hooks.php';
        $menu_aligment = BD\blogig_get_customizer_option('menu_options_menu_alignment');
        $sticky_class = 'menu-aligment--'. $menu_aligment;
        // $sticky_option = BD\blogig_get_customizer_option('menu_options_sticky_header');
        // $sticky_class .= ' header-sticky--'. ( $sticky_option ? 'enabled' : 'disabled' );
        
        ?>
            <div class="main-header <?php echo esc_attr( $sticky_class );?>">
                <div class="blogig-container">
                    <div class="row">
                        <div class="site-branding-section">
                            <?php
                                /**
                                 * hook - blogig_header__site_branding_section_hook
                                 * 
                                 * @hooked - blogig_header_menu_part - 10
                                 * @hooked - blogig_header_ads_banner_part - 20
                                 */
                                if( has_action( 'blogig_header__site_branding_section_hook' ) ) do_action( 'blogig_header__site_branding_section_hook' );
                            ?>
                        </div>
                        <div class="menu-section">
                            <?php
                                /**
                                 * hook - blogig_header__menu_section_hook
                                 * 
                                 * @hooked - blogig_header_menu_part - 10
                                 * @hooked - blogig_header_search_part - 20
                                 */
                                if( has_action( 'blogig_header__menu_section_hook' ) ) do_action( 'blogig_header__menu_section_hook' );
                            ?>
                            <div class="subscribe-section">
                                <?php
                                    /**
                                     * hook - blogig_header__custom_button_section_hook
                                     */
                                    if( has_action( 'blogig_header__custom_button_section_hook' ) ) do_action( 'blogig_header__custom_button_section_hook' );
                                ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        <?php
    }
endif;

if( ! function_exists( 'blogig_get_post_format' ) ) :
    /**
     * Gets the post format string
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_get_post_format( $id = null ) {
        $post_format = ( $id ) ? get_post_format($id): get_post_format();
        return apply_filters( 'blogig_post_format_string_filter', $post_format );
    }
endif;

if( ! function_exists( 'blogig_main_banner_html' ) ) :
    /**
     * Main banner html
     * 
     * @since 1.0.0
     */
    function blogig_main_banner_html() {
        $main_banner_render_in = BD\blogig_get_customizer_option( 'main_banner_render_in' );
        if( ! BD\blogig_get_customizer_option( 'main_banner_option' ) || is_paged() ) :
            return;
        elseif( $main_banner_render_in == 'front_page' && ! is_front_page() ) :
            return;
        elseif( $main_banner_render_in == 'posts_page' && ! is_home() ) :
            return;
        elseif( $main_banner_render_in == 'both' && ( ! is_front_page() && ! is_home() ) ):
            return;
        endif;

        // post query
        $main_banner_post_categories = BD\blogig_get_customizer_option( 'main_banner_slider_categories' );
        $main_banner_posts_to_include = BD\blogig_get_customizer_option( 'main_banner_slider_posts_to_include' );
        $main_banner_post_order = BD\blogig_get_customizer_option( 'main_banner_post_order' );
        $main_banner_no_of_posts_to_show = BD\blogig_get_customizer_option( 'main_banner_no_of_posts_to_show' );
        $hide_posts_with_no_featured_image = BD\blogig_get_customizer_option( 'main_banner_hide_post_with_no_featured_image' );
        $post_categories_id_args = ( ! empty( $main_banner_post_categories ) ) ? implode( ",", array_column( json_decode( $main_banner_post_categories ), 'value' ) ) : '';
        $post_to_include_id_args = ( ! empty( $main_banner_posts_to_include ) ) ? array_column( json_decode( $main_banner_posts_to_include ), 'value' ) : '';
        // post elements
        $show_title = BD\blogig_get_customizer_option( 'main_banner_post_elements_show_title' );
        $show_categories = BD\blogig_get_customizer_option( 'main_banner_post_elements_show_categories' );
        $show_date = BD\blogig_get_customizer_option( 'main_banner_post_elements_show_date' );
        $show_author = BD\blogig_get_customizer_option( 'main_banner_post_elements_show_author' );
        // image settings and slider settings
        $main_banner_image_sizes = BD\blogig_get_customizer_option( 'main_banner_image_sizes' );
        $main_banner_central_mode = BD\blogig_get_customizer_option( 'main_banner_center_mode' );
        $banner_class = '';
        $banner_class .= ($main_banner_central_mode) ? 'blogig-central-mode-enable ' : '';
        $main_banner_aligment = BD\blogig_get_customizer_option( 'main_banner_post_elements_alignment' );
        $banner_class .= 'banner-align--'.$main_banner_aligment;
        $banner_class .= ' main-banner-arrow-show';
        ?>
            <section class="blogig-main-banner-section <?php echo esc_attr( $banner_class )?>" id="blogig-main-banner-section">
                <div class="blogig-container">
                    <div class="row">
                        <div class="main-banner-wrap">
                            <?php
                                $post_order = explode( '-', $main_banner_post_order );
                                $post_query_args = [
                                    'post_type' =>  'post',
                                    'post_status'  =>  'publish',
                                    'posts_per_page'    =>  absint( $main_banner_no_of_posts_to_show ),
                                    'order' =>  $post_order[1],
                                    'order_by'  =>  $post_order[1],
                                    'ignore_sticky_posts'   =>  true
                                ];
                                if( isset( $main_banner_post_categories ) ) $post_query_args['cat'] = $post_categories_id_args;
                                if( isset( $main_banner_posts_to_include ) ) $post_query_args['post__in'] = $post_to_include_id_args;
                                if( $hide_posts_with_no_featured_image ) :
                                    $post_query_args['meta_query'] = [
                                        [
                                            'key'   =>  '_thumbnail_id',
                                            'compare'   =>  'EXISTS'
                                        ]
                                    ];
                                endif;
                                $post_query = new \WP_Query( $post_query_args );
                                if( $post_query->have_posts() ) :
                                    while( $post_query->have_posts() ) :
                                        $post_query->the_post();
                                        ?>
                                            <article class="post-item">
                                                <figure class="post-thumb">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php if( has_post_thumbnail() ) the_post_thumbnail( $main_banner_image_sizes ); ?>
                                                    </a>
                                                </figure>
                                                <div class="post-elements">
                                                    <div class="post-meta">
                                                        <?php 
                                                            if( $show_categories ) blogig_get_post_categories( get_the_ID(), 2 );
                                                            if( $show_date ) blogig_posted_on( get_the_ID(), 'banner' );
                                                        ?>
                                                    </div>
                                                    <?php
                                                        if( $show_title ) the_title( '<h2 class="post-title"><a href="'. esc_url( get_the_permalink() ) .'">', '</a></h2>' );
                                                        if( $show_author ) blogig_posted_by( 'banner' );
                                                    ?>
                                                </div>
                                            </article>
                                        <?php
                                    endwhile;
                                endif;
                                wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogig_header_after_hook', 'blogig_main_banner_html', 20 );
endif;

if( ! function_exists( 'blogig_carousel_html' ) ) :
    /**
     * Main banner html
     * 
     * @since 1.0.0
     */
    function blogig_carousel_html() {
        $carousel_render_in = BD\blogig_get_customizer_option( 'carousel_render_in' );
        if( ! BD\blogig_get_customizer_option( 'carousel_option' ) || is_paged() ) :
            return;
        elseif( $carousel_render_in == 'front_page' && ! is_front_page() ) :
            return;
        elseif( $carousel_render_in == 'posts_page' && ! is_home() ) :
            return;
        elseif( $carousel_render_in == 'both' && ( ! is_front_page() && ! is_home() ) ):
            return;
        endif;
        // post query
        $carousel_post_categories = BD\blogig_get_customizer_option( 'carousel_slider_categories' );
        $carousel_posts_to_include = BD\blogig_get_customizer_option( 'carousel_slider_posts_to_include' );
        $carousel_post_order = BD\blogig_get_customizer_option( 'carousel_post_order' );
        $carousel_no_of_posts_to_show = BD\blogig_get_customizer_option( 'carousel_no_of_posts_to_show' );
        $hide_posts_with_no_featured_image = BD\blogig_get_customizer_option( 'carousel_hide_post_with_no_featured_image' );
        $post_categories_id_args = ( ! empty( $carousel_post_categories ) ) ? implode( ",", array_column( json_decode( $carousel_post_categories ), 'value' ) ) : '';
        $post_to_include_id_args = ( ! empty( $carousel_posts_to_include ) ) ? array_column( json_decode( $carousel_posts_to_include ), 'value' ) : '';

        // post elements
        $show_title = BD\blogig_get_customizer_option( 'carousel_post_elements_show_title' );
        $show_categories = BD\blogig_get_customizer_option( 'carousel_post_elements_show_categories' );
        $show_date = BD\blogig_get_customizer_option( 'carousel_post_elements_show_date' );
        $show_author = BD\blogig_get_customizer_option( 'carousel_post_elements_show_author' );
        // image settings and slider settings
        $carousel_image_sizes = BD\blogig_get_customizer_option( 'carousel_image_sizes' );
        $carousel_no_of_columns = absint( BD\blogig_get_customizer_option( 'carousel_no_of_columns' ) );

        // element class
        $elementClass = 'blogig-carousel-section';
        $elementClass .= ( $carousel_no_of_columns ) ? ' no-of-columns--'. blogig_convert_number_to_numeric_string( $carousel_no_of_columns ) : '';

        $carousel_aligment = BD\blogig_get_customizer_option( 'carousel_post_elements_alignment' );
        $elementClass .= ' carousel-align--'.$carousel_aligment;
        $elementClass .= ' carousel-banner-arrow-show';
        ?>
            <section class="<?php echo esc_attr( $elementClass ); ?>" id="blogig-carousel-section">
                <div class="blogig-container">
                    <div class="row">
                        <div class="carousel-wrap">
                            <?php
                                $post_order = explode( '-', $carousel_post_order );
                                $post_query_args = [
                                    'post_type' =>  'post',
                                    'post_status'  =>  'publish',
                                    'posts_per_page'    =>  absint( $carousel_no_of_posts_to_show ),
                                    'order' =>  $post_order[1],
                                    'order_by'  =>  $post_order[1],
                                    'ignore_sticky_posts'   =>  true
                                ];
                                if( isset( $carousel_post_categories ) ) $post_query_args['cat'] = $post_categories_id_args;
                                if( isset( $carousel_posts_to_include ) ) $post_query_args['post__in'] = $post_to_include_id_args;
                                if( $hide_posts_with_no_featured_image ) :
                                    $post_query_args['meta_query'] = [
                                        [
                                            'key'   =>  '_thumbnail_id',
                                            'compare'   =>  'EXISTS'
                                        ]
                                    ];
                                endif;
                                $post_query = new \WP_Query( $post_query_args );
                                if( $post_query->have_posts() ) :
                                    while( $post_query->have_posts() ) :
                                        $post_query->the_post();
                                        ?>
                                            <article class="post-item">
                                                <figure class="post-thumb">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php if( has_post_thumbnail() ) the_post_thumbnail( $carousel_image_sizes ); ?>
                                                    </a>
                                                </figure>
                                                <div class="post-elements">
                                                    <div class="post-meta">
                                                        <?php 
                                                            if( $show_categories ) blogig_get_post_categories( get_the_ID(), 2 );
                                                            if( $show_date ) blogig_posted_on( get_the_ID(), 'carousel' );
                                                        ?>
                                                    </div>
                                                    <?php
                                                        if( $show_title ) the_title( '<h2 class="post-title"><a href="'. esc_url( get_the_permalink() ) .'">', '</a></h2>' );
                                                        if( $show_author ) blogig_posted_by( 'carousel' );
                                                    ?>
                                                </div>
                                            </article>
                                        <?php
                                    endwhile;
                                endif;
                                wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php
    }
    add_action( 'blogig_header_after_hook', 'blogig_carousel_html', 30 );
endif;

if( ! function_exists( 'blogig_get_icon_control_html' ) ) :
    /**
     * Generates output for icon control
     * 
     * @since 1.0.0
     */
    function blogig_get_icon_control_html($archive_date_icon) {
        if( $archive_date_icon['type'] == 'none' ) return;
        switch($archive_date_icon['type']) {
            case 'svg' : $output = '<img src="' .esc_url( wp_get_attachment_url( $archive_date_icon['value'] ) ). '"/>';
                    break;
            default: $output = '<i class="' .esc_attr( $archive_date_icon['value'] ). '"></i>';
        }
        return $output;
    }
endif;

if( ! function_exists( 'blogig_convert_number_to_numeric_string' )) :
    /**
     * Function to convert int parameter to numeric string
     * 
     * @return string
     */
    function blogig_convert_number_to_numeric_string( $int ) {
        switch( $int ){
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
 endif;

 if( ! function_exists( 'blogig_post_read_time' ) ) :
    /**
     * Function derives the read time
     * @return float
     */
    function blogig_post_read_time( $string = '' ) {
    	$read_time = 0;
        if( empty( $string ) ) {
            return 0 . esc_html__( ' min', 'blogig' );
        } else {
            $read_time = apply_filters( 'blogig_content_read_time', round( str_word_count( wp_strip_all_tags( $string ) ) / 100 ), 2 );
            if( $read_time == 0 ) {
            	return 1 . esc_html__( ' min', 'blogig' );
            } else {
            	return $read_time . esc_html__( ' mins', 'blogig' );
            }
        }
    }
endif;

if( ! function_exists( 'blogig_get_post_categories' ) ) :
    /**
     * Function contains post categories html
     * @return float
     */
    function blogig_get_post_categories( $post_id, $number = 1 ) {
    	$n_categories = wp_get_post_categories($post_id, array( 'number' => absint( $number ) ));
		echo '<ul class="post-categories">';
			foreach( $n_categories as $n_category ) :
				echo '<li class="cat-item ' .esc_attr( 'cat-' . $n_category ). '"><a href="' .esc_url( get_category_link( $n_category ) ). '" rel="category tag">' .get_cat_name( $n_category ). '</a></li>';
			endforeach;
		echo '</ul>';
    }
endif;

if( ! function_exists( 'blogig_loader_html' ) ) :
	/**
     * Preloader html
     * 
     * @package Blogig
     * @since 1.0.0
     */
	function blogig_loader_html() {
        if( ! BD\blogig_get_customizer_option( 'preloader_option' ) ) return;
        $elementClass = 'blogig_loading_box';
        $elementClass .= ' display-preloader--every-load';
	?>
		<div class="<?php echo esc_attr( $elementClass ); ?>">
			<div class="box">
				<div class="one"></div>
                <div class="two"></div>
                <div class="three"></div>
                <div class="four"></div>
                <div class="five"></div>
			</div>
		</div>
	<?php
	}
    add_action( 'blogig_page_prepend_hook', 'blogig_loader_html', 1 );
endif;

 if( ! function_exists( 'blogig_custom_header_html' ) ) :
    /**
     * Site custom header html
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_custom_header_html() {
        /**
         * Get custom header markup
         * 
         * @since 1.0.0 
         */
        the_custom_header_markup();
    }
    add_action( 'blogig_page_prepend_hook', 'blogig_custom_header_html', 20 );
 endif;

 if( ! function_exists( 'blogig_pagination_fnc' ) ) :
    /**
     * Renders pagination html
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_pagination_fnc() {
        if( is_null( paginate_links() ) ) {
            return;
        }
        $archive_pagination_type = BD\blogig_get_customizer_option( 'archive_pagination_type' );
        // the_post_navigation
        switch($archive_pagination_type) {
            case 'default'; the_posts_navigation();
                    break;
            default: echo '<div class="pagination">' .wp_kses_post( paginate_links( array( 'prev_text' => '<i class="fas fa-chevron-left"></i>', 'next_text' => '<i class="fas fa-chevron-right"></i>', 'type' => 'list' ) ) ). '</div>';
        }
        
    }
    add_action( 'blogig_pagination_link_hook', 'blogig_pagination_fnc' );
 endif;

 if( ! function_exists( 'blogig_scroll_to_top_html' ) ) :
    /**
     * Scroll to top fnc
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_scroll_to_top_html() {
        if( ! BD\blogig_get_customizer_option('blogig_scroll_to_top_option') ) return;
        $stt_text = BD\blogig_get_customizer_option( 'stt_text' );
        $stt_icon = BD\blogig_get_customizer_option( 'stt_icon' );
        $stt_alignment = BD\blogig_get_customizer_option( 'stt_alignment' );
        $scroll_to_top_mobile_option = BD\blogig_get_customizer_option( 'scroll_to_top_mobile_option' );
        $classes = 'align--' . $stt_alignment;
        if( ! $scroll_to_top_mobile_option ) $classes .= ' hide-on-mobile';
    ?>
        <div id="blogig-scroll-to-top" class="blogig-scroll-btn <?php echo esc_attr( $classes ); ?>">
            <?php
                if( $stt_text ) { echo '<span class="icon-text">'. esc_html( $stt_text ) .'</span>'; }
                if( $stt_icon['type'] == 'icon' ) {
                    if( $stt_icon['value'] != 'fas fa-ban' ) : 
                        echo '<span class="icon-holder"><i class="'. esc_attr( $stt_icon['value'] ) .'"></i></span>';
                    endif;
                } else {
                    if( $stt_icon['type'] != 'none' )echo '<span class="icon-holder">'. wp_get_attachment_image( $stt_icon['value'], 'full' ) .'</span>';
                }
            ?>
        </div><!-- #blogig-scroll-to-top -->
    <?php
    }
    add_action( 'blogig_after_footer_hook', 'blogig_scroll_to_top_html' );
 endif;

 require get_template_directory() . '/inc/hooks/footer-hooks.php'; // footer hooks.
if( !function_exists( 'blogig_footer_sections_html' ) ) :
    /**
     * Calls footer hooks
     * 
     * @since 1.0.0
     */
    function blogig_footer_sections_html() {
        if( ! BD\blogig_get_customizer_option( 'footer_option' ) ) return;
        ?>
        <div class="main-footer boxed-width">
            <div class="footer-inner blogig-container">
                <div class="row">
                    <div class="footer-inner-wrap">
                        <?php
                            /**
                             * hook - blogig_footer_hook
                             * 
                             * @hooked - blogig_footer_widgets_area_part - 10
                             */
                            if( has_action( 'blogig_footer_hook' ) ) do_action( 'blogig_footer_hook' );
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
endif;

if( !function_exists( 'blogig_bottom_footer_sections_html' ) ) :
    /**
     * Calls bottom footer hooks
     * 
     * @since 1.0.0
     */
    function blogig_bottom_footer_sections_html() {
        if( ! BD\blogig_get_customizer_option( 'bottom_footer_option' ) ) return;
        ?>
        <div class="bottom-footer">
            <div class="blogig-container">
                <div class="row">
                    <?php
                        /**
                         * hook - blogig_bottom_footer_sections_html
                         * 
                         * @hooked - blogig_bottom_footer_menu_part - 20
                         * @hooked - blogig_bottom_footer_copyright_part - 3020
                         */
                        if( has_action( 'blogig_botttom_footer_hook' ) ) do_action( 'blogig_botttom_footer_hook' );
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
endif;

if ( ! function_exists( 'blogig_breadcrumb_trail' ) ) :
    /**
     * Theme default breadcrumb function.
     *
     * @since 1.0.0
     */
    function blogig_breadcrumb_trail() {
        if ( ! function_exists( 'breadcrumb_trail' ) ) {
            // load class file
            require_once get_template_directory() . '/inc/breadcrumb-trail/breadcrumb-trail.php';
        }

        // arguments variable
        $breadcrumb_args = array(
            'container' => 'div',
            'show_browse' => false,
        );
        breadcrumb_trail( $breadcrumb_args );
    }
    add_action( 'blogig_breadcrumb_trail_hook', 'blogig_breadcrumb_trail' );
endif;

if( ! function_exists( 'blogig_breadcrumb_html' ) ) :
    /**
     * Theme breadcrumb
     *
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_breadcrumb_html() {
        $site_breadcrumb_option = BD\blogig_get_customizer_option( 'site_breadcrumb_option' );
        if ( ! $site_breadcrumb_option ) return;
        if ( is_front_page() || is_home() ) return;
        $site_breadcrumb_type = BD\blogig_get_customizer_option( 'site_breadcrumb_type' );
            ?>
                <div class="row blogig-breadcrumb-element">
                    <div class="blogig-breadcrumb-wrap">
                        <?php
                            switch( $site_breadcrumb_type ) {
                                case 'yoast': if( blogig_compare_wand([blogig_function_exists( 'yoast_breadcrumb' )] ) ) yoast_breadcrumb();
                                        break;
                                case 'rankmath': if( blogig_compare_wand([blogig_function_exists( 'rank_math_the_breadcrumbs' )] ) ) rank_math_the_breadcrumbs();
                                        break;
                                case 'bcn': if( blogig_compare_wand([blogig_function_exists( 'bcn_display' )] ) ) bcn_display();
                                        break;
                                default: do_action( 'blogig_breadcrumb_trail_hook' );
                                        break;
                            }
                        ?>
                    </div>
                </div><!-- .row -->
        <?php
    }
endif;
add_action( 'blogig_before_main_content', 'blogig_breadcrumb_html', 10 );

if( ! function_exists( 'blogig_theme_mode_switch' ) ) :
    /**
     * Function to return either icon html or image html
     * 
     * @param type
     * @since 1.0.0
     */
    function blogig_theme_mode_switch( $mode, $theme_mode ) {
        $elementClass = ( $theme_mode == 'light' ) ? 'lightmode' : 'darkmode';
        switch( $mode['type'] ) :
            case 'icon' :
                echo '<i class="'. esc_attr( $mode['value'] . ' ' . $elementClass ) .'"></i>';
                break;
            case 'svg' :
                echo '<img class="'. esc_attr( $elementClass ) .'" src="'. esc_url( wp_get_attachment_image_url( $mode['value'], 'full' ) ) .'">';
                break;
        endswitch;
    }
 endif;