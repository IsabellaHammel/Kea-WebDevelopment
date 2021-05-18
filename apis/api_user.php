<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../bridges/bridge_user.php');
require_once(__DIR__.'/../services/MailService.php');
require_once(__DIR__.'/../services/ImageService.php');

function update_user()
{
    try {
        // Fetch information from POST and get ID from session
        $user = get_logged_in_user();
        
        // ONLY UPDATE IF NEW VALUE GIVEN
        if($_POST['user_password']) { 
            $hash_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
            $user->set_password($hash_password);
        }
        
        if($_POST['user_name']){
            $user->set_firstname($_POST['user_name']);
        }

        if($_POST['user_email']){
            $user->set_email($_POST['user_email']);
        }


        $user_repository = new UserRepository();
        $user_repository->update_user($user);    

        http_response_code(200); // OK

    } catch (Exception $e) {
        http_response_code(500); // internal error
    }

}
