<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/posts_repository.php');
require_once(__DIR__.'/../bridges/bridge_user.php');
require_once(__DIR__.'/../services/MailService.php');

function create_post()
{
    try {
        // Fetch information from POST and get ID from session
        $user = get_logged_in_user();
        
        if($_POST['user_first_name']){
            $user->set_firstname($_POST['user_first_name']);
        }

        if($_POST['user_last_name']){
            $user->set_lastname($_POST['user_last_name']);
        }

        if($_POST['user_age']){
            $user->set_age($_POST['user_age']);
        }

        if($_POST['user_phone']){
            $user->set_phone($_POST['user_phone']);
        }

        if($_POST['user_email']){
            $user->set_email($_POST['user_email']);
        }

        /* if($_POST['user_picture']){ // add profile picture
            $user->set_firstname($_POST['user_picture']);
        } */
        
        
        $user_repository = new Post();
        $user_repository->update_user($user);    

        http_response_code(200); // OK

    } catch (Exception $e) {
        http_response_code(500); // internal error
    }

}