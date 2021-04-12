<?php

require_once(__DIR__.'/router.php'); // $_SERVER['DOCUMENT_ROOT'];

// #####################

get('/', function(){
    echo 'x';
});


any('/404', function(){
  echo 'Not found';
});