<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($display_error)){
    ?>
        <div>
            error <?= urldecode($display_error) ?>
        </div>
    <?php
    }
    ?>
    <form action= '/login' method="POST">
        <input name="user_email" type="text" placeholder="email">
        <input name="user_password" type="password" placeholder="password">
        <button>login</button>
    </form>
</body>
</html>


<!-- OR -->
<!-- <?php
  //if( isset($display_error) ){
   // echo '<div>Wrong credentials</div>';
 // }
//?>


  <form action="/login" method="POST">
    <input name="user_email" type="text" placeholder="email">
    <input name="user_password" type="password" placeholder="password">
    <button>login</button>
  </form> -->