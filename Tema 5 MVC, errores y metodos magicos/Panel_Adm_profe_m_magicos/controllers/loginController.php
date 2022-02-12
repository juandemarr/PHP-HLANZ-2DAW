<?php
if(isset($_POST['logeo'])){
    if($u=UserRepository::login($_POST['user'],$_POST['password']))
        $_SESSION['user']=$u;
    if($_SESSION['user']->rol>0)
        header('location:index.php');
    else
        require_once("views/LoginView.phtml");
}
else if(isset($_GET['logout'])){//mejor ponerlo anidado,mas eficiente, y arriba lo mas probable. 
    //Se pone en este controller porque tienen suficiente entidad para estar en el login. Aun asi daria
    // "igual" si va en el mainController
    session_destroy();
    header('location:index.php');
}
else if(isset($_POST['registro'])){
    if(!empty($_POST['user']) && !empty($_POST['password']) && !empty($_POST['email']) && $_POST['password'] == $_POST['password2']){
        UserRepository::register($_POST['user'],$_POST['password'],$_POST['email']);
        //header('location:index.php');//require_once cuando no hay que cargar ningun dato, 
        //para cargar la info y necesitar de datos se usa header("location:")
        require_once('views/LoginView.phtml');
    }else
        require_once('views/LoginView.phtml');
}
else require_once("views/LoginView.phtml");


?>