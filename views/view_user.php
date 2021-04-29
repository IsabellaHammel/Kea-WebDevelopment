<?php

// validate everything you can come up with
if(!isset($user_id)){
    header('Location: /search');
    exit();
}
if(strlen($user_id) != 32){
    header('Location: /search');
    exit();
}
if(!ctype_alnum($user_id)) 
{
  header('Location: /search');
  exit();
}

try{
    $db_path = $_SERVER['DOCUMENT_ROOT'].'/';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // full text search
    $q = $db->prepare(' SELECT user_firstname, user_lastname, user_phone, user_email 
                        FROM users 
                        WHERE user_uuid = :user_uuid 
                        LIMIT 1');
    $q->bindValue(':user_id', $user_id);
    $q->execute();
    $user = $q->fetch();
    ?>
    <div>
      <div><?= $user['user_firstname'] ?></div>
      <div><?= $user['user_lastname'] ?></div>
      <div><?= $user['user_phone'] ?></div>
      <div><?= $user['user_email'] ?></div>
    </div>
    <?php
  }catch(PDOException $ex){
    echo $ex;
  }