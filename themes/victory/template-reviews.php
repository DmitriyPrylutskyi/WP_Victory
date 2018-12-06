<?php
/* Template Name: Reviews Template */

get_header();

$perPageReviews = 3;

$args = array(
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_type'      => array( 'reviews' ),
    'post_status'    => array( 'publish' ),
    'posts_per_page' => $perPageReviews,
);

$reviews = new WP_Query( $args );

?>
<div class="rewiews-ar">
    <div class="oun-head">
        <h2>Наши отзывы</h2>
    </div>
    <div class="rewiews-wrapp">
        <section class="reviews">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    <?php
                        while ( $reviews->have_posts() ) :
                            $reviews->the_post();

                            $user_name      = get_the_title();
                            $user_photo     = get_field('photo_review');
                            $location       = get_field('location');
                            $date_review    = (get_field('date_review') == '') ? get_the_date('j F Y') : get_field('date_review');
                            $text_review    = get_field('text_review');
                    ?>
                            <div class="wrapper-block">
                                <div class="wrapper2">
                                    <div class="">
                                        <div class="review">
                                            <div class="photo">
                                                <?php if ( !empty($user_photo) ) :?>
                                                    <img src="<?php echo $user_photo; ?>" alt="photo">
                                                <?php endif; ?>
                                            </div>
                                            <h4>
                                                <?php echo $user_name; ?>
                                            </h4>
                                            <span>
                                                <?php echo $date_review ?>
                                            </span>
                                            <h5>
                                                <?php echo $location; ?>
                                            </h5>
                                            <p>
                                                <?php echo $text_review; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        endwhile;
                    ?>
                    </div>
                </div>
            </div>
        </section>

        <?php echo pagination_reviews($perPageReviews, 0 ); ?>

        <?php
            wp_reset_query();
        ?>

    </div>
</div>

<?php get_footer(); ?>

