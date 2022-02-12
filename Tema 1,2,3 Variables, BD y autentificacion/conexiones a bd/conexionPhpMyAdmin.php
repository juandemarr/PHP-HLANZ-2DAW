<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //localhost/phpmyadmin
        //id como pimary key. Autoincremento por defecto
        
        //CONEXION
        $mysqli = new mysqli("localhost", "root", "", "pruebaphp");//usuario root de xampp para acceder, sin contraseña
        if ($mysqli->connect_errno) { //la flecha sustituye al punto, para llamar al metodo del objeto
            echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        //echo $mysqli->host_info . "\n";

        var_dump($mysqli);//comprobacion
        echo "<br><br>";

        //CONSULTAS
        if($result = $mysqli->query("select * from users where username='admin'")) //no se puede hacer echo de result al ser un objeto
                            //si es select de una columna, sera row[0] al haber solo una columna
            $row = $result->fetch_row(); //coger el resultado con forma de fila y lo mete en row, es un array.
                                        //solo 1 fila, para varios en bucle
            echo 'El usuario encontrado es: '.$row[1];//el 0 es el id, el 1 el username (segun las columans de la fila)
            $result->close();//close para cerrar este objeto
        
        echo "<br><br>";
        /////////////////////////////    
        if($result = $mysqli->query("select * from users where username='admin'")) 
            $row = $result->fetch_assoc();//array asociativo, con nombres de columnas
            echo 'El usuario encontrado es: '.$row['username'].' con contraseña '.$row['password'];
            $result->close();
        echo "<br><br>";
        /////////////////////////////
        //Para varios resultados
        if($result = $mysqli->query("select * from users")){ 
            while($row = $result->fetch_assoc()){//mientras haya resultados hace el bucle
                echo 'El usuario encontrado es: '.$row['username'].' con contraseña '.$row['password'].'<br>';
            }
            $result->close();
        }



    ?>
</body>
</html>
