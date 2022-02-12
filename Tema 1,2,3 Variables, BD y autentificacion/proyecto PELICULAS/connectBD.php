<?php
    $mysqli = new mysqli("localhost","root","","proyectopeliculas");
    if($mysqli->connect_errno)
        echo "Error connecting to the database: (".$mysqli->connect_errno.") : ".$mysqli->connect_error;
?>