<?php

include "Common.php";

get1Degree();

/** Gets 1st Degree of Separation from Kevin Bacon */
function get1Degree() {

    $db = connectDB();

    $fname = $_POST["firstName"];
    $lname = $_POST["lastName"];

    $query = "(SELECT *  FROM
                (SELECT * FROM actors as a
                    INNER JOIN roles as r
                    ON a.id = r.actor_id
                    WHERE (first_name = \"Kevin\" AND last_name = \"Bacon\")
                    OR (first_name = ? AND last_name = ? ))as t1)";

    $prep = $db->prepare("$query");
    $prep->bindParam(1, $fname);
    $prep->bindParam(2, $lname);
    $prep->execute();

    $result = array("from" => "1degree", "data" => array());

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

} //Get 1 Degree

?>
