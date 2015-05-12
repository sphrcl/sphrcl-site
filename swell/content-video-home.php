<?php
$link 	= get_theme_mod( 'swell_home_video' );
$video 	= swell_embed_parser( $link );
?>

	<div id="video-background" class="video-background<?php if( !$link ) echo ' no-video'; ?>" <?php if( get_theme_mod( 'swell_home_image' ) ) { ?> style="background-image: url('<?php echo get_theme_mod( 'swell_home_image' ); ?>');" <?php } ?>>
		<div id="banner-content">
			<div class="inside">
			<div class="content"><?php echo wpautop(wp_kses_post( do_shortcode(get_theme_mod('swell_home_banner_text_main') )) ); ?>	
</div>			
			</div>
		</div>
		
		<?php if(!wp_is_mobile()) { // Do not show video if on mobile device ?>
		
		<div class="overlay">
			<!-- Loading animation container -->
			<div class="loading">
			    <!-- We make this div spin -->
			    <div class="spinner fa-spin">
			        <!-- Mask of the quarter of circle -->
			        <div class="mask">
			            <!-- Inner masked circle -->
			            <div class="maskedCircle"></div>
			        </div>
			    </div>
			</div>
		</div>
		<?php if( get_theme_mod( 'swell_pattern_overlay' ) ) { ?>		
		<div class="pattern-overlay"></div>
		<?php } ?>
		<?php swell_video_embed( $link ); ?>
		<?php } ?>
	</div>
	<div id="button-wrapper"><div id="down-button"></div></div>