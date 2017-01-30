<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * 1degree.php
 *
 * Get's all films in a 1st degree of separation from Kevin Bacon
 * with a given actor.
 *
 * PHP 5
 *
 * @category    Project1
 * @author      Anthony Zheng <Anthony@anthonyzing.me>
 * @author      Terrence Butler <tbbutle@uga.edu>
 * @author      Nghia Le <nghiathanle.25@gmail.com>
 * @since       Created January 22, 2017
 */

include "Common.php";

get1Degree();

/**
 * get1Degree
 *
 * Gets 1st Degree of Separation from Kevin Bacon.
 */
function get1Degree() {

    $db = connectDB();

    $fname = $_POST["firstName"];
    $lname = $_POST["lastName"];

    $query = "SELECT * FROM movies WHERE id in
        (SELECT movie_id FROM
            (SELECT * FROM actors WHERE first_name = 'Kevin' AND last_name = 'Bacon'
            union
            SELECT * FROM actors WHERE first_name = '$fname' AND last_name = '$lname') as bothActors
            INNER JOIN roles as s ON bothActors.id=s.actor_id
            WHERE movie_id in
                (SELECT movie_id FROM actors as a
                INNER JOIN roles as r ON a.id = r.actor_id
                WHERE (a.id =
                    (SELECT id FROM actors WHERE first_name = '$fname' AND last_name = '$lname')
                    )
                )
                AND movie_id in
                    (SELECT movie_id FROM actors as a
                    INNER JOIN roles as r ON a.id = r.actor_id
                    WHERE(a.id =
                        (SELECT id FROM actors WHERE first_name = 'Kevin' AND last_name = 'Bacon')
                    ))
        )";

    $prep = $db->prepare("$query");
    $prep->bindParam(1, $fname);
    $prep->bindParam(2, $lname);
    $prep->execute();

    $result = array("from" => "1degree", "data" => array());

    foreach($prep as $row) {
        array_push($result["data"], array(
            "rank" => $row["rank"],
            "year" => $row["year"],
            "movieName" => $row["name"],
            "movieID" => $row["id"]
        ));
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

} //Get 1 Degree

?>
