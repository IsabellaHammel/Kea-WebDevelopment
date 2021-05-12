<?php 
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');
require_once(__DIR__.'/../services/MailService.php');
require_once(__DIR__.'/../utilities/utilities.php');


function verify_user($token){
    $user_repository = new UserRepository();
    $user = $user_repository->get_user_by_verify_token($token);
    
    if($user == null)
    {
        $error = 'Unable to verify user';
        redirect("/login/error/$error");
    }
    if($user->get_is_verified())
    {
        $error = 'User is already verified';
        redirect("/login/error/$error");
    }

    $user->set_is_verified(true);
    $user_repository->update_user($user);
    send_welcome_mail($user);
    redirect("/login");
}

function send_welcome_mail(User $user)
{
    $mail_service = new MailService();
    $user_email = $user->get_email();
    $fullname = $user->get_fullname();
    $subject = "KEA test - Welcome";
    
    $message = " <div> <b>Hello {$fullname}</b> </div> 
    <div> Welcome to the site! </div>
    <div> Kind Regards </div>
    <div> - Kea Test </div>";

    $mail_service->sendMail($message, $subject, $user_email);
}
