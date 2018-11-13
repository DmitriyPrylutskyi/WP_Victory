<?php
/* Template Name: Home Template */
//var_dump(get_page_template_slug());
get_header();

//section about
$about_img = get_field('about_image');

//section advantages
$i = 1;
if( have_rows('advantages') ):
    while ( have_rows('advantages') ) : the_row();

            $image_short[$i]     = get_sub_field('advantage_image_short');
            $image_long[$i]      = get_sub_field('advantage_image_long');
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
                                <input name="period" type="radio" id="period1" checked>
                                <label for="period1">
                                    <span></span>
                                    2 года
                                </label>
                                <input name="period" type="radio" id="period2">
                                <label for="period2">
                                    <span></span>
                                    1 год
                                </label>
                                <input name="period" type="radio" id="period3">
                                <label for="period3">
                                    <span></span>
                                    6 месяцев
                                </label>
                                <input name="period" type="radio" id="period4">
                                <label for="period4">
                                    <span></span>
                                    3 месяца
                                </label>
                                <input name="period" type="radio" id="period5">
                                <label for="period5">
                                    <span></span>
                                    бессрочное
                                </label>
                            </div>
                            <div class="input-method">
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
                            </div>
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
                                55
                            </span>
                        <span class="caption">
                                Процентная ставка
                            </span>
                        <span class="value" id="interest-rate" form="calc">
                                18
                                <span class="unit">%</span>
                            </span>
                        <span class="caption">
                                Сумма к концу срока
                            </span>
                        <span class="value" id="total" form="calc">
                                1055
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
                                <div class="review">
                                    <div class="photo">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/photo.png" alt="photo">
                                    </div>
                                    <h4>
                                        Кравченко Карина Георгиевна
                                    </h4>
                                    <span>
                                        03 мая 2017
                                    </span>
                                    <h5>
                                        г. Мингск
                                    </h5>
                                    <p>
                                        Я являюсь пайщиком КПК "ПЕРВЫЙ", неоднократно обращался за помощью в данную организацию и очень доволен сотрудничеством, планирую обращаться к вам и дальше! Желаю КПК "ПЕРВЫЙ" всего наилучшего и дальнейшего развития! ...
                                    </p>
                                </div>
                                <div class="review">
                                    <div class="photo">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/photo.png" alt="photo">
                                    </div>
                                    <h4>
                                        Кравченко Карина Георгиевна
                                    </h4>
                                    <span>
                                        03 мая 2017
                                    </span>
                                    <h5>
                                        г. Мингск
                                    </h5>
                                    <p>
                                        Я являюсь пайщиком КПК "ПЕРВЫЙ", неоднократно обращался за помощью в данную организацию и очень доволен сотрудничеством, планирую обращаться к вам и дальше! Желаю КПК "ПЕРВЫЙ" всего наилучшего и дальнейшего развития! ...
                                    </p>
                                </div>
                            </div>
                            <a href="#" class="link-review">
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