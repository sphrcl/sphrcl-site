	<?php
	$projects_count = get_theme_mod( 'swell_recent_projects_count' );
	?>
	<?php if($projects_count > 0) { ?>

	<section id="projects-home">
		
		<div id="projects" class="portfolio-content">

		<h1>featured projects</h1>

			<?php				
					$args = array(
						'ignore_sticky_posts' 	=> 1,
			    		'posts_per_page' 		=> get_theme_mod('swell_recent_projects_count'),
			    		'post_type' 			=> array('project'),
			    		'order' 	            => 'DESC'
					);			

				$projects = new WP_Query( $args ); ?>
				<?php
				global $ttrust_config;
				$ttrust_config['isotope_class'] = '';				
				?>
			<div class="thumbs clearfix">
				<?php  while ( $projects->have_posts() ) : $projects->the_post(); ?>
					<?php get_template_part( 'content-project-thumb' ); ?>
				<?php endwhile; ?>
			</div>
			
			<?php $portfolio_page_id = swell_get_portfolio_id(); ?>
			<?php if($portfolio_page_id) : ?>
			<div class="view-all">
			<a href="<?php echo esc_url( get_permalink( $portfolio_page_id ) ); ?>" class="button"><?php _e('View All', 'port'); ?></a>
			</div>
			<?php endif; ?>
			
		</div>
		
	</section><!-- #projects-home -->
		<section id="projects-home white">
		
		<div id="projects" class="portfolio-content">
			
			<header>
			<h2><?php echo wp_kses_post(get_theme_mod( 'swell_recent_projects_title' )); ?></h2>			
			<?php $portfolio_page_id = swell_get_portfolio_id(); ?>
			<?php echo wpautop(wp_kses_post( do_shortcode(get_theme_mod('swell_recent_projects_summary') )) ); ?>			
			</header>
				
			<?php				
					$args = array(
						'ignore_sticky_posts' 	=> 1,
			    		'posts_per_page' 		=> get_theme_mod('swell_recent_projects_count'),
			    		'post_type' 			=> array('project')
					);			

				$projects = new WP_Query( $args ); ?>
				<?php
				global $ttrust_config;
				$ttrust_config['isotope_class'] = '';				
				?>

			
			<?php $portfolio_page_id = swell_get_portfolio_id(); ?>
			<?php if($portfolio_page_id) : ?>

			<?php endif; ?>
			
		</div>
		
	</section><!-- #projects-home -->

	<?php } ?>