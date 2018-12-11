<?php
/* Template Name: Personal Area Template */

if ( !is_user_logged_in() ) {
    wp_redirect(  esc_html( home_url() ) );exit();
}

get_header();

global $post;

//section calc
$rate_3 = get_option('month_3_rate_options');
$rate_6 = get_option('month_6_rate_options');
$rate_12 = get_option('month_12_rate_options');
$rate_24 = get_option('month_24_rate_options');
$rate_termless = get_option('termless_rate_options');

$current_user           =   wp_get_current_user();
$userID                 =   $current_user->ID;
$user_login             =   $current_user->user_login;
$first_name             =   get_the_author_meta( 'first_name' , $userID );
$last_name              =   get_the_author_meta( 'last_name' , $userID );
$patronymic             =   get_the_author_meta( 'patronymic' , $userID );
$user_email             =   get_the_author_meta( 'user_email' , $userID );
$user_phone             =   get_the_author_meta( 'phone' , $userID );
$user_birthday          =   get_the_author_meta( 'birthday' , $userID );
$user_city              =   get_the_author_meta( 'city' , $userID );
$gender                 =   get_the_author_meta( 'gender' , $userID );
$pass_ser               =   get_the_author_meta( 'pass_ser' , $userID );
$pass_num               =   get_the_author_meta( 'pass_num' , $userID );
$pass_whom              =   get_the_author_meta( 'pass_whom' , $userID );
$pass_date              =   get_the_author_meta( 'pass_date' , $userID );
$pass_code              =   get_the_author_meta( 'pass_code' , $userID );
$user_amount            =   get_the_author_meta( 'user_amount' , $userID );
$images                 =   unserialize(get_the_author_meta( 'images', $userID ));
$foto                   =   get_the_author_meta( 'foto', $userID );

// Load upload an thickbox script
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');

// Load thickbox CSS
wp_enqueue_style('thickbox');

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
                            <?php if ( $user_amount >= 50000 ) : ?>
                            <li class="status-off">
                                <p>статус :</p>
                                <?php
                                if ( $user_amount >= 50000 && $user_amount < 100000 ) {
                                        echo "<span>Бронзовый</span>";
                                    } else if ( $user_amount >= 100000 && $user_amount < 500000 ) {
                                        echo "<span>Серебряный</span>";
                                    } else if ( $user_amount >= 500000 && $user_amount < 1000000 ) {
                                        echo "<span>Золотой</span>";
                                    } else if ( $user_amount >= 1000000 ) {
                                        echo "<span>Платиновый</span>";
                                    }
                                ?>
                            </li>
                            <?php endif; ?>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="profile" class="tab-pane active">
                                <div class="personal-info">
                                    <h3 class="new-title">личные данные</h3>
                                    <div id="personal_info_message"></div>
                                    <div>
                                        <form>
                                            <div class="left-part">
                                                <div class="one-line">
                                                    <label for="" id="avatar-chn" class="can-lable">Фото</label>
                                                    <div class="foto-block-ava">
                                                        <div class="avatar-wrapper">
                                                            <img class="profile-pic" src="<?php echo $foto; ?>" />

                                                            <div class="upload-button" id="upload-button">
                                                                <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                                                            </div>
                                                            <input type="hidden" name="foto" id="foto" value="<?php echo $foto; ?>" class="regular-text" />
                                                            <input class="file-upload" id="file-upload" type="file" accept="image/*"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="one-line">
                                                    <label for="last_name" class="can-lable">Фамилия</label>
                                                    <input type="text" id="last_name" name="last_name" placeholder="Фамилия" value="<?php echo $last_name; ?>">
                                                </div>
                                                <div class="one-line">
                                                    <label for="first_name" class="can-lable">Имя</label>
                                                    <input type="text" id="first_name" name="first_name" placeholder="Имя" value="<?php echo $first_name; ?>">
                                                </div>
                                                <div class="one-line">
                                                    <label for="patronymic" class="can-lable">Отчество</label>
                                                    <input type="text" id="patronymic" name="patronymic" placeholder="Отчество" value="<?php echo $patronymic; ?>">
                                                </div>
                                            </div>
                                            <div class="right-part">
                                                <div class="one-line">
                                                    <label for="birthday" class="can-lable">Дата рождения</label>
                                                    <input type="text" id="birthday" name="birthday" placeholder="Дата рождения" value="<?php echo $user_birthday; ?>">
                                                </div>
                                                <div class="one-line">
                                                    <label for="city" class="can-lable">Город</label>
                                                    <input type="text" id="city" name="city" placeholder="Город" value="<?php echo $user_city; ?>">
                                                </div>
                                                <div class="one-line has-radio">
                                                    <p class="can-lable">Пол</p>
                                                    <input type="radio" id="male" name="gender" <?php if ($gender == 'male' ) { ?>checked="checked"<?php }?> value="male">
                                                    <label for="male">Мужской</label>
                                                    <input type="radio" id="female" name="gender" <?php if ($gender == 'female' ) { ?>checked="checked"<?php }?> value="female">
                                                    <label for="female">Женский</label>
                                                </div>
                                            </div>
                                            <div class="clean"></div>
                                            <div class="bot-infoo">
                                                <div class="one-line">
                                                    <label for="user_email" class="can-lable">E-mail</label>
                                                    <input type="email" id="user_email" name="user_email" placeholder="E-mail" value="<?php echo $user_email; ?>">
                                                    <!--<a href="">Верифицировать</a>-->
                                                </div>
                                                <div class="one-line">
                                                    <label for="user_phone" class="can-lable">Телефон</label>
                                                    <input type="text" id="user_phone" name="user_phone" placeholder="Телефон" value="<?php echo $user_phone; ?>">
                                                    <a href="">Подтвердить</a>
                                                </div>
                                            </div>
                                            <input type="hidden" id="security-personal" name="security-personal" value="<?php echo create_onetime_nonce( 'personal_nonce' ); ?>">
                                            <input type="button" id="user_data" value="Сохранить">
                                            <div class="clean"></div>
                                        </form>
                                    </div>

                                </div>
                                <div class="pass-data">
                                    <h3>
                                        Паспортные ДАННЫЕ
                                    </h3>
                                    <div id="passport_info_message"></div>
                                    <form>
                                        <div class="top-sec line-off">
                                            <div class="one-ll">
                                                <label for="pass_ser" class="can-lable">Серия</label>
                                                <input type="text" id="pass_ser" name="pass_ser" value="<?php echo $pass_ser; ?>">
                                            </div>
                                            <div class="one-ll">
                                                <label for="pass_num" class="can-lable nomm">Номер</label>
                                                <input type="text" id="pass_num" name="pass_num" value="<?php echo $pass_num; ?>">
                                            </div>
                                        </div>
                                        <div class="mid-sec line-off">
                                            <label for="pass_whom" class="can-lable">Кем выдан</label>
                                            <input type="text" id="pass_whom" name="pass_whom" value="<?php echo $pass_whom; ?>">
                                        </div>
                                        <div class="bot-sec line-off">
                                            <div class="one-ll">
                                                <label for="pass_date" class="can-lable">Дата выдачи</label>
                                                <input type="text" id="pass_date" name="pass_date" value="<?php echo $pass_date; ?>">
                                            </div>
                                            <div class="one-ll">
                                                <label for="pass_code" class="can-lable nomm">Код подразделения</label>
                                                <input type="text" id="pass_code" name="pass_code" value="<?php echo $pass_code; ?>">
                                            </div>
                                        </div>
                                        <input type="hidden" id="security-passport" name="security-passport" value="<?php echo create_onetime_nonce( 'passport_nonce' ); ?>">
                                        <input type="button" id="user_passport" value="Сохранить">
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
                                        <div id="password_info_message"></div>
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
                                        <input type="hidden" id="security-password" name="security-password" value="<?php echo create_onetime_nonce( 'password_nonce' ); ?>">
                                        <input type="button" id="change_password" value="Сохранить">
                                    </div>
                                    <div class="part-r">
                                        <div class="in-nwe-ff">
                                            <h3>Верификация
                                                пользователя
                                            </h3>
                                            <div id="doc_info_message"></div>
                                            <p>Загрузите действующий документ, удостоверяющий вашу личность (PNG или JPEG не
                                                более 5МБ)</p>
                                            <div id="user-docs-wrapper">
                                                <?php if (!empty($images)) :
                                                    foreach($images as $image): ?>
                                                    <div class="image-doc-wrapper">
                                                        <img class="user-preview-image" src="<?php echo $image; ?>">
                                                        <button type="button" class="btn btn-danger glyphicon glyphicon-remove"><i class="fas fa-times"></i></button>
                                                    </div>
                                                <?php
                                                    endforeach;
                                                    endif;
                                                ?>
                                                <form id="user_docs">
                                                    <input type="hidden" name="image" id="image" value="" class="regular-text" />
                                                    <button type="button" class="btn btn-default image_doc"><i class="fas fa-plus"></i></button>
                                                    <input type="hidden" id="security-doc" name="security-doc" value="<?php echo create_onetime_nonce( 'doc_nonce' ); ?>">
                                                </form>
                                            </div>
                                            <input type="button" id="uploader_doc" value="Сохранить">
                                        </div>
                                    </div>
                                    <div class="clean"></div>
                                </div>
                            </div>
                            <div id="open-vklad" class="container tab-pane fade">

                                <?php get_template_part('template-calc'); ?>

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
                                            <?php
                                            $args = array(
                                                'post_type' => 'deposit',
                                                'post_status' => 'publish',
                                                'orderby' => 'post_date',
                                                'order' => 'DESC'
                                            );

                                            $deposits = new WP_Query($args);

                                            if ( $deposits->have_posts() ) :
                                                    while ( $deposits->have_posts() ) : $deposits->the_post();
                                                    ?>
                                                    <tr>
                                                        <?php
                                                            $full_name = get_field('full_name');
                                                            $deposit_closed = get_field('deposit_closed');

                                                            if ( $full_name == $user_login && !$deposit_closed ) {
                                                                $number = preg_replace("/[^,.0-9]/", '', get_the_title());
                                                                $zero = str_repeat("0", 5 - strlen($number));
                                                                $number = $zero . $number;


                                                                $deposit_opened = get_field('deposit_opened');
                                                                $close_deposit_date = get_field('close_deposit_date');
                                                                $period = get_field('period');
                                                                $amount = get_field('amount');
                                                                $refill = get_field('refill');
                                                                $rate = get_field('rate');
                                                                $date_period_between_date = floor((strtotime($close_deposit_date) - strtotime($deposit_opened)) / (60 * 60 * 24));
                                                                $$day_in_year = 365;
                                                                $date_between_date = floor((time() - strtotime($deposit_opened)) / (60 * 60 * 24));

                                                                if ($date_period_between_date >= 365) {
                                                                    switch (bcmod($date_period_between_date, '365')) {
                                                                        case 0:
                                                                            $day_in_year = 365;
                                                                            break;
                                                                        case 1:
                                                                            $day_in_year = 366;
                                                                            break;
                                                                    }
                                                                }

                                                                $rate_per_day = $rate / $day_in_year / 100;

                                                                $current_amount = $amount;
                                                                $total_amount = $amount;
                                                                $total_refill = $refill;
                                                                $total_percent = 0;

                                                                for ($i = 0; $i < $date_between_date; ++$i) {
                                                                    $m = 1;
                                                                    $percent = $current_amount * $rate_per_day;
                                                                    $total_percent += $rate_per_day*100;
                                                                    $total_amount += $percent;

                                                                    $counter = strtotime("+" . $i . " day", $deposit_opened);
                                                                    $over_month = strtotime("+" . $m . " month", $deposit_opened);

                                                                    if ($counter == $over_month) {
                                                                        $total_amount += $refill;
                                                                        $total_refill += $refill;
                                                                        $current_amount += $refill;
                                                                        ++$m;
                                                                    }
                                                                }
                                                                ?>
                                                                <td><?php echo $number; ?></td>
                                                                <td><?php echo date('d.m.y', strtotime($deposit_opened)); ?></td>
                                                                <td><?php echo $period; ?> мес.</td>
                                                                <td><?php echo $amount; ?></td>
                                                                <td><?php echo $rate; ?> %</td>
                                                                <td><?php echo round($total_percent, 2); ?> %</td>
                                                                <td><?php echo round($total_amount, 2); ?><img
                                                                            src="<?php echo get_template_directory_uri(); ?>/img/ruble1.png"
                                                                            alt="rb-sing"></td>
                                                                <td><a href=""
                                                                       class="<?php echo (strtotime(date('d.m.y')) >= strtotime($close_deposit_date)) ? 'act' : 'not-act'; ?>">Снять</a>
                                                                    <button data-toggle="popover" data-placement="top"
                                                                            data-trigger="focus" data-content="Test"
                                                                            title="title">?
                                                                    </button>
                                                                </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                    endwhile;
                                                    endif;
                                            ?>
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
                                                <?php
                                                if ( $deposits->have_posts() ) :
                                                    while ( $deposits->have_posts() ) : $deposits->the_post();
                                                    ?>
                                                    <tr>
                                                        <?php
                                                            $full_name = get_field('full_name');
                                                            $deposit_closed = get_field('deposit_closed');

                                                            if ( $full_name == $user_login && $deposit_closed ) {
                                                                $number = preg_replace("/[^,.0-9]/", '', get_the_title());
                                                                $zero = str_repeat("0", 5 - strlen($number));
                                                                $number = $zero . $number;


                                                                $deposit_opened = get_field('deposit_opened');
                                                                $close_deposit_date = get_field('close_deposit_date');
                                                                $period = get_field('period');
                                                                $amount = get_field('amount');
                                                                $refill = get_field('refill');
                                                                $rate = get_field('rate');

                                                                $rate_per_month = $rate /12/100;
                                                                $current_amount = $amount;
                                                                $total_amount = $amount;
                                                                $total_refill = $amount;
                                                                $total_percent = 0;

                                                                for($i=0; $i<$period; ++$i)
                                                                  {
                                                                      $percent = $current_amount * $rate_per_month;
                                                                      $total_percent += $rate_per_month*100;
                                                                  }
                                                                ?>
                                                                <td><?php echo $number; ?></td>
                                                                <td><?php echo date('d.m.y', strtotime($deposit_opened)); ?></td>
                                                                <td><?php echo $period; ?> мес.</td>
                                                                <td><?php echo $amount; ?></td>
                                                                <td><?php echo $rate; ?> %</td>
                                                                <td><?php echo round($total_percent); ?> %</td>
                                                    </tr>
                                                        <?php
                                                            }
                                                    endwhile;
                                                    wp_reset_postdata();
                                                  endif;
                                            ?>
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
        $( '.image_doc' ).on( 'click', function(e) {
            e.preventDefault();

            tb_show('Добавить документ', '/wp-admin/media-upload.php?type=image&amp&TB_iframe=1');

            var oldFunc = window.send_to_editor;

            window.send_to_editor = function( html )
            {
                imgurl = $( html  ).attr( 'src' );
                $( '#image' ).val(imgurl);
                tb_remove();
                $('#user-docs-wrapper').prepend('<div class="image-doc-wrapper"><img class="user-preview-image" src="' + imgurl + '"><button type="button" class="btn btn-danger glyphicon glyphicon-remove"><i class="fas fa-times"></i></button></div>');
                window.send_to_editor = oldFunc;
            }

            return false;
        });

        $( '.file-upload' ).on( 'click', function(e) {
            e.preventDefault();

            tb_show('Добавить фото', '/wp-admin/media-upload.php?type=image&amp&TB_iframe=1');

            var oldFunc = window.send_to_editor;

            window.send_to_editor = function( html )
            {
                imgurl = $( html  ).attr( 'src' );
                $( '#foto' ).val(imgurl);
                tb_remove();
                $('.profile-pic').attr('src', imgurl);
                window.send_to_editor = oldFunc;
            }

            return false;
        });



        $( '#user-docs-wrapper .btn-danger' ).on( 'click', function(e) {
            $(this).parent('.image-doc-wrapper').remove();
        });

        $('a[href$="profile"]').click(function() {
            $('#personal_info_message').empty();
            $('#passport_info_message').empty();
        });

        $('a[href$="open-vklad"]').click(function() {
            $('#deposit_info_message').empty();
            calcresult();
        });
    });
</script>
