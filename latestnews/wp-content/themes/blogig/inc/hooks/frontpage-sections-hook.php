<?php
/**
 * Frontpage section hooks and function for the theme
 * 
 * @package Blogig
 * @since 1.0.0
 */
use Blogig\CustomizerDefault as BD;
 
 if( ! function_exists( 'blogig_article_masonry' ) ) :
    /**
     * Masonry articles element
     * 
     * @package Blogig
     * @since 1.0.0
     */
    function blogig_article_masonry() {
        $query_args = [
            'post_type' =>  'post',
            'post_status'   =>  'publish'
        ];
        $post_query = new \WP_Query( $query_args );
        if( $post_query->have_posts() ) :
            while( $post_query->have_posts() ) :
                $post_query->the_post();
            endwhile;
        endif;
    }
    add_action( 'blogig_masonry_articles_hook', 'blogig_article_masonry' );
 endif;
