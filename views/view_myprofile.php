<?php
// Calls bridge admin bridge to get users - consider
// Show all users in table (firstname, lastname, email, phone, is_active)

require_once(__DIR__.'/../bridges/bridge_user.php'); // Requires user bridge to allow us to call functions from that php file


$user = get_logged_in_user(); // call function from bridge_user.php exposed by require_once
?>
<?php
if($user != null){
?>
  <div class='container user-container'>
    <div class="container user-details">
      <div><b>Firstname:</b> <?= $user->get_firstname() ?></div>
      <div><b>Lastname:</b> <?= $user->get_lastname() ?></div>
      <div><b>Age:</b> <?= $user->get_age() ?></div>
      <div><b>Phone:</b> <?= $user->get_phone() ?></div>
      <div><b>Email:</b> <?= $user->get_email() ?></div>
    </div>

    <button type="button" id="toggle_update_btn" class="toggle-update btn btn-info" onclick="toggle_update()">Update info</button>

    <div class="container user-update hide">
      <form id="update-user-form" class="row form-floating" onsubmit="return update_user()">
        <div class="mb-2">
          <label for="floatingFirstname">Firstname</label>
          <input required type="text" name="user_first_name" id="floatingFirstname" class="form-control" value= "<?= $user->get_firstname() ?>">
        </div>
        <div class="mb-2">
          <label for="floatingLastname">Lastname</label>
          <input required type="text" name="user_last_name" id="floatingLastname" class="form-control" value= "<?= $user->get_lastname()?>">
        </div>
        <div class="mb-2">
          <label for="floatingAge">Age</label>
          <input required type="text" name="user_age" id="floatingAge" class="form-control" value="<?= $user->get_age() ?>">
        </div>
        <div class="mb-2">
          <label for="floatingPhone">Phone</label>
          <input required type="text" name="user_phone" id="floatingPhone" class="form-control" value="<?= $user->get_phone() ?>">
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
  
    <form action= '/deactivate' method="POST">
        <button type="submit" class="btn btn-danger">Deactivate Account</button> 
    </form>
  </div>
  <script src="./js/myprofile.js"></script> 
<?php
}
?>