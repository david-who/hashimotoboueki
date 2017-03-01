<?php $options = get_desing_plus_option(); ?>

  <!-- smartphone banner -->
  <?php if(is_mobile() and !is_home()) { ?>
  <?php if($options['mobile_ad_code2']||$options['mobile_ad_image2']) { ?>
  <div id="mobile_banner_bottom">
   <?php if ($options['mobile_ad_code2']) { ?>
    <?php echo $options['mobile_ad_code2']; ?>
   <?php } else { ?>
    <a href="<?php esc_attr_e( $options['mobile_ad_url2'] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['mobile_ad_image2'] ); ?>" alt="" title="" /></a>
   <?php }; ?>
  </div>
  <?php }; ?>
  <?php }; ?>

	</div><!-- END #contents -->
	
	<div id="footer-wrapper">
		<div id="footer" class="clearfix">
			<div id="footer_description">
				<p><?php echo get_bloginfo('description'); ?></p>
				<h2><?php echo get_bloginfo('name'); ?></h2>
			</div>
    <?php if ($options['show_rss'] or $options['twitter_url'] or $options['facebook_url']) { ?>
    <ul class="social_link clearfix" id="footer_social_link">
     <?php if ($options['facebook_url']) : ?>
     <li class="facebook"><a class="target_blank blendy" href="<?php echo $options['facebook_url']; ?>">facebook</a></li>
     <?php endif; ?>
     <?php if ($options['twitter_url']) : ?>
     <li class="twitter"><a class="target_blank blendy" href="<?php echo $options['twitter_url']; ?>">twitter</a></li>
     <?php endif; ?>
     <?php if ($options['show_rss']) : ?>
     <li class="rss"><a class="target_blank blendy" href="<?php bloginfo('rss2_url'); ?>">rss</a></li>
     <?php endif; ?>
    </ul>
    <?php }; ?>
		</div>
		
 <?php if(!is_mobile()) { ?>
		<div id="footer_widget_wrap">
			<div id="footer_widget" class="clearfix">
<?php
	if($options['footer_ad_code3']||$options['footer_ad_image3']){
		$rdm=mt_rand(1,3);
	}else if($options['footer_ad_code2']||$options['footer_ad_image2']){
		$rdm=mt_rand(1,2);
	}else if($options['footer_ad_code1']||$options['footer_ad_image1']){
		$rdm=1;
	}else{
		$rdm=0;
	}
?>
<?php if($rdm!=0){ ?>
				<div id="footer_widget_banner">
				<div>
   <?php if ($options['footer_ad_code'.$rdm]) { ?>
    <?php echo $options['footer_ad_code'.$rdm]; ?>
   <?php } else { ?>
    <a href="<?php esc_attr_e( $options['footer_ad_url'.$rdm] ); ?>" class="target_blank"><img src="<?php esc_attr_e( $options['footer_ad_image'.$rdm] ); ?>" alt="" title="" /></a>
   <?php }; ?>
				</div>
				</div>
<?php }; ?>
   
  <?php if(is_active_sidebar('footer_widget')){ ?>
    <?php dynamic_sidebar('footer_widget'); ?>
  <?php }; ?>
			</div><!-- END #footer_widget -->
		</div><!-- END #footer_widget_wrap -->
 <?php } else { ?>
  <?php if(is_active_sidebar('mobile_widget_footer')){ ?>
		<div id="footer_widget_wrap">
			<div id="footer_widget" class="clearfix">
    <?php dynamic_sidebar('mobile_widget_footer'); ?>
			</div><!-- END #footer_widget -->
		</div><!-- END #footer_widget_wrap -->
  <?php }; ?>
 <?php }; ?>

		<div id="footer_copr">
			<p id="copyright"><?php _e('Copyright &copy;&nbsp; ', 'tcd-w'); ?><a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a> All rights reserved.</p>
		</div>
		
		<div id="return_wrapper">
			<a id="return_top" class="blendy"><?php _e('Return Top', 'tcd-w'); ?></a>
		</div>
		
	</div>
	
</div>
<?php wp_footer(); ?>
</body>
</html>
