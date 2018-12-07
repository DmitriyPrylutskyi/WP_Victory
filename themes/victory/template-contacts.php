<?php
/* Template Name: Contacts Template */

get_header();

$address = get_option('address_options');
$email = get_option('email_options');
$phone = get_option('phone_options');

if( have_rows('offices') ):
    while ( have_rows('offices') ) : the_row();

        $office_name      = get_sub_field('office_name');
        $office_address   = get_sub_field('office_address');
        $office_phone     = get_sub_field('office_phone');
        $office_email     = get_sub_field('office_email');

        $offices .= '<div class="one-line-contact">';
        $offices .= '<div class="left-line-cont">';
        $offices .= '<div class="block-with-map">';
        $offices .= get_coords($office_name . ' ' . $office_address);
        $offices .= '</div>';
        $offices .= '</div>';
        $offices .= '<div class="right-line-cont">';
        $offices .= '<h3>' . $office_name . '</h3>';
        $offices .= '<p>';
        $offices .= '<span>' . $office_address . '</span>';
        $offices .= '<span>телефон: ' . $office_phone . '</span>';
        $offices .= '<span>e-mail: ' . $office_email . '</span>';
        $offices .= '</p>';
        $offices .= '</div>';
        $offices .= '</div>';

    endwhile;
endif;


function get_coords($address) {
    //echo '<script type="text/javascript" charset="utf-8" async="" src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU"></script>';

    //echo '<script type="application/javascript">
    //        var geocoder = new YMaps.Geocoder("' . $address .'");
    //        map.addOverlay(geocoder);
    //       </script>';
};

?>

<div class="contacts-ar">
    <div class="oun-head">
        <h2>КОНТАКТЫ</h2>
    </div>
    <div class="jjjjd">
        <div class="new-back">
        </div>
    </div>
    <div class="contacts-wrapp">
        <p class="text-right-add">Офисы потребительского кооператива «ПОБЕДА»:</p>
        <div class="all-lines-cont">
            <?php echo $offices; ?>
        </div>

        <div class="send-email-one-line">
            <div class="left-send-mail">
                <div class="one-p otor-rp">
                    <p>E-mail : <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
                    <p>Тел. <a href="tel://<?php echo $phone; ?>"><?php echo $phone; ?></a></p>
                </div>
                <div class="otor-rp">
                    <p>Адрес <?php echo $address; ?></p>
                </div>
            </div>
            <div class="right-send-mail">
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
            <div class="clean"></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
