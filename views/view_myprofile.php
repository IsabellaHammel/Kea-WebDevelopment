<?php
require_once(__DIR__.'/../bridges/bridge_user.php'); // Requires user bridge to allow us to call functions from that php file
$user = get_logged_in_user(); // call function from bridge_user.php exposed by require_once
?>

<?php
if($user != null){
?>
<p id="user_id" style="display: none;" value="<?= $user->get_id()?>"></p> 

<div class='container user-container'>
  <div class="container user-details">
    <div><b>Name:</b> <?= $user->get_name() ?></div>
    <div><b>Email:</b> <?= $user->get_email() ?></div>
  </div>

  <button type="button" id="toggle_update_btn" class="toggle-update btn btn-info" onclick="toggle_update()">Update info</button>

  <div class="container user-update hide">
    <form id="update-user-form" class="row form-floating" enctype="multipart/form-data" onsubmit="return update_user();  return false;" >
      <div class="mb-2">
        <label for="floatingFirstname">Name</label>
        <input required type="text" name="user_first_name" id="floatingFirstname" class="form-control" value= "<?= $user->get_firstname() ?>">
      </div>
      <div class="mb-2">
        <label for="floatingEmail">Email</label>
        <input required type="email" name="user_email" id="floatingEmail" class="form-control" value="<?= $user->get_email() ?>">
      </div>
      <div class="mb-2">
        <label for="floatingPassword">Password</label>
        <input type="password" name="user_password" id="floatingPassword" class="form-control" placeholder="Password">
      </div>
      <div class="mb-2">
        <label for="floatingConfirmPassword">Confirm password</label>
        <input type="password" name="user_confirm_password" id="floatingConfirmPassword" class="form-control" placeholder="Confirm password">
      </div>
      <div class="mb-2">
        <button type="submit" class="btn btn-primary mb-3">Update</button>
      </div>
    </form>
  </div>   
</div>


<script src="./js/myprofile.js"></script> 
<?php
}else{
  header("Location: /");
}
?>