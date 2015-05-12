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
		<div class="halfsies fl"> <!-- web design -->
		<ul class="titles">	
			<li><img width="150px;" src="http://sphericalcommunications.com/new/wp-content/themes/swell/images/web-design.png" /></li>
			<li><h1><?php echo get_post_meta($post->ID, 'spherical_title2', true); ?></h1></li>
		</ul>				
				<div style="clear: both;"></div>	
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'swell' ),
					'after'  => '</div>',
				) );
			?>
			<br />
			<!-- <span class="edit-link"><a href="<?php echo get_post_meta($post->ID, 'spherical_link', true); ?>" class="post-edit-link">Read more</a></span> -->
			<br />	
				<div style="clear: both;"></div>		
			<?php echo get_post_meta($post->ID, 'spherical_para2', true); ?>
		</div> <!-- end webdesign -->

		<div class="middle-liner"></div>

		<div class="halfsies fr"> <!-- marketing -->
		<ul class="titles">	
			<li><img width="150px;" src="http://sphericalcommunications.com/new/wp-content/themes/swell/images/marketing.png" /></li>
			<li style="padding-top: 15px;"><h1><?php echo get_post_meta($post->ID, 'spherical_title', true); ?></h1></li>
		</ul>	
				<div style="clear: both;"></div>

			<p style="text-align: justify;"><?php echo get_post_meta($post->ID, 'spherical_para1', true); ?></p>

			<br />
			<!-- <span class="edit-link"><a href="<?php echo get_post_meta($post->ID, 'spherical_link2', true); ?>" class="post-edit-link">Read more</a></span> -->
			<br />
				<div style="clear: both;"></div>		

		</div> <!-- end marketing -->
		
		<div class="colorblock-header"></div>

	</div><!-- .entry-content -->
	<footer class="entry-footer">
	</footer><!-- .entry-footer -->
	</div>
	
</article><!-- #post-## -->
