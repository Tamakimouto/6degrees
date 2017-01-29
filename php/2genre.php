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

    $result = array("from" => "2genre", "data" => array());

    foreach($prep as $row) {
        array_push($result["data"], array(
            "firstName" => $row["first_name"],
            "lastName" => $row["last_name"],
            "count" => /* !!!!!!!!!!!! The Count !!!!!!!!!!! */
        ));
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

} //Get 2 Genre

?>
