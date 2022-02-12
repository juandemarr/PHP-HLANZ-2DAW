<?php
if(isset($_POST['submit'])){
    if($u = UserRepository::login($_POST['name'],$_POST['password'])){
        $_SESSION['user'] = $u;
        header('location:index.php');
    }else require_once("views/loginView.phtml");
    
}else require_once("views/loginView.phtml");

?>