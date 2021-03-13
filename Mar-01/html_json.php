<?php
// not associative but json
$user = new stdClass(); // JSON
$user->name = 'a';
$user->last_name = 'b';
$user->age = 1;
unset($user->age);

/* echo "Hi $user->name $user->last_name";
 */
// you can only echo text - not arrays, not json
echo json_encode($user);
