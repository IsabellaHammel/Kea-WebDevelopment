
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
            <input name="user_age" type="text" placeholder="age">
            <br><br>
            <input name="user_phone"  type="text" placeholder="phone">
            <br><br>
            <input name="user_email" type="text"  placeholder="email">
            <br><br>
            <input name="user_password" type="password"  placeholder="password">
            <br><br>
            <input name="user_confirm_password" type="password" placeholder="confirm password">
            <br><br>
        <button>signup</button>
    </form>