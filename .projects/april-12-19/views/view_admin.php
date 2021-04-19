<?php
session_start();
if(!isset($_SESSION['user_uuid'])){
    header('Location: /login');
    exit();
}

$user_id = $_GET['id'];

try{
  $db_path = $_SERVER['DOCUMENT_ROOT'].'/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare('SELECT * FROM users WHERE user_uuid = :user_uuid');
  $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
  $q->execute();
  $user = $q->fetch();
  if(!$user){
    header('Location: /login');
    exit();
  }
  ?>
  <div>Hi <?= $user['user_name'] ?> <?= $user['user_last_name']?></div>
  <form action="/deactivate" method="POST">
    <button>deactivate account</button>
  </form>
  <?php
}catch(PDOException $ex){
  echo $ex;
}