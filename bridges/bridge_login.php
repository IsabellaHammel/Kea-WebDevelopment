<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');

global $user_repository;  // Sets user repository globally so it can be used in functions 
$user_repository = new UserRepository();  // Creates a new user_repository object to used


// call user repo and get user by email and verify password
function try_login(): string 
{
  global $user_repository;

  $user_email = $_POST['user_email'];
  $user_pass = $_POST['user_password'];
  $user = $user_repository->get_user_by_email($user_email);

  if($user == null || ! password_verify($user_pass, $user->get_password())) 
  {
      return "Password or email was invalid"; // Return error message
  }
  
  if(!$user->get_is_active()) // Check if user is active 
  {
    return "User is no longer active";
  }

  if(!$user->get_is_verified())
  {
    return "User is not verified";
  }

  session_start();
  $_SESSION['user_id'] = $user->get_id(); 

  return ""; // Return empty error message
}

// redirect function
function redirect(string $endpoint)
{
  header("Location: $endpoint"); 
  exit();
}



function send_forgot_mail(User $user){
  $mail_service = new MailService();
  $user_email = $user->get_email();
  $verify_link = $_SERVER['SERVER_NAME'] . '/verify/' . $user->get_verify_token(); // TODO Replace get_verify_token() with something else
  
  $subject = "KEA test - Please reset your password";
  $message = " <div> <b>Hello {$user->get_fullname()}</b> </div> 
  <div> Please reset your password by pressing this <a href='$verify_link'>link</a> </div>
  <div> If you did not request to change your password, please ignore this email </div>
  <div> Kind Regards </div>
  <div> - Kea Test </div>"; // TODO change $verify_link

  $mail_service->sendMail($message, $subject, $user_email);
}




// ------------------- Main flow -------------------------------

$error = try_login();
if($error != "") // if error is not empty go error page
{
  redirect("/login/error/$error");
}
redirect("/admin");


