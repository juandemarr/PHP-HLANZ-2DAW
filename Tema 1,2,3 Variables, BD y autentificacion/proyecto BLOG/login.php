<?php
    session_start();//siempre necesario al principio para poder usar $_SESSION
    
    if(isset($_GET['logout'])){
        //$_SESSION['loged'] = false;
        $_SESSION['rol'] = 0;
        session_destroy();
    }
    if(!isset($_SESSION['rol'])){//if(!isset($_SESSION['loged']))
        //$_SESSION['loged'] = false;
        $_SESSION['rol'] = 0;
        //echo "creo loged<br>";//solo aparece la primera vez que nos metemos en la pagina, dsp ya esta creado
    }
    //echo "antes de todo: ".var_dump($_SESSION['loged'])."<br>";

    //conectar BBDD
    include "bd.php";

    //$login = false;

    //comprobar si hemos recibido $_POST
    if(isset($_POST["nombreUsuario"]) && isset($_POST["contrasenaUsuario"]))
        //realizar la consulta select from users where usrname=post. 
        //Esto nos ahorra hacer un while para comprobar todas las filas de la tabla usuario, ya que tenemos a uno solo
        if($result = $mysqli->query("select * from usuarios where name='".$_POST['nombreUsuario']."'")){
            if($row = $result->fetch_assoc()){ //si existe ese usuario comprobamos contraseña
                if($row["password"] == $_POST["contrasenaUsuario"]){
                    //$login = true;
                    //$_SESSION['loged'] = true;
                    $_SESSION['user'] = $row['name'];
                    $_SESSION['userid'] = $row['id'];
                    $_SESSION['rol'] = $row['rol'];
                    //echo "despues de logear: ".var_dump($_SESSION['loged'])."<br>";
                    header("location: index.php");//redirecciona, al ser correcto se va al index
                }
                else $error = "Error en la contraseña";
        }
        else $error = "El usuario no existe";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <?php
        include "header.php";
    ?>
    <section id="main">
    
    <?php
        if($_SESSION['rol'] > 0){//if($_SESSION['loged'])
            if($_SESSION['rol'] === 2)
                include "formAnadir.php";
            
        }else{

    ?>    

        <form action="login.php" method="POST" class="formularioLogin">
            <h2>Iniciar sesión</h2>

            <label for="nombreUsuario">Nombre de usuario:</label>
            <input type="text" id="nombreUsuario" name="nombreUsuario" required/>

            <label for="contrasenaUsuario">Contraseña de usuario:</label>
            <input type="password" id="contrasenaUsuario" name="contrasenaUsuario" required/>

            <input type="submit" value="Iniciar sesion"/>
        </form>

        <?php
            /* if($login)
                include 'formAnadir.php'; */
            
            if(isset($error))
                echo "<h5>".$error."</h5>";

        }

        ?>

    </section>
    <?php
        include "footer.php";
    ?>
</body>
</html>