<?php
/* Template Name: Personal Area Template */

if ( !is_login() ) {
    wp_redirect( home_url() );
    exit;
}

get_header();

?>

<div class="personal-area">
            <div class="oun-head">
                <h2>Личный кабинет</h2>

            </div>
            <div class="contain">
                <div class="row">
                    <div class="in-block">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#profile">Профиль</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#open-vklad">Открыть вклад</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link last-link" data-toggle="tab" href="#in-time">Действующие вклады</a>
                            </li>
                            <li class="status-off">
                                <p>статус :</p>
                                <span>Бронзовый</span>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="profile" class="tab-pane active">
                                <div class="personal-info">
                                    <h3 class="new-title">личные данные</h3>
                                    <div>
                                        <form>
                                            <div class="left-part">
                                                <div class="one-line">
                                                    <label for="thir-name" class="can-lable">Фамилия</label>
                                                    <input type="text" id="thir-name" name="thir-name" placeholder="Фамилия">
                                                </div>
                                                <div class="one-line">
                                                    <label for="name" class="can-lable">Имя</label>
                                                    <input type="text" id="name" name="name" placeholder="Имя">
                                                </div>
                                                <div class="one-line">
                                                    <label for="fath-nn" class="can-lable">Отчество</label>
                                                    <input type="text" id="fath-nn" name="fath-nn" placeholder="Отчество">
                                                </div>
                                            </div>
                                            <div class="right-part">
                                                <div class="one-line">
                                                    <label for="date-b" class="can-lable">Дата рождения</label>
                                                    <input type="text" id="date-b" name="date-b" placeholder="Дата рождения">
                                                </div>
                                                <div class="one-line">
                                                    <label for="city-of" class="can-lable">Город</label>
                                                    <input type="text" id="city-of" name="city-of" placeholder="Город">
                                                </div>
                                                <div class="one-line has-radio">
                                                    <p class="can-lable">Пол</p>
                                                    <input type="radio" checked id="ma" name="mall">
                                                    <label for="ma">Мужской</label>
                                                    <input type="radio" id="wo" name="mall">
                                                    <label for="wo">Женский</label>

                                                </div>
                                            </div>
                                            <div class="clean"></div>
                                            <div class="bot-infoo">
                                                <div class="one-line">
                                                    <label for="phone-n" class="can-lable">Телефон</label>
                                                    <input type="text" id="phone-n" name="phone-n" placeholder="Телефон">
                                                    <a href="">Подтвердить</a>
                                                </div>
                                                <div class="one-line">
                                                    <label for="e-mail" class="can-lable">E-mail</label>
                                                    <input type="email" id="e-mail" name="e-mail" placeholder="E-mail">
                                                    <a href="">Верифицировать</a>
                                                </div>
                                            </div>
                                            <input type="submit" value="Сохранить">
                                            <div class="clean"></div>
                                        </form>
                                    </div>

                                </div>
                                <div class="pass-data">

                                    <h3>
                                        Паспортные ДАННЫЕ
                                    </h3>


                                    <form>
                                        <div class="top-sec line-off">
                                            <div class="one-ll">
                                                <label for="pass-ser" class="can-lable">Серия</label>
                                                <input type="text" id="pass-ser" name="pass-ser">
                                            </div>
                                            <div class="one-ll">
                                                <label for="num-ser" class="can-lable nomm">Номер</label>
                                                <input type="text" id="num-ser" name="num-ser">
                                            </div>
                                        </div>
                                        <div class="mid-sec line-off">
                                            <label for="whom-ser" class="can-lable">Кем выдан</label>
                                            <input type="text" id="whom-ser" name="whom-ser">
                                        </div>
                                        <div class="bot-sec line-off">
                                            <div class="one-ll">
                                                <label for="data-ser" class="can-lable">Дата выдачи</label>
                                                <input type="text" id="data-ser" name="data-ser">
                                            </div>
                                            <div class="one-ll">
                                                <label for="kod-ser" class="can-lable nomm">Код подразделения</label>
                                                <input type="text" id="kod-ser" name="kod-ser">
                                            </div>
                                        </div>
                                        <input type="submit" value="Сохранить">
                                        <div class="clean"></div>
                                    </form>
                                </div>
                                <div class="jjjjd">
                                    <div class="new-back">

                                    </div>
                                </div>
                                <div class="last-pass-doc">
                                    <div class="part-l">
                                        <h3>Смена пароля</h3>
                                        <div class="one-sl-bl first-bb">
                                            <label for="old-pass">Старый пароль</label>
                                            <input type="password" id="old-pass" name="old-pass">
                                        </div>
                                        <div class="one-sl-bl sec-bb">
                                            <label for="new-pass">Новый пароль</label>
                                            <input type="password" id="new-pass" name="new-pass">
                                        </div>
                                        <div class="one-sl-bl">
                                            <label for="re-pass" class="last-bb">Подтверждение пароля</label>
                                            <input type="password" id="re-pass" name="re-pass">
                                        </div>
                                        <input type="submit" value="Сохранить">
                                    </div>
                                    <div class="part-r">
                                        <div class="in-nwe-ff">
                                            <h3>Верификация
                                                пользователя
                                            </h3>
                                            <p>Загрузите действующий документ, удостоверяющий вашу личность (PNG или JPEG не
                                                более 5МБ)</p>
                                            <div>
                                                <form>
                                                    <input type="file" accept=".jpg, .jpeg, .png" multiple>
                                                </form>
                                            </div>
                                            <input type="submit" value="Сохранить">
                                        </div>
                                    </div>
                                    <div class="clean"></div>
                                </div>
                            </div>
                            <div id="open-vklad" class="container tab-pane fade">
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
                                                <button type="submit" data-toggle="modal" data-target="#leave-order">Оставить заявку</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                            </div>
                            <div id="in-time" class="container tab-pane fade">
                                <h3 class="title-block">Дeйствующие вклады</h3>
                                <div class="table-in">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Номер
                                                    вклада</th>
                                                <th>Дата
                                                    вклада</th>
                                                <th>Срок
                                                    вклада</th>
                                                <th>Сумма
                                                    вклада</th>
                                                <th>Процентная
                                                    ставка</th>
                                                <th>Процентов
                                                    начислено</th>
                                                <th>Доступно
                                                    для вывода</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>00287</td>
                                                <td>12.10.18</td>
                                                <td>180 дн.</td>
                                                <td>20000</td>
                                                <td>15 %</td>
                                                <td>2470 %</td>
                                                <td>374 <img src="<?php echo get_template_directory_uri(); ?>/img/ruble1.png" alt="rb-sing"></td>
                                                <td><a href="" class="act">Снять</a><button data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Test" title="title">?</button></td>
                                            </tr>
                                            <tr>
                                                <td>00287</td>
                                                <td>12.10.18</td>
                                                <td>180 дн.</td>
                                                <td>20000</td>
                                                <td>15 %</td>
                                                <td>2470 %</td>
                                                <td>374 <img src="<?php echo get_template_directory_uri(); ?>/img/ruble1.png" alt="rb-sing"></td>
                                                <td><a href="" class="act">Снять</a><button data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Test" title="title">?</button></td>
                                            </tr>
                                            <tr>
                                                <td>00287</td>
                                                <td>12.10.18</td>
                                                <td>180 дн.</td>
                                                <td>20000</td>
                                                <td>15 %</td>
                                                <td>2470 %</td>
                                                <td>374 <img src="<?php echo get_template_directory_uri(); ?>/img/ruble1.png" alt="rb-sing"></td>
                                                <td><a href="" class="act">Снять</a><button data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Test" title="title">?</button></td>
                                            </tr>
                                            <tr>
                                                <td>00287</td>
                                                <td>12.10.18</td>
                                                <td>180 дн.</td>
                                                <td>20000</td>
                                                <td>15 %</td>
                                                <td>2470 %</td>
                                                <td>374 <img src="<?php echo get_template_directory_uri(); ?>/img/ruble1.png" alt="rb-sing"></td>
                                                <td><a href="" class="not-act">Снять</a><button data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Test" title="title">?</button></td>
                                            </tr>
                                            <tr>
                                                <td>00287</td>
                                                <td>12.10.18</td>
                                                <td>180 дн.</td>
                                                <td>20000</td>
                                                <td>15 %</td>
                                                <td>2470 %</td>
                                                <td>374 <img src="<?php echo get_template_directory_uri(); ?>/img/ruble1.png" alt="rb-sing"></td>
                                                <td><a href="" class="act">Снять</a><button data-toggle="popover" data-placement="top" data-trigger="focus" data-content="Test" title="title">?</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    <h3 class="title-block">закрытые вклады</h3>
                                    <div class="table-in">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Номер
                                                        вклада</th>
                                                    <th>Дата
                                                        вклада</th>
                                                    <th>Срок
                                                        вклада</th>
                                                    <th>Сумма
                                                        вклада</th>
                                                    <th>Процентная
                                                        ставка</th>
                                                    <th>Процентов
                                                        начислено</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>00287</td>
                                                    <td>12.10.18</td>
                                                    <td>180 дн.</td>
                                                    <td>20000</td>
                                                    <td>15 %</td>
                                                    <td>2470 %</td>
                                                </tr>
                                                <tr>
                                                    <td>00287</td>
                                                    <td>12.10.18</td>
                                                    <td>180 дн.</td>
                                                    <td>20000</td>
                                                    <td>15 %</td>
                                                    <td>2470 %</td>
                                                </tr>
                                                <tr>
                                                    <td>00287</td>
                                                    <td>12.10.18</td>
                                                    <td>180 дн.</td>
                                                    <td>20000</td>
                                                    <td>15 %</td>
                                                    <td>2470 %</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

<?php get_footer(); ?>

<script>
    $(document).ready(function () {
        $('input[type="file"]').imageuploadify();
    })
</script>
