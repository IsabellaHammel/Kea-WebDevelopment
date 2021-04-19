<?php
session_start();

if( ! isset( $_SESSION['user_uuid'] ) ){
  header('Location: /login');
  exit();  
}


try{
  $db_path = $_SERVER['DOCUMENT_ROOT'].'/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare(' UPDATE users 
                      SET user_active = :user_active 
                      WHERE user_uuid = :user_uuid ');
  $q->bindValue(':user_active', 0);
  $q->bindValue(':user_uuid', $_SESSION['user_uuid']);
  $q->execute();
  // fetch fetchAll 
  // rowCount works on Update Delete
  if( ! $q->rowCount() ){
      header('Location: /admin');
      exit();
  }

  session_destroy();

}catch(PDOException $ex){
  echo $ex;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

You are unactive
  
</body>
</html>