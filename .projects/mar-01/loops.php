<?php

$user = ['name'=>'a', 'last_name'=>'b'];
foreach($user as $key => $value){ // $unknown is also the $value
    echo "<div>$key $value</div>";
}


// array means many, many means loop
/* $letters = ['a', 'b', 'c']; */


/* foreach($letters as $index=>$value){
    // echo $index; //012
    // echo $value; //abc
    echo "$index $value";
} */


/* foreach($letters as $letter){
    echo $letter;
} */


/* echo $letters[0]; */


// this is the same but just a for loop
// sizeof or use count
/* for($i = 0 ; $i < count($letters); $i++){
    echo $letters[$i];
} */