<?php
$user_id = $_GET['id'];

try{
  $db_path = $_SERVER['DOCUMENT_ROOT'].'/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare('SELECT * FROM users WHERE user_email = :email AND user_password = :password');
  $q->bindValue(':email', $_POST['login_user_email']);
  $q->bindValue(':password', $_POST['login_user_password']);
  $q->execute();
}catch(PDOException $ex){
  echo $ex;
}