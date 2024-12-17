<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogig
 */
use Blogig\CustomizerDefault as BD;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php blogig_schema_body_attributes(); ?>>
<?php
	wp_body_open();

	/**
	 * Function - blogig_shooting_star_animation_html
	 */
	$site_background_animation = BD\blogig_get_customizer_option( 'site_background_animation' );
	if( $site_background_animation ) blogig_shooting_star_animation_html();
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'blogig' ); ?></a>
	<?php
		/**
		 * hook - blogig_page_prepend_hook
		 * 
		 * @package Blogig
		 * @since 1.0.0
		 */
		do_action( "blogig_page_prepend_hook" );
	?>
	<header id="masthead" class="site-header">
		<?php
			/**
			 * Function - blogig_header_html
			 * 
			 * @since 1.0.0
			 * 
			 */
			blogig_header_html();
		?>
	</header><!-- #masthead -->
<?php
	/**
	 * Hook - blogig_header_after_hook
	 * 
	 * 
	 * @since 1.0.0
	 * 
	 */
	if( has_action( 'blogig_header_after_hook' ) ) do_action( 'blogig_header_after_hook' );

echo '<div id="blogig-main-wrap">';

/**
 * hook - blogig_page_header_hook
 * 
 * @since 1.0.0
 */
do_action( 'blogig_page_header_hook' );

echo '<div class="blogig-container">';
	/**
	 * hook - blogig_before_main_content
	 * 
	 */
	do_action( 'blogig_before_main_content' );
echo '<div class="row">';