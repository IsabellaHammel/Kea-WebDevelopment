<?php
require_once(__DIR__.'/../bridges/bridge_user.php'); // Requires user bridge to allow us to call functions from that php file
try_start_session();

// validate everything you can come up with
if(!isset($user_id)){
    header('Location: /search');
    exit();
}
if(!ctype_alnum($user_id)) 
{
  header('Location: /search');
  exit();
}

$user = get_user($user_id);

if($user == null)
{
  header('Location: /search');
  exit();
}
?>
 <div class="user">
    <div><b>Firstname:</b> <?= $user->get_firstname() ?></div>
    <div><b>Lastname:</b> <?= $user->get_lastname() ?></div>
    <div><b>Age:</b> <?= $user->get_age() ?></div>
    <div><b>Phone:</b> <?= $user->get_phone() ?></div>
    <div><b>Email:</b> <?= $user->get_email() ?></div>
 </div>