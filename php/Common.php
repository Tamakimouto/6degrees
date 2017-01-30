<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Common.php
 *
 * The main SQL config file for the project.
 *
 * PHP 5
 *
 * @category    Project1
 * @author      Anthony Zheng <Anthony@anthonyzing.me>
 * @author      Terrence Butler <tbbutle@uga.edu>
 * @author      Nghia Le <nghiathanle.25@gmail.com>
 * @since       Created January 22, 2017
 */

/**
 * connectDB
 *
 * Connects to database with the set config.
 *
 * @access  public
 * @return  PDO     A PDO instance representing our current db connection.
 *
 * @throws  PDOException
 */
function connectDB() {

    /* Connection Configs */
    $user = "root";
    $pass = "10068366";
    $dbname = "kevinbacondatabase";
    $host = "localhost";

    try {

        $source = "mysql:host=$host;dbname=$dbname";
        $db = new PDO($source, $user, $pass);

        return $db;

    } catch (PDOException $e) {

        echo "Connection Error Message: " . $e->getMessage() . "<br/>";
        die();

    }
}


/**
 * closeDB
 *
 * Closes the database connection given as param.
 *
 * @access  public
 * @param   PDO     $db     A PDO instance representing the connection
 *                          to be closed.
 *
 * @throws  PDOException
 */
function closeDB($db) {
    $db = null;
}

?>
