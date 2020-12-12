<?php
/**
 * Template Name: Custom Query
 */
?>
<?php get_header(); ?>
<body <?php body_class(); ?>>
<?php get_template_part( "/template-parts/common/hero" ); ?>
    <div class="posts text-center">
        <?php
        $paged          = get_query_var( "paged" ) ? get_query_var( "paged" ) : 1;
        $posts_per_page = -1;
        $post_ids       = array( 36, 59, 29, 1, 17, 41);
        $_p             = new WP_Query( array(
            'posts_per_page' => $posts_per_page,
            'post__in'       => $post_ids,
            'orderby'        => 'post__in',
            'paged'          => $paged
        ) );
        while($_p->have_posts()) {
            $_p->the_post();
            setup_postdata( $post );
            ?>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h2></a>
            <?php
        }
        wp_reset_query();
        ?>

        <div class="container post-pagination">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <?php
                    echo paginate_links( array(
                        'total' => ceil( count( $post_ids ) / $posts_per_page )
                    ) );
                    ?>
                </div>
            </div>
        </div>

    </div>
<?php get_footer(); ?>