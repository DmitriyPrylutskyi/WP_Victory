<?php
    //section calc
    $rate_3 = get_option('month_3_rate_options');
    $rate_6 = get_option('month_6_rate_options');
    $rate_12 = get_option('month_12_rate_options');
    $rate_24 = get_option('month_24_rate_options');
    $rate_termless = get_option('termless_rate_options');
?>


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
                                <input name="refill" type="text" id="refill" value="0">
                                <label for="refill">
                                    Ежемесячное пополнение
                                </label>
                            </div>
                        </div>
                        <div class="input-month-block">
                            <div id="slider-month" class="slider"></div>
                            <div class="input-month">
                                <input name="month" type="text" id="month" value="1">
                                <label for="month">
                                    Количество месяцев
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
                    <a href="" data-toggle="modal" data-target="#make-request" class="make-request">Оставить заявку</a>
                </div>
            </div>
        </div>
        </div>
