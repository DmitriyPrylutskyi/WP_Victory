<?php
/// Register function

if( wp_doing_ajax() ){
	add_action( 'wp_ajax_nopriv_victory_register_form', 'victory_register_form' );
	add_action( 'wp_ajax_victory_register_form', 'victory_register_form' );
}

if( !function_exists('victory_register_form') ) {

    function victory_register_form(){

        $allowed_html   =   array();
        $last_name    =   trim( wp_kses ($_POST['last_name'],$allowed_html ));
        $first_name   =   trim( wp_kses ($_POST['first_name'],$allowed_html ));
        $patronymic   =   trim( wp_kses ($_POST['patronymic'],$allowed_html ));
        $email   			=   trim( wp_kses ($_POST['email'],$allowed_html ));
        $phone   			=   trim( wp_kses ($_POST['phone'],$allowed_html ));
        $password   	=   trim( wp_kses ($_POST['password'],$allowed_html ));
        $rpassword   	=   trim( wp_kses ($_POST['rpassword'],$allowed_html ));

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


        $user_id     =   username_exists( $user_name );

        if ($user_id){
            echo json_encode(array('register'=>false,'message'=>'Username already exists.  Please choose a new one.!', 'id'=>'last_name'));
            exit();
        }

        $password        =   trim( sanitize_text_field(wp_kses( $_POST['password'] ,$allowed_html) ) );
        $rpassword       =   trim( sanitize_text_field(wp_kses( $_POST['rpassword'] ,$allowed_html) ) );

        if ($password=='' || $rpassword=='' ){
            echo json_encode(array('register'=>false,'message'=>'One of the password field is empty!', 'id'=>'password'));
            exit();
        }

        if ($password !== $rpassword ){
            echo json_encode(array('register'=>false,'message'=>'Passwords do not match!', 'id'=>'password'));
            exit();
        }

        if ( !$user_id and email_exists($email) == false ) {

            $user_id = wp_create_user( $user_name, $password, $email, $phone );

            echo json_encode(array('register'=>true,'message'=>'Success'));

            exit();

        } else {
            echo json_encode(array('register'=>false,'message'=>'Email already exists.  Please choose a new one!', 'id'=>'email'));
        }
        die();

    }

}

?>