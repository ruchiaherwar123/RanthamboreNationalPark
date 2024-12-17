<?php
/**
 * Includes the inline css
 * 
 * @package Blogig
 * @since 1.0.0
 */
use Blogig\CustomizerDefault as BD;

if( ! function_exists( 'blogig_assign_preset_var' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_assign_preset_var( $selector, $control) {
      $decoded_control =  BD\blogig_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      echo " body { " . $selector . ": ".esc_html( $decoded_control ).  ";}\n";
   }
endif;

// Value change single
if( ! function_exists( 'blogig_value_change' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_value_change ( $selector, $control, $property ) {
      $decoded_control = BD\blogig_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      echo $selector . "{ ".esc_html( $property ) ." : ".esc_html($decoded_control) .  "px; }";
   }
endif;

// Value change with responsive
if( ! function_exists( 'blogig_value_change_responsive' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_value_change_responsive ( $selector, $control, $property ) {
      $decoded_control = BD\blogig_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['desktop'] ) ) :
         $desktop = $decoded_control['desktop'];
         echo $selector . "{ " . esc_html( $property ). ": ".esc_html( $desktop ).  "px; }";
         endif;
         if( isset( $decoded_control['tablet'] ) ) :
         $tablet = $decoded_control['tablet'];
         echo "@media(max-width: 940px) { " .$selector . "{ " . esc_html( $property ). ": ".esc_html( $tablet ).  "px; } }\n";
         endif;
         if( isset( $decoded_control['smartphone'] ) ) :
         $smartphone = $decoded_control['smartphone'];
         echo "@media(max-width: 610px) { " .$selector . "{ " . esc_html( $property ). ": ".esc_html($smartphone).  "px; } }\n";
      endif;
   }
endif;

// Variable change with responsive
if( ! function_exists( 'blogig_assign_preset_var_responsive' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_assign_preset_var_responsive( $selector, $control) {
         $decoded_control =  BD\blogig_get_customizer_option( $control );
         if( ! $decoded_control ) return;
         echo " body { " . $selector . ": ".esc_html( $decoded_control ).  ";}\n";
   }
endif;

// Typography
if( ! function_exists( 'blogig_get_typo_style' ) ) :
   /**
   * Generate css code for typography control.
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_get_typo_style( $selector, $control ) {
      $decoded_control = BD\blogig_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['font_family'] ) ) :
         echo ".blogig_font_typography { ".$selector."-family : " .esc_html( $decoded_control['font_family']['value'] ).  "; }\n";
      endif;

      if( isset( $decoded_control['font_weight'] ) ) :
         echo ".blogig_font_typography { ".$selector."-weight : " .esc_html( $decoded_control['font_weight']['value'] ).  "; }\n";
      endif;

      if( isset( $decoded_control['text_transform'] ) ) :
         echo ".blogig_font_typography { ".$selector."-texttransform : " .esc_html( $decoded_control['text_transform'] ).  "; }\n";
      endif;

      if( isset( $decoded_control['text_decoration'] ) ) :
         echo ".blogig_font_typography { ".$selector."-textdecoration : " .esc_html( $decoded_control['text_decoration'] ).  "; }\n";
      endif;

      if( isset( $decoded_control['font_size'] ) ) :
         if( isset( $decoded_control['font_size']['desktop'] ) ) echo ".blogig_font_typography { ".$selector."-size : " .absint( $decoded_control['font_size']['desktop'] ).  "px; }\n";
         if( isset( $decoded_control['font_size']['tablet'] ) ) echo ".blogig_font_typography { ".$selector."-size-tab : " .absint( $decoded_control['font_size']['tablet'] ).  "px; }\n";
         if( isset( $decoded_control['font_size']['smartphone'] ) ) echo ".blogig_font_typography { ".$selector."-size-mobile : " .absint( $decoded_control['font_size']['smartphone'] ).  "px; }\n";
      endif;
      if( isset( $decoded_control['line_height'] ) ) :
         if( isset( $decoded_control['line_height']['desktop'] ) ) echo ".blogig_font_typography { ".$selector."-lineheight : " .absint( $decoded_control['line_height']['desktop'] ).  "px; }\n";
         if( isset( $decoded_control['line_height']['tablet'] ) ) echo ".blogig_font_typography { ".$selector."-lineheight-tab : " .absint( $decoded_control['line_height']['tablet'] ).  "px; }\n";
         if( isset( $decoded_control['line_height']['smartphone'] ) ) echo ".blogig_font_typography { ".$selector."-lineheight-mobile : " .absint( $decoded_control['line_height']['smartphone'] ).  "px; }\n";
      endif;
      if( isset( $decoded_control['letter_spacing'] ) ) :
         if( isset( $decoded_control['letter_spacing']['desktop'] ) ) echo ".blogig_font_typography { ".$selector."-letterspacing : " . $decoded_control['letter_spacing']['desktop'] .  "px; }\n";
         if( isset( $decoded_control['letter_spacing']['tablet'] ) ) echo ".blogig_font_typography { ".$selector."-letterspacing-tab : " . $decoded_control['letter_spacing']['tablet'] .  "px; }\n";
         if( isset( $decoded_control['letter_spacing']['smartphone'] ) ) echo ".blogig_font_typography { ".$selector."-letterspacing-mobile : " . $decoded_control['letter_spacing']['smartphone'] .  "px; }\n";
      endif;
   }
endif;

// Typography Value
if( ! function_exists( 'blogig_get_typo_style_value' ) ) :
   /**
   * Generate css code for typography control.
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_get_typo_style_value( $selector, $control ) {
      $decoded_control = BD\blogig_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['font_family'] ) ) :
         echo ".blogig_font_typography ".$selector. "{ font-family : " .esc_html( $decoded_control['font_family']['value'] ).  "; }\n";
      endif;

      if( isset( $decoded_control['font_weight'] ) ) :
         echo ".blogig_font_typography ".$selector."{ font-weight : " .esc_html( $decoded_control['font_weight']['value'] ).  "; }\n";
      endif;

      if( isset( $decoded_control['text_transform'] ) ) :
         echo ".blogig_font_typography ".$selector."{ text-transform : " .esc_html( $decoded_control['text_transform'] ).  "; }\n";
      endif;

      if( isset( $decoded_control['text_decoration'] ) ) :
         echo ".blogig_font_typography ".$selector."{ text-decoration : " .esc_html( $decoded_control['text_decoration'] ).  "; }\n";
      endif;

      if( isset( $decoded_control['font_size'] ) ) :
         if( isset( $decoded_control['font_size']['desktop'] ) ) echo ".blogig_font_typography ".$selector." { font-size : " .absint( $decoded_control['font_size']['desktop'] ).  "px; }\n";
         if( isset( $decoded_control['font_size']['tablet'] ) ) echo "@media(max-width: 940px) { .blogig_font_typography " .$selector . "{ font-size : " .absint( $decoded_control['font_size']['tablet'] ).  "px; } }\n";
         if( isset( $decoded_control['font_size']['smartphone'] ) ) echo "@media(max-width: 610px) { .blogig_font_typography " .$selector . "{ font-size : " .absint( $decoded_control['font_size']['smartphone'] ).  "px; } }\n";
      endif;

      if( isset( $decoded_control['line_height'] ) ) :
         if( isset( $decoded_control['line_height']['desktop'] ) ) echo ".blogig_font_typography ".$selector." { line-height : " .absint( $decoded_control['line_height']['desktop'] ).  "px; }\n";
         if( isset( $decoded_control['line_height']['tablet'] ) ) echo "@media(max-width: 940px) { .blogig_font_typography " .$selector . "{ line-height : " .absint( $decoded_control['line_height']['tablet'] ).  "px; } }\n";
         if( isset( $decoded_control['line_height']['smartphone'] ) ) echo "@media(max-width: 610px) { .blogig_font_typography " .$selector . "{ line-height : " .absint( $decoded_control['line_height']['smartphone'] ).  "px; } }\n";
      endif;

      if( isset( $decoded_control['letter_spacing'] ) ) :
         if( isset( $decoded_control['letter_spacing']['desktop'] ) ) echo ".blogig_font_typography ".$selector." { letter-spacing : " .$decoded_control['letter_spacing']['desktop'] .  "px; }\n";
         if( isset( $decoded_control['letter_spacing']['tablet'] ) ) echo "@media(max-width: 940px) { .blogig_font_typography " .$selector . "{ letter-spacing : " . $decoded_control['letter_spacing']['tablet'] .  "px; } }\n";
         if( isset( $decoded_control['letter_spacing']['smartphone'] ) ) echo "@media(max-width: 610px) { .blogig_font_typography " .$selector . "{ letter-spacing : " . $decoded_control['letter_spacing']['smartphone'] .  "px; } }\n";
      endif;



   }
endif;

// Typography Value Body
if( ! function_exists( 'blogig_get_typo_style_body_value' ) ) :
   /**
   * Generate css code for typography control.
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_get_typo_style_body_value( $selector, $control ) {
      $decoded_control = BD\blogig_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['font_family'] ) ) :
         echo $selector. "{ font-family : " .esc_html( $decoded_control['font_family']['value'] ).  "; }\n";
      endif;

      if( isset( $decoded_control['font_weight'] ) ) :
         echo $selector."{ font-weight : " .esc_html( $decoded_control['font_weight']['value'] ).  "; }\n";
      endif;

      if( isset( $decoded_control['text_transform'] ) ) :
         echo $selector."{ text-transform : " .esc_html( $decoded_control['text_transform'] ).  "; }\n";
      endif;

      if( isset( $decoded_control['text_decoration'] ) ) :
         echo $selector."{ text-decoration : " .esc_html( $decoded_control['text_decoration'] ).  "; }\n";
      endif;

      if( isset( $decoded_control['font_size'] ) ) :
         if( isset( $decoded_control['font_size']['desktop'] ) ) echo $selector." { font-size : " .absint( $decoded_control['font_size']['desktop'] ).  "px; }\n";
         if( isset( $decoded_control['font_size']['tablet'] ) ) echo "@media(max-width: 940px) { ".$selector . "{ font-size : " .absint( $decoded_control['font_size']['tablet'] ).  "px; } }\n";
         if( isset( $decoded_control['font_size']['smartphone'] ) ) echo "@media(max-width: 610px) { .blogig_font_typography " .$selector . "{ font-size : " .absint( $decoded_control['font_size']['smartphone'] ).  "px; } }\n";
      endif;

      if( isset( $decoded_control['line_height'] ) ) :
         if( isset( $decoded_control['line_height']['desktop'] ) ) echo $selector." { line-height : " .absint( $decoded_control['line_height']['desktop'] ).  "px; }\n";
         if( isset( $decoded_control['line_height']['tablet'] ) ) echo "@media(max-width: 940px) { " .$selector . "{ line-height : " .absint( $decoded_control['line_height']['tablet'] ).  "px; } }\n";
         if( isset( $decoded_control['line_height']['smartphone'] ) ) echo "@media(max-width: 610px) { " .$selector . "{ line-height : " .absint( $decoded_control['line_height']['smartphone'] ).  "px; } }\n";
      endif;

      if( isset( $decoded_control['letter_spacing'] ) ) :
         if( isset( $decoded_control['letter_spacing']['desktop'] ) ) echo $selector." { letter-spacing : " . $decoded_control['letter_spacing']['desktop'].  "px; }\n";
         if( isset( $decoded_control['letter_spacing']['tablet'] ) ) echo "@media(max-width: 940px) { " .$selector . "{ letter-spacing : " . $decoded_control['letter_spacing']['tablet'] .  "px; } }\n";
         if( isset( $decoded_control['letter_spacing']['smartphone'] ) ) echo "@media(max-width: 610px) { " .$selector . "{ letter-spacing : " . $decoded_control['letter_spacing']['smartphone'] .  "px; } }\n";
      endif;
   }
endif;

// Assign Variable
if( ! function_exists( 'blogig_assign_var' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_assign_var( $selector, $control) {
         $decoded_control =  BD\blogig_get_customizer_option( $control );
         if( ! $decoded_control ) return;
         echo " body { " . $selector . ": ".esc_html( $decoded_control ).  ";}\n";
   }
endif;

// Text Color ( Variable Change )
if( ! function_exists( 'blogig_variable_color' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_variable_color( $selector, $control) {
      $decoded_control =  BD\blogig_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['color'] ) ) :
         $color = $decoded_control['color'];
         echo "body  { " . $selector . ": ".blogig_get_color_format($color).  ";}";
      endif;
      if( isset( $decoded_control['hover'] ) ) :
         $color_hover = $decoded_control['hover'];
         echo "body  { " . $selector . "-hover : ".blogig_get_color_format($color_hover).  "; }";
      endif;
   }
endif;

// Color Group ( Variable Change )
if( ! function_exists( 'blogig_variable_bk_color' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_variable_bk_color( $selector, $control, $var = '' ) {
      $decoded_control = json_decode( BD\blogig_get_customizer_option( $control ), true );
      if( ! $decoded_control ) return;
      if(isset($decoded_control['initial'] )):

         if( isset( $decoded_control['initial']['type'] ) ) :
            $type = $decoded_control['initial']['type'];
            if( isset( $decoded_control['initial'][$type] ) ) echo "body { ".$selector.": " .blogig_get_color_format( $decoded_control['initial'][$type] ). "}\n";
         endif;
      endif;

      if(isset($decoded_control['hover'])):
         if( isset( $decoded_control['hover']['type'] ) ) :
            $type = $decoded_control['hover']['type'];
            if( isset( $decoded_control['hover'][$type] ) ) echo "body { ".$selector."-hover: " .blogig_get_color_format( $decoded_control['hover'][$type] ). "}\n";
         endif;
      endif;
   }
endif;

// Category colors
if( ! function_exists( 'blogig_category_bk_colors_styles' ) ) :
   /**
    * Generates css code for font size
   *
   * @package Blogig
   * @since 1.0.0
   */
   function blogig_category_bk_colors_styles() {
      $totalCats = get_categories();
      if( $totalCats ) :
         foreach( $totalCats as $singleCat ) :
            $category_color = BD\blogig_get_customizer_option( 'category_' .absint($singleCat->term_id). '_color' );
            echo "body .post-categories .cat-item.cat-" . absint($singleCat->term_id) . " a{ color : " .blogig_get_color_format( $category_color['color'] ). "} \n";
            echo "body .post-categories .cat-item.cat-" . absint($singleCat->term_id) . " a:hover { color : " .blogig_get_color_format( $category_color['hover'] ). "} \n";
            echo "body.archive.category.category-" . absint($singleCat->term_id) . " #blogig-main-wrap .page-header .blogig-container i{ color : " .blogig_get_color_format( $category_color['color'] ). "} \n";
            echo "body.archive.category.category-" . absint($singleCat->term_id) . " #blogig-main-wrap .page-header .blogig-container i:hover { color : " .blogig_get_color_format( $category_color['hover'] ). "} \n";
            $category_color_bk = json_decode( BD\blogig_get_customizer_option( 'category_background_' .absint($singleCat->term_id). '_color' ), true );
            if(isset($category_color_bk['initial'] )):
               if( isset( $category_color_bk['initial']['type'] ) ) :
                  $type = $category_color_bk['initial']['type'];
                  if( isset( $category_color_bk['initial'][$type] ) ) {
                     echo "body .post-categories .cat-item.cat-" . absint($singleCat->term_id) . " a{ background : " .blogig_get_color_format( $category_color_bk['initial'][$type]   ). "; box-shadow: 0px 3px 10px -2px ".blogig_get_color_format( $category_color_bk['initial'][$type] )."} \n";
                     echo "body.archive.category.category-". absint($singleCat->term_id) . " #blogig-main-wrap .page-header .blogig-container i{ background : " .blogig_get_color_format( $category_color_bk['initial'][$type]   )."; box-shadow: 0px 3px 10px -2px ".blogig_get_color_format( $category_color_bk['initial'][$type] )."}\n";
                  }
               endif;
            endif;

            if(isset($category_color_bk['hover'] )) :
               if( isset( $category_color_bk['hover']['type'] ) ) :
                  $type = $category_color_bk['hover']['type'];
                  if( isset( $category_color_bk['hover'][$type] ) ) {
                     echo "body .post-categories .cat-item.cat-" . absint($singleCat->term_id) . " a:hover{ background : " .blogig_get_color_format( $category_color_bk['hover'][$type] )."; box-shadow: 0px 3px 10px -2px ".blogig_get_color_format( $category_color_bk['hover'][$type] ).  "} \n";
                     echo "body.archive.category.category-". absint($singleCat->term_id) . " #blogig-main-wrap .page-header .blogig-container i:hover{ background : " .blogig_get_color_format( $category_color_bk['hover'][$type]   )."; box-shadow: 0px 3px 10px -2px ".blogig_get_color_format( $category_color_bk['hover'][$type] ). "} \n";
                  }
               endif;
            endif;
         endforeach;
      endif;
   }
endif;

// tags colors
if( ! function_exists( 'blogig_tags_bk_colors_styles' ) ) :
   /**
    * Generates css code for font size
   *
   * @package Blogig
   * @since 1.0.0
   */
   function blogig_tags_bk_colors_styles() {
      $totalTags = get_tags();
      if( $totalTags ) :
         foreach( $totalTags as $singleTag ) :
            $tag_color = BD\blogig_get_customizer_option( 'tag_' .absint($singleTag->term_id). '_color' );
            echo "body .tags-wrap .tags-item.tag-" . absint($singleTag->term_id) . " span{ color : " .blogig_get_color_format( $tag_color['color'] ). "} \n";
            echo "body .tags-wrap .tags-item.tag-" . absint($singleTag->term_id) . ":hover span { color : " .blogig_get_color_format( $tag_color['hover'] ). "} \n";
            echo "body.archive.tag.tag-" . absint($singleTag->term_id) . " #blogig-main-wrap .page-header .blogig-container i{ color : " .blogig_get_color_format( $tag_color['color'] ). "} \n";
            echo "body.archive.tag.tag-" . absint($singleTag->term_id) . " #blogig-main-wrap .page-header .blogig-container i:hover { color : " .blogig_get_color_format( $tag_color['hover'] ). "} \n";
            $tag_color_bk = json_decode( BD\blogig_get_customizer_option( 'tag_background_' .absint($singleTag->term_id). '_color' ), true );
            if(isset($tag_color_bk['initial'] )) :
               if( isset( $tag_color_bk['initial']['type'] ) ) :
                  $type = $tag_color_bk['initial']['type'];
                  if( isset( $tag_color_bk['initial'][$type] ) ){
                     echo "body .tags-wrap .tags-item.tag-" . absint($singleTag->term_id) . " { background : " .blogig_get_color_format( $tag_color_bk['initial'][$type]   ). "; box-shadow: 0px 3px 10px -2px ".blogig_get_color_format( $tag_color_bk['initial'][$type] ). "} \n";
                     echo "body.archive.tag.tag-" . absint($singleTag->term_id) . " #blogig-main-wrap .page-header .blogig-container i{ background : " .blogig_get_color_format( $tag_color_bk['initial'][$type]   )."; box-shadow: 0px 3px 10px -2px ".blogig_get_color_format( $tag_color_bk['initial'][$type] ). "} \n";
                  }
               endif;
            endif;

            if(isset($tag_color_bk['hover'] )) :
               if( isset( $tag_color_bk['hover']['type'] ) ) :
                  $type = $tag_color_bk['hover']['type'];
                  if( isset( $tag_color_bk['hover'][$type] ) ) {
                     echo "body .tags-wrap .tags-item.tag-" . absint($singleTag->term_id) . ":hover{ background : " .blogig_get_color_format( $tag_color_bk['hover'][$type] )."; box-shadow: 0px 3px 10px -2px ".blogig_get_color_format( $tag_color_bk['hover'][$type] ). "} \n";
                     echo "body.archive.tag.tag-" . absint($singleTag->term_id) . " #blogig-main-wrap .page-header .blogig-container i:hover{ background : " .blogig_get_color_format( $tag_color_bk['hover'][$type]   )."; box-shadow: 0px 3px 10px -2px ".blogig_get_color_format( $tag_color_bk['hover'][$type] ). "} \n";
                  }
               endif;
            endif;
         endforeach;
      endif;
   }
endif;

// Border Options
if( ! function_exists( 'blogig_border_option' ) ) :
   /**
   * Generate css code for Top header Text Color
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_border_option( $selector, $control, $property="border" ) {
      $decoded_control = BD\blogig_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['type'] ) || isset( $decoded_control['width'] ) || isset( $decoded_control['color'] ) ) :
      echo $selector. "{ ".$property.": ". $decoded_control['width'] ."px ".$decoded_control['type']." ". blogig_get_color_format($decoded_control['color']) .";}";
      endif;
   }
endif;

// Box Shadow
if( ! function_exists( 'blogig_box_shadow_styles' ) ) :
   /**
    * Generates css code for block box shadow size
   *
   * @package Blogig
   * @since 1.0.0
   */
   function blogig_box_shadow_styles($selector,$value) {
      $blogig_box_shadow = BD\blogig_get_customizer_option($value);
      if( $blogig_box_shadow['option'] == 'none' ) {
         echo $selector."{ box-shadow: 0px 0px 0px 0px; }\n";
      } else {
            if( $blogig_box_shadow['type'] == 'outset') $blogig_box_shadow['type'] = '';
            echo $selector."{ box-shadow : ".esc_html( $blogig_box_shadow['type'] ) ." ".esc_html( $blogig_box_shadow['hoffset'] ).  "px ". esc_html( $blogig_box_shadow['voffset'] ). "px ".esc_html( $blogig_box_shadow['blur'] ).  "px ".esc_html( $blogig_box_shadow['spread'] ).  "px ".blogig_get_color_format( $blogig_box_shadow['color'] ).  ";
            }\n";
      }
   }
endif;

// Image ratio change
if( ! function_exists( 'blogig_image_ratio' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_image_ratio( $selector, $control ) {
      $decoded_control = BD\blogig_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['desktop'] ) && $decoded_control['desktop'] > 0 ) :
         $desktop = $decoded_control['desktop'];
         echo $selector . "{ padding-bottom : calc(".esc_html( $desktop ).  " * 100%); }";
      endif;
      if( isset( $decoded_control['tablet'] ) && $decoded_control['tablet'] > 0 ) :
         $tablet = $decoded_control['tablet'];
         echo "@media(max-width: 940px) { " .$selector . "{ padding-bottom : calc(".esc_html( $tablet ).  "* 100%); } }\n";
      endif;
      if( isset( $decoded_control['smartphone'] ) && $decoded_control['smartphone'] > 0 ) :
         $smartphone = $decoded_control['smartphone'];
         echo "@media(max-width: 610px) { " .$selector . "{ padding-bottom : calc(".esc_html($smartphone).  " * 100%); } }\n";
      endif;
   }
endif;

// Image ratio Variable change
if( ! function_exists( 'blogig_image_ratio_variable' ) ) :
   /**
   * Generate css code for variable change with responsive
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_image_ratio_variable ( $selector, $control ) {
      $decoded_control = BD\blogig_get_customizer_option( $control );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['desktop'] ) && $decoded_control['desktop'] > 0 ) :
         $desktop = $decoded_control['desktop'];
         echo "body { ". $selector . " : ".esc_html( $desktop )."}\n";
         endif;
         if( isset( $decoded_control['tablet'] ) && $decoded_control['tablet'] > 0 ) :
         $tablet = $decoded_control['tablet'];
         echo "body { " .$selector . "-tab : ".esc_html( $tablet ). " }\n";
         endif;
         if( isset( $decoded_control['smartphone'] ) && $decoded_control['smartphone'] > 0 ) :
         $smartphone = $decoded_control['smartphone'];
         echo "body { " .$selector . "-mobile : ".esc_html($smartphone).  " }\n";
      endif;
   }
endif;

// Background Color (Initial)
if( ! function_exists( 'blogig_initial_bk_color' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_initial_bk_color( $selector, $control) {
      $decoded_control = json_decode( BD\blogig_get_customizer_option( $control ), true);
      if( ! $decoded_control ) return;
         echo $selector. " { background: " .blogig_get_color_format( $decoded_control[$decoded_control ['type']]). "}\n";
   }
endif;

// Site Background Color
if( ! function_exists( 'blogig_get_background_style' ) ) :
   /**
    * Generate css code for background control.
    *
    * @package Blogig
    * @since 1.0.0 
    */
   function blogig_get_background_style( $selector, $control, $var = '' ) {
      $decoded_control = json_decode( BD\blogig_get_customizer_option( $control ), true );
      if( ! $decoded_control ) return;
      if( isset( $decoded_control['type'] ) ) :
         $type = $decoded_control['type'];
         switch( $type ) {
            case 'image' : if( isset( $decoded_control[$type]['media_id'] ) ) echo $selector . " { background-image: url(" .esc_url( wp_get_attachment_url( $decoded_control[$type]['media_id'] ) ). ") }";
                  if( isset( $decoded_control['repeat'] ) ) echo $selector . "{ background-repeat: " .esc_html( $decoded_control['repeat'] ). "}";
                  if( isset( $decoded_control['position'] ) ) echo $selector . "{ background-position:" .esc_html( $decoded_control['position'] ). "}";
                  if( isset( $decoded_control['attachment'] ) ) echo $selector . "{ background-attachment: " .esc_html( $decoded_control['attachment'] ). "}";
                  if( isset( $decoded_control['size'] ) ) echo $selector . "{ background-size: " .esc_html( $decoded_control['size'] ). "}";
               break;
            default: if( isset( $decoded_control[$type] ) ) echo $selector . "{ background: " .blogig_get_color_format( $decoded_control[$type] ). "}";
         }
      endif;
   }
endif;

// Text Color ( Variable Change Single )
if( ! function_exists( 'blogig_variable_color_single' ) ) :
   /**
   * Generate css code for top header color options
   *
   * @package Blogig
   * @since 1.0.0 
   */
   function blogig_variable_color_single( $selector, $control) {
      $decoded_control =  BD\blogig_get_customizer_option( $control );
      if( ! $decoded_control ) return;
         echo "body  { " . $selector . ": ".blogig_get_color_format($decoded_control).  ";}";
   }
endif;