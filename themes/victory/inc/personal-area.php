<?php
/// Register function

if( wp_doing_ajax() ){
	add_action( 'wp_ajax_nopriv_victory_ajax_register_form', 'victory_ajax_register_form' );
	add_action( 'wp_ajax_victory_ajax_register_form', 'victory_ajax_register_form' );
}

if( !function_exists('victory_ajax_register_form') ) {

    function victory_ajax_register_form(){

        $allowed_html =   array();
        $last_name    =   trim( wp_kses ($_POST['last_name'],$allowed_html ));
        $first_name   =   trim( wp_kses ($_POST['first_name'],$allowed_html ));
        $patronymic   =   trim( wp_kses ($_POST['patronymic'],$allowed_html ));
        $email        =   trim( wp_kses ($_POST['email'],$allowed_html ));
        $phone        =   trim( wp_kses ($_POST['phone'],$allowed_html ));
        $password     =   trim( wp_kses( $_POST['password'] ,$allowed_html) );
        $rpassword    =   trim( wp_kses( $_POST['rpassword'] ,$allowed_html) );

        if( !verify_onetime_nonce($_POST['nonce'], 'register_nonce') ){
            echo json_encode(array('register'=>false, 'message'=>'Что-то пошло не так. Повторите позже.'));
            exit();
        }

        $user_name		= 	$last_name . ' ' . $first_name . ' ' . $patronymic;

        if (preg_match("/^[^\d_,.!@#$%^&*()-\/*+=?~`\[\]\\<>]+$/", $last_name) == 0) {
            echo json_encode(array('register'=>false,'message'=>'Некорректное имя !', 'id'=>'last_name'));
            die();
        }

        if (preg_match("/^[^\d_,.!@#$%^&*()-\/*+=?~`\[\]\\<>]+$/", $first_name) == 0) {
            echo json_encode(array('register'=>false,'message'=>'Некорректное имя !', 'id'=>'first_name'));
            die();
        }

        if (preg_match("/^[^\d_,.!@#$%^&*()-\/*+=?~`\[\]\\<>]+$/", $patronymic) == 0) {
            echo json_encode(array('register'=>false,'message'=>'Некорректное имя !', 'id'=>'patronymic'));
            die();
        }

        if ($email==''){
            echo json_encode(array('register'=>false,'message'=>'Поле почты пустое!', 'id'=>'email'));
            exit();
        }

        if ($user_name==''){
            echo json_encode(array('register'=>false,'message'=>'Поле имя пустое!', 'id'=>'last_name'));
            exit();
        }

        if(filter_var($email,FILTER_VALIDATE_EMAIL) === false) {
            echo json_encode(array('register'=>false,'message'=>'Почта некорректная!', 'id'=>'email'));
            exit();
        }

        $domain = substr(strrchr($email, "@"), 1);
        if( !checkdnsrr ($domain) ){
            echo json_encode(array('register'=>false,'message'=>'Почта некорректная!', 'id'=>'email'));
            exit();
        }

        if (preg_match("/^[\d- ]+$/", $phone) == 0) {
            echo json_encode(array('register'=>false,'message'=>'Некорректный номер телефона !', 'id'=>'phone'));
            die();
        }

        if ($phone==''){
            echo json_encode(array('register'=>false,'message'=>'Поле телефон пустое!', 'id'=>'phone'));
            exit();
        }

        if ($password=='' || $rpassword=='' ){
            echo json_encode(array('register'=>false,'message'=>'Одно из полей пароля пустое!', 'id'=>'password'));
            exit();
        }

        if ($password !== $rpassword ){
            echo json_encode(array('register'=>false,'message'=>'Пароли не совпадают!', 'id'=>'password'));
            exit();
        }

        $user = get_users(array('meta_key' => 'phone', 'meta_value' => $phone));
        if ( !$user ) {

            $user_id = wp_create_user( $user_name, $password, $email );

            //var_dump($user_id); die();

            update_user_meta($user_id, 'first_name', $first_name);
            update_user_meta($user_id, 'last_name', $last_name);
            update_user_meta($user_id, 'patronymic', $patronymic);
            update_user_meta($user_id, 'phone', $phone);

            echo json_encode(array('register'=>true,'message'=>'Регистрация прошла успешно ...'));

            exit();

        } else {
            echo json_encode(array('register'=>false,'message'=>'Пользователь с таким номером уже существует!', 'id'=>'phone'));
        }
        die();

    }

}

/// Login function

if( wp_doing_ajax() ){
	add_action( 'wp_ajax_nopriv_victory_ajax_login_form', 'victory_ajax_login_form' );
	add_action( 'wp_ajax_victory_ajax_login_form', 'victory_ajax_login_form' );
}

if( !function_exists('victory_ajax_login_form') ) {

    function victory_ajax_login_form(){

        $allowed_html =   array();
        $phone   			=   trim( wp_kses ($_POST['phone'],$allowed_html ));
        $password     =   trim( wp_kses( $_POST['password'] ,$allowed_html)  );

        if( !verify_onetime_nonce($_POST['nonce'], 'login_nonce') ){
            echo json_encode(array('login'=>false, 'message'=>'Что-то пошло не так. Повторите позже.'));
            exit();
        }

        $user = get_users(array('meta_key' => 'phone', 'meta_value' => $phone));

        $user_name = $user[0]->data->user_login;

        if ($phone==''){
            echo json_encode(array('login'=>false,'message'=>'Поле телефон пустое!', 'id'=>'phone'));
            exit();
        }

        if ($password=='' ){
            echo json_encode(array('login'=>false,'message'=>'Одно из полей пароля пустое!', 'id'=>'password'));
            exit();
        }

        wp_clear_auth_cookie();

        $info                   = array();
        $info['user_login']     = $user_name;
        $info['user_password']  = $password;
        $info['remember'] 		= true;
        $user_signon            = wp_signon( $info, true );

        if ( is_wp_error($user_signon) ){
            echo json_encode(array('login'=>false, 'message'=>'Недействительное имя пользователя или пароль!', 'id'=>'phone'));
        } else {
            wp_set_auth_cookie($user_signon->ID);
            echo json_encode(array('login'=>true, 'message'=>'Авторизация прошла успешно ...'));
        }

        die();

    }

}

/// Ajax Forgot Pass function

add_action( 'wp_ajax_nopriv_victory_ajax_forgot_pass', 'victory_ajax_forgot_pass' );
add_action( 'wp_ajax_victory_ajax_forgot_pass', 'victory_ajax_forgot_pass' );

if( !function_exists('victory_ajax_forgot_pass') ):

    function victory_ajax_forgot_pass(){
        global $wpdb;

        //    check_ajax_referer( 'login_ajax_nonce', 'security-forgot' );
        $allowed_html   =   array();
        $forgot_email   =   sanitize_text_field( wp_kses( $_POST['forgot_email'],$allowed_html) ) ;

        if( !verify_onetime_nonce($_POST['nonce'], 'forgot_nonce') ){
            echo 'Что-то пошло не так. Повторите позже.';
            exit();
        }

        if ($forgot_email==''){
            echo 'Поле почты пустое!';
            exit();
        }

        //We shall SQL escape the input
        $user_input = trim($forgot_email);

        $value          = 'Вы попросили сбросить пароль для следующей учетной записи:
                            %website_url
                            Имя: %username.
                            IЕсли это была ошибка, просто игнорируйте это письмо, и ничего не произойдет. Чтобы сбросить пароль, перейдите по следующему адресу: %reset_link,,
                            Спасибо!';
        $value_subject  = 'Запрос на изменение пароля';

        $user_data = get_user_by( 'email', $user_input );
        if(empty($user_data) || isset( $user_data->caps['administrator'] ) ) {
            echo'Почта некорректная!';
            exit();
        }

        $user_login = $user_data->user_login;
        $user_email = $user_data->user_email;

        $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
        if(empty($key)) {
            //generate reset key
            $key = wp_generate_password(20, false);
            $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
        }

        //emailing password change request details to the user
        //$arguments=array(
        //    'reset_link'        =>  victory_validate_url() . "action=reset_pwd&key=$key&login=" . rawurlencode($user_login)
        //);

        //victory_emails_filter_replace($user_email,$value,$value_subject,$arguments);

        echo 'Мы только что отправили вам электронное письмо с инструкциями по сбросу пароля.';

        die();
    }
endif; // end   victory_ajax_forgot_pass

if( !function_exists('victory_emails_filter_replace')):
    function  victory_emails_filter_replace($user_email,$message,$subject,$arguments){
        $arguments ['website_url'] = get_option('siteurl');
        $arguments ['website_name'] = get_option('blogname');
        $arguments ['user_email'] = $user_email;
        $user= get_user_by('email',$user_email);
        $arguments ['username'] = $user-> user_login;

        foreach($arguments as $key_arg=>$arg_val){
            $subject = str_replace('%'.$key_arg, $arg_val, $subject);
            $message = str_replace('%'.$key_arg, $arg_val, $message);
        }

        victory_email($user_email, $subject, $message);
    }
endif;

if (!function_exists('victory_email')):
    function victory_email($user_email, $subject, $message){
        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";
        @wp_mail(
            $user_email,
            $subject,
            $message,
            $headers
        );
    };
endif;

if( !function_exists('victory_validate_url') ):
    function victory_validate_url() {
        $page_url = esc_html( home_url() );
        $urlget = strpos($page_url, "?");
        if ($urlget === false) {
            $concate = "?";
        } else {
            $concate = "&";
        }
        return $page_url.$concate;
    }
endif; // end   victory_validate_url


/// Ajax Update Personal Info

add_action( 'wp_ajax_nopriv_victory_ajax_update_profile', 'victory_ajax_update_profile' );
add_action( 'wp_ajax_victory_ajax_update_profile', 'victory_ajax_update_profile' );

if( !function_exists('victory_ajax_update_profile') ):

    function victory_ajax_update_profile(){
        $current_user   =   wp_get_current_user();
        $userID         =   $current_user->ID;
        $login_name     =   $current_user->display_name;
        if ( !is_user_logged_in() ) {
            exit('ko');
        }
        if($userID === 0 ){
            exit('out pls');
        }

        if( !verify_onetime_nonce($_POST['nonce'], 'personal_nonce') ){
            print('Что-то пошло не так. Повторите позже.');
            exit();
        }

        $allowed_html   =   array();
        $foto           =   sanitize_text_field ( wp_kses( $_POST['foto'] ,$allowed_html) );
        $firstname      =   sanitize_text_field ( wp_kses( $_POST['firstname'] ,$allowed_html) );
        $lastname     	=   sanitize_text_field ( wp_kses( $_POST['lastname'] ,$allowed_html)) ;
        $patronymic     =   sanitize_text_field ( wp_kses( $_POST['patronymic'] ,$allowed_html)) ;
        $email      	=   sanitize_text_field ( wp_kses( $_POST['useremail'] ,$allowed_html) );
        $phone      	=   sanitize_text_field ( wp_kses( $_POST['userphone'] ,$allowed_html) );
        $birthday     	=   sanitize_text_field ( wp_kses( $_POST['userbirthday'] ,$allowed_html) );
        $city      		=   sanitize_text_field ( wp_kses( $_POST['usercity'] ,$allowed_html) );
        $gender      	=   sanitize_text_field ( wp_kses( $_POST['gender'] ,$allowed_html) );

        update_user_meta($userID, 'foto', $foto);
        update_user_meta($userID, 'first_name', $firstname);
        update_user_meta($userID, 'last_name', $lastname);
        update_user_meta($userID, 'patronymic', $patronymic);
        update_user_meta($userID, 'email', $email);
        update_user_meta($userID, 'phone', $phone);
        update_user_meta($userID, 'birthday', $birthday);
        update_user_meta($userID, 'city', $city);
		update_user_meta($userID, 'gender', $gender);

        $user = get_users(array('meta_key' => 'phone', 'meta_value' => $phone));

        if($userID == $user[0]->data->ID ) {
        		if($phone==''){
                print ('Поле телефон пустое!');
                exit();
						} else if($email==''){
                print ('Поле почты пустое!');
                exit();
            } else if(filter_var($email,FILTER_VALIDATE_EMAIL) === false) {
                print ( 'Почта некорректная!');
                exit();
            } else if($gender=='') {
                print ( 'Не выбран пол!');
                exit();
            }
            else{
                $args = array(
                    'ID'         => $userID,
                    'user_email' => $email,
                    'foto'       => $foto,
                    'first_name' => $firstname,
                    'last_name'  => $lastname,
                    'patronymic' => $patronymic,
                    'phone'		 => $phone,
                    'birthday'	 => $birthday,
                    'city'		 => $city,
                    'gender'	 => $gender
                );

                wp_update_user( $args );
				        print ('Profile updated');
				        die();
            }
        }

        print ('Телефон не был сохранен, потому что он используется другим пользователем.');

        die();
    }
endif; // end   victory_ajax_update_profile


/// Ajax Update Passport Info

add_action( 'wp_ajax_nopriv_victory_ajax_update_passport', 'victory_ajax_update_passport' );
add_action( 'wp_ajax_victory_ajax_update_passport', 'victory_ajax_update_passport' );

if( !function_exists('victory_ajax_update_passport') ):

    function victory_ajax_update_passport(){
        $current_user   =   wp_get_current_user();
        $userID         =   $current_user->ID;
        if ( !is_user_logged_in() ) {
            exit('ko');
        }
        if($userID === 0 ){
            exit('out pls');
        }

        if( !verify_onetime_nonce($_POST['nonce'], 'passport_nonce') ){
            print('Что-то пошло не так. Повторите позже.');
            exit();
        }

        //check_ajax_referer( 'profile_ajax_nonce', 'security-profile' );
        $allowed_html   =   array();
        $passser        =   sanitize_text_field ( wp_kses( $_POST['passser'] ,$allowed_html) );
        $passnum       	=   sanitize_text_field ( wp_kses( $_POST['passnum'] ,$allowed_html)) ;
        $passwhom       =   sanitize_text_field ( wp_kses( $_POST['passwhom'] ,$allowed_html)) ;
        $passdate    		=   sanitize_text_field ( wp_kses( $_POST['passdate'] ,$allowed_html) );
        $passcode      	=   sanitize_text_field ( wp_kses( $_POST['passcode'] ,$allowed_html) );

        update_user_meta($userID, 'passser', $passser);
        update_user_meta($userID, 'passnum', $passnum);
        update_user_meta($userID, 'passwhom', $passwhom);
        update_user_meta($userID, 'passdate', $passdate);
        update_user_meta($userID, 'passcode', $passcode);

        $args = array(
            'ID'         => $userID,
            'pass_ser' 	 => $passser,
            'pass_num'   => $passnum,
            'pass_whom'  => $passwhom,
            'pass_date'  => $passdate,
            'pass_code'  => $passcode
        );

        wp_update_user( $args );
        print ('Пароль обновлен');


        die();
    }
endif; // end   victory_ajax_update_passport

/// Ajax  Change Pass function

add_action( 'wp_ajax_nopriv_victory_ajax_change_pass', 'victory_ajax_change_pass' );
add_action( 'wp_ajax_victory_ajax_change_pass', 'victory_ajax_change_pass' );

if( !function_exists('victory_ajax_change_pass') ):
    function victory_ajax_change_pass(){
        $current_user   = wp_get_current_user();
        $allowed_html   = array();
        $userID         = $current_user->ID;

        if ( !is_user_logged_in() ) {
            exit('ko');
        }
        if($userID === 0 ){
            exit('out pls');
        }

        if( !verify_onetime_nonce($_POST['nonce'], 'password_nonce') ){
            print ('Что-то пошло не так. Повторите позже.');
            exit();
        }

        $oldpass        =   sanitize_text_field ( wp_kses( $_POST['oldpass'] ,$allowed_html) );
        $newpass        =   sanitize_text_field ( wp_kses( $_POST['newpass'] ,$allowed_html) );
        $renewpass      =   sanitize_text_field ( wp_kses( $_POST['renewpass'] ,$allowed_html) );

        if($newpass=='' || $renewpass=='' ){
            print ('Новый пароль пустой!');
            die();
        }

        if($newpass != $renewpass){
            print ('Пароли не совпадают!');
            die();
        }

        $user = get_user_by( 'id', $userID );
        if ( $user && wp_check_password( $oldpass, $user->data->user_pass, $user->ID) ){
            wp_set_password( $newpass, $user->ID );
            print ('Обновлен пароль - вам нужно будет снова выйти и войти в систему!');
        }else{
            print ('Старый пароль не верен!');
        }

        die();
    }
endif; // end  vicory_ajax_change_pass

/// Ajax Update Doc function

add_action( 'wp_ajax_nopriv_victory_ajax_update_doc', 'victory_ajax_update_doc' );
add_action( 'wp_ajax_victory_ajax_update_doc', 'victory_ajax_update_doc' );

if( !function_exists('victory_ajax_update_doc') ):
    function victory_ajax_update_doc(){
        $current_user   = wp_get_current_user();
        $allowed_html   = array();
        $userID         = $current_user->ID;

        if ( !is_user_logged_in() ) {
            exit('ko');
        }
        if($userID === 0 ){
            exit('out pls');
        }

        if( !verify_onetime_nonce($_POST['nonce'], 'doc_nonce') ){
            print ('Что-то пошло не так. Повторите позже.');
            exit();
        }

        $imageurl = $_POST['images'];

        if($imageurl=='' ){
          $images = "";
        } else {
        	$images = serialize($imageurl);
      	}

        update_user_meta( $userID, 'images', $images);

        print ('Документы обновлены');

        die();
    }
endif; // end  victory_ajax_update_doc

/// Add Deposit function

if( wp_doing_ajax() ){
    add_action( 'wp_ajax_nopriv_victory_ajax_add_deposit', 'victory_ajax_add_deposit' );
    add_action( 'wp_ajax_victory_ajax_add_deposit', 'victory_ajax_add_deposit' );
}

if( !function_exists('victory_ajax_add_deposit') ) {

    function victory_ajax_add_deposit(){

        $current_user   = wp_get_current_user();
        $full_name      = $current_user->display_name;
        $userID         = $current_user->ID;
        $allowed_html   = array();

        if ( !is_user_logged_in() ) {
            exit('ko');
        }
        if($userID === 0 ){
            exit('out pls');
        }

        $amount       =   trim( wp_kses ($_POST['amount'],$allowed_html ));
        $refill       =   trim( wp_kses ($_POST['refill'],$allowed_html ));
        $rate         =   trim( wp_kses ($_POST['rate'],$allowed_html ));
        $period       =   trim( wp_kses ($_POST['period'],$allowed_html ));

        if( !verify_onetime_nonce($_POST['nonce'], 'security-deposit') ){
            print ('Что-то пошло не так. Повторите позже.');
            exit();
        }

        if ($amount==''){
            print ('Поле Сумыы Вложения пустое!');
            exit();
        }

        if ($refill==''){
            print ('Поле Сумыы Ежемесячного пополнения пустое!');
            exit();
        }

        $post = array(
            'post_status'   => 'pending',
            'post_type'     => 'deposit' ,
            'post_author'   => $userID
        );
        $post_id =  wp_insert_post($post );

        if($post_id) {
            $arg = array(
                'ID' => $post_id,
                'post_title' => 'Вклад № ' .  $post_id
            );
            wp_update_post( wp_slash($arg) );

            update_field( 'full_name' , $full_name, $post_id );
            update_field( 'amount' , $amount, $post_id );
            update_field( 'refill' , $refill, $post_id );
            update_field( 'rate' , $rate, $post_id );
            update_field( 'period' , $period, $post_id );

            print ('Заявка отправлена');
        } else {
            print ('Повторите попытку позже');
        }

        wp_reset_query();

        die();

    }
}

/// Add Order function

if( wp_doing_ajax() ){
    add_action( 'wp_ajax_nopriv_victory_ajax_add_order', 'victory_ajax_add_order' );
    add_action( 'wp_ajax_victory_ajax_add_order', 'victory_ajax_add_order' );
}

if( !function_exists('victory_ajax_add_order') ) {

    function victory_ajax_add_order(){
        $allowed_html   = array();

        $order_type       =   trim( wp_kses ($_POST['order_type'],$allowed_html ));
        $order_name       =   trim( wp_kses ($_POST['order_name'],$allowed_html ));
        $order_phone      =   trim( wp_kses ($_POST['order_phone'],$allowed_html ));
        $order_date       =   trim( wp_kses ($_POST['order_date'],$allowed_html ));
        $order_comment    =   trim( wp_kses ($_POST['order_comment'],$allowed_html ));

        if( !verify_onetime_nonce($_POST['nonce'], 'order_nonce') ){
            print ('Что-то пошло не так. Повторите позже.');
            exit();
        }

        if ($order_name==''){
            print ('Поле Имя пустое!');
            exit();
        }

        if ($order_phone==''){
            print ('Поле Телефон пустое!');
            exit();
        }

        if ($order_date==''){
            print ('Поле Даты пустое!');
            exit();
        }

        $post = array(
            'post_status'   => 'publish',
            'post_type'     => 'service'
        );
        $post_id =  wp_insert_post($post );

        if($post_id) {
            $arg = array(
                'ID' => $post_id,
                'post_title' => 'Заказ № ' .  $post_id
            );
            wp_update_post( wp_slash($arg) );

            update_field( 'order_type' , $order_type, $post_id );
            update_field( 'order_name' , $order_name, $post_id );
            update_field( 'order_phone' , $order_phone, $post_id );
            update_field( 'order_date' , $order_date, $post_id );
            update_field( 'order_comment' , $order_comment, $post_id );

            print ('Заказ отправлен');
        } else {
            print ('Повторите попытку позже');
        }

        wp_reset_query();

        die();

    }

}

/// Send Request function

if( wp_doing_ajax() ){
    add_action( 'wp_ajax_nopriv_victory_ajax_request', 'victory_ajax_request' );
    add_action( 'wp_ajax_victory_ajax_request', 'victory_ajax_request' );
}

if( !function_exists('victory_ajax_request') ) {

    function victory_ajax_request(){
        $allowed_html   = array();

        $requestor_name    =   trim( wp_kses ($_POST['requestor_name'],$allowed_html ));
        $requestor_email   =   trim( wp_kses ($_POST['requestor_email'],$allowed_html ));
        $requestor_comment =   trim( wp_kses ($_POST['requestor_comment'],$allowed_html ));

        if( !verify_onetime_nonce($_POST['nonce'], 'request_nonce') ){
            echo json_encode(array('register'=>false, 'message'=>'Что-то пошло не так. Повторите позже.'));
            print ('Что-то пошло не так. Повторите позже.');
            exit();
        }

        if ($requestor_name==''){
            echo json_encode(array('request'=>false,'message'=>'Некорректное имя !', 'id'=>'requestor-name'));
            exit();
        }

        if ($requestor_email==''){
            echo json_encode(array('request'=>false,'message'=>'Некорректная почта !', 'id'=>'requestor-email'));
            exit();
        }

        if(filter_var($requestor_email,FILTER_VALIDATE_EMAIL) === false) {
            echo json_encode(array('request'=>false,'message'=>'Некорректная почта !', 'id'=>'requestor-email'));
            exit();
        }

        $domain = substr(strrchr($requestor_email, "@"), 1);
        if( !checkdnsrr ($domain) ){
            echo json_encode(array('request'=>false,'message'=>'Некорректная почта !', 'id'=>'requestor-email'));
            exit();
        }

        $website = get_site_url();
        $subject = 'Отправлено с сайта ' . $website;

        $message='';

        $receiver_email = get_option('admin_email');

        $message .= "Имя: " . $requestor_name . "\n\n ". "Email : " . $requestor_email . " \n\n " . "Сайт : " . $website . " \n\n " . "Тема : " . $subject . " \n\n" . "Комментарий: \n " . $requestor_comment;

        $headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

        $mail = wp_mail($receiver_email, $subject, $message, $headers);


        if( $mail ) {
            echo json_encode(array('request'=>true,'message'=>'Сообщение отправлено', 'id'=>''));
        } else {
            echo json_encode(array('request'=>false,'message'=>'Повторите попытку позже', 'id'=>''));
        }

        die();

    }

}

?>