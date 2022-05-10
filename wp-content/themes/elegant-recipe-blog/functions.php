<?php
/**
 * Elegant Recipe Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package elegant_recipe_blog
 */

if (!function_exists('elegant_recipe_blog_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function elegant_recipe_blog_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Elegant Recipe Blog, use a find and replace
         * to change 'elegant-recipe-blog' to the name of your theme in all the template files.
         */
        load_theme_textdomain(
            'elegant-recipe-blog',
            get_template_directory() . '/languages'
        );

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-carousel-thumbnails/
         */
        add_theme_support('post-thumbnails');
        remove_theme_support( 'widgets-block-editor' );

        add_image_size('elegant-recipe-blog-blog-thumbnail-img', 600, 400, true);
        add_image_size('elegant-recipe-blog-custom-size', 400, 550, true);
    

        // This theme uses wp_nav_menu() in one location.

        register_nav_menus([
            'primary' => esc_html__('Primary Menu', 'elegant-recipe-blog'),
        ]);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ]);
        add_theme_support('custom-header');

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters('elegant_recipe_blog_custom_background_args', [
                'default-color' => 'ffffff',
                'default-image' => '',
            ])
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', [
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ]);
    }
endif;
add_action('after_setup_theme', 'elegant_recipe_blog_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function elegant_recipe_blog_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('elegant_recipe_blog_content_width', 640);
}
add_action('after_setup_theme', 'elegant_recipe_blog_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function elegant_recipe_blog_widgets_init()
{
    register_sidebar([
        'name' => esc_html__('Sidebar', 'elegant-recipe-blog'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'elegant-recipe-blog'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ]);
    for ($i = 1; $i <= 3; $i++) {
        register_sidebar([
            'name' => esc_html__('Elegant Recipe Blog Footer Widget', 'elegant-recipe-blog') . $i,
            'id' => 'elegant_recipe_blog_footer_' . $i,
            'description' =>
                esc_html__('Shows Widgets in Footer', 'elegant-recipe-blog') . $i,
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ]);
    }
    register_sidebar([
        'name' => esc_html__('HomePage Section Sidebar', 'elegant-recipe-blog'),
        'id' => 'home-sidebar',
        'description' => esc_html__('Add widgets here.', 'elegant-recipe-blog'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ]);
}
add_action('widgets_init', 'elegant_recipe_blog_widgets_init');



/**
 * Enqueue scripts and styles.
 */
function elegant_recipe_blog_scripts_enqueue()
{
    wp_enqueue_style('elegant-recipe-blog-style', get_stylesheet_uri());
    wp_enqueue_style('elegant-recipe-blog-font', elegant_recipe_blog_font_url(), [], null);
    wp_enqueue_style(
        'bootstrap-css',
        get_template_directory_uri() . '/assets/css/bootstrap.min.css',
        [],
        '1.0'
    );
    wp_enqueue_style(
        'fontawesome-css',
        get_template_directory_uri() . '/assets/css/font-awesome.css',
        [],
        '1.0'
    );
    wp_enqueue_style(
        'slick-css',
        get_template_directory_uri() . '/assets/css/slick.css',
        [],
        '1.0'
    );
    wp_enqueue_style(
        'ionicons-css',
        get_template_directory_uri() . '/assets/css/ionicons.css',
        [],
        '1.0'
    );
    wp_enqueue_style(
        'elegant-recipe-blog-css',
        get_template_directory_uri() . '/assets/css/elegant-recipe-blog.css',
        [],
        '1.0'
    );
    wp_enqueue_style(
        'elegant-recipe-blog-media-css',
        get_template_directory_uri() . '/assets/css/media-queries.css',
        [],
        '1.0'
    );
    wp_enqueue_script(
        'elegant-recipe-blog-navigation',
        get_template_directory_uri() . '/js/navigation.js',
        ['jquery'],
        '1.0',
        true
    );
    wp_enqueue_script(
        'bootstrap-js',
        get_template_directory_uri() . '/assets/js/bootstrap.min.js',
        ['jquery'],
        '1.0',
        true
    );

    wp_enqueue_script(
        'slick-js',
        get_template_directory_uri() . '/assets/js/slick.min.js',
        ['jquery'],
        '1.0',
        true
    );

    wp_enqueue_script(
        'elegant-recipe-blog-app',
        get_template_directory_uri() . '/assets/js/app.js',
        ['jquery'],
        '1.0',
        true
    );


    wp_enqueue_script(
        'elegant-recipe-blog-skip-link-focus-fix',
        get_template_directory_uri() . '/js/skip-link-focus-fix.js',
        ['jquery'],
        '',
        true
    );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'elegant_recipe_blog_scripts_enqueue');

function elegant_recipe_blog_custom_customize_enqueue()
{
    wp_enqueue_style(
        'elegant-recipe-blog-customizer-style',
        trailingslashit(get_template_directory_uri()) .
            'inc/customizer/css/customizer-control.css'
    );
}

add_action(
    'customize_controls_enqueue_scripts',
    'elegant_recipe_blog_custom_customize_enqueue'
);

if (!function_exists('elegant_recipe_blog_font_url')):
    function elegant_recipe_blog_font_url()
    {
        $fonts_url = '';
        $fonts = [];


        if ('off' !== _x('on', 'Montserrat font: on or off', 'elegant-recipe-blog')) {
            $fonts[] = 'Montserrat:400';
        }

        if ('off' !== _x('on', 'Open Sans font: on or off', 'elegant-recipe-blog')) {
            $fonts[] = 'Open Sans:400';
        }
        if ('off' !== _x('on', 'Dancing Script font: on or off', 'elegant-recipe-blog')) {
            $fonts[] = 'Dancing Script:400';
        }
        if ($fonts) {
            $fonts_url = add_query_arg(
                [
                    'family' => urlencode(implode('|', $fonts)),
                ],
                '//fonts.googleapis.com/css'
            );
        }

        return $fonts_url;
    }
endif;

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/elegant-recipe-blog-menu.php';
/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer-control.php';
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/elegant-recipe-blog-customizer-default.php';
require get_template_directory() . '/plugin-activation.php';
require get_template_directory() . '/lib/elegant-recipe-blog-tgmp.php';
require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/elegant-recipe-blog-upgrade/class-customize.php' );



/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

if (!function_exists('elegant_recipe_blog_get_excerpt')):
    function elegant_recipe_blog_get_excerpt($post_id, $count)
    {
        $content_post = get_post($post_id);
        $excerpt = $content_post->post_content;

        $excerpt = strip_shortcodes($excerpt);
        $excerpt = strip_tags($excerpt);

        $excerpt = preg_replace('/\s\s+/', ' ', $excerpt);
        $excerpt = preg_replace('#\[[^\]]+\]#', ' ', $excerpt);
        $strip = explode(' ', $excerpt);
        foreach ($strip as $key => $single) {
            if (!filter_var($single, FILTER_VALIDATE_URL) === false) {
                unset($strip[$key]);
            }
        }
        $excerpt = implode(' ', $strip);

        $excerpt = substr($excerpt, 0, $count);
        if (strlen($excerpt) >= $count) {
            $excerpt = substr($excerpt, 0, strripos($excerpt, ' '));
            $excerpt = $excerpt . '...';
        }
        return $excerpt;
    }
endif;

if (!function_exists('wp_body_open')) {
    function wp_body_open()
    {
        do_action('wp_body_open');
    }
}



if (!function_exists('elegant_recipe_blog_blank_widget')) {
    function elegant_recipe_blog_blank_widget()
    {
        echo '<div class="col-md-4">';
        if (is_user_logged_in() && current_user_can('edit_theme_options')) {
            echo '<a href="' .
                esc_url(admin_url('widgets.php')) .
                '" target="_blank"><i class="fa fa-plus-circle"></i> ' .
                esc_html__('Add Footer Widget', 'elegant-recipe-blog') .
                '</a>';
        }
        echo '</div>';
    }
}

if (!function_exists('elegant_recipe_blog_archive_link')) {
    function elegant_recipe_blog_archive_link($post)
    {
        $year = date('Y', strtotime($post->post_date));
        $month = date('m', strtotime($post->post_date));
        $day = date('d', strtotime($post->post_date));
        $link = site_url('') . '/' . $year . '/' . $month . '?day=' . $day;
        return $link;
    }
}
