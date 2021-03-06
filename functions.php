<?php
/**
 * Marketing functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Marketing
 */

if ( ! function_exists( 'marketing_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function marketing_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Marketing, use a find and replace
	 * to change 'marketing' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'marketing', get_template_directory() . '/languages' );

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
		'primary' => esc_html__( 'Primary', 'marketing' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'marketing_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'marketing_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function marketing_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'marketing_content_width', 640 );
}
add_action( 'after_setup_theme', 'marketing_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function marketing_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'marketing' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'marketing' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'marketing_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function marketing_scripts() {
	wp_enqueue_style( 'marketing-style', get_stylesheet_uri() );

	wp_enqueue_script( 'marketing-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'marketing-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	//Adds Google Fonts
	wp_enqueue_style( 'marketing-google-fonts', 'http://fonts.googleapis.com/css?family=Quicksand|Julius+Sans+One|Poiret+One|Parisienne|Niconne|Reem+Kufi');

	//Enqueues FlexSlider
	wp_enqueue_script('flexslider', get_template_directory_uri() .'/js/jquery.flexslider.js', array('jquery'));
	wp_enqueue_script('flexslider-init', get_template_directory_uri() . '/js/flexslider-init.js', array( 'jquery'));
	//Enqueues FlexSlider Stylesheet
	wp_enqueue_style( 'flexslider-style', get_template_directory_uri() . '/js/css/flexslider.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'marketing_scripts' );

// Option to change content font on homepage
function body_font() {
	$options = get_option( 'mrkting_options_settings' );
		// If option 2 is selected, display this font
		if ($options['mrkting_radio_field'] == 2){ ?>
			<style> 
				body {
					font-family: 'Julius Sans One';
				}
			</style> 
		<?php }
		// If option 3 is selected, display this font
		elseif ($options['mrkting_radio_field'] == 3) {?>
			<style> 
				body {
					font-family: 'Poiret One';
				}
			</style> 
		<?php 
		}
}
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

/**
 * Call the file that controls the theme options
 */
require get_template_directory() .'/inc/options.php';
