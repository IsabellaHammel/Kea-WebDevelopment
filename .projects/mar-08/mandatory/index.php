<?php
// require require_once include include_once
// require -> must be there or stop the page
// require_once -> use it only 1 time
// include -> nice, it tries to use it
// include_once -> 1 time

require_once(__DIR__.'/router.php');

$GLOBALS["baseRoute"] = 'mar-08/mandatory';
$baseRoute = $GLOBALS["baseRoute"];

get($baseRoute . '/signup', 'render_signup');
function render_signup(){
  require_once(__DIR__.'/views/view_signup.php');
  exit();
}

get($baseRoute . '/signup/error/:message', 'render_signup_error');
function render_signup_error($message){
  $display_error = $message;
  require_once(__DIR__.'/views/view_signup.php');
  exit();
}

get($baseRoute . '/login', 'render_login');
function render_login(){
  require_once(__DIR__.'/views/view_login.php');
  exit();
}

post($baseRoute . '/signup', 'submit_signup');
function submit_signup(){
  require_once(__DIR__.'/bridges/bridge_signup.php');
  exit();
}

any('/404', 'error404');
function error404(){
  echo 'Not found';
  exit();
}

?>