<?php
// Calls bridge admin bridge to get users - consider
// Show all users in table (firstname, lastname, email, phone, is_active)

require_once(__DIR__.'/../bridges/bridge_user.php'); // Requires user bridge to allow us to call functions from that php file

$user = get_logged_in_user(); // call function from bridge_user.php exposed by require_once

echo "
<div class='user'>
  <div>Firstname: $user->get_firstname</div>
  <div>Lastname: $user->get_lastname</div>
  <div> ... </div>


  <! -- TODO: CREATE DEACTIVATE BUTTON AND CALL PHP deactivate_user() from user_bridge -->
  https://www.geeksforgeeks.org/how-to-call-php-function-on-the-click-of-a-button/#:~:text=Calling%20a%20PHP%20function%20using,the%20array_key_exists()%20function%20called.
  
  <button >Deactivate Account.</button> 

</div>
";