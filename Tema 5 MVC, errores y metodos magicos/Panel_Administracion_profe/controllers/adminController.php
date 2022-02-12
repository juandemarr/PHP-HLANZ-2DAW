<?php
if(isset($_GET['goadmin']))
    UserRepository::admin($_GET['goadmin'],2);
else if(isset($_GET['desadmin']))
    UserRepository::admin($_GET['desadmin'],1);
else if(isset($_GET['edit'])){
    if($user=UserRepository::getUserById($_GET['edit'])){
        require_once("views/editUserView.phtml");
        die();//para que no muestre la lista de usuarios, del mainController que aparece debajo de la llamada a este controller
    }
}
else if(isset($_GET['save'])){
    if(isset($_POST['user']) && isset($_POST['email'])){
        UserRepository::save($_GET['save'],$_POST['user'],$_POST['email']);
    }
}
else if(isset($_GET['del']))
    UserRepository::delete($_GET['del']);


?>