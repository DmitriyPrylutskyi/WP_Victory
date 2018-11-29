<?php
/// Register function

if( wp_doing_ajax() ){
	add_action( 'wp_ajax_nopriv_victory_register_form', 'victory_register_form' );
	add_action( 'wp_ajax_victory_register_form', 'victory_register_form' );
}

if( !function_exists('victory_register_form') ) {

    function victory_register_form(){

        $allowed_html =   array();
        $last_name    =   trim( wp_kses ($_POST['last_name'],$allowed_html ));
        $first_name   =   trim( wp_kses ($_POST['first_name'],$allowed_html ));
        $patronymic   =   trim( wp_kses ($_POST['patronymic'],$allowed_html ));
        $email   			=   trim( wp_kses ($_POST['email'],$allowed_html ));
        $phone   			=   trim( wp_kses ($_POST['phone'],$allowed_html ));
        $password     =   trim( wp_kses( $_POST['password'] ,$allowed_html) );
        $rpassword    =   trim( wp_kses( $_POST['rpassword'] ,$allowed_html) );

        if( !verify_onetime_nonce($_POST['nonce'], 'register_nonce') ){
            echo json_encode(array('register'=>false, 'message'=>'You are not submiting from site or you have too many atempts!'));
            exit();
        }

        $user_name		= 	$last_name . ' ' . $first_name . ' ' . $patronymic;

        if (preg_match("/^[0-9A-Za-z_]+$/", $last_name) == 0) {
            echo json_encode(array('register'=>false,'message'=>'Invalid username (do not use special characters or spaces)!', 'id'=>'last_name'));
            die();
        }

        if (preg_match("/^[0-9A-Za-z_]+$/", $first_name) == 0) {
            echo json_encode(array('register'=>false,'message'=>'Invalid username (do not use special characters or spaces)!', 'id'=>'first_name'));
            die();
        }

        if (preg_match("/^[0-9A-Za-z_]+$/", $patronymic) == 0) {
            echo json_encode(array('register'=>false,'message'=>'Invalid username (do not use special characters or spaces)!', 'id'=>'patronymic'));
            die();
        }

        if ($email==''){
            echo json_encode(array('register'=>false,'message'=>'Email field is empty!', 'id'=>'email'));
            exit();
        }

        if ($user_name==''){
            echo json_encode(array('register'=>false,'message'=>'Username field is empty!', 'id'=>'last_name'));
            exit();
        }

        if ($phone==''){
            echo json_encode(array('register'=>false,'message'=>'Phone field is empty!', 'id'=>'phone'));
            exit();
        }

        if(filter_var($email,FvictoryILTER_VALIDATE_EMAIL) === false) {
            echo json_encode(array('register'=>false,'message'=>'The email doesn\'t look right!', 'id'=>'email'));
            exit();
        }

        $domain = substr(strrchr($email, "@"), 1);
        if( !checkdnsrr ($domain) ){
            echo json_encode(array('register'=>false,'message'=>'The email\'s domain doesn\'t look right!', 'id'=>'email'));
            exit();
        }

        if ($password=='' || $rpassword=='' ){
            echo json_encode(array('register'=>false,'message'=>'One of the password field is empty!', 'id'=>'password'));
            exit();
        }

        if ($password !== $rpassword ){
            echo json_encode(array('register'=>false,'message'=>'Passwords do not match!', 'id'=>'password'));
            exit();
        }

        $user = get_users(array('meta_key' => 'phone', 'meta_value' => $phone));
        if ( !$user ) {

            $user_id = wp_create_user( $user_name, $password, $email );

            update_user_meta($user_id, 'first_name', $first_name);
            update_user_meta($user_id, 'last_name', $last_name);
            update_user_meta($user_id, 'patronymic', $patronymic);
            update_user_meta($user_id, 'phone', $phone);

            echo json_encode(array('register'=>true,'message'=>'Auth successful, redirecting...'));

            exit();

        } else {
            echo json_encode(array('register'=>false,'message'=>'Phone already exists.  Please choose a new one!', 'id'=>'email'));
        }
        die();

    }

}

/// Login function

if( wp_doing_ajax() ){
	add_action( 'wp_ajax_nopriv_victory_login_form', 'victory_login_form' );
	add_action( 'wp_ajax_victory_login_form', 'victory_login_form' );
}

if( !function_exists('victory_login_form') ) {

    function victory_login_form(){

        $allowed_html =   array();
        $phone   			=   trim( wp_kses ($_POST['phone'],$allowed_html ));
        $password     =   trim( wp_kses( $_POST['password'] ,$allowed_html)  );

        if( !verify_onetime_nonce($_POST['nonce'], 'login_nonce') ){
            echo json_encode(array('login'=>false, 'message'=>'You are not submiting from site or you have too many atempts!'));
            exit();
        }

        $user = get_users(array('meta_key' => 'phone', 'meta_value' => $phone));

        $user_name = $user[0]->data->user_login;

        if ($phone==''){
            echo json_encode(array('login'=>false,'message'=>'Phone field is empty!', 'id'=>'phone'));
            exit();
        }

        if ($password=='' ){
            echo json_encode(array('login'=>false,'message'=>'One of the password field is empty!', 'id'=>'password'));
            exit();
        }

        wp_clear_auth_cookie();

        $info                   = array();
        $info['user_login']     = $user_name;
        $info['user_password']  = $password;
        $info['remember'] 			= true;
        $user_signon            = wp_signon( $info, true );

        if ( is_wp_error($user_signon) ){
            echo json_encode(array('login'=>false, 'message'=>'Wrong username or password!', 'id'=>'phone'));
        } else {
            wp_set_auth_cookie($user_signon->ID);
            echo json_encode(array('login'=>true, 'message'=>'Auth successful, redirecting...'));
        }

        die();

    }

}

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
            print('You are not submiting from site or you have too many atempts!');
            exit();
        }

        $allowed_html   =   array();
        $firstname      =   sanitize_text_field ( wp_kses( $_POST['firstname'] ,$allowed_html) );
        $lastname     	=   sanitize_text_field ( wp_kses( $_POST['lastname'] ,$allowed_html)) ;
        $patronymic     =   sanitize_text_field ( wp_kses( $_POST['patronymic'] ,$allowed_html)) ;
        $email      		=   sanitize_text_field ( wp_kses( $_POST['useremail'] ,$allowed_html) );
        $phone      		=   sanitize_text_field ( wp_kses( $_POST['userphone'] ,$allowed_html) );
        $birthday     	=   sanitize_text_field ( wp_kses( $_POST['userbirthday'] ,$allowed_html) );
        $city      			=   sanitize_text_field ( wp_kses( $_POST['usercity'] ,$allowed_html) );
        $gender      		=   sanitize_text_field ( wp_kses( $_POST['gender'] ,$allowed_html) );

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
                print ('The phone field cannot be blank. ');
                exit();
						} else if($email==''){
                print ('The email field cannot be blank. ');
                exit();
            } else if(filter_var($email,FILTER_VALIDATE_EMAIL) === false) {
                print ( 'The email doesn\'t look right !');
                exit();
            } else if($gender=='') {
                print ( 'The gender field cannot be blank.');
                exit();
            }
            else{
                $args = array(
                    'ID'         => $userID,
                    'user_email' => $email,
                    'first_name' => $firstname,
                    'last_name'  => $lastname,
                    'patronymic' => $patronymic,
                    'phone'			 => $phone,
                    'birthday'	 => $birthday,
                    'city'			 => $city,
                    'gender'		 => $gender
                );

                wp_update_user( $args );
				        print ('Profile updated');
				        die();
            }
        }

        print ('The phone was not saved because it is used by another user. ');

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
            print('You are not submiting from site or you have too many atempts!');
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
        print ('Passport updated');


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
            print ('You are not submiting from site or you have too many atempts!');
            exit();
        }

        $oldpass        =   sanitize_text_field ( wp_kses( $_POST['oldpass'] ,$allowed_html) );
        $newpass        =   sanitize_text_field ( wp_kses( $_POST['newpass'] ,$allowed_html) );
        $renewpass      =   sanitize_text_field ( wp_kses( $_POST['renewpass'] ,$allowed_html) );

        if($newpass=='' || $renewpass=='' ){
            print ('The new password is blank');
            die();
        }

        if($newpass != $renewpass){
            print ('Passwords do not match');
            die();
        }

        $user = get_user_by( 'id', $userID );
        if ( $user && wp_check_password( $oldpass, $user->data->user_pass, $user->ID) ){
            wp_set_password( $newpass, $user->ID );
            print ('Password Updated - You will need to logout and login again ');
        }else{
            print ('Old Password is not correct');
        }

        die();
    }
endif; // end   wpestate_ajax_update_pass

/// Ajax Update Doc function

add_action( 'wp_ajax_nopriv_victory_ajax_update_doc', 'victory_ajax_update_doc' );
add_action( 'wp_ajax_victory_ajax_update_doc', 'victory_ajax_update_doc' );

if( !function_exists('victory_ajax_update_doc') ):
    function victory_ajax_update_doc(){
        $current_user   = wp_get_current_user();
        $allowed_html   = array();
        $userID         = $current_user->ID;
        //$images         = get_the_author_meta( 'images', $userID );

        if ( !is_user_logged_in() ) {
            exit('ko');
        }
        if($userID === 0 ){
            exit('out pls');
        }

        if( !verify_onetime_nonce($_POST['nonce'], 'doc_nonce') ){
            print ('You are not submiting from site or you have too many atempts!');
            exit();
        }

        $imageurl = $_POST['images'];

        if($imageurl=='' ){
          $images = "";
        } else {
        	$images = serialize($imageurl);
      	}

        update_user_meta( $userID, 'images', $images);

        print ('Doc Updated');

        die();
    }
endif; // end   wpestate_ajax_update_pass

?>