<?php
$elegant_recipe_blog_options = elegant_recipe_blog_theme_options();
$about_show            = $elegant_recipe_blog_options['about_show'];
$about_title           = $elegant_recipe_blog_options['about_title'];
$about_desc           = $elegant_recipe_blog_options['about_desc'];
$about_bg_image  = $elegant_recipe_blog_options['about_bg_image'];
$about_button_txt = $elegant_recipe_blog_options['about_button_txt'];
$about_button_url = $elegant_recipe_blog_options['about_button_url'];



if($about_show == 1){   ?>

    <div class="section about-section">
        <div class="container">
            <div class="row">

                    <div class="col-md-6">
                        <img src="<?php echo esc_url($about_bg_image); ?>" alt="" />
                    </div>
                    
                     <div class="col-md-6">
                        <div class="about-wrap">
                            <h2><?php echo esc_html($about_title); ?></h2>
                            <p><?php echo esc_html($about_desc); ?></p>
                            <?php  if( $about_button_txt && $about_button_url):?>
        <a href="<?php echo esc_url($about_button_url); ?>" class="btn btn-default"><?php echo esc_html($about_button_txt); ?></a>
        <?php endif; ?>
                        </div>
                     </div>
                   
            </div>
        </div>
    </div>

<?php } ?>