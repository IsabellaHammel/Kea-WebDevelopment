<?php
require_once(__DIR__.'/../db.php');

$q = $db->prepare('SELECT * FROM users');
$q->execute();
$users = $q->fetchAll(); //PDO::FETCH_ASSOC
print_r($users);
// var_dump($rows);
// echo json_encode($rows);

// [0, 1, 2]
// ["name"=>"a"]
// {"name":"a"}

foreach($users as $user){
    echo "
    <div class='users'>
        <div>ID: $user->id</div>
        <div>EMAIL: $user->email</div>
    </div>
    "; 
    // echo $user['id'];
}