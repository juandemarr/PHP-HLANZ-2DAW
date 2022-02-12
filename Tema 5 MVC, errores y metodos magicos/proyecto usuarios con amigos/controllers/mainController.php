<?php
require_once("models/userModel.php");
require_once("models/userRepository.php");

session_start();

if(!isset($_SESSION['user'])){
    $data['id']=0;
    $data['username']="";
    $data['email']="";
    $data['rol']=0;
    $_SESSION['user'] = new User($data);
}

if(isset($_GET['login'])){
    require_once("controllers/loginController.php");
    die();
}else if(isset($_GET['user'])){
    require_once("controllers/userController.php");
    die();
}

if($_SESSION['user']->rol>0){
    $users=UserRepository::list();
    $friends=UserRepository::friends($_SESSION['user']->id);
    $nofriends=UserRepository::noFriends($_SESSION['user']->id);
    require_once("views/mainView.phtml");
}else
    require_once("views/loginView.phtml");

?>