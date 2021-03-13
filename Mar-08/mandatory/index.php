<?php

require_once(__DIR__.'/router.php');


/* get('/', 'index');
function index(){
    echo "Welcome";
    exit();
}

// ###########################
// POST
post('/login', 'login');
function login(){
  echo $_POST['email'];
  echo $_POST['password'];
  exit();
} */


// ###########################






// ###########################
// For GET or POST
any('/404', 'error404');
function error404(){
  echo 'Not found';
  exit();
}