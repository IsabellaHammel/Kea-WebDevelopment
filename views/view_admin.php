<?php
// Calls bridge admin bridge to get users - consider
// Show all users in table (firstname, lastname, email, phone, is_active)

require_once(__DIR__.'/../bridges/bridge_user.php'); // Requires user bridge to allow us to call functions from that php file


ensure_user_logged_in();
$user = get_logged_in_user(); // call function from bridge_user.php exposed by require_once
?>
<?php
if($user != null){
?>
  <div class='user'>
    <div><b>Firstname:</b> <?= $user->get_firstname() ?></div>
    <div><b>Lastname:</b> <?= $user->get_lastname() ?></div>
    <div><b>Age:</b> <?= $user->get_age() ?></div>
    <div><b>Phone:</b> <?= $user->get_phone() ?></div>
    <div><b>Email:</b> <?= $user->get_email() ?></div>
    <br><br>
  
    <form action= '/deactivate' method="POST">
        <button>Deactivate Account</button> 
    </form>
  </div>
<?php
}
?>