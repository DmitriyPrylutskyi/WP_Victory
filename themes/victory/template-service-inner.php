<?php
/* Template Name: Services Inner Template */

get_header();

?>

<div class="services-inner-ar">
    <div class="oun-head">
        <h2>Услуги</h2>
    </div>
    <?php

        if (have_posts()): while (have_posts()) : the_post();

            $equipment_name = get_the_title();
            $equipment_type = get_field('equipment_type');
            $equipment_price = (empty(get_field('equipment_price'))) ? 'по согласованию' : get_field('equipment_price');
            $equipment_config = get_field('equipment_config');
            $equipment_carrying = get_field('equipment_carrying');
            $equipment_volume = get_field('equipment_volume');
            $equipment_dimensions = get_field('equipment_dimensions');

        if( have_rows('equipment_gallery') ):
            while ( have_rows('equipment_gallery') ) : the_row();

                $image = get_sub_field('equipment_image');

                $fancybox .= '<a data-fancybox="gallery-top" href="' . $image . '">';
                $fancybox .= '<div style="background-image:url(' . $image .'); cursor: pointer;" class="img-slide-f">';
                $fancybox .= '</div></a>';

                $slide .= '<div style="background-image:url(' . $image . '); cursor: pointer; " class="img-slide-f">';
                $slide .= '</div>';

            endwhile;
        endif;

    ?>
    <div class="services-inner-wrapp">
        <a href="<?php echo get_permalink( get_page_by_path( 'services', OBJECT ) ); ?>" class="back-to-allserv"><i class="fas fa-chevron-left"></i>Вернуться</a>
        <h3 class="title-serv">Аренда спецтехники</h3>
        <div class="all-line-worr">
            <div class="left-w-sl">
                <section class="slide-foto">
                    <?php echo $fancybox; ?>
                </section>
                <section class="slide-foto-nav">
                    <?php echo $slide; ?>
                </section>
                <div class="clean"></div>
            </div>
            <div class="right-w-sl">
                <h4 class="title"><?php echo $equipment_type; ?></h4>
                <p class="name-of-carr"><?php echo $equipment_name; ?></p>
                <ul class="list-of-dop">
                    <?php
                        if (!empty($equipment_config))
                            echo '<li>Конфигурация: <span>' . $equipment_config .'</span></li>';

                        if (!empty($equipment_carrying))
                            echo '<li>Грузоподъёмность: <span>' .$equipment_carrying . 'тонн</span></li>';

                        if (!empty($equipment_volume))
                             echo '<li>Объём кузова: <span>' . $equipment_volume .' м3</span></li>';

                        if (!empty($equipment_dimensions))
                            echo '<li>Габариты кузова: <span>' . $equipment_dimensions . ' мм</span></li>';
                    ?>
                </ul>
                <div class="one-line-bl-bott">
                    <button type="submit" class="left-input" data-toggle="modal" data-target="#make-order">Заказать</button>
                    <p class="right-info-bott">Цена: <span><?php echo $equipment_price; ?></span><?php echo ($equipment_price == 'по согласованию') ? '</p>' : '<i><img src="' . get_template_directory_uri() . '/img/ruble1.png" alt="rb-sing"></i>/час</p>'; ?>
                </div>
            </div>
            <div class="clean"></div>
        </div>
    </div>
    <?php
        endwhile;
        endif;
    ?>
</div>

<?php get_footer(); ?>
