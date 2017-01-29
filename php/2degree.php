<?php

include "Common.php";

get2Degree();

/** Gets 2nd Degree of Separation from Kevin Bacon */
function get2Degree() {

    $db = connectDB();

    $fname = $_POST["firstName"];
    $lname = $_POST["lastName"];

    $query = " ";

    $prep = $db->prepare("$query");
    $prep->bindParam(1, $fname);
    $prep->bindParam(2, $lname);
    $prep->execute();

    $result = array("from" => "2degree", "data" => array());

    foreach($prep as $row) {
        array_push($result["data"], array(
            "firstName" => $row["first_name"],
            "lastName" => $row["last_name"],
            "actorID" => $row["actor_id"],
            "movieID" => $row["movie_id"],
            "role" => $row["role"]
        ));
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

} //Get 2 Degree

?>
