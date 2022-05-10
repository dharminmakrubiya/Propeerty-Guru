<?php
/**
 * Elegant Recipe Blog Theme Customizer
 *
 * @package elegant_recipe_blog
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function elegant_recipe_blog_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    $elegant_recipe_blog_options = elegant_recipe_blog_theme_options();

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', [
            'selector' => '.site-title a',
            'render_callback' => 'elegant_recipe_blog_customize_partial_blogname',
        ]);
        $wp_customize->selective_refresh->add_partial('blogdescription', [
            'selector' => '.site-description',
            'render_callback' => 'elegant_recipe_blog_customize_partial_blogdescription',
        ]);
    }

    $wp_customize->add_panel('theme_options', [
        'title' => esc_html__('Theme Options', 'elegant-recipe-blog'),
        'priority' => 2,
    ]);

    /* Header Section */
    $wp_customize->add_section('header_section', [
        'title' => esc_html__('Header Section', 'elegant-recipe-blog'),
        'panel' => 'theme_options',
        'description' => esc_html__(
            'Only Facebook and Instagram social links are available in Free version','elegant-recipe-blog'
        ),
        'capability' => 'edit_theme_options',
    ]);

    $wp_customize->add_setting('elegant_recipe_blog_theme_options[facebook]', [
        'type' => 'option',
        'default' => $elegant_recipe_blog_options['facebook'],
        'sanitize_callback' => 'elegant_recipe_blog_sanitize_url',
    ]);
    $wp_customize->add_control('elegant_recipe_blog_theme_options[facebook]', [
        'label' => esc_html__('Facebook Link', 'elegant-recipe-blog'),
        'type' => 'url',
        'section' => 'header_section',
        'settings' => 'elegant_recipe_blog_theme_options[facebook]',
    ]);

    $wp_customize->add_setting('elegant_recipe_blog_theme_options[twitter]', [
        'type' => 'option',
        'default' => $elegant_recipe_blog_options['twitter'],
        'sanitize_callback' => 'elegant_recipe_blog_sanitize_url',
    ]);
    $wp_customize->add_control('elegant_recipe_blog_theme_options[twitter]', [
        'label' => esc_html__('Twitter Link', 'elegant-recipe-blog'),
        'type' => 'url',
        'section' => 'header_section',
        'settings' => 'elegant_recipe_blog_theme_options[twitter]',
    ]);


    $wp_customize->add_setting('elegant_recipe_blog_theme_options[search_show]', [
        'type' => 'option',
        'default' => true,
        'default' => $elegant_recipe_blog_options['search_show'],
        'sanitize_callback' => 'elegant_recipe_blog_sanitize_checkbox',
    ]);
    $wp_customize->add_control(
        'elegant_recipe_blog_theme_options[search_show]',
        [
            'label' => esc_html__('Show Search', 'elegant-recipe-blog'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'header_section',
        ]
    );



    //radio box sanitization function
    function elegant_recipe_blog_sanitize_radio( $input, $setting ){

        //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
        $input = sanitize_key($input);

        //get the list of possible radio box options
        $choices = $setting->manager->get_control( $setting->id )->choices;

        //return input if valid or return default option
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

    }
    $wp_customize->add_section('banner_carousel_section', [
        'title' => esc_html__('Banner Carousel Section', 'elegant-recipe-blog'),
        'panel' => 'theme_options',
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_setting(
        'elegant_recipe_blog_theme_options[blog_carousel_category]',
        [
            'type' => 'option',
            'sanitize_callback' => 'elegant_recipe_blog_sanitize_select',
            'default' => $elegant_recipe_blog_options['blog_carousel_category'],
        ]
    );

    $wp_customize->add_control(
        'elegant_recipe_blog_theme_options[blog_carousel_category]',
        [
            'section' => 'banner_carousel_section',
            'type' => 'select',
            'choices' => elegant_recipe_blog_get_categories_select(),
            'label' => esc_html__('Select Category to show Recipes', 'elegant-recipe-blog'),
            'description' => esc_html__(
                'Max 3 Posts will be shown from the selected Category and no carousel in Free Version ',
                'elegant-recipe-blog'
            ),
            'settings' => 'elegant_recipe_blog_theme_options[blog_carousel_category]',
            'priority' => 1,
        ]
    );

    function elegant_recipe_blog_sanitize_checkbox($input)
    {
        if (true === $input) {
            return 1;
        } else {
            return 0;
        }
    }



    $wp_customize->add_section(
        'about_section',
        array(
            'title' => esc_html__( 'About Section','elegant-recipe-blog' ),
            'panel'=>'theme_options',
            'capability'=>'edit_theme_options',
        )
    );


    $wp_customize->add_setting('elegant_recipe_blog_theme_options[about_show]',
        array(
            'type' => 'option',
            'default'        => true,
            'default' => $elegant_recipe_blog_options['about_show'],
            'sanitize_callback' => 'elegant_recipe_blog_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('elegant_recipe_blog_theme_options[about_show]',
        array(
            'label' => esc_html__('Show About Section', 'elegant-recipe-blog'),
            'type' => 'Checkbox',
            'priority' => 1,
            'section' => 'about_section',

        )
    );
	$wp_customize->add_setting('elegant_recipe_blog_theme_options[about_title]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('about_title',
	    array(
	        'label' => esc_html__('About Title', 'elegant-recipe-blog'),
	        'type' => 'text',
	        'section' => 'about_section',
	        'settings' => 'elegant_recipe_blog_theme_options[about_title]',
	    )
	);

	$wp_customize->add_setting('elegant_recipe_blog_theme_options[about_desc]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('about_desc',
	    array(
	        'label' => esc_html__('About Description', 'elegant-recipe-blog'),
	        'type' => 'text',
	        'section' => 'about_section',
	        'settings' => 'elegant_recipe_blog_theme_options[about_desc]',
	    )
	);

	$wp_customize->add_setting('elegant_recipe_blog_theme_options[about_bg_image]',
	    array(
	        'type' => 'option',
	        'sanitize_callback' => 'esc_url_raw',
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'elegant_recipe_blog_theme_options[about_bg_image]',
	        array(
	            'label' => esc_html__('Add Image', 'elegant-recipe-blog'),
	            'section' => 'about_section',
	            'settings' => 'elegant_recipe_blog_theme_options[about_bg_image]',
	        ))
	);
	$wp_customize->add_setting('elegant_recipe_blog_theme_options[about_button_txt]',
	    array(
	        'type' => 'option',
	        'default' => $elegant_recipe_blog_options['about_button_txt'],
	        'sanitize_callback' => 'sanitize_text_field',
	    )
	);
	$wp_customize->add_control('elegant_recipe_blog_theme_options[about_button_txt]',
	    array(
	        'label' => esc_html__('Button Text', 'elegant-recipe-blog'),
	        'type' => 'text',
	        'section' => 'about_section',
	        'settings' => 'elegant_recipe_blog_theme_options[about_button_txt]',
	    )
	);
	$wp_customize->add_setting('elegant_recipe_blog_theme_options[about_button_url]',
	    array(
	        'type' => 'option',
	        'default' => $elegant_recipe_blog_options['about_button_url'],
	        'sanitize_callback' => 'elegant_recipe_blog_sanitize_url',
	    )
	);
	$wp_customize->add_control('elegant_recipe_blog_theme_options[about_button_url]',
	    array(
	        'label' => esc_html__('Button Link', 'elegant-recipe-blog'),
	        'type' => 'text',
	        'section' => 'about_section',
	        'settings' => 'elegant_recipe_blog_theme_options[about_button_url]',
	    )
	);





    $wp_customize->add_section('bottom_section', [
        'title' => esc_html__('Bottom Recipe Section', 'elegant-recipe-blog'),
        'panel' => 'theme_options',
        'capability' => 'edit_theme_options',
    ]);

    $wp_customize->add_setting('elegant_recipe_blog_theme_options[sidebar_recipe_title]',
    array(
        'type' => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control('sidebar_recipe_title',
    array(
        'label' => esc_html__('Section Title', 'elegant-recipe-blog'),
        'type' => 'text',
        'section' => 'bottom_section',
        'settings' => 'elegant_recipe_blog_theme_options[sidebar_recipe_title]',
    )
);

    $wp_customize->add_setting(
        'elegant_recipe_blog_theme_options[bottom_blog_category]',
        [
            'type' => 'option',
            'sanitize_callback' => 'elegant_recipe_blog_sanitize_select',
            'default' => $elegant_recipe_blog_options['bottom_blog_category'],
        ]
    );

    $wp_customize->add_control(
        'elegant_recipe_blog_theme_options[bottom_blog_category]',
        [
            'section' => 'bottom_section',
            'type' => 'select',
            'choices' => elegant_recipe_blog_get_categories_select(),
            'label' => esc_html__('Select Category to show Posts', 'elegant-recipe-blog'),
            'settings' => 'elegant_recipe_blog_theme_options[bottom_blog_category]',
            'priority' => 1,
        ]
    );

    /* Blog Section */

    $wp_customize->add_section('prefooter_section', [
        'title' => esc_html__('Prefooter Section', 'elegant-recipe-blog'),
        'panel' => 'theme_options',
        'capability' => 'edit_theme_options',
    ]);

    $wp_customize->add_setting('elegant_recipe_blog_theme_options[show_prefooter]', [
        'type' => 'option',
        'default' => true,

        'default' => $elegant_recipe_blog_options['show_prefooter'],
        'sanitize_callback' => 'elegant_recipe_blog_sanitize_checkbox',
    ]);

    $wp_customize->add_control('elegant_recipe_blog_theme_options[show_prefooter]', [
        'label' => esc_html__('Show Prefooter Section', 'elegant-recipe-blog'),
        'type' => 'Checkbox',
        'priority' => 1,
        'description' => esc_html__(
            'Copyright text can be changed in Premium version only ',
            'elegant-recipe-blog'
        ),
        'section' => 'prefooter_section',
    ]);
}
add_action('customize_register', 'elegant_recipe_blog_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function elegant_recipe_blog_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function elegant_recipe_blog_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function elegant_recipe_blog_customize_preview_js()
{
    wp_enqueue_script(
        'elegant-recipe-blog-customizer',
        get_template_directory_uri() . '/js/customizer.js',
        ['customize-preview'],
        '20151215',
        true
    );
}
add_action('customize_preview_init', 'elegant_recipe_blog_customize_preview_js');
