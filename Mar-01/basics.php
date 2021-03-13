<?php

// phpinfo();

// double quotes is not the same as single quotes
// echo 'Isabella';
// variable
// $name = 'Isabella';

// concatenation you use a dot
// the plus sign is used for math
// echo 'Hi '.$name;

// double quotes take longer time for php
// echo "Hi $name";

// if you don't use variables in the sentence
// then use single quotes

/* $name = 'A';
$last_name = 'B';
echo 'Hi '.$name.' '.$last_name;
echo "Hi $name $last_name"; */

// no quotes on numbers
/* $year = '2021';
$next_year = $year + 1; // plus is used for math
echo $next_year; */

// array
$letters = ['a', 'b'];
array_push($letters, 'c', 'd');
/* var_dump($letters); */
// how do you delete the last element from the array
$removed = array_pop($letters);
/* var_dump($letters); */
// how do you prepend to the array
array_unshift($letters, 'x');
var_dump($letters);
// delete first element _shift
// delete last element _pop
// unset used to delete an array



// web is text - you pass text, you get text
// client and the server send text to each other
// echo $letters; // not possible
/* print_r($letters); */
/* var_dump($letters); */
// json_encode