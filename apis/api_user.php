<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../bridges/bridge_user.php');
require_once(__DIR__.'/../services/MailService.php');


function search_users()
{
    $user_repository = new UserRepository();

    // Validate
    if(!isset($_POST['search_for']) || 
        strlen($_POST['search_for']) < 2 ||
        strlen($_POST['search_for']) > 50)
    {
        http_response_code(400); // bad request
        exit();
    }
    
    try 
    {
        $users = $user_repository->search_user_by_name(trim($_POST['search_for']));
    } catch (PDOException $exception) 
    {
        http_response_code(500); // internal server error
    }
    
    $users_to_return = array();
    foreach($users as $user)
    {
        $user_to_return = array(
            "user_id" => $user->get_id(), 
            "user_fullname" => $user->get_fullname()
        );
        array_push($users_to_return, $user_to_return);
    }
    header("Content-type:application/json");
    echo json_encode($users_to_return);
}

function deactivate_user_by_admin(int $id)
{
    try{
        $user_repository = new UserRepository();
        $mail_service = new MailService();

        $user = $user_repository->get_user($id);

        if($user == null){
            http_response_code(404);
            exit();
        }
        $user->set_is_active(false);
        $user_repository->update_user($user);
        
        $user_email = $user->get_email();
        $subject = "KEA test - Your account has been deactivated";
        $message = " <div> <b>Hello {$user->get_fullname()}</b> </div> 
        <div> An admin has deactivated your account </div>
        <div> Kind Regards </div>
        <div> - Kea Test </div>";
        $mail_service->sendMail($message, $subject, $user_email);

        http_response_code(200);
    }
    catch(Exception $e){
        http_response_code(500);
    }
}

function activate_user_by_admin(int $id)
{
    try{
        $user_repository = new UserRepository();
        $mail_service = new MailService();

        $user = $user_repository->get_user($id);

        if($user == null){
            http_response_code(404);
            exit();
        }
        $user->set_is_active(true);
        $user_repository->update_user($user);

        $user_email = $user->get_email();
        $subject = "KEA test - Your account has been re-activated";
        $message = " <div> <b>Hello {$user->get_fullname()}</b> </div> 
        <div> An admin has re-activated your account </div>
        <div> Kind Regards </div>
        <div> - Kea Test </div>";
        $mail_service->sendMail($message, $subject, $user_email);

        http_response_code(200);
    }
    catch(Exception $e){
        http_response_code(500);
    }
}


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
        
        
        $user_repository = new UserRepository();
        $user_repository->update_user($user);    

        http_response_code(200); // OK

    } catch (Exception $e) {
        http_response_code(500); // internal error
    }

}
