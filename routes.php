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
  require_once("{$_SERVER['DOCUMENT_ROOT']}/bridges/bridge_user.php");
  logout();
  exit();
});

//---------- USER DASHBOARD ---------------
// Create routes
get('/admin', function (){ 
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_admin.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
  exit();
});

get('/users', function (){ 
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_top.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_users.php");
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_bottom.php");
  exit();
});


post('/deactivate', function(){
  require_once("{$_SERVER['DOCUMENT_ROOT']}/bridges/bridge_user.php");
  deactivate_user();
  exit();
});


//---------- DEFAULT---------------
any('/404', 'error404');
function error404(){
  echo 'Not found';
  exit();
}

?>