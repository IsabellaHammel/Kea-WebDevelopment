<?php
// you must start the engine
session_start();
// connected to the db
// get name out
$name = 'Isabella';
// $_GET[] $POST_[]
// assosiative array
$_SESSION['name'] = $name;
$_SESSION['last_name'] = 'Hammel';
// $_SESSION['year'] = 2021;
$_SESSION['year'] = date('Y');
