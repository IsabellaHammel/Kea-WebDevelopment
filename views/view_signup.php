
<?php

// Include dropdown with schools
// include dropdown with roles - student/teacher


if(isset($display_error)){
?>
    <div>
        error <?= urldecode($display_error) ?>
    </div>
<?php
}
?>
<form action='/signup' method="POST" enctype="multipart/form-data">
        <input name="user_name" type="text" placeholder="name" >
        <br><br>
        <input name="user_email" type="text"  placeholder="email">
        <br><br>
        <input name="user_password" type="password"  placeholder="password">
        <br><br>
        <input name="user_confirm_password" type="password" placeholder="confirm password">
        <br><br>
    <button>signup</button>
</form>
