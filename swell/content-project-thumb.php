<?php
/**
 * @package swell
 */
?>
	<?php global $ttrust_config; ?>
	<div class="project small <?php echo $ttrust_config['isotope_class']; ?>" id="<?php echo $post->ID; ?>">
		<div class="inside">
			<a href="<?php echo get_post_meta($post->ID, 'spherical_link', true); ?>" rel="bookmark" alt="<?php the_title(); ?>" >
				<?php if( has_post_thumbnail() ) {
					the_post_thumbnail( 'swell_project_thumb', array( 'class' => '', 'alt' => '' . the_title_attribute( 'echo=0' ) . '', 'title' => '' . the_title_attribute( 'echo=0' ) . '' ) );
					} else {
						swell_video_thumbnail( $post->ID );
					}
				?>
				<span class="title"><span>
				<ul class="deliverables">
 					<li class="type"><?php echo get_post_meta($post->ID, 'spherical_social', true); ?></li> 
    				<li class="type"><?php echo get_post_meta($post->ID, 'spherical_webdesign', true); ?></li> 
    				<li class="type"><?php echo get_post_meta($post->ID, 'spherical_webdev', true); ?></li> 
    				<li class="type"><?php echo get_post_meta($post->ID, 'spherical_inbound', true); ?></li> 
				</ul></span></span>
				<span class="overlay"><span></span></span>
			</a>
		</div>
	</div>