<?php

session_start();

if( ! isset($_POST['login_user_email']) ){
  header('Location: /login');
  exit();  
}
if( ! isset($_POST['login_user_password']) ){
  header('Location: /login');
  exit();  
}
if( ! filter_var($_POST['login_user_email'], FILTER_VALIDATE_EMAIL) ){
  header('Location: /login');
  exit();  
}
if( strlen($_POST['login_user_password']) < 2 || 
    strlen($_POST['login_user_password']) > 50 ){
  header('Location: /login');
  exit();  
}


try{
  $db_path = $_SERVER['DOCUMENT_ROOT'].'/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare(' SELECT * FROM users 
                      WHERE user_email = :user_email LIMIT 1');
  $q->bindValue(':user_email', $_POST['login_user_email']);
  $q->execute();
  $user = $q->fetch();
  if(! $user ){
    header('Location: /login');
    exit();
  }
  if(! password_verify($_POST['login_user_password'], $user['user_password'])){
    header('Location: /login');
    exit();
  }
  $_SESSION['user_uuid'] = $user['user_uuid'];
  header('Location: /admin');
  exit();
  
}catch(PDOException $ex){
  echo $ex;
}