<?php
$elegant_recipe_blog_options = elegant_recipe_blog_theme_options();
$blog_carousel_category = $elegant_recipe_blog_options['blog_carousel_category'];
?>

<?php
if ($blog_carousel_category && 'none' != $blog_carousel_category) {
    $args = [
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post_status' => 'publish',
        'order' => 'desc',
        'orderby' => 'menu_order date',
        'tax_query' => [
            'relation' => 'AND',
            [
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => [$blog_carousel_category],
            ],
        ],
    ];
} else {
    $args = [
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post_status' => 'publish',
        'order' => 'desc',
        'orderby' => 'menu_order date',
    ];
}

$blog_query = new WP_Query($args);
$loop = 0;

if ($blog_query->have_posts()): ?>

<div class="blog-carousel-section section">
	<div class="container">
		<div class="row">
			<div class="card-slider-wrap fourcolumn">

            <?php
            while ($blog_query->have_posts()):

                $blog_query->the_post();

                    $image_src = wp_get_attachment_image_src(
                        get_post_thumbnail_id(),
                        'elegant-recipe-blog-custom-size'
                    );

                if($image_src){
                    $url = $image_src[0];
                    }
                ?>

                <div class="banner-wrap-element">
					<div class="post-content-wrap">
						<div class="post-thumb">
                        
                        <a href="<?php echo esc_url(get_the_permalink()); ?>"><img src="<?php echo esc_url($url); ?>"></a>
						</div>
						<div class="post-content">
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
							<h3>
								<a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a>
							</h3>
                            
						</div>
					</div>
				</div>

                <?php
            endwhile;
            wp_reset_postdata();
            ?>
			</div>
		</div>
	</div>
</div>

<?php endif;
?>

