<?php
/*
Template Name:Company
*/
?>

<?php get_header(); $options = get_desing_plus_option(); ?>

<div id="bread_crumb_wrapper">
		<?php get_template_part('breadcrumb'); ?>
</div>
<div id="contents" class="<?php echo $options['layout']; ?> clearfix">
<!-- mainColumn -->
<div id="mainColumn">
		<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();
			$custom_fields = get_post_custom($post->ID);
		?>
		<div id="page-title" class="headline2">
				<?php the_title(); ?>
		</div>
		<div id="page-wrapper">
				<div class="page">
						<?php if ( has_post_thumbnail() and $page=='1') { if ($options['show_thumbnail']) : ?>
						<div class="post_image">
								<?php the_post_thumbnail('size1'); ?>
						</div>
						<?php endif; }; ?>
						<?php the_content(__('Read more', 'tcd-w')); ?>
						<?php custom_wp_link_pages(); ?>

						<?php
							$company_info_label = $custom_field_template->get_post_meta($post->ID, 'company_info_label', false);
							$company_info_data = $custom_field_template->get_post_meta($post->ID, 'company_info_data', false);
							if ( is_array($company_info_label) ) {
						?>
						<div id="company_info">
								<?php if (!empty($custom_fields['company_info_headline'][0])) {  ?>
								<h3 class="headline1 mb30"><span><?php echo $custom_fields['company_info_headline'][0]; ?></span></h3>
								<?php }; ?>
								<dl class="clearfix">
										<?php foreach($company_info_label as $key => $val) { ?>
										<dt><?php echo wpautop($company_info_label[$key]); ?></dt>
										<dd><?php echo wpautop($company_info_data[$key]); ?></dd>
										<?php }; ?>
								</dl>
						</div>
						<?php }; ?>
						<?php if (!empty($custom_fields['company_map'][0])) {  ?>
						<div id="company_map_area" class="clearfix">
								<?php if (!empty($custom_fields['company_map_headline'][0])) {  ?>
								<h4 class="headline1 mb30"><span><?php echo $custom_fields['company_map_headline'][0]; ?></span></h4>
								<?php }; ?>
								<div id="company_map"> <?php echo $custom_fields['company_map'][0]; ?> </div>
								<?php if (!empty($custom_fields['company_map_desc'][0])) { ?>
								<div id="company_map_desc"> <?php echo wpautop($custom_fields['company_map_desc'][0]); ?> </div>
								<?php }; ?>
						</div>
						<?php }; ?>
						
				</div>
		</div>
		<?php endwhile; endif; ?>
</div>
<!-- /mainColumn -->
<!-- sideColumn -->
<?php get_template_part('sidebar'); ?>
<!-- /sideColumn -->
<?php get_footer(); ?>
