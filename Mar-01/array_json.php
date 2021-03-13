<?php
$users = [];
$user_one = new stdClass();
$user_one->id = 1;
$user_one->name = 'a';
array_push($users, $user_one);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <?= $users[0]->name ?>
    </div>
</body>
</html>