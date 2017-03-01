<?php
/*
Template Name:INDEX
*/
?>
<?php get_header(); $options = get_desing_plus_option(); ?>

<?php if ($options['slider_image1']) { ?>
	<!-- slider -->
	<div id="slider-wrapper" class="slider-bg_<?php echo $options['sliderbg']; ?>">
		<div id="slider-shadow"></div>
		<div class="flexslider">
			<ul class="slides">
     <?php for($i = 1; $i <= 5; $i++): ?>
      <?php if($options['slider_image'.$i]) { ?>
       <?php if($options['slider_url'.$i]) { ?>
        <li><a href="<?php esc_attr_e( $options['slider_url'.$i] ); ?>"><img src="<?php esc_attr_e( $options['slider_image'.$i] ); ?>" alt="" title="" /></a></li>
       <?php } else { ?>
        <li><img src="<?php esc_attr_e( $options['slider_image'.$i] ); ?>" alt="" title="" /></li>
       <?php }; ?>
      <?php }; ?> 
    <?php endfor; ?>
			</ul>
		</div>
	</div>
	<!-- /slider -->
<?php }; ?>
	
	<div id="contents" class="<?php echo $options['layout']; ?> clearfix">
		<!-- mainColumn -->
		<div id="mainColumn">
			<!-- topics -->
			<div class="headline1 clearfix">
				<h2><?php echo $options['index_headline_blog']; ?></h2>
				<?php if ($options['blogindex_url']) : ?>
				<div class="archive_btn"><a class="blendy" href="<?php esc_attr_e( $options['blogindex_url'] ); ?>"><?php _e("Older Posts","tcd-w"); ?></a></div>
				<?php endif; ?>
			</div>
			<ul class="top_list clear">
    <?php
         $args = array('post_type' => 'post', 'numberposts' => 5);
         $index_recent_post=get_posts($args);
         if ($index_recent_post) :
         foreach ($index_recent_post as $post) : setup_postdata ($post);
    ?>
				<li><span><?php the_time('Y.m.d'); ?></span><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
    <?php endforeach; else: ?>
				<li><?php _e("There is no registered post.","tcd-w"); ?></li>
    <?php endif; ?>
			</ul>
			<!-- /topics -->
			
			<!-- press release -->
			<div class="headline1">
				<h2><?php echo $options['index_headline_news']; ?></h2>
				<div class="archive_btn"><a class="blendy" href="<?php echo get_post_type_archive_link('press'); ?>"><?php _e("Older News","tcd-w"); ?></a></div>
			</div>
			<ul class="top_list clear">
    <?php
         $args = array('post_type' => 'press', 'numberposts' => 5);
         $news_post=get_posts($args);
         if ($news_post) :
         foreach ($news_post as $post) : setup_postdata ($post);
    ?>
				<li><span><?php the_time('Y.n.j'); ?></span><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
    <?php endforeach; else: ?>
				<li><?php _e("There is no registered news.","tcd-w"); ?></li>
    <?php endif; ?>
			</ul>
			<!-- /press release -->
			
			<!-- banner -->
<?php
	if($options['single_ad_code3']||$options['single_ad_image3']){
		$rdm=mt_rand(1,3);
	}else if($options['single_ad_code2']||$options['single_ad_image2']){
		$rdm=mt_rand(1,2);
	}else if($options['single_ad_code1']||$options['single_ad_image1']){
		$rdm=1;
	}else{
		$rdm=0;
	}
?>
<?php if($rdm!=0){ ?>
			<div class="top_banner">
<?php if ($options['single_ad_code'.$rdm]) { ?>
<?php echo $options['single_ad_code'.$rdm]; ?>
<?php } else { ?>
				<a href="<?php esc_attr_e( $options['single_ad_url'.$rdm] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['single_ad_image'.$rdm] ); ?>" alt="" title="" /></a>
<?php }; ?>
			</div>
<?php }; ?>
			<!-- /banner -->
			
			<!-- widget area -->
  <?php if(is_active_sidebar('index_bottom_widget')) { ?>
			<div id="top_widget_area">
   <?php dynamic_sidebar('index_bottom_widget'); ?>
			</div>
			<!-- /widget area -->
  <?php }; ?>

		</div>
		<!-- /mainColumn -->

		<!-- sideColumn -->
 <?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->
	
<?php get_footer(); ?>