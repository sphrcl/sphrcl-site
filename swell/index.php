<?php
/**
 * @package swell
 */

get_header(); ?>

	<div id="primary" class="blog-content archive content-area">
		<main id="main" class="site-main" role="main">
			
			<?php 
			$featured_image = "";
			$c = ""; 	
			if (is_blog() && !is_front_page()) {
				$blog_page_id = get_option('page_for_posts'); 
				$blog_page = get_page($blog_page_id);		
				if( has_post_thumbnail($blog_page_id) ) { 
					$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($blog_page_id), 'swell_full_width' ); 
					$c = "has-background";		
				}?>
				<header class="main entry-header <?php echo $c; ?>" style="<?php echo 'background-image: url('.$featured_image[0].');' ?>">			
					<h1 class="entry-title"><?php echo $blog_page->post_title; ?></h1>					
					<?php if( $blog_page->post_excerpt ) { ?>
					<hr class="short" />
					<span class="meta">			
						<?php echo $blog_page->post_excerpt; ?>		
					</span>	
					<?php } ?>	
					<span class="overlay"></span>
				</header><!-- .entry-header -->
			<?php	
			} 
			?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php swell_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
