<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');
require_once(__DIR__.'/../utilities/utilities.php');


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

  session_start();
  $_SESSION['user_id'] = $user->get_id(); 

  return ""; // Return empty error message
}



// ------------------- Main flow -------------------------------

$error = try_login();
if($error != "") // if error is not empty go error page
{
  redirect("/login/error/$error");
}
redirect("/admin");


