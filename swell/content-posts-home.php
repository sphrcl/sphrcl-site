<?php
$posts_count = get_theme_mod( 'swell_recent_posts_count' );
?>
<?php if($posts_count > 0) { ?>

<section id="blog">
	<?php $recent_posts_title = get_theme_mod( 'swell_recent_posts_title' ); ?>
	<?php $blog_page_id = get_option( 'page_for_posts' ); ?>
	<?php if( $recent_posts_title ):?>
		<header>
		<h2><?php echo wp_kses_post($recent_posts_title); ?></h2>
		<?php echo wpautop(wp_kses_post( do_shortcode(get_theme_mod('swell_recent_posts_summary') )) ); ?>			
		</header>		
		
	<?php endif; ?>
	
	<?php
	$args = array(
		'ignore_sticky_posts' => 1,
    	'posts_per_page' => $posts_count,
    	'post_type' => array(
			'post'
		)
	);
	?>
	<?php $recentPosts = new WP_Query( $args ); ?>
	<div class="posts">
	<?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
		<?php get_template_part( 'content-post-small' ); ?>
	<?php endwhile; ?>
	</div>
	<?php if( $blog_page_id ) : ?>
		<div class="view-all">
			<a href="<?php echo esc_url( get_permalink( $blog_page_id ) ); ?>" class="button"><?php _e('View All', 'swell'); ?></a>
		</div>
	<?php endif; ?>
</section><!-- #testimonials -->
<?php } ?>