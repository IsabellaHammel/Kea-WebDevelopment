<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');
require_once(__DIR__.'/../services/MailService.php');

global $user_repository;
global $error; // Needed to access error on line 100

$user_repository = new UserRepository();
$error = null;

function appendError($message){
    global $error;
   
    if($error == null){
        $error = $message;
        return;
    }
    $error = $error . ' | ' . $message;
}

function validateName(){
    $first_name = $_POST['user_first_name'];
    $last_name = $_POST['user_last_name'];
    $minLength = 2;
    $maxLength = 20;

    $isFirstNameValid = isLengthValid($first_name, $minLength, $maxLength); // input, min, max
    $isLastNameValid = isLengthValid($last_name, $minLength, $maxLength); // input, min, max

    if(!$isFirstNameValid){
        appendError("First name must be between $minLength and $maxLength");
    }
    if(!$isLastNameValid){
        appendError("Last name must be between $minLength and $maxLength");
    }
}

function validateAge(){
    $age = $_POST['user_age'];

    if($age < 1){
        appendError("Age must be greater than zero");
    }
}

function validatePhone(){
    $phone = trim($_POST['user_phone']);
    
    $requiredLength = 8;
    if(strlen($phone) != $requiredLength){
        appendError("Phone must contain $requiredLength digits");
    }
    
    if(strlen($phone) > 0)
    {
        $pattern = '/\D+/i'; // \D is non digit - "+" is one or more - i is non case sensitive search
        $nonDigitMatch = preg_match($pattern, $phone); // regex matches all non digits
        
        if($nonDigitMatch > 0 || $phone[0] == '0'){
            appendError('Phone is invalid');
        }
    }
}

function validateEmail(){
    $email = $_POST['user_email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        appendError('Invalid Email');
    }
}

function validateUserNotExist(){
    global $user_repository;
    $email = $_POST['user_email'];
    $user = $user_repository->get_user_by_email($email);
    $is_exists = $user != null;
    if($is_exists){
        appendError('User already exists');
    }
}

function validatePassword(){
    $password =  $_POST['user_password'];
    $confirmPassword =  $_POST['user_confirm_password'];
    $minLength = 8;
    $maxLength = 50;

    $isLengthValid = isLengthValid($password, $minLength, $maxLength); // input, min, max
    $isConfirmValid = $password == $confirmPassword;

    if(!$isLengthValid){
        appendError("Password must be between $minLength and $maxLength characters");
    }
    
    if(!$isConfirmValid){
        appendError("Confirm-password does not match with password");
    }
}

function isLengthValid($input, $min, $max){
    $inputLength = strlen($input);
    $isLengthWithinRange = $inputLength >= $min && $inputLength <= $max; 
    return $isLengthWithinRange;
}

function showErrorMessage($error_message){
    redirect("/signup/error/$error_message");
}

function redirect($endpoint){
    header('Location: ' . $endpoint);
    exit();
}

function createUser(){
    global $user_repository;
    $hash_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);

    $verify_token = uniqid();

    $user = new User(
        null,
        $_POST['user_first_name'],
        $_POST['user_last_name'],
        $_POST['user_age'],
        $_POST['user_phone'],
        $_POST['user_email'],
        $hash_password,
        null,
        false,
        $verify_token
    );
    $user_repository->create_user($user);
    send_verification_mail($verify_token);
}

function send_verification_mail($token){
    $mail_service = new MailService();
    $user_email = $_POST['user_email'];
    $fullname = "{$_POST['user_first_name']} {$_POST['user_last_name']}";
    $verify_link = $_SERVER['SERVER_NAME'] . '/verify/' . $token;
    $subject = "KEA test - Please verify your account";
    
    $message = " <div> <b>Hello {$fullname}</b> </div> 
    <div> Please verify your account by pressing this <a href='$verify_link'>link</a> </div>
    <div> Kind Regards </div>
    <div> - Kea Test </div>";

    $mail_service->sendMail($message, $subject, $user_email);
}

// ---------------- VALIDATE FORM INPUT AND USER

validateName();

validateAge();

validatePhone();

validateEmail();

validateUserNotExist();

validatePassword();

if($error != null){
    showErrorMessage($error);
}
else {
    try {

        createUser();  // Try create a user if no errors

    } catch (Exception $e) {
        showErrorMessage($e->getMessage()); // Failed to create user
    }
}

redirect('/login');

