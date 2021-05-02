<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');

global $user_repository; // Exposes user repository globally to be used in functions
$user_repository = new UserRepository();

function try_start_session(){
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
}

function redirect($endpoint)
{
    header("Location: $endpoint");
}


function get_logged_in_user(): ?User
{
    try_start_session();
    global $user_repository;

    if(!isset($_SESSION['user_id'])){
        return null;
    }

    $user_id =  $_SESSION['user_id'];
    $user = $user_repository->get_user($user_id); 
    return $user;
}

function ensure_user_logged_in()
{
    $logged_in_user = get_logged_in_user();
    if($logged_in_user == null) 
    {
        redirect('/login');
    }
}

function get_all_users(): array
{
    global $user_repository;
    ensure_user_logged_in();
    $users = $user_repository->get_users();
    usort($users, function($user1, $user2){
        return $user1->get_age() > $user2->get_age();
    });
    return $users;
}

function get_user(string $user_id): ?User
{
    global $user_repository;
    ensure_user_logged_in();
    $user = $user_repository->get_user($user_id);
    return $user;
}

function deactivate_user()
{
    global $user_repository;
    ensure_user_logged_in();

    $user = get_logged_in_user();
    $user->set_is_active(false);
    $user_repository->update_user($user);
    
    logout();
}

function logout()
{
    session_start();
    session_destroy(); 
    redirect("/login");
}

function search_users()
{
    ensure_user_logged_in();

    global $user_repository;

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

