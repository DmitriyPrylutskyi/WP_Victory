<?php
/* Template Name: Home Template */

get_header();

//section about
$about_img = get_field('about_image');

//section advantages
$i = 1;
if( have_rows('advantages') ):
    while ( have_rows('advantages') ) : the_row();

            $image_short[$i]    = get_sub_field('advantage_image_short');
            $image_long[$i]     = get_sub_field('advantage_image_long');
            $description_short  = get_sub_field('advantage_description_short');
            $description_long   = get_sub_field('advantage_description_long');

            if ( $i % 2 == 0) {
                $advantages .= '<div class="advantage-block right">';
                $advantages .= '<div class="advantage-desc">';
                $advantages .= '<p class="active">';
                $advantages .= $description_short;
                $advantages .= '</p>';
                $advantages .= '<p class="small-text scrollbar">';
                $advantages .= $description_long;
                $advantages .= '</p>';
                $advantages .= '</div>';
                $advantages .= '<div class="advantage-img">';
                $advantages .= '<img class="active" src="' .$image_short[$i]. '" alt="advantage">';
                $advantages .= '<img src="' .$image_long[$i]. '" alt="advantage">';
            }
            else {
                $advantages .= '<div class="advantage-block">';
                $advantages .= '<div class="advantage-img">';
                $advantages .= '<img class="active" src="' .$image_short[$i]. '" alt="advantage">';
                $advantages .= '<img src="' .$image_long[$i]. '" alt="advantage">';
                $advantages .= '</div>';
                $advantages .= '<div class="advantage-desc">';
                $advantages .= '<p class="active">';
                $advantages .= $description_short;
                $advantages .= '</p>';
                $advantages .= '<p class="small-text scrollbar">';
                $advantages .= $description_long;
                $advantages .= '</p>';
            }
            $advantages .= '</div>';
            $advantages .= '</div>';

            $i++;

    endwhile;
endif;

//section liders
if( have_rows('liders') ):
    while ( have_rows('liders') ) : the_row();

        $fio        = get_sub_field('fio');
        $position   = get_sub_field('position');
        $photo      = get_sub_field('photo');

        $liders .= '<div class="col-12 col-md-4 lider">';
        $liders .= '<div class="img-wrapper" style="background-image: url(' . $photo .');"></div>';
        $liders .= '<h4>';
        $liders .= $fio;
        $liders .= '</h4>';
        $liders .= '<p>';
        $liders .= $position;
        $liders .= '</p>';
        $liders .= '</div>';

    endwhile;
endif;

//section reviews

// WP_Query arguments
$args = array(
    'post_type'              => array( 'reviews' ),
    'post_status'            => array( 'publish' ),
    'order'                  => 'DESC',
    'orderby'                => 'date',
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {

    while ( $query->have_posts() ) {
        $query->the_post();

        $user_name      = get_the_title();
        $user_photo     = get_field('photo_review');
        $location       = get_field('location');
        $date_review    = (get_field('date_review') == '') ? get_the_date('j F Y') : get_field('date_review');
        $text_review    = get_field('text_review');

        $reviews .= '<div class="review">';
        $reviews .= '<div class="photo">';
        if ( !empty($user_photo) ) {
            $reviews .= '<img src="' . $user_photo . '" alt="photo">';
        }
        $reviews .= '</div>';
        $reviews .= '<h4>' . $user_name . '</h4>';
        $reviews .= '<span>' . $date_review . '</span>';
        $reviews .= '<h5>' . $location . '</h5>';
        $reviews .= '<p>' . the_excerpt_max_charlength($text_review, 220) . '</p>';
        $reviews .= '</div>';

    }
}

wp_reset_query();

?>

<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    В счастливое будущее
                    <br>
                    вместе с Победой
                </h1>
            </div>
        </div>
    </div>

    <section class="calc">
        <div class="container">
            <?php get_template_part('template-calc'); ?>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <div class="row">
                <div class="col-12 offset">
                    <h2>
                        потребительский кооператив,
                        <br>
                        которому доверяют тысячи россиян
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 offset">
                    <p>
                        Потребительский кооператив "Победа" является открытой некоммерческой организацией, которая выполняет социальную миссию, предлагая населению и юридическим лицам доступные финасовые услуги. Без волокиты с бумагами и справками в «Победе» всегда можно сохранить свои сбережения под выгодные проценты или оформить займ. Ответственность ПК "Победа" перед своими клиентами застрахована в страховом обществе "Помощь".
                    </p>
                </div>
                <div class="col-12 col-md-5 image">
                    <img src= "<?php echo $about_img; ?>" alt="about">
                </div>
            </div>
        </div>
    </section>
    <section class="advantages">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="advantages-wrapper">
                        <h2 class="title">
                            Что мы знаем о победе?
                        </h2>
                        <?php echo $advantages; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="leaders">
        <div class="container">
            <div class="row">
                <div class="col-12 title">
                    <h3>
                        Наши лидеры
                    </h3>
                </div>
            </div>
            <div class="wrapper">
                <div class="row">
                    <?php echo $liders; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="reviews">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wrapper-block">
                        <div class="wrapper-carousel">
                            <div class="reviews-carousel">
                                <?php echo $reviews; ?>
                            </div>
                            <a href="<?php echo get_permalink( get_page_by_path( 'review', OBJECT ) ); ?>" class="link-review">
                                Перейти на страницу
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
