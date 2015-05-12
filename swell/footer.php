<?php
/**
 * @package swell
 */
?>
</div> <!-- end middle -->
	<div id="footer">
	<div class="inside clear">
		<?php //Get the appropriate sidebar.
		if((get_post_type() == 'project' || is_page_template('page-portfolio.php')) && is_active_sidebar('footer_portfolio')) : dynamic_sidebar('footer_portfolio');
		elseif( is_front_page() && is_active_sidebar( 'footer_home' ) ) : $sidebar = 'footer_home';
		elseif( is_archive() && is_active_sidebar( 'footer_posts' ) ) : $sidebar = 'footer_posts';
		elseif( is_single() && is_active_sidebar( 'footer_posts' ) ) : $sidebar = 'footer_posts';
		elseif( is_home() && is_active_sidebar( 'footer_posts' ) ) : $sidebar = 'footer_posts';
		elseif( is_page() && is_active_sidebar( 'footer_pages' ) ) : $sidebar = 'footer_pages';
		else : $sidebar = 'footer_default';
		endif; ?>
		<?php if( swell_get_widgets_count( $sidebar ) > 0 ) : ?>
		<div class="main clear thumbs">
			
				<?php dynamic_sidebar( $sidebar ); ?>
			
		</div><!-- end footer main -->
		<?php endif; ?>

		<div class="secondary">
			
			<?php $footer_left = get_theme_mod( 'swell_footer_left' ); ?>
			<?php $footer_right = get_theme_mod( 'swell_footer_right' ); ?>
			<div class="left"><p><?php if( $footer_left ){ echo( $footer_left ); } else{ ?>&copy; <?php echo date( 'Y' );?> <a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a> All Rights Reserved.<?php }; ?></p></div>
			<?php if($footer_right) { ?>
			<div class="right"><p><?php echo $footer_right; ?></p></div>
			<?php } ?>
		</div><!-- end footer secondary-->
		</div><!-- end footer inside-->
	</div>

	<?php wp_footer(); ?>
</div>


	<script type="text/javascript" src="http://www.sphericalcommunications.com/new/wp-content/themes/swell/js/classie.js"></script>
	<script type="text/javascript" src="http://www.sphericalcommunications.com/new/wp-content/themes/swell/js/nav.js">	</script>


</body>
</html>