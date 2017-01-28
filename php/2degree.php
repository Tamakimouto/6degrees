<?php
include "common.php";

GET2DEGREE();

function get2Degree(){

    try{

        $connection = "mysql:host=localhost;dbname=kevinbacondatabase";
        $user = "generaluser";
        $password = "password";
        $db = new PDO($connection,$user,$password);

        $fname = "Tom";
        $lname = "Cruise";


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

        //Test Query
        foreach($prep as $row) {
            echo $row['first_name'] . " " . $row['last_name'] .
                " " . $row['actor_id'] . " " . $row['movie_id'] . " ". $row['role'] . "<br/>";
        }


        //Close Connection
        $db = null;

    }catch(PDOException $e){

        echo "Connection Error Message: " . $e->getMessage() . "<br/>";
        die();
    }



}//Get 1 Degree