<?php
/**
 * Theme hooks and functions
 * 
 * @package Blogig
 * @since 1.0.0
 */
use Blogig\CustomizerDefault as BD;
if( ! function_exists( 'blogig_single_related_posts' ) ) :
    /**
     * Single related posts
     * 
     * @package Blogig
     */
    function blogig_single_related_posts() {
        if( get_post_type() != 'post' ) return;
        $single_post_related_posts_option = BD\blogig_get_customizer_option( 'single_post_related_posts_option' );
        if( ! $single_post_related_posts_option ) return;
        $related_posts_title = BD\blogig_get_customizer_option( 'single_post_related_posts_title' );

        $related_posts_args = array(
            'posts_per_page'   => 2,
            'post__not_in'  => array( get_the_ID() ),
            'ignore_sticky_posts'    => true
        );
        $current_post_categories = get_the_category(get_the_ID());
        if( $current_post_categories ) :
            foreach( $current_post_categories as $current_post_cat ) :
                $query_cats[] =  $current_post_cat->term_id;
            endforeach;
            $related_posts_args['category__in'] = $query_cats;
        endif;
        $related_posts = new WP_Query( $related_posts_args );
        if( ! $related_posts->have_posts() ) return;
  ?>
            <div class="single-related-posts-section-wrap layout--list">
                <div class="single-related-posts-section">
                    <?php
                        if( $related_posts_title ) echo '<h2 class="blogig-block-title"><span>' .esc_html( $related_posts_title ). '</span></h2>';
                            echo '<div class="single-related-posts-wrap">';
                                while( $related_posts->have_posts() ) : $related_posts->the_post();
                            ?>
                                <article post-id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                    <?php if( has_post_thumbnail() ) : ?>
                                        <figure class="post-thumb-wrap <?php if(!has_post_thumbnail()){ echo esc_attr('no-feat-img');} ?>">
                                            <?php blogig_post_thumbnail( 'medium' ); ?>
                                        </figure>
                                    <?php endif; ?>
                                    <div class="post-element">
                                        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <div class="post-meta">
                                            <?php
                                                blogig_posted_by();
                                                blogig_posted_on();
                                                $comments_num = '<span class="comments-context">' .get_comments_number(). '</span>';
                                                if( BD\blogig_get_customizer_option( 'single_comments_icon' ) ) {
                                                    $single_comments_icon = BD\blogig_get_customizer_option( 'single_comments_icon' );
                                                    $icon_html = blogig_get_icon_control_html($single_comments_icon);
                                                    if( $icon_html ) $comments_num = $icon_html . $comments_num ;
                                                }
                                                echo '<a class="post-comments-num" href="'. esc_url(get_the_permalink()) .'#commentform">' .$comments_num. '</a>';
                                            ?>
                                        </div>
                                    </div>
                                </article>
                            <?php
                                endwhile;
                            echo '</div>';
                    ?>
                </div>
            </div>
    <?php
    }
endif;
add_action( 'blogig_single_post_append_hook', 'blogig_single_related_posts' );

if( ! function_exists( 'blogig_archive_button_html' ) ) :
    /**
     * Archive button hook
     * 
     * @since 1.0.0
     */
    function blogig_archive_button_html() {
        if( ! BD\blogig_get_customizer_option( 'archive_button_option' ) ) return;
        $archive_button_text = BD\blogig_get_customizer_option( 'archive_button_text' );
        $archive_button_icon = BD\blogig_get_customizer_option( 'archive_button_icon' );
        $archive_read_more_button_on_mobile = BD\blogig_get_customizer_option( 'show_readmore_button_mobile_option' );
        $read_more_button_hide_on_mobile = ( ! $archive_read_more_button_on_mobile ) ? ' hide-on-mobile' : '';
        ?>
            <a href="<?php the_permalink(); ?>" class="post-button<?php echo esc_attr( $read_more_button_hide_on_mobile ); ?>">
                <span class="button-icon">
                <?php
                    $icon_html = blogig_get_icon_control_html($archive_button_icon);
                    if( $icon_html ) echo $icon_html;
                ?>
                </span>
                <span class="button-text"><?php echo esc_html( $archive_button_text ); ?></span>
            </a><!-- .post-button -->
        <?php
    }
endif;

if( ! function_exists( 'blogig_archive_header_html' ) ) :
    /**
     * Archive info box hook
     * 
     * @since 1.0.0
     */
    function blogig_archive_header_html() {
        if( ! is_archive() ) return;
        if( is_category() && ! BD\blogig_get_customizer_option( 'archive_category_info_box_option' ) ) return;
        if( is_tag() && ! BD\blogig_get_customizer_option( 'archive_tag_info_box_option' ) ) return;
        if( is_author() && ! BD\blogig_get_customizer_option( 'archive_author_info_box_option' ) ) return;
        echo '<header class="page-header">';
            echo '<div class="blogig-container">';
                echo '<div class="row">';
                    if( is_category() ) {
                        $archive_category_info_box_icon = BD\blogig_get_customizer_option( 'archive_category_info_box_icon' );
                        $icon_html = blogig_get_icon_control_html($archive_category_info_box_icon);
                        if( $icon_html ) echo $icon_html;
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<div class="archive-description">', '</div>' );
                    } else if( is_tag() ) {
                        $archive_tag_info_box_icon = BD\blogig_get_customizer_option( 'archive_tag_info_box_icon' );
                        $icon_html = blogig_get_icon_control_html($archive_tag_info_box_icon);
                        if( $icon_html ) echo $icon_html;
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<div class="archive-description">', '</div>' );
                    } else if( is_author() ) {
                        $author_image = get_avatar( get_queried_object_id(), 90 );
                        if( $author_image ) echo $author_image;
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<div class="archive-description">', '</div>' );
                    } else {
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                    }
                    echo '</div><!-- .row -->';
                echo '</div><!-- .blogig-container -->';
        echo '</header><!-- .page-header -->';
    }
    add_action( 'blogig_page_header_hook', 'blogig_archive_header_html' );
endif;

if( 'blogig_shooting_star_animation_html' ) :
    /**
     * Background animation one
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_shooting_star_animation_html() {
        $show_background_animation_on_mobile = BD\blogig_get_customizer_option( 'show_background_animation_on_mobile' ); 
        $elementClass = 'blogig-background-animation';
        if( ! $show_background_animation_on_mobile ) $elementClass .= ' hide-on-mobile';
        ?>
            <div class="<?php echo esc_attr( $elementClass ); ?>">
                <?php
                    for( $i = 0; $i < 13; $i++ ) :
                        echo '<span class="item"></span>';
                    endfor;
                ?>
            </div>
        <?php
    }
endif;