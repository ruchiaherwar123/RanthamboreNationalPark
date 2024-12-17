<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Blogig
 */
use Blogig\CustomizerDefault as BD;

 if ( ! function_exists( 'blogig_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function blogig_posted_on( $post_id = '', $for = '' ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		$time = $post_id ? get_the_time( 'U', $post_id ) : get_the_time( 'U' );
		$modified_time = $post_id ? get_the_modified_time( 'U', $post_id ) : get_the_modified_time( 'U' );
		if ( $time !== $modified_time ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( $post_id ? get_the_date( DATE_W3C, $post_id ) : get_the_date( DATE_W3C ) ),
			esc_html( blogig_get_published_date($post_id) ),
			esc_attr( $post_id ? get_the_modified_date( DATE_W3C, $post_id ) : get_the_modified_date( DATE_W3C ) ),
			esc_html( blogig_get_modified_date($post_id) )
		);
		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
		if( $for == 'banner' ) { 
			$main_banner_date_icon = BD\blogig_get_customizer_option( 'main_banner_date_icon' );
			$icon_html = blogig_get_icon_control_html( $main_banner_date_icon );
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		} else if( $for == 'carousel' ) {
			$carousel_date_icon = BD\blogig_get_customizer_option( 'carousel_date_icon' );
			$icon_html = blogig_get_icon_control_html( $carousel_date_icon );
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		} else if( $for == 'you-may-have-missed' ) {
			$ymhm_date_icon = BD\blogig_get_customizer_option( 'you_may_have_missed_date_icon' );
			$icon_html = blogig_get_icon_control_html( $ymhm_date_icon );
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		} else if( is_home() || is_archive() ) {
			$archive_date_icon = BD\blogig_get_customizer_option( 'archive_date_icon' );
			$icon_html = blogig_get_icon_control_html( $archive_date_icon );
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		} else if( is_single() ) {
			$single_date_icon = BD\blogig_get_customizer_option( 'single_date_icon' );
			$icon_html = blogig_get_icon_control_html( $single_date_icon );
			if( $icon_html ) $posted_on = $icon_html . $posted_on;
		}
		echo '<span class="post-date posted-on ' .esc_attr( BD\blogig_get_customizer_option( 'site_date_to_show' ) ). '">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if ( ! function_exists( 'blogig_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function blogig_posted_by( $for = '' ) {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'blogig' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		if( $for == 'banner' ) {
			$author_image = get_avatar( get_the_author_meta( 'ID' ), 40 );
			if( $author_image ) $byline = $author_image . $byline;
		} else if( $for == 'carousel' ) {
			$author_image = get_avatar( get_the_author_meta( 'ID' ), 40 );
			if( $author_image ) $byline = $author_image . $byline;
		} else if( $for == 'you-may-have-missed' ) {
			$author_image = get_avatar( get_the_author_meta( 'ID' ), 40 );
			if( $author_image ) $byline = $author_image . $byline;
		} else {
			if( is_home() || is_archive() ) :
				$author_image = get_avatar( get_the_author_meta( 'ID' ), 40 );
				if( $author_image ) $byline = $author_image . $byline;
			endif;
	
			if( is_single() ) :
				$author_image = get_avatar( get_the_author_meta( 'ID' ), 40 );
				if( $author_image ) $byline = $author_image . $byline;
			endif;
	
			if( is_search() ) :
				$author_image = get_avatar( get_the_author_meta( 'ID' ), 40 );
				if( $author_image ) $byline = $author_image . $byline;
			endif;
		}
		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;

if( ! function_exists( 'blogig_tags_list' ) ) :
	/**
	 * print the html for tags list
	 */
	function blogig_tags_list() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', ' ' );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged: %1$s', 'blogig' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;

if ( ! function_exists( 'blogig_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function blogig_entry_footer() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'blogig' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'blogig_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function blogig_post_thumbnail( $size = 'thumbnail' ) {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		if ( is_singular() ) :
			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( $size ); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>
			<a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						$size,
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if( ! function_exists( 'blogig_get_published_date' ) ) :
	// Get post pusblished date
	function blogig_get_published_date($post_id='') {
		$site_date_format = BD\blogig_get_customizer_option( 'site_date_format' );
		$n_date = $site_date_format == 'default' ? 
												$post_id ? get_the_date('', $post_id) : get_the_date() : 
												human_time_diff($post_id ? get_the_time('U',$post_id) : get_the_time('U'), current_time('timestamp')) .' '. __('ago', 'blogig');
		return apply_filters( "blogig_inherit_published_date", $n_date );
	}
endif;

if( ! function_exists( 'blogig_get_modified_date' ) ) :
	// Get post pusblished date
	function blogig_get_modified_date($post_id='') {
		$site_date_format = BD\blogig_get_customizer_option( 'site_date_format' );
		$n_date = $site_date_format == 'default' ? 
											$post_id ? get_the_modified_date('', $post_id) : get_the_modified_date() : 
												human_time_diff($post_id ? get_the_modified_time('U', $post_id): get_the_modified_time('U'), current_time('timestamp')) .' '. __('ago', 'blogig');
		return apply_filters( "blogig_inherit_published_date", $n_date );
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
