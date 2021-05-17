<?php
    if(isset($display_message)){
    ?>
        <div>
            error <?= urldecode($display_message) ?>
        </div>
    <?php
    }
    else{
        header('Location: /');
    }
?>