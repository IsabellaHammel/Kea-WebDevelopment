<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');
require_once(__DIR__.'/../repository/forgot_password_repository.php'); 
require_once(__DIR__.'/../repository/forgot_password.php');
require_once(__DIR__.'/../services/MailService.php');
require_once(__DIR__.'/../utilities/utilities.php');

function check_restore_link_active($token) 
{
  $forgot_password_repository = new ForgotPasswordRepository();

  $forgot_password = $forgot_password_repository->get_by_token($token);
  
  if($forgot_password == null)
  {
    $msg = "Invalid link";
    redirect("/restore/error/$msg");
  }

  if(!$forgot_password->get_is_active())
  {
    $msg = "Link has expired";
    redirect("/restore/error/$msg");
  }

  $minutes_to_add = 10;
  $expire_date = (clone $forgot_password->get_created_on()) -> add(new DateInterval('PT' . $minutes_to_add . 'M')); // https://stackoverflow.com/questions/8169139/adding-minutes-to-date-time-in-php
  $date_now = new DateTime("now", new DateTimeZone("UTC"));
  
  if($date_now > $expire_date)
  {
    $forgot_password->set_is_active(false);
    $forgot_password_repository->update($forgot_password);
    $msg = "Link has expired";
    redirect("/restore/error/$msg");
  }
}



