<?php
/* Template Name: Home Template */
//var_dump(get_page_template_slug());
get_header();

$about_img = get_field('about_image');

$i = 1;
if( have_rows('les_etapos_repeater') ):
    while ( have_rows('les_etapos_repeater') ) : the_row();

            $caption = get_sub_field('etapos_caption');
            $image   = get_sub_field('etapos_image');
            $image_url    = $image['url'];

            $output .= '<li class="etapos-wrapper-box">';

            $output .= '<img src="'.$image_url.'" alt="stage">';
            $output .= '<span class="caption">'.$caption.'</span>';

            $output .= '</li>';

            $i++;

    endwhile;
endif;
$output .= '</ol>';

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
                <div class="col-12">
                    <h2>
                        потребительский кооператив,
                        <br>
                        которому доверяют тысячи россиян
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <p>
                        Кредитный потребительский кооператив является некоммерческой организацией, который выполняет социальную миссию, предлагая населению доступные услуги финансовой взаимопомощи. Без волокиты с бумагами и справками в «ПОБЕДЕ» всегда можно сохранить свои сбережения под выгодные проценты или оформить заём на неотложные нужды. Деятельность КПК регулируется Федеральным законом «О кредитной кооперации», а контроль осуществляет Центробанк РФ, являясь мега-регулятором кредитных и некредитных организаций.
                    </p>
                </div>
                <div class="col-12 col-md-6 image">
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
                        <div class="advantage-block">
                            <div class="advantage-img">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/advantage-icon-1.png" alt="advantage">
                            </div>
                            <div class="advantage-desc">
                                <p class="active">
                                    Страхование ответственности <br> ПК на сумму <span>100</span> млн.р
                                </p>
                            </div>
                        </div>
                        <div class="advantage-block right">
                            <div class="advantage-desc">
                                <p class="active">
                                    Высокие процентные ставки
                                </p>
                            </div>
                            <div class="advantage-img">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/advantage-icon-2.png" alt="advantage">
                            </div>
                        </div>
                        <div class="advantage-block">
                            <div class="advantage-img">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/advantage-icon-3.png" alt="advantage">
                            </div>
                            <div class="advantage-desc">
                                <p class="active">
                                    Возможность входа клиента в <br> наблюдательный совет
                                </p>
                            </div>
                        </div>
                        <div class="advantage-block right">
                            <div class="advantage-desc">
                                <p class="active">
                                    Качественный клиентский сервис, <br>
                                    регулярное проведение социальных акций
                                </p>
                            </div>
                            <div class="advantage-img">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/advantage-icon-4.png" alt="advantage">
                            </div>
                        </div>
                        <div class="advantage-block">
                            <div class="advantage-img">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/advantage-icon-5.png" alt="advantage">
                            </div>
                            <div class="advantage-desc">
                                <p class="active">
                                    Ежегодное общедоступное <br> финансово-отчетное собрание.
                                </p>
                                <p class="small-text scrollbar">
                                    Ежегодное общедоступное финансово-отчетное собрание. На собрании окртывается вся финансовая отчетность, показатели и прочее. Каждому пайщику доступна эта информация.
                                </p>
                            </div>
                        </div>
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
                    <div class="col-12 col-md-4 lider deputy">
                        <div class="img-wrapper"></div>
                        <h4>
                            Гарифуллина Юлия <br> Валерьевна
                        </h4>
                        <p>
                            заместитель председателя совета
                        </p>
                    </div>
                    <div class="col-12 col-md-4 lider chairman">
                        <div class="img-wrapper"></div>
                        <h4>
                            Кравченко Константин <br> Валерьевич
                        </h4>
                        <p>
                            председатель совета
                        </p>
                    </div>
                    <div class="col-12 col-md-4 lider manager">
                        <div class="img-wrapper"></div>
                        <h4>
                            Жегалов Олег <br> Александрович
                        </h4>
                        <p>
                            управляющий
                        </p>
                    </div>
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
    window.addEventListener('load', function () {
        $('.advantage-img').hover(
            function() {
              var img = $( this ).find('img').attr('src').replace( /^\D+/g, '');
              $(this).find('img').attr('src', '<?php echo get_stylesheet_directory_uri(); ?>/img/advantage-icon-hover-' + img);
            }, function() {
              if (  !$( this ).hasClass('active') ) {
                var img = $(this).find('img').attr('src').replace(/^\D+/g, '');
                $(this).find('img').attr('src', '<?php echo get_stylesheet_directory_uri(); ?>/img/advantage-icon-' + img);
              }
            }
        )
    })
</script>