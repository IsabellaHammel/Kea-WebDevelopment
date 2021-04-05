<?php
// require require_once include include_once
// require -> must be there or stop the page
// require_once -> use it only 1 time
// include -> nice, it tries to use it
// include_once -> 1 time

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

//---------- SIGN UP ---------------
// get('/signup', 'render_signup');
// function render_signup(){
//   require_once(__DIR__.'/views/view_signup.php');
//   exit();
// }

get('/signup', function(){
    require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_signup.php");
    exit();
});

get('/signup/error/:message', function ($message){
  $display_error = $message;
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_signup.php");
  exit();
});

post('/signup', function(){
  require_once("{$_SERVER['DOCUMENT_ROOT']}/bridges/bridge_signup.php");
  exit();
});


//---------- LOGIN ---------------
get('/login', function (){
  require_once("{$_SERVER['DOCUMENT_ROOT']}/views/view_login.php");
  exit();
});


//---------- USER DASHBOARD ---------------
// Create routes



//---------- ADMIN DASHBOARD ---------------
// Create routes


//---------- DEFAULT---------------
any('/404', 'error404');
function error404(){
  echo 'Not found';
  exit();
}

?>