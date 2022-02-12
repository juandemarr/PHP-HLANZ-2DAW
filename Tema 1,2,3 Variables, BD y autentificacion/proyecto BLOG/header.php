<header>
    <h1><a href="index.php">Los mejores libros</a></h1>
        <a class="userProfile" href="login.php"><img src="img/login.svg" alt="Login" id="loginIcon"/></a>
        <?php
        //var_dump($_SESSION['rol']);
        //echo "antes de decir hola: ".var_dump($_SESSION['loged'])."<br>";
            if($_SESSION['rol'] > 0){//if($_SESSION['loged'])
                
                echo "<p>Hola ".$_SESSION['user']."&nbsp;&nbsp;";
                echo "<a href='index.php?logout'>Cerrar sesión</a></p>";
                //este logout de la url despues de ? es la variable $_GET['logout']
            }
        ?>
</header>