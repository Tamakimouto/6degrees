<?php
include "Common.php";

get2Genre();

/** Gets actors that have the largest amount of movies from the given genre */
function get2Genre() {

    $db = connectDB();

    $genre = $_POST['genre'];
    $query = " ";

    $prep = $db->prepare("$query");
    $prep->bindParam(1, $genre);
    $prep->execute();


/*
    foreach($prep as $row) {   }
*/

    header("Content-Type: application/json");


    closeDB($db);

} //Get 2 Genre