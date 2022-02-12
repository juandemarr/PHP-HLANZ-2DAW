<?php
/*Realizar una web que permita el registro/logeo de usuarios.
El administrador puede publicar peliculas {titulo, año, director, actores, cartel}
Los usuarios pueden valorarlas una sola vez con "la recomiendo" o "no la recomiendo"

Si da tiempo añadir categorias (generos). Poner category en header, lista de los que hay (con select de tabla categories.
Al pinchar, mostrar en index solo las de esa categoria*/

session_start();

if(!isset($_SESSION['rol']))
    $_SESSION['rol'] = 0;

if(isset($_GET['logout'])){
    $_SESSION['rol'] = 0;
}

//Connect to BD
include "connectBD.php";

//Leave a comment
if(isset($_POST['like']))
    if($_SESSION['rol'] > 0){
        if($result = $mysqli->query("select * from `ratings` where idUser = ".$_SESSION['id']." and idPelicula = ".$_POST['idPelicula']." and valoration = 1"))
            if($row = $result->fetch_row()){
                $errorUserRated = true;
            }else
                mysqli_query($mysqli,'insert into `ratings` values (NULL,'.$_SESSION['id'].','.$_POST['idPelicula'].','.$_POST['like'].')');
    }else
        $errorRating = true;

if(isset($_POST['dislike']))
    if($_SESSION['rol'] > 0){
        if($result = $mysqli->query("select * from `ratings` where idUser = ".$_SESSION['id']." and idPelicula = ".$_POST['idPelicula']." and valoration = 0"))
            if($row = $result->fetch_row()){
                $errorUserRated = true;
            }else
                mysqli_query($mysqli,'insert into `ratings` values (NULL,'.$_SESSION['id'].','.$_POST['idPelicula'].','.$_POST['dislike'].')');
    }else
        $errorRating = true;


//To count ratings
$numberLikes[0] = 0;
$numberDislikes[0] = 0;


//To delete films
//The foreign key configure to cascade to be able to delete it
//to see the result the page must be reload without the /index.php
if(isset($_POST['delete'])){
    if($result = $mysqli->query("delete from films where id = '".$_POST['delete']."'"))
        $deleteSuccessfull = true;
    else 
        $deleteSuccessfull = false;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!--CUSTOM STYLES-->
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <!--SWEETALERT2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--CUSTOM SCRIPT-->
    <script src="alert.js"></script>
</head>
<body class="bg-dark">
    <?php
        include "header.php";
    ?>
    
    <section class="container-md my-3 my-md-5">
    <h2 class="text-center mb-3 mb-md-5">My Top 5 Films</h2>
    <div class="row m-0 d-flex flex-wrap films">   
        <?php 
            if(isset($_GET['category'])){
                if($result = $mysqli->query("select films.id, title, year, director, actors, poster from 
                    films inner join films_category inner join category on films.id = films_category.idPelicula and 
                    films_category.idCategory = category.id where category.name = '".$_GET['category']."' ")){
                    while($row = $result->fetch_assoc())
                        $films[] = $row;
                    $result -> close();
                }
            }else{
                if($result = $mysqli->query("select * from films")){
                    while($row = $result->fetch_assoc())
                        $films[] = $row;
                    $result -> close();
                }
            }

            if(isset ($films) && count($films)){ 
                foreach($films as $film){
        ?>
                <div class="col p-2 p-md-4 mb-5 d-flex justify-content-between film">
                <?php 
                    echo '<div class="imgFilm mr-2">';
                        echo '<img src="'.$film['poster'].'" alt="'.$film['title'].'"/>';
                    echo '</div>';
                    echo '<div class="descriptionFilm">';
                        echo '<p class="title">'.$film['title'].'</p>';
                        echo '<p>Release year: '.$film['year'].'</p>';
                        echo '<p>Director: '.$film['director'].'</p>';
                        echo '<p>Actors: '.$film['actors'].'</p>';
                ?>
                        <div class="d-flex justify-content-between flex-column flex-md-row">
                            <?php
                            $numberLikes[0] = 0;
                            $numberDislikes[0] = 0;

                            //Inside the film's loop to have the idPeliculas
                            //Showing the rating. 
                            if($result = $mysqli->query("select count(id) from `ratings` where valoration = 1 and idPelicula = ".$film['id']." group by idPelicula")){
                                if($row = $result->fetch_row()){
                                    $numberLikes = $row;
                                }
                                $result->close();
                            }

                            if($result = $mysqli->query("select count(id) from `ratings` where valoration = 0 and idPelicula = ".$film['id']." group by idPelicula")){
                                if($row = $result->fetch_row()){
                                    $numberDislikes = $row;
                                }
                                $result->close();
                            }
                        
                            ?>
                            <?php
                            if(isset($_GET['category']))
                                echo '<form method="POST" action="index.php?category='.$_GET['category'].'">';
                            else
                                echo '<form method="POST" action="index.php">';
                                
                                    echo '<input type="hidden" name="idPelicula" value="'.$film['id'].'"/>'; 
                            ?>
                                    <button type="submit" name="like" value="1" class="btn"><img src="img/up.svg" alt="Like"/></button><?php echo $numberLikes[0] .' likes'; ?>
                                    <button type="submit" name="dislike" value="0" class="btn ml-4"><img src="img/down.svg" alt="Dislike"/></button><?php echo $numberDislikes[0] .' dislikes'; ?>
                                    <?php
                                        if(isset($errorRating))
                                            echo '<script>loginForRate()</script>';
                                        if(isset($errorUserRated))
                                            echo '<script>userAlreadyRated()</script>';
                                    ?>
                                </form>
                            <div class="d-flex">
                            <?php if($_SESSION['rol'] == 2){
                                echo '<form method="POST" action="edit.php">';
                                    echo '<button type="submit" class="btn btn-success mr-2" name="edit" value="'.$film['id'].'">Edit</button>';
                                echo '</form>';

                                if(isset($_GET['category']))
                                    echo '<form method="POST" action="index.php?category='.$_GET['category'].'">';
                                else
                                    echo '<form method="POST" action="index.php">';
                                        
                                        echo '<button type="submit" class="btn btn-danger" name="delete" value="'.$film['id'].'">Delete</button>';
                                    
                                        if(isset($deleteSuccessfull) && $deleteSuccessfull)
                                            echo '<script>deleteYes()</script>';
                                        if(isset($deleteSuccessfull) && !$deleteSuccessfull)
                                            echo '<script>deleteNo()</script>';
                                    echo '</form>';
                                }
                            ?>
                            </div>
                
                        </div>
                    </div>
                </div>  
        <?php 
                }
            }
        ?>
        
    </div>
    </section>

    <?php
        include "footer.php";
    ?>
    <!--BOOTSTRAP-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>