<?php
/**
 * Template Name: Portfolio
 * @package swell
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	
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
		<!--<hr class="short" />
		<?php if( $post->post_excerpt ) { ?>
		<span class="meta">			
			<?php echo $post->post_excerpt; ?>		
		</span>	
		<?php } ?>	
		<span class="overlay"></span>-->
	</header><!-- .entry-header -->
	
	<div class="body-wrap">
	<?php while (have_posts()) : the_post(); ?>	
		<div id="portfolio-content">										
			<?php the_content(); ?>	
		</div>													
	<?php endwhile; ?>
	
	<?php $page_skills = get_post_meta($post->ID, "swell_page_skills", true); //See if there are any associated skills listed ?>
	
	<?php if ($page_skills) : // if there are a limited number of skills set ?>
		<?php $skill_slugs = ""; $skills = explode(",", $page_skills); ?>

		<?php if (sizeof($skills) > 1) : // if there is more than one skill, show the filter nav?>	
			<ul id="filter-nav" class="clearfix">
				<li class="all-btn"><a href="#" data-filter="*" class="selected"><?php _e('All', 'themetrust'); ?></a></li>

				<?php
				$j=1;					  
				foreach ($skills as $skill) {				
					$skill = get_term_by( 'slug', trim(htmlentities($skill)), 'skill');
					if($skill) {
						$skill_slug = $skill->slug;				

						$skill_slugs .= $skill_slug . ",";
		  				$a = '<li><a href="#" data-filter=".'.$skill_slug.'">';
						$a .= $skill->name;					
						$a .= '</a></li>';
						echo $a;
						echo "\n";
						$j++;
					}		  
				}?>
			</ul>
			<?php $skill_slugs = substr($skill_slugs, 0, strlen($skill_slugs)-1); ?>
		<?php else: ?>
			<?php $skill = $skills[0]; ?>
			<?php $s = get_term_by( 'name', trim(htmlentities($skill)), 'skill'); ?>
			<?php if($s) { $skill_slugs = $s->slug; } ?>
		<?php endif;		
		
		$temp_post = $post;
		$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 200,
			'post_type' => 'project',
			'skill' => $skill_slugs
		);
		$projects = new WP_Query( $args );		

	else : // if not, use all the skills ?>

		<!--<ul id="filter-nav" class="clearfix">
			<li class="all-btn"><a href="#" data-filter="*" class="selected"><?php _e('All', 'themetrust'); ?></a></li>
			<?php $j=1;
			$skills = get_terms('skill');
			foreach ($skills as $skill) {
				$a = '<li><a href="#" data-filter=".'.$skill->slug.'">';
		    	$a .= $skill->name;					
				$a .= '</a></li>';
				echo $a;
				echo "\n";
				$j++;
			}?>
		</ul> -->
		<?php
		$temp_post = $post;
		$args = array(
			'ignore_sticky_posts' => 1,
			'posts_per_page' => 200,
			'post_type' => 'project'			
		);
		$projects = new WP_Query( $args );

	endif; ?>

		<div id="projects" class="thumbs clearfix">
			<?php  while ( $projects->have_posts()) : $projects->the_post(); ?>
				<?php
					global $ttrust_config;
					$ttrust_config['isotope_class'] = '';

					$skills = get_the_terms( $post->ID, 'skill');
					if ( $skills ) {
					   foreach ( $skills as $skill ) {
					      $ttrust_config['isotope_class'] .= $skill->slug . " ";
					   }
					}
					$ttrust_config['isotope_class'] = substr( $ttrust_config['isotope_class'], 0, -1 );

					get_template_part( 'content-project-thumb' ); ?>
			<?php endwhile; ?>
		</div>
	</div>
	</div>
	<div align="center"><img align="middle" width="1000" src="http://sphericalcommunications.com/new/wp-content/uploads/2014/10/logos1.jpg" /></div>
	</main>
</div>

<?php get_footer(); ?>