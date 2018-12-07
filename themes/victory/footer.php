<?php
/**
 * The template for displaying the footer
 *
 */

$email = get_option('email_options');
$phone = get_option('phone_options');

?>

<div class="un-act">
    <a href="#top-has" class="link-go"><i class="fas fa-chevron-up"></i></a>
</div>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                <a href="#" class="logo">
                    <p>Победа</p>
                    <span>потребительский кооператив</span>
                </a>
            </div>
            <div class="col-12 col-md-9 contacts">
                <span>Email: </span>
                <a class="block" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                <span>Телефон горячей линии: </span>
                <a class="block" href="tel://<?php echo $phone; ?>"><?php echo $phone; ?></a>
                <span class="block">ИНН: 7728439614 </span>
                <span class="block">ОГРН: 1187746738190</span>
            </div>
        </div>
    </div>
</footer>

<!-- Modals -->

<div class="modal fade leave-order-modal" id="leave-order" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/close-modal.png" alt="close-modal">
                </button>
                <div class="new-in-bl-nn scrollbar">
                    <div class="one-bl-modal firls-bl-mod">
                        <h3>Полные условия по вкладу</h3>
                        <p>Вклад принимается от физических лиц в рамках предоставления комплексного продукта,
                            предусматривающего заключение договора срочного банковского вклада «Газпромбанк –
                            Сбережения и
                            защита», а также оформление и оплату в Банке ГПБ (АО) полиса инвестиционного или
                            накопительного
                            страхования одной из страховых компаний – партнеров Банка ГПБ (АО)**
                        </p>
                    </div>
                    <div class="one-bl-modal">
                        <h3>партнёрские программы страхования жизни ООО “СК СОГАЗ- ЖИЗНЬ “</h3>
                        <ul>
                            <li>«Копилка Экспресс»</li>
                            <li>«Уверенный старт Экспресс»</li>
                            <li>«Доход и Защита»</li>
                            <li>«Индекс доверия»</li>
                        </ul>
                    </div>
                    <div class="one-bl-modal">
                        <h3>Валюта вклада</h3>
                        <ul>
                            <li>Российские рубли</li>
                            <li>Вклад в пользу третьих лиц не открывается</li>
                        </ul>
                    </div>

                    <div class="one-bl-modal">
                        <h3>Срок вклада</h3>
                        <ul>
                            <li>91 день, 181 день, 367 дней</li>
                        </ul>
                    </div>
                    <div class="one-bl-modal">
                        <h3>Минимальная сумма вклада</h3>
                        <p>50 000 российских рублей</p>
                        <p>Макс. сумма не должна превыщать 100 % от суммы страховой премии, оплаченной вкладчикамом
                            в
                            дату заключения договора строчного банковского вклада “Газпромбанк- Сбережения и
                            защита”</p>
                    </div>
                    <div class="one-bl-modal">
                        <h3>внесение денежных средств на счёт по вкладу</h3>
                        <p>Осуществляется в порядке перевода с банковского (текущего) счёта, открытого в российских
                            рублях на имя вкладчика в том же подразделении Банка ГПБ (АО) </p>
                    </div>
                    <div class="one-bl-modal">
                        <h3>Дополнительные взносы</h3>
                        <p>Не осуществляются</p>
                    </div>
                    <div class="one-bl-modal">
                        <h3>Частичное снятие </h3>
                        <p>Расходные операции по счёту вклада не осуществляются</p>
                    </div>
                    <div class="one-bl-modal">
                        <h3>порядок начисления и выплаты процентов</h3>
                        <p>Проценты по вкладу выплачиваются путем причисления к сумме вклада в день окончания срока
                            вклада</p>
                    </div>
                    <div class="one-bl-modal">
                        <h3>досрочное востребование вклада:</h3>
                        <p>При дострочном востребовании вклада проценты выплачиваются за фактический срок хранения
                            вклада из расчёта процентной ставки по вкладу “До востребования” в российских рублях,
                            действующей в Банке ГПБ (АО) на дату востребования вклада.</p>
                    </div>
                    <div class="one-bl-modal">
                        <h3>Возврат вклада:</h3>
                        <p>
                            Возврат вклада осуществляется в порядке перевода денежных средств на банковский
                            (текущий)
                            счёт, с которого денежные средства были переведены на счет по вкладу при открытии
                            вклада;<br>
                            При невостребовании вклада вдень окончания срока сумма вклада вместе с причитающимися
                            процуентами переводчится на сбанковский счёт по вкладу при открытии вклада.
                        </p>
                    </div>
                    <div class="one-bl-modal">
                        <h3>Пролонгация</h3>
                        <p>Не осуществляется</p>
                    </div>
                    <div class="one-bl-modal">
                        <h3>Документы</h3>

                        <a href="" target="_blank">
                            <table>
                                <tr>
                                    <td><span></span></td>
                                    <td>
                                        <p>Условия срочного банковского вклада “Гаспромбанк - Сбережения и защита“</p>
                                        <i>272 КБ</i>
                                    </td>
                                </tr>
                            </table>
                        </a>

                        <a href="" target="_blank">
                            <table>
                                <tr>
                                    <td><span></span></td>
                                    <td>
                                        <p>Условия срочного банковского вклада “Гаспромбанк - Сбережения и защита“</p>
                                        <i>272 КБ</i>
                                    </td>
                                </tr>
                            </table>
                        </a>

                        <a href="" target="_blank">
                            <table>
                                <tr>
                                    <td><span></span></td>
                                    <td>
                                        <p>Условия срочного банковского вклада “Гаспромбанк - Сбережения и защита“</p>
                                        <i>272 КБ</i>
                                    </td>
                                </tr>
                            </table>
                        </a>

                        <a href="" target="_blank">
                            <table>
                                <tr>
                                    <td><span></span></td>
                                    <td>
                                        <p>Условия срочного банковского вклада “Гаспромбанк - Сбережения и защита“</p>
                                        <i>272 КБ</i>
                                    </td>
                                </tr>
                            </table>
                        </a>

                        <button class="go-to-other" id="add-deposit">Продолжить</button>
                        <span class="rull-go-to">Нажимая "продолжить" я принимаю все вышеперечисленые условия</span>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
        </div>
    </div>
</div>

<div class="modal fade" id="enter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog other modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/close-modal.png" alt="close-modal">
                </button>
                <h3>Вход в личный кабинет</h3>
                <p class="msg"><span id="close"></span></p>
                <form id="login" method="post">
                    <input type="text" placeholder="Телефон" name="phone" id="phone" required>
                    <div class="seee-pass">
                        <input type="password" placeholder="Пароль" name="password" id="password" required>
                        <input type="checkbox" id="see-pass"><label for="see-pass"><span></span></label>
                    </div>
                    <!--<div class="be-cen">
                        <input type="checkbox" id="ireadd" required>
                        <label for="ireadd"><span></span>Я прочел и согласен с <a href="" data-toggle="modal"
                                data-target="#leave-order" class="leave-order">Правилами и условиями</a></label>
                    </div>-->
                    <a href="" data-toggle="modal" data-target="#forgot-pass" class="forgot-pass">Забыли пароль?</a>
                    <input type="hidden" id="security-login" name="security-login" value="<?php echo create_onetime_nonce( 'login_nonce' ); ?>">
                    <div class="new-link-mod">
                        <a href="" data-toggle="modal" data-target="#sign-up" class="sign-up">Регистрация</a>
                        <input type="button" value="Войти">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sign-up" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog other modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/close-modal.png" alt="close-modal">
                </button>
                <h3>Регистрация</h3>
                <p class="msg"><span id="close"></span></p>
                <form id="registration" method="post">
                    <div class="input-grp">
                        <input type="text" name="last_name" id="last_name" placeholder="Фамилия" autocomplete="off" required>
                        <span class="error-msg"></span>
                    </div>
                    <div class="input-grp">
                        <input type="text" name="first_name" id="first_name" placeholder="Имя" autocomplete="off" required>
                        <span class="error-msg"></span>
                    </div>
                    <div class="input-grp">
                        <input type="text" name="patronymic_name" id="patronymic" placeholder="Отчество" autocomplete="off" required>
                        <span class="error-msg"></span>
                    </div>
                    <div class="input-grp">
                        <input type="email" name="email" id="email" placeholder="Почта" autocomplete="off" required>
                        <span class="error-msg"></span>
                    </div>
                    <div class="input-grp">
                        <input type="tel" name="phone" id="phone" placeholder="Телефон" autocomplete="off" required>
                        <span class="error-msg"></span>
                    </div>
                    <div class="input-grp">
                        <input type="password" name="password" id="password" placeholder="Пароль" autocomplete="off" required>
                        <span class="error-msg"></span>
                    </div>
                    <div class="input-grp">
                        <input type="password" name="rpassword" id="rpassword" placeholder="Повторите пароль" autocomplete="off" required>
                        <span class="error-msg"></span>
                    </div>
                    <!-- <div class="input-grp">
                        <input type="checkbox" id="ireadd2" required>
                        <label for="ireadd2"><span></span>Я прочел и согласен с <a href="" data-toggle="modal"
                                data-target="#leave-order" class="leave-order">Правилами и условиями</a></label>
                        <span class="error-msg"></span>
                    </div> -->
                    <input type="hidden" id="security-register" name="security-register" value="<?php echo create_onetime_nonce( 'register_nonce' ); ?>">

                    <input type="button" id="victory-login" value="Зарегистрироватся" class="reg-new-snb">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="forgot-pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog other modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/close-modal.png" alt="close-modal">
                </button>
                <h3>Забыли пароль?</h3>
                <p class="msg"><span id="close"></span></p>
                <form>
                    <!-- <p>На указанную почту будет отправлено письмо с инструкциями</p> -->
                    <input type="hidden" id="security-forgot" name="security-forgot" value="<?php echo create_onetime_nonce( 'forgot_nonce' ); ?>">
                    <input type="email" id="forgot-email" placeholder="Почта">
                    <div class="new-link-mod">
                        <a href="" data-toggle="modal" data-target="#sign-up" class="sign-up">Регистрация</a>
                        <input type="submit" id="forgot-password" value="Отправить">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="make-order" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog other modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/close-modal.png" alt="close-modal">
                </button>
                <h3>оформить заказ</h3>
                <div id="order_info_message"></div>
                <form id="form-order">
                    <input type="hidden" name="order-type" id="order-type" value="">
                    <input type="text" name="order-name" id="order-name" placeholder="ФИО">
                    <input type="text" name="order-phone" id="order-phone" placeholder="Телефон">
                    <input type="text" name="order-date" id="order-date" placeholder="Дата">
                    <textarea name="order-comment" id="order-comment" placeholder="Комментарий"></textarea>
                    <input type="hidden" id="security-order" name="security-order" value="<?php echo create_onetime_nonce( 'order_nonce' ); ?>">
                    <input type="button" id="victory-order" value="Отправить">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="make-request" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog other modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/close-modal.png" alt="close-modal">
                </button>
                <form id="form-request">
                    <div class="in-call-newsa">
                        <h3>
                            Напишите нам
                        </h3>
                        <div id="request_info_message"></div>
                        <input type="text" name="requestor-name" id="requestor-name" placeholder="Имя">
                        <input type="text" name="requestor-email" id="requestor-email" placeholder="E-mail">
                        <input type="hidden" id="security-request" name="security-request" value="<?php echo create_onetime_nonce( 'request_nonce' ); ?>">
                        <textarea name="requestor-comment" id="requestor-comment" placeholder="Комментарий"></textarea>
                    </div>
                    <input type="button" id="send-request" value="Отправить">
                </form>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
