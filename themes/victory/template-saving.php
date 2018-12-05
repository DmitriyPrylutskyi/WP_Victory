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
        <div class="prog-take">
            <h3>Программы сбережений</h3>
            <div class="all-kind-off">
                <div class="one-kind-off">
                    <h4>Срок 90 дней</h4>
                    <div class="per-one-k">
                        <span>13 %</span>
                        <p>сумма от 1000 Р</p>
                    </div>
                </div>
                <div class="one-kind-off">
                    <h4>Срок 90 дней</h4>
                    <div class="per-one-k">
                        <span>13 %</span>
                        <p>сумма от 1000 Р</p>
                    </div>
                </div>
                <div class="one-kind-off">
                    <h4>Срок 90 дней</h4>
                    <div class="per-one-k">
                        <span>13 %</span>
                        <p>сумма от 1000 Р</p>
                    </div>
                </div>
                <div class="one-kind-off">
                    <h4>Срок 90 дней</h4>
                    <div class="per-one-k">
                        <span>13 %</span>
                        <p>сумма от 1000 Р</p>
                    </div>
                </div>
                <div class="one-kind-off">
                    <h4>Срок 90 дней</h4>
                    <div class="per-one-k">
                        <span>13 %</span>
                        <p>сумма от 1000 Р</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="simple-text">
            <p>
                Кредитный потребительский кооператив является некоммерческой организацией, который выполняет социальную
                миссию, предлагая населению доступные услуги финансовой взаимопомощи. Без волокиты с бумагами и
                справками в «ПОБЕДЕ» всегда можно сохранить свои сбережения под выгодные проценты или оформить заём на
                неотложные нужды. Деятельность КПК регулируется Федеральным законом «О кредитной кооперации», а
                контроль осуществляет Центробанк РФ, являясь мега-регулятором кредитных и некредитных организаций.
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
                        Для обеспечения гарантии сохранности и возврата сбережений создан Резервный фонд кооператива.
                        Отчисления в Резервный фонд составляют не менее 5% от суммы привлечённых средств сберегателей,
                        а также КПК "ПЕРВЫЙ" отвечает перед сберегателями всем своим имуществом
                    </p>
                </div>
                <div class="one-bl-gar sec">
                    <h4 class="title">
                        Никаких рискованных операций
                    </h4>
                    <p class="info">
                        Кредитный потребительский кооператив "Первый" является членом саморегулируемой организации
                        (СРО) "Межрегиональный союз кредитных кооперативов". Здесь создан Компенсационный фонд СРО,
                        формируемый из обязательных отчислений её участников. Это финансовая подушка безопасности КПК
                    </p>
                </div>
                <div class="one-bl-gar thr">
                    <h4 class="title">
                        Прямой контроль регулятора
                    </h4>
                    <p class="info">
                        Кооператив "ПЕРВЫЙ" - один из крупных кооперативов России, поэтому его деятельность находится
                        под прямым контролем Центрального Банка РФ и осуществляется в строгом соответствии с
                        законодательством. Ежеквартальные проверки СРО, аудиторов и Росфинмониторинга.
                    </p>
                </div>
                <div class="one-bl-gar four">
                    <h4 class="title">
                        Членство в СРО "МСКК"
                    </h4>
                    <p class="info">
                        КПК "ПЕРВЫЙ" осуществляет всего два вида деятельности: приём сбережений и выдачу займов.
                        Кооператив не работает с иностранной валютой, не заключает рискованных сделок и не размещает
                        средства сберегателей в сомнительные активы.
                    </p>
                </div>
                <div class="clean"></div>
            </div>
        </div>
        <div class="simple-text2">
            <p>
                Сбережения принимаются только от членов КПК «Победа», ознакомиться с порядком вступления в кооператив
                можно <a href="">здесь</a>. Член кооператива обязан солидарно с другими членами кредитного кооператива
                (пайщиками) нести субсидиарную ответственность по обязательствам кредитного кооператива в пределах
                невнесенной части дополнительного взноса
            </p>
        </div>
    </div>
</div>

<?php get_footer(); ?>
