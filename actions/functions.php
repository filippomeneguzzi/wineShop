<?php

/* file incluso nella navbar quindi 
    incluso ovunque*/

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//function to verify log
if(!function_exists('logged_in')){
    function logged_in() {
        return isset($_SESSION['user_id']);
    }
}


//functions to limit word description product
function limitWords($string){
    $cut = 8;
    $words = explode(' ', $string);
    return implode(' ', array_slice($words, 0 , $cut));
}

function current_date(){
    $today = date("j F Y");
    echo $today;
}




?>