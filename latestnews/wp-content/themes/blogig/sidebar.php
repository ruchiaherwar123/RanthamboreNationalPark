<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Blogig
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
use Blogig\CustomizerDefault as BD;
?>
<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
