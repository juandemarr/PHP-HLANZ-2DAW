<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav w-100">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <div class="d-flex flex-column flex-sm-row ml-sm-auto">
            <?php 
            if($_SESSION['user']->rol > 0){
                echo '<li class="nav-item"><span class="nav-link no-hover">Hello '.$_SESSION['user']->name.'</span></li>';
                if($_SESSION['user']->rol == 1){
                    echo '<li class="nav-item"><a class="nav-link" href="index.php?cart&show">Cart</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="index.php?cart&orders">Orders</a></li>';
                }
                echo '<li class="nav-item"><a class="nav-link" href="index.php?logout">Log out</a></li>';
            }
            else{
                echo '<li class="nav-item"><a class="nav-link" href="index.php?login">Log in</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="index.php?register">Register</a></li>';
            }
            ?>
            </div>
        </ul>
    </div>
</nav>