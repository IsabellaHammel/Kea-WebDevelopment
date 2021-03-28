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