<?php
/**
 * Adds Blogig Author Info Widget
 * 
 * @package Blogig
 * @since 1.0.0
 */

 class Blogig_Author_Info_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'blogig_author_info_widget',
            esc_html( 'Blogig: Author Info', 'blogig' ),
            [ 'description' =>  __( 'The information of author in detail.', 'blogig' ) ]
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        $author_type = isset( $instance['author_type'] ) ? $instance['author_type'] : 'custom';
        $widget_title = isset( $instance['widget_title'] ) ? $instance['widget_title'] : '';
        $author_name = isset( $instance['author_name'] ) ? $instance['author_name'] : '';
        $author_image = isset( $instance['author_image'] ) ? $instance['author_image'] : '';
        $author_tag = isset( $instance['author_tag'] ) ? $instance['author_tag'] : '';
        $author_url = isset( $instance['author_url'] ) ? $instance['author_url'] : '';
        $author_desc = isset( $instance['author_desc'] ) ? $instance['author_desc'] : '';

        if( $author_type != 'custom' ) :
            $author_id = str_replace( 'admin-', '', $author_type );
            $author_tag = get_the_author_meta( 'user_nicename', $author_id );
            $author_name = get_the_author_meta( 'display_name', $author_id );
            $author_desc = get_the_author_meta( 'description', $author_id );
        endif;
        echo wp_kses_post( $before_widget );
            if( ! empty( $widget_title ) ) echo wp_kses_post( $before_title ) . esc_html( $widget_title ) . wp_kses_post( $after_title );
            ?>
                <div class="post-card author-wrap">
                    <div class="bmm-author-thumb-wrap">
                        <figure class="post-thumb">
                            <?php
                                if( $author_type == 'custom' ) {
                                    if( $author_image ) echo '<a href="'. esc_url( $author_url ) .'"><img src="'. esc_url( $author_image ) .'"></a>';
                                } else {
                                    $author_id = str_replace( 'author-', '', $author_type );
                                    echo wp_kses_post( get_avatar( $author_id, 125 ) );
                                };
                            ?>
                        </figure>
                        <div class="author-elements">
                            <?php
                                if( $author_name ) echo '<h2 class="author-name"><a href="'. esc_url( $author_url ) .'">'. esc_html( $author_name ) .'</a></h2>';
                                if( $author_tag ) echo '<span class="author-tag">'. esc_html( $author_tag ) .'</span>';
                                // author links go here.
                            ?>
                        </div>
                    </div>
                    <div class="author-content-wrap">
                        <?php
                            if( $author_desc ) echo '<div class="author-desc">'. esc_html( $author_desc ) .'</div>';
                        ?>
                    </div>
                </div>
            <?php
        echo wp_kses_post( $after_widget );
    }

    public function widget_fields() {
        $admin_users = get_users( [ 'role__not_in' => 'subscriber', 'fields' => [ 'ID', 'display_name' ] ] );
        $admin_users_options['custom'] = esc_html__( 'Custom', 'blogig' );
        if( $admin_users ) :
            foreach( $admin_users as $admin_user ) :
                $admin_users_options['admin-'. $admin_user->ID] = $admin_user->display_name;
            endforeach;
        endif;
        return [
            [
                'name'  =>  'author_type',
                'type'  =>  'select',
                'title' =>  esc_html__( 'Author to Display', 'blogig' ),
                'description'   =>  esc_html__( 'Custom will allow you to diplay below custom content to add.', 'blogig' ),
                'options'   =>  $admin_users_options
            ],
            [
                'name'      => 'widget_title',
                'type'      => 'text',
                'title'     => esc_html__( 'Widget Title', 'blogig' ),
                'description'=> esc_html__( 'Add the widget title here', 'blogig' ),
                'default'   => esc_html__( 'Author Info', 'blogig' )
            ],
            [
                'name'      => 'author_name',
                'type'      => 'text',
                'title'     => esc_html__( 'Author Name', 'blogig' ),
                'default'   => esc_html__( 'Author Name', 'blogig' )
            ],
            [
                'name'  =>  'author_image',
                'type'  =>  'upload',
                'title' =>  esc_html__( 'Author Image', 'blogig' )
            ],
            [
                'name'  =>  'author_tag',
                'type'  =>  'text',
                'title' =>  esc_html__( 'Author Tag', 'blogig' ),
                'default'   =>  esc_html__( 'Writer', 'blogig' )
            ],
            [
                'name'  =>  'author_url',
                'type'  =>  'url',
                'title' =>  esc_html__( 'Author URL', 'blogig' ),
                'placeholder'   =>  esc_html__( 'Add url here..', 'blogig' )
            ],
            [
                'name'  =>  'author_desc',
                'type'  =>  'textarea',
                'title' =>  esc_html__( 'Description', 'blogig' ),
                'default'   =>  esc_html__( 'Lorem ipsum is simply dummy text is simply dummy text Lorem ipsum is simply dummy text..', 'blogig' )
            ],
        ];
    }

    public function form( $instance ) {
        $widget_fields = $this->widget_fields();
        foreach( $widget_fields as $widget_field ) :
            if ( isset( $instance[ $widget_field['name'] ] ) ) {
                $field_value = $instance[ $widget_field['name'] ];
            } else if( isset( $widget_field['default'] ) ) {
                $field_value = $widget_field['default'];
            } else {
                $field_value = '';
            }
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