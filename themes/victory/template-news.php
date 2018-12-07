<?php
/* Template Name: News Template */

get_header();

$perPageNews = 3;

$args = array(
    'orderby'        => 'date',
    'order'          => 'DESC',
    'post_type'      => 'post',
    'posts_per_page' => $perPageNews,
);

$news = new WP_Query( $args );

?>
    <div class="news-ar">
        <div class="oun-head">
            <h2>Новости</h2>
        </div>
        <div class="news-wrapp">
        <section class="reviews">
            <div class="container">
            <div class="row">
            <div class="col-12">
<?php
    while ( $news->have_posts() ) :
        $news->the_post();
?>
        <div class="wrapper-block">
            <div class="wrapper2">
                <div class="">
                    <div class="review">
                        <div class="photo">
                            <a href="" class="js-watch" data-toggle="modal" data-target="#watch-news"  data-post="<?php echo $post->ID; ?>">
                                <?php if ( get_the_post_thumbnail_url() ) :?>
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="photo">
                                <?php endif; ?>
                            </a>
                        </div>
                        <h4>
                            <a href="" class="js-watch" data-toggle="modal" data-target="#watch-news" data-post="<?php echo $post->ID; ?>"><?php echo get_the_title(); ?></a>
                        </h4>
                        <?php echo html_excerpt_post('html_length_post'); ?>
                        <div class="clean"></div>
                    </div>
                    <div class="clean"></div>
                    <div class="bot-trans">
                            <span>
                                <?php echo get_the_date(); ?>
                            </span>
                        <a href="#" class="js-watch" data-toggle="modal" data-target="#watch-news"  data-post="<?php echo $post->ID; ?>" class="link-review">
                            Читать далее
                        </a>
                    </div>
                    <div class="clean"></div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="watch-news" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
             aria-hidden="true">
            <div class="modal-dialog news modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">

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

        <?php echo pagination_news($perPageNews, 0 ); ?>

        <?php
            wp_reset_query();
        ?>

        </div>
    </div>

<?php get_footer(); ?>

<script>
    $('a[data-target="#watch-news"]').click(function () {
        url =  vars.news_url + '/template-news.php';
        post = $(this).attr('data-post');
        $.post(url, {post : post})
    });
</script>
