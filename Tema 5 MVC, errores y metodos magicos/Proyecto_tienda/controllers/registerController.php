<?php
if(isset($_POST['register'])){
    if(!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST["password2"]) && 
    !empty($_POST["email"]) && $_POST["password"] == $_POST["password2"]){
        UserRepository::register($_POST['name'],$_POST['password'],$_POST["email"]);
        require_once("views/loginView.phtml");
    }else{
        require_once("views/registerView.phtml");
    }
}else{
    require_once("views/registerView.phtml");
}
?>