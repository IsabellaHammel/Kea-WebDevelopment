<?php

$valid_extensions = ['png', 'jpg', 'jpeg', 'gif', 'zip', 'pdf'];

$image_type = mime_content_type($_FILES['my_picture']['tmp_name']); // image/png
$extension = strrchr( $image_type , '/');
$extension = ltrim($extension, '/'); // png, jpg...

if( ! in_array($extension, $valid_extensions) ){
  echo "mmm.. hacking me?";
  exit();
}


$random_image_name = bin2hex(random_bytes(16)).".$extension";
move_uploaded_file($_FILES['my_picture']['tmp_name'], "images/$random_image_name");
