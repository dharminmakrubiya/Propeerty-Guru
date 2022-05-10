<?php
/**
 *
 * Template Name: Frontpage

 *
 * @package Elegant Recipe Blog
 */

$elegant_recipe_blog_options = elegant_recipe_blog_theme_options();


get_header();



get_template_part('template-parts/homepage/blog-carousel', 'section');


get_template_part('template-parts/homepage/about-section', 'section');


get_template_part('template-parts/homepage/bottom-section', 'section');



get_footer();
