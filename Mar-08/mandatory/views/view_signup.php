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

    <form action="/login" method="POST">
        <div>
            <div>
                name <span class="soft">(min 2 max 20 characters)</span>
            </div>
            <input id="first_name" onclick="clear_error()" type="text" placeholder="name" data-input-type="str" data-min="2" data-max="20">
        </div>

        <div>
            <div>
                last name <span class="soft">(min 2 max 20 characters)</span>
            </div>
            <input id="last_name" onclick="clear_error()" type="text" placeholder="last name" data-input-type="str" data-min="2" data-max="20">
        </div>

        <div>
            <div>
                phone <span class="soft">(8 digits)</span>
            </div>
            <input id="phone" onclick="clear_error()" type="text" placeholder="phone" maxlength="8" data-input-type="int" data-min="10000000" data-max="99999999">
        </div>

        <div>
            <div>
                email <span class="soft">(mail)</span>
            </div>
            <input id="email" onclick="clear_error()" type="text" placeholder="email" maxlength="50" data-input-type="email">
        </div>

        <!--the password must be at least 8 characters and no more than 50-->

        <div>
            <div>
                password <span class="soft">(1-50 characters)</span>
            </div>
            <input id="password" onclick="clear_error()" type="password" placeholder="password" maxlength="50" data-input-type="str" data-min="1" data-max="50">
        </div>

        <div>
            <div>
                confirm password <span class="soft">(1-50 characters)</span>
            </div>
            <input id="confirm_password" onclick="clear_error()" type="password" placeholder="password" maxlength="50" data-input-type="str" data-min="1" data-max="50">
        </div>
        <button>login</button>
    </form>
</body>
</html>