<?php
/**
 * @package swell
 */

get_header(); ?>

	<div class="inner">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<h2><?php _e( 'Oops! That page can&rsquo;t be found.', 'swell' ); ?></h2>

				<p><?php _e( 'The page you are looking for could not be found. Try a different address, or search using the form below.', 'swell' ); ?></p>

				<?php get_search_form(); ?>

				<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

				<?php if ( swell_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
				<div class="widget widget_categories">
					<h2 class="widget-title"><?php _e( 'Most Used Categories', 'swell' ); ?></h2>
					<ul>
					<?php
						wp_list_categories( array(
							'orderby'    => 'count',
							'order'      => 'DESC',
							'show_count' => 1,
							'title_li'   => '',
							'number'     => 10,
						) );
					?>
					</ul>
				</div><!-- .widget -->
				<?php endif; ?>

			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
