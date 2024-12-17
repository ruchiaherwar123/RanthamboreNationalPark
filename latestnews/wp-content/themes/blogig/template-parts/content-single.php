<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Blogig
 */
use Blogig\CustomizerDefault as BD;
?>
<article <?php blogig_schema_article_attributes(); ?> id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner">
		<?php
			$single_custom_class = '';
			if( ! has_post_thumbnail() ) $single_custom_class = 'no-single-featured-image';
		?>
		<div class="post-meta-wrap">
			<?php
				blogig_get_post_categories( get_the_ID(), 20 );
			?>
			<?php
				$single_title_tag = BD\blogig_get_customizer_option( 'single_title_tag' );
				the_title( '<' .esc_html( $single_title_tag ). ' class="entry-title" ' .blogig_schema_article_name_attributes(). '>', '</' .esc_html( $single_title_tag ). '>' );
			?>
			<?php
				blogig_posted_by();
			?>
			<span class="post-meta">
				<?php
					blogig_posted_on();

					$read_time = '<span class="time-context">' .blogig_post_read_time( get_the_content() ). '</span>';
					if( BD\blogig_get_customizer_option( 'single_read_time_icon' ) ) {
						$single_read_time_icon = BD\blogig_get_customizer_option( 'single_read_time_icon' );
						$icon_html = blogig_get_icon_control_html($single_read_time_icon);
						if( $icon_html ) $read_time = $icon_html . $read_time;
					}
					echo '<span class="post-read-time">' .$read_time. '</span>';

					$comments_num = '<span class="comments-context">' .get_comments_number(). '</span>';
					if( BD\blogig_get_customizer_option( 'single_comments_icon' ) ) {
						$single_comments_icon = BD\blogig_get_customizer_option( 'single_comments_icon' );
						$icon_html = blogig_get_icon_control_html($single_comments_icon);
						if( $icon_html ) $comments_num = $icon_html . $comments_num ;
					}
					echo '<a class="post-comments-num" href="'. esc_url(get_the_permalink()) .'#commentform">' .$comments_num. '</a>';
				?>
			</span>
		</div>

		<header class="entry-header <?php echo esc_attr($single_custom_class); ?>" >
			<?php
				$single_image_size = BD\blogig_get_customizer_option( 'single_image_size' );
				blogig_post_thumbnail( $single_image_size );
			?>
		</header><!-- .entry-header -->
		
		<div <?php blogig_schema_article_body_attributes(); ?> class="entry-content">
			<?php
				do_action( 'blogig_before_single_content_hook' );
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blogig' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					)
				);
				do_action( 'blogig_after_single_content_hook' );

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogig' ),
						'after'  => '</div>',
					)
				);
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php
				$tag_count = get_tags([ 'object_ids' => get_the_ID() ]);
				if( count( $tag_count ) != 0 ) :
					blogig_tags_list();
				endif;
					blogig_entry_footer();
			?>
		</footer><!-- .entry-footer -->
	</div>

	<div class="post-card author-wrap">
		<div class="bmm-author-thumb-wrap">
			<?php
				echo '<figure class="post-thumb">'. get_avatar( get_the_author_meta( 'ID' ) ) .'</figure>';
			?>
			<div class="author-elements">
				<?php
					echo '<h2 class="author-name"><a href="'. esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) .'">'. get_the_author() .'</a></h2>';
					if( ! empty( get_the_author_meta( 'description' ) ) ) echo '<div class="author-desc">'. get_the_author_meta( 'description' ) .'</div>';
				?>
			</div>
		</div>
	</div>
	
	<?php
		$prev_post_date = $prev_post_thumbnail = $prev_post_navigation_sub_title = '';
		$next_post_date = $next_post_thumbnail = $next_post_navigation_sub_title = '';
		$previous = get_previous_post();
		$next = get_next_post();
		// date
		$prev_post_date = '<span class="nav-post-date">' . get_the_date() . '</span>';
		$next_post_date = '<span class="nav-post-date">' . get_the_date() . '</span>';
		// thumbnail
		$prev_post_thumbnail = ( ! empty( $previous ) ) ? get_the_post_thumbnail_url( $previous->ID ) : '';
		$next_post_thumbnail = ( ! empty( $next ) ) ? get_the_post_thumbnail_url( $next->ID  ) : '';
		// sub-title
		$prev_post_navigation_sub_title = '<span class="nav-subtitle"><i class="fa-solid fa-arrow-left"></i></span>';
		$next_post_navigation_sub_title = '<span class="nav-subtitle"><i class="fa-solid fa-arrow-right"></i></span>';
		// title
		$post_navigation_title = '<span class="nav-title">%title</span>';
		the_post_navigation(
			array(
				'prev_text' => '<figure class="nav-thumb" style="background-image:url('. $prev_post_thumbnail .')"><div class="nav-post-elements">'. $prev_post_date . '<div class="nav-title-wrap">' . $prev_post_navigation_sub_title . $post_navigation_title. '</div></div></figure>',
				'next_text' => '<figure class="nav-thumb" style="background-image:url('. $next_post_thumbnail .')"><div class="nav-post-elements">'. $next_post_date . '<div class="nav-title-wrap">' . $post_navigation_title . $next_post_navigation_sub_title .'</div></div></figure>'
			)
		);
	?>
		
	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php
	/**
	 * hook - blogig_single_post_append_hook
	 * 
	 * @since 1.0.0
	 */
	do_action( 'blogig_single_post_append_hook' );