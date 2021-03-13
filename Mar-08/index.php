<?php

require_once(__DIR__.'/router.php');


/* get('/', 'index');
function index(){
    echo "Welcome";
    exit();
}

// ###########################
get('/test/:gender', 'test');
function test($gender){
    echo $gender;
    echo $_GET['price'];
    exit();
}


// ###########################
get('/product/:color', 'get_product');
function get_product($color){
  echo "The product is $color";
  exit();
}

// ###########################
get('/:gender/:item', 'get_products');
function get_products($gender, $item){
  echo $gender;
  echo $item;
  exit();
}

// ###########################
get('/product/:category/:size/:maxprice', 'get_searched_product');
function get_searched_product($category, $size, $maxprice){
  echo "$category, $size, $maxprice";
  exit();
}

// product/category/size/max price
// product/shoes/10/1000
// product/pants/32/500
// product/shoes/10/200





// ###########################
// POST
post('/login', 'login');
function login(){
  echo $_POST['email'];
  echo $_POST['password'];
  exit();
} */




// ###########################
/* TASK
we need to login, signup, logout, update profiles,
search for a user, search for user by age, 
search for user by gender, 
search for user by gender and age,
block a user */

// get('/user/:name', 'get_user_by_name');
// function get_user_by_name($name){
  
//   exit();
// }

get('/login', 'render_login');
function render_login(){
  require_once(__DIR__.'/views/view_login.php');
  exit();
}

get('/login/error/:message', 'render_login_error');
function render_login_error($message){
  $display_error = $message;
  require_once(__DIR__.'/views/view_login.php');
  exit();
}



get('/profile', 'render_profile');
function render_profile(){
  require_once(__DIR__.'/views/view_profile.php');
  exit();
}

post('/login', 'user_login');
function user_login(){
  require_once(__DIR__.'/bridges/bridge_login.php');
  exit();
}

// post('/signup', 'signup');
// function signup(){
  
//   exit();
// }

// post('/logout', 'logout');
// function logout(){
//   echo $_POST['email'];
//   exit();
// }

// post('/update-profile', 'update-profile');
// function update_profile(){

//   exit();
// }

// get('/user/:age', 'get_user_age');
// function get_user_age($age){
//   echo $age;
//   exit();
// }

// get('/user/:gender', 'get_user_gender');
// function get_user_gender($gender){
//   echo $gender;
//   exit();
// }

// get('/user/:gender/:age', 'get_user');
// function get_user($gender, $age){
//   echo $gender;
//   echo $age;
//   exit();
// }

// post('/user/block', 'block_user');
// function block_user($id){
  
//   exit();
// }



// ###########################
// For GET or POST
any('/404', 'error404');
function error404(){
  echo 'Not found';
  exit();
}