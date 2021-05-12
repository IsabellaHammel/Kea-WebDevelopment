<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');
require_once(__DIR__.'/../repository/forgot_password_repository.php'); 
require_once(__DIR__.'/../repository/forgot_password.php');
require_once(__DIR__.'/../services/MailService.php');

/*
TODO
- New function CheckRestoreLinkActive
  - get ForgotPassword with get_by_token from repo
  - If active proceed with RestorePassword

  - If CreatedOn is greater than 10 min - Expire link --> update is_active = false
    - Redirect to login
  - If is_active was already false
    - Redirect to login


- New function called RestorePassword()
 - get ForgotPassword by token from json post call or form
 - get user from userID stored in ForgotPassword
 - take posted password and hash password
 - update user with new password "->set_password($hashed_password)"
 - update ForgotPassword is_active = 0

When restored password redirect to login
*/

function check_restore_link_active($token): bool 
{
  $forgot_password_repository = new ForgotPasswordRepository();

  $forgot_password = $forgot_password_repository->get_by_token($token);
  
  if($forgot_password == null)
  {
    $msg = "Invalid link";
    redirect("/restore/error/$msg");
  }

  $minutes_to_add = 10;
  $expire_date = (clone $forgot_password->get_created_on()) -> add(new DateInterval('PT' . $minutes_to_add . 'M')); // https://stackoverflow.com/questions/8169139/adding-minutes-to-date-time-in-php
  $date_now = new DateTime("now", new DateTimeZone("UTC"));
  
  if($date_now > $expire_date )
  {
    $forgot_password == false;
    $forgot_password_repository($forgotpwd_is_active);
    $msg = "Link has expired";
    redirect("/restore/error/$msg");
    // set forgot password isactive to false
    // update forgotpassword in repo
    // redirect to restore/error page showing link has expired
  }

  return true;
}

function restore_password(){
  $user_repository = new UserRepository;
  $email = $_POST['user_email'];
  $user = $user_repository->get_user_by_email($email);
  //json post call
  ForgotPassword()->user_id;
  $hash_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
  $user->set_passwword($hash_password);
  ForgotPassword(is_active = 0);
  redirect("/login");
}

function redirect(string $endpoint)
{
  header("Location: $endpoint"); 
  exit();
}