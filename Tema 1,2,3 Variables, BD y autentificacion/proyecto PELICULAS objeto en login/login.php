<?php
session_start();

//Connect to BD
include "connectBD.php";

//Add classUser
include 'classUser.php';

//LOGIN
if(isset($_POST['username']) && isset($_POST['password'])){
    if($result = $mysqli->query("select * from users where username = '".$_POST['username']."'"))
        if($row = $result->fetch_assoc()){
            $usuario = new User($row);
            if($usuario->check($_POST['username'], $_POST['password'])){
                $_SESSION['username'] = $usuario->getUsername();
                $_SESSION['rol'] = $usuario->getRol();
                $_SESSION['id'] = $usuario->getId();
                header("location:index.php");
            }else $error = "<p>Incorrect password</p>";
        }else $error = "<p>Incorrect username</p>";
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
</head>
<body class="bg-dark">
    <?php
        include "header.php";
    ?>
    <section class="container-md my-3 my-md-5">
    <div class="row">
        <form class="offset-lg-4 col-lg-4 offset-lg-4 offset-md-3 col-md-6 offset-md-3 offset-1 col-10 offset-1" action="login.php" method="POST">
            <h2 class="text-center mb-3 mb-md-4">Login</h2>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <?php
                if(isset($error))
                    echo '<p class="italic text-danger">'.$error.'</p>';
            ?>

            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-success m-auto">Login</button>
            </div>
        </form>
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