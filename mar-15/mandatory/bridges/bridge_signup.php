<?php

$error = null;
global $error; // Needed to access error on line 100

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
    setURL("/signup/error/$error_message");
}

function setURL($endpoint){
    header('Location: ' . '/' . $GLOBALS['baseRoute'] . $endpoint);
    exit();
}

validateName();

validatePhone();

validateEmail();

validatePassword();

if($error != null){
    showErrorMessage($error);
}

// success go to login
setURL('/login');

