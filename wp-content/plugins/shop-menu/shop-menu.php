<?php
/*
Plugin Name: Shop Menu
Plugin URI:  http://residentbird.main.jp/bizplugin/
Description: 商品一覧、メニュー一覧を作成するプラグインです
Version:     1.4.0
Author:      Hideki Tanaka
Author URI:  http://residentbird.main.jp/bizplugin/
*/

if (!class_exists( 'WPAlchemy_MetaBox' ) ) {
	include_once( dirname(__FILE__) . "/wpalchemy/MetaBox.php" );
}
include_once( dirname(__FILE__) . "/admin-ui.php" );
$shopMenu = new ShopMenu();

// 选项设置
class SM{
	const VERSION = "1.4.0";
	const SHORTCODE = "showshopmenu";
	const SHORTCODE_PRICE = "showprice";
	const OPTIONS = "shop_memu_options";

	public static function get_option(){
		return get_option(self::OPTIONS); // 从 OPTION 表单中查询 shop_memu_options 选项
	}

	public static function update_option( $options ){
		if ( empty($options)){
			return;
		}
		update_option(self::OPTIONS, $options);
	}

	public static function enqueue_css_js(){
		wp_enqueue_style('shop-menu-style', plugins_url('shop-menu.css', __FILE__ ), array(), self::VERSION);
		wp_enqueue_script('shop-menu-js',   plugins_url('next-page.js',  __FILE__ ), array('jquery'), self::VERSION);
	}

	public static function localize_js(){
		wp_localize_script( 'shop-menu-js', 'SM_Setting', array(
				'ajaxurl' => admin_url('admin-ajax.php'),
				'action' => 'get_menu_ajax',
				'next_page' => '1'
		));
	}

	public static function get_dummy_img_tag(){
		$imgpath = plugin_dir_url( __FILE__ ) . "image/noimage.png";
		return "<img src='{$imgpath}'>";
	}
}

// 主类
class ShopMenu{

	var $adminUi;
	var $custom_metabox;

	public function __construct(){
		// 插件启用函数 on_activation
		register_activation_hook(__FILE__, array(&$this,'on_activation'));
		add_action( 'init', array(&$this,'on_init') );
		add_action( 'admin_init', array(&$this,'on_admin_init') );
		// 管理员菜单
		add_action( 'admin_menu', array(&$this, 'on_admin_menu'));
		add_action( 'after_setup_theme',  array(&$this, 'after_setup_theme'));
		add_action( 'wp_enqueue_scripts', array(&$this,'on_enqueue_sctipts'));
		add_action( 'wp_ajax_get_menu_ajax', array(&$this,'get_menu_ajax') );
		add_action( 'wp_ajax_nopriv_get_menu_ajax', array(&$this,'get_menu_ajax') );
		// 添加 Post 显示列标题
		add_filter( 'manage_shop_menu_posts_columns', array(&$this, 'manage_posts_columns'));
		// 添加 Post 显示列内容
		add_action( 'manage_shop_menu_posts_custom_column',  array(&$this, 'add_posts_column'), 10, 2);
		// 添加 快速编辑	内容
		add_action( 'quick_edit_custom_box', array(&$this, 'display_custom_quick_edit_box'), 10, 3 );
		// 显示快速编辑列
		add_action( 'admin_print_scripts-edit.php', array(&$this, 'add_price_enqueue_edit_scripts' ));
		// 保存 Post 内容
		add_action( 'save_post', array(&$this, 'save_shop_menu_meta' ));	
		// 分类目录
		add_filter( 'manage_edit-menu_type_columns', array(&$this, 'manage_menu_type_columns'));
		add_action( 'manage_menu_type_custom_column',array(&$this, 'add_shortcode_column'), 10, 4);
		// 嵌入插件快捷代码 [showshopmenu]
		add_shortcode( SM::SHORTCODE, array(&$this,'show_shortcode'));
		// 嵌入插件快捷代码 [showprice]
		add_shortcode( SM::SHORTCODE_PRICE, array(&$this,'show_price'));		
	}

	// 添加 quick-edit-box 自定义内容
	function display_custom_quick_edit_box( $column_name, $post_type ) {
		static $printNonce = TRUE;
		if ( $printNonce ) {
      	$printNonce = FALSE;
      	wp_nonce_field( plugin_basename( __FILE__ ), 'shop_menu_edit_nonce' );
		}

		?>
		<fieldset class="inline-edit-col-right">
      <div class="inline-edit-group">
        <label class="inline-edit-group">
        <?php 
        	switch ( $column_name ) {
         case 'price':
         	 echo "<span class='title'>价格</span>";
             echo "<input name='price' value=''>";
             break;
      	}
      	?>
      	</label>
      </div>
		</fieldset>
		<?php
	}
	
	// 添加 jquery 处理代码, 获取自定义列 数据
	function add_price_enqueue_edit_scripts() {
   	wp_enqueue_script( 'manage-wp-posts-using-bulk-quick-edit',
   		trailingslashit( plugin_dir_url( __FILE__ ) ) . 'bulk_quick_edit.js',
   		array( 'jquery', 'inline-edit-post' ), '', true );
	}

	// 保存 shop_menu 数据, 包括快速编辑
	function save_shop_menu_meta( $post_id ) {
		// don't save for autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
      
		/* in production code, $slug should be set only once in the plugin,
         preferably as a class property, rather than in each function that needs it.
		*/
		$slug = 'shop_menu';
		if ( $slug !== $_POST['post_type'] ) return;

		if ( !current_user_can( 'edit_post', $post_id ) ) return;
		// NOUNCE 安全验证
		$_POST += array("{$slug}_edit_nonce" => '');
		if ( !wp_verify_nonce( $_POST["{$slug}_edit_nonce"],
                           plugin_basename( __FILE__ ) ) )
		{
	   	return;
		}
		// meta_key: _shop_menu
		// value:    a:1:{s:5:"price";s:3:"920";}
		//           a:1:{s:5:"price";s:3:"920";}
		if ( isset( $_REQUEST['price'] ) ) {
			$value =mb_ereg_replace ("[^0-9]","", $_REQUEST['price']);
			if (empty($value)){
				$value = 0;
			}
			$data = array('price'=>"$value");
	   	update_post_meta( $post_id, $this->custom_metabox->get_the_id(), $data );
		}
	}

	function init_custom_metabox(){
		// 新建 Shop_Menu 文章时的显示框
		$this->custom_metabox = $simple_mb = new WPAlchemy_MetaBox(array
				(
						'id' => '_shop_menu',
						'title' => 'Shop Menu 数据',
						'template' => dirname(__FILE__) . '/meta-view.php',
						'hide_editor' => false,
						'save_filter' => array( &$this, 'valid_custom_metabox') ,
						'types' => array('shop_menu'),
				));
	}

	// 验证价格数据
	function valid_custom_metabox($meta, $post_id) {
		// 去除 Price 中非数字字符
		$meta['price'] = mb_ereg_replace ("[^0-9]","", $meta['price']);
		if (empty($meta['price'])){
			$meta['price'] = 0;
		}
		return $meta;
	}

	// 获取 Meta 数据
	function get_post_meta($post_id){
		return get_post_meta( $post_id, $this->custom_metabox->get_the_id(), true);
	}

	// 激活插件
	function on_activation() {
		// 注册插件菜单
		$this->register_shop_menu();
		// 更新插件页面链接
		flush_rewrite_rules();

		/*
		 * option 选项初始化
		*/
		$option = SM::get_option();
		if( $option ) {
			return;
		}
		$arr = array(
				"sm_show_price" => true,
				"sm_item_num" => 12,
				"sm_item_orderby" => "名称排序",
				"sm_item_order" => "升序",
				"sm_monetary_unit" => "円（税后）",
		);
		SM::update_option( $arr );
	}

	// init() 钩子
	function on_init() {
		$this->init_custom_metabox();
		$this->register_shop_menu();
	}

	// 1) 注册 shop_menu 类型
	function register_shop_menu(){
		// add_menu_page
		$labels = array(
				'menu_name' => '商品菜单插件', // 插件菜单名称
				'all_items' => '商品浏览',    // 子菜单名称
				'name' => '商品一览',         // 标题
				'add_new_item' => '新增商品', // 子菜单名称
		);
		// 文章类型功能   显示标题    编辑器      特色图像      修订版        页面属性:页面模板  友好名称
		$supports = array('title', 'editor', 'thumbnail', 'revisions', 'page-attributes', 'slug');
		$menu_setting = array(
				'labels' => $labels,  // 用来配置文章类型显示在后台的一些描述性文字
				'public' => true,
				'publicly_queryable' => true,
				'show_ui' => true,    // 生成一个默认的管理页面
				'query_var' => true,
				'rewrite' => true,
				'capability_type' => 'page',
				'hierarchical' => false,
				'menu_position' => null, // 在后台菜单中的位置
				'supports' => $supports, // 对文章类型的一些功能支持
				'has_archive' => true,
		);
		// 1.1) 注册自定义日志（文章）类型
		register_post_type( 'shop_menu', $menu_setting);
		$category = array(
				'label' => '商品类别',
				'public' => true,
				'show_ui' => true,
				'hierarchical' => true,
		);
		// 1.2) 注册自定义分类
		register_taxonomy( 'menu_type', 'shop_menu', $category);
	}
	
	// shop_menu （类型文章）条目列标题
	function manage_posts_columns($columns) {
		$columns['shop_category'] = "商品类别";
		unset( $columns['date'] ); // 从而 日期 列 在最后
		$columns['price'] = '价格'; // 增加一列, 但没有数据
		$columns['date']  = '日期';
		return $columns;
	}

	function manage_menu_type_columns($columns) {
		$columns['menu_shortcode'] = "助记代码";
		unset( $columns['description'] );
		return $columns;
	}

	// 增加 shop_menu 自定义列显示内容
	function add_posts_column($column_name, $post_id){
		// 商品类别
		if( $column_name == 'shop_category' ){
			$category = get_the_term_list($post_id, 'menu_type');
			if ( isset($category) && $category ){
				echo $category;
			}else{
				echo __('None');
			}
		}
		// 商品预览
		elseif( $column_name == 'price' ) {
			$price = call_user_func( array(&$this, 'show_price') );
			// 直接显示价格
			//echo $shopitem->price; 
			// 存储 post_id, 以便以后使用
			echo '<div id="price-' . $post_id . '">' . $price . '</div>';
		}
	}
	
	// 商品分类 ==> 列显示内容
	function add_shortcode_column( $out, $column_name, $theme_id ){
		$short = SM::SHORTCODE; 
		echo "<input type='text' value='[${short} id=${theme_id}]' size='18' readonly>";
	}

	function on_enqueue_sctipts() {
		if ( is_admin() ) {
			return;
		}
		SM::enqueue_css_js();
		SM::localize_js();
	}

	function on_admin_init() {
		$this->adminUi = new SMAdminUi(__FILE__);
	}

	public function on_admin_menu() {
		// 添加 设置 子菜单( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function )
		add_submenu_page( "edit.php?post_type=shop_menu", "ShopMenu 设置", "设置", 'administrator', __FILE__, array(&$this->adminUi, 'show_admin_page'));
	}

	public function after_setup_theme() {
		add_theme_support( 'post-thumbnails', array('shop_menu'));
	}

	/**
	 * shortcode
	 */
	function show_shortcode( $atts ){
		extract(shortcode_atts(array(
				'id' => null,
		), $atts));
		$info = new ShopMenuInfo( array(&$this, 'get_post_meta'), 0, $id);
		$category = $id;
		ob_start();
		include( dirname(__FILE__) . '/shop-menu-view.php');
		$contents = ob_get_contents();
		ob_end_clean();
		return $contents;
	}

	function show_price(){
		$post = get_post( get_the_ID() );
		if (empty($post)){
			return "";
		}
		$post_meta = call_user_func( array(&$this, 'get_post_meta'), $post->ID );
		$shopitem = new ShopMenuItem($post, $post_meta);
		return $shopitem->price;
	}

	/**
	 * Ajax
	 */
	function get_menu_ajax(){
		$page = absint( $_REQUEST['page'] );
		if ( $page == 0){
			die();
		}
		$category_id = absint( $_REQUEST['category'] );
		$info = new ShopMenuInfo( array(&$this, 'get_post_meta'), $page, $category_id );
		$charset = get_bloginfo( 'charset' );
		$info->next_page = $info->has_next ? $page + 1: null;
		$json = json_encode( $info );
		nocache_headers();
		header( "Content-Type: application/json; charset=$charset" );
		echo $json;
		die();
	}
}

// 商品信息
class ShopMenuInfo{
	var $items = array();
	var $has_next = false;
	var $show_price = true;
	var $window_open = false;

	public function __construct( $callback, $page = 0, $category_id = null){
		$options = SM::get_option();
		$this->show_price = $options['sm_show_price'];
		$this->window_open = isset( $options['sm_window_open'] ) ? $options['sm_window_open'] : false;
		$item_num = $options['sm_item_num'];

		$condition = array();
		$condition['post_type'] = 'shop_menu';
		if ( empty( $options['sm_item_orderby'] ) || $options['sm_item_orderby'] == '名称排序'){
			$condition['orderby'] = 'title';
		}else if( $options['sm_item_orderby'] == '日期排序' ){
			$condition['orderby'] = 'modified';
		}else{
			$condition['orderby'] = 'post_date';
		}
		$condition['order'] = ( isset($options['sm_item_order'] ) && $options['sm_item_order'] == '升序' ) ? 'asc' : 'desc';
		$condition['numberposts'] = $item_num + 1;
		$condition['offset'] = $page * $item_num;
		if ( isset($category_id) ){
			$terms = get_term_by( 'id', $category_id, 'menu_type');
			if ( $terms ){
				$condition['menu_type'] = $terms->slug;
			}
		}
		// 按条件获取文章
		$posts = get_posts( $condition );
		if ( !is_array($posts) ){
			return;
		}
		if ( count($posts) > $item_num){
			$this->has_next = true;
			array_pop ( $posts );
		}
		foreach($posts as $post){
			$post_meta = call_user_func( $callback, $post->ID );
			$this->items[] = new ShopMenuItem($post, $post_meta);
		}
	}
}

// 商品数据结构
class ShopMenuItem{
	var $title;
	var $url;
	var $price;
	var $row_price;
	var $img_tag;

	public function __construct( $post, $post_meta ){
		$this->title = esc_html( $post->post_title );
		$this->url = get_permalink($post->ID);
		$this->row_price = $post_meta['price'];
		$this->price = $this->get_format_price( $post_meta['price']);
		$this->img_tag = $this->get_thumbnail( $post->ID );
	}

	private function get_format_price($price){
		$options = SM::get_option();
		return number_format( $price ) . $options['sm_monetary_unit'];
	}

	private function get_thumbnail($id){
		$img_tag = get_the_post_thumbnail( $id, 'thumbnail' );
		if ( !empty($img_tag) ){
			return $img_tag;
		}
		return SM::get_dummy_img_tag();
	}
}

?>