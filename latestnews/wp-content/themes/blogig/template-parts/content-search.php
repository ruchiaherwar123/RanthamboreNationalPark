<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogig
 */
use Blogig\CustomizerDefault as BD;
$custom_class = 'has-featured-image';
if( ! has_post_thumbnail() ) $custom_class = 'no-featured-image';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $custom_class ); ?>>
    <div class="blogig-article-inner">
        <figure class="post-thumbnail-wrapper">
            <div class="post-thumnail-inner-wrapper">
                <?php
                    $archive_image_size = BD\blogig_get_customizer_option( 'archive_image_size' );
                    blogig_post_thumbnail( $archive_image_size );
                ?>
                <span class="post-meta-readtime-comment">
                    <?php
                        if( BD\blogig_get_customizer_option( 'archive_read_time_option' ) ) :
                            $read_time = '<span class="time-context">' .blogig_post_read_time( get_the_content() ). '</span>';
                            if( BD\blogig_get_customizer_option( 'archive_read_time_icon' ) ) {
                                $archive_read_time_icon = BD\blogig_get_customizer_option( 'archive_read_time_icon' );
                                $icon_html = blogig_get_icon_control_html($archive_read_time_icon);
                                if( $icon_html ) $read_time = $read_time . $icon_html;
                            }
                            echo '<span class="post-read-time">' .$read_time. '</span>';
                        endif;

                        if( BD\blogig_get_customizer_option( 'archive_comments_option' ) ) :
                            $comments_num = '<span class="comments-context">' .get_comments_number(). '</span>';
                            if( BD\blogig_get_customizer_option( 'archive_comments_icon' ) ) {
                                $archive_comments_icon = BD\blogig_get_customizer_option( 'archive_comments_icon' );
                                $icon_html = blogig_get_icon_control_html($archive_comments_icon);
                                if( $icon_html ) $comments_num = $comments_num . $icon_html;
                            }
                            echo '<a class="post-comments-num" href="'. esc_url(get_the_permalink()) .'#commentform">' .$comments_num. '</a>';
                        endif;
                    ?>       
                </span>        
            </div>
        </figure>
        <div class="inner-content">
            <div class="content-wrap">
                <?php
                    if( BD\blogig_get_customizer_option( 'archive_category_option' ) ) blogig_get_post_categories(get_the_ID());
                    if( BD\blogig_get_customizer_option( 'archive_title_option' ) ) :
                                $archive_title_tag = BD\blogig_get_customizer_option( 'archive_title_tag' );
                                the_title( '<' .esc_html( $archive_title_tag ). ' class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></' .esc_html( $archive_title_tag ). '>' );
                            endif;
                ?>
                <?php
                    
                    if( BD\blogig_get_customizer_option( 'archive_excerpt_option' ) ) {
                        echo '<div class="post-excerpt">';
                            the_excerpt();
                        echo '</div>';
                    }
                ?>

                <?php
                    blogig_archive_button_html(); // archive post button ?>
            </div>
            <div class="post-footer">
                <?php
                    if( BD\blogig_get_customizer_option( 'archive_author_option' ) ) blogig_posted_by();
                    ?>
                <span class="post-meta">
                    <?php
                        if( BD\blogig_get_customizer_option( 'archive_date_option' ) ) blogig_posted_on();
                    ?>
                </span>
            </div>
            <?php blogig_entry_footer(); ?>
        </div>
        <?php
            /**
             * hook - blogig_archive_button_html_hook
             * 
             * @since 1.0.0
             */
            do_action( 'blogig_archive_post_append_hook' );
        ?>
    </div>
</article>