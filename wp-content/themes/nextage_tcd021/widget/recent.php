<?php

// 「最近の投稿」ウィジェットを置き換える -----------------------------------------------------------------------
class My_WP_Widget_Recent_Posts extends WP_Widget_Recent_Posts {
	function My_WP_Widget_Recent_Posts() {
    	//parent::WP_Widget(false, $name = '最近の投稿（tcdバージョン）');
	    $widget_ops = array( 'classname' => 'tcdw_news_list_widget', 'description' => __('Displays news list.', 'tcd-w') ); // Widget Settings
	    $control_ops = array( 'id_base' => 'tcdw_news_list_widget' ); // Widget Control Settings
	    WP_Widget::__construct( 'tcdw_news_list_widget', __('Recent Posts (tcd ver)','tcd-w'), $widget_ops, $control_ops );
    }
	
	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
		if ( ! $number )
 			$number = 10;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul class="news_widget_list">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
				<?php if ( $show_date ) : ?>
                    <p class="news_date"><?php the_time('Y.n.j'); ?></p>
                <?php endif; ?>
				<a class="news_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
	}

}
add_action('widgets_init', create_function('', 'return register_widget("My_WP_Widget_Recent_Posts");'));


?>