<?php
/**
 * The left sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogig
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) {
	return;
}
use Blogig\CustomizerDefault as BD;
?>
<aside id="secondary-aside" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-left' ); ?>
</aside><!-- #secondary-aside -->