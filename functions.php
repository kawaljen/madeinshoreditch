<?php
/**
 * MadeInShoreditch functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package MadeInShoreditch
 */

if ( ! function_exists( 'madeinshoreditch_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function madeinshoreditch_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on MadeInShoreditch, use a find and replace
	 * to change 'madeinshoreditch' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'madeinshoreditch', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'madeinshoreditch' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'madeinshoreditch_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // madeinshoreditch_setup
add_action( 'after_setup_theme', 'madeinshoreditch_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function madeinshoreditch_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'madeinshoreditch_content_width', 640 );
}
add_action( 'after_setup_theme', 'madeinshoreditch_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function madeinshoreditch_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'madeinshoreditch' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'madeinshoreditch_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function madeinshoreditch_scripts() {
	wp_enqueue_style( 'madeinshoreditch-style', get_stylesheet_uri() );

	wp_enqueue_script( 'madeinshoreditch-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'madeinshoreditch-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'madeinshoreditch_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


add_theme_support( 'html5', array( 'search-form' ) );
//-------------------------------------------------------------------------
////////////////////////////////////////////////////////////////////////////////
// get image source link
////////////////////////////////////////////////////////////////////////////////
function mis_get_image_src($string){
$first_img = '';
ob_start();
ob_end_clean();
$first_image = preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $string, $matches );
$import_image = $matches[1][0];
$import_image = str_replace('-150x150','',$import_image);
$final_import_image = str_replace('-300x300','',$import_image);
return $final_import_image;
}

////////////////////////////////////////////////////////////////////////////////
// get featured images
////////////////////////////////////////////////////////////////////////////////
if( !function_exists( 'mis_get_featured_post_image' )):
function mis_get_featured_post_image( $class , $size , $alt , $title ,  $default , $backgroundImage) { //$size - full, large, medium, thumbnail 

global $blog_id, $wpdb, $post, $posts;

$swt_post_thumb = get_post_meta($post->ID, 'thumbnail_html', true);
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);

if($output): $first_img = $matches[1][0]; endif;

if(!empty($swt_post_thumb)):
	$import_img = dez_get_image_src($swt_post_thumb);
	$imgsource=$import_img;
else:
	if( has_post_thumbnail( $post->ID ) ) {
		$imgsource = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size )[0];	
		$imgsource = empty($imgsource )? $first_img : $imgsource; 
	} 
	else {
		if($first_img) {
			$imgsource=$first_img;
		} 
	}
endif;


$imgsource = (empty($imgsource) && $default == 'true')? get_template_directory_uri() . '/images/post-default.jpg' : $imgsource; 
if($backgroundImage)
	return $imgsource;
else
	return "<img class='" . $class . "' src='" . $imgsource . "' alt='" . $alt . "' title='" . $title . "'/>";
}
endif;

////////////////////////////////////////////////////////////////////////////////
// getMenuPosts
///////////////////////////////////////////////////////////////////////////////
if( !function_exists( 'add_js_scripts' )):
function add_js_scripts() {
	wp_enqueue_script( 'script', get_template_directory_uri().'/js/script.js', array('jquery'), '1.0', true );

	// pass Ajax Url to script.js
	wp_localize_script('script', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
add_action('wp_enqueue_scripts', 'add_js_scripts');
endif;


add_action( 'wp_ajax_getMenuItems', 'getMenuItems' );
add_action( 'wp_ajax_nopriv_getMenuItems', 'getMenuItems' );

function getMenuItems() {
    $menu_id = 3787;
    $i=0;
	
	$args = array(
			'post_type'              => 'nav_menu_item',
			'post_status'            => 'publish');
			
	$menu_items = wp_get_nav_menu_items($menu_id, $args);
	$menu_list = array();
	$cat_list = array();


	foreach ( (array) $menu_items as $key => $menu_item ) {
		if($menu_item->object == 'category'){
			$args=array(
				'cat' => $menu_item->object_id,
				'orderby' => 'post_date', 
				'order' => 'DESC',
				'posts_per_page' => 4 // Number of posts to display.
				);
			$my_query = new WP_Query( $args);
				if( $my_query->have_posts() ) {
					while ($my_query->have_posts()) {
						$my_query->the_post();
						// get article
						$item = 
						'<article id="post-'.get_the_ID().'" class="grid-article" ><div class="holder">
							<header class="entry-header grid-article-info">
								<h2 class="entry-title"><a href="'.esc_url( get_permalink()).'" rel="bookmark">'.get_the_title().'</a></h2>
								<a href="'.get_the_author_link().'">by '.get_the_author().'</a>
							</header>
							<div class="entry-content"><div class="img-post" style="background-image:url('.
								mis_get_featured_post_image('random','medium',get_the_title(),get_the_title(),true, true).	
							')"></div></div></div>
						</article>';
						$menu_list[]= array('cat' => $menu_item->ID, 'content' => $item);	
						//$menu_list[]=$menu_items;

					}
				  wp_reset_query();
				}
				else
				{
						//$menu_list[]=$menu_items;
						$menu_list[]= array('cat' => $cat_list[$i]['cat'], 'content' => $args['cat']);
				}
		}
	}
	//print_r($menu_items);
	echo json_encode(array('success' => true, 'result' => $menu_list));

	die();
}
