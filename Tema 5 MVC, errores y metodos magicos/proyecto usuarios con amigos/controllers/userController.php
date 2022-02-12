<?php
if(isset($_GET['add'])){
    UserRepository::add($_SESSION['user']->id,$_GET['add']);
    header("location:index.php");
}else if(isset($_GET['delete'])){
    UserRepository::delete($_SESSION['user']->id);
    header("location:index.php");
}
?>