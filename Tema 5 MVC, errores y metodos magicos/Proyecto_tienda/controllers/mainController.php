<?php
//load the models and repositories
require_once("models/UserModel.php");
require_once("models/UserRepository.php");
require_once("models/ProductModel.php");
require_once("models/ProductRepository.php");
require_once("models/CartProductModel.php");
require_once("models/CartRepository.php");
require_once("models/OrderModel.php");
require_once("models/OrderRepository.php");

session_start();

if(!isset($_SESSION['user'])){
    $data['idUser']=0;
    $data['nameUser']="";
    $data['email']="";
    $data['rol']=0;
    $_SESSION['user'] = new User($data);
}    

//dirigir a los controladores correctos
if(isset($_GET['login'])){
    require_once("controllers/loginController.php");
    die();
}else if(isset($_GET['register'])){
    require_once("controllers/registerController.php");
    die();
}else if(isset($_GET['admin-products']) || isset($_GET['admin-users'])){
    require_once("controllers/adminController.php");
    die();
}else if(isset($_GET['cart'])){
    require_once("controllers/userController.php");
    die();
}else if(isset($_GET['logout'])){
    session_destroy();
    header("location:index.php");
}
    
//cargar las vistas
if($_SESSION['user']->rol == 1){
    $products = ProductRepository::listProducts();
    require_once("views/productsView.phtml");
}else if($_SESSION['user']->rol == 2){
    require_once("views/adminView.phtml");
}else{
    $products = ProductRepository::listProducts();
    require_once("views/productsView.phtml");
}
?>