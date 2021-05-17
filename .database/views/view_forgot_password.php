<?php
    if(isset($display_message)){
    ?>
        <div>
        <p><?= urldecode($display_message) ?></p>
        </div>
    <?php
    }
?>
<div class="container">
<form id="forgot-pwd-form" class="row form-floating" action='/forgotpassword' method="POST">
  <div class="mb-2">
    <label for="floatingEmail">Email</label>
    <input required type="email" name="user_email" id="floatingEmail" class="form-control" placeholder="some-mail@mail.com">
  </div>
  <div class="mb-2">
    <button type="submit" class="btn btn-primary mb-3">Reset password</button>
  </div>
</form>
</div>