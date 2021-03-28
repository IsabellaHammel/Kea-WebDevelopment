<?php
// TODO: validate user_email
// TODO: validate user_password
require_once(__DIR__.'/../db.php');

try{
  // echo $_POST['user_email'];
  // echo $_POST['user_password'];
  // INSECURE, NEVER DO IT LIKE THIS
  // $q = $db->prepare("SELECT * FROM users WHERE email = '{$_POST['user_email']}'");
  $q = $db->prepare('SELECT * FROM users WHERE email = :email');
  $q->bindValue(':email', $_POST['user_email']);
  $q->execute();
  $user = $q->fetchAll();
  // if the email is not in the db we get []
  // if the email is in the db we get [{"id":"1","email":"a@a.com"}]
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


