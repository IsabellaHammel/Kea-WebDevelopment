<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');
require_once(__DIR__.'/../repository/forgot_password_repository.php'); 
require_once(__DIR__.'/../repository/forgot_password.php');
require_once(__DIR__.'/../services/MailService.php');
require_once(__DIR__.'/../utilities/utilities.php');


function create_forgot_password(){
    $user_repository = new UserRepository();
    $forgot_password_repository = new ForgotPasswordRepository();

    $email = $_POST['user_email'];
    $user = $user_repository->get_user_by_email($email);

    if($user == null){
        $error = "No user was found";
        redirect("/forgotpassword/message/$error");
    }

    $token = uniqid();
    $forgot_password = new ForgotPassword(
        id: null,
        user_id: $user->get_id(), 
        token: $token,
        created_on: new DateTime("now", new DateTimeZone("UTC")),
        is_active: true
    );

    try{
        $forgot_password_repository->create($forgot_password);
        send_mail_forgot_password($user, $forgot_password);
    }
    catch(Exception $e){
        $error = "Failed to complete operation - Try again";
        redirect("/forgotpassword/error/$error");
    }
    $message = "Restore link successfully sent";
    redirect("/forgotpassword/message/$message");
}


function send_mail_forgot_password(User $user, ForgotPassword $forgot_password){
    $mail_service = new MailService();
    $user_email = $user->get_email();
    $verify_link = $_SERVER['SERVER_NAME'] . '/restore/' . $forgot_password->get_token();
    
    $subject = "KEA test - Please reset your password";
    $message = " <div> <b>Hello {$user->get_fullname()}</b> </div> 
    <div> Please reset your password by pressing this <a href='$verify_link'>link</a> </div>
    <div> If you did not request to change your password, please ignore this email </div>
    <div> Kind Regards </div>
    <div> - Kea Test </div>";
  
    $mail_service->sendMail($message, $subject, $user_email);
  }

function alert(string $message){
    echo "<script type='text/javascript'>alert('$message');</script>";
}