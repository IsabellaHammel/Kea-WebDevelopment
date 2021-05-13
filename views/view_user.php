<?php
require_once(__DIR__.'/../bridges/bridge_user.php'); // Requires user bridge to allow us to call functions from that php file
try_start_session();

// validate everything you can come up with
if(!isset($user_id)){
    header('Location: /');
    exit();
}
if(!ctype_alnum($user_id)) // check contains only letter or digits
{
  header('Location: /');
  exit();
}

$user = get_user($user_id);

if($user == null || !$user->get_is_active())
{
  header('Location: /');
  exit();
}
?>
<p id="user_id" style="display: none;" value="<?= $user->get_id()?>"></p>
  <h1><?=$user->get_fullname()?></h1>
  <div class="user">
    <div><img class="profile-image" src="../<?= $user->get_profile_image()?>" alt="profile image"></div>
    <div><b>Age:</b> <?= $user->get_age_str() ?></div>
    <div><b>Phone:</b> <?= $user->get_phone() ?></div>
    <div><b>Email:</b> <?= $user->get_email() ?></div>

  </div>

 <div class="container" id="user_posts_section">
    <h2>Posts</h2>
    <div class="container" id="posts">
      <!--Javascript populates this section-->
    </div>    
  </div>
 <script src="../../js/user.js"></script>