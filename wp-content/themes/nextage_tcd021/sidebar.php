<?php $options = get_desing_plus_option(); ?>

		<div id="sideColumn">
<?php if(!is_mobile()) { ?>

<?php
	if(is_front_page() and is_active_sidebar('index_side_widget')){ dynamic_sidebar('index_side_widget'); }
	elseif((is_archive()||is_page()||is_home()) and is_active_sidebar('archive_side_widget') or is_search() and is_active_sidebar('archive_side_widget')) { dynamic_sidebar('archive_side_widget'); }
	elseif(is_single() and is_active_sidebar('single_side_widget') or is_page() and is_active_sidebar('single_side_widget')) { dynamic_sidebar('single_side_widget'); }
	else {
?>
			<div class="side_widget clearfix">
				<h3 class="side_headline"><?php _e("Recent post","tcd-w"); ?></h3>
				<ul class="news_widget_list">
				<?php $myposts = get_posts('numberposts=5'); foreach($myposts as $post) : ?>
					<li>
						<p class="news_date"><?php the_time('Y.n.j'); ?></p>
						<a class="news_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</li>
				<?php endforeach; ?>
				</ul>
			</div>

			<div class="side_widget clearfix">
				<h3 class="side_headline"><?php _e("Category","tcd-w"); ?></h3>
				<ul>
				<?php wp_list_categories('orderby=name&title_li='); ?>
				</ul>
			</div>

<?php }; ?>

<!-- side column banner -->
<?php
	if($options['side_ad_code3']||$options['side_ad_image3']){
		$rnd=mt_rand(1,3);
	}else if($options['side_ad_code2']||$options['side_ad_image2']){
		$rnd=mt_rand(1,2);
	}else if($options['side_ad_code1']||$options['side_ad_image1']){
		$rnd=1;
	}else{
		$rnd=0;
	}
?>
<?php if($rnd!=0){ ?>
			<div class="side_banner">
<?php if ($options['side_ad_code'.$rnd]) { ?>
<?php echo $options['side_ad_code'.$rnd]; ?>
<?php } else { ?>
				<a href="<?php esc_attr_e( $options['side_ad_url'.$rnd] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['side_ad_image'.$rnd] ); ?>" alt="" title="" /></a>
<?php }; ?>
			</div>
<?php }; ?>
<!-- /side column banner -->

<?php }else{ ?>

<?php // smartphone ?>
<?php
	if(is_front_page() and is_active_sidebar('mobile_widget_index')){ dynamic_sidebar('mobile_widget_index'); }
	elseif((is_archive()||is_page()||is_home()) and is_active_sidebar('mobile_widget_archive') or is_search() and is_active_sidebar('mobile_widget_archive')) { dynamic_sidebar('mobile_widget_archive'); }
	elseif(is_single() and is_active_sidebar('mobile_widget_single') or is_page() and is_active_sidebar('mobile_widget_single')) { dynamic_sidebar('mobile_widget_single'); }
	else {}
?>

<?php }; ?>
		</div>
