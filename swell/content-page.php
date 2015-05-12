<?php
/**
 * The template used for displaying page content in page-what-we-do.php
 *
 * @package swell
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php 
	$featured_image = "";
	$c = ""; 
	if (is_page()) {
		if( has_post_thumbnail() ) { 
			$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'swell_full_width' ); 
			$c = "has-background";		
		}
	} 
	?>

	<header class="main entry-header <?php echo $c; ?>" style="<?php echo 'background-image: url('.$featured_image[0].');' ?>">			
		<div class="entry-content">
			<div class="liner"></div>
			<?php the_title( '<h1 class="entry-title fl">', '</h1>' ); ?>
		</div>

		<?php if( $post->post_excerpt ) { ?>
			<hr class="short" />
		<span class="meta">			
			<?php echo $post->post_excerpt; ?>		
		</span>	
		<?php } ?>	
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
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'swell' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
	</div>
	
</article><!-- #p