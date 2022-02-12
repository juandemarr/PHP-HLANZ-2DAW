<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ej img</title>
    <style>
        img{
            width:200px;
            margin-right:1rem;
        }
    </style>
</head>
<body>
    <?php
        //CONEXION
        $mysqli = new mysqli("localhost", "root", "", "pruebaphp");
        if ($mysqli->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }

        var_dump($mysqli);
        echo "<br><br>";

        //CONSULTAS
        if($result = $mysqli->query("select*from urls"))
            while($row=$result->fetch_assoc()){
                echo '<a href="'.$row["url"].'"><img src="'.$row["rutaimg"].'" title="'.$row["nombre"].'"/></a>';
            }
            $result->close();
    ?>
</body>
</html>