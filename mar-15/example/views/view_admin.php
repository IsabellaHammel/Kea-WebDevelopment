<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <h1>
        <?php
            echo "Hi {$_SESSION['email']}";
        ?>
    </h1>

    <a href="/logout">logout</a>
