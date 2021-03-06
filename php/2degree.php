<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * 2degree.php
 *
 * Gets all movies in a 2nd degree of separation from Kevin Bacon.
 * Working down to the wire with this query. Hopefully it doesn't
 * get submitted late.
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

get2Degree();

/**
 * get2Degree
 *
 * Gets 2nd Degree of Separation from Kevin Bacon
 */
function get2Degree() {

    $db = connectDB();

    $query = ("
        SELECT * FROM (
        SELECT *
        FROM actors as a
        INNER JOIN roles as r
        ON a.id = r.actor_id
        WHERE NOT actor_id IN (
            SELECT actor_id from roles
            WHERE movie_id IN
            (SELECT movie_id
            FROM actors as a
            INNER JOIN roles as r
            ON a.id = r.actor_id
            WHERE first_name='Kevin' AND last_name='Bacon')
        ))as t1

        WHERE movie_id IN (SELECT movie_id
        FROM actors as a
        INNER JOIN roles as r
        ON a.id = r.actor_id
        WHERE actor_id IN (
            SELECT actor_id from roles
            WHERE movie_id IN
            (SELECT movie_id
            FROM actors as a
            INNER JOIN roles as r
            ON a.id = r.actor_id
            WHERE first_name='Kevin' AND last_name='Bacon')
        ))
    ");

    $prep = $db->prepare("$query");
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
