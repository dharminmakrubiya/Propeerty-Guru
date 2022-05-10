<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package elegant_recipe_blog
 */

$elegant_recipe_blog_options = elegant_recipe_blog_theme_options();
$facebook = $elegant_recipe_blog_options['facebook'];
$twitter = $elegant_recipe_blog_options['twitter'];


$header_search = $elegant_recipe_blog_options['search_show'];

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>


<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e(
     'Skip to content',
     'elegant-recipe-blog'
 ); ?></a>

<?php 
		$image_src = get_header_image();

			if (!empty($image_src)) {
				$image_style =
					"style='background-image:url(" . esc_url($image_src) . ")'"; ?>
				<?php
			} else {
				$image_style = '';
			}
		?>

<div class="main-wrap">
	<header id="masthead" class="site-header big-header">
	<div class="bottom-header">


<div class="container">
	<div class="row">

	<div class="header-social">
				        	
							<ul> <?php
		   if ($facebook) {
			   echo '<a class="social-btn facebook" href="' .
				   esc_url($facebook) .
				   '"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
		   }
	
		   if ($twitter) {
			   echo '<a class="social-btn twitter" href="' .
				   esc_url($twitter) .
				   '"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
		   }
	
?>
								</ul>
							</div>

	<div class="site-branding">
			<?php the_custom_logo(); ?>
			<div class="logo-wrap">

			<?php
if (is_front_page() && is_home()): ?>
				<h2 class="site-title"><a href="<?php echo esc_url(
home_url('/')
); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
				<?php else: ?>
				<h2 class="site-title"><a href="<?php echo esc_url(
home_url('/')
); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
				<?php endif;
$elegant_recipe_blog_description = get_bloginfo('description', 'display');
if ($elegant_recipe_blog_description || is_customize_preview()): ?>
				<p class="site-description"><?php echo $elegant_recipe_blog_description;
// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
?></p>
			<?php endif;
?>
			</div>
		</div><!-- .site-branding -->
	
		<?php if ($header_search): ?>
							<div class="header-search">
							<?php get_search_form(); ?>
							</div>
						<?php endif; ?>

	</div>
</div>
</div>
	<div class="header-top">
			<div class="container">
	             <div class="row">



					<div class="col-md-12">
					<div class="collapse navbar-collapse" id="navbar-collapse">
		            	<nav id="site-navigation" class="main-navigation clearfix">
		             <?php if (has_nav_menu('primary')) { ?>
		                <?php wp_nav_menu([
                      'theme_location' => 'primary',
                      'container' => '',
                      'menu_class' => 'nav navbar-nav navbar-center nav-menu',
                      'menu_id' => 'menu-main',
                      'walker' => new elegant_recipe_blog_nav_walker(),
                      'fallback_cb' => 'elegant_recipe_blog_nav_walker::fallback',
                  ]); ?>
		            	</nav>
		                <?php } else { ?>
		                    <nav id="site-navigation" class="main-navigation clearfix">
		                        <?php wp_page_menu([
                              'menu_class' => 'menu',
                              'menu_id' => 'menuid',
                          ]); ?>
		                    </nav>
		                <?php } ?>

		            </div><!-- End navbar-collapse -->
					</div>




		            
				</div>
			</div>
		</div>







	</header><!-- #masthead -->

	<div class="header-mobile">
		<div class="site-branding">
			<?php the_custom_logo(); ?>
			<div class="logo-wrap">

			<?php
   if (is_front_page() && is_home()): ?>
				<h2 class="site-title"><a href="<?php echo esc_url(
        home_url('/')
    ); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
				<?php else: ?>
				<h2 class="site-title"><a href="<?php echo esc_url(
        home_url('/')
    ); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
				<?php endif;
   $elegant_recipe_blog_description = get_bloginfo('description', 'display');
   if ($elegant_recipe_blog_description || is_customize_preview()): ?>
				<p class="site-description"><?php echo $elegant_recipe_blog_description;
       ?></p>
			<?php endif;
   ?>
			</div>
		</div><!-- .site-branding -->


		<div class="mobile-wrap">
	        <div class="header-social">

			<ul> <?php
       if ($facebook) {
           echo '<a class="social-btn facebook" href="' .
               esc_url($facebook) .
               '"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
       }

       if ($twitter) {
           echo '<a class="social-btn twitter" href="' .
               esc_url($twitter) .
               '"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
       }


       ?>
			                </ul>
			</div>
	   <div id="mobile-menu-wrap">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
	                data-target="#navbar-collapse1" aria-expanded="false">
	            <span class="sr-only"><?php echo esc_html__(
                 'Toggle navigation',
                 'elegant-recipe-blog'
             ); ?></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	        </button>

	        <div class="collapse navbar-collapse" id="navbar-collapse1">

	         <?php if (has_nav_menu('primary')) { ?>
	            <?php wp_nav_menu([
                 'theme_location' => 'primary',
                 'container' => '',
                 'menu_class' => 'nav navbar-nav navbar-center',
                 'menu_id' => 'menu-main',
                 'walker' => new elegant_recipe_blog_nav_walker(),
                 'fallback_cb' => 'elegant_recipe_blog_nav_walker::fallback',
             ]); ?>
	            <?php } else { ?>
	                <nav id="site-navigation" class="main-navigation clearfix">
	                    <?php wp_page_menu([
                         'menu_class' => 'menu',
                         'menu_id' => 'menuid',
                     ]); ?>
	                </nav>
	            <?php } ?>

				<div class="header-search-form">
					<?php if ($header_search) {
         echo get_search_form();
     } ?>
		        </div>
				</div>
		    
	        </div><!-- End navbar-collapse -->
	    </div>
	</div>
	<!-- /main-wrap -->
