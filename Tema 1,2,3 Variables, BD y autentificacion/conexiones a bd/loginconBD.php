<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #main{
            width:100%;
            height:100vh;            
        }
        form{
            padding:3rem 2rem;
            background-color:#e1e1e1;
            border-radius:10px;
            width:30%;
            text-align:center;
            font-size:1.2rem;
            margin:2rem auto 0;
        }
        input{
            font-size:0.9rem;
            padding:0.25rem;
        }
        h2{
            margin:0 0 2rem;
        }
        h5{
            text-align:center;
        }
    </style>
</head>
<body>
<?php

//comprobar si hemos recibido $_POST
//obtener la fila del bd de $_POST y comporbar el nombre
//si existe, comprobar conrtaseña
//si contraseña es correcta, echo OK
$loged=false;
$error="";
//CONEXION
$mysqli = new mysqli("localhost", "root", "", "pruebaphp");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

if(isset($_POST["name"]) && isset($_POST["password"])){
    //CONSULTA
    if($result = $mysqli->query("select * from users where username='".$_POST["username"]."'")){
        if($row = $result->fetch_assoc()){ //no hay que usar while ya que solo dará un usuario con ese nombre
            //if($_POST["name"] == $row['username']){//no hace falta comprobar el usuario ya que de no existir no entraría
                if($_POST["password"] == $row['password'])
                    $loged=true;
                else $error = "Contraseña incorrecta";
            //}
        }else
            echo $error = "El usuario no existe";
    }
}
    

?>

    <section id="main">
        <?php
        if($loged)
            echo '<p>Hola '.$row["username"].' </p>';
        else{
            
        ?>
        <form method="POST" action="loginconBD.php">
            <h2>Login</h2>
            <label for="name">Nombre: </label>
            <input type="text" id="name" name="name" placeholder="Nombre" required/><br><br>

            <label for="password">Contraseña: </label>
            <input type="password" id="password" name="password" placeholder="Contraseña" /><br><br>
            
            <input type="submit" value="Entrar"/>
        </form>
        <?php
                if(isset($error))
                    echo '<h5>'.$error.'</h5>';
            }
        ?>
        
    </section>
</body>
</html>