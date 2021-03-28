<?php

if(!ctype_digit($id)){
        http_response_code(400);
        echo 'Invalid id';
        exit();
    }
    if($action != 0 && $action != 1){
        http_response_code(400);
        echo 'Invalid like or dislike';
        exit();
    }

    if($action == 0){
        // UPDATE posts SET likes = likes +1 WHERE post_id = 1
        $number = file_get_contents("{$_SERVER['DOCUMENT_ROOT']}/db/dislikes.txt"); // read the content of the file
        $number = $number+1;
        // write back to the file - second argument is the data to be written
        file_put_contents("{$_SERVER['DOCUMENT_ROOT']}/db/dislikes.txt", $number);
        echo $number;
        exit();
    }

    if($action == 1){
        $number = file_get_contents("{$_SERVER['DOCUMENT_ROOT']}/db/likes.txt"); // read the content of the file
        $number = $number+1;
        file_put_contents("{$_SERVER['DOCUMENT_ROOT']}/db/likes.txt", $number);
        echo $number;
        exit();
    };