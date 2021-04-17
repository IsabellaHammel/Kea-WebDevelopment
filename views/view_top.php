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
</head>
<body>
  <nav>
    <ul>
    <?php
    if(!isset($_SESSION['user_id'])){
    ?>
        <li>
          <a href="/signup">
            Signup
          </a>
        </li> 
        <li>
          <a href="/login"> <!-- Only shown when no session -->
            Login
          </a>
        </li>
    <?php
    } 
    else {
    ?>
        <li>
          <a href="/admin">  <!-- TODO: Hide this if not logged in check session -->
            Admin
          </a>
        </li>
        <li>
          <a href="/users">  <!-- TODO: Hide this if not logged in check session -->
            Users
          </a>
        </li>  
        <li>
          <a href="/logout"> <!-- Only shown when no session -->
            Logout
          </a>
        </li>
    <?php
    }
    ?>    
    </ul>
  </nav>

