<?php
    if(isset($_GET['addFriend'])){
        UserRepository::addFriend($_GET['addFriend']);
    }
    else if(isset($_GET['delFriend'])){
        UserRepository::delFriend($_GET['delFriend']);
    }
?>