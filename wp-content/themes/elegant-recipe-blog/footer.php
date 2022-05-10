<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package elegant_recipe_blog
 */

$elegant_recipe_blog_options = elegant_recipe_blog_theme_options();

$show_prefooter = $elegant_recipe_blog_options['show_prefooter'];

?>

<footer id="colophon" class="site-footer">


	<?php if ($show_prefooter== 1){ ?>
	    <section class="footer-sec">
	        <div class="container">
	            <div class="row">
	                <?php if (is_active_sidebar('elegant_recipe_blog_footer_1')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('elegant_recipe_blog_footer_1') ?>
	                    </div>
	                    <?php
	                else: elegant_recipe_blog_blank_widget();
	                endif; ?>
	                <?php if (is_active_sidebar('elegant_recipe_blog_footer_2')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('elegant_recipe_blog_footer_2') ?>
	                    </div>
	                    <?php
	                else: elegant_recipe_blog_blank_widget();
	                endif; ?>
	                <?php if (is_active_sidebar('elegant_recipe_blog_footer_3')) : ?>
	                    <div class="col-md-4">
	                        <?php dynamic_sidebar('elegant_recipe_blog_footer_3') ?>
	                    </div>
	                    <?php
	                else: elegant_recipe_blog_blank_widget();
	                endif; ?>
	            </div>
	        </div>
	    </section>
	<?php } ?>

		<div class="site-info">
		<p><?php esc_html_e('Powered By WordPress', 'elegant-recipe-blog');
                    esc_html_e(' | ', 'elegant-recipe-blog') ?>
                    <a target="_blank" rel="nofollow"
                       href="<?php echo esc_url('https://elegantblogthemes.com/theme/elegant-recipe-blog-best-recipe-blog-wordpress-theme-ever/'); ?>"><?php esc_html_e('Elegant Recipe Blog' , 'elegant-recipe-blog'); ?></a>
                </p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
