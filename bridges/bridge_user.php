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
    exit();
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

function is_user_logged_in(bool $is_require_admin): bool
{
    $logged_in_user = get_logged_in_user();
    $is_user_logged_in = $logged_in_user != null;

    if($is_user_logged_in && 
       $is_require_admin && 
       !$logged_in_user->get_is_admin())
    {
        return false;
    }
    return $is_user_logged_in;
}

function get_all_users(): array
{
    global $user_repository;
    $users = $user_repository->get_users();
    usort($users, function($user1, $user2){
        return $user1->get_age() > $user2->get_age();
    });
    return $users;
}

function get_user(string $user_id): ?User
{
    global $user_repository;
    $user = $user_repository->get_user($user_id);
    return $user;
}

function deactivate_user()
{
    global $user_repository;

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


