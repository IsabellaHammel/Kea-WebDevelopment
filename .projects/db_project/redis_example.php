<?php

try {
    // create redis instance
    $redis = new Redis();
    
    // connect with server and port
    $redis->connect('localhost', 6379);
    
    // set key
    // $redis->set('user', 'John Doe');
    
    // get value
    $user = $redis->get('user');

    print($user); // John Doe
} catch (Exception $ex) {
    echo $ex->getMessage();
}