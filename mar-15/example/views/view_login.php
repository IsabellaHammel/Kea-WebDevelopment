<?php
if(!isset($display_error)){

}else{
    echo '<div>Wrong credentials</div>';
}
?>


    <form action="/login" method="POST">
        <input name="user_email" type="text" placeholder="email">
        <input name="user_password" type="password" placeholder="password">
        <button>login</button>
    </form>
