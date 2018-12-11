<?php
/* Template Name: Saving Template */

get_header();

//section calc
$rate_3 = get_option('month_3_rate_options');
$rate_6 = get_option('month_6_rate_options');
$rate_12 = get_option('month_12_rate_options');
$rate_24 = get_option('month_24_rate_options');
$rate_termless = get_option('termless_rate_options');

?>

<div class="saving">
    <div class="oun-head no-ots">
        <h2>Сбережения</h2>
    </div>
    <div class="saving-wrapp">

        <section class="calc">
            <div class="container">

                <?php get_template_part('template-calc'); ?>

            </div>
        </section>

        <div class="prog-take">
            <h3>Программы сбережений</h3>
            <div class="all-kind-off">
                <div class="one-kind-off">
                    <h4>Срок 3 месяца</h4>
                    <div class="per-one-k">
                        <span><?php echo $rate_3; ?> %</span>
                        <p>сумма от 1000 Р</p>
                    </div>
                </div>
                <div class="one-kind-off">
                    <h4>Срок 6 месяцев</h4>
                    <div class="per-one-k">
                        <span><?php echo $rate_6; ?> %</span>
                        <p>сумма от 1000 Р</p>
                    </div>
                </div>
                <div class="one-kind-off">
                    <h4>Срок 12 месяцев</h4>
                    <div class="per-one-k">
                        <span><?php echo $rate_12; ?> %</span>
                        <p>сумма от 1000 Р</p>
                    </div>
                </div>
                <div class="one-kind-off">
                    <h4>Срок 24 месяца</h4>
                    <div class="per-one-k">
                        <span><?php echo $rate_24; ?> %</span>
                        <p>сумма от 1000 Р</p>
                    </div>
                </div>
                <div class="one-kind-off">
                    <h4>Срок бессрочный</h4>
                    <div class="per-one-k">
                        <span><?php echo $rate_termless; ?> %</span>
                        <p>сумма от 1000 Р</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="simple-text">
            <p>
                Потребительский кооператив "Победа" является открытой некоммерческой организацией, которая выполняет социальную миссию, предлагая населению и юридическим лицам доступные финасовые услуги. Без волокиты с бумагами и справками в «Победе» всегда можно сохранить свои сбережения под выгодные проценты или оформить займ. Ответственность ПК "Победа" перед своими клиентами застрахована в страховом обществе "Помощь"
            </p>
        </div>
        <div class="our-gar">
            <h3>Наши гарантии</h3>
            <div class="all-bl-gar">
                <div class="one-bl-gar first">
                    <h4 class="title">
                        Собственный Резервный фонд
                    </h4>
                    <p class="info">
                        Для обеспечения гарантии сохранности и возврата привлеченных денежных средств создан Резервный фонд кооператива. Отчисления в Резервный фонд составляют не менее 5% от суммы привлечённых средств сберегателей, а также ПК "Победа" отвечает перед своими членами всем своим имуществом.
                    </p>
                </div>
                <div class="one-bl-gar sec">
                    <h4 class="title">
                        Никаких рискованных операций
                    </h4>
                    <p class="info">
                        Потребительский кооператив "Победа" осуществляет два вида деятельности: привлечение денежных средств и выдача займов юридическим лицам и населению. Кооператив не работает с иностранной валютой, не заключает рискованных сделок и не размещает средства своих клиентов в сомнительные активы.
                    </p>
                </div>
                <div class="one-bl-gar thr">
                    <h4 class="title">
                        Страхование
                    </h4>
                    <p class="info">
                        Ответственность потребительского кооператива "Победа" перед своими клиентами застрахована в страховом обществе "Помощь" (лицензии СИ № 3834, СЛ № 3834, ПС № 3834) на сумму 100 миллионов рублей.
                        <br><br><br><br>
                    </p>
                </div>
                <div class="one-bl-gar four">
                    <h4 class="title">
                        Наблюдательный совет
                    </h4>
                    <p class="info">
                        Максимальная честность перед клиентами и открытость ведения дел — одно из главных и непререкаемых правил работы «Победы». Стать членом Наблюдательного Совета и получать подробные ежеквартальные отчёты о деятельности организации может любой член кооператива, просто заявив о своём желании менеджерам офиса компании.
                    </p>
                </div>
                <div class="clean"></div>
            </div>
        </div>
        <div class="simple-text2">
             <a href="" data-toggle="modal" data-target="#make-request" class="make-request">Оставить заявку</a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
