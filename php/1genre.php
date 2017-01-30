<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * 1genre.php
 *
 * Gets the most "popular" genre, as in the one
 * with the most movies.
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

get1Genre();

/**
 * get1Genre
 *
 * Gets Genre with the Largest Movie Count.
 */
function get1Genre() {

    $db = connectDB();

    $query = ("
        SELECT g.genre, COUNT(g.movie_id) as MovieCount FROM movies_genres g
        GROUP BY g.genre HAVING COUNT(g.movie_id) =
            (SELECT COUNT(g2.movie_id) tc FROM movies_genres g2
            GROUP BY g2.genre ORDER BY tc DESC LIMIT 1)
    ");

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
