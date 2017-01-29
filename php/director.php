<?php
include "Common.php";

getDirectors();

/** Finds actors who also directed a movie */
function getDirectors() {

    $db = connectDB();


    $query = " ";

    $prep = $db->prepare("$query");

    $prep->execute();


/*
    foreach($prep as $row) {   }
*/


    header("Content-Type: application/json");

    closeDB($db);

} //Get Directors