<?php

require_once(__DIR__.'/router.php'); // $_SERVER['DOCUMENT_ROOT'];

// #####################

get('/', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_index.php'); // document root shouldnt be used in these folders
});

// #####################

get('/admin', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_admin.php'); // document root shouldnt be used in these folders
});

// #####################

get('/login', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_login.php'); // document root shouldnt be used in these folders
});

// #####################

get('/users', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_users.php'); // document root shouldnt be used in these folders
});

// #####################

get('/signup', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_signup.php'); // document root shouldnt be used in these folders
});

// #####################

get('/email', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_email.php'); // document root shouldnt be used in these folders
});

get('/search', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_search.php'); // document root shouldnt be used in these folders
});

get('/users/$user_uuid', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/views/view_user.php'); // document root shouldnt be used in these folders
});

// #####################

post('/login', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/bridges/bridge_login.php');
});

// #####################

post('/deactivate', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/views/deactivate.php');
});

// post('/deactivate', 'views/deactivate.php'); --> new update, also update router.php

// #####################

post('/search', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/apis/api_search.php');
});

post('/users/create', function(){
    echo 'user created';
});

// #####################

post('/users/update/:id', function($id){
    echo "updating user with id: $id";
});

// #####################

post('/users/delete/:user_id', function($user_id){
    require_once($_SERVER['DOCUMENT_ROOT'].'/apis/api_delete_user.php');
});

// #####################

post('/db-create-users', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/db/db_create_users.php');
});

// #####################

post('/db-seed-users', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/db/db_seed_users.php');
});


post('/signup', function(){
    require_once($_SERVER['DOCUMENT_ROOT'].'/bridges/bridge_signup.php');
});



// #####################

any('/404', function(){
  echo 'Not found';
});