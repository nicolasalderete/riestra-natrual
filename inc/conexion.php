<?php

    //$db = pg_connect($_ENV["DATABASE_URL"])
    //or die('No se ha podido conectar: ' . pg_last_error());

    $db =  pg_connect($_ENV["DATABASE_URL"])
    or header("location: error.html");

?>