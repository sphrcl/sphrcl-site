<?php
/**
 * Custom template tags for Swell.
 * @package swell
 */

//////////////////////////////////////////////////////////////
// Pagination
/////////////////////////////////////////////////////////////

if ( ! function_exists( 'swell_paging_nav' ) ) :
	// Kriesi navigation
	function swell_paging_nav( $pages = '', $range = 2 ) {
	     $showitems = ( $range * 2 ) + 1;

	     global $paged;
	     if( empty( $paged ) ) $paged = 1;

	     if($pages == '')
	     {
	         global $wp_query;
	         $pages = $wp_query->max_num_pages;
	         if(!$pages)
	         {
	             $pages = 1;
	         }
	     }

	     if(1 != $pages) {
	         echo "<div class='pagination clear'><div class='inside'>";
	         if( $paged > 2 && $paged > $range + 1 && $showitems < $pages ) echo "<a href='" . get_pagenum_link(1) . "'>&laquo;</a>";
	         if( $paged > 1 && $showitems < $pages ) echo "<a href='" . get_pagenum_link($paged - 1) . "'>&lsaquo;</a>";

	         for ( $i=1; $i <= $pages; $i++ ) {
	             if ( 1 != $pages &&( !( $i >= $paged+$range+1 || $i <= $paged-$range - 1 ) || $pages <= $showitems ) ) {
	                 echo ( $paged == $i ) ? "<span class='current'>$i</span>" : "<a href='" . get_pagenum_link($i) . "' class='inactive' >$i</a>";
	             }
	         }

	         if ( $paged < $pages && $showitems < $pages ) echo "<a href='" . get_pagenum_link( $paged + 1 ) . "'>&rsaquo;</a>";
	         if ( $paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages ) echo "<a href='" . get_pagenum_link($pages) . "'>&raquo;</a>";
	         echo "</div></div>\n";
	     }
	}
endif;

//////////////////////////////////////////////////////////////
// Post Navigation
/////////////////////////////////////////////////////////////

if ( ! function_exists( 'swell_post_nav' ) ) :
	// Display navigation to next/previous post when applicable.
	function swell_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'swell' ); ?></h1>
			<div class="nav-links">				
				<?php					
					next_post_link(     '<div class="nav-next">%link</div>',     _x( '<span class="meta-nav">&larr;</span> %title', 'Next post link',     'swell' ) );
					$portfolio_page_id = swell_get_portfolio_id(); 
					if($portfolio_page_id) { ?> 
					<div class="nav-portfolio <?php if(!get_next_post()){ echo 'inactive'; }?>">
						<a href="<?php echo esc_url( get_permalink($portfolio_page_id) ); ?>"></a>
					</div>
					<?php } 
					previous_post_link( '<div class="nav-previous">%link</div>', _x( '%title <span class="meta-nav">&rarr;</span>', 'Previous post link', 'swell' ) );
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;

//////////////////////////////////////////////////////////////
// Posted-On
/////////////////////////////////////////////////////////////

// Posted-on function for a more translateable string
if ( ! function_exists( 'swell_posted_on' ) ) :
	// Prints HTML with meta information for the current post-date/time.
	function swell_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		printf( __( '<span class="posted-on">%1$s</span>', 'swell' ),
			sprintf( '%2$s',
				esc_url( get_permalink() ),
				$time_string
			)
			
		);
	}
endif;

//////////////////////////////////////////////////////////////
// Posted-By
/////////////////////////////////////////////////////////////
if ( ! function_exists( 'swell_posted_by' ) ) :
	// Prints HTML with meta information for the current author.
	function swell_posted_by() {
		// Set up and print post meta information.
		printf( '<span class="byline">' . __( 'By ', 'swell' ) . '<span class="author vcard"><a class="url fn n" href="%1$s" rel="author">%2$s</a></span></span>',			
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
	}
endif;


//////////////////////////////////////////////////////////////
// Is Blog
/////////////////////////////////////////////////////////////

if ( ! function_exists( 'is_blog' ) ) :
function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}
endif;

//////////////////////////////////////////////////////////////
// Non-linked category list
/////////////////////////////////////////////////////////////

if ( ! function_exists( 'swell_category_list' ) ) :
function swell_category_list($id){
	$categories = get_the_category($id);
	$separator = ', ';
	$output = '';
	if($categories){
		foreach($categories as $category) {
			$output .= $category->cat_name.$separator;
		}
	return trim($output, $separator);
	}
}
endif;

//////////////////////////////////////////////////////////////
// True if Categorized Blog
/////////////////////////////////////////////////////////////

if ( ! function_exists( 'swell_categorized_blog' ) ) :
	// @return bool
	function swell_categorized_blog() {
		if ( false === ( $all_the_cool_cats = get_transient( 'swell_categories' ) ) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields'     => 'ids',
				'hide_empty' => 1,

				// We only need to know if there is more than one category.
				'number'     => 2,
			) );

			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );

			set_transient( 'swell_categories', $all_the_cool_cats );
		}

		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so swell_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so swell_categorized_blog should return false.
			return false;
		}
	}
endif;

//////////////////////////////////////////////////////////////
// Custom Excerpts
/////////////////////////////////////////////////////////////

if ( ! function_exists( 'swell_excerpt_ellipsis' ) ) :
	function swell_excerpt_ellipsis( $text ) {
		return str_replace(
			'[&hellip;]',
			'',
			$text
		);
	}
endif;

add_filter( 'the_excerpt', 'swell_excerpt_ellipsis' );


// Add Excerpt Support for Pages
add_post_type_support( 'page', 'excerpt' );

//////////////////////////////////////////////////////////////
// Custom More Link
/////////////////////////////////////////////////////////////

if ( ! function_exists( 'swell_more_link' ) ) :
	function swell_more_link( $class='' ) {
		global $post;
		$swell_more_link = '<p class="read-more"><a href="'. esc_url( get_permalink() ) . '" title="'. the_title_attribute('echo=0') .'" class="' . $class . '">';
		$swell_more_link .= __('Read More', 'swell');
		$swell_more_link .= '</a></p>';
		echo $swell_more_link;
	}
endif;

//////////////////////////////////////////////////////////////
// Remove <p> Tags from Images (currenlty deactivated)
/////////////////////////////////////////////////////////////

function swell_filter_ptags_on_images( $content ){
   return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}

//add_filter( 'the_content', 'swell_filter_ptags_on_images' );

//////////////////////////////////////////////////////////////
// Restyle Video Embeds ((currenlty deactivated))
/////////////////////////////////////////////////////////////

if( ! function_exists( 'swell_embed_formatter' ) ) {
	function swell_embed_formatter( $html ) {
	    return '<div class="video-pad"><div class="video-container">' . $html . '</div></div>';
	}

	//add_filter( 'embed_oembed_html', 'swell_embed_formatter', 10, 3 );
	//add_filter( 'video_embed_html', 'swell_embed_formatter' ); // Jetpack
} // if()

//////////////////////////////////////////////////////////////
// Get Poster Frame Image
/////////////////////////////////////////////////////////////

if ( ! function_exists( 'swell_video_thumbnail' ) ) :
	// Prints HTML with meta information for the current post-date/time and author.
	function swell_video_thumbnail( $id ) {

		$content_post	= get_post( $id );
		$content 		= $content_post->post_content;
		$video 			= swell_embed_parser( $content );

		if( $video[ 'type' ] == "youtube" ) {

			// ToDo: Get poster frame via the API to avoid broken links if YT changes this format
			$swell_video_thumbnail = '<img class="youtube-thumb" src="http://img.youtube.com/vi/' . $video[ 'id' ] . '/0.jpg" />';

		} elseif ( $video[ 'type' ] == "vimeo" ) {

			$imgid = $video[ 'id' ];

			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));

			$thumbURL = $hash[0]['thumbnail_large'];

			$swell_video_thumbnail = '<img class="vimeo-thumb" src="' . $thumbURL . '" />';

		} else {

			$swell_video_thumbnail = '<img src="' . get_bloginfo( 'template_url' ) . '/images/no_video.jpg" width="500" />';

		}

		echo $swell_video_thumbnail;

	}
endif;

//////////////////////////////////////////////////////////////
// More Translateable Posted On
/////////////////////////////////////////////////////////////

if ( ! function_exists( 'swell_posted_on' ) ) :
	function swell_posted_on() {

		$categories = get_the_category();
		$separator = ' ';
		$output = '';
		if($categories){
			foreach($categories as $category) {
				$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
			}

			$category_string = 'in '. trim($output, $separator);
		}


		printf( __( 'Posted by %2$s on %1$s %3$s<br /> ', 'swell' ),
			sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_date() )
			),
			sprintf( '<a href="%1$s">%2$s</a>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			),
			sprintf( '%s', $category_string )
		);
	}
endif;

/**
 * Flush out the transients used in swell_categorized_blog.
 */
function swell_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'swell_categories' );
}
add_action( 'edit_category', 'swell_category_transient_flusher' );
add_action( 'save_post',     'swell_category_transient_flusher' );

//////////////////////////////////////////////////////////////
// Comments
/////////////////////////////////////////////////////////////

function swell_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li id="li-comment-<?php comment_ID() ?>">

		<div class="comment <?php echo get_comment_type(); ?>" id="comment-<?php comment_ID() ?>">

			<?php echo get_avatar($comment,'70',get_bloginfo('template_url').'/images/default_avatar.png'); ?>

   	   		<h5><?php comment_author_link(); ?></h5>
			<span class="date"><?php comment_date(); ?></span>

			<?php if ($comment->comment_approved == '0') : ?>
				<p><span class="message"><?php _e('Your comment is awaiting moderation.', 'themetrust'); ?></span></p>
			<?php endif; ?>

			<?php comment_text() ?>

			<?php
			if(get_comment_type() != "trackback")
				comment_reply_link(array_merge( $args, array('add_below' => 'comment','reply_text' => '<span>'. __('Reply', 'themetrust') .'</span>', 'login_text' => '<span>'. __('Log in to reply', 'themetrust') .'</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'])))

			?>

		</div><!-- end comment -->

<?php
}

//////////////////////////////////////////////////////////////
// Pings
/////////////////////////////////////////////////////////////

function ttrust_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
		<li class="comment" id="comment-<?php comment_ID() ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
<?php
}
