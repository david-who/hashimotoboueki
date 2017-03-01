<ul id="bread_crumb" class="clearfix">
	<li class="home"><a href="<?php echo esc_url(home_url('/')); ?>"><span><?php _e('Home', 'tcd-w'); ?></span></a></li>

<?php if(is_paged()) { ?>
	<li class="last"><?php echo $options['index_headline_blog']; ?></li>

<?php } elseif (is_home()) { ?>
	<li class="last"><?php echo $options['index_headline_blog']; ?></li>

<?php } elseif (is_category()) { ?>
	<li class="last"><?php echo single_cat_title('', false); ?></li>

<?php } elseif(is_tag()) { ?>
	<li class="last"><?php echo single_tag_title('', false); ?></li>

<?php } elseif(is_day()) { ?>
	<li class="last"><?php echo get_the_time(__('F jS, Y', 'tcd-w')); ?></li>

<?php } elseif(is_month()) { ?>
	<li class="last"><?php echo get_the_time(__('F, Y', 'tcd-w')); ?></li>

<?php } elseif(is_year()) { ?>
	<li class="last"><?php echo get_the_time(__('Y', 'tcd-w')); ?></li>

<?php } elseif(is_author()) { global $wp_query; $curauth = $wp_query->get_queried_object(); //get the author info ?>
	<li class="last"><?php echo $curauth->display_name; ?></li>

<?php } elseif(is_search()) { ?>
	<li class="last"><?php _e("Search Result","tcd-w"); ?></li>

<?php } elseif(is_single()) { ?>
	<li><?php the_category(''); ?></li>
	<li class="last"><?php the_title(); ?></li>

<?php } elseif(is_page()) { ?>
	<?php foreach ( array_reverse(get_post_ancestors($post->ID)) as $parid ) { ?>
		<li><a href="<?php echo get_page_link( $parid );?>" title="<?php echo get_page($parid)->post_title; ?>">
		<?php echo get_page($parid)->post_title; ?></a></li>
	<?php } ?>
	<li class="last"><?php the_title(); ?></li>

<?php }; ?>
</ul>