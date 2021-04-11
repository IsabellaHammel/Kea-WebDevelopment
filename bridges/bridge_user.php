<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/user.php');

global $user_repository; // Exposes user repository globally to be used in functions
$user_repository = new UserRepository();

function redirect($endpoint)
{
    header("Location: $endpoint");
}


function get_logged_in_user(): User
{
    global $user_repository;

    $user_id =  $_SESSION[...]; // TODO: Get user id from session
    $user = $user_repository-> ...; // TODO: Get user from repo by user_id

    return $user;
}

function ensure_user_logged_in():
{
    $logged_in_user = get_logged_in_user();
    if(...) // if user is == null then user is not logged in
    {
        redirect('/login');
    }
}


function get_all_users(): array
{
    global ... // TODO:
    ensure_user_logged_in()
    return $user_repository->...; // TODO: Call get_users()
}

function deactivate_user()
{
    global ...
    ensure_user_logged_in()

    $user = ... // TODO: use get_logged_in_user function
    $user->set_is_active(...); // TODO: set to false
    $user_repository->update_user(...); // TODO: update $user to deactive it
    
    logout();
}

function logout()
{
    // TODO: destroy session - use session_destroy();
    ...
    redirect("/login");
}