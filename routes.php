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
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_login.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
  exit();
});

get('/login', function (){
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


//---------- USER DASHBOARD ---------------

get('/myprofile', function (){ 
  authorize();
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_myprofile.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
  exit();
});


post('/users/update', function(){
  authorize();
  require_once("{$_SERVER['DOCUMENT_ROOT']}/apis/api_user.php");
  update_user();
  exit();
});

// ------------- SCHOOLS  ---------------------

get('/api/schools', function(){
  require_once("{$_SERVER['DOCUMENT_ROOT']}/apis/api_schools.php");
  get_all_schools();
  exit();
});


// ------------- ROLES  ---------------------

get('/api/roles', function(){
  require_once("{$_SERVER['DOCUMENT_ROOT']}/apis/api_roles.php");
  get_all_roles();
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

