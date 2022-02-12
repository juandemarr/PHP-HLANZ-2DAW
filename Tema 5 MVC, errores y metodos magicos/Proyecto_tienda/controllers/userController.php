<?php
if(isset($_GET['add'])){
    if(isset($_SESSION['user'])){
        $product = ProductRepository::listProductById($_GET['add']);
        if(ProductRepository::checkQuantity($product->id)){
            if(CartRepository::existsProductCart($product->id)){
                CartRepository::updateQuantity($product->id,$product->price);
            }else{
                CartRepository::addCart($_SESSION['user']->id,$product->id,$product->name,$product->img,$product->price,1);
            }
            header("location:index.php");
        }
        echo '<script>alert("There is not stock");
                    window.location.href="index.php"
            </script>';
    }else echo '<script>alert("You have to be logged in to buy");
                window.location.href="index.php"</script>';
}else if(isset($_GET['show'])){
    $cartProducts = CartRepository::listCart(); 
    require_once("views/cartView.phtml");
}else if(isset($_GET['delete'])){
    CartRepository::deleteCart();
    header("location:index.php?cart&show");
}else if(isset($_GET['create'])){
    $numberProducts = CartRepository::numberProducts();
    $totalPrice = CartRepository::totalPrice();
    $actualDate = new DateTime();
    $pastDate = $actualDate->format("d-m-Y H:i:s");
    OrderRepository::createOrder($_SESSION['user']->id,$pastDate,$numberProducts,$totalPrice);
    OrderRepository::createDetailOrder($_SESSION['user']->id,$pastDate);
    CartRepository::deleteCart();
    $orders = OrderRepository::listOrders();
    require_once("views/ordersView.phtml");
    
}else if(isset($_GET['orders'])){
    $orders = OrderRepository::listOrders();
    require_once("views/ordersView.phtml");
}
?>