	<?php
	$testimonials_background = get_theme_mod( 'swell_testimonials_background' );
	$testimonials_count = get_theme_mod( 'swell_testimonials_count' );
	?>
	<?php if($testimonials_count > 0) { ?>
	<section id="testimonials"  <?php if( $testimonials_background ) { ?> style="background-image: url('<?php echo $testimonials_background; ?>');" <?php }?> >
		<div class="flexslider">	
				<?php $home_testimonial_count = get_theme_mod('swell_testimonials_count'); ?>
				<?php
				$args = array(
					'ignore_sticky_posts' => 1,    	
					'post_type' => array(				
					'testimonial'					
					),
					'posts_per_page' => $home_testimonial_count,
				);
				$testimonials = new WP_Query( $args );		
				?>
				<ul class="slides">
					<?php while ($testimonials->have_posts()) : $testimonials->the_post(); ?>
					<li class="testimonial">	
						<?php the_post_thumbnail("swell_square_medium", array('class' => '', 'alt' => ''.the_title_attribute( 'echo=0' ).'', 'title' => ''.the_title_attribute( 'echo=0' ).'')); ?>
						<?php the_content(); ?>
						<span class="title"><?php the_title_attribute(); ?> </span>
					</li>
					
					<?php endwhile; ?>
				</ul>	
					<script type="text/javascript">
					//<![CDATA[
					jQuery(document).ready(function(){
					jQuery('#testimonials .flexslider').imagesLoaded(function() {		
						jQuery('#testimonials .flexslider').flexslider({
							slideshowSpeed: 8000,  
							directionNav: false,
							slideshow: false,				 				
							animation: 'fade',
							animationLoop: true
						});  
					});
					});
					//]]>
					</script>				
		</div>
	</section><!-- #testimonials -->
	<?php } ?>