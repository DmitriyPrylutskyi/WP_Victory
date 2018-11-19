<?php
function theme_options_page(){
    // variables for the field and option names
    $email_name = 'email_options';
    $email_field_name = 'Email';
    $phone_name = 'phone_options';
    $phone_field_name = 'Телефон';
    $rate_3_name = 'month_3_rate_options';
    $rate_3_field_name = 'Процентная ставка на 3 месяца';
    $rate_6_name = 'month_6_rate_options';
    $rate_6_field_name = 'Процентная ставка на 6 месяцев';
    $rate_12_name = 'month_12_rate_options';
    $rate_12_field_name = 'Процентная ставка на 12 месяцев';
    $rate_24_name = 'month_24_rate_options';
    $rate_24_field_name = 'Процентная ставка на 24 месяца';
    $rate_termless_name = 'termless_rate_options';
    $rate_termless_field_name = 'Процентная ставка на безсрочный период';
    $hidden_field_name = 'vicory_submit_hidden';

    // Read in existing option value from database
    $email_val = get_option( $email_name );
    $phone_val = get_option( $phone_name );
    $rate_3_val = get_option( $rate_3_name );
    $rate_6_val = get_option( $rate_6_name );
    $rate_12_val = get_option( $rate_12_name );
    $rate_24_val = get_option( $rate_24_name );
    $rate_termless_val = get_option( $rate_termless_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_email = $email_val = $_POST[ $email_name ];
        $opt_phone = $phone_val = $_POST[ $phone_name ];
        $opt_rate_3  = $rate_3_val = $_POST[ $rate_3_name ];
        $opt_rate_6  = $rate_6_val = $_POST[ $rate_6_name ];
        $opt_rate_12 = $rate_12_val = $_POST[ $rate_12_name ];
        $opt_rate_24  = $rate_24_val = $_POST[ $rate_24_name ];
        $opt_rate_termless  = $rate_termless_val = $_POST[ $rate_termless_name ];

        // Save the posted value in the database
        update_option( $email_name, $opt_email );
        update_option( $phone_name, $opt_phone );
        update_option( $rate_3_name, $opt_rate_3 );
        update_option( $rate_6_name, $opt_rate_6 );
        update_option( $rate_12_name, $opt_rate_12 );
        update_option( $rate_24_name, $opt_rate_24 );
        update_option( $rate_termless_name, $opt_rate_termless );

        // Put an options updated message on the screen

    ?>

    <div class="updated"><p><strong>Изменения сохранены</strong></p></div>

<?php

    }

?>

    <div id="victory_wrapper_admin_menu">
        <h1>Основные настройки</h1>
        <form method="post" enctype="multipart/form-data" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="<?php echo $email_name; ?>"><?php echo $email_field_name; ?></label>
                        </th>
                        <td><input name="<?php echo $email_name; ?>" type="text" id="<?php echo $email_name; ?>" value="<?php echo $email_val; ?>" class='regular-text'></td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="<?php echo $phone_name; ?>"><?php echo $phone_field_name; ?></label>
                        </th>
                        <td><input name="<?php echo $phone_name; ?>" type="text" id="<?php echo $phone_name; ?>" value="<?php echo $phone_val; ?>" class='regular-text'></td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <h2>Сберегательные программы</h2>
                        </th>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="<?php echo $rate_3_name; ?>"><?php echo $rate_3_field_name; ?></label>
                        </th>
                        <td><input class="small-text" name="<?php echo $rate_3_name; ?>" type="text" id="<?php echo $rate_3_name; ?>" value="<?php echo $rate_3_val; ?>" class='regular-text'></td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="<?php echo $rate_6_name; ?>"><?php echo $rate_3_field_name; ?></label>
                        </th>
                        <td><input class="small-text" name="<?php echo $rate_6_name; ?>" type="text" id="<?php echo $rate_6_name; ?>" value="<?php echo $rate_6_val; ?>" class='regular-text'></td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="<?php echo $rate_12_name; ?>"><?php echo $rate_12_field_name; ?></label>
                        </th>
                        <td><input class="small-text" name="<?php echo $rate_12_name; ?>" type="text" id="<?php echo $rate_12_name; ?>" value="<?php echo $rate_12_val; ?>" class='regular-text'></td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="<?php echo $rate_24_name; ?>"><?php echo $rate_24_field_name; ?></label>
                        </th>
                        <td><input class="small-text" name="<?php echo $rate_24_name; ?>" type="text" id="<?php echo $rate_24_name; ?>" value="<?php echo $rate_24_val; ?>" class='regular-text'></td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="<?php echo $rate_termless_name; ?>"><?php echo $rate_termless_field_name; ?></label>
                        </th>
                        <td><input class="small-text" name="<?php echo $rate_termless_name; ?>" type="text" id="<?php echo $rate_termless_name; ?>" value="<?php echo $rate_termless_val; ?>" class='regular-text'></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y"></td>
                    </tr>
                </tbody>
            </table>
            <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Сохранить"></p>
        </form>
    </div>

    <?php
}

?>