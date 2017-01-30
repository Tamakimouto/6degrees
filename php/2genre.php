<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * 2genre.php
 *
 * Ajax return for the actor who has played in the most amount
 * of movies in a given genre.
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

get2Genre();

/**
 * get2Genre
 *
 * Gets actors that have the largest amount of movies from the given genre 
 */
function get2Genre() {

    $db = connectDB();

    $genre = $_POST['genre'];
    $query = ("
        SELECT a.first_name, a.last_name, COUNT(DISTINCT a.id) as count
        FROM roles as r
        JOIN actors as a ON r.actor_id = a.id
        JOIN movies_genres as g ON g.movie_id = r.movie_id
        WHERE g.genre = '$genre'
        GROUP BY a.id ORDER BY a.id
        LIMIT 1
    ");

    $prep = $db->prepare("$query");
    $prep->bindParam(1, $genre);
    $prep->execute();

    $result = array("from" => "2genre", "data" => array());

    foreach($prep as $row) {
        array_push($result["data"], array(
            "firstName" => $row["first_name"],
            "lastName" => $row["last_name"],
            "count" => $row["count"]
        ));
    }

    header("Content-Type: application/json");
    echo json_encode($result);

    closeDB($db);

} //Get 2 Genre

?>
