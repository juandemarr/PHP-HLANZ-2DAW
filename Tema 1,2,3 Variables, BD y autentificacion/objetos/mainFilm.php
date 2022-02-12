<?php
    //connect to BD
    $mysqli = new mysqli("localhost","root","","proyectopeliculas");
    if($mysqli->connect_errno)
        echo "Error connecting to the database: (".$mysqli->connect_errno.") : ".$mysqli->connect_error;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Film</title>
</head>
<body>
    <?php
    include 'classFilm.php';

    $movies = null;

    if($result = $mysqli->query('select * from films')){
        while($row = $result->fetch_assoc()){
            $movies[] = new Movie($row);//equivalente al .push de javascript, rellena el array de objetos movie individuales
        }
    }
    
    foreach($movies as $movie){
        echo $movie->getTitle().'<br/>';
    }

    ?>
</body>
</html>
