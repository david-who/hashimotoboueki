<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
     $options = get_desing_plus_option();
     if($options['use_ogp']) {
?>
<!--[if lt IE 9]><html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#" class="ie"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://ogp.me/ns#"><!--<![endif]-->
<?php } else { ?>
<!--[if lt IE 9]><html xmlns="http://www.w3.org/1999/xhtml" class="ie"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml"><!--<![endif]-->
<?php }; ?>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width" />
<title><?php seo_title(); ?></title>
<meta name="description" content="<?php seo_description(); ?>" />
<?php if($options['use_ogp']) { ogp(); }; ?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" /> 
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_enqueue_script( 'jquery' ); ?>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?> 
<?php wp_head(); ?>

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css<?php version_num(); ?>" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/comment-style.css<?php version_num(); ?>" type="text/css" />

<link rel="stylesheet" media="screen and (min-width:641px)" href="<?php bloginfo('template_url'); ?>/style_pc.css<?php version_num(); ?>" type="text/css" />
<link rel="stylesheet" media="screen and (max-width:640px)" href="<?php bloginfo('template_url'); ?>/style_sp.css<?php version_num(); ?>" type="text/css" />

<?php if (strtoupper(get_locale()) == 'JA') ://to fix the font-size for japanese font ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/japanese.css<?php version_num(); ?>" type="text/css" />
<?php endif; ?>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jscript.js<?php version_num(); ?>"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scroll.js<?php version_num(); ?>"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/comment.js<?php version_num(); ?>"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/rollover.js<?php version_num(); ?>"></script>
<!--[if lt IE 9]>
<link id="stylesheet" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style_pc.css<?php version_num(); ?>" type="text/css" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/ie.js<?php version_num(); ?>"></script>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie.css" type="text/css" />
<![endif]-->

<!--[if IE 7]>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/ie7.css" type="text/css" />
<![endif]-->

<?php if(is_front_page()) { ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.flexslider-min.js"></script>
<link href="<?php bloginfo('template_url'); ?>/js/flexslider.css" rel="stylesheet" type="text/css" />
<?php if($options['sliderbg']==0){ ?>
<script type="text/javascript" charset="utf-8">
	jQuery(window).on('load',function() {
		jQuery('.flexslider').flexslider({
			controlNav: false,
			directionNav: false,
			start: function() {
				jQuery('.flexslider .slides li img').boxCenter();
			},
			before: function() {
				jQuery('.flexslider .slides li img').boxCenter();
			},
			after: function() {
				jQuery('.flexslider .slides li img').boxCenter();
			}
		});
		jQuery('.flexslider .slides li img').boxCenter();

		var timer = false;
		jQuery(window).resize(function() {
			if (timer !== false) {
				clearTimeout(timer);
			}
			timer = setTimeout(function() {
				jQuery('.flexslider .slides li img').boxCenter();
			}, 0);
		});
	});
	jQuery.fn.boxCenter = function() {
		return this.each(function(){
			var w = jQuery(this).width();
<?php if(is_mobile()){ ?>
			var w2 = jQuery(window).width();
<?php }else{ ?>
			var w2 = Math.max(jQuery(window).width(), 1103);
<?php }; ?>
			var mleft = ((w2-w)/2);
			jQuery(this).css({"margin-left": + mleft+ "px"});
		});
	};
</script>
<?php }else{ ?>
<script type="text/javascript" charset="utf-8">
	jQuery(window).on('load',function() {
		jQuery('.flexslider').flexslider({
			controlNav: false,
			directionNav: false,
		});
	});
</script>
<?php }; ?>
<?php }; ?>

<!-- blend -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.blend-min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery("#global_menu a").blend();
		jQuery(".blendy").blend();
	});
</script>
<!-- /blend -->



<style type="text/css">
a:hover { color:#<?php echo $options['pickedcolor1']; ?>; }
.page_navi a:hover, #post_pagination a:hover, #wp-calendar td a:hover, #return_top:hover,
 #wp-calendar #prev a:hover, #wp-calendar #next a:hover, #footer #wp-calendar td a:hover, .widget_search #search-btn input:hover, .widget_search #searchsubmit:hover, .tcdw_category_list_widget a:hover, .tcdw_news_list_widget .month, .tcd_menu_widget a:hover, .tcd_menu_widget li.current-menu-item a, #submit_comment:hover
  { background-color:#<?php echo $options['pickedcolor1']; ?>; }

body { font-size:<?php echo $options['content_font_size']; ?>px; }
#header-wrapper{
	border-top-color: #<?php echo $options['pickedcolor1']; ?>;
}
#wrapper-light #global_menu ul ul li a {background: #<?php echo $options['pickedcolor1']; ?>;}
#wrapper-light #global_menu ul ul a:hover{background: #<?php echo $options['pickedcolor2']; ?>;}
#wrapper-dark #global_menu ul ul li a {background: #<?php echo $options['pickedcolor1']; ?>;}
#wrapper-dark #global_menu ul ul a:hover{background: #<?php echo $options['pickedcolor2']; ?>;}
#bread_crumb_wrapper{ background-color: #<?php echo $options['pickedcolor1']; ?>;}
.headline1{ border-left: solid 5px #<?php echo $options['pickedcolor1']; ?>;}
.headline2{ border-top: solid 5px #<?php echo $options['pickedcolor1']; ?>;}
.side_headline{ border-left: solid 5px #<?php echo $options['pickedcolor1']; ?>;}
.footer_headline{ color:#<?php echo $options['pickedcolor1']; ?>;}
<?php if($options['sliderbg']==0||is_mobile()){ ?>
<?php }else{ ?>
.flexslider { margin: 0 auto; position: relative; width: 1100px; height: 353px; zoom: 1; }
<?php }; ?>

<?php if ($options['use_break_word']){ ?>
.side_widget, #single_title, .footer_widget, #page-title, #company_info dd 
  { word-wrap:break-word; }
<?php }; ?>

<?php if($options['css_code']) { echo $options['css_code']; };?>
</style>
</head>

<body>
<div id="wrapper-<?php echo $options['site_style']; ?>">
	<div id="header-wrapper">
		<!-- header -->
		<div id="header">
			<div id="header-inner" class="clearfix">
				<div id="header-left">
					<!-- logo -->
					<?php the_dp_logo(); ?>
				</div>
   <?php if(!is_mobile()) { ?>
				<div id="header-right">
	<?php if($options['header_right']=='banner') : ?>
					<!-- header banner -->



<table id="01" width="695" height="100" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<a href="http://hashimotoboueki.jp/list/"><img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/header-2_01.jpg" width="152" height="49" alt=""></a></td>
		<td colspan="2">
			<a href="http://hashimotoboueki.jp/flow/"><img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/header-2_02.jpg" width="150" height="49" alt=""></a></td>
		<td colspan="2">
			<a href="http://hashimotoboueki.jp/wp-content/uploads/2015/12/kaitoridoisyo.pdf"><img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/header-2_03.jpg" width="206" height="49" alt=""></a></td>
		<td rowspan="2">
			<a href="http://hashimotoboueki.jp/satei/"><img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/header-2_04.jpg" width="187" height="99" alt=""></a></td>
	</tr>
	<tr>
		<td colspan="2">
			<a href="http://hashimotoboueki.jp/flow/flow1/"><img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/header-2_05.jpg" width="169" height="50" alt=""></a></td>
		<td colspan="2">
			<a href="http://hashimotoboueki.jp/list/"><img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/header-2_06.jpg" width="162" height="50" alt=""></a></td>
		<td>
			<a href="http://hashimotoboueki.jp/form/"><img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/header-2_07.jpg" width="177" height="50" alt=""></a></td>
	</tr>
	<tr>
		<td>
			<img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/spacer.gif" width="152" height="1" alt=""></td>
		<td>
			<img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/spacer.gif" width="17" height="1" alt=""></td>
		<td>
			<img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/spacer.gif" width="133" height="1" alt=""></td>
		<td>
			<img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/spacer.gif" width="29" height="1" alt=""></td>
		<td>
			<img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/spacer.gif" width="177" height="1" alt=""></td>
		<td>
			<img src="http://hashimotoboueki.jp/wp-content/uploads/2015/12/spacer.gif" width="187" height="1" alt=""></td>
	</tr>
</table>






					<!-- /header banner -->
   
	<?php elseif($options['header_right']=='menu') : ?>
					<!-- header menu -->
					<div id="header_menu_area">
 <?php if (has_nav_menu('header-menu')) { ?>

  <?php wp_nav_menu( array( 'theme_location' => 'header-menu' , 'menu_id' => 'header_menu', 'depth' => 1, 'container' => '' ) ); ?>
 <?php }; ?>
					</div>
					<!-- /header menu -->

	<?php elseif($options['header_right']=='search') : ?>
					<!-- search -->
					<div class="search_area">
						<?php if ($options['custom_search_id']) { ?>
						<form action="http://www.google.com/cse" method="get" id="searchform">
							<div>
								<input type="hidden" name="cx" value="<?php echo $options['custom_search_id']; ?>" />
								<input type="hidden" name="ie" value="UTF-8" />
							</div>
							<div id="search_button"><input type="submit" value="<?php _e('SEARCH','design-plus'); ?>" /></div>
							<div id="search_input"><input type="text" value="<?php _e('SEARCH','design-plus'); ?>" name="q" onfocus="if (this.value == '<?php _e('SEARCH','design-plus'); ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php _e('SEARCH','design-plus'); ?>';" /></div>
						</form>
						<?php } else { ?>
						<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
							<div id="search_button"><input type="submit" value="<?php _e('SEARCH','design-plus'); ?>" /></div>
							<div id="search_input"><input type="text" value="<?php _e('SEARCH','design-plus'); ?>" name="s" onfocus="if (this.value == '<?php _e('SEARCH','design-plus'); ?>') this.value = '';" onblur="if (this.value == '') this.value = '<?php _e('SEARCH','design-plus'); ?>';" /></div>
						</form>
						<?php }; ?>
					</div>
					<!-- /search -->
	<?php else: ?>
	<?php endif; ?>
				</div>
   <?php }; ?>   
				<a href="#" class="menu_button"><?php _e('menu', 'tcd-w'); ?></a>
			</div>
		</div>
		<!-- /header -->
		<!-- global menu -->
		<div id="global_menu" class="clearfix">
			<div id="global_menu_home"><a href="<?php echo bloginfo('url'); ?>">
<?php if($options['site_style']=='light') { ?>
<img src="<?php bloginfo('template_url'); ?>/images/home.png" alt="HOME" />
<?php } elseif($options['site_style']=='dark') { ?>
<img src="<?php bloginfo('template_url'); ?>/images/home2.png" alt="HOME" />
<?php }; ?>
</a></div>
 <?php if (has_nav_menu('global-menu')) { ?>
  <?php wp_nav_menu( array( 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
 <?php }; ?>
		</div>
		<!-- /global menu -->

 <!-- smartphone banner -->
 <?php if(is_mobile() and !is_home()) { ?>
 <?php if($options['mobile_ad_code1']||$options['mobile_ad_image1']) { ?>
 <div id="mobile_banner_top">
  <?php if ($options['mobile_ad_code1']) { ?>
   <?php echo $options['mobile_ad_code1']; ?>
  <?php } else { ?>
   <a href="<?php esc_attr_e( $options['mobile_ad_url1'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['mobile_ad_image1'] ); ?>" alt="" title="" /></a>
  <?php }; ?>
 </div>
 <?php }; ?>
 <?php }; ?>

	</div>
