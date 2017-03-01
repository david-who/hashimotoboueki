<?php get_header(); $options = get_desing_plus_option(); ?>
	
	<div id="bread_crumb_wrapper">
		<?php get_template_part('breadcrumb'); ?>
	</div>
	
	<div id="contents" class="<?php echo $options['layout']; ?> clearfix">
		<!-- mainColumn -->
		<div id="mainColumn">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div id="page-title" class="headline2"><?php the_title(); ?></div>
			<div id="page-wrapper">
				<div class="page">
					<?php if ( has_post_thumbnail() and $page=='1') { if ($options['show_thumbnail']) : ?><div class="post_image"><?php the_post_thumbnail('size1'); ?></div><?php endif; }; ?>
					<?php the_content(__('Read more', 'tcd-w')); ?>
					<?php custom_wp_link_pages(); ?>
				</div>
			</div>
<?php endwhile; endif; ?>
		</div>
		<!-- /mainColumn -->
		
		<!-- sideColumn -->
 <?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->
	
<?php get_footer(); ?>