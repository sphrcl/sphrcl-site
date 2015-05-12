<?php
/**
 * @package swell
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	$featured_image = "";
	$c = ""; 
	if (is_single()) {
		if( has_post_thumbnail() ) { 
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'swell_full_width' ); 
			$c = "has-background";		
		}
	} 
	?>

	<header class="main entry-header <?php echo $c; ?>" style="#">
		
		<?php if (class_exists('MultiPostThumbnails')) : MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'secondary-image'); endif; ?>

		<div class="intro">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<hr class="short" />

			<p class="meta">			
				
					<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_term_list( $post->ID, 'skill', '', ', ' ); 
					
						if ( $categories_list) :
					?>
					<span class="cat-list">
						<?php echo strip_tags($categories_list); ?>
					</span>
					<?php endif; // End if categories ?>				
				
			</p><!-- .entry-meta -->
		</div>

			<?php // get_template_part( 'content-post-thumb' ); ?>
			<span class="overlay"></span>
	</header><!-- .entry-header -->
	
	<div class="body-wrap">
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'swell' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	
	</div><!-- .body-wrap -->
</article><!-- #post-## -->
