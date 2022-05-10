<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package elegant_recipe_blog
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if (is_search() || is_home()) {
	global $post;
    $post_thumbnail_id = get_post_thumbnail_id(
        get_the_ID()
    );
    $image = wp_get_attachment_image_src(
        $post_thumbnail_id,
        'elegant-recipe-blog-blog-thumbnail-img'
    );
    ?>
    <a href="<?php echo esc_url(get_the_permalink()); ?>"><img src="<?php echo esc_url(
        $image[0]
    ); ?>" alt="" /></a> <?php
    
    } ?>


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

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( is_single() ) {
			?>
										<ul class="post-meta">
                            <li class="meta-date"><a href="<?php echo esc_url(
                                elegant_recipe_blog_archive_link($post)
                            ); ?>"><time class="entry-date published" datetime="<?php echo esc_url(
    elegant_recipe_blog_archive_link($post)
); ?>"><?php echo esc_html(the_time(get_option('date_format'))); ?></time>
                                                </a></li>
                                                <li class="meta-comment"><a
                                                    href="<?php echo esc_url(
                                                        get_comments_link(
                                                            get_the_ID()
                                                        )
                                                    ); ?>"><?php printf(
    /* translators: 1: number of comments */ _nx(
        '%1$s Comment',
        '%1$s Comments',
        get_comments_number(),
        '',
        'elegant-recipe-blog'
    ),
    number_format_i18n(get_comments_number())
); ?></a></li>
							</ul>
		<?php } ?>

	</header><!-- .entry-header -->

    <?php if (is_single()) {
         elegant_recipe_blog_post_thumbnail();
    }
    ?>

	<div class="entry-content">
            <?php

            global $numpages;
            if (is_search() || is_home()):
                 
            else:
                the_content(sprintf(wp_kses(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'elegant-recipe-blog'),array('span' => array('class' => array(),),)),get_the_title()));
            endif;
            if(is_single()) {
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'elegant-recipe-blog'),
                    'after' => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ));
            }
            ?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->


<?php if (is_single()) {
 elegant_recipe_blog_single_related_posts($post->ID);
}
?>