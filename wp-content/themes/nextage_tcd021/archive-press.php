<?php get_header(); $options = get_desing_plus_option(); ?>
	
	<div id="bread_crumb_wrapper">
		<ul id="bread_crumb" class="clearfix">
			<li class="home"><a href="<?php echo esc_url(home_url('/')); ?>"><span><?php _e('Home', 'tcd-w'); ?></span></a></li>
			<li class="last"><?php _e('Press Release Archive', 'tcd-w'); ?></li>
		</ul>
	</div>
	
	<div id="contents" class="<?php echo $options['layout']; ?> clearfix">
		<!-- mainColumn -->
		<div id="mainColumn">
			<div id="page-title" class="headline2"><?php echo $options['index_headline_news']; ?></div>
			<ul class="top_list clear">
				<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
				<li><span><?php the_time('Y.n.j'); ?></span><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
				<?php endwhile; else: ?>
				<li class="no_post"><?php _e("There is no registered post.","tcd-w"); ?></li>
				<?php endif; ?>
			</ul>
			
			<?php include('navigation.php'); ?>
			
		</div>
		<!-- /mainColumn -->
		
		<!-- sideColumn -->
 <?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->
	
<?php get_footer(); ?>