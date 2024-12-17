<?php
/**
 * Category collection widget
 * 
 * @since 1.0.0
 * @package Blogig
 */

 class Blogig_Category_Collection_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'blogig_category_collection_widget',
            esc_html__( 'Blogig: Category Collection', 'blogig' ),
            [ 'description' => __( 'A collection of post categories', 'blogig' ) ]
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $widget_title = ( isset( $instance['widget_title'] ) ) ? $instance['widget_title'] : '';
        $post_categories = ( isset( $instance['post_categories'] ) ) ? $instance['post_categories'] : '';
        echo wp_kses_post( $before_widget );
            if( ! empty( $widget_title ) ) echo $before_title . esc_html( $widget_title ) .$after_title;
            ?>
                <div class="categories-wrap">
                    <?php
                        if( $post_categories ) :
                            $post_categories = get_categories( [ 'include' => explode( ',', $post_categories ) ] );
                        else:
                            $post_categories = get_categories( [ 'number' => 4 ] );
                        endif;
                        foreach( $post_categories as $cat ) :
                            $cat_name = $cat->name;
                            $cat_count = $cat->count;
                            $cat_id = $cat->cat_ID;

                            $widget_post = new WP_Query( 
                                [
                                    'cat'    => esc_html( $cat_id ),
                                    'posts_per_page' => 1,
                                    'meta_query' => [
                                        [
                                        'key' => '_thumbnail_id',
                                        'compare' => 'EXISTS'
                                        ],
                                    ],
                                    'ignore_sticky_posts'    => true
                                ]
                            );
                            $thumbnail_url = '';
                            if( $widget_post->have_posts() ) :
                                while( $widget_post->have_posts() ) :
                                    $widget_post->the_post();
                                    $thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
                                endwhile;
                            endif;
                            wp_reset_postdata();
                            ?>
                                <div class="post-thumb post-thumb category-item cat-<?php echo esc_attr( $cat_id ); ?>">
                                    <?php if( $thumbnail_url ) : ?>
                                        <img src="<?php echo esc_url( $thumbnail_url ); ?>">
                                    <?php endif; ?>
                                    <a class="cat-meta-wrap" href="<?php echo esc_url( get_term_link( $cat_id ) ); ?>">
                                        <div class="cat-meta blogig-post-title">
                                            <?php
                                                echo sprintf( '<span class="category-name">%1s</span><span class="category-count">%2s</span>', esc_html( $cat_name ), absint( $cat_count ) );
                                            ?>
                                        </div>
                                    </a>
                                </div>
                            <?php
                        endforeach;
                    ?>
                </div>
            <?php
        echo wp_kses_post( $after_widget );
    }

    public function widget_fields() {
        $category_query_args = get_categories();
        foreach( $category_query_args as $category ) :
            $categories_options[$category->term_id] = $category->name .'('. $category->count .')';
        endforeach;
        $categories_options['type'] = 'category';
        return [
            [
                'name'  =>  'widget_title',
                'type'  =>  'text',
                'title' =>  esc_html( 'Widget Title', 'blogig' ),
                'description'   =>  esc_html__( 'Add the widget title here', 'blogig' ),
                'default'   =>  esc_html__( 'Category Collection', 'blogig' )
            ],
            [
                'name'  =>  'post_categories',
                'type'  =>  'select-two',
                'title' =>  esc_html__( 'Post Categories', 'blogig' ),
                'description'   =>  esc_html__( 'Choose the caategories to display', 'blogig' ),
                'options'   =>  $categories_options
            ]
        ];
    }

    public function form( $instance ) {
        $widget_fields = $this->widget_fields();
        foreach( $widget_fields as $widget_field ) :
            if( isset( $instance[ $widget_field['name'] ] ) ) :
                $field_value = $instance[ $widget_field['name'] ];
            elseif( isset( $widget_field['default'] ) ) :
                $field_value = $widget_field['default'];
            else:
                $field_value = '';
            endif;
            blogig_widget_fields( $this, $widget_field, $field_value );
        endforeach;
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        if( ! is_array( $widget_fields ) ) return $instance;
        foreach( $widget_fields as $widget_field ) :
            $instance[ $widget_field['name'] ] = blogig_sanitize_widget_fields( $widget_field, $new_instance );
        endforeach;
        return $instance;
    }
 }