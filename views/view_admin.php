<?php
// Calls bridge admin bridge to get users - consider
// Show all users in table (firstname, lastname, email, phone, is_active)

require_once(__DIR__.'/../bridges/bridge_user.php'); // Requires user bridge to allow us to call functions from that php file

$users = get_all_users(); // calls function from bridge_user.php exposed by require_once
?>
<?php
foreach($users as $user){ // TODO sort by age
?>
  <div class='user'>
    <div><b>ID:</b> <?= $user->get_id() ?></div>
    <div><b>Firstname:</b> <?= $user->get_firstname() ?></div>
    <div><b>Lastname:</b> <?= $user->get_lastname() ?></div>
    <div><b>Age:</b> <?= $user->get_age() ?></div>
    <div><b>Phone:</b> <?= $user->get_phone() ?></div>
    <div><b>Email:</b> <?= $user->get_email() ?></div>
    <div><b>Active status:</b> <?= $user->get_is_active() ?></div>
  </div>
  <br>
<?php
}
?>