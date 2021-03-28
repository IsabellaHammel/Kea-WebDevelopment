<?php

// require_once(__DIR__.'/router.php');
// echo $_SERVER['DOCUMENT_ROOT'];
require_once($_SERVER['DOCUMENT_ROOT'].'/router.php');

// ###################################

get('/', function(){
    echo 'Index'; 
});

get('/posts', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_posts.php');
    // require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_posts.php"); assoc array
});

post('/posts/:id/:action', function($id, $action){
    require_once("{$_SERVER['DOCUMENT_ROOT']}/apis/api_posts_like_dislike.php");

    /* IN THIS CASE DON'T USE SWITCH */
    // switch ($action):
    //     case 0:
    //         echo 'dislike';
    //         break;
    //     case 1:
    //         echo 'like';
    //         break;
    //     default:
    //     bad_request("Invalid like or dislike");
    // endswitch;

    // echo "The user $action post with id $id";
});



// ###################################
// MOST THINGS BELOW IS FOR UNDERSTANDING

// get('/users', function(){
//     echo 'Users'; 
// });

// get('/users/:id', function($id){
//     echo "Getting user with id $id";
// });

// ###################################

// post('/users', function(){
//     echo 'User created with id: 1';
// });

// post('/users/:id', function($id){
//     echo "Updating user with id: $id";
// });

// ###################################

// delete('/users/:id', function($id){
//     echo "Deleting user with id: $id";
// });

/* HTTP STATUS CODES
200 ok success
400 bad request
401 unauthorized
500 internal server error  
*/

// ###################################




// For GET or POST
any('/404', function(){
  echo 'Not found';
});




// ###################################

/* 
GET --> url copy paste
POST --> create something
PUT/PATCH --> update
DELETE --> use to delete something
*/

/* 
GET user with id 1
    /users/1
get all users
    /users


post to create a user, the user does not hav an id at the moment
    /users
return the user's id


put/patch?
post to update a user
    /users/3

delete
    /users/1
*/