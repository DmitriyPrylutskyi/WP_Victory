<?php
/* Template Name: Home Template */

get_header();

//section calc
$rate_3 = get_option('month_3_rate_options');
$rate_6 = get_option('month_6_rate_options');
$rate_12 = get_option('month_12_rate_options');
$rate_24 = get_option('month_24_rate_options');
$rate_termless = get_option('termless_rate_options');

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
                $advantages .= '<p class="long-text scrollbar">';
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
                $advantages .= '<p class="long-text scrollbar">';
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
extract(shortcode_atts(array(
    'class' => '',
    'number' => '1',
), $atts));


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
        $reviews .= '<img src="' . $user_photo . '" alt="photo">';
        $reviews .= '</div>';
        $reviews .= '<h4>' . $user_name . '</h4>';
        $reviews .= '<span>' . $date_review . '</span>';
        $reviews .= '<h5>' . $location . '</h5>';
        $reviews .= '<p>' . the_excerpt_max_charlength($text_review, 220) . '</p>';
        $reviews .= '</div>';

    }
}

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
            <div class="row">
                <div class="col-12">
                <div class="wrapper-calc">
                    <div class="data">
                        <form id="calc" action="">
                            <div class="input-period">
                                <input name="period" type="radio" id="period1" value="24" data-rate="<?php echo $rate_24; ?>" checked>
                                <label for="period1">
                                    <span></span>
                                    2 года
                                </label>
                                <input name="period" type="radio" id="period2" value="12" data-rate="<?php echo $rate_12; ?>">
                                <label for="period2">
                                    <span></span>
                                    1 год
                                </label>
                                <input name="period" type="radio" id="period3" value="6" data-rate="<?php echo $rate_6; ?>">
                                <label for="period3">
                                    <span></span>
                                    6 месяцев
                                </label>
                                <input name="period" type="radio" id="period4" value="3" data-rate="<?php echo $rate_3; ?>">
                                <label for="period4">
                                    <span></span>
                                    3 месяца
                                </label>
                                <input name="period" type="radio" id="period5" value="1" data-rate="<?php echo $rate_termless; ?>">
                                <label for="period5">
                                    <span></span>
                                    бессрочное
                                </label>
                            </div>
                           <!-- <div class="input-method">
                                <input name="method" type="radio" id="method1" checked>
                                <label for="method1">
                                    <span></span>
                                    Оставлять проценты на вкладе
                                </label>
                                <input name="method" type="radio" id="method2">
                                <label for="method2">
                                    <span></span>
                                    Долгосрочное закрытие вклада
                                </label>
                            </div>-->
                            <div class="input-amount-block">
                                <div id="slider-amount" class="slider"></div>
                                <div class="input-amount">
                                    <input name="amount" type="text" id="amount" value="1000">
                                    <label for="amount">
                                        Сумма вложения
                                    </label>
                                </div>
                            </div>
                            <div class="input-refill-block">
                                <div id="slider-refill" class="slider"></div>
                                <div class="input-refill">
                                    <input name="refill" type="text" id="refill" value="1000">
                                    <label for="refill">
                                        Ежемесячное пополнение
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="result">
                        <h5>Расчет сбережений</h5>

                        <span class="caption">
                                Доход по сбережению
                            </span>
                        <span class="value" id="income" form="calc">
                                4500
                            </span>
                        <span class="caption">
                                Процентная ставка
                            </span>
                        <span class="value" id="interest-rate" form="calc">
                                <?php echo $rate_24; ?>
                                <span class="unit">%</span>
                            </span>
                        <span class="caption">
                                Сумма к концу срока
                            </span>
                        <span class="value" id="total" form="calc">
                                28500
                            </span>
                        <button type="submit" form="calc">Оставить заявку</button>
                    </div>
                </div>
            </div>
            </div>
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
                        Кредитный потребительский кооператив является некоммерческой организацией, который выполняет социальную миссию, предлагая населению доступные услуги финансовой взаимопомощи. Без волокиты с бумагами и справками в «ПОБЕДЕ» всегда можно сохранить свои сбережения под выгодные проценты или оформить заём на неотложные нужды. Деятельность КПК регулируется Федеральным законом «О кредитной кооперации», а контроль осуществляет Центробанк РФ, являясь мега-регулятором кредитных и некредитных организаций.
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
                            <a href="/reviews" class="link-review">
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

<script type="application/javascript">
    function setHoverOnAdvantageIcon() {
        $('.advantage-img').hover(
            function() {
              if ( !$( this ).hasClass('active') ) {
                $( this ).find('img').toggleClass('active');
              }
            }, function() {
              if ( !$( this ).hasClass('active') ) {
                $( this ).find('img').toggleClass('active');
              }
            }
        )
    }

    function setClickOnAdvantageIcon() {
      $('.advantage-img').click(function() {
        if ( !$( this ).hasClass('active') ) {
            $( this ).addClass('active');
            $( this ).parent().find('.advantage-desc p').toggleClass('active');
        } else {
            $( this ).removeClass('active');
            $( this ).parent().find('.advantage-desc p').toggleClass('active');
        }
      })
    }

    $(window).on("load", function() {
        setHoverOnAdvantageIcon();
        setClickOnAdvantageIcon();
    })
</script>