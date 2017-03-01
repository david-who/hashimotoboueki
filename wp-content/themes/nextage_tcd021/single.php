<?php get_header(); $options = get_desing_plus_option(); ?>


	<div id="bread_crumb_wrapper">
		<?php get_template_part('breadcrumb'); ?>
	</div>
	
	<div id="contents" class="<?php echo $options['layout']; ?> clearfix">
		<!-- mainColumn -->
		<div id="mainColumn">
			<div id="page-title" class="headline2"><?php echo $options['index_headline_blog']; ?></div>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div id="post-wrapper">
				<h2 id="single_title"><?php the_title(); ?></h2>
				<div class="post">
					<div id="post_meta" class="clearfix">
						<?php if ($options['show_date'] or $options['show_category']) { ?>
						<ul id="single_meta" class="clearfix meta">
							<?php if ($options['show_date']) : ?><li class="date"><?php the_time('Y.n.j'); ?></li><?php endif; ?>
							<?php if ($options['show_category']) : ?><li class="post_category"><?php the_category(', '); ?></li><?php endif; ?>
						</ul>
						<?php }; ?>
						<?php if($options['show_bookmark']) { include('bookmark.php'); };?>
					</div>
					
					<?php if ( has_post_thumbnail() and $page=='1') { if ($options['show_thumbnail']) : ?><div class="post_image"><?php the_post_thumbnail('size1'); ?></div><?php endif; }; ?>
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
			
<?php // related post
	if ($options['show_related_post']) :
	$categories = get_the_category($post->ID);
	if ($categories) {
	$category_ids = array();
	foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		$args=array(
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'showposts'=>5,
			'orderby' => 'rand'
		);
	$my_query = new wp_query($args);
	$i = 1;
	if($my_query->have_posts()) {
?>
			<div id="related_post">
				<h3 class="headline1"><?php _e("Related post","tcd-w"); ?></h3>
				<ul>
				<?php while ($my_query->have_posts()) { $my_query->the_post(); ?>
					<li><a href="<?php the_permalink() ?>"><?php trim_title(32); ?></a></li>
				<?php $i++; }; ?>
				</ul>
			</div>
<?php }; }; wp_reset_query(); ?>
<?php endif; ?>

		</div>
		<!-- /mainColumn -->
		
		<!-- sideColumn -->
 <?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->
	
<?php get_footer(); ?>