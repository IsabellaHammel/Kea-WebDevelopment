<?php

// TODO form with password and confirm password --> 
// post to /restore with token inside (javascript call to get token out) ?????????
// frontend valdiate password match confirm pass  + length
require_once(__DIR__.'/../bridges/bridge_user.php'); // Requires user bridge to allow us to call functions from that php file

?>

<div class="container">
    <form action="">
        <div class="mb-2">
            <label for="floatingPassword">Password</label>
            <input type="password" name="user_password" id="floatingPassword" class="form-control" placeholder="Password">
        </div>
        <div class="mb-2">
            <label for="floatingConfirmPassword">Confirm password</label>
            <input type="password" name="user_confirm_password" id="floatingConfirmPassword" class="form-control" placeholder="Confirm password">
        </div>
        <div class="mb-2">
            <button type="submit" class="btn btn-primary mb-3">Reset password</button>
        </div>
    </form>
</div>
<script src="./js/myprofile.js"></script>