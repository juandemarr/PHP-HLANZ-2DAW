<?php
require_once("models/userModel.php");
require_once("models/userRepository.php");
require_once("models/mainRepository.php");
session_start();

if(!isset($_SESSION['user'])){
    $_SESSION['user']=NULL;
}

if(isset($_GET['logout'])){
    session_destroy();
    header("location:index.php");
}

if(isset($_GET['login']) || isset($_GET['register'])){//Otra solucion seria hacer dos controladores: login y register
    require_once("controllers/loginController.php");
    die();
}else if(isset($_SESSION['user'])){
    if($_SESSION['user']->getRol()==2)
        require_once("views/adminView.phtml");
    else if($_SESSION['user']->getRol()==1)
        require_once("views/userView.phtml");
}else require_once("views/mainView.phtml");


if(isset($_POST['update'])){
    MainRepository::updateUser($_POST['id'],$_POST['name'],$_POST['email'],$_POST['rol']);
    //hay que recargar la pagina desde la url para que se actualice la vista
}
?>