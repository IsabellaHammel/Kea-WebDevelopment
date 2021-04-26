<?php
// Top
require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_top.php');

    

// Main part of the page
try{
  $db_path = $_SERVER['DOCUMENT_ROOT'].'/db/users.db';
  $db = new PDO("sqlite:$db_path");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $q = $db->prepare('SELECT * FROM users'); // SELECT (user_uuid, ...)
  $q->execute();
  $users = $q->fetchAll();
  echo '<div id="users">';
  foreach($users as $user){
      unset($user['user_password']);
  ?>
    <div class="user">
        <div>ID: <?= $user['user_uuid'] ?></div>
        <div>NAME: <?= $user['user_name'] ?></div>
        <div>LAST NAME: <?= $user['user_last_name'] ?></div>
        <div>EMAIL: <?= $user['user_email'] ?></div>
        <div>PHONE: <?= $user['user_phone'] ?></div>
        <button onclick="delete_user('<?= $user['user_uuid'] ?>')">
            🗑️
        </button>
    </div>
  <?php
  }
  echo '</div>';
}catch(PDOException $ex){
  echo $ex;
}
?>

<script>
async function delete_user(user_id){
    let div_user = event.target.parentNode
    let conn = await fetch (`/users/delete/${user_id}`, {
        "method" : "POST"
    })
    if(! conn.ok){alert("oops..."); return}
    let data = await conn.text()
    console.log(data)
}
div_user.remove()
</script>

<?php
// Bottom
require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_bottom.php');
?>