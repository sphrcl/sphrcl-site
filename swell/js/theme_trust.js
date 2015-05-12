var gridContainer 	= jQuery('.thumbs'),
	topOffest 		= (jQuery('body').hasClass('admin-bar')) ? 32 : 0,
	windowHeight 	= jQuery(window).height(),
	windowWidth 	= jQuery(window).width(),
	offset 			= - (windowHeight - 480) / 2,
	scroll 			= jQuery(window).scrollTop(),
	stickyNav 		= jQuery('#menu .bottom .surround'),
	player			= {},
	stickyNavOffsetTop,
	currVolume;
	windowHeightAdjusted = 0;

/////////////////////////////////
// Set Home Video/Image & Height
/////////////////////////////////

// Find the video backgrounds
function getVideoBGs(){

	var playersList = [],
		i = 0,
		state = [];

	// Grab the player ids from the .player class
	jQuery('.player').each(function(){
		var id = this.id;
		playersList.push(id);

	});

	jQuery.each(playersList, function(index, value){

		// Get the types of players being used and store them in the array
		type	= this.substr( 0, this.length - 1);
		// Get the player index to contruct the ID later
		index	= this.substr( type.length, 1);
		id		= '#' + this;

		// Set up the video
		setVideo(type, index, id);

		// Pass the information to the player object to be used later
		player[index] = [type, id, state];

		i++;

	});

	// Player Status
	if( jQuery(player[1]).length > 0 ) {
		player[1][2] = 'playing';
	}

	if( jQuery(player[2]).length > 0 ) {
		player[2][2] = 'playing';
	}


}

// Used to create Vimeo and YouTube players
function setVideo(playerType, playerIndex, playerId) {

	switch(playerType){

		case "youtube":
			jQuery(playerId).height(windowHeight).mb_YTPlayer();

			jQuery(playerId).on("YTPStart", function(){
				jQuery(playerId).siblings(".overlay").addClass("fade-out");
			})
			break;

		case "vimeo":
	        jQuery(playerId).each(function(){
	            Froogaloop(this).addEvent('ready', ready);
	        });
	        break;

		case 'self':
			var video = jQuery(playerId).get(0);

			break;

		default:
			break;
	}
}

function playSelfVideo(playerId){
	if(!jQuery('body').hasClass('gecko')){
		var video = jQuery(playerId).get(0);
		video.play();
		jQuery(playerId).parent().siblings(".overlay").addClass("fade-out faster");
	}
}

// All the Vimeo Stuff
function ready(playerID) {
	// First Vimeo player only should autoplay
    if(playerID === "vimeo1" || playerID === "vimeo2"){
	    Froogaloop(playerID).api('play'); // To prevent autoplay bug
    }
	// Make Vimeo fill the screen and be responsive
	video_resize(playerID);
	// Mute videos on play
    Froogaloop(playerID).addEvent('play', vimeoPlaying(playerID));
}

function vimeoPlaying(playerID){
	Froogaloop(playerID).api('setVolume', 0);
	fadeOutOverlay(playerID);
}

function fadeOutOverlay(playerID){
	jQuery("#"+playerID).parent().siblings(".overlay").addClass("fade-out");
}

function mute(playerID){
    Froogaloop(playerID).api('setVolume', 0);
}

// Separate play for use later
function play(playerType, playerIndex, playerId, vimeoId){

	switch(playerType) {
		case 'youtube':
			jQuery(playerId).playYTP();
			break;

		case 'vimeo':
			Froogaloop(vimeoId).api("play");
			break;

		case 'self':
			var video = document.getElementById(playerId);
			video.play();
			break;

		default:
			break;

		// Set play state for tracking
		player[playerIndex][2] === 'playing';
	}

}

// Separate pause for use later
function pause(playerType, playerIndex, playerId, vimeoId) {

	switch(playerType) {

		case 'youtube':
			jQuery(playerId).pauseYTP();
			break;

		case 'vimeo':
			Froogaloop(vimeoId).api("pause");
			break;

		case 'self':
			var video = document.getElementById(playerId);
			video.pause();
			break;

		default:
			break;

		// Set play state for tracking
		player[playerIndex][2] === 'paused';

	}

}

function video_resize() {
	windowHeightAdjusted = jQuery(window).height() - topOffest - jQuery('.home .site-header .top').height();
	jQuery('.home.has-video .site-header').height(jQuery(window).height());
    jQuery('.home.has-video .site-header #video-background').height(windowHeightAdjusted);
	if(!isMobile()){
	if( ! jQuery.isEmptyObject(player[1]) && player[1][0] != 'youtube' ) {
	    playerId = player[1][1];
	    video_filler(playerId);
    }

    if( ! jQuery.isEmptyObject(player[2]) && player[2][0] != 'youtube' ) {
	    playerId = player[2][1];
	    video_filler(playerId);
    }
	}
}

function video_filler(playerId) {
    var offset;

    var $player = jQuery(playerId);

	// Offset for player1
	if(playerId.substr(playerId.length - 1, playerId.length) === 1) {
	    offset = 0;
	}

	// Offset for player2
	if(playerId.substr(playerId.length - 1, playerId.length) === 2) {
		offset = -200;
	}

	var width = jQuery(window).width(),
		pWidth, // player width, to be defined
        height = $player.parent().height() + 55, // Sneaky way to hide the controls
        pHeight, // player height, tbd
        ratio = 16/9;

    // when screen aspect ratio differs from video, video must center and underlay one dimension
    if (width / ratio < height) { // if new video height < window height (gap underneath)
        pWidth = Math.ceil(height * ratio); // get new player width
        $player.width(pWidth).height(height).css({left: (width - pWidth) / 2, top: offset}); // player width is greater, offset left; reset top
    } else { // new video width < window width (gap to right)
        pHeight = Math.ceil(width / ratio); // get new player height
        $player.width(width).height(pHeight).css({left: 0, top: (offset + height - pHeight ) / 2}); // player height is greater, offset top; reset left

    }
}



///////////////////////////////
// Mobile Detection
///////////////////////////////

function isMobile(){
    return (
        (navigator.userAgent.match(/Android/i)) ||
		(navigator.userAgent.match(/webOS/i)) ||
		(navigator.userAgent.match(/iPhone/i)) ||
		(navigator.userAgent.match(/iPod/i)) ||
		(navigator.userAgent.match(/iPad/i)) ||
		(navigator.userAgent.match(/BlackBerry/))
    );
}

///////////////////////////////
// Pullquotes
///////////////////////////////

function pull_out_the_quote() {
	jQuery('span.pullquote-right').each(function() {
		var $parentParagraph = jQuery(this).parent('p');
		$parentParagraph.css('position', 'relative');
		jQuery(this).clone()
    		  .addClass('pull pullright')
    		  .prependTo($parentParagraph);
	  });
	jQuery('span.pullquote-left').each(function() {
		var $parentParagraph = jQuery(this).parent('p');
		$parentParagraph.css('position', 'relative');
		jQuery(this).clone()
    		  .addClass('pull pullleft')
    		  .prependTo($parentParagraph);
	  });
}

///////////////////////////////
// Full-Width Images
///////////////////////////////

function full_width_images() {
	if(jQuery('.full-width-container').length > 0) {
		jQuery('.full-width-container').css({
			'height': windowHeight + 'px',
		 });
	}
}


///////////////////////////////
// Mobile Nav
///////////////////////////////

function mmenu_nav(){
	if(jQuery(window).width() < 700){
	var status = 'closed';
	jQuery("#main-menu").mmenu({
	   // options
	}, {
	   // configuration
	   clone: true
	});
	jQuery("#mm-main-menu ul").removeClass('sf-menu');
	jQuery("#menu-toggle").click(function() {
		if(status === 'closed') {
			jQuery("#main-menu").trigger("open.mm");
			status = 'open';
		} else {
			jQuery("#main-menu").trigger("close.mm");
		}
	});
	}
}

///////////////////////////////
// Project Filtering
///////////////////////////////

function projectFilterInit() {
	if( jQuery('#filter-nav a').length > 0 ) {
		jQuery('#filter-nav a').click(function(){
			var selector = jQuery(this).attr('data-filter');
			jQuery('#projects.thumbs').isotope({
				filter: selector,
				hiddenStyle : {
			    	opacity: 0,
			    	scale : 1
				}
			});

			if ( !jQuery(this).hasClass('selected') ) {
				jQuery(this).parents('#filter-nav').find('.selected').removeClass('selected');
				jQuery(this).addClass('selected');
			}

			return false;
		});
	} // if() - Don't have this element on every page on which we call Isotope
}

///////////////////////////////
// Project thumbs
///////////////////////////////

function isotopeInit() {
	setColumns();
	gridContainer.isotope({
		resizable: true,
		layoutMode: 'fitRows',
		masonry: {
			columnWidth: colW
		}
	});

	jQuery(".thumbs .small").css("visibility", "visible");

}

///////////////////////////////
// Isotope Grid Resize
///////////////////////////////

function setColumns()
{
	var columns;
	var gw = gridContainer.width();
	var ww = jQuery(window).width()
	if(ww<=700){
		columns = 1;
	}else if(ww<=870){
		columns = 2;
	}else{
		columns = 3;
	}
	colW = Math.floor(gw / columns);
	jQuery('.thumbs .small').each(function(id){
		jQuery(this).css('width',colW+'px');
	});
	jQuery('.thumbs .small').show();
}

function gridResize() {
	setColumns();
	gridContainer.isotope({
		resizable: false,
		layoutMode: 'fitRows',
		masonry: {
			columnWidth: colW
		}
	});
}

///////////////////////////////
// Center Home Banner Text
///////////////////////////////

function centerHomeBannerContent() {
	var bannerContent = jQuery('.home #banner-content');
	var bannerContentTop = (windowHeightAdjusted/2) - (jQuery('.home #banner-content').actual('height')/2);
	bannerContent.css('margin-top', bannerContentTop+'px');
	bannerContent.show();
}

///////////////////////////////
// Initialize
///////////////////////////////

jQuery.noConflict();
jQuery(document).ready(function(){
	jQuery(".content-area").fitVids();
	mmenu_nav();
	jQuery('#video-background').height(windowHeight);
	video_resize();
	if(!isMobile()){
		getVideoBGs();
	}

	jQuery('body').imagesLoaded(function(){
		projectFilterInit();
		isotopeInit();
		centerHomeBannerContent();
	});

	jQuery(window).smartresize(function(){
		gridResize();
		//full_width_images();
		video_resize();
		mmenu_nav();
		centerHomeBannerContent()
	});

	//Set Down Arrow Button
	jQuery('#down-button').click(function(){
		jQuery.scrollTo( ".middle", {easing: 'easeInOutExpo', duration: 1000} );
	});

	//pull_out_the_quote();
	//full_width_images();

});