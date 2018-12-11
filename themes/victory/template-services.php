<?php
/* Template Name: Services Template */

get_header();

?>

<div class="services-ar">
    <div class="oun-head">
        <h2>Услуги</h2>
    </div>
    <div class="services-wrapp">
        <div class="our-serv">
            <div class="all-block-myserv has-back">
                <h3>Наши услуги</h3>
                <div class="one-serv-our first">
                    <a href="" class="make-order" data-toggle="modal" data-target="#make-order">
                        <div class="have-img-back"></div>
                        <div class="ser-info-off">
                            <h4 class="one-serv-name">Грузчик</h4>
                            <p class="price-of-our"><span>300</span> <i><img src="<?php echo get_template_directory_uri(); ?>/img/ruble1.png" alt="rb-sing"></i>/час</p>
                            <div class="clean"></div>
                        </div>
                    </a>
                </div>
                <div class="one-serv-our sec">
                    <a href="" class="make-order" data-toggle="modal" data-target="#make-order">
                        <div class="have-img-back"></div>
                        <div class="ser-info-off">
                            <h4 class="one-serv-name">Сантехник</h4>
                            <p class="price-of-our"><span>500</span> <i><img src="<?php echo get_template_directory_uri(); ?>/img/ruble1.png" alt="rb-sing"></i>/час</p>
                            <div class="clean"></div>
                        </div>
                    </a>
                </div>
                <div class="one-serv-our thr">
                    <a href="" class="make-order" data-toggle="modal" data-target="#make-order">
                        <div class="have-img-back"></div>
                        <div class="ser-info-off">
                            <h4 class="one-serv-name">Электрик</h4>
                            <p class="price-of-our"><span>500</span> <i><img src="<?php echo get_template_directory_uri(); ?>/img/ruble1.png" alt="rb-sing"></i>/час</p>
                            <div class="clean"></div>
                        </div>
                    </a>
                </div>
                <div class="clean"></div>
            </div>
            <div class="all-block-myserv">
                <h3>Аренда спецтехники</h3>

                <?php
                $args = array(
                    'post_type' => 'equipment',
                    'post_status' => 'publish',
                    'orderby' => 'post_date',
                    'order' => 'DESC'
                );

                $equipments = new WP_Query($args);

                if ( $equipments->have_posts() ) :
                    while ( $equipments->have_posts() ) : $equipments->the_post();

                        $equipment_name = get_the_title();
                        $equipment_type = get_field('equipment_type');
                        $equipment_price = (empty(get_field('equipment_price'))) ? 'договорная' : get_field('equipment_price');

                        if( have_rows('equipment_gallery') ):
                            while ( have_rows('equipment_gallery') ) : the_row();

                                $image = get_sub_field('equipment_image');
                                break;

                            endwhile;
                        endif;
                    ?>
                        <div class="one-serv-our car-w">
                            <a href="<?php echo get_permalink(); ?>">
                                <div class="have-img-back" style="background-image:url(<?php echo $image; ?>"></div>
                                <div class="ser-info-off">
                                    <h4 class="one-serv-name"><?php echo $equipment_type; ?></h4>
                                    <p class="price-of-our"><span><?php echo $equipment_price; ?></span><?php echo ($equipment_price == 'договорная') ? '</p>' : '<i><img src="' . get_template_directory_uri() . '/img/ruble1.png" alt="rb-sing"></i>/час</p>' ?>
                                    <div class="clean"></div>
                                    <p class="name-of-carr"><?php echo $equipment_name; ?></p>
                                </div>
                            </a>
                        </div>
                <?php
                    endwhile;
                endif;
                ?>
                <div class="clean"></div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
