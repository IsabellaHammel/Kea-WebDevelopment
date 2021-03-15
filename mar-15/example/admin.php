<?php
// must start the engine
session_start();
// SESSION is an assoc array
$name = $_SESSION['name'];
echo "Hi $name {$_SESSION['last_name']}";
// echo $_SESSION['year'] = 2021;
echo 'copyright'