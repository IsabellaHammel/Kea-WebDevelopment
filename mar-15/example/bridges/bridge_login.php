<?php
// TODO: validate user_email and user_password

require_once(__DIR__.'/../db.php');

try{
    // echo $_POST['user_email'];
    // echo $_POST['user_password'];
    // $q = $db->prepare('SELECT * FROM users WHERE email = :email ');
    // $q = $q->bindValue(':email', $_POST['user_email']);


    // INSECURE DONT DO THIS
    // $q = $db->prepare("SELECT * FROM users WHERE email = '{$_POST['user_email']}');
    // $q = $q->bindValue(':email', $_POST['user_email']);

    $q = $db->prepare('SELECT * FROM users WHERE email = :email');
    $q->bindValue(':email', $_POST['user_email']);
    $q->execute();
    $user = $q->fetchAll();


    // the user is not found
    if(count($user) == 0){
        header ('Location: /login');
        exit();
    }

    // the user is found
    session_start();
    $_SESSION['email'] = $_POST['user_email'];
    header ('Location: /admin');
    exit();



    // if the mail is not in the db we get [] empty
    // echo json_encode($user);
    // header('Location: /login');
    
}catch(PDOException as $e){
    echo $e;
}


