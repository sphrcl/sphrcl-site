<?php $show_full_post = get_theme_mod('swell_post_show_full');
	$post_show_date = get_theme_mod('swell_post_show_date');
	$bg_image_post = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>

<div <?php post_class('small'); ?> style="background-image: url( '<?php echo $bg_image_post; ?>' );">
	
	<a href="<?php the_permalink() ?>" rel="bookmark" >
	<span class="inside">	
	
	<?php
		/* translators: used between list items, there is a space after the comma */
		$categories_list = swell_category_list($post->ID);;
		if ( $categories_list && swell_categorized_blog() ) :
	?>
	<span class="meta category">
		<?php echo $categories_list; ?>
	</span>
	<?php endif; // End if categories ?>
	
	<h2><?php the_title(); ?></h2>
	<span class="meta date">
		<?php swell_posted_on();?>		
	</span>
	</span>
	</a>
	<span class="overlay"></span>
	
</div>