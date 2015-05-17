<?php
// @package swell
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<!--
	/**
	 * @license
	 * MyFonts Webfont Build ID 2947849, 2015-01-05T19:15:08-0500
	 * 
	 * The fonts listed in this notice are subject to the End User License
	 * Agreement(s) entered into by the website owner. All other parties are 
	 * explicitly restricted from using the Licensed Webfonts(s).
	 * 
	 * You may obtain a valid license at the URLs below.
	 * 
	 * Webfont: AvenirLTStd-Medium by Linotype
	 * URL: http://www.myfonts.com/fonts/linotype/avenir/65-medium/
	 * Copyright: Copyright &#x00A9; 1981 - 2006 Linotype GmbH, www.linotype.com. All rights
	 * reserved. Copyright &#x00A9; 1989 - 2002 Adobe Systems Incorporated.  All Rights
	 * Reserved.
	 * 
	 * Webfont: AvenirLTStd-Book by Linotype
	 * URL: http://www.myfonts.com/fonts/linotype/avenir/45-book/
	 * Copyright: Copyright &#x00A9; 1989, 1995, 2002 Adobe Systems Incorporated.  All
	 * Rights Reserved. &#x00A9; 1981, 1995, 2002 Heidelberger Druckmaschinen AG. All rights
	 * reserved.
	 * 
	 * 
	 * License: http://www.myfonts.com/viewlicense?type=web&buildid=2947849
	 * Licensed pageviews: 250,000
	 * 
	 * © 2015 MyFonts Inc
	*/

	-->
	<link rel="stylesheet" type="text/css" href="http://sphericalcommunications.com/new/wp-content/themes/swell/MyFontsWebfontsKit.css">
	<link href='http://fonts.googleapis.com/css?family=Nunito:300,700,400' rel='stylesheet' type='text/css'> 
	<link href='http://fonts.googleapis.com/css?family=Muli:400,300italic,300,400italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type='text/css' href="http://www.sphericalcommunications.com/new/wp-content/themes/swell/css/nav.css">
	<link rel="stylesheet" type='text/css' href="http://sphericalcommunications.com/new/wp-content/themes/swell/css/base.css">
	<link rel="stylesheet" type='text/css' href="http://sphericalcommunications.com/new/wp-content/themes/swell/css/animation.css">


	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<nav class="menu slide-menu-top">

    <div class="inside clearfix">
			<button style="float: right;" class="close-menu">X</button></li>
			
		<div class="contact">
			<ul class="contact">
				<li>
				<h3>Socials</h3>
				<p>twitter<br />
				facebook<br />
				instagram</p><br />
				</li>		

				<li>
				<h3>Address</h3>					
				<p>34 Howard Street<br /> 
				3rd Floor New York,<br /> 
				New York 10013</p><br />
				</li>

				<li>
					<h3>Contact</h3>						
					<a href="mailto:info@sphericalcommunications.com">info@sphericalcommunications.com</a>
				</li> 

				<li class="hire">
					<span class="edit-link"><a href="http://sphericalcommunications.com/new/?page_id=223" class="post-edit-link">We Are Hiring</a></span>
				</li>		    	
			</ul>
		</div>
	</div>
</nav><!-- /slide menu top -->
</div>
	
<div>
	<div class="site-header">	

		<div class="top">
			
				<div class="inside clearfix">
					<?php $logo_head_tag = ( is_front_page() ) ? "h1" : "h3";	?>
					<?php $ttrust_logo = get_theme_mod( 'swell_logo' ); ?>
					<div id="logo fade-in">

					<?php if( $ttrust_logo ) { ?>

						<<?php echo $logo_head_tag; ?> class="logo"><a href="<?php bloginfo('url'); ?>"><img id="fade-in" src="<?php echo $ttrust_logo; ?>" alt="<?php bloginfo('name'); ?>" /></a></<?php echo $logo_head_tag; ?>>

					<?php } else { ?>

						<<?php echo $logo_head_tag; ?>><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></<?php echo $logo_head_tag; ?>>

					<?php } ?>
					</div>
					
					<div id="main-nav" class="">

						<!-- removed this temp 
						<?php wp_nav_menu( array(
							'container'			=> 'nav',
							'container_id'		=> 'main-menu',
							'menu_class' 		=> 'sf-menu clear',
							'theme_location'	=> 'primary',
							'fallback_cb' 		=> 'main_nav'
						) ); ?>
						-->

						
						<nav class="menu-main-menu-container" id="main-menu">
							<ul class="sf-menu clear" id="menu-main-menu">
								<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-51" id="menu-item-51"><a href="http://sphericalcommunications.com/new/?page_id=48">Who we are</a></li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-66" id="menu-item-66"><a href="http://sphericalcommunications.com/new/?page_id=209">What We Do</a></li>
								<li class="menu-item menu-item-type-post_type menu-item-object-page page_item page-item-39 menu-item-73" id="menu-item-73"><a href="http://sphericalcommunications.com/new/?page_id=39">Projects</a></li>
								<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-202 nav-toggler toggle-slide-top" id="menu-item-202"><a class="nav-toggler toggle-slide-top" href="#">Contact</a></li>
							</ul>
						</nav>
						
						<div class="buttons">
			                <button class="nav-toggler toggle-slide-left">Slide Menu Left</button>
			                <button class="nav-toggler toggle-slide-right">Slide Menu Right</button>
			                <!-- <button class="nav-toggler toggle-slide-top">Slide Menu Top</button> -->
			                <button class="nav-toggler toggle-slide-bottom">Slide Menu Bottom</button><br>
			                <button class="nav-toggler toggle-push-left">Push Menu Left</button>
			                <button class="nav-toggler toggle-push-right">Push Menu Right</button>
			                <button class="nav-toggler toggle-push-top">Push Menu Top</button>
			                <button class="nav-toggler toggle-push-bottom">Push Menu Bottom</button>
            			</div>	

					</div>
					<a href="#main-menu" id="menu-toggle"></a>
				</div>
			
		</div>
		
		<?php if( is_front_page() ) {

			// If we have a video or an image, show the top section
			if( get_theme_mod( 'swell_home_video' ) || get_theme_mod( 'swell_home_image' ) ) {  ?>

				<?php get_template_part( 'content-video-home' ); ?>

		<?php } // if()
		} // if() ?>


			
	</div>
	<div class="middle clear">



























