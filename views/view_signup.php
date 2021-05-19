<?php

if(isset($display_error)){
?>
    <div>
        error <?= urldecode($display_error) ?>
    </div>
<?php
}
?>
<form action='/signup' method="POST" enctype="multipart/form-data">
        <input name="user_name" type="text" placeholder="name" >
        <br><br>
        <input name="user_email" type="text"  placeholder="email">
        <br><br>

        <label for="roles">Choose a role:</label>
        <select name="roles" id="roles">
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>
        <br><br>

        <label for="schools">Choose a school:</label>
        <select name="schools" id="schools">
            <option value="kea">KEA</option>
            <option value="itu">ITU</option>
            <option value="ku">KU</option>
            <option value="diku">DIKU</option>
        </select>
        <br><br>

        <input name="user_password" type="password"  placeholder="password">
        <br><br>
        <input name="user_confirm_password" type="password" placeholder="confirm password">
        <br><br>
    <button>signup</button>
</form>
