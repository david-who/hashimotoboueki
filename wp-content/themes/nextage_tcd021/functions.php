<?php

// 管理バーの表示をOFFにする --------------------------------------------------------------------------------
add_filter( 'show_admin_bar', '__return_false' );

// 言語ファイルの読み込み --------------------------------------------------------------------------------
load_textdomain('tcd-w', dirname(__FILE__).'/languages/' . get_locale() . '.mo');


// テーマオプション --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/admin/theme-options.php' );


// 更新通知 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/update_notifier.php' );


// ウィジェットの読み込み ------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/widget/ad.php' );
require_once ( dirname(__FILE__) . '/widget/press_list.php' );
require_once ( dirname(__FILE__) . '/widget/recent.php' );
require_once ( dirname(__FILE__) . '/widget/styled_post_list1.php' );
require_once ( dirname(__FILE__) . '/widget/styled_post_list2.php' );





// enqueue -----------------------------------------------------------------------
function widget_admin_scripts() {
  wp_enqueue_script('thickbox');
  wp_enqueue_style('thickbox');
  wp_enqueue_script('media-upload');
  wp_enqueue_script('ml-widget-js', get_template_directory_uri().'/widget/js/script.js', '', '1', true);
}
add_action('admin_print_scripts', 'widget_admin_scripts');


// include stylesheet -----------------------------------------------------------------------
function widget_admin_styles() {
  wp_enqueue_style('ml-widget-style', get_template_directory_uri() . '/widget/css/style.css');
}
add_action('admin_print_styles', 'widget_admin_styles');


// おすすめ記事 PICKUP記事 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/recommend.php' );
require_once ( dirname(__FILE__) . '/functions/recommend2.php' );
require_once ( dirname(__FILE__) . '/functions/recommend3.php' );
require_once ( dirname(__FILE__) . '/functions/pickup.php' );



// meta title meta description  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/seo.php' );


// カスタムページリンク  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/custom_page_link.php' );


// OGP tag  --------------------------------------------------------------------------------
require get_template_directory() . '/functions/ogp.php';


//ロゴ画像用関数 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/header-logo.php' );
require_once ( dirname(__FILE__) . '/functions/footer-logo.php' );


// スタイルシートの読み込み --------------------------------------------------------------------------------
//add_action('admin_print_styles', 'my_admin_CSS');
//function my_admin_CSS() {
// wp_enqueue_style('myAdminCSS', get_bloginfo('stylesheet_directory').'/admin/my_admin.css');
//};
function my_admin_css() {
  wp_enqueue_style('theme-option-style', get_template_directory_uri() .'/admin/my_admin.css');
  wp_enqueue_style('cft-style', get_template_directory_uri().'/admin/cft/cft.css');
};
add_action('admin_print_styles', 'my_admin_css');

// javascriptの読み込み
function my_admin_scripts() {
  wp_enqueue_script('cft-script', get_template_directory_uri().'/admin/cft/cft.js', '', '1', true);
}
add_action('admin_print_scripts', 'my_admin_scripts');


// ビジュアルエディタ用スタイルシートの読み込み --------------------------------------------------------------------------------
add_editor_style();


// ユーザーエージェントを判定するための関数---------------------------------------------------------------------
function is_mobile() {

 $match = 0;

 $ua = array(
   'iPhone', // iPhone
   'iPod', // iPod touch
   'Android.*Mobile', // 1.5+ Android *** Only mobile
   'Windows.*Phone', // *** Windows Phone
   'dream', // Pre 1.5 Android
   'CUPCAKE', // 1.5+ Android
   'BlackBerry', // BlackBerry
   'webOS', // Palm Pre Experimental
   'incognito', // Other iPhone browser
   'webmate' // Other iPhone browser
 );

 $pattern = '/' . implode( '|', $ua ) . '/i';
 $match   = preg_match( $pattern, $_SERVER['HTTP_USER_AGENT'] );

 if ( $match === 1 ) {
   return TRUE;
 } else {
   return FALSE;
 }

}


// バージョン管理 ----------------------------------------------------------------------------------------------
function version_num() {

 if (function_exists('wp_get_theme')) {
  $theme_data = wp_get_theme();
 } else {
  $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
 };

 $current_version = $theme_data['Version'];

 echo "?ver=" . $current_version;

};


// ウィジェットの設定 ------------------------------------------------------------------------------
if ( function_exists('register_sidebar') ) {
    register_sidebar(array(
        'before_widget' => '<div class="side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline">',
        'after_title' => "</h3>\n",
        'name' => __('Index side widget', 'tcd-w'),
        'id' => 'index_side_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="top_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="headline2">',
        'after_title' => "</h3>\n",
        'name' => __('Index bottom widget', 'tcd-w'),
        'id' => 'index_bottom_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline">',
        'after_title' => "</h3>\n",
        'name' => __('Archive side widget', 'tcd-w'),
        'id' => 'archive_side_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline">',
        'after_title' => "</h3>\n",
        'name' => __('Single side widget', 'tcd-w'),
        'id' => 'single_side_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="footer_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="footer_headline">',
        'after_title' => "</h3>\n",
        'name' => __('Footer widget', 'tcd-w'),
        'id' => 'footer_widget'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline">',
        'after_title' => "</h3>\n",
        'name' => __('Index widget (for mobile)', 'tcd-w'),
        'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
        'id' => 'mobile_widget_index'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline">',
        'after_title' => "</h3>\n",
        'name' => __('Archive widget (for mobile)', 'tcd-w'),
        'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
        'id' => 'mobile_widget_archive'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="side_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="side_headline">',
        'after_title' => "</h3>\n",
        'name' => __('Single page widget (for mobile)', 'tcd-w'),
        'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
        'id' => 'mobile_widget_single'
    ));
    register_sidebar(array(
        'before_widget' => '<div class="footer_widget clearfix %2$s" id="%1$s">'."\n",
        'after_widget' => "</div>\n",
        'before_title' => '<h3 class="footer_headline">',
        'after_title' => "</h3>\n",
        'name' => __('Footer widget (for mobile)', 'tcd-w'),
        'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
        'id' => 'mobile_widget_footer'
    ));
}

// オリジナルの抜粋記事 --------------------------------------------------------------------------------
function new_excerpt($a) {

 if(has_excerpt()) { 

   $base_content = get_the_excerpt();
   $base_content = str_replace(array("\r\n", "\r", "\n"), "", $base_content);
   $trim_content = mb_substr($base_content, 0, $a ,"utf-8");

 } else {

   $base_content = get_the_content();
   $base_content = preg_replace('!<style.*?>.*?</style.*?>!is', '', $base_content);
   $base_content = preg_replace('!<script.*?>.*?</script.*?>!is', '', $base_content);
   $base_content = strip_tags($base_content);
   $trim_content = mb_substr($base_content, 0, $a ,"utf-8");
   $trim_content = mb_ereg_replace('&nbsp;', '', $trim_content);

 };

 echo $trim_content . '…';

};

function new_excerpt2($a) {

 if(has_excerpt()) { 

   $base_content = get_the_excerpt();
   $base_content = str_replace(array("\r\n", "\r", "\n"), "", $base_content);
   $trim_content = mb_substr($base_content, 0, $a ,"utf-8");
   $trim_content = str_replace(']]>', ']]&gt;', $trim_content);
   $trim_content = str_replace(array("\r\n", "\r", "\n"), "", $trim_content);
   $trim_content = htmlspecialchars($trim_content);
   if(preg_match("/。/", $trim_content)) { //指定した文字数内にある、最後の「。」以降をカットして表示
     mb_regex_encoding("UTF-8"); 
     $trim_content = mb_ereg_replace('。[^。]*$', '。', $trim_content);
     echo $trim_content;
   }else{ //指定した文字数内に「。」が無い場合は、指定した文字数の文章を表示し、末尾に「…」を表示
     echo $trim_content . '...';
   };

 } else {

   $base_content = get_the_content();
   $base_content = preg_replace('!<style.*?>.*?</style.*?>!is', '', $base_content);
   $base_content = preg_replace('!<script.*?>.*?</script.*?>!is', '', $base_content);
   $base_content = strip_tags($base_content);
   $trim_content = mb_substr($base_content, 0, $a ,"utf-8");
   $trim_content = mb_ereg_replace('&nbsp;', '', $trim_content);
   $trim_content = str_replace(']]>', ']]&gt;', $trim_content);
   $trim_content = str_replace(array("\r\n", "\r", "\n"), "", $trim_content);
   $trim_content = htmlspecialchars($trim_content);
   if(preg_match("/。/", $trim_content)) { //指定した文字数内にある、最後の「。」以降をカットして表示
     mb_regex_encoding("UTF-8"); 
     $trim_content = mb_ereg_replace('。[^。]*$', '。', $trim_content);
     echo $trim_content;
   }else{ //指定した文字数内に「。」が無い場合は、指定した文字数の文章を表示し、末尾に「…」を表示
     echo $trim_content . '...';
   };

 };

 //echo $trim_content . '…';

};


//抜粋からPタグを取り除く
remove_filter( 'the_excerpt', 'wpautop' );


// 記事タイトルの文字数制限 --------------------------------------------------------------------------------
function trim_title($num) {
 $base_title = get_the_title();
 $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
 $count_title = mb_strlen($trim_title,"utf-8");
 if($count_title > $num-1) {
  echo $trim_title . '…';
 } else {
  echo $trim_title;
 };
};



// ページナビ用 --------------------------------------------------------------------------------
function show_posts_nav() {
global $wp_query;
return ($wp_query->max_num_pages > 1);
};


// アイキャッチに文言を追加 --------------------------------------------------------------------------------
add_filter( 'admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction( $content ) {
 return $content .= '<p>' . __('Upload post thumbnail from here.', 'tcd-w') . '</p>';
};


//　ヘッダーから余分なMETA情報を削除 --------------------------------------------------------------------
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');


//　サムネイルの設定 --------------------------------------------------------------------------------
if (function_exists('add_theme_support')) {
add_theme_support('post-thumbnails');
add_image_size( 'size1', 700, 400, true );
add_image_size( 'size2', 60, 60, true );
add_image_size( 'size3', 100, 70, true );
add_image_size( 'size4', 300, 150, true );}


// カスタムメニューの設定 --------------------------------------------------------------------------------
if(function_exists('register_nav_menu')) {
 register_nav_menu( 'global-menu', __( 'Global menu', 'tcd-w' ) );
 register_nav_menu( 'header-menu', __( 'Header menu', 'tcd-w' ) );
}


//カスタム投稿「プレスリリース」を追加 ----------------------------------------------------------------

if ( function_exists('register_post_type') ) {
 $labels = array(
  'name' => __('Press Release', 'tcd-w'),
  'singular_name' => __('Press Release', 'tcd-w'),
  'add_new' => __('Add New', 'tcd-w'),
  'add_new_item' => __('Add New Item', 'tcd-w'),
  'edit_item' => __('Edit', 'tcd-w'),
  'new_item' => __('New item', 'tcd-w'),
  'view_item' => __('View Item', 'tcd-w'),
  'search_items' => __('Search Items', 'tcd-w'),
  'not_found' => __('Not Found', 'tcd-w'),
  'not_found_in_trash' => __('Not found in trash', 'tcd-w'), 
  'parent_item_colon' => ''
 );

 register_post_type('press', array(
  'label' => __('Press Release', 'tcd-w'),
  'labels' => $labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 6,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array('slug' => 'press'),
  'capability_type' => 'post',
  'has_archive' => true,
  'supports' => array('title','editor')
 ));
};

// プレスリリースアーカイブページの表示件数を変更
//function change_press_num($wp_query){
//  $options = get_desing_plus_option();
//  $press_archive_num = $options['press_archive_num'];
//  if($wp_query->is_main_query() && $wp_query->is_post_type_archive('press')){
//    $wp_query->set('posts_per_page',$press_archive_num);
//  }
//}
//add_action('pre_get_posts', 'change_press_num');


// カスタムコメント --------------------------------------------------------------------------------------

if (function_exists('wp_list_comments')) {
	// comment count
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $commentcount ) {
		global $id;
		$_commnets = get_comments('post_id=' . $id);
		$comments_by_type = &separate_comments($_commnets);
		return count($comments_by_type['comment']);
	}
}


function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>

 <li class="comment <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-comment';} else {echo 'guest-comment';} ?>" id="comment-<?php comment_ID() ?>">
  <div class="comment-meta clearfix">
   <div class="comment-meta-left">
  <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 35); } ?>
  
    <ul class="comment-name-date">
     <li class="comment-name">
<?php if (get_comment_author_url()) : ?>
<a id="commentauthor-<?php comment_ID() ?>" class="url <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-url';} else {echo 'guest-url';} ?>" href="<?php comment_author_url() ?>" rel="nofollow">
<?php else : ?>
<span id="commentauthor-<?php comment_ID() ?>">
<?php endif; ?>

<?php comment_author(); ?>

<?php if(get_comment_author_url()) : ?>
</a>
<?php else : ?>
</span>
<?php endif;  $options = get_option('tcd-w_options'); ?>
     </li>
     <li class="comment-date"><?php echo get_comment_time(__('F jS, Y', 'tcd-w')); if ($options['time_stamp']) : echo get_comment_time(__(' g:ia', 'tcd-w')); endif; ?></li>
    </ul>
   </div>

   <ul class="comment-act">
<?php if (function_exists('comment_reply_link')) { 
        if ( get_option('thread_comments') == '1' ) { ?>
    <li class="comment-reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span><span>'.__('REPLY','tcd-w').'</span></span>'))) ?></li>
<?php   } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-w'); ?></a></li>
<?php   }
      } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-w'); ?></a></li>
<?php } ?>
    <li class="comment-quote"><a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'comment');"><?php _e('QUOTE', 'tcd-w'); ?></a></li>
    <?php edit_comment_link(__('EDIT', 'tcd-w'), '<li class="comment-edit">', '</li>'); ?>
   </ul>

  </div>
  <div class="comment-content post" id="comment-content-<?php comment_ID() ?>">
  <?php if ($comment->comment_approved == '0') : ?>
   <span class="comment-note"><?php _e('Your comment is awaiting moderation.', 'tcd-w'); ?></span>
  <?php endif; ?>
  <?php comment_text(); ?>
  </div>

<?php } ?>