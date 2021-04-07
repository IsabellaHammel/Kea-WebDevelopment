<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');

// user repo

// call user repo and get user by email and verify password

// set user email in SESSION

// redirect to user page


// TODO: validate user_email
// TODO: validate user_password

try{
  $q = $db->prepare('SELECT user_email, user_password FROM users WHERE email = :email AND user_password = :u_password');
  $q->bindValue(':email', $_POST['user_email']);
  $q->bindValue(':u_password', $_POST['user_password']);
  $q->execute();
  $user = $q->fetchAll();
 
  // The user is not found in the db
  if( count($user) == 0 ){
    header('Location: /login/error');
    exit();
  }
  // The user is found in the db
  session_start();
  $_SESSION['email'] = $_POST['user_email'];
  header('Location: /admin');
  exit();

}catch(PDOException $ex){
  echo $ex;
}
