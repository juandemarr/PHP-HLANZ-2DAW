<?php

if(isset($_GET['login'])){
if(isset($_POST["login"])){
    if($user=UserRepository::login($_POST['name'],$_POST['password'])){
        $_SESSION['user']=$user;
        header("location:index.php");
    }else require_once("views/loginView.phtml");
}else require_once("views/loginView.phtml");
}


if(isset($_GET['register'])){
if(isset($_POST['register'])){
    if(!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['password2']) && !empty($_POST['email']) && $_POST['password'] == $_POST['password2']){
        UserRepository::register($_POST['name'],$_POST['password'],$_POST['email']);
        header("location:index.php");
    }else require_once("views/registerView.phtml");
}else require_once("views/registerView.phtml");
}



?>