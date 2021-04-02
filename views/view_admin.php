<?php
// Calls bridge admin bridge to get users - consider
// Show all users in table (firstname, lastname, email, phone, is_active)

require_once(__DIR__.'/../db.php');

$q = $db->prepare('SELECT * FROM users');
$q->execute();
$users = $q->fetchAll(); // PDO::FETCH_ASSOC

foreach($users as $user){
  echo "
  <div class='user'>
    <div>ID: $user->id</div>
    <div>EMAIL: $user->email</div>
  </div>
  ";
}


// OR
/* <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
</head>
<body>

  <h1>
    <?php   
      echo "Hi {$_SESSION['email']}";
    ?>
  </h1>

  <a href="/logout">logout</a> */