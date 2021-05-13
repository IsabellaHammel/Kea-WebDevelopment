
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
            <input name="user_age" type="date" value="2000-01-01" min="1900-01-01">
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

    <!-- <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input name="my_picture" type="file">
        <input type="submit" value="Upload image">
    </form> -->