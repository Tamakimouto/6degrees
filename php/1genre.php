<?php

include "common.php";

get1genre();

function get1genre(){

    try{

        $connection = "mysql:host=localhost;dbname=kevinbacondatabase";
        $user = "generaluser";
        $password = "password";
        $db = new PDO($connection,$user,$password);



        $query = "SELECT genre,count(*) as MovieCount FROM movies_genres group by genre ORDER BY MovieCount DESC ";

        $prep = $db->prepare("$query");
        $prep->execute();

        //Test Query
        foreach($prep as $row) {
            echo $row['genre'] . " " . $row['MovieCount'] . "<br/>";
        }


        //Close Connection
        $db = null;

    }catch(PDOException $e){

        echo "Connection Error Message: " . $e->getMessage() . "<br/>";
        die();
    }



}//Get Genre