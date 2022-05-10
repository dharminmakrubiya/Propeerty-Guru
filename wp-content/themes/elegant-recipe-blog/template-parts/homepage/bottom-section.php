<?php
$elegant_recipe_blog_options = elegant_recipe_blog_theme_options();

$bottom_blog_category = $elegant_recipe_blog_options['bottom_blog_category'];
$content_length = '350';


$sidebar_recipe_title = $elegant_recipe_blog_options['sidebar_recipe_title'];
$paged = get_query_var('page') ? absint(get_query_var('page')) : 1;


?>


<div class="posts-with-sidebar section">
	<div class="container">
		<div class="row">
             <div class="col-md-12">
             <?php if($sidebar_recipe_title){ ?>
             <div class="section-title section-header">
                  
                        <h2><?php echo esc_html($sidebar_recipe_title); ?></h2>
                        <span class="title-decor-line"></span>
                    </div>
                <?php } ?>

                <div class="two-column-posts">
                <?php
                    if ($bottom_blog_category && 'none' != $bottom_blog_category) {
                        
                        $args = [
                            'post_type' => 'post',
                            'posts_per_page' => 6,
                            'post_status' => 'publish',
                            'order' => 'desc',
                            'orderby' => 'menu_order date',
                            'paged' => $paged,
                            'tax_query' => [
                                'relation' => 'AND',
                                [
                                    'taxonomy' => 'category',
                                    'field' => 'slug',
                                    'terms' => [$bottom_blog_category],
                                ],
                            ],
                        ];


                    } else {
                        $args = [
                            'post_type' => 'post',
                            'posts_per_page' => 6,
                            'post_status' => 'publish',
                            'order' => 'desc',
                            'orderby' => 'menu_order date',
                            'paged' => $paged,
                        ];
                    }
                $recent_query = new WP_Query($args);
                if ($recent_query->have_posts()){ ?>


                        <?php
                        while ($recent_query->have_posts()):

                            $recent_query->the_post();
                            global $post;
                            $post_thumbnail_id = get_post_thumbnail_id(
                                get_the_ID()
                            );
                            $image = wp_get_attachment_image_src(
                                $post_thumbnail_id,
                                'elegant-recipe-blog-blog-thumbnail-img'
                            );
                            $content = get_the_content();

                            if (!empty($image)) {
                                $image_style =
                                    "style='background-image:url(" .
                                    esc_url($image[0]) .
                                    ")'";
                            } else {
                                $image_style = '';
                            }
                            ?>
                            <div class="post-content-wrap">
                                <div class="posts-wrap">
                                <a href="<?php echo esc_url(get_the_permalink()); ?>"><img src="<?php echo esc_url(
                                      $image[0]
                                  ); ?>" alt="" /></a>
                                            <div class="category-btn-wrap">
                            <?php 
                            $categories = get_the_category();
                            $separator = ',';
                            $output = '';
                            if ( ! empty( $categories ) ) {
                                foreach( $categories as $category ) {
                                    $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'elegant-recipe-blog' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                                }
                                echo trim( $output, $separator );
                            }
                            ?>
                            </div>
                                <h2><a href="<?php echo esc_url(
                                    get_the_permalink()
                                ); ?>"><?php the_title(); ?></a></h2>


                                  


                                </div>
                            </div>
                        <?php
                        endwhile;
                        $max_posts = $recent_query->max_num_pages;
                        if ($max_posts > 1) {
                            $current_page = max(1, get_query_var('page'));
                            echo '<div class="navigation">';

                            echo paginate_links([
                                'base' => get_pagenum_link(1) . '%_%',
                                'format' => '?paged=%#%',
                                'current' => $current_page,
                                'total' => $max_posts,
                                'type' => 'list',
                                'prev_text' => esc_html__(
                                    'Previous Posts',
                                    'elegant-recipe-blog'
                                ),
                                'next_text' => esc_html__(
                                    'More Posts',
                                    'elegant-recipe-blog'
                                ),
                            ]);
                            echo '</div>';
                        }
                        wp_reset_postdata();
                        ?>
                    <?php } ;
                ?>
             </div>

    


             </div>
             
        </div>
    </div>
</div>
        
