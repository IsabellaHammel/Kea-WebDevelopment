<?php
// Calls bridge admin bridge to get users - consider
// Show all users in table (firstname, lastname, email, phone, is_active)

require_once(__DIR__.'/../bridges/bridge_user.php'); // Requires user bridge to allow us to call functions from that php file
$user = get_logged_in_user(); // call function from bridge_user.php exposed by require_once
$users = get_all_users(); // calls function from bridge_user.php exposed by require_once
?>
<?php
foreach($users as $user)
{ 
  if($user->get_is_admin())
  {
    continue;
  }
?>
  <div class="pt-3"><b>Users</b></div>
  <div class='user'>
    <div><b>ID:</b> <?= $user->get_id() ?></div>
    <div><b>Firstname:</b> <?= $user->get_firstname() ?></div>
    <div><b>Lastname:</b> <?= $user->get_lastname() ?></div>
    <div><b>Age:</b> <?= $user->get_age_str() ?></div>
    <div><b>Phone:</b> <?= $user->get_phone() ?></div>
    <div><b>Email:</b> <?= $user->get_email() ?></div>
    <div><b>Active status:</b> <?= $user->get_is_active() ?></div>
  </div>
  <?php
  if($user->get_is_active())
  {
  ?>
    <form class="pt-2" onsubmit="return false"> 
      <button type="submit" onclick="deactivate_user(<?= $user->get_id() ?>)" class="btn btn-danger">Deactivate user account</button> 
    </form>
    <?php
  }
  else
  {
    ?>
    <form class="pt-2" onsubmit="return false">
      <button type="submit" onclick="activate_user(<?= $user->get_id() ?>)" class="btn btn-success">Activate user account</button> 
    </form>
    <?php
  }
  ?>
<?php
}
?>
<script src="./js/admin.js"></script>
<script src="./js/myprofile.js"></script> 
