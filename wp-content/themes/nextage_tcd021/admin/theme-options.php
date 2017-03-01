<?php

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );

/**
 * オプション初期値
 * @var array 
 */
global $dp_default_options;
$dp_default_options = array(
	'pickedcolor1' => '0077B3',
	'pickedcolor2' => '57BDCC',
	'logotop' => 0,
	'logoleft' => 0,
	'logotop2' => 0,
	'logoleft2' => 0,
	'content_font_size' => '14',
	'show_date' => 1,
	'show_category' => 1,
	'show_tag' => 1,
	'show_comment' => 1,
	'show_author' => 1,
	'show_trackback' => 1,
	'show_related_post' => 1,
	'show_next_post' => 1,
	'show_thumbnail' => 1,
	'show_bookmark' => 1,
	'show_rss' => 1,
	'twitter_url' => '',
	'facebook_url' => '',
	'custom_search_id' => '',
	'index_headline_news' => 'Press release',
	'index_headline_blog' => 'Topics',
	'header_ad_code1' => '',
	'header_ad_url1' => '',
	'header_ad_image1' => false,
	'header_ad_code2' => '',
	'header_ad_url2' => '',
	'header_ad_image2' => false,
	'header_ad_code3' => '',
	'header_ad_url3' => '',
	'header_ad_image3' => false,
	'single_ad_code1' => '',
	'single_ad_url1' => '',
	'single_ad_image1' => false,
	'single_ad_code2' => '',
	'single_ad_url2' => '',
	'single_ad_image2' => false,
	'single_ad_code3' => '',
	'single_ad_url3' => '',
	'single_ad_image3' => false,
	'side_ad_code1' => '',
	'side_ad_url1' => '',
	'side_ad_image1' => false,
	'side_ad_code2' => '',
	'side_ad_url2' => '',
	'side_ad_image2' => false,
	'side_ad_code3' => '',
	'side_ad_url3' => '',
	'side_ad_image3' => false,
	'mobile_ad_code1' => '',
	'mobile_ad_url1' => '',
	'mobile_ad_image1' => false,
	'mobile_ad_code2' => '',
	'mobile_ad_url2' => '',
	'mobile_ad_image2' => false,
	'use_ogp' => 0,
	'fb_admin_id' => '',
	'use_twitter_card' => 0,
	'twitter_account_name' => '',
	'site_style' => 'light',
	'header_right' => 'banner',
	'blogindex_url' => '',
	'sliderbg' => 0,
	'slider_image1' => false,
	'slider_image2' => false,
	'slider_image3' => false,
	'slider_image4' => false,
	'slider_image5' => false,
	'slider_url1' => '',
	'slider_url2' => '',
	'slider_url3' => '',
	'slider_url4' => '',
	'slider_url5' => '',
	'layout' => 'layout1',
	'footer_ad_code1' => '',
	'footer_ad_url1' => '',
	'footer_ad_image1' => false,
	'footer_ad_code2' => '',
	'footer_ad_url2' => '',
	'footer_ad_image2' => false,
	'footer_ad_code3' => '',
	'footer_ad_url3' => '',
	'footer_ad_image3' => false,
	'use_break_word' => 1,
	'css_code' => ''
);

/**
 * Design Plusのオプションを返す
 * @global array $dp_default_options
 * @return array 
 */
function get_desing_plus_option(){
	global $dp_default_options;
	return shortcode_atts($dp_default_options, get_option('dp_options', array()));
}



// カラーピッカーの準備 その他javascriptの読み込み
add_action('admin_print_scripts', 'my_admin_print_scripts');
function my_admin_print_scripts() {
  wp_enqueue_script('jscolor', get_template_directory_uri().'/admin/jscolor.js');
  wp_enqueue_script('jquery.cookieTab', get_template_directory_uri().'/admin/jquery.cookieTab.js');
}



// 画像アップロードの準備
function wp_gear_manager_admin_scripts() {
wp_enqueue_script('dp-image-manager', get_template_directory_uri().'/admin/image-manager.js', array('jquery', 'jquery-ui-draggable', 'imgareaselect'));
wp_enqueue_script('dp-image-manager2', get_template_directory_uri().'/admin/image-manager2.js', array('jquery', 'jquery-ui-draggable', 'imgareaselect'));
}
function wp_gear_manager_admin_styles() {
wp_enqueue_style('imgareaselect');
}
add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
add_action('admin_print_styles', 'wp_gear_manager_admin_styles');



// 登録
function theme_options_init(){
 register_setting( 'design_plus_options', 'dp_options', 'theme_options_validate' );
}


// ロード
function theme_options_add_page() {
 add_theme_page( __( 'Theme Options', 'tcd-w' ), __( 'Theme Options', 'tcd-w' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}


//スタイルの初期設定
global $site_style_options;
$site_style_options = array(
 'light' => array(
  'value' => 'light',
  'label' => __( 'Light', 'tcd-w' )
 ),
 'dark' => array(
  'value' => 'dark',
  'label' => __( 'Dark', 'tcd-w' )
 )
);

// レイアウトの初期設定
global $layout_options;
$layout_options = array(
 'right' => array(
  'value' => 'layout1',
  'label' => __( 'Right', 'tcd-w' ),
  'img' => 'right_side'
 ),
 'left' => array(
  'value' => 'layout2',
  'label' => __( 'Left', 'tcd-w' ),
  'img' => 'left_side'
 )
);

// スライダー背景の初期設定
global $sliderbg_options;
$sliderbg_options = array(
 'bg0' => array(
  'value' => '0',
  'label' => __( 'width:100%', 'tcd-w' ),
  'img' => '0'
 ),
 'bg1' => array(
  'value' => '1',
  'label' => __( 'Background image 1', 'tcd-w' ),
  'img' => '1'
 ),
 'bg2' => array(
  'value' => '2',
  'label' => __( 'Background image 2', 'tcd-w' ),
  'img' => '2'
 ),
 'bg3' => array(
  'value' => '3',
  'label' => __( 'Background image 3', 'tcd-w' ),
  'img' => '3'
 ),
 'bg4' => array(
  'value' => '4',
  'label' => __( 'Background image 4', 'tcd-w' ),
  'img' => '4'
 ),
 'bg5' => array(
  'value' => '5',
  'label' => __( 'Background image 5', 'tcd-w' ),
  'img' => '5'
 ),
 'bg6' => array(
  'value' => '6',
  'label' => __( 'Background image 6', 'tcd-w' ),
  'img' => '6'
 ),
 'bg7' => array(
  'value' => '7',
  'label' => __( 'Background image 7', 'tcd-w' ),
  'img' => '7'
 ),
 'bg8' => array(
  'value' => '8',
  'label' => __( 'Background image 8', 'tcd-w' ),
  'img' => '8'
 ),
 'bg9' => array(
  'value' => '9',
  'label' => __( 'Background image 9', 'tcd-w' ),
  'img' => '9'
 ),
 'bg10' => array(
  'value' => '10',
  'label' => __( 'Background image 10', 'tcd-w' ),
  'img' => '10'
 ),
 'bg11' => array(
  'value' => '11',
  'label' => __( 'Background image 11', 'tcd-w' ),
  'img' => '11'
 ),
 'bg12' => array(
  'value' => '12',
  'label' => __( 'Background image 12', 'tcd-w' ),
  'img' => '12'
 ),
 'bg13' => array(
  'value' => '13',
  'label' => __( 'Background image 13', 'tcd-w' ),
  'img' => '13'
 )
);


// ヘッダーの初期設定
global $header_right_options;
$header_right_options = array(
 'banner' => array(
  'value' => 'banner',
  'label' => __( 'Banner', 'tcd-w' )
 ),
 'menu' => array(
  'value' => 'menu',
  'label' => __( 'Menu', 'tcd-w' )
 ),
 'search' => array(
  'value' => 'search',
  'label' => __( 'Search', 'tcd-w' )
 )
);


// テーマオプション画面の作成
function theme_options_do_page() {
 global $site_style_options, $layout_options, $sliderbg_options, $header_right_options, $dp_upload_error;
 $options = get_desing_plus_option(); 

 if ( ! isset( $_REQUEST['settings-updated'] ) )
  $_REQUEST['settings-updated'] = false;


?>

<div class="wrap">
 <?php screen_icon(); echo "<h2>" . __( 'Theme Options', 'tcd-w' ) . "</h2>"; ?>

 <?php // 更新時のメッセージ
       if ( false !== $_REQUEST['settings-updated'] ) :
 ?>
 <div class="updated fade"><p><strong><?php _e('Updated', 'tcd-w');  ?></strong></p></div>
 <?php endif; ?>

 <?php /* ファイルアップロード時のメッセージ */ if(!empty($dp_upload_error['message'])): ?>
  <?php if($dp_upload_error['error']): ?>
   <div id="error" class="error"><p><?php echo $dp_upload_error['message']; ?></p></div>
  <?php else: ?>
   <div id="message" class="updated fade"><p><?php echo $dp_upload_error['message']; ?></p></div>
  <?php endif; ?>
 <?php endif; ?>
 
 <script type="text/javascript">
  jQuery(document).ready(function($){
   $('#my_theme_option').cookieTab({
    tabMenuElm: '#theme_tab',
    tabPanelElm: '#tab-panel'
   });
  });
 </script>

 <div id="my_theme_option">

 <div id="theme_tab_wrap">
  <ul id="theme_tab" class="cf">
   <li><a href="#tab-content1"><?php _e('Basic', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content2"><?php _e('Advance', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content3"><?php _e('Slider', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content4"><?php _e('Logo', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content5"><?php _e('Header Banner', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content6"><?php _e('Index Page Banner', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content7"><?php _e('Side Column Banner', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content8"><?php _e('Footer Banner', 'tcd-w');  ?></a></li>
   <li><a href="#tab-content9"><?php _e('Smartphone Banner', 'tcd-w');  ?></a></li>
  </ul>
 </div>

<form method="post" action="options.php" enctype="multipart/form-data">
 <?php settings_fields( 'design_plus_options' ); ?>

 <div id="tab-panel">

  <!-- #tab-content1 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content1">

   <?php // サイトカラー ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Site main color', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <input type="text" class="color" name="dp_options[pickedcolor1]" value="<?php esc_attr_e( $options['pickedcolor1'] ); ?>" />
     <input type="submit" class="button-primary" value="<?php echo __( 'Save Color', 'tcd-w' ); ?>" />
    </div>
    <p color="color_scheme" id="default_color1"><?php _e('Default color', 'tcd-w');  ?> ：0077B3</p>
   </div>

   <?php // サイトカラー２ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Site secondary color', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <input type="text" class="color" name="dp_options[pickedcolor2]" value="<?php esc_attr_e( $options['pickedcolor2'] ); ?>" />
     <input type="submit" class="button-primary" value="<?php echo __( 'Save Color', 'tcd-w' ); ?>" />
    </div>
    <p color="color_scheme" id="default_color2"><?php _e('Default color', 'tcd-w');  ?> ：57BDCC</p>
   </div>

   <?php // フォントサイズ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Font size', 'tcd-w');  ?></h3>
    <p><?php _e('Font size of single page and wp-page.', 'tcd-w');  ?></p>
    <div class="theme_option_input">
     <input id="dp_options[content_font_size]" class="font_size" type="text" name="dp_options[content_font_size]" value="<?php esc_attr_e( $options['content_font_size'] ); ?>" /><span>px</span>
    </div>
   </div>

   <?php // 投稿者名・タグ・コメント ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Display Setup', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <ul>
      <li><label><input id="dp_options[show_date]" name="dp_options[show_date]" type="checkbox" value="1" <?php checked( '1', $options['show_date'] ); ?> /> <?php _e('Display date', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_category]" name="dp_options[show_category]" type="checkbox" value="1" <?php checked( '1', $options['show_category'] ); ?> /> <?php _e('Display category', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_tag]" name="dp_options[show_tag]" type="checkbox" value="1" <?php checked( '1', $options['show_tag'] ); ?> /> <?php _e('Display tags', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_author]" name="dp_options[show_author]" type="checkbox" value="1" <?php checked( '1', $options['show_author'] ); ?> /> <?php _e('Display author', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_comment]" name="dp_options[show_comment]" type="checkbox" value="1" <?php checked( '1', $options['show_comment'] ); ?> /> <?php _e('Display comment', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_thumbnail]" name="dp_options[show_thumbnail]" type="checkbox" value="1" <?php checked( '1', $options['show_thumbnail'] ); ?> /> <?php _e('Display thumbnail at single post page', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_bookmark]" name="dp_options[show_bookmark]" type="checkbox" value="1" <?php checked( '1', $options['show_bookmark'] ); ?> /> <?php _e('Display bookmark at single post page', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_trackback]" name="dp_options[show_trackback]" type="checkbox" value="1" <?php checked( '1', $options['show_trackback'] ); ?> /> <?php _e('Display trackbacks at single post page', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_related_post]" name="dp_options[show_related_post]" type="checkbox" value="1" <?php checked( '1', $options['show_related_post'] ); ?> /> <?php _e('Display related post at single post page', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_next_post]" name="dp_options[show_next_post]" type="checkbox" value="1" <?php checked( '1', $options['show_next_post'] ); ?> /> <?php _e('Display next previous post link at single post page', 'tcd-w');  ?></label></li>
      <li><label><input id="dp_options[show_rss]" name="dp_options[show_rss]" type="checkbox" value="1" <?php checked( '1', $options['show_rss'] ); ?> /> <?php _e('Display RSS at header', 'tcd-w');  ?></label></li>
     </ul>
    </div>
   </div>

   <?php // Blog index ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Blog Index URL', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('Enter the URL of blog index.', 'tcd-w');  ?></p>
     <ul>
      <li>
       <input id="dp_options[blogindex_url]" class="regular-text" type="text" name="dp_options[blogindex_url]" value="<?php esc_attr_e( $options['blogindex_url'] ); ?>" />
      </li>
     </ul>
    </div>
   </div>

  <?php // 見出しの設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Other setting', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <ul>
      <li>
       <label style="display:inline-block; margin:0 20px 0 0;"><?php _e('Headline for Blog', 'tcd-w');  ?></label>
       <input id="dp_options[index_headline_blog]" class="regular-text" type="text" name="dp_options[index_headline_blog]" value="<?php esc_attr_e( $options['index_headline_blog'] ); ?>" />
      </li>
      <li>
       <label style="display:inline-block; margin:0 20px 0 0;"><?php _e('Headline for Press Release', 'tcd-w');  ?></label>
       <input id="dp_options[index_headline_news]" class="regular-text" type="text" name="dp_options[index_headline_news]" value="<?php esc_attr_e( $options['index_headline_news'] ); ?>" />
      </li>
     </ul>
    </div>
   </div>

   <?php // facebook twitter ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('twitter and facebook setup', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('When it is blank, twitter and facebook icon will not displayed on a site.', 'tcd-w');  ?></p>
     <ul>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('your twitter URL', 'tcd-w');  ?></label>
       <input id="dp_options[twitter_url]" class="regular-text" type="text" name="dp_options[twitter_url]" value="<?php esc_attr_e( $options['twitter_url'] ); ?>" />
      </li>
      <li>
       <label style="display:inline-block; min-width:140px;"><?php _e('your facebook URL', 'tcd-w');  ?></label>
       <input id="dp_options[facebook_url]" class="regular-text" type="text" name="dp_options[facebook_url]" value="<?php esc_attr_e( $options['facebook_url'] ); ?>" />
      </li>
     </ul>
    </div>
   </div>

   <?php // 検索の設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Using Google custom search', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('If you wan\'t to use google custom search for your wordpress, enter your google custom search ID.<br /><a href="http://www.google.com/cse/" target="_blank">Read more about Google custom search page.</a>', 'tcd-w');  ?></p>
     <label style="display:inline-block; margin:0 20px 0 0;"><?php _e('Google custom search ID', 'tcd-w');  ?></label>
     <input id="dp_options[custom_search_id]" class="regular-text" type="text" name="dp_options[custom_search_id]" value="<?php esc_attr_e( $options['custom_search_id'] ); ?>" />
    </div>
   </div>

   <?php // Break-wordを使用する ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Use "word-wrap:break-word;" CSS for title and excerpt', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <ul>
      <li><label><input id="dp_options[use_break_word]" name="dp_options[use_break_word]" type="checkbox" value="1" <?php checked( '1', $options['use_break_word'] ); ?> /> <?php _e('Use break-word', 'tcd-w');  ?></label></li>
     </ul>
    </div>
   </div>

   <?php // ユーザーCSS用の自由記入欄 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Free input area for user definition CSS.', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('Code example:<br /><strong>.example { font-size:12px; }</strong>', 'tcd-w');  ?></p>
     <textarea id="dp_options[css_code]" class="large-text" cols="50" rows="10" name="dp_options[css_code]"><?php echo esc_textarea( $options['css_code'] ); ?></textarea>
    </div>
   </div>

   <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content1 -->




  <!-- #tab-content2 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content2">

   <?php // スタイル設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Style setting', 'tcd-w');  ?></h3>
    <div class="theme_option_input layout_option">
     <fieldset class="cf"><legend class="screen-reader-text"><span><?php _e('Select Light or Dark style.', 'tcd-w');  ?></span></legend>
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $site_style_options as $option ) {
          $site_style_setting = $options['site_style'];
           if ( '' != $site_style_setting ) {
            if ( $options['site_style'] == $option['value'] ) {
             $checked = "checked=\"checked\"";
            } else {
             $checked = '';
            }
           }
     ?>
      <label class="description">
       <input type="radio" name="dp_options[site_style]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> />
       <?php echo $option['label']; ?>
      </label>
     <?php
          }
     ?>
     </fieldset>
    </div>
   </div>


   <?php // レイアウト設定 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Layout setting', 'tcd-w');  ?></h3>
    <div class="theme_option_input layout_option">
     <fieldset class="cf"><legend class="screen-reader-text"><span><?php _e('Layout', 'tcd-w');  ?></span></legend>
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $layout_options as $option ) {
          $layout_setting = $options['layout'];
           if ( '' != $layout_setting ) {
            if ( $options['layout'] == $option['value'] ) {
             $checked = "checked=\"checked\"";
            } else {
             $checked = '';
            }
           }
     ?>
      <label class="description">
       <input type="radio" name="dp_options[layout]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> />
       <img src="<?php bloginfo('template_url'); ?>/admin/<?php echo $option['img']; ?>.gif" alt="" title="" />
       <?php echo $option['label']; ?>
      </label>
     <?php
          }
     ?>
     </fieldset>
    </div>
   </div>




   <?php // Use OGP tag ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Facebook OGP setting', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <p><label><input id="dp_options[use_ogp]" name="dp_options[use_ogp]" type="checkbox" value="1" <?php checked( '1', $options['use_ogp'] ); ?> /> <?php _e('Use OGP', 'tcd-w');  ?></label></p>
     <p><?php _e('Your fb:admins ID', 'tcd-w');  ?> <input id="dp_options[fb_admin_id]" class="regular-text" type="text" name="dp_options[fb_admin_id]" value="<?php esc_attr_e( $options['fb_admin_id'] ); ?>" /></p>
    </div>
   </div>

   <?php // Use twitter card ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Twitter Cards setting', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <p><label><input id="dp_options[use_twitter_card]" name="dp_options[use_twitter_card]" type="checkbox" value="1" <?php checked( '1', $options['use_twitter_card'] ); ?> /> <?php _e('Use Twitter Cards', 'tcd-w');  ?></label></p>
     <p><?php _e('Your Twitter account name (exclude @ mark)', 'tcd-w');  ?> <input id="dp_options[twitter_account_name]" class="regular-text" type="text" name="dp_options[twitter_account_name]" value="<?php esc_attr_e( $options['twitter_account_name'] ); ?>" /></p>
     <p><?php _e('Register Twitter Cards from <a href="https://dev.twitter.com/docs/cards/validation/validator" target="_blank">Twitter Developer page</a>.<br /><a href="https://dev.twitter.com/docs/cards" target="_blank">Information about Twitter Cards</a>.', 'tcd-w'); ?></p>
    </div>
   </div>

   <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content2 -->




  <!-- #tab-content3 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content3">

   <?php // スライダー背景 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Slider setting', 'tcd-w');  ?></h3>
    <div class="theme_option_input layout_option">
     <fieldset class="cf"><legend class="screen-reader-text"><span><?php _e('Select the background image of slider', 'tcd-w');  ?></span></legend>
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $sliderbg_options as $option ) {
          $sliderbg_setting = $options['sliderbg'];
           if ( '' != $sliderbg_setting ) {
            if ( $options['sliderbg'] == $option['value'] ) {
             $checked = "checked=\"checked\"";
            } else {
             $checked = '';
            }
           }
     ?>
      <label class="description">
       <input type="radio" name="dp_options[sliderbg]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> />
       <img src="<?php bloginfo('template_url'); ?>/admin/slider_bg_thumb_<?php echo $option['img']; ?>.jpg" alt="" title="" />
       <?php echo $option['label']; ?>
      </label>
     <?php
          }
     ?>
     </fieldset>
    </div>
   </div>



  <p class="tab_desc"><?php _e('Please prepare the following picture size. Height:353px.', 'tcd-w');  ?></p>

  <?php for($i = 1; $i <= 5; $i++): ?>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Index Slider setup', 'tcd-w');  ?><?php echo $i; ?></h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">
     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Slider image.(Height 353px)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[slider_image<?php echo $i; ?>]" value="<?php esc_attr_e( $options['slider_image'.$i] ); ?>" /></div>
        <input type="file" name="slider_image_file_<?php echo $i?>" id="slider_image_file_<?php echo $i?>" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['slider_image'.$i]) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['slider_image'.$i] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['slider_image'.$i])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_slider_image'.$i) ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>
     <div class="sub_box">
      <h4><?php _e('Register URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[slider_url<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[slider_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['slider_url'.$i] ); ?>" />
      </div>
     </div>
    </div>
   </div>
  </div>
  <?php endfor; ?>

   <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content3 -->




  <!-- #tab-content4 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content4">

   <?php // ステップ１ ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Step 1 : Upload image to use for logo.', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('Upload image to use for logo from your computer.<br />You can resize your logo image in step 2 and adjust position in step 3.', 'tcd-w');  ?></p>
     <div class="button_area">
      <label for="dp_image"><?php _e('Select image to use for logo from your computer.', 'tcd-w');  ?></label>
      <input type="file" name="dp_image" id="dp_image" value="" />
      <input type="submit" class="button" value="<?php _e('Upload', 'tcd-w');  ?>" />
     </div>
     <?php if(dp_logo_exists()): $info = dp_logo_info(); ?>
     <div class="uploaded_logo">
      <h4><?php _e('Uploaded image.', 'tcd-w');  ?></h4>
      <div class="uploaded_logo_image" id="original_logo_size">
       <?php dp_logo_img_tag(false, '', '', 9999); ?>
      </div>
      <p><?php printf(__('Original image size : width %1$dpx, height %2$dpx', 'tcd-w'), $info['width'], $info['height']); ?></p>
     </div>
     <?php else: ?>
     <div class="uploaded_logo">
      <h4><?php _e('The image has not been uploaded yet.<br />A normal text will be used for a site logo.', 'tcd-w');  ?></h4>
     </div>
     <?php endif; ?>
    </div>
   </div>

   <?php // ステップ２ ?>
   <?php if(dp_logo_exists()): ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Step 2 : Resize uploaded image.', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
    <?php if(dp_logo_exists()): ?>
     <p><?php _e('You can resize uploaded image.<br />If you don\'t need to resize, go to step 3.', 'tcd-w');  ?></p>
     <div class="uploaded_logo">
      <h4><?php _e('Please drag the range to cut off.', 'tcd-w');  ?></h4>
      <div class="uploaded_logo_image">
       <?php dp_logo_resize_base(9999); ?>
      </div>
      <div class="resize_amount">
       <label><?php _e('Ratio', 'tcd-w');  ?>: <input type="text" name="dp_resize_ratio" id="dp_resize_ratio" value="100" />%</label>
       <label><?php _e('Width', 'tcd-w');  ?>: <input type="text" name="dp_resized_width" id="dp_resized_width" />px</label>
       <label><?php _e('Height', 'tcd-w');  ?>: <input type="text" name="dp_resized_height" id="dp_resized_height" />px</label>
      </div>
      <div id="resize_button_area">
       <input type="submit" class="button-primary" value="<?php _e('Resize', 'tcd-w'); ?>" />
      </div>
     </div>
     <?php if($info = dp_logo_info(true)): ?>
     <div class="uploaded_logo">
      <h4><?php printf(__('Resized image : width %1$dpx, height %2$dpx', 'tcd-w'), $info['width'], $info['height']); ?></h4>
      <div class="uploaded_logo_image">
       <?php dp_logo_img_tag(true, '', '', 9999); ?>
      </div>
     </div>
     <?php endif; ?>
    <?php endif; ?>
    </div>
   </div>
   <?php endif; ?>

   <?php // ステップ３ ?>
   <?php if(dp_logo_exists()): ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Step 3 : Adjust position of logo.', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
    <?php if(dp_logo_exists()): ?>
     <p><?php _e('Drag the logo image and adjust the position.', 'tcd-w');  ?></p>
     <div id="tcd-w-logo-adjuster" class="ratio-<?php echo '760-760'; ?>">
      <?php if(dp_logo_resize_tag(760, 760, $options['logotop'], $options['logoleft'])): ?>
      <?php else: ?>
      <span><?php _e('Logo size is too big. Please resize your logo image.', 'tcd-w');  ?></span>
      <?php endif; ?>
     </div>
     <div class="hide">
      <label><?php _e('Top', 'tcd-w');  ?>: <input type="text" name="dp_options[logotop]" id="dp-options-logotop" value="<?php esc_attr_e( $options['logotop'] ); ?>" />px </label>
      <label><?php _e('Left', 'tcd-w');  ?>: <input type="text" name="dp_options[logoleft]" id="dp-options-logoleft" value="<?php esc_attr_e( $options['logoleft'] ); ?>" />px </label>
      <input type="button" class="button" id="dp-adjust-realvalue" value="adjust" />
     </div>
     <p><input type="submit" class="button" value="<?php _e('Save the position', 'tcd-w');  ?>" /></p>
    <?php endif; ?>
    </div>
   </div>
   <?php endif; ?>

   <?php // 画像の削除 ?>
   <?php if(dp_logo_exists()): ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Delete logo image.', 'tcd-w');  ?></h3>
    <div class="theme_option_input">
     <p><?php _e('If you delete the logo image, normal text will be used for a site logo.', 'tcd-w');  ?></p>
     <p><a class="button" href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_image_'.  get_current_user_id()); ?>" onclick="if(!confirm('<?php _e('Are you sure to delete logo image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w');  ?></a></p>
    </div>
   </div>
   <?php endif; ?>

  </div><!-- END #tab-content4 -->







  <!-- #tab-content5 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content5">

   <?php // ヘッダー表示内容 ?>
   <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e('Header setting', 'tcd-w');  ?></h3>
    <div class="theme_option_input layout_option">
     <fieldset class="cf"><legend class="screen-reader-text"><span><?php _e('Select the content of right side of header.', 'tcd-w');  ?></span></legend>
     <?php
          if ( ! isset( $checked ) )
          $checked = '';
          foreach ( $header_right_options as $option ) {
          $header_right_setting = $options['header_right'];
           if ( '' != $header_right_setting ) {
            if ( $options['header_right'] == $option['value'] ) {
             $checked = "checked=\"checked\"";
            } else {
             $checked = '';
            }
           }
     ?>
      <label class="description">
       <input type="radio" name="dp_options[header_right]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php echo $checked; ?> />
       <?php echo $option['label']; ?>
      </label>
     <?php
          }
     ?>
     </fieldset>
    </div>
   </div>


  <?php // ヘッダー広告の登録 -------------------------------------------------------------------------------------------- ?>
  <p class="tab_desc"><?php _e('You can register advertising up to three. Registered ad will appear in random.', 'tcd-w'); ?></p>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Header banner setup.', 'tcd-w'); ?>1</h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[header_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[header_ad_code1]"><?php echo esc_textarea( $options['header_ad_code1'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Recommend size. Width:468px Height:60px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[header_ad_image1]" value="<?php esc_attr_e( $options['header_ad_image1'] ); ?>" /></div>
        <input type="file" name="header_ad_image_file1" id="header_ad_image_file1" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['header_ad_image1']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['header_ad_image1'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['header_ad_image1'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_header_ad_image1') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[header_ad_url1]" class="regular-text" type="text" name="dp_options[header_ad_url1]" value="<?php esc_attr_e( $options['header_ad_url1'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Header banner setup.', 'tcd-w'); ?>2</h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[header_ad_code2]" class="large-text" cols="50" rows="10" name="dp_options[header_ad_code2]"><?php echo esc_textarea( $options['header_ad_code2'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Recommend size. Width:468px Height:60px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[header_ad_image2]" value="<?php esc_attr_e( $options['header_ad_image2'] ); ?>" /></div>
        <input type="file" name="header_ad_image_file2" id="header_ad_image_file2" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['header_ad_image2']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['header_ad_image2'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['header_ad_image2'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_header_ad_image2') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[header_ad_url2]" class="regular-text" type="text" name="dp_options[header_ad_url2]" value="<?php esc_attr_e( $options['header_ad_url2'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>


  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Header banner setup.', 'tcd-w'); ?>3</h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[header_ad_code3]" class="large-text" cols="50" rows="10" name="dp_options[header_ad_code3]"><?php echo esc_textarea( $options['header_ad_code3'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Recommend size. Width:468px Height:60px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[header_ad_image3]" value="<?php esc_attr_e( $options['header_ad_image3'] ); ?>" /></div>
        <input type="file" name="header_ad_image_file3" id="header_ad_image_file3" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['header_ad_image3']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['header_ad_image3'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['header_ad_image3'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_header_ad_image3') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[header_ad_url3]" class="regular-text" type="text" name="dp_options[header_ad_url3]" value="<?php esc_attr_e( $options['header_ad_url3'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content5 -->




  <!-- #tab-content6 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content6">


  <?php // トップページの広告 -------------------------------------------------------------------------------------------- ?>
  <p class="tab_desc"><?php _e('You can register advertising up to three. Registered ad will appear in random.', 'tcd-w'); ?></p>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Index page banner setup.(Show on middle of the page.)', 'tcd-w');  ?>1</h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[single_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code1]"><?php echo esc_textarea( $options['single_ad_code1'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Recommend size. Width:760px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[single_ad_image1]" value="<?php esc_attr_e( $options['single_ad_image1'] ); ?>" /></div>
        <input type="file" name="single_ad_image_file1" id="single_ad_image_file1" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['single_ad_image1']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['single_ad_image1'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['single_ad_image1'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_single_ad_image1') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[single_ad_url1]" class="regular-text" type="text" name="dp_options[single_ad_url1]" value="<?php esc_attr_e( $options['single_ad_url1'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Index page banner setup.(Show on middle of the page.)', 'tcd-w');  ?>2</h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[single_ad_code2]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code2]"><?php echo esc_textarea( $options['single_ad_code2'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Recommend size. Width:760px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[single_ad_image2]" value="<?php esc_attr_e( $options['single_ad_image2'] ); ?>" /></div>
        <input type="file" name="single_ad_image_file2" id="single_ad_image_file2" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['single_ad_image2']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['single_ad_image2'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['single_ad_image2'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_single_ad_image2') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[single_ad_url2]" class="regular-text" type="text" name="dp_options[single_ad_url2]" value="<?php esc_attr_e( $options['single_ad_url2'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Index page banner setup.(Show on middle of the page.)', 'tcd-w');  ?>3</h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[single_ad_code3]" class="large-text" cols="50" rows="10" name="dp_options[single_ad_code3]"><?php echo esc_textarea( $options['single_ad_code3'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Recommend size. Width:760px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[single_ad_image3]" value="<?php esc_attr_e( $options['single_ad_image3'] ); ?>" /></div>
        <input type="file" name="single_ad_image_file3" id="single_ad_image_file3" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['single_ad_image3']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['single_ad_image3'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['single_ad_image3'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_single_ad_image3') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[single_ad_url3]" class="regular-text" type="text" name="dp_options[single_ad_url3]" value="<?php esc_attr_e( $options['single_ad_url3'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>


  <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content6 -->



  <!-- #tab-content7 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content7">


  <?php //サイドバーの広告 -------------------------------------------------------------------------------------------- ?>
  <p class="tab_desc"><?php _e('You can register advertising up to three. Registered ad will appear in random.', 'tcd-w'); ?><br />
<?php _e('Advertising that you set here will appear in the side column bottom of every page (if not set will remain hidden)', 'tcd-w'); ?></p>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Side Column banner setup.(Show on bottom of the sidebar.)', 'tcd-w');  ?>1</h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[side_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[side_ad_code1]"><?php echo esc_textarea( $options['side_ad_code1'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Recommend size. Width:300px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[side_ad_image1]" value="<?php esc_attr_e( $options['side_ad_image1'] ); ?>" /></div>
        <input type="file" name="side_ad_image_file1" id="side_ad_image_file1" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['side_ad_image1']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['side_ad_image1'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['side_ad_image1'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_side_ad_image1') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[side_ad_url1]" class="regular-text" type="text" name="dp_options[side_ad_url1]" value="<?php esc_attr_e( $options['side_ad_url1'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Side Column banner setup.(Show on bottom of the sidebar.)', 'tcd-w');  ?>2</h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[side_ad_code2]" class="large-text" cols="50" rows="10" name="dp_options[side_ad_code2]"><?php echo esc_textarea( $options['side_ad_code2'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Recommend size. Width:300px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[side_ad_image2]" value="<?php esc_attr_e( $options['side_ad_image2'] ); ?>" /></div>
        <input type="file" name="side_ad_image_file2" id="side_ad_image_file2" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['side_ad_image2']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['side_ad_image2'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['side_ad_image2'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_side_ad_image2') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[side_ad_url2]" class="regular-text" type="text" name="dp_options[side_ad_url2]" value="<?php esc_attr_e( $options['side_ad_url2'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Side Column banner setup.(Show on bottom of the sidebar.)', 'tcd-w');  ?>3</h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[side_ad_code3]" class="large-text" cols="50" rows="10" name="dp_options[side_ad_code3]"><?php echo esc_textarea( $options['side_ad_code3'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Recommend size. Width:300px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[side_ad_image3]" value="<?php esc_attr_e( $options['side_ad_image3'] ); ?>" /></div>
        <input type="file" name="side_ad_image_file3" id="side_ad_image_file3" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['side_ad_image3']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['side_ad_image3'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['side_ad_image3'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_side_ad_image3') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[side_ad_url3]" class="regular-text" type="text" name="dp_options[side_ad_url3]" value="<?php esc_attr_e( $options['side_ad_url3'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content7 -->



  <!-- #tab-content8 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content8">


  <?php // フッターの広告 -------------------------------------------------------------------------------------------- ?>
  <p class="tab_desc"><?php _e('You can register advertising up to three. Registered ad will appear in random.', 'tcd-w'); ?><br />
<?php _e('Advertising that you set here will appear in the left part of the footer area of of every page  (if not set will remain hidden)', 'tcd-w'); ?></p>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Footer banner setup.(Show on left of the footer.)', 'tcd-w');  ?>1</h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[footer_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[footer_ad_code1]"><?php echo esc_textarea( $options['footer_ad_code1'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Recommend size. Width:300px Height:250px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[footer_ad_image1]" value="<?php esc_attr_e( $options['footer_ad_image1'] ); ?>" /></div>
        <input type="file" name="footer_ad_image_file1" id="footer_ad_image_file1" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['footer_ad_image1']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['footer_ad_image1'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['footer_ad_image1'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_footer_ad_image1') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[footer_ad_url1]" class="regular-text" type="text" name="dp_options[footer_ad_url1]" value="<?php esc_attr_e( $options['footer_ad_url1'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Footer banner setup.(Show on left of the footer.)', 'tcd-w');  ?>2</h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[footer_ad_code2]" class="large-text" cols="50" rows="10" name="dp_options[footer_ad_code2]"><?php echo esc_textarea( $options['footer_ad_code2'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Recommend size. Width:300px Height:250px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[footer_ad_image2]" value="<?php esc_attr_e( $options['footer_ad_image2'] ); ?>" /></div>
        <input type="file" name="footer_ad_image_file2" id="footer_ad_image_file2" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['footer_ad_image2']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['footer_ad_image2'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['footer_ad_image2'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_footer_ad_image2') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[footer_ad_url2]" class="regular-text" type="text" name="dp_options[footer_ad_url2]" value="<?php esc_attr_e( $options['footer_ad_url2'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Footer banner setup.(Show on left of the footer.)', 'tcd-w');  ?>3</h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[footer_ad_code3]" class="large-text" cols="50" rows="10" name="dp_options[footer_ad_code3]"><?php echo esc_textarea( $options['footer_ad_code3'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.(Recommend size. Width:300px Height:250px;)', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[footer_ad_image3]" value="<?php esc_attr_e( $options['footer_ad_image3'] ); ?>" /></div>
        <input type="file" name="footer_ad_image_file3" id="footer_ad_image_file3" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['footer_ad_image3']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['footer_ad_image3'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['footer_ad_image3'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_footer_ad_image3') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[footer_ad_url3]" class="regular-text" type="text" name="dp_options[footer_ad_url3]" value="<?php esc_attr_e( $options['footer_ad_url3'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>


  <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content8 -->



  <!-- #tab-content9 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  -->
  <div id="tab-content9">

  <p class="tab_desc"><?php _e('This Adsense is displayed only on the user who accessed the site with the smartphone.', 'tcd-w');  ?></p>

  <?php // モバイル広告の登録（ページ上部） -------------------------------------------------------------------------------------------- ?>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Smartphone banner setup1. (Display on the top of a page)', 'tcd-w');  ?></h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[mobile_ad_code1]" class="large-text" cols="50" rows="10" name="dp_options[mobile_ad_code1]"><?php echo esc_textarea( $options['mobile_ad_code1'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[mobile_ad_image1]" value="<?php esc_attr_e( $options['mobile_ad_image1'] ); ?>" /></div>
        <input type="file" name="mobile_ad_image_file1" id="mobile_ad_image_file1" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['mobile_ad_image1']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['mobile_ad_image1'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['mobile_ad_image1'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_mobile_ad_image1') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[mobile_ad_url1]" class="regular-text" type="text" name="dp_options[mobile_ad_url1]" value="<?php esc_attr_e( $options['mobile_ad_url1'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>


  <?php // モバイル広告の登録（ページ下部） -------------------------------------------------------------------------------------------- ?>
  <div class="banner_wrapper">
   <h3 class="banner_headline"><?php _e('Smartphone banner setup2. (Display on the bottom of a page)', 'tcd-w');  ?></h3>
   <div class="theme_option_field cf">
    <div class="theme_option_input">

     <div class="sub_box">
      <h4><?php _e('Banner code', 'tcd-w');  ?></h4>
      <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
      <div class="theme_option_input">
       <textarea id="dp_options[mobile_ad_code2]" class="large-text" cols="50" rows="10" name="dp_options[mobile_ad_code2]"><?php echo esc_textarea( $options['mobile_ad_code2'] ); ?></textarea>
      </div>
     </div>
     <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>

     <div class="sub_box cf" style="margin:0 0 10px 0;">
      <h4><?php _e('Register banner image.', 'tcd-w');  ?></h4>
      <div class="image_box cf">
       <div class="upload_banner_button_area">
        <div class="hide"><input type="text" size="36" name="dp_options[mobile_ad_image2]" value="<?php esc_attr_e( $options['mobile_ad_image2'] ); ?>" /></div>
        <input type="file" name="mobile_ad_image_file2" id="mobile_ad_image_file2" />
        <input type="submit" class="button-primary" value="<?php echo __( 'Save Image', 'tcd-w' ); ?>" />
       </div>
       <?php if($options['mobile_ad_image2']) { ?>
        <div class="uploaded_banner_image">
         <img src="<?php esc_attr_e( $options['mobile_ad_image2'] ); ?>" alt="" title="" />
        </div>
        <?php if(dp_is_uploaded_img($options['mobile_ad_image2'])): ?>
        <div class="delete_uploaded_banner_image">
         <a href="<?php echo wp_nonce_url(admin_url('themes.php?page=theme_options'), 'dp_delete_mobile_ad_image2') ?>" class="button" onclick="if(!confirm('<?php _e('Are you sure to delete this image?', 'tcd-w'); ?>')) return false;"><?php _e('Delete Image', 'tcd-w'); ?></a>
        </div>
       <?php endif; ?>
       <?php }; ?>
      </div>
     </div>

     <div class="sub_box">
      <h4><?php _e('Register Target URL', 'tcd-w');  ?></h4>
      <div class="theme_option_input">
       <input id="dp_options[mobile_ad_url2]" class="regular-text" type="text" name="dp_options[mobile_ad_url2]" value="<?php esc_attr_e( $options['mobile_ad_url2'] ); ?>" />
      </div>
     </div>

    </div>
   </div>
  </div>

  <p class="submit"><input type="submit" class="button-primary" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></p>

  </div><!-- END #tab-content9 -->



  </div><!-- END #tab-panel -->

 </form>

</div>

</div>

<?php

 }


/**
 * チェック
 */
function theme_options_validate( $input ) {
 global $site_style_options, $layout_options, $sliderbg_options, $header_right_options;

 // 色の設定
 $input['pickedcolor1'] = wp_filter_nohtml_kses( $input['pickedcolor1'] );
 $input['pickedcolor2'] = wp_filter_nohtml_kses( $input['pickedcolor2'] );

 // フォントサイズ
 $input['content_font_size'] = wp_filter_nohtml_kses( $input['content_font_size'] );

 // 投稿者・タグ・コメント
 if ( ! isset( $input['show_date'] ) )
  $input['show_date'] = null;
  $input['show_date'] = ( $input['show_date'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_category'] ) )
  $input['show_category'] = null;
  $input['show_category'] = ( $input['show_category'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_tag'] ) )
  $input['show_tag'] = null;
  $input['show_tag'] = ( $input['show_tag'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_comment'] ) )
  $input['show_comment'] = null;
  $input['show_comment'] = ( $input['show_comment'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_trackback'] ) )
  $input['show_trackback'] = null;
  $input['show_trackback'] = ( $input['show_trackback'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_related_post'] ) )
  $input['show_related_post'] = null;
  $input['show_related_post'] = ( $input['show_related_post'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_next_post'] ) )
  $input['show_next_post'] = null;
  $input['show_next_post'] = ( $input['show_next_post'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_thumbnail'] ) )
  $input['show_thumbnail'] = null;
  $input['show_thumbnail'] = ( $input['show_thumbnail'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_rss'] ) )
  $input['show_rss'] = null;
  $input['show_rss'] = ( $input['show_rss'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_bookmark'] ) )
  $input['show_bookmark'] = null;
  $input['show_bookmark'] = ( $input['show_bookmark'] == 1 ? 1 : 0 );
 if ( ! isset( $input['show_author'] ) )
  $input['show_author'] = null;
  $input['show_author'] = ( $input['show_author'] == 1 ? 1 : 0 );

 // twitter,facebook URL
 $input['blogindex_url'] = wp_filter_nohtml_kses( $input['blogindex_url'] );
 $input['twitter_url'] = wp_filter_nohtml_kses( $input['twitter_url'] );
 $input['facebook_url'] = wp_filter_nohtml_kses( $input['facebook_url'] );

 // 検索の設定
 $input['custom_search_id'] = wp_filter_nohtml_kses( $input['custom_search_id'] );

 // break word CSSの設定
 if ( ! isset( $input['use_break_word'] ) )
  $input['use_break_word'] = null;
  $input['use_break_word'] = ( $input['use_break_word'] == 1 ? 1 : 0 );

 // オリジナルスタイルの設定
 $input['css_code'] = $input['css_code'];


 // サイトスタイルの設定
// if ( ! isset( $input['site_style'] ) )
//  $input['site_style'] = null;
// if ( ! array_key_exists( $input['site_style'], $site_style_options ) )
//  $input['site_style'] = null;

 // レイアウトの設定
// if ( ! isset( $input['layout'] ) )
//  $input['layout'] = null;
// if ( ! array_key_exists( $input['layout'], $layout_options ) )
//  $input['layout'] = null;

 // スライダー背景
// if ( ! isset( $input['sliderbg'] ) )
//  $input['sliderbg'] = null;
// if ( ! array_key_exists( $input['sliderbg'], $sliderbg_options ) )
//  $input['sliderbg'] = null;

 // ヘッダー表示内容
// if ( ! isset( $input['header_right'] ) )
//  $input['header_right'] = null;
// if ( ! array_key_exists( $input['header_right'], $header_right_options ) )
//  $input['header_right'] = null;

 // トップページのスライダー
 $input['slider_image1'] = wp_filter_nohtml_kses( $input['slider_image1'] );
 $input['slider_url1'] = wp_filter_nohtml_kses( $input['slider_url1'] );

 $input['slider_image2'] = wp_filter_nohtml_kses( $input['slider_image2'] );
 $input['slider_url2'] = wp_filter_nohtml_kses( $input['slider_url2'] );

 $input['slider_image3'] = wp_filter_nohtml_kses( $input['slider_image3'] );
 $input['slider_url3'] = wp_filter_nohtml_kses( $input['slider_url3'] );

 $input['slider_image4'] = wp_filter_nohtml_kses( $input['slider_image4'] );
 $input['slider_url4'] = wp_filter_nohtml_kses( $input['slider_url4'] );

 $input['slider_image5'] = wp_filter_nohtml_kses( $input['slider_image5'] );
 $input['slider_url5'] = wp_filter_nohtml_kses( $input['slider_url5'] );


 // ヘッダーの広告バナー
 $input['header_ad_code1'] = $input['header_ad_code1'];
 $input['header_ad_image1'] = wp_filter_nohtml_kses( $input['header_ad_image1'] );
 $input['header_ad_url1'] = wp_filter_nohtml_kses( $input['header_ad_url1'] );

 $input['header_ad_code2'] = $input['header_ad_code2'];
 $input['header_ad_image2'] = wp_filter_nohtml_kses( $input['header_ad_image2'] );
 $input['header_ad_url2'] = wp_filter_nohtml_kses( $input['header_ad_url2'] );

 $input['header_ad_code3'] = $input['header_ad_code3'];
 $input['header_ad_image3'] = wp_filter_nohtml_kses( $input['header_ad_image3'] );
 $input['header_ad_url3'] = wp_filter_nohtml_kses( $input['header_ad_url3'] );

 // トップページ中央の広告バナー
 $input['single_ad_code1'] = $input['single_ad_code1'];
 $input['single_ad_image1'] = wp_filter_nohtml_kses( $input['single_ad_image1'] );
 $input['single_ad_url1'] = wp_filter_nohtml_kses( $input['single_ad_url1'] );

 $input['single_ad_code2'] = $input['single_ad_code2'];
 $input['single_ad_image2'] = wp_filter_nohtml_kses( $input['single_ad_image2'] );
 $input['single_ad_url2'] = wp_filter_nohtml_kses( $input['single_ad_url2'] );

 $input['single_ad_code3'] = $input['single_ad_code3'];
 $input['single_ad_image3'] = wp_filter_nohtml_kses( $input['single_ad_image3'] );
 $input['single_ad_url3'] = wp_filter_nohtml_kses( $input['single_ad_url3'] );

 // サイドバー下部の広告バナー
 $input['side_ad_code1'] = $input['side_ad_code1'];
 $input['side_ad_image1'] = wp_filter_nohtml_kses( $input['side_ad_image1'] );
 $input['side_ad_url1'] = wp_filter_nohtml_kses( $input['side_ad_url1'] );

 $input['side_ad_code2'] = $input['side_ad_code2'];
 $input['side_ad_image2'] = wp_filter_nohtml_kses( $input['side_ad_image2'] );
 $input['side_ad_url2'] = wp_filter_nohtml_kses( $input['side_ad_url2'] );

 $input['side_ad_code3'] = $input['side_ad_code3'];
 $input['side_ad_image3'] = wp_filter_nohtml_kses( $input['side_ad_image3'] );
 $input['side_ad_url3'] = wp_filter_nohtml_kses( $input['side_ad_url3'] );

 // フッターの広告バナー
 $input['footer_ad_code1'] = $input['footer_ad_code1'];
 $input['footer_ad_image1'] = wp_filter_nohtml_kses( $input['footer_ad_image1'] );
 $input['footer_ad_url1'] = wp_filter_nohtml_kses( $input['footer_ad_url1'] );

 $input['footer_ad_code2'] = $input['footer_ad_code2'];
 $input['footer_ad_image2'] = wp_filter_nohtml_kses( $input['footer_ad_image2'] );
 $input['footer_ad_url2'] = wp_filter_nohtml_kses( $input['footer_ad_url2'] );

 $input['footer_ad_code3'] = $input['footer_ad_code3'];
 $input['footer_ad_image3'] = wp_filter_nohtml_kses( $input['footer_ad_image3'] );
 $input['footer_ad_url3'] = wp_filter_nohtml_kses( $input['footer_ad_url3'] );

 // モバイル用の広告バナー（上部）
 $input['mobile_ad_code1'] = $input['mobile_ad_code1'];
 $input['mobile_ad_image1'] = wp_filter_nohtml_kses( $input['mobile_ad_image1'] );
 $input['mobile_ad_url1'] = wp_filter_nohtml_kses( $input['mobile_ad_url1'] );

 // モバイル用の広告バナー（下部）
 $input['mobile_ad_code2'] = $input['mobile_ad_code2'];
 $input['mobile_ad_image2'] = wp_filter_nohtml_kses( $input['mobile_ad_image2'] );
 $input['mobile_ad_url2'] = wp_filter_nohtml_kses( $input['mobile_ad_url2'] );

 //OGPタグ関連
 if ( ! isset( $input['use_ogp'] ) )
  $input['use_ogp'] = null;
  $input['use_ogp'] = ( $input['use_ogp'] == 1 ? 1 : 0 );
 $input['fb_admin_id'] = wp_filter_nohtml_kses( $input['fb_admin_id'] );
 if ( ! isset( $input['use_twitter_card'] ) )
  $input['use_twitter_card'] = null;
  $input['use_twitter_card'] = ( $input['use_twitter_card'] == 1 ? 1 : 0 );
 $input['twitter_account_name'] = wp_filter_nohtml_kses( $input['twitter_account_name'] );

 // 見出しの設定
 $input['index_headline_news'] = wp_filter_nohtml_kses( $input['index_headline_news'] );
 $input['index_headline_blog'] = wp_filter_nohtml_kses( $input['index_headline_blog'] );


 //ロゴの位置
 if(isset($input['logotop'])){
	 $input['logotop'] = intval($input['logotop']);
 }
 if(isset($input['logoleft'])){
	 $input['logoleft'] = intval($input['logoleft']);
 }

 //ロゴの位置2
 if(isset($input['logotop2'])){
	 $input['logotop2'] = intval($input['logotop2']);
 }
 if(isset($input['logoleft2'])){
	 $input['logoleft2'] = intval($input['logoleft2']);
 }

 //ファイルアップロード
 if(isset($_FILES['dp_image'])){
	$message = _dp_upload_logo();
	add_settings_error('design_plus_options', 'default', $message['message'], ($message['error'] ? 'error' : 'updated'));
 }

 //ファイルアップロード2
 if(isset($_FILES['dp_image2'])){
	$message = _dp_upload_footer_logo();
	add_settings_error('design_plus_options', 'default', $message['message'], ($message['error'] ? 'error' : 'updated'));
 }

 //画像リサイズ
 if(isset($_REQUEST['dp_logo_resize_left'], $_REQUEST['dp_logo_resize_top']) && is_numeric($_REQUEST['dp_logo_resize_left']) && is_numeric($_REQUEST['dp_logo_resize_top'])){
	$message = _dp_resize_logo();
	add_settings_error('design_plus_options', 'default', $message['message'], ($message['error'] ? 'error' : 'updated'));
 }

 //画像リサイズ2
 if(isset($_REQUEST['dp_logo_resize_left2'], $_REQUEST['dp_logo_resize_top2']) && is_numeric($_REQUEST['dp_logo_resize_left2']) && is_numeric($_REQUEST['dp_logo_resize_top2'])){
	$message = _dp_resize_footer_logo();
	add_settings_error('design_plus_options', 'default', $message['message'], ($message['error'] ? 'error' : 'updated'));
 }

 //スライダー画像の登録
 for($i = 1; $i <= 5; $i++){
	 if(isset($_FILES['slider_image_file_'.$i])){
		 //画像のアップロードに問題はないか
		 if($_FILES['slider_image_file_'.$i]['error'] === 0){
			 $name = sanitize_file_name($_FILES['slider_image_file_'.$i]['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['slider_image_file_'.$i]['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['slider_image'.$i] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
					break;
				}
			 }
		 }elseif($_FILES['slider_image_file_'.$i]['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['slider_image_file_'.$i]['error']), 'error');
			 continue;
		 }
	 }
 }	 




 //ヘッダーの広告バナー
 for($i = 1; $i <= 3; $i++){
	 if(isset($_FILES['header_ad_image_file'.$i])){
		 //画像のアップロードに問題はないか
		 if($_FILES['header_ad_image_file'.$i]['error'] === 0){
			 $name = sanitize_file_name($_FILES['header_ad_image_file'.$i]['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['header_ad_image_file'.$i]['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['header_ad_image'.$i] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
					//break;
				}
			 }
		 }elseif($_FILES['header_ad_image_file'.$i]['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['header_ad_image_file'.$i]['error']), 'error');
			 //continue;
		 }
	 }
 }	 

 //トップページ中央の広告バナー
 for($i = 1; $i <= 3; $i++){
	 if(isset($_FILES['single_ad_image_file'.$i])){
		 //画像のアップロードに問題はないか
		 if($_FILES['single_ad_image_file'.$i]['error'] === 0){
			 $name = sanitize_file_name($_FILES['single_ad_image_file'.$i]['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['single_ad_image_file'.$i]['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['single_ad_image'.$i] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
					//break;
				}
			 }
		 }elseif($_FILES['single_ad_image_file'.$i]['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['single_ad_image_file'.$i]['error']), 'error');
			 //continue;
		 }
	 }
 }


 //サイドバー下部の広告バナー
 for($i = 1; $i <= 3; $i++){
	 if(isset($_FILES['side_ad_image_file'.$i])){
		 //画像のアップロードに問題はないか
		 if($_FILES['side_ad_image_file'.$i]['error'] === 0){
			 $name = sanitize_file_name($_FILES['side_ad_image_file'.$i]['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['side_ad_image_file'.$i]['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['side_ad_image'.$i] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
					//break;
				}
			 }
		 }elseif($_FILES['side_ad_image_file'.$i]['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['side_ad_image_file'.$i]['error']), 'error');
			 //continue;
		 }
	 }
 }


 //フッターの広告バナー
  for($i = 1; $i <= 3; $i++){
	 if(isset($_FILES['footer_ad_image_file'.$i])){
		 //画像のアップロードに問題はないか
		 if($_FILES['footer_ad_image_file'.$i]['error'] === 0){
			 $name = sanitize_file_name($_FILES['footer_ad_image_file'.$i]['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['footer_ad_image_file'.$i]['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['footer_ad_image'.$i] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
					//break;
				}
			 }
		 }elseif($_FILES['footer_ad_image_file'.$i]['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['footer_ad_image_file'.$i]['error']), 'error');
			 //continue;
		 }
	 }
 }


 //スマホ用の広告バナー
	 if(isset($_FILES['mobile_ad_image_file1'])){
		 //画像のアップロードに問題はないか
		 if($_FILES['mobile_ad_image_file1']['error'] === 0){
			 $name = sanitize_file_name($_FILES['mobile_ad_image_file1']['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['mobile_ad_image_file1']['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['mobile_ad_image1'] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
					//break;
				}
			 }
		 }elseif($_FILES['mobile_ad_image_file1']['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['mobile_ad_image_file1']['error']), 'error');
			 //continue;
		 }
	 }


 //スマホ用の広告バナー
	 if(isset($_FILES['mobile_ad_image_file2'])){
		 //画像のアップロードに問題はないか
		 if($_FILES['mobile_ad_image_file2']['error'] === 0){
			 $name = sanitize_file_name($_FILES['mobile_ad_image_file2']['name']);
			 //ファイル形式をチェック
			 if(!preg_match("/\.(png|jpe?g|gif)$/i", $name)){
				 add_settings_error('design_plus_options', 'dp_uploader', sprintf(__('You uploaded %s but allowed file format is PNG, GIF and JPG.', 'tcd-w'), $name), 'error');
			 }else{
				//ディレクトリの存在をチェック
				if(
					(
						(file_exists(dp_logo_basedir()) && is_dir(dp_logo_basedir()) && is_writable(dp_logo_basedir()) )
							||
						@mkdir(dp_logo_basedir())
					)
						&&
					move_uploaded_file($_FILES['mobile_ad_image_file2']['tmp_name'], dp_logo_basedir().DIRECTORY_SEPARATOR.$name)
				){
					$input['mobile_ad_image2'] = dp_logo_baseurl().'/'.$name;
				}else{
					add_settings_error('default', 'dp_uploader', sprintf(__('Directory %s is not writable. Please check permission.', 'tcd-w'), dp_logo_basedir()), 'error');
					//break;
				}
			 }
		 }elseif($_FILES['mobile_ad_image_file2']['error'] !== UPLOAD_ERR_NO_FILE){
			 add_settings_error('default', 'dp_uploader', _dp_get_upload_err_msg($_FILES['mobile_ad_image_file2']['error']), 'error');
			 //continue;
		 }
	 }


 return $input;
}

?>