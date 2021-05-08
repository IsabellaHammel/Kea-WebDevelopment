<?php
// require require_once include include_once
// require -> must be there or stop the page
// require_once -> use it only 1 time
// include -> nice, it tries to use it
// include_once -> 1 time

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

//---------- SIGN UP ---------------
get('/signup', function(){
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_signup.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
  exit();
});

get('/signup/error/:message', function ($message){
  $display_error = $message;
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_signup.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
  exit();
});

post('/signup', function(){
  require_once("{$_SERVER['DOCUMENT_ROOT']}/bridges/bridge_signup.php");
  exit();
});


//---------- LOGIN ---------------
get('/', function (){
  authorize(is_home: true);
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_login.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
  exit();
});

get('/login', function (){
  authorize(is_home: true);
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_login.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
  exit();
});

get('/login/error/:message', function($message){
  $display_error = $message;
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_login.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
  exit();
});

post('/login', function(){
  require_once("{$_SERVER['DOCUMENT_ROOT']}/bridges/bridge_login.php");
  exit();
});

get('/logout', function(){
  authorize();
  require_once("{$_SERVER['DOCUMENT_ROOT']}/bridges/bridge_user.php");
  logout();
  exit();
});

//---------- ADMIN DASHBOARD ---------------

get('/admin', function (){
  authorize();
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_admin.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
  exit();
});

//---------- USER DASHBOARD ---------------

get('/myprofile', function (){ 
  authorize();
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_myprofile.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
  exit();
});

// get('/users', function (){ 
//   require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
//   require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_users.php");
//   require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
//   exit();
// });

get('/users/:id', function($id){
  authorize();
  $user_id = $id;
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_user.php"); 
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
  exit();
});

post('/deactivate', function(){
  authorize();
  require_once("{$_SERVER['DOCUMENT_ROOT']}/bridges/bridge_user.php");
  deactivate_user();
  exit();
});

post('/users/update', function(){
  authorize();
  require_once("{$_SERVER['DOCUMENT_ROOT']}/apis/api_user.php");
  update_user();
  exit();
});

//---------- SEARCH ---------------

get('/search', function(){
  authorize();
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php"); 
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_search.php"); 
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php"); 
  exit();
});

post('/search', function(){
  authorize_api();
  require_once("{$_SERVER['DOCUMENT_ROOT']}/apis/api_user.php");
  search_users();
  exit();
});

//---------- VERIFICATION ------------
get('/verify/:token', function($token){
  require_once("{$_SERVER['DOCUMENT_ROOT']}/bridges/bridge_verify.php");
  verify_user($token);
  exit();
});


//---------- DEFAULT---------------
any('/404', 'error404');
function error404(){
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php"); 
  echo 'Not found';
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php"); 
  exit();
}

function authorize(bool $is_home = false){
  require_once("{$_SERVER['DOCUMENT_ROOT']}/bridges/bridge_user.php");
  
  if(is_user_logged_in() && $is_home){
    header("Location: /myprofile"); // user already logged in
    exit();
  }

  if(!is_user_logged_in() && !$is_home){
    header("Location: /"); // avoid infinite redirect if home
  }
}

function authorize_api(){
  require_once("{$_SERVER['DOCUMENT_ROOT']}/bridges/bridge_user.php");
  
  if(!is_user_logged_in()){
    http_response_code(401); // unauthorized
    exit();
  }
}

?>

