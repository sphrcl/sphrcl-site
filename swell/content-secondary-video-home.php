<?php
/**
 * @package swell
 */

$link 	= get_theme_mod( 'swell_home_video_secondary' );
$video 	= swell_embed_parser( $link );
$featured_image = "";
while (have_posts()) : the_post();
		$excerpt = $post->post_excerpt;
		if( has_post_thumbnail($post->ID) ) { 
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'swell_full_width' ); 
			$c = "has-background";
		} 
endwhile; 
?>

<?php if($link || $excerpt) {?>
<section id="secondary-video-home" class="video-background<?php if( !$link ) echo ' no-video'; ?>" <?php if( $featured_image ) { ?> style="background-image: url('<?php echo $featured_image[0]; ?>');" <?php } ?>>
	<?php if($excerpt) { ?>
	<div class="content">
	<div class="inside">
		<div class="excerpt">
			<?php echo wpautop(do_shortcode($excerpt)); ?>
		</div>
	</div>
	</div>	
	<?php } ?>
	<?php if(!wp_is_mobile()) { // Do not show video if on mobile device ?>
	<div class="overlay"></div>
	<?php if( get_theme_mod( 'swell_pattern_overlay' ) ) { ?>		
	<div class="pattern-overlay"></div>
	<?php } ?>
	<?php swell_video_embed( $link ); ?>
	<?php } ?>

</section>
<?php } ?>