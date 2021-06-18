<?php

    //$db = pg_connect($_ENV["DATABASE_URL"])
    //or die('No se ha podido conectar: ' . pg_last_error());
    // env heroku
    //      postgres://uxctgnjrjcnmka:bc44443153074ced85b5fce0a980c5c9f5b6b2737f25465237272260ea7c1657@ec2-52-4-111-46.compute-1.amazonaws.com:5432/d7k960oqb8t2g
    // env local 
    //      host=localhost:5423 dbname=dietetica user=restra_natural password=1q2w3e4r
    if ($_SERVER["DATABASE_URL"]) 
    {
        $db = pg_connect($_SERVER["DATABASE_URL"]) or header("location: error.html");
    } else {
        $db = pg_connect($_ENV["DATABASE_URL"]) or header("location: error.html");
    }
    //$db = pg_connect("host=localhost dbname=dietetica user=postgres password=1q2w3e4r") or header("location: error.html");

?>