<?php

connectToDatabase();

/**
 *
 */
function connectToDatabase(){

    try{

        $connection = "mysql:host=localhost;dbname=kevinbacondatabase";
        $user = "generaluser";
        $password = "password";
        $db = new PDO($connection,$user,$password);


        //Test Query
        foreach($db->query('SELECT * FROM actors WHERE 1') as $row) {
            echo $row['first_name'] . "<br/>";
        }


        //Close Connection
        $db = null;

    }catch(PDOException $e){

        echo "Connection Error Message: " . $e->getMessage() . "<br/>";
        die();
    }



}//Connect to Database






?>