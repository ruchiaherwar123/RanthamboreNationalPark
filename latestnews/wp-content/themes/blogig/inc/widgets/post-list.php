<?php
/**
 * Post List widget
 * 
 * @since 1.0.0
 * @package Blogig
 */

 class Blogig_Post_List_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'blogig_post_list_widget',
            esc_html__( 'Blogig: Post List', 'blogig' ),
            [ 'description' => __( 'A collection of post in a List', 'blogig' ) ]
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $widget_title = ( isset( $instance['widget_title'] ) ) ? $instance['widget_title'] : '';
        $number_of_posts_to_show = ( isset( $instance['number_of_posts_to_show'] ) ) ? $instance['number_of_posts_to_show'] : '';
        $posts_categories = ( isset( $instance['post_catgories'] ) ) ? $instance['post_catgories'] : '';
        $post_tags = ( isset( $instance['post_tags'] ) ) ? $instance['post_tags'] : '';
        $post_authors = ( isset( $instance['post_authors'] ) ) ? $instance['post_authors'] : '';
        $post_to_include = ( isset( $instance['post_to_include'] ) ) ? $instance['post_to_include'] : '';
        $post_to_exclude = ( isset( $instance['post_to_exclude'] ) ) ? $instance['post_to_exclude'] : '';
        $image_size = ( isset( $instance['image_size'] ) ) ? $instance['image_size'] : '';
        $post_list_args = [
            'post_type' =>  'post',
            'post_status'   =>  'publish',
            'posts_per_page'    =>  absint( $number_of_posts_to_show ),
            'ignore_sticky_posts'   =>  true
        ];
        if( ! empty( $posts_categories ) ) $post_list_args['cat'] = $posts_categories;
        if( ! empty( $post_authors ) ) $post_list_args['author'] = $post_authors;
        if( ! empty( $post_tags ) ) $post_list_args['tag__in'] = explode( ',', $post_tags );
        if( ! empty( $post_to_include ) ) $post_list_args['post__in'] = explode( ',', $post_to_include );
        if( ! empty( $post_to_exclude ) ) $post_list_args['post__not_in'] = explode( ',', $post_to_exclude );
        echo wp_kses_post( $before_widget );
            if( ! empty( $widget_title ) ) echo $before_title . $widget_title . $after_title;
            ?>
                <div class="post-list-wrap">
                    <?php
                        $post_list_query = new \WP_Query( $post_list_args );
                        if( $post_list_query->have_posts() ) :
                            $post_numbering = 1;
                            while( $post_list_query->have_posts() ) :
                                $post_list_query->the_post();
                                ?>
                                    <div class="post-item format-standard">
                                        <div class="post-thumb-image<?php if( ! has_post_thumbnail() ) echo ' no-feat-img'?>">
                                            <?php
                                                echo ( has_post_thumbnail() ) ? '<figure class="post-thumb"><a href="'. get_the_permalink() .'">'. get_the_post_thumbnail( get_the_ID(), $image_size ) .'</a></figure>' : '';
                                            ?>
                                        </div>
                                        <div class="post-content-wrap">
                                            <?php echo blogig_get_post_categories( get_the_ID() ); ?>

                                            <h3 class="post-title">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>

                                            <div class="post-meta">
                                                <?php blogig_posted_on(); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                $post_numbering++;
                            endwhile;
                        endif;
                        wp_reset_postdata();
                    ?>
                </div>
            <?php
        echo wp_kses_post( $after_widget );
    }

    public function widget_fields() {
        // for category
        $post_categories_args = get_categories();
        foreach( $post_categories_args as $category ) :
            $category_list[$category->term_id] = $category->name .'('. $category->count .')';
        endforeach;
        $category_list['type'] = 'category';

        // for tag
        $post_tags_args = get_tags();
        foreach( $post_tags_args as $tag ) :
            $tag_list[$tag->term_id] = $tag->name .'('. $tag->count .')';
        endforeach;
        $tag_list['type'] = 'tag';

        // for user
        $post_authors_args = new \WP_User_Query( [ 'number' => -1 ] );
        if( ! empty( $post_authors_args->get_results() ) ) :
            foreach( $post_authors_args->get_results() as $user ) :
                $user_list[$user->ID] = $user->display_name;
            endforeach;
        endif;
        $user_list['type'] = 'user';

        // for posts
        $posts_query = new \WP_Query([
            'post_type' =>  'post',
            'post_status'=>  'publish',
            'posts_per_page'    =>  -1
        ]);
        if( $posts_query->have_posts() ) :
            while( $posts_query->have_posts() ) :
                $posts_query->the_post();
                $post_list[ get_the_ID() ] = get_the_title();
            endwhile;
        endif;
        $post_list['type'] = 'post';
        wp_reset_postdata();
        return [
            [
                'name'  =>  'widget_title',
                'type'  =>  'text',
                'title' =>  esc_html( 'Widget Title', 'blogig' ),
                'description'   =>  esc_html__( 'Add the widget title here', 'blogig' ),
                'default'   =>  esc_html__( 'Post List', 'blogig' )
            ],
            [
                'name'  =>  'post_catgories',
                'type'  =>  'select-two',
                'title' =>  esc_html__( 'Post Categories', 'blogig' ),
                'description'   =>  esc_html__( 'Choose the category to display list of posts', 'blogig' ),
                'options'   =>  $category_list
            ],
            [
                'name'  =>  'post_tags',
                'type'  =>  'select-two',
                'title' =>  esc_html__( 'Post Tags', 'blogig' ),
                'description'   =>  esc_html__( 'Choose the tag to display list of posts', 'blogig' ),
                'options'   =>  $tag_list
            ],
            [
                'name'  =>  'post_authors',
                'type'  =>  'select-two',
                'title' =>  esc_html__( 'Post Authors', 'blogig' ),
                'description'   =>  esc_html__( 'Choose the author to display list author posts', 'blogig' ),
                'options'   =>  $user_list
            ],
            [
                'name'  =>  'post_to_include',
                'type'  =>  'select-two',
                'title' =>  esc_html__( 'Post to Include', 'blogig' ),
                'description'   =>  esc_html__( 'Choose the posts to display in the list of posts', 'blogig' ),
                'options'   =>  $post_list
            ],
            [
                'name'  =>  'post_to_exclude',
                'type'  =>  'select-two',
                'title' =>  esc_html__( 'Post to Exclude', 'blogig' ),
                'description'   =>  esc_html__( 'Choose the posts to exclude from list of posts', 'blogig' ),
                'options'   =>  $post_list
            ],
            [
                'name'  =>  'number_of_posts_to_show',
                'title' =>  esc_html__( 'Number of posts to show', 'blogig' ),
                'type'  =>  'number',
                'default'   =>  6
            ],
            [
                'name'  =>  'image_settings_heading',
                'type'  =>  'heading',
                'label' =>  esc_html__( 'Image Settings', 'blogig' )
            ],
            [
                'name'  =>  'image_size',
                'type'  =>  'select',
                'title' =>  esc_html__( 'Image Size', 'blogig' ),
                'options'   =>  blogig_get_image_sizes_option_array()
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
        if( ! is_array( $widget_fields ) ) return;
        foreach( $widget_fields as $widget_field ) :
            $instance[ $widget_field['name'] ] = blogig_sanitize_widget_fields( $widget_field, $new_instance );
        endforeach;
        return $instance;
    }
 }