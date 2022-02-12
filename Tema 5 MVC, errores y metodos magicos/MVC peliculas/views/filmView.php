<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
</head>
<body>
    <?php
        if(!empty($info))
            echo '<script>alert("'.$info.'")</script>';

        foreach($filmsData as $film){
            echo "<a href='index.php?info=".$film['id']."'>".$film["title"]."</a> ";
            echo "Me gustas: ".$film['likes']."<br>";
            echo "<a href='index.php?like=".$film['id']."'>LIKE</a><br><br>";
        }
    ?>
</body>
</html>