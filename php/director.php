<?php
include "Common.php";

getDirectors();

/** Finds actors who also directed a movie */
function getDirectors() {

    $db = connectDB();

    $query = ("
        SELECT a.first_name, a.last_name, a.id
        FROM actors a
        INNER JOIN directors
        WHERE a.first_name = directors.first_name
        AND a.last_name = directors.last_name
    ");

    $prep = $db->prepare("$query");
    $prep->execute();

    $result = array("from" => "director", "data" => array());

    foreach($prep as $row) {
        array_push($result["data"], array(
            "firstName" => $row["first_name"],
            "lastName" => $row["last_name"],
            "actorID" => $row["id"]
        ));
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

} //Get Directors
