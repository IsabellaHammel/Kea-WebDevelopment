<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');
require_once(__DIR__.'/../repository/forgot_password_repository.php'); 
require_once(__DIR__.'/../repository/forgot_password.php');
require_once(__DIR__.'/../services/MailService.php');


/*
TODO
- New function CheckRestoreLinkActive
  - get ForgotPassword with get_by_token from repo
  - If active proceed with RestorePassword

  - If CreatedOn is greater than 10 min - Expire link --> update is_active = false
    - Redirect to login
  - If is_active was already false
    - Redirect to login


- New function called RestorePassword()
 - get ForgotPassword by token from json post call or form
 - get user from userID stored in ForgotPassword
 - take posted password and hash password
 - update user with new password "->set_password($hashed_password)"
 - update ForgotPassword is_active = 0

When restored password redirect to login
*/