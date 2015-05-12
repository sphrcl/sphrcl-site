<?php
/**
 * swell Theme Customizer
 *
 * @package swell
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function swell_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	//Remove unwanted
	$wp_customize->remove_control('background_color');

	// -- Custom Controllers

	// Project Dropdown
	require_once( 'class-customizer-post-dropdown.php' );

	// Header, Text Area
	require_once( 'classes-customizer.php' );

	// -- Sanitization Callbacks

	// Boolean
	function swell_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}

	// Numeric
	function swell_sanitize_number( $input ) {
		if ( is_numeric( $input ) ) {
			return $input;
		} else {
			return '20';
		}
	}
	
	//Text Area Control
	class TTrust_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';

		public function render_content() {
			?>
			<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
			<?php
		}
	}

	// Logo
	$wp_customize->add_setting( 'swell_logo' , array(
	    'default'   		=> '',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
		'label'      => __('Logo', 'swell'),
		'section'    => 'title_tagline',
		'settings'   => 'swell_logo',
	    'priority'   => 11
	) ) );
	
	$wp_customize->add_setting( 'swell_favicon' , array(
	    'default'   		=> '',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'favicon', array(
		'label'      => __('Favicon', 'swell'),
		'section'    => 'title_tagline',
		'settings'   => 'swell_favicon',
	    'priority'   => 12
	) ) );

	// -- Home Section

	$wp_customize->add_section( 'swell_home' , array(
	    'title'     	=> __( 'Homepage', 'swell' ),
	    'description'	=> __('Use the following settings to customize the appearance of your Swell homepage.', 'swell'),
	    'priority'   	=> 3,
	) );

	// Header for Top Section
	$wp_customize->add_setting( 'swell_home_tag');
	$wp_customize->add_control( new Swell_Tag( $wp_customize, 'swell_home_tag', array(
		'label'		=> __( 'Banner Section', 'swell' ),
		'section'   => 'swell_home',
		'settings'  => 'swell_home_tag',
		'priority' 	=> 31
	) ) );

	// Banner Img - Fallback
	$wp_customize->add_setting( 'swell_home_image' , array(
	    'default'     		=> '',
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'swell_home_image', array(
		'label'      => __( 'Banner Background Image', 'swell' ),
		'section'    => 'swell_home',
		'settings'   => 'swell_home_image',
		'priority'   => 32
	) ) );

	// Home Video ID
	$wp_customize->add_setting( 'swell_home_video' , array(
	    'default'     		=> '',
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( 'swell_home_video', array(
		'label'      => __( 'Banner Background Video', 'swell' ),
		'section'    => 'swell_home',
		'settings'   => 'swell_home_video',
		'priority'   => 33
	) );
	
	// Home Banner Main Text
	$wp_customize->add_setting( 'swell_home_banner_text_main' , array(
	    'default'     => __('Swell is a beautiful WordPress theme that uses motion to help tell your story.', 'swell'),
	    'type' => 'theme_mod',
	    'transport' => 'refresh',
	    'sanitize_callback'	 => 'wp_kses_post'
	) );

	$wp_customize->add_control( new TTrust_Textarea_Control( $wp_customize, 'swell_home_banner_text_main', array(
		'label'        => __('Banner Content', 'swell'),
		'section'    => 'swell_home',
		'settings'   => 'swell_home_banner_text_main',
		'priority'   => 34
	) ) );

	// Home Video Pattern Overlay
	$wp_customize->add_setting( 'swell_pattern_overlay' , array(
	    'default'     		=> '1',
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'swell_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'swell_pattern_overlay', array(
		'label'      => __( 'Pattern Overlay for Video', 'swell' ),
		'section'    => 'swell_home',
		'settings'   => 'swell_pattern_overlay',
		'type'		 => 'checkbox',
		'priority'   => 35
	) );

	// Header for Portfolio Section
	$wp_customize->add_setting( 'swell_portfolio_tag');
	$wp_customize->add_control( new Swell_Tag( $wp_customize, 'swell_portfolio_tag', array(
		'label'		=> __( 'Portfolio Section', 'swell' ),
		'section'   => 'swell_home',
		'settings'  => 'swell_portfolio_tag',
		'priority' 	=> 36
	) ) );

	// Home Projects Title
	$wp_customize->add_setting( 'swell_recent_projects_title' , array(
	    'default'     		=> __( 'Recent Projects', 'swell' ),
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );

	$wp_customize->add_control( 'swell_recent_projects_title', array(
		'label'      => __( 'Recent Projects Title', 'swell' ),
		'section'    => 'swell_home',
		'settings'   => 'swell_recent_projects_title',
		'priority'   => 37
	) );
	
	// Recent Project Summary
	$wp_customize->add_setting( 'swell_recent_projects_summary' , array(
	    'default'     => __('', 'swell'),
	    'type' => 'theme_mod',
	    'transport' => 'refresh',
	    'sanitize_callback'	 => 'wp_kses_post'
	) );

	$wp_customize->add_control( new TTrust_Textarea_Control( $wp_customize, 'swell_recent_projects_summary', array(
		'label'        => __('Recent Projects Summary', 'swell'),
		'section'    => 'swell_home',
		'settings'   => 'swell_recent_projects_summary',
		'priority'   => 38
	) ) );

	// Number of Recent Projects to Show
	$wp_customize->add_setting( 'swell_recent_projects_count' , array(
	    'default'			=> '3',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	=> 'swell_sanitize_number'
	) );

	$wp_customize->add_control( 'swell_recent_projects_count', array(
		'label'		=> __( 'Number of Recent Projects to Show', 'swell' ),
		'section'	=> 'swell_home',
		'settings'	=> 'swell_recent_projects_count',
		'type'		=> 'select',
	    'choices'	=> array(
			'0' => '0',
	        '3' => '3',
	        '6' => '6',
	        '9' => '9',
	        ),
		'priority'	=> 40
	) );

	// Header for Seondary Video Section
	$wp_customize->add_setting( 'swell_secondary_video_tag');
	$wp_customize->add_control( new Swell_Tag( $wp_customize, 'swell_secondary_video_tag', array(
		'label'		=> __( 'Secondary Video Section', 'swell' ),
		'section'   => 'swell_home',
		'settings'  => 'swell_secondary_video_tag',
		'priority' 	=> 42
	) ) );

	// Secondary Video	
	$wp_customize->add_setting( 'swell_home_video_secondary' , array(
	    'default'     		=> '',
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( 'swell_home_video_secondary', array(
		'label'      => __( 'Secondary Video', 'swell' ),
		'section'    => 'swell_home',
		'settings'   => 'swell_home_video_secondary',
		'priority'   => 42
	) );

	// Header for Blog Section
	$wp_customize->add_setting( 'swell_blog_tag');
	$wp_customize->add_control( new Swell_Tag( $wp_customize, 'swell_blog_tag', array(
		'label'		=> __( 'Blog Section', 'swell' ),
		'section'   => 'swell_home',
		'settings'  => 'swell_blog_tag',
		'priority' 	=> 43
	) ) );

	// Recent Posts Title
	$wp_customize->add_setting( 'swell_recent_posts_title' , array(
	    'default'			=> __( 'From the Blog', 'swell' ),
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	=> 'esc_html'
	) );

	$wp_customize->add_control( 'swell_recent_posts_title', array(
		'label'		=> __( 'Recent Posts Title', 'swell' ),
		'section'	=> 'swell_home',
		'settings'	=> 'swell_recent_posts_title',
		'priority'	=> 44
	) );
	
	// Recent Post Summary
	$wp_customize->add_setting( 'swell_recent_posts_summary' , array(
	    'default'     => __('', 'swell'),
	    'type' => 'theme_mod',
	    'transport' => 'refresh',
	    'sanitize_callback'	 => 'wp_kses_post'
	) );

	$wp_customize->add_control( new TTrust_Textarea_Control( $wp_customize, 'swell_recent_posts_summary', array(
		'label'        => __('Recent Posts Summary', 'swell'),
		'section'    => 'swell_home',
		'settings'   => 'swell_recent_posts_summary',
		'priority'   => 45
	) ) );

	// Number of Recent Posts to Show
	$wp_customize->add_setting( 'swell_recent_posts_count' , array(
	    'default'			=> '5',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	=> 'swell_sanitize_number'
	) );

	$wp_customize->add_control( 'swell_recent_posts_count', array(
		'label'		=> __( 'Number of Recent Posts to Show', 'swell' ),
		'section'	=> 'swell_home',
		'settings'	=> 'swell_recent_posts_count',
		'priority'	=> 45
	) );
	
	// Header for Testimonials Section
	$wp_customize->add_setting( 'swell_testimonials_tag');
	$wp_customize->add_control( new Swell_Tag( $wp_customize, 'swell_testimonials_tag', array(
		'label'		=> __( 'Testimonials Section', 'swell' ),
		'section'   => 'swell_home',
		'settings'  => 'swell_testimonials_tag',
		'priority' 	=> 46
	) ) );
	
	// Number of Testimonials to Show
	$wp_customize->add_setting( 'swell_testimonials_count' , array(
	    'default'			=> '3',
	    'type'				=> 'theme_mod',
	    'transport'			=> 'refresh',
	    'sanitize_callback'	=> 'swell_sanitize_number'
	) );

	$wp_customize->add_control( 'swell_testimonials_count', array(
		'label'		=> __( 'Number of Testimonials to Show', 'swell' ),
		'section'	=> 'swell_home',
		'settings'	=> 'swell_testimonials_count',
		'type'		=> 'select',
	    'choices'	=> array(
	        '0' => '0',
			'3' => '3',
	        '6' => '6',
	        '9' => '9',
	        ),
		'priority'	=> 47
	) );
	
	// Testimonials Background
	$wp_customize->add_setting( 'swell_testimonials_background' , array(
	    'default'     		=> '',
	    'type' 				=> 'theme_mod',
	    'transport' 		=> 'refresh',
	    'sanitize_callback'	=> 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'swell_testimonials_background', array(
		'label'      => __( 'Testimonials Background', 'swell' ),
		'section'    => 'swell_home',
		'settings'   => 'swell_testimonials_background',
		'priority'   => 48
	) ) );
	
	
	
	// -- Custom  CSS Section

	$wp_customize->add_section( 'swell_css' , array(
	    'title'     	=> __( 'Custom CSS', 'swell' ),
	    'description'	=> __('Add your own custom CSS.', 'swell'),
	    'priority'   	=> 49,
	) );
	
	// Recent Post Summary
	$wp_customize->add_setting( 'swell_custom_css' , array(
	    'default'     => __('', 'swell'),
	    'type' => 'theme_mod',
	    'transport' => 'refresh',
	    'sanitize_callback'	 => 'wp_kses_post'
	) );

	$wp_customize->add_control( new TTrust_Textarea_Control( $wp_customize, 'swell_custom_css', array(
		'label'        => __('CSS', 'swell'),
		'section'    => 'swell_css',
		'settings'   => 'swell_custom_css',
		'priority'   => 50
	) ) );

	// -- Colors Section

	// Accent (Borders)
	$wp_customize->add_setting( 'swell_accent_color' );
	$wp_customize->add_control(
		new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
			'label'      => __( 'Accent Color', 'swell' ),
			'section'    => 'colors',
			'settings'   => 'swell_accent_color'
		) )
	);
	
	// Header
	$wp_customize->add_setting( 'swell_header_color' );
	$wp_customize->add_control(
		new WP_Customize_Color_Control( $wp_customize, 'header_color', array(
			'label'      => __( 'Header Background Color', 'swell' ),
			'section'    => 'colors',
			'settings'   => 'swell_header_color'
		) )
	);
	
	// Menu Color
	$wp_customize->add_setting( 'swell_menu_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_color', array(
			'label'      => __( 'Menu Color', 'swell' ),
			'section'    => 'colors',
			'settings'   => 'swell_menu_color',
			'priority'   => 13
		) )
	);
	
	// Menu Color Hover
	$wp_customize->add_setting( 'swell_menu_hover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_hover_color', array(
			'label'      => __( 'Menu Hover Color', 'swell' ),
			'section'    => 'colors',
			'settings'   => 'swell_menu_hover_color',
			'priority'   => 14
		) )
	);

	// Link Color
	$wp_customize->add_setting( 'swell_link_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'      => __( 'Link Color', 'swell' ),
			'section'    => 'colors',
			'settings'   => 'swell_link_color',
			'priority'   => 15
		) )
	);

	// Link Hover Color (Incl. Active)
	$wp_customize->add_setting( 'swell_link_hover_color' );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
			'label'      => __( 'Link Hover Color', 'swell' ),
			'section'    => 'colors',
			'settings'   => 'swell_link_hover_color',
			'priority'   => 16
		) )
	);
	
	// -- Footer Section

	$wp_customize->add_section( 'swell_footer' , array(
	    'title'      => __( 'Footer', 'port' ),
	    'priority'   => 50,
	) );

	// Left Footer Text (Custom Control)
	$wp_customize->add_setting( 'swell_footer_left' , array(
	    'default'     => '',
	    'type' => 'theme_mod',
	    'transport' => 'refresh',
	    'sanitize_callback'	 => 'wp_kses_post'
	) );

	$wp_customize->add_control( new TTrust_Textarea_Control( $wp_customize, 'footer_left', array(
	    'label'   => __('Primary Footer Text', 'port'),
	    'section' => 'swell_footer',
	    'settings'   => 'swell_footer_left',
	    'priority'   => 71
	) ) );

	// Right Footer Text (Custom Control)
	$wp_customize->add_setting( 'swell_footer_right' , array(
	    'default'     => '',
	    'type' => 'theme_mod',
	    'transport' => 'refresh',
	    'sanitize_callback'	 => 'wp_kses_post'
	) );

	$wp_customize->add_control( new TTrust_Textarea_Control( $wp_customize, 'footer_right', array(
	    'label'   => __('Secondary Footer Text', 'port'),
	    'section' => 'swell_footer',
	    'settings'   => 'swell_footer_right',
	    'priority'   => 72
	) ) );

}
add_action( 'customize_register', 'swell_customize_register' );