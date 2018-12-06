<?php
/* Template Name: Loans Template */

get_header();

$phone = get_option('phone_options');

?>

<div class="loans-ar">
    <div class="oun-head">
        <h2>Займы</h2>
    </div>
    <div class="loans-wrapp">
        <div class="block-with-back-or">
            <ol>
                <li>
                    <div>
                        Потребительский кооператив «ПОБЕДА» выдаёт займы от 100 000 рублей юридическим и физическим лицам.
                    </div>
                </li>
                <li>
                    <div>
                        Процентная ставка по займу рассматривается в индивидуальном порядке и варьируется.
                    </div>
                </li>
                <li>
                    <div>
                        Займы выдаются только под обеспечение – поручительство либо залог, которым может быть как
                        недвижимое, так и движимое имущество. Срок рассмотрения заявки – 3 рабочих дня.
                    </div>
                </li>
                <li>
                    <div>
                        Подать заявку на выдачу займа и получить всю необходимую дополнительную информацию можно в
                        офисе кооператива либо по телефону <a href="tel://<?php echo $phone; ?>"><?php echo $phone; ?></a> (звонок бесплатный)
                    </div>
                </li>
            </ol>
        </div>
        <div class="clean"></div>
        <div class="text-info-only">

        </div>
    </div>
</div>

<?php get_footer(); ?>
