<?php
/**
 * 	Swell by ThemeTrust © 2014
 *   =====================================================
 *	 1. 	Theme Setup
 *	 	1.1		Content Width
 *	 	1.2		Swell_Setup
 *		1.3		Post Image Sizes & Video Tracker
 *	 2. 	Header
 *	 	2.1		Swell Scripts
 *		2.2		Embed Formatter
 *		2.3		Embed Parser
 *		2.4		Customizer Head
 *	 3. Includes
 *		3.1		Template Tags
 *		3.2		Extra Functions
 *		3.3		Customizer Additions
 *		3.4		Jetpack Compatibility
 *		3.5		Widgets
 *	 4. Shortcodes
 *
 * @package swell
 */

//////////////////////////////////////////////////////////////
// 1. Theme Setup
/////////////////////////////////////////////////////////////

//	1.1 Content Width
if ( ! isset( $content_width ) ) {
	$content_width = 1000; /* This will have to be overridden. */
}

//	1.2 Swell_Setup
if ( ! function_exists( 'swell_setup' ) ) :
	function swell_setup() {

		// 1.2.1 Set Globals
		global $ttrust_config;

		$ttrust_config['theme'] 			= 'Swell ';
		$ttrust_config['version']		= '1.0';

		// 1.2.2 Make theme available for translation.
		load_theme_textdomain( 'swell', get_template_directory() . '/languages' );

		// 1.2.3 Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// 1.2.4 Add support for thumbnails
		add_theme_support( 'post-thumbnails' );

		// 1.2.5 This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Main Menu', 'swell' ),
		) );

		// 1.2.6 Enable support for Post Formats (currently disabled).
		//add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

		// 1.2.7 Load and instantiate the Portfolio CPT Class v1.0 -- Warning: WP<3.8 requires images/blue-folder-stand.png
		load_template( get_template_directory() . '/inc/class-portfolio-cpt.php', true );

		$portfolio_cpt = new Portfolio_CPT( 'swell' ); // Sending in the textdomain
		$portfolio_cpt->project_init();
		$portfolio_cpt->skills_init();

		// 1.2.8 Load and instantiate the Testimonial CPT Class v1.0 -- Warning: WP<3.8 requires images/user-icon.png
		load_template( get_template_directory() . '/inc/class-testimonial-cpt.php', true );

		$testimonial_cpt = new Testimonial_CPT( 'swell' ); // Sending in the textdomain
		$testimonial_cpt->testimonial_init();

		// 1.2.9 Enable Featured Content
		add_theme_support( 'featured-content', array(
		   'filter'     => 'swell_get_featured_posts',
		   'max_posts'  => get_theme_mod( 'swell_featured_pages_count' ),
		   'post_types' => array( 'post', 'page' ),
		) );

		// 1.2.10 Setup the WordPress Core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'swell_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// 1.2.11 Enable support for HTML5 markup.
		add_theme_support( 'html5', array(
			'comment-list',
			'search-form',
			'comment-form',
			'gallery',
			'caption',
		) );

		// 1.2.12 Add Menus
		function mobile_nav() {
			echo '<ul>';
			wp_list_pages('sort_column=menu_order&title_li=');
			echo '</ul>';
		}

		function main_nav() {
			echo '<nav id="main-menu"><ul class="sf-menu clearfix">';
			wp_list_pages('sort_column=menu_order&title_li=');
			echo '</ul></nav>';
		}


	} // swell_setup()
endif; // if()

add_action( 'after_setup_theme', 'swell_setup' );

// 1.3 Add Post Image Sizes & Video Tracker
add_image_size('swell_post_thumb_small', 120, 120, true);
add_image_size( 'swell_post_thumb', 800, 450, true );
add_image_size( 'swell_post_thumb_big', 1000, 9999, true );
add_image_size( 'swell_project_thumb', 400, 400, true );
add_image_size( 'swell_full_width', 2000, 9999, true );

// Keep track of the number of videos on a page
$ttrust_config['video_counter']	= 1;

//////////////////////////////////////////////////////////////
// 2. Header
/////////////////////////////////////////////////////////////

// 2.1 Swell Scripts
if ( ! function_exists( 'swell_scripts_n_styles' ) ) {
	function swell_scripts_n_styles() {

		global $wp_version;

		// 2.1.1  CSS
		wp_enqueue_style( 'swell-style', get_stylesheet_uri(), false );
		wp_enqueue_style( 'swell-mmenu-css', get_bloginfo('template_url').'/css/jquery.mmenu.css', false, '4.3.2', 'all' );
		wp_enqueue_style( 'superfish', get_bloginfo('template_url').'/css/superfish.css', false, '1.7.3', 'all' );
		wp_enqueue_style( 'swell-YTVideo', get_bloginfo( 'template_url' ).'/css/YTPlayer.css', false );

		// 2.1.2  Fonts
		wp_enqueue_style( 'font-awesome', get_bloginfo( 'template_url' ) . '/css/font-awesome.min.css', false, '4.0.3', 'all' );
		wp_enqueue_style( 'font-merriweather', '//fonts.googleapis.com/css?family=Merriweather:300,400,700,300italic,400italic,700italic', false );
		wp_enqueue_style( 'font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300,400,700,300italic,400italic,700italic', false );
		wp_enqueue_style( 'flexslider', get_bloginfo( 'template_url' ) . '/css/flexslider.css', false );

		// 2.1.3  Scripts
		wp_enqueue_script( 'swell-jquery-ui', '//code.jquery.com/ui/1.10.4/jquery-ui.min.js', array( 'jquery' ), '1.10.4', true );
		wp_enqueue_script( 'swell-jquery-actual', get_bloginfo( 'template_url' ).'/js/jquery.actual.js', array( 'jquery' ), '1.0.16', true );
		wp_enqueue_script( 'swell-flexslider', get_bloginfo( 'template_url' ).'/js/jquery.flexslider-min.js', array( 'jquery' ), '2.2.2', true);

		// Video
		wp_enqueue_script( 'swell-YTVideo', get_bloginfo( 'template_url' ).'/js/jquery.mb.YTPlayer.js', array( 'jquery' ), '0.10', true );
		wp_enqueue_script( 'swell-froogaloop', 'http://a.vimeocdn.com/js/froogaloop2.min.js', array( 'jquery' ), null, true );

		// Others
		wp_enqueue_script( 'superfish', get_bloginfo('template_url').'/js/superfish.js', array('jquery'), '1.7.3', true );
		wp_enqueue_script( 'swell-scrollto', get_bloginfo( 'template_url' ) . '/js/jquery.scrollTo.min.js', array( 'jquery' ), '1.4.6', true );
		wp_enqueue_script( 'swell-isotope', get_bloginfo( 'template_url' ) . '/js/jquery.isotope.js', array( 'jquery' ), '1.3.110525', true );
		wp_enqueue_script( 'swell-fitvids', get_bloginfo( 'template_url' ) . '/js/jquery.fitvids.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'swell-mmenu', get_bloginfo( 'template_url' ) . '/js/jquery.mmenu.min.js', array( 'jquery' ), '4.3.2', true);
		wp_enqueue_script( 'swell-theme_trust_js', get_bloginfo( 'template_url' ) . '/js/theme_trust.js', array( 'jquery' ), '1.0', true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		if( is_active_widget( false, '', 'ttrust_flickr' ) ) {
	    	wp_enqueue_script( 'flickrfeed', get_bloginfo( 'template_url' ) . '/js/jflickrfeed.js', array( 'jquery' ), '0.8', true);
		}

	}

} // if()

add_action( 'wp_enqueue_scripts', 'swell_scripts_n_styles' );

/*
 *	2.2 Embed Parser
 *	---
 *	This function will take any link and determine whether it is (1) YouTube, (2) Vimeo or (3) Self-Hosted.
 *	The function is called on the video link in the customizer, but could be called anywhere.
*/

if ( ! function_exists( 'swell_embed_parser' ) ) {
	function swell_embed_parser( $content ) {

		if( ! empty( $content ) ) {

			$video = array();

		  	// ToDo: Improve the ID fetching using oEmbed instead of RegEx

		  	// Our YouTube RegEx Pattern
		  	$pattern 	= '%(http(?:s)?:\/\/?(?:www\.)?youtu(?:be\.com\/|\.be\/)(?:embed\/|v\/|watch\?v=|)([a-zA-Z0-9_-]{10,12}))%';
		  	$match 		= array();

		  	// YouTube Embed Parser
			preg_match_all( $pattern, $content, $match );

			// Clear null values from the array
			$match = array_filter($match);

			if ( ! empty( $match ) ) {

				// Return YouTube Link, ID and Type
				$video[ 'url' ]		= $match[1][0];
				$video[ 'id' ] 		= $match[2][0];
				$video[ 'type' ] 	= 'youtube';

			} else { 	// Well, OK. Let's try Vimeo ...

			  	// Our Vimeo RegEx Pattern
				$pattern = '%((\/\/player\.)?vimeo\.com\/(video|channels\/)?([a-zA-Z]*\/?)([0-9]*))%';

				// Vimeo embed parser
				preg_match_all( $pattern, $content, $match );

				// Clear null values from the array
				$match = array_filter($match);

				if ( ! empty( $match ) ) {

					// Return Vimeo ID and Type
					$video[ 'url' ]		= '//player.vimeo.com/video/' . $match[5][0]; // iframe embeds need this format
					$video[ 'id' ] 		= $match[5][0];
					$video[ 'type' ] 	= 'vimeo';

				} else {	// Hmm.. Self-hosted?

						$video['url']		= $content;
						$video[ 'id' ] 		= 'self';
						$video[ 'type' ] 	= 'self';

				} // Vimeo else()

			} // YouTube if()

		} else { // if ! empty
			$video[ 'url' ]		= '';
			$video[ 'id' ] 		= '';
			$video[ 'type' ] 	= 'img';
		}

		return $video;

	} // swell_embed_parser()
} // if()

/*	ToDo: Space reserved for scraping thumbnails for the posts without a thumb and storing them as featured images */

//	2.3 Customizer Head
if ( ! function_exists( 'swell_theme_head' ) ) {
	function swell_theme_head() { ?>
		<?php if (get_theme_mod('swell_favicon') ) : ?>
			<link rel="shortcut icon" href="<?php echo get_theme_mod('swell_favicon'); ?>" />
		<?php endif; ?>
		<meta name="generator" content="<?php global $ttrust_config; echo $ttrust_config['theme'] . ' ' . $ttrust_config['version']; ?>" />

		<!--[if IE 8]>
		<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/ie8.css" type="text/css" media="screen" />
		<![endif]-->
		<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

		<?php

		$color = array();

		$color['text'] 			= get_theme_mod( 'swell_text_color' );
		$color['accent'] 		= get_theme_mod( 'swell_accent_color' );
		$color['header'] 		= get_theme_mod( 'swell_header_color' );
		$color['menu'] 			= get_theme_mod( 'swell_menu_color' );
		$color['menu_hover'] 	= get_theme_mod( 'swell_menu_hover_color' );
		$color['header'] 		= get_theme_mod( 'swell_header_color' );
		$color['link'] 			= get_theme_mod( 'swell_link_color' );
		$color['link_hover'] 	= get_theme_mod( 'swell_link_hover_color' );

		// Colors
		if( $color ){ ?>

		<style>

			<?php // Accent Color
			if( $color['accent'] ) { ?>
			.pull, blockquote { border-color: <?php echo $color['accent']; ?>; }
			.home .post.small:hover .overlay { background-color: <?php echo $color['accent']; ?>; }
			<?php } ?>

			<?php // Header Color
			if( $color['header'] ) { ?>
			.site-header .top, #main-nav ul ul { background: <?php echo $color['header']; ?>; }
			<?php } ?>

			<?php // Menu Color
			if( $color['menu'] ) { ?>
			#main-nav ul a, .site-header #main-nav ul ul li a, #menu-toggle { color: <?php echo $color['menu']; ?>; }
			<?php } ?>

			<?php // Menu Hover Color
			if( $color['menu_hover'] ) { ?>
			#main-nav ul li a:hover, .site-header #main-nav ul ul li a:hover,
			#main-nav ul li.current a,
			#main-nav ul li.current-cat a,
			#main-nav ul li.current_page_item a,
			#main-nav ul li.current-menu-item a,
			#main-nav ul li.current-post-ancestor a,
			.single-post #main-nav ul li.current_page_parent a,
			#main-nav ul li.current-category-parent a,
			#main-nav ul li.current-category-ancestor a,
			#main-nav ul li.current-portfolio-ancestor a,
			#main-nav ul li.current-projects-ancestor a {
				color: <?php echo $color['menu_hover']; ?>;
			}
			<?php } ?>

			<?php // Link Color
			if( $color['link'] ) { ?>
			a, a.button, li.menu-item a { color: <?php echo $color['link']; ?> !important; border-color: <?php echo $color['link']; ?> !important; }
			<?php } ?>

			<?php // Link Color Hover
			if( $color['link_hover'] ) { ?>
			a:hover, a.button:hover { color: <?php echo $color['link_hover']; ?> !important; border-color: <?php echo $color['link_hover']; ?> !important; }
			<?php } ?>

			<?php if (get_theme_mod('swell_custom_css') ) {
			echo get_theme_mod('swell_custom_css');
			} ?>

		</style>

		<?php } // if($color)

	} // swell_theme_head()
} // if()

add_action( 'wp_head','swell_theme_head' );

//	2.4 Swell Background Maker
if ( ! function_exists( 'swell_video_embed' ) ) {
	function swell_video_embed( $link ) {

		global $ttrust_config;

		$video 	= swell_embed_parser( $link );

		switch ( $video['type'] ) {

            case 'youtube': ?>
				<div id="youtube<?php echo $ttrust_config['video_counter']; ?>" class="video-container player" style="display:block; margin: auto; background: rgba(0,0,0,0.5)" data-property="{
					videoURL:'<?php echo $video['url']; ?>',
					containment:'#youtube<?php echo $ttrust_config['video_counter']++; ?>',
					mute:true,
					autoPlay:true,
					loop:true,
					opacity:1

				}"></div><?php
                break;

            case 'vimeo': ?>
                <div class="video-container">
                    <iframe class="vimeo player" id="vimeo<?php echo $ttrust_config['video_counter']; ?>" src="<?php echo $video['url']; ?>?api=1&loop=1&portrait=0&controls=0&showinfo=0&autohide=1&rel=0&wmode=transparent&output=embed&player_id=vimeo<?php echo $ttrust_config['video_counter']++; ?>" width="100%" height="100%"></iframe>
                </div><?php

				break;

			case 'self': ?>
				<div class="video-container" style="width: 100%; height: 100%;" >
					<video id="self<?php echo $ttrust_config['video_counter']++; ?>" class="html5-video player" width="100%" height="100%" <?php if( get_theme_mod( 'swell_home_image' ) ) { ?> poster="<?php echo get_theme_mod( 'swell_home_image' ); ?>" <?php } ?> loop autoplay muted oncanplay="playSelfVideo(this)">
						<!-- mp4 -->
						<source src="<?php echo $video['url']; ?>.mp4" type='video/mp4' />
						<!-- webm -->
						<source src="<?php echo $video['url']; ?>.webm" type='video/webm' />
						<!-- ogg -->
						<source src="<?php echo $video['url']; ?>.ogv" type='video/ogv' />
						<?php _e('Sorry, but it seems like your browser doesnt support HTML5 video.', 'swell' ); ?>
					</video>
				</div><?php
				break;

			default:
				break;

		} // switch()

    } // swell_video_embed()
} // if()

//////////////////////////////////////////////////////////////
// 3. Includes
/////////////////////////////////////////////////////////////

//	3.1 Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

//	3.2 Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/extras.php';

//	3.3 Customizer additions.
require get_template_directory() . '/inc/customizer.php';

//	3.4 Load Jetpack compatibility file.
require get_template_directory() . '/inc/jetpack.php';

//	3.5 Widgets
require get_template_directory() . '/inc/widgets.php';


//////////////////////////////////////////////////////////////
// 4. Shortcodes
/////////////////////////////////////////////////////////////

// 4.1 Pull-Quote Shortcode
if(! function_exists( 'swell_pullquotes' ) ) {
	function swell_pullquotes( $atts, $content = null ) {

		extract(shortcode_atts(array(
			'side' => 'right',
		), $atts));

		if( $side != 'right' || $side != 'left' ) {

			return false;

		} else {

			return "<span class='pull pull$side'>" . do_shortcode( $content ) . "</span>";

		}

	}

	add_shortcode('pullquote', 'swell_pullquotes');

add_theme_support( 'post-thumbnails' ); 

wp_insert_term( $term, $taxonomy, $args = array() );


 if (class_exists('MultiPostThumbnails')) {
        new MultiPostThumbnails(
            array(
                'label' => 'Secondary Image',
                'id' => 'secondary-image',
                'post_type' => 'project'
            )
        );
    }

}




