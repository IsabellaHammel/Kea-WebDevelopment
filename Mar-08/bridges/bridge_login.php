<?php
// redirect
// connect to the database
// check if there is a match in the email and password
$right_email = 'a@a.com';
$right_password = '12345';
// error redirect to login


// validate password
if(strlen($_POST['user_password']) < 2){
    $error_message = 'Password must be at least 2 characters';
    header("Location: /login/error/$error_message");
    exit();
}

if(strlen($_POST['user_password']) > 5){
    $error_message = 'Password cannot be longer than 5 characters';
    header("Location: /login/error/$error_message");
    exit();
}


// VALIDATE
if(!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)){
    // header('Location: /login/error?message=Invalid Email');
    $error_message = 'Invalid Email';
    header("Location: /login/error/$error_message");
    exit();
}


if($right_email != $_POST['user_email'] || $right_password != $_POST['user_password']){
    // header('Location: /login/error?message=Email not found');
    $error_message = 'Incorrect credentials';
    header("Location: /login/error/$error_message");
    exit();
}


// success show profile
header('Location: /profile');
exit();