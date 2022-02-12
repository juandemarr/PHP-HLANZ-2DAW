<?php
require_once("models/UserModel.php");
require_once("models/UserRepository.php");

session_start();
//3 partes, usuario vacio, redirigir al controlador adecuado, vista que mostrar

if(!isset($_SESSION['user'])){
    $datos['id']=0;
    $datos['username']="";
    $datos['rol']=0;
    $datos['email']="";
    $datos['visible']=0;
    $_SESSION['user'] = new User($datos);
}

if(isset($_GET['login'])){
    require_once("controllers/LoginController.php");
    die();
}

if(isset($_GET['admin'])){
    require_once("controllers/adminController.php");
    //el die() se le puso en el adminController
}
if(isset($_GET['user'])){
    require_once("controllers/userController.php");
    //die();
}

if($_SESSION['user']->rol==2){
    if($users=UserRepository::list())//al asignarle NULL a la variable, seria if(NULL) y eso es falso
    require_once('views/adminView.phtml');
}else if($_SESSION['user']->rol==1){
    if($users=UserRepository::list())
    require_once('views/mainView.phtml');
}
    
else require_once('views/LoginView.phtml');


?>