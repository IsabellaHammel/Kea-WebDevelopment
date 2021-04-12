<?php

require_once(__DIR__.'/router.php'); // $_SERVER['DOCUMENT_ROOT'];

// #####################

get('/', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_index.php'); // document root shouldnt be used in these folders
});

// #####################

get('/users', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_users.php'); // document root shouldnt be used in these folders
});

// #####################

post('/users/create', function(){
    echo 'user created';
});

// #####################

post('/users/update/:id', function($id){
    echo "updating user with id: $id";
});

// #####################

post('/users/delete/:id', function($id){
    echo "deleting user with id: $id";
});

// #####################

post('/db-create-users', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/db/db_create_users.php');
});

// #####################

post('/db-seed-users', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/db/db_seed_users.php');
});

// #####################

any('/404', function(){
  echo 'Not found';
});