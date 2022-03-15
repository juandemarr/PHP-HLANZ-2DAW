<?php
if(isset($_POST['logeo'])){
    if($u=UserRepository::login($_POST['user'],$_POST['password'])){
        $_SESSION['user']=$u;
        header('location:index.php');
    }else
        require_once("views/LoginView.phtml");
}
else if(isset($_GET['logout'])){
    session_destroy();
    header('location:index.php');
}
else if(isset($_POST['registro'])){
    if(!empty($_POST['user']) && !empty($_POST['password']) && !empty($_POST['email']) && $_POST['password'] == $_POST['password2']){
        UserRepository::register($_POST['user'],$_POST['password'],$_POST['email']);
        require_once('views/LoginView.phtml');
    }else
        require_once('views/LoginView.phtml');
}
else require_once("views/LoginView.phtml");


?>