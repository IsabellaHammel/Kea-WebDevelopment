<?php
  require_once(__DIR__.'/../bridges/bridge_user.php'); // Requires user bridge to allow us to call functions from that php file
  try_start_session();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page_title ?? 'Mandatory Project' ?></title>
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <nav>
    <ul>
    <?php
    if(!isset($_SESSION['user_id'])){ 
    ?> <!-- Only shown when no session -->
        <li>
          <a href="/signup">
            Signup
          </a>
        </li> 
        <li>
          <a href="/login"> 
            Login
          </a>
        </li>
    <?php
    } 
    else { 
    ?> <!-- Only shown when session -->
        <li>
          <a href="/admin">  
            Admin
          </a>
        </li>
        <li>
          <a href="/search">  
            Search
          </a>
        </li>
        <li>
          <a href="/users">  
            Users
          </a>
        </li>  
        <li>
          <a href="/logout"> 
            Logout
          </a>
        </li>
    <?php
    }
    ?>    
    </ul>
  </nav>

