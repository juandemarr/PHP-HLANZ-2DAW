<?php
session_start();

//Connect to BD
include "connectBD.php";

//To edit films
if(isset($_POST['title']) && isset($_POST['year']) && isset($_POST['director']) && isset($_POST['actors']) && isset($_POST['poster'])){
    if(mysqli_query($mysqli,'update `films` set `title` = "'.$_POST['title'].'",`year` = "'.$_POST['year'].'",
        `director` = "'.$_POST['director'].'",`actors` = "'.$_POST['actors'].'",`poster` = "'.$_POST['poster'].'" where id = "'.$_POST['edit'].'"'))
        $editSuccess = true;
    else
        $editSuccess = false;
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
    <div class="row">
        <form class="col-md-6 offset-md-3 col-10 offset-1" action="edit.php" method="POST">
            <h2 class="text-center mb-3 mb-md-4">Edit film</h2>
            <?php
                if($result = $mysqli->query("select * from films where id = '".$_POST['edit']."'")){
                    if($row = $result->fetch_assoc()){
                        $filmToEdit = $row;
                        
                        echo '<div class="form-group">';
                        echo '<label for="title">Title:</label>';
                        echo '<input type="text" class="form-control" name="title" id="title" value="'.$filmToEdit["title"].'" required/>';
                        echo '</div>';

                        echo '<div class="form-group">';
                        echo '<label for="year">Year:</label>';
                        echo '<input type="text" class="form-control" name="year" id="year" value="'.$filmToEdit["year"].'" required/>';
                        echo '</div>';

                        echo '<div class="form-group">';
                        echo '<label for="director">Director:</label>';
                        echo '<input type="text" class="form-control" name="director" id="director" value="'.$filmToEdit["director"].'" required/>';
                        echo '</div>';

                        echo '<div class="form-group">';
                        echo '<label for="actors">Actors:</label>';
                        echo '<input type="text" class="form-control" name="actors" id="actors" value="'.$filmToEdit["actors"].'" required/>';
                        echo '</div>';

                        echo '<div class="form-group">';
                        echo '<label for="poster">Img Path:</label>';
                        echo '<input type="text" class="form-control" name="poster" id="poster" value="'.$filmToEdit["poster"].'" required/>';
                        
                        if(isset($_POST['edit']))
                            echo '<input type="hidden" name="edit" value="'.$_POST['edit'].'"';
                            //nombrar igual el name que el $_POST que recibe, para reenviar el mismo dato. 
                            //De esta forma siempre existirá
                        echo '</div>';
                        
                        echo '<div class="d-flex justify-content-center mt-4">';
                        echo '<button type="submit" class="btn btn-success">Save changes</button>';
                        echo '</div>';
                        
                    }
                    $result->close();
                }

                    if(isset($editSuccess) && $editSuccess)
                        echo '<script>editYes()</script>';
                    if(isset($editSuccess) && !$editSuccess)
                        echo '<script>editNo()</script>';
                      
            ?>
        </form>
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