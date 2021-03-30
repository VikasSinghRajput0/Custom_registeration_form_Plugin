<?php
/*
  Plugin Name: WordPress Registration Form
  Description: Custom registration form using shortcode 
  Version: 1.x
  Author: VIKAS
*/
function wordpress_custom_registration_form


( $first_name, $last_name, $username, $password, $email) 



{
 
    global $username, $password, $email, $first_name, $last_name;
   echo '

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Bootstrap Simple Registration Form</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
    color: ;
    background: lightcyan;
    font-family: , sans-serif;
}
.abc{

color:red;

}
.form-control {
    height: 40px;
    box-shadow: none;
    color: #969fa4;
}
.form-control:focus {
    border-color: #5cb85c;
}
.form-control, .btn {        
    border-radius: 3px;
}
.signup-form {
    width: 450px;
    margin: 0 auto;
    padding: 30px 0;
    font-size: 15px;
}
.signup-form h2 {
    color: #ff2d00;
    margin: 0 0 15px;
    position: relative;
    text-align: center;
}
.signup-form h2:before, .signup-form h2:after {
    content: "";
    height: 2px;
    width: 30%;
    background: #d4d4d4;
    position: absolute;
    top: 50%;
    z-index: 2;
}   
.signup-form h2:before {
    left: 0;
}
.signup-form h2:after {
    right: 0;
}
.signup-form .hint-text {
    color: #999;
    margin-bottom: 30px;
    text-align: center;
}
.signup-form form {
    color: #999;
    border-radius: 3px;
    margin-bottom: 15px;
    background: #0e1015;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.signup-form .form-group {
    margin-bottom: 20px;
}
.signup-form input[type="checkbox"] {
    margin-top: 3px;
}
.signup-form .btn {        
    font-size: 16px;
    font-weight: bold;      
    min-width: 140px;
    outline: none !important;
}
.signup-form .row div:first-child {
    padding-right: 10px;
}
.signup-form .row div:last-child {
    padding-left: 10px;
}       
.signup-form a {
    color: #fff;
    text-decoration: underline;
}
.signup-form a:hover {
    text-decoration: none;
}
.signup-form form a {
    color: #5cb85c;
    text-decoration: none;
}   
.signup-form form a:hover {
    text-decoration: underline;
}  
</style>
</head>
<body>
<div class="signup-form">
   <form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
        <h2 class="abc" >Register</h2>
        <p class="hint-text">Create your account. Its free and only takes a minute.</p>
        <div class="form-group">
            <div class="row">
                <div class="col"><input type="text" class="form-control" name="fname" placeholder="First Name" required="required"></div>
                

                <div class="col"><input type="text" class="form-control"  name="lname"   placeholder="Last Name" required="required"></div>
            </div>          
        </div>
       


        <div class="form-group">
            <input type="text" class="form-control" class="form-control"  name="username"  placeholder="User name"  required="required">
        </div>
        
        

        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required="required">
        </div>
              
      

       <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Email" required="required">
        </div> 
        

        <div class="form-group">
            <input type="submit" name="submit" value="Register"/>
            <input type="reset" value="Reset">
        </div>
    </form>

    
</div>
</body>
</html>

</div> ';

}
function wp_reg_form_valid( $username, $password, $email)  {
    global $customize_error_validation;
    $customize_error_validation = new WP_Error;
    if ( empty( $username ) || empty( $password ) || empty( $email ) ) {
        $customize_error_validation->add('field', ' Please Fill the filed of WordPress registration form');
    }
    if ( username_exists( $username ) )
        $customize_error_validation->add('user_name', ' User Already Exist');
    if ( is_wp_error( $customize_error_validation ) ) {
        foreach ( $customize_error_validation->get_error_messages() as $error ) {
        	echo '<strong>Hold</strong>:';
        	echo $error . '<br/>';
        }
    }
}
 
function wordpress_user_registration_form_completion() {
    global $customize_error_validation, $username, $password, $email, $first_name, $last_name;
 
    if ( 1 > count( $customize_error_validation->get_error_messages() ) ) {
        $userdata = array(
        	'first_name'	=>   $first_name,
        	'last_name' 	=>   $last_name,
        	'user_login'	=>   $username,
        	'user_email'	=>   $email,
        	'user_pass' 	=>   $password,
 
        );

        $user = wp_insert_user( $userdata );
        echo 'Complete WordPress Registration. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';
    }
}
function wordpress_custom_registration_form_function() {
    global $first_name, $last_name,$username, $password, $email ;
    if ( isset($_POST['submit'] ) ) {
        wp_reg_form_valid(
        	$_POST['username'],
        	$_POST['password'],
        	$_POST['email'],
        	$_POST['fname'],
        	$_POST['lname']
       );
 
        $username   =   sanitize_user( $_POST['username'] );
        $password   =   esc_attr( $_POST['password'] );
        $email  	=   sanitize_email( $_POST['email'] );
        $first_name =   sanitize_text_field( $_POST['fname'] );
        $last_name  =   sanitize_text_field( $_POST['lname'] );
    
       wordpress_user_registration_form_completion(
        	$username,
        	$password,
        	$email,
        	$first_name,
        	$last_name
        );
    }
    wordpress_custom_registration_form(
        $username,
        $password,
        $email,
        $first_name,
        $last_name
    );
}
 
add_shortcode( 'wp_registration_form', 'wp_custom_shortcode_registration' );
 
function wp_custom_shortcode_registration() {
    ob_start();
    wordpress_custom_registration_form_function();
    return ob_get_clean();
}

?>