<?php
if(isset($_GET['admin-products'])){
    if(isset($_POST["addProduct"])){
        if(!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['image']) && 
        !empty($_POST['price']) && !empty($_POST['quantity'])){
            ProductRepository::addProduct($_POST['name'],$_POST['description'],$_POST['image'],$_POST['price'],$_POST['quantity']);
            header("location:index.php?admin-products");
        }
    }else if(isset($_GET['edit'])){
        $product = ProductRepository::listProductById($_GET['edit']);
        require_once("views/editProduct.phtml");
            
        if(isset($_POST['editProduct'])){
            if(!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['image']) && 
            !empty($_POST['price']) && !empty($_POST['quantity'])){
                ProductRepository::editProduct($_GET['edit'],$_POST['name'],$_POST['description'],$_POST['image'],$_POST['price'],$_POST['quantity']);
                header("location:index.php?admin-products");
            }
        }
    }else if(isset($_GET['delete'])){
        ProductRepository::deleteProduct($_GET['delete']);
        header("location:index.php?admin-products");        
    }else{
        //if($products = ProductRepository::listProducts())
        $products = ProductRepository::listProducts();
            //require_once("views/addProduct.phtml");
        require_once("views/addProduct.phtml");   
    }
}else if(isset($_GET['admin-users'])){
    if(isset($_GET['reset'])){
        require_once("views/resetUser.phtml");
        if(isset($_POST['resetPassword']) && !empty($_POST['password']) && !empty($_POST['password2']) && 
        $_POST['password'] == $_POST['password2']){
            UserRepository::resetPassword($_GET['reset'],$_POST['password']);
            header("location:index.php?admin-users");
        }
    }else if(isset($_GET['delete'])){
        UserRepository::deleteUser($_GET['delete']);
        header("location:index.php?admin-users");
    }else if(isset($_GET['activate'])){
        UserRepository::activateUser($_GET['activate']);
        header("location:index.php?admin-users");
    }else{
        $users = UserRepository::listUsers();
        require_once("views/listUsers.phtml");
    }
}

?>