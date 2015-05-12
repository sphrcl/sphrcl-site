<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package swell
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php 
			$featured_image = "";
			$c = ""; 	
			
				$blog_page_id = get_option('page_for_posts'); 
				$blog_page = get_page($blog_page_id);		
				if( has_post_thumbnail($blog_page_id) ) { 
					$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id($blog_page_id), 'swell_full_width' ); 
					$c = "has-background";		
				}?>
				<header class="main entry-header <?php echo $c; ?>" style="<?php echo 'background-image: url('.$featured_image[0].');' ?>">			
					<h1 class="entry-title"><h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'swell' ), '<span>' . get_search_query() . '</span>' ); ?></h1></h1>					
					<span class="overlay"></span>
				</header><!-- .entry-header -->
			
		
		<?php if ( have_posts() ) : ?>		

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php swell_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>