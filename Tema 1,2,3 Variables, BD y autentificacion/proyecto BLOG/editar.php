<?php
session_start();
if(isset($_GET['logout'])){
    $_SESSION['rol'] = 0;
    session_destroy();
}
if(!isset($_SESSION['rol'])){
    $_SESSION['rol'] = 0;
}

include "bd.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <?php
        include "header.php";
    ?>
    <section id="main">
        <section class="editarLibros">
            
            <?php
                //editamos articulo
                if($_SESSION['rol'] == 2){
                    if($result = $mysqli->query("select * from libros where id='".$_GET['editar']."'")){
                        if($row = $result->fetch_assoc()){
                            $article = $row;
                        
                echo '<form action="editar.php?editar='.$_GET["editar"].'" method="POST" class="formularioEditar">';
                    echo '<h2>Editar</h2>';

                    echo '<label for="tituloLibro">Título:</label>';
                    echo '<input type="text" name="tituloLibro" id="tituloLibro" value="'.$article["titulo"].'" required/>';

                    echo '<label for="imgLibro">Ruta imágen:</label>';
                    echo '<input type="text" name="imgLibro" id="imgLibro" value="'.$article["img"].'" required/>';

                    echo '<label for="textoLibro">Descripción:</label>';
                    echo '<input type="text" name="textoLibro" id="textoLibro" value="'.$article["texto"].'" required/>';

                    

                    echo '<input type="submit" value="Añadir"/>';

                echo '</form>';
                

                /*UPDATE `libros` SET `id`=[value-1],`titulo`=[value-2],`texto`=[value-3],`autor`=[value-4],`fecha`=[value-5],`img`=[value-6] WHERE 1*/
                //hacer que el autor que se inserte sea el que haya iniciado sesion

                if(isset($_POST["tituloLibro"]) && isset($_POST["imgLibro"]) && isset($_POST["textoLibro"])){
                    $sql = "update `libros` set `titulo`='".$_POST["tituloLibro"]."',`img`='".$_POST["imgLibro"]."',`autor`='".$_SESSION["user"]."',`texto`='".$_POST["textoLibro"]."' where id='".$article["id"]."'";
                    
                    if(mysqli_query($mysqli,$sql))
                        echo "<p>Libro editado correctamente</p>";
                    else
                        echo "<p>No se pudo editar</p>";
                            
                    }
                }
                $result->close();
            }
        }
        else header("location:index.php");
            //autor, hora, nombre articulo, texto (solo se muestra a rellenar), id 
            //si ha iniciado sesion que se muestre para poner comentarios
            //crear tabla de comentarios en base de datos
            //input type="hidden" name="idArticulo" value="idArticulo" añadir en el form de comentarios
            
            ?>

        </section>
    </section>
    <?php
        include "footer.php";
    ?>
</body>
</html>