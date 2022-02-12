<?php
//Hacer una pag aparte para editar el libro. Que ese boton le aparezca solo al autor de su libro y pueda editar y borrar
//Cualquiera regsitrado puede escribir comentarios, comprobar con rol == 0, equivalente a isset($_SESSION['loged'])
//mostrar comentarios
//responder comentarios
//si el rol es admin podra borrar comentarios tbn. logueados (rol distinto de 0) pueden crearlos
//los usuarios registrados le pueden dar me gusta al articulo

    session_start();//siempre necesario al principio de todas las paginas que trabajen con la variable $_SESSION
    
    if(isset($_GET['logout'])){
        //$_SESSION['loged'] = false;
        $_SESSION['rol'] = 0;
        session_destroy();
    }
     if(!isset($_SESSION['rol'])){//$_SESSION['loged']
        //$_SESSION['loged'] = false;
        $_SESSION['rol'] = 0;
    }
    
    //conectar BBDD
    include "bd.php";


    //borramos articulos
    if($_SESSION['rol'] == 2 && isset($_GET['borrar'])){//if($_SESSION['loged']
        $result = $mysqli->query("delete from libros where id='".$_GET['borrar']."'");
    }


    //cargamos articulos
    if($result = $mysqli->query("select * from libros")){
        while($row = $result->fetch_assoc()){
            $articles[] = $row;
        }
        $result->close();
    }


    //enviar comentarios
    if($_SESSION['rol'] > 0 && isset($_POST["comentario"])){//if($_SESSION['loged']
        mysqli_query($mysqli, "insert into `comentarios` (`id`,`autor`,`fecha`,`idArticulo`,`comentario`)
            values (NULL, '".$_SESSION['user']."','".date("Y-m-d")."','".$_POST["idArticulo"]."','".$_POST["comentario"]."')");  
    }


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mejores libros</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <?php
        include "header.php";
    ?>
    <section id="main">

        <section class="seccionLibros">
        
        <?php
            if(count($articles)){//existe mas de cero, ya que cero es false
                foreach($articles as $article){
                    echo '<div class="libro">';
                        echo '<img class="imgLibro" src="'.$article["img"].'"/>';
                        echo '<div class="datosLibro">';
                            echo '<h3>'.$article["titulo"].'</h3>';
                            echo '<p class="negrita">'.$article["autor"].'</p>';
                            echo '<p>'.$article["fecha"].'</p>';
                            echo '<p>'.$article["texto"].'</p>';

                            if($_SESSION['rol'] > 0 && $_SESSION['user'] == $article['autor']){//o que sea admin
                                echo '<div class="botonesLibro">';
                                    echo "<button><a href='index.php?borrar=".$article['id']."'>Borrar</a></button>";
                                    echo "<button><a href='editar.php?editar=".$article['id']."'>Editar</a></button>";
                                echo '</div>';
                            }
                        echo '</div>';
                        
                        echo '<div class="comentariosContenedor">';
                            if($_SESSION['rol'] > 0){
                                echo '<form action="index.php" method="POST"/>';
                                    echo '<label for="comentario">Escribe un comentario:</label>';
                                    echo '<textarea name="comentario" id="comentario"></textarea>';
                                    echo '<input type="hidden" name="idArticulo" value="'.$article["id"].'"/>';
                                    echo '<input type="submit" value"Enviar"/>';
                                echo '</form>';
                            }

                            //mostrar comentarios
                            $comentarios = null;
                            if($result = $mysqli->query("select * from comentarios where idArticulo = ".$article["id"])){
                                while($row = $result->fetch_assoc()){
                                    $comentarios[] = $row;
                                }
                            }$result->close();
                            
                            if($comentarios != null){//if(count($comentarios){
                                echo '<h4 id="tituloComentarios">Comentarios</h4>';
                                echo '<div class="mostrarComentarios">';
                                    foreach($comentarios as $comentario){
                                        //var_dump($comentario);
                                        //echo"<br>";
                                        //var_dump($article["id"]);
                                        echo '<div class="mostrarUnComentario">';
                                            echo '<div>';
                                                echo '<p class="negrita">'.$comentario["autor"].': </p>';
                                                echo '<p class="cursiva">'.$comentario["fecha"].'</p>';
                                            echo '</div>';
                                            echo '<p class="comentarioDeAutor">'.$comentario["comentario"].'</p>';
                                        echo '</div>';
                                    }
                                    //unset($comentarios);
                                    $comentarios = null;
                                //}
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                }
            }    

        ?>
        
        </section>

    </section>
    <?php
        include "footer.php";
    ?>
</body>
</html>