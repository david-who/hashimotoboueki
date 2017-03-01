<?php get_header(); $options = get_desing_plus_option(); ?>
	
	<div id="bread_crumb_wrapper">
		<ul id="bread_crumb" class="clearfix">
			<li class="home"><a href="<?php echo esc_url(home_url('/')); ?>"><span><?php _e('Home', 'tcd-w'); ?></span></a></li>
			<li><a href="<?php echo get_post_type_archive_link('press'); ?>"><?php echo $options['index_headline_news']; ?></a></li>
			<li class="last"><?php the_title(); ?></li>
		</ul>
	</div>
	
	<div id="contents" class="<?php echo $options['layout']; ?> clearfix">
		<!-- mainColumn -->
		<div id="mainColumn">
			<div id="page-title" class="headline2"><?php echo $options['index_headline_news']; ?></div>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div id="post-wrapper">
				<h2 id="single_title"><?php the_title(); ?></h2>
				<div class="post">
					<div id="post_meta" class="clearfix">
						<ul id="single_meta" class="clearfix meta">
							<li class="date"><?php the_time('Y.n.j'); ?></li>
						</ul>
						<?php if($options['show_bookmark']) { include('bookmark.php'); };?>
					</div>
					
					<?php the_content(__('Read more', 'tcd-w')); ?>
					<?php custom_wp_link_pages(); ?>
				</div>
				
				<?php if ($options['show_next_post']) : ?>
				<div id="previous_next_post" class="clearfix">
					<p id="previous_post"><?php previous_post_link('%link') ?></p>
					<p id="next_post"><?php next_post_link('%link') ?></p>
				</div>
				<?php endif; ?>
			</div>
<?php endwhile; endif; ?>
			
		</div>
		<!-- /mainColumn -->
		
		<!-- sideColumn -->
 <?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->
	
<?php get_footer(); ?>