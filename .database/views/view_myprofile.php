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
    <div><img class="profile-image" src="<?= $user->get_profile_image()?>" alt="profile image"></div>
    <div><b>Firstname:</b> <?= $user->get_firstname() ?></div>
    <div><b>Lastname:</b> <?= $user->get_lastname() ?></div>
    <div><b>Age:</b> <?= $user->get_age_str() ?></div>
    <div><b>Phone:</b> <?= $user->get_phone() ?></div>
    <div><b>Email:</b> <?= $user->get_email() ?></div>
  </div>

  <button type="button" id="toggle_update_btn" class="toggle-update btn btn-info" onclick="toggle_update()">Update info</button>

  <div class="container user-update hide">
    <form id="update-user-form" class="row form-floating" enctype="multipart/form-data" onsubmit="return update_user();  return false;" >
      <div class="mb-2">
        <label for="user_profile_image">Profile picture</label>
        <input type="file" name="user_profile_image" class="form-control-file" id="user_profile_image">
      </div>
      <div class="mb-2">
        <label for="floatingAge">Age</label>
        <input required type="date" name="user_age" id="floatingAge" value="<?= $user->get_age_str() ?>">
      </div>
      <div class="mb-2">
        <label for="floatingFirstname">Firstname</label>
        <input required type="text" name="user_first_name" id="floatingFirstname" class="form-control" value= "<?= $user->get_firstname() ?>">
      </div>
      <div class="mb-2">
        <label for="floatingLastname">Lastname</label>
        <input required type="text" name="user_last_name" id="floatingLastname" class="form-control" value= "<?= $user->get_lastname()?>">
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
  <div class="container" id="user_posts_section">
    <h2>Your Posts</h2>
    <div class="container" id="posts">
      <!--Javascript populates this section-->
    </div>
    <form id="create-post-form" class="row form-floating" onsubmit="create_post(); return false;">
      <!-- TODO CREATE POST FORM TEXT AREA TO WRITE NEW POSTS -->
      <textarea name="post_content" id="post_content_text_area" cols="30" rows="10"></textarea>
      <button type="submit" class="btn btn-success">Create post</button>
    </form>
  </div>
</div>


<script src="./js/myprofile.js"></script> 
<?php
}else{
  header("Location: /");
}
?>