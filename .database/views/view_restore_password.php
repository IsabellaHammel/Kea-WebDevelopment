<?php

?>
<p id="token" style="display: none;" value="<?= $restore_token ?>"></p>

<div class="container">
    <form id="update-password-form" onsubmit="update_user_password(); return false;">
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
<script src="./../js/restore.js"></script>