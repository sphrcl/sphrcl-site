<?php
/**
 * @package swell
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="body-wrap">
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
			<span class="meta category">
				
				<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
					<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'swell' ) );
						if ( $categories_list && swell_categorized_blog() ) :
					?>
					
						<?php echo $categories_list; ?>
					
					<?php endif; // End if categories ?>		
				<?php endif; // End if 'post' == get_post_type() ?>
			</span><!-- .entry-meta -->
		<?php endif; ?>
		
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<hr class="short" />
		<?php if ( 'post' == get_post_type() ) : ?>
			<span class="meta date-author">
				<?php swell_posted_on(); swell_posted_by(); ?>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link"><?php comments_popup_link( __( 'No Comments', 'swell' ), __( '1 Comment', 'swell' ), __( '% Comments', 'swell' ) ); ?></span>
				<?php endif; ?>
			</span><!-- .entry-meta -->
		<?php endif; ?>

		<?php get_template_part( 'content-post-thumb'); ?>

	</header><!-- .entry-header -->

	<?php
		$show_excerpt = TRUE;
		if ( is_search() || $show_excerpt ) : // Display Excerpts on Option or Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<?php swell_more_link('button'); ?>		
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>	
	</div>
</article><!-- #post-## -->
