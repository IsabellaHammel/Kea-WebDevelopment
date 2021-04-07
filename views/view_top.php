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
      <li>
        <a href="/">
          home
        </a>
      </li>
      <li>
        <a href="/admin">  <!-- Hide this if not logged in check session -->
          admin
        </a>
      </li>
      <li>
        <a href="/user">  <!-- Hide this if not logged in check session -->
          user
        </a>
      </li>   

      <!-- Dynamic switch based on session - signup, login, logout-->       
      <li>
        <a href="/login"> <!-- Only shown when no session -->
          login
        </a>
      </li>
      <!---->
      
    </ul>
  </nav>

