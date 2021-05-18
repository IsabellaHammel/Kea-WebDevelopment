<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/entities/user.php');
require_once(__DIR__.'/../services/MailService.php');
require_once(__DIR__.'/../services/ImageService.php');
require_once(__DIR__.'/../utilities/utilities.php');


global $error; // Needed to access error on line 100

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

function validateEmail(){
    $email = $_POST['user_email'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        appendError('Invalid Email');
    }
}

function validateUserNotExist(){
    $user_repository = new UserRepository();
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

function createUser(){
    $user_repository = new UserRepository();
    $imageService = new ImageService();

    $hash_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
    $verify_token = uniqid();

    $imagePath = $imageService->save_image($_FILES['user_profile_image']['tmp_name']);

    $user = new User(
        firstname: $_POST['user_first_name'],
        lastname: $_POST['user_last_name'],
        age: new DateTime($_POST['user_age']),
        phone: $_POST['user_phone'],
        email: $_POST['user_email'],
        password: $hash_password,
        verify_token: $verify_token,
        profile_image: $imagePath
    );
    $user_repository->create_user($user);
    send_verification_mail($user);
}

// ---------------- VALIDATE FORM INPUT AND USER

validateName();

validateEmail();

validateUserNotExist();

validatePassword();


if($error != null)
{
    showErrorMessage($error);
}
else 
{
    try 
    {
        createUser();  // Try create a user if no errors
    } 
    catch (Exception $e) 
    {
        showErrorMessage($e->getMessage()); // Failed to create user
    }
}

redirect('/login');

