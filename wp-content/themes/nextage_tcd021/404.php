<?php get_header(); $options = get_desing_plus_option(); ?>


	<div id="bread_crumb_wrapper">
		<ul id="bread_crumb" class="clearfix">
			<li class="home"><a href="<?php echo esc_url(home_url('/')); ?>"><span><?php _e('Home', 'tcd-w'); ?></span></a></li>
			<li class="last"><?php _e("Sorry, but you are looking for something that isn't here.","tcd-w"); ?></li>
		</ul>
	</div>
	
	<div id="contents" class="<?php echo $options['layout']; ?> clearfix">
		<!-- mainColumn -->
		<div id="mainColumn">
			<div id="page-title" class="headline2">404 Not Found</div>
			<p class="no_post"><?php _e("Sorry, but you are looking for something that isn't here.","tcd-w"); ?></p>
			<?php include('navigation.php'); ?>
		</div>
		<!-- /mainColumn -->
		
		<!-- sideColumn -->
 <?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->
	
<?php get_footer(); ?>