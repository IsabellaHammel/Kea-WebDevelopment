<?php
if(!isset($_POST['login_user_email'])){
    header('Location: /login');
    exit();
}
if(!isset($_POST['login_user_password'])){
    header('Location: /login');
    exit();
}
if(!filter_var($_POST['login_user_email'], FILTER_VALIDATE_EMAIL)){
    header('Location: /login');
    exit();
}
if(strlen($_POST['login_user_password']) < 2 || strlen($_POST['login_user_password']) > 50){
    header('Location: /login');
    exit();
}

$user_id = $_GET['id'];

try{
  $db_path = $_SERVER['DOCUMENT_ROOT'].'/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare('SELECT * FROM users WHERE user_email = :email AND user_password = :password LIMIT 1');
  $q->bindValue(':email', $_POST['login_user_email']);
  $q->bindValue(':password', $_POST['login_user_password']);
  $q->execute();
  $user = $q->fetch();
  if(!$user){
    header('Location: /login');
    exit();
  }
  session_start();
  $_SESSION['user_uuid'] = $user['user_uuid'];
  header('Location: /admin');
    exit();
}catch(PDOException $ex){
  echo $ex;
}