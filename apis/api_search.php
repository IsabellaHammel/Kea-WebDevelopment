<?php

// Validate
if(!isset($_POST['search_for'])){
    http_response_code(400);
    exit();
}

if(strlen($_POST['search_for']) < 2){
    http_response_code(400);
    exit();
}

if(strlen($_POST['search_for']) > 20){
    http_response_code(400);
    exit();
}

try{
    $db_path = $_SERVER['DOCUMENT_ROOT'].'/db/users.db';
    $db = new PDO("sqlite:$db_path");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $q = $db->prepare('SELECT user_id, user_firstname, user_lastname FROM users WHERE user_firstname LIKE :user_firstname LIMIT 20 COLLATE NOCASE');
    $q->bindValue(':user_firstname', '%'.trim($_POST['search_for']).'%');
    $q->execute();
    $users = $q->fetchAll();
    // Cannot pass arrays or json to the frontend. you can 'arrays' looking like json looking like string
    header("Content-type:application/json");
    echo json_encode($users);
}catch(PDOException $ex){
    echo $ex;
  }