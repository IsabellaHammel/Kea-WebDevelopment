
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
        <br><br>
        <input name="user_password" type="password" placeholder="password">
        <br><br>
        <button>login</button>
    </form>
    <!-- <div id="forgot_pwd"> I forgot my password </div> -->
