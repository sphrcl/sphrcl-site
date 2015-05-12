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

	<header class="main entry-header <?php echo $c; ?>" style="<?php echo 'background-image: url('.$featured_image[0].');' ?>">
		
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'swell' ) );
			if ( $categories_list && swell_categorized_blog() ) :
		?>
		<span class="meta category">
			<?php echo $categories_list; ?>
		</span>
		<?php endif; // End if categories ?>
		
		<?php the_title( '<h1 class="entry-title fl">', '</h1>' ); ?>

		<hr class="short" />

		<span class="meta date-author">
			<?php swell_posted_on(); swell_posted_by(); ?>			
		</span><!-- .entry-meta -->

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
