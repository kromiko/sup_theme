<?php
/**
 * Twenty Thirteen functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
/**
 * Sets up the content width value based on the theme's design.
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Adds support for a custom header image.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentythirteen', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', twentythirteen_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );
	add_image_size('links-widget', 65, 65);

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );

/* custom admin menu */
require get_template_directory() . '/admin/hobbies_page.php';
require get_template_directory() . '/admin/rank_page.php';

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_fonts_url() {
	$fonts_url = '';
	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );
	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();
		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';
		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}
	return $fonts_url;
}
/**
 * Enqueues scripts and styles for front end.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_scripts_styles() {
	// Adds JavaScript to pages with the comment form to support sites with
	// threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to Twenty Thirteen.
	wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-07-18', true );

	wp_enqueue_script( 'jquery-ui.min-1.8.24', get_template_directory_uri() . '/js/jquery-ui.min-1.8.24.js', array( 'jquery' ), '2012-09-28', true );
	
	// loads karma scripts
	wp_enqueue_script( 'karma_script', get_template_directory_uri() . '/js/karma.js', array( 'jquery' ) );
	wp_localize_script( 'karma_script', 'karmaAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

	// Add Open Sans and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentythirteen-fonts', twentythirteen_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array('dashicons'), '2013-07-18' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '2013-07-18' );
	wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );

/* admin scripts and styles*/
function twentythirteen_admin_scripts_styles() {
	wp_enqueue_script('user-raiting', get_template_directory_uri() . '/js/user-raiting.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker' ));
	wp_enqueue_style( 'user-raiting', '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css', array(), '2014-10-31' );
}
add_action( 'admin_enqueue_scripts', 'twentythirteen_admin_scripts_styles' );
/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );

/**
 * Registers two widget areas.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Left Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears on posts and pages in the left sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

            <?php wp_pagenavi(); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
<?php
}
endif;

if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
/**
 * Displays navigation to next/previous post when applicable.
*
* @since Twenty Thirteen 1.0
*
* @return void
*/
function twentythirteen_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
<?php
}
endif;

if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';
	
	// Post author
	if ( 'post' == get_post_type() || 'useful_links' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a><span title="Author\'s karma" class="rate_val">%4$s</span></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			'By '.get_the_author(),
			karma_author_display(get_the_author_meta('ID'))
		);
	}
	
	if ( (! has_post_format( 'link' ) && 'post' == get_post_type()) || ('useful_links' == get_post_type()) )
		twentythirteen_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}
}
endif;

if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';
	
	$tandd = get_the_time().' on '.get_the_date();
	
	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), $tandd ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Returns the URL from the post.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extends the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( (is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' )) && ! is_attachment() && ! is_404() && ! is_single() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );

/**
 * Adjusts content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'twentythirteen_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function twentythirteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentythirteen_customize_register' );

/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );

//Shortcodes
include_once(TEMPLATEPATH . '/inc/shortcodes/pretty_photo.php');

//quick-post custom post type
function my_post_type_quick_post() {
	register_post_type( 'quick-post',
                array( 
				'label' => __('Quick post'), 
				'singular_label' => __('Quick post Item', 'support_theme'),
				'_builtin' => false,
				'public' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'hierarchical' => true,
				'capability_type' => 'page',
				'menu_icon' => get_template_directory_uri() . '/images/quick-post.png',
				'rewrite' => array(
					'slug' => 'quick-post',
					'with_front' => FALSE,
				),
				'supports' => array(
						'title',
						'editor',
						'thumbnail',
						'excerpt',
						'custom-fields',
						'comments')
					) 
				);
	register_taxonomy('quick_post_category', 'quick_post', array('hierarchical' => true, 'label' => 'Quick post Categories', 'singular_name' => 'Category', "rewrite" => true, "query_var" => true));
}

add_action('init', 'my_post_type_quick_post');

//useful links custom post type
function my_post_type_useful_links() {
	register_post_type( 'useful_links',
                array( 
				'label' => __('Useful links'), 
				'singular_label' => __('Useful links item', 'support_theme'),
				'_builtin' => false,
				'capability_type' => 'post',
				'public' => true,
				'publicly_queryable' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'hierarchical' => true,
				'rewrite' => array(
					'slug' => 'useful-links',
					'with_front' => FALSE,
				),
				'menu_icon' => get_template_directory_uri() . '/images/links-post.png',
				'supports' => array(
						'title',
						'editor',
						'author',
						'comments'
					)
				) 
	);
	register_taxonomy('useful_links_category', 'useful_links', array('hierarchical' => true, 'label' => 'Useful Links Categories', 'singular_name' => 'Useful Links Category', 'rewrite' => true, 'query_var' => true));
}
add_action('init', 'my_post_type_useful_links');

//private enterprise news custom post type
function my_post_type_private_enterprise() {
	register_post_type( 'private_enterprise',
                array( 
				'label' => __('Private Enterprise News'), 
				'singular_label' => __('Private Enterprise News item', 'support_theme'),
				'_builtin' => false,
				'capability_type' => 'post',
				'public' => true,
				'publicly_queryable' => true, 
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'hierarchical' => false,
				'rewrite' => array(
					'slug' => 'pe-news',
					'with_front' => FALSE,
				),
				'menu_icon' => get_template_directory_uri() . '/images/pe-post.png',
				'supports' => array(
						'title',
						'editor',
						'author',
						'comments'
					)
				) 
	);
}
add_action('init', 'my_post_type_private_enterprise');

//time of day
function time_of_day($content) {
   //$pdate = strtotime($content);
   $pdate = strtotime(str_replace("<br />","",$content)); //WP-Admin adds a break tag for display purposes which we have to strip out.
   $hour=date('H',$pdate);
   switch($hour)
		{
		case 0:
		case 1:
		case 2:
			$tod = 'in the wee hours';
			break;
		case 3:
		case 4:
		case 5:
		case 6:
			$tod = 'terribly early in the morning';
			break;
		case 7:
		case 8:
		case 9:
			$tod = 'in the early morning';
			break;
		case 10:
			$tod = 'mid-morning';
			break;
		case 11:
			$tod = 'just before lunchtime';
			break;
		case 12:
		case 13:
			$tod = 'around lunchtime';
			break;
		case 14:
			$tod = 'in the early afternoon';
			break;
		case 15:
		case 16:
			$tod = 'mid-afternoon';
			break;
		case 17:
			$tod = 'in the late afternoon';
			break;
		case 18:
		case 19:
			$tod = 'in the early evening';
			break;
		case 20:
		case 21:
			$tod = 'at around evening time';
			break;
		case 22:
			$tod = 'in the late evening';
			break;
		case 23:
			$tod = 'late at night';
			break;
		default:
			$tod = '';
			break;
		}
	return $tod;
}
add_filter('get_the_time','time_of_day');

//prettyPhoto scripts and styles
function twentythirteen_add_scripts() {
    wp_register_script(
        'prettyPhoto',
        get_template_directory_uri() . '/js/jquery.prettyPhoto.js',
        'jquery',
        '3.1.5',
        false
    );

    wp_enqueue_script( 'prettyPhoto' );
	
	wp_register_script(
        'toTop',
        get_template_directory_uri() . '/js/scroll_to_top.js',
        'jquery',
        '3.1.5',
        false
    );

    wp_enqueue_script( 'toTop' );
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_add_scripts' );

function twentythirteen_add_style() {
    wp_register_style(
        'prettyPhoto',
        get_template_directory_uri() . '/css/prettyPhoto.css',
        false,
        '3.1.5',
        'screen'
    );

    wp_enqueue_style( 'prettyPhoto' );
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_add_style' );

/* useful_links post custom meta boxes */
include_once get_template_directory() . '/inc/useful_links-meta.php';
include_once get_template_directory() . '/inc/register-widgets.php';

/* sets RSS update time to one hour */
add_filter( 'wp_feed_cache_transient_lifetime', create_function('$a', 'return 3600;') );

/* post karma raiting display */
function karma_results_display($karma_post_id) {
	global $wpdb;
	$get_karma = $wpdb->get_var( "SELECT karma_value FROM wp_karma_new WHERE karma_post_id = ".$karma_post_id."" );
	return $get_karma;
}

/* ajax actions for post karma */
add_action( 'wp_ajax_karma_save_rating', 'do_karma_save_rating' );
add_action( 'wp_ajax_nopriv_karma_save_rating', 'do_karma_save_rating' );

/* post karma raiting submit */
function do_karma_save_rating() {
	global $wpdb;
	if (is_user_logged_in()){
		
		$post_id = $_POST['post_id'];
		$direction = $_POST['direction'];
		$rater = $_POST['rater'];
		$owner = $_POST['owner'];
		
		$user_rated_post_id = get_user_meta( $rater, 'karma_rated', true );
		$rated_post_id_array = explode(",", $user_rated_post_id);
		$user_rated = in_array( $post_id, $rated_post_id_array );
		
		if ($rater == $owner){
			$self_posted = true;
		} else {
			$self_posted = false;
		}
		
		if ($self_posted == true){
			$return = array(
				'message' => 'You can not rate yourself'
			);
			wp_send_json($return);
		} elseif ( !$user_rated ) {
			$rated_post_id_array[] = $post_id;
			$rated_post_ids = implode(",", $rated_post_id_array);
			update_user_meta( $rater, 'karma_rated', $rated_post_ids );
			
			$cur_karma = karma_results_display($post_id);
			if ($direction == '+'){
				$new_karma = ($cur_karma + 1);
				if (!is_null($cur_karma)){
					$set_karma = $wpdb->query("UPDATE wp_karma_new SET karma_value = '".$new_karma."' WHERE karma_post_id =".$post_id." LIMIT 1");
				} else {
					$set_karma = $wpdb->insert('wp_karma_new', array('karma_id' => '', 'karma_post_id' => $post_id, 'karma_value' => $new_karma, 'kama_post_author_id' => $owner), array('%d', '%d', '%d', '%d'));
				}
			} else {
				$new_karma = ($cur_karma - 1);
				if (!is_null($cur_karma)){
					$set_karma = $wpdb->query("UPDATE wp_karma_new SET karma_value = '".$new_karma."' WHERE karma_post_id =".$post_id." LIMIT 1");
				} else {
					$set_karma = $wpdb->insert('wp_karma_new', array('karma_id' => '', 'karma_post_id' => $post_id, 'karma_value' => $new_karma, 'kama_post_author_id' => $owner), array('%d', '%d', '%d', '%d'));
				}
			}
			$return = array(
				'message' => 'Thank you',
				'karma' => karma_results_display($post_id)
			);
			wp_send_json($return);
		} else {
			$return = array(
				'message' => 'You have already rated'
			);
			wp_send_json($return);
		}
	} else {
		$return = array(
			'message' => 'Please login to rate'
		);
		wp_send_json($return);
	}
}

/* post author raiting display */
function karma_author_display($owner) {
	global $wpdb;
	$get_author_karma = $wpdb->get_results("SELECT karma_value FROM wp_karma_new WHERE kama_post_author_id = ".$owner."", ARRAY_N);
	$res = 0;
	foreach ($get_author_karma as $key){
		$res += $key[0];
	}
	return $res;
}

/* post karma list results */
function karma_list_results(){
	global $wpdb;
	$get_user_ids = $wpdb->get_results("SELECT kama_post_author_id FROM wp_karma_new", ARRAY_N);
	$user_ids = array();
	foreach ($get_user_ids as $key){
		$user_ids[] = $key[0];
	}
	$unique_user_ids = array_unique($user_ids);
	$res = array();
	foreach ($unique_user_ids as $usr_id){
		$user_info = get_userdata($usr_id);
		$usr_name = $user_info->display_name;
		$karma_val = karma_author_display($usr_id);
		$res[$usr_name] = $karma_val;
	}
	arsort($res);
	$output = '<div class="entry-content"><ul>';
	foreach ($res as $element => $value){
		$output .= '<li>' . $element . ': ' . $value . '</li>';
	}
	$output .= '</ul></div>';
	return $output;
}

/* comment karma raiting display*/
function karma_comment_results_display($karma_comment_id) {
	global $wpdb;
	$get_comment_karma = $wpdb->get_var( "SELECT karma_value FROM wp_karma_new WHERE karma_comment_id = ".$karma_comment_id."" );
	return $get_comment_karma;
}

/* ajax actions for comment karma */
add_action( 'wp_ajax_comment_karma_save_rating', 'do_comment_karma_save_rating' );
add_action( 'wp_ajax_nopriv_comment_karma_save_rating', 'do_comment_karma_save_rating' );

/* comment karma raiting submit */
function do_comment_karma_save_rating() {
	global $wpdb;
	if (is_user_logged_in()){
		
		$comment_id = $_POST['comment_id'];
		$rater = $_POST['com_rater'];
		$owner = $_POST['com_owner'];
		
		$user_rated_post_id = get_user_meta( $rater, 'karma_comment_rated', true );
		$rated_post_id_array = explode(",", $user_rated_post_id);
		$user_rated = in_array( $comment_id, $rated_post_id_array );
		
		if ($rater == $owner){
			$self_posted = true;
		} else {
			$self_posted = false;
		}
		
		if ($self_posted == true){
			$return = array(
				'comment_message' => 'You are not allowed to say Thanks yourself'
			);
			wp_send_json($return);
		} elseif ( !$user_rated ) {
			$rated_post_id_array[] = $comment_id;
			$rated_post_ids = implode(",", $rated_post_id_array);
			update_user_meta( $rater, 'karma_comment_rated', $rated_post_ids );
			
			$cur_karma = karma_comment_results_display($comment_id);
			$new_karma = ($cur_karma + 1);
			if (!is_null($cur_karma)){
				$set_karma = $wpdb->query("UPDATE wp_karma_new SET karma_value = '".$new_karma."' WHERE karma_comment_id =".$comment_id." LIMIT 1");
			} else {
				$set_karma = $wpdb->insert('wp_karma_new', array('karma_id' => '', 'karma_post_id' => '0', 'karma_comment_id' => $comment_id, 'karma_value' => $new_karma, 'kama_post_author_id' => $owner), array('%d', '%d', '%d', '%d', '%d'));
			}
			$return = array(
				'comment_message' => 'You are welcome!',
				'comment_karma' => karma_comment_results_display($comment_id),
				'comment_auth_karma' => karma_author_display($owner)
			);
			wp_send_json($return);
		} else {
			$return = array(
				'comment_message' => 'You have already said Thank You'
			);
			wp_send_json($return);
		}
	} else {
		$return = array(
			'comment_message' => 'Please login to say Thank You'
		);
		wp_send_json($return);
	}
}

/** COMMENTS WALKER */
class supTheme_walker_comment extends Walker_Comment {
     
    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
    /** START_LVL
     * Starts the list before the CHILD elements are added. */
    function start_lvl( &$output, $depth = 0, $args = array() ) {      
        $GLOBALS['comment_depth'] = $depth + 1; ?>
 
                <ul class="children">
<?php }
 
    /** END_LVL
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>
 
        </ul><!-- /.children -->
         
<?php }
     
    /** START_EL */
    function start_el( &$output, $comment, $depth, $args, $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment;
        $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>
         
        <li <?php comment_class( $parent_class ); ?> id="comment-<?php comment_ID() ?>">
            <article id="comment-body-<?php comment_ID() ?>" class="comment-body">
             
             	<footer class="comment-meta">
                	<div class="comment-author vcard author">
                    	<?php
							$com_obj = get_comment(get_comment_ID());
							$com_author_id = ($com_obj->user_id);
						?>
						<?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?>
                        <cite class="fn n author-name"><?php echo get_comment_author_link(); ?></cite><span title="Author's karma" class="rate_val"><?php echo karma_author_display($com_author_id); ?></span>
                    </div><!-- /.comment-author -->
                    <div class="comment-metadata comment-meta-data">
                        <a href="<?php echo htmlspecialchars( get_comment_link( get_comment_ID() ) ) ?>"><?php comment_date(); ?> at <?php comment_time(); ?></a> <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?><span class="karma_val"><?php if(function_exists('karma_comment_results_display')) { echo karma_comment_results_display(get_comment_ID()); } ?></span><a class="karma"><i class="fa fa-trophy"></i>Say Thank you!</a><div class="msg"></div>
                    </div><!-- /.comment-meta -->
                </footer>
 
                <div id="comment-content-<?php comment_ID(); ?>" class="comment-content">
                    <?php if( !$comment->comment_approved ) : ?>
                    <em class="comment-awaiting-moderation">Your comment is awaiting moderation.</em>
                     
                    <?php else: comment_text(); ?>
                    <?php endif; ?>
                </div><!-- /.comment-content -->
 
                <div class="reply">
                    <?php $reply_args = array(
                        'add_below' => $add_below,
                        'depth' => $depth,
                        'max_depth' => $args['max_depth'] );
     
                    comment_reply_link( array_merge( $args, $reply_args ) );  ?>
                </div><!-- /.reply -->
            </article><!-- /.comment-body -->
            <script type="text/javascript">
			jQuery('#comment-<?php comment_ID() ?> .karma').click(function() {
				karma_comment_rate_ajax(
					'#comment-<?php echo comment_ID(); ?>',
					'<?php echo comment_ID(); ?>',
					'<?php echo get_current_user_id(); ?>',
					'<?php echo $com_author_id; ?>'
				);
			});
			</script>
 
    <?php }
 
    function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
         
        </li><!-- /#comment-' . get_comment_ID() . ' -->
        
    <?php }
}

/* ajax actions for user profile page */
add_action( 'wp_ajax_update_user_profile', 'do_update_user_profile' );
add_action( 'wp_ajax_update_user_hobbies', 'do_update_user_hobbies' );

/* updating user profile info */
function do_update_user_profile() {
	if (is_user_logged_in()){
		$usr_id = $_POST['user_id'];
		$new_pwd = $_POST['new_pwd'];
		$verify_pwd = $_POST['confirm_pwd'];
		$new_mail = $_POST['newmail'];
		$new_firstname = $_POST['newfirstname'];
		$new_lastname = $_POST['newlastname'];
		$new_displayname = $_POST['newdisplayname'];
		$new_gender = $_POST['newgender'];
		$new_city = $_POST['newcity'];
		$new_shift = $_POST['newshift'];
		$return = array();
		
		if ($new_pwd){
			if ($new_pwd == $verify_pwd){
				wp_set_password($new_pwd, $usr_id);
				$return = array(
					'success' => '1',
					'pwd_message' => 'Password has been updated. Please re-login to your account!'
				);
			} else {
				$return = array(
					'success' => '0',
					'pwd_message' => 'Passwords do not match'
				);
			}
		}
		
		if ($new_mail != 'false'){
			$mail_to_db = strip_tags($new_mail);
		}
		if ($new_firstname != 'false'){
			$firstname_to_db = strip_tags($new_firstname);
		}
		if ($new_lastname != 'false'){
			$lastname_to_db = strip_tags($new_lastname);
		}
		if ($new_displayname != 'false'){
			$displayname_to_db = strip_tags($new_displayname);
		}
		if ($new_gender != 'false'){
			$gender_to_db = strip_tags($new_gender);
		}
		if ($new_city != 'false'){
			$city_to_db = strip_tags($new_city);
		}
		if ($new_shift != 'false'){
			$shift_to_db = $new_shift;
		}
		
		if ($firstname_to_db || $lastname_to_db){
			if ($firstname_to_db){
				$firstname_upd = update_user_meta($usr_id, 'first_name', $firstname_to_db);
			}
			if ($lastname_to_db){
				$lastname_upd = update_user_meta($usr_id, 'last_name', $lastname_to_db);
			}
			if ($firstname_upd && $lastname_upd) {
				$return = array(
					'success' => '1',
					'name_message' => 'First and last names were updated'
				);
			} elseif ($firstname_upd) {
				$return = array(
					'success' => '1',
					'name_message' => 'First name was updated'
				);
			} else {
				$return = array(
					'success' => '1',
					'name_message' => 'Last name was updated'
				);
			}
			
		}
		
		if ($mail_to_db || $displayname_to_db){
			if ($mail_to_db && $displayname_to_db){
				$usr_data = array(
					'ID' => $usr_id,
					'user_email' => $mail_to_db,
					'display_name' => $displayname_to_db
				);
			} elseif ($mail_to_db){
				$usr_data = array(
					'ID' => $usr_id,
					'user_email' => $mail_to_db
				);
			} else {
				$usr_data = array(
					'ID' => $usr_id,
					'display_name' => $displayname_to_db
				);
			}
			$user_update = wp_update_user($usr_data);
			if ($user_update){
				$return = array(
					'success' => '1',
					'mail_message' => 'Email and/or Display name was/were updated'
				);
			} else {
				$return = array(
					'success' => '0',
					'mail_message' => 'Email and/or Display name was/were not updated'
				);
			}
		}
		
		if ($gender_to_db){
			if (update_user_meta($usr_id, '_gender', $gender_to_db)){
				$return = array(
					'success' => '1',
					'gender_message' => 'Gender has been updated'
				);
			} else {
				$return = array(
					'success' => '0',
					'gender_message' => 'Gender has not been updated'
				);
			}
		}
		
		if ($city_to_db){
			if (update_user_meta($usr_id, '_city', $city_to_db)){
				$return = array(
					'success' => '1',
					'city_message' => 'City information has been updated'
				);
			} else {
				$return = array(
					'success' => '0',
					'city_message' => 'City information has not been updated'
				);
			}
		}
		
		if ($shift_to_db){
			if (update_user_meta($usr_id, '_shift', $shift_to_db)){
				$return = array(
					'success' => '1',
					'shift_message' => 'Shift information has been updated'
				);
			} else {
				$return = array(
					'success' => '0',
					'shift_message' => 'Shift information has not been updated'
				);
			}
		}
		wp_send_json($return);
	}
}

/* updating user hobbies */
function do_update_user_hobbies(){
	if (is_user_logged_in()){
		$usr_id = $_POST['user_id'];
		$usr_hobbies = $_POST['hobbies_list'];
		
		if ($usr_hobbies){
			if (update_user_meta($usr_id, '_hobbies', $usr_hobbies)){
				$return = array(
					'hob_success' => '1',
					'hobby_message' => 'Hobbies have been updated'
				);
				wp_send_json($return);
			} else {
				$return = array(
					'hob_success' => '0',
					'hobby_message' => 'Hobbies have not been updated'
				);
				wp_send_json($return);
			}
		}
	}
}

/* ajax action for admin hobbies - remove category */
add_action( 'wp_ajax_rem_hobby_cat', 'do_rem_hobby_cat' );

function do_rem_hobby_cat(){
	$cat_name = $_POST['cat_name'];
	if ($cat_name){
		$get_hobbies = get_option('hobby');
		unset($get_hobbies[$cat_name]);
		if (update_option( 'hobby', $get_hobbies )){
			$return = array(
				'message' => 'Hobby category has been removed'
			);
			wp_send_json($return);
		} else {
			$return = array(
				'message' => 'Hobby category has not been removed'
			);
			wp_send_json($return);
		}
	}
}

/* ajax action for admin hobbies - remove hobby from category */
add_action( 'wp_ajax_rem_hobby', 'do_rem_hobby' );

function do_rem_hobby(){
	$hobby_key = $_POST['hobby_key'];
	$cat_name = $_POST['cat_name'];
	if ($cat_name){
		$get_hobbies = get_option('hobby');
		$get_single_cat = $get_hobbies[$cat_name];
		unset($get_single_cat[$hobby_key]);
		$get_hobbies[$cat_name] = $get_single_cat;
		if (update_option( 'hobby', $get_hobbies )){
			$return = array(
				'message_hob' => 'Hobby has been removed'
			);
			wp_send_json($return);
		} else {
			$return = array(
				'message_hob' => 'Hobby has not been removed'
			);
			wp_send_json($return);
		}
	} else {
		$return = array(
			'message_hob' => 'Some shit has happened!'
		);
		wp_send_json($return);
	}
}
/* ajax action for user rank - load user's rank */
add_action( 'wp_ajax_get_rating_data', 'do_get_rating_data' );

function do_get_rating_data(){
	$user_id = $_POST['usrid'];
	if ($user_id){
		$pts_arr = get_user_meta($user_id, '_pts', true);
		if ($pts_arr){
			$output_pts .= '<table><tr><th><strong>Rank</strong></th><th><strong>PTS</strong></th><th><strong>Date</strong></th><th><strong>Delete</strong></th></tr>';
			foreach ($pts_arr as $pts_key=>$pts_values){
				$output_pts .= '<tr id="'. $pts_key .'">';
				foreach ($pts_values as $value){
					$rank_val = '';
					if ($value == 1){
						$rank_val = 'novice';
						$output_pts .= '<td title="1">' . $rank_val . '</td>';
					} elseif ($value == 2) {
						$rank_val = 'neophyte';
						$output_pts .= '<td title="2">' . $rank_val . '</td>';
					} elseif ($value == 3) {
						$rank_val = 'apprentice';
						$output_pts .= '<td title="3">' . $rank_val . '</td>';
					} elseif ($value == 4) {
						$rank_val = '1 - follower';
						$output_pts .= '<td title="4">' . $rank_val . '</td>';
					} elseif ($value == 5) {
						$rank_val = '2 - sophomore';
						$output_pts .= '<td title="5">' . $rank_val . '</td>';
					} elseif ($value == 6) {
						$rank_val = '3 - junior technician';
						$output_pts .= '<td title="6">' . $rank_val . '</td>';
					} elseif ($value == 7) {
						$rank_val = '4 - senior technician';
						$output_pts .= '<td title="7">' . $rank_val . '</td>';
					} elseif ($value == 8) {
						$rank_val = '5 - leading technician';
						$output_pts .= '<td title="8">' . $rank_val . '</td>';
					} elseif ($value == 9) {
						$rank_val = '6 - expert';
						$output_pts .= '<td title="9">' . $rank_val . '</td>';
					} elseif ($value == 10) {
						$rank_val = '7 - guru';
						$output_pts .= '<td title="10">' . $rank_val . '</td>';
					} elseif ($value == 11) {
						$rank_val = '8 - master';
						$output_pts .= '<td title="11">' . $rank_val . '</td>';
					} elseif ($value == 12) {
						$rank_val = '9 - grand master';
						$output_pts .= '<td title="12">' . $rank_val . '</td>';
					} elseif ($value == 13) {
						$rank_val = '10 - star technician';
						$output_pts .= '<td title="13">' . $rank_val . '</td>';
					} elseif ($value == 14) {
						$rank_val = '11 - the legend';
						$output_pts .= '<td title="14">' . $rank_val . '</td>';
					} elseif ($value == 15) {
						$rank_val = '12 - magician';
						$output_pts .= '<td title="15">' . $rank_val . '</td>';
					} else {
						$output_pts .= '<td>' . $value . '</td>';
					}
				}
				$output_pts .= '<td align="center"><span class="dashicons dashicons-trash"></span></td>';
				$output_pts .= '</tr>';
			}
			$output_pts .= '</table>';
		}
		if ($pts_arr){
			$return = array(
				'message_pts' => $output_pts
			);
		} else {
			$return = array(
				'message_pts' => 'No Data'
			);
		}
		wp_send_json($return);
	}
}

/* ajax action for admin hobbies - remove category */
add_action( 'wp_ajax_rem_rank', 'do_rem_rank' );

function do_rem_rank(){
	$rank_arrKey = $_POST['rank_arrKey'];
	$user_id = $_POST['userID'];
	if (is_numeric($rank_arrKey)){
		$get_ranks = get_user_meta($user_id, '_pts', true);
		unset($get_ranks[$rank_arrKey]);
		if (update_user_meta($user_id, '_pts', $get_ranks)){
			$return = array(
				'message' => 'Value has been removed'
			);
		} else {
			$return = array(
				'message' => 'Value has not been removed'
			);
		}
		wp_send_json($return);
	}
}