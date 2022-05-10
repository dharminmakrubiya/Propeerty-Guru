<?php
if (!function_exists('elegant_recipe_blog_theme_options')) :
    function elegant_recipe_blog_theme_options()
    {
        $defaults = array(

            'facebook' => '',
            'search_show' => 1,
            'twitter' => '',


            'blog_carousel_category' => '',
            'sidebar_recipe_title' => '',
            

            
            'bottom_blog_category' => '',
            'show_prefooter' => 1,


            'about_show' => '0',
            'about_title' => '',
            'about_desc' => '',
            'about_bg_image' => '',
            'about_button_txt' => '',
            'about_button_url' => '',

        );

        $options = get_option('elegant_recipe_blog_theme_options', $defaults);

        //Parse defaults again - see comments
        $options = wp_parse_args($options, $defaults);

        return $options;
    }
endif;
