<?php
require_once(__DIR__.'/../repository/user_repository.php');
require_once(__DIR__.'/../repository/posts_repository.php');
require_once(__DIR__.'/../bridges/bridge_user.php');
require_once(__DIR__.'/../services/MailService.php');

function create_post()
{
    try { 
        $post_repository = new PostRepository;
        $user = get_logged_in_user();

        if($user == null) // unauthorized status code when user is not found
        {
            http_response_code(401);
            exit();
        }
        
        $post_content = $_POST['post_content'];

        if($post_content == null || strlen($post_content) == 0)
        {
            http_response_code(400); // Bad request
            exit();
        }

        $post = new Post(
            post_user_id: $user->get_id(), 
            post_created_on: new DateTime("now", new DateTimeZone("UTC")),
            post_content: $post_content
        );
        
        $post_repository->create($post);  

        http_response_code(200); // OK

    } 
    catch (Exception $e) 
    {
        http_response_code(500); // internal error
    }
}

function get_posts()
{
    try{
        $post_repository = new PostRepository;
        $user_id = $_GET['user_id'];   //i.e., posts?user_id=1
        
        if($user_id == null || !$user_id)
        {
            http_response_code(400);
        }

        $posts = $post_repository->get_posts_by_user_id($user_id); // this returns domain obj
        
        $posts_to_return = array(); // array of dicts
        foreach($posts as $post)
        {
            $post_to_return = array(
                "post_id" => $post->get_post_id(),
                "post_user_id" => $post->get_post_user_id(),
                "created_on" => $post->get_post_created_on_str(),
                "post_content" => $post->get_post_content()
            );
            array_push($posts_to_return, $post_to_return);
        }

        $response = array(
            "posts" => $posts_to_return 
        ); 

        header("Content-type:application/json");
        echo json_encode($response);
    }
    catch(Exception $e)
    {
        http_response_code(500);
    }
}

function delete_post(string $post_id)
{
    try
    {
        $post_repository = new PostRepository;
        $user = get_logged_in_user();

        if($post_id == null || !$post_id)
        {
            http_response_code(400); // bad request
        }
        
        $post = $post_repository->get_post($post_id);
        
        if($post == null)
        {
            http_response_code(404); // not found
        }

        if($post->get_post_user_id() != $user->get_id())
        {
            http_response_code(401); // unauthorized
        }

        $post_repository->delete($post_id);
        http_response_code(200);
    }
    catch(Exception $e)
    {
        http_response_code(500); // internal error
    }
}