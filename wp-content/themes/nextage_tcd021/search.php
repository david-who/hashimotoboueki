<?php get_header(); $options = get_desing_plus_option(); ?>

	<div id="bread_crumb_wrapper">
		<?php get_template_part('breadcrumb'); ?>
	</div>

	<div id="contents" class="<?php echo $options['layout']; ?> clearfix">

 <?php
      global $query_string;
      query_posts($query_string . "&post_type=post");
      if (have_posts()):
 ?>

		<!-- mainColumn -->
		<div id="mainColumn">
			<div id="page-title" class="headline2"><?php printf(__('Search results for - [ %s ]', 'tcd-w'), get_search_query()); ?></div>

			<?php $postmonth = false; ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if( $postmonth != get_post_time('Yn') ) : ?>
					<?php if ( $postmonth !== false ) : ?>
			</ul>
					<?php endif; ?>
			<h2 class="date_headline"><span><?php echo get_post_time('n月'); ?></span></h2>
			<ul class="post_list">
					<?php $postmonth = get_post_time('Yn'); ?>
				<?php endif; ?>
				<li>
					<?php if ($options['show_date'] or $options['show_category']) { ?>
					<ul class="meta clearfix">
						<?php if ($options['show_date']) : ?><li class="post_date"><?php the_time('Y.n.j'); ?></li><?php endif; ?>
						<?php if ($options['show_category']) : ?><li class="post_category"><?php the_category(', '); ?></li><?php endif; ?>
					</ul>
					<?php }; ?>
					<h3 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
				</li>
			<?php endwhile; ?>
			</ul>
			<?php else: ?>
		<!-- mainColumn -->
		<div id="mainColumn">
			<div id="page-title" class="headline2"><?php printf(__('Search results for - [ %s ]', 'tcd-w'), get_search_query()); ?></div>
			<p class="no_post"><?php _e("There is no registered post.","tcd-w"); ?></p>
			<?php endif; ?>
			<?php include('navigation.php'); ?>
		</div>
		<!-- /mainColumn -->
		
		<!-- sideColumn -->
 <?php get_template_part('sidebar'); ?>
		<!-- /sideColumn -->
	
<?php get_footer(); ?>