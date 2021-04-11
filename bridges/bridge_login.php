<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');

global $user_repository;  // Sets user repository globally so it can be used in functions 
$user_repository = new UserRepository();  // Creates a new user_repository object to used


// call user repo and get user by email and verify password
function try_login(): string 
{
  global $user_repository;

  $user_email = ...;   // TODO: fetch email from _POST
  $user_pass = ...;    // TODO: fetch pass from _POST
  $user = ...;         // TODO: Call user repository and get user domain object using the email provided

  if(...) // TODO: if no user was returned from repository or $user.get_password() != $user_pass
  {
      return "Either password or email was invalid"; // Return error message
  }
  
  if(...) // TODO: Check if user is active 
  {

  }

  session_start();
  $_SESSION['user_id'] = ... // TODO: Set user session by user_id to ensure user stays logged in

  return ""; // Return empty error message
}

// redirect function
function redirect(string $endpoint)
{
  // TODO: Rewrite and user string interpolation ie back quotes ``  to redirect to endpoiont
  // ie "Location: $someEndpointVar"
  header("Location: ..."); 
  exit();
}


// ------------------- Main flow -------------------------------

$error = try_login();
if(...) // TODO: if error is not empty ie $errorMessage != ""
{
  redirect("/login/error");
}
redirect(...); // TODO: Redirect to user page


