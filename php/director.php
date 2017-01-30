<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * director.php
 *
 * Finds actors who also directed a movie. To be used as an Ajax call
 * sending with POST variables as needed.
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

getDirectors();

/**
 * getDirectors
 *
 * Connects to database defined in Common.php and runs query to
 * get actors who are also directors.
 */

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
