<?php

include "Common.php";

get1Genre();


/** Gets Genre with the Largest Movie Count */
function get1Genre() {

    $db = connectDB();


    $query = "SELECT genre,count(*) as MovieCount FROM movies_genres group by genre ORDER BY MovieCount DESC ";

    $prep = $db->prepare("$query");

    $prep->execute();

    foreach($prep as $row) {
        echo $row['genre'] . " " . $row['MovieCount'] . "<br/>";
    }


    header("Content-Type: application/json");

    closeDB($db);

} //Get 1 Genre
