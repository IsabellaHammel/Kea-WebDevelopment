<?php
// Calls bridge admin bridge to get users - consider
// Show all users in table (firstname, lastname, email, phone, is_active)

require_once(__DIR__.'/../bridges/bridge_user.php'); // Requires user bridge to allow us to call functions from that php file


$users = get_all_users(); // calls function from bridge_user.php exposed by require_once

foreach($users as $user){ // TODO FILL OUT Infos for each users
  echo "
  <div class='user'>
    <div>Firstname: $user->get_firstname</div>
    <div>Lastname: $user->get_lastname</div>
    <div> ... </div>
  </div>
  ";
}