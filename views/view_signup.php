<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup form</title>
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
    <form action='/signup' method="POST">
            <input name="user_first_name" type="text" placeholder="name" >
            <br><br>
            <input name="user_last_name" type="text" placeholder="last name">
            <br><br>
            <input name="user_phone"  type="text" placeholder="phone">
            <br><br>
            <input name="user_email" type="text"  placeholder="email">
            <br><br>
            <input name="user_password" type="password"  placeholder="password">
            <br>
            <input name="user_confirm_password" type="password" placeholder="confirm password">
            <br><br>
        <button>signup</button>
    </form>
</body>
</html>