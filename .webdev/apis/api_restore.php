<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');
require_once(__DIR__.'/../repository/forgot_password_repository.php'); 
require_once(__DIR__.'/../repository/forgot_password.php');

function restore_password(){
    try
    {
        $user_repository = new UserRepository;
        $forgot_password_repository = new ForgotPasswordRepository;

        $restore_token = $_POST['restore_token'];
        $forgot_password = $forgot_password_repository->get_by_token($restore_token);

        if($forgot_password == null)
        {
            http_response_code(404);
            exit();
        }

        if(!$forgot_password->get_is_active())
        {
            http_response_code(404);
            exit();
        }

        $user = $user_repository->get_user($forgot_password->get_user_id());

        if($user == null)
        {
            http_response_code(500);
            exit();
        }

        $hash_password = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
        $user->set_password($hash_password);

        $user_repository->update_user($user);

        $forgot_password->set_is_active(false); // deactivate so hackers cannot reuse link
        $forgot_password_repository->update($forgot_password);
        http_response_code(200);
    }
    catch(Exception $e)
    {
        http_response_code(500);
    }
}