<?php



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
