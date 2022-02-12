<?php
if(!isset($_SESSION['rol']))
    $_SESSION['rol'] = 0;

if(isset($_GET['logout'])){
    $_SESSION['rol'] = 0;
    session_destroy();
}

//Obtain categories
if($result = $mysqli->query("select * from category")){
    while($row = $result->fetch_assoc())
        $categories[] = $row;
    $result->close();
}

?>
<header class="px-3 py-1">
    <nav class="navbar navbar-expand-md navbar-dark px-0">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mr-2">
                    <a class="nav-link" href="index.php">Top films</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php
                            foreach($categories as $category)
                                echo '<a class="dropdown-item" href="index.php?category='.$category['name'].'">'.$category['name'].'</a>';
                        ?>
                    </div>
                </li>

            </ul>
            <?php
                if($_SESSION['rol'] > 0){
                 
            ?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="controlPanel.php">Control panel</a>
                </li>
     
                <li class="nav-item">
                    <a class="nav-link" href="index.php?logout">Log out</a>
                </li>
            </ul>
            <?php
                }else{
            ?>
            <ul class="navbar-nav">
                <li class="nav-item mr-2">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
            </ul>
            <?php
                }
            ?>
        </div>
    </nav>
</header>