<?php

include "Common.php";

get1Genre();

/** Gets Genre with the Largest Movie Count */
function get1Genre() {

    $db = connectDB();

    $query = "SELECT genre, count(*) as MovieCount FROM movies_genres
        group by genre ORDER BY MovieCount DESC";

    $prep = $db->prepare("$query");
    $prep->execute();

    $result = array("from" => "1genre", "data" => array());

    foreach($prep as $row) {
        array_push($result["data"], array(
            "genre" => $row["genre"],
            "count" => $row["MovieCount"]
        ));
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

} //Get 1 Genre

?>
