<?php
/**
 * The template for displaying Archive pages.
 * @package swell
 */

get_header(); ?>

	<div id="primary" class="content-area">
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
					<h1 class="entry-title">
						<?php
							if ( is_category() ) :
								single_cat_title();

							elseif ( is_tag() ) :
								single_tag_title();

							elseif ( is_author() ) :
								printf( __( 'Author: %s', 'swell' ), '<span class="vcard">' . get_the_author() . '</span>' );

							elseif ( is_day() ) :
								printf( __( 'Day: %s', 'swell' ), '<span>' . get_the_date() . '</span>' );

							elseif ( is_month() ) :
								printf( __( 'Month: %s', 'swell' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'swell' ) ) . '</span>' );

							elseif ( is_year() ) :
								printf( __( 'Year: %s', 'swell' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'swell' ) ) . '</span>' );

							elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
								_e( 'Asides', 'swell' );

							elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
								_e( 'Galleries', 'swell');

							elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
								_e( 'Images', 'swell');

							elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
								_e( 'Videos', 'swell' );

							elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
								_e( 'Quotes', 'swell' );

							elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
								_e( 'Links', 'swell' );

							elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
								_e( 'Statuses', 'swell' );

							elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
								_e( 'Audios', 'swell' );

							elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
								_e( 'Chats', 'swell' );

							else :
								_e( 'Archives', 'swell' );

							endif;
						?>
					</h1>					
					<?php // Show an optional term description.		
					$term_description = term_description();
					if ( ! empty( $term_description ) ) {
					?>
					<hr class="short" />
					<span class="meta">			
						<?php echo $term_description; ?>		
					</span>	
					<?php } ?>	
					<span class="overlay"></span>
				</header><!-- .entry-header -->
			<?php	
			} 
			?>	
			

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
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
