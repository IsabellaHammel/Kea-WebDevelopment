<?php
$people = [
    ['id'=>'a1', 'name'=>'a', 'last_name'=>'aa'],
    ['id'=>'b2', 'name'=>'b', 'last_name'=>'bb'],
    ['id'=>'c3', 'name'=>'c', 'last_name'=>'cc']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <title>Document</title>
</head>
<body>
    <div id="users">
        <div class="user">
            <?php
            foreach($people as $person){
            ?>
            <div class="person">
                ID: <?= $person['id'] ?>
            </div>
            <div>
                Name: <?= $person['name'] ?>
            </div>
            <div>
                Last name: <?= $person['last_name'] ?>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    
</body>
</html>