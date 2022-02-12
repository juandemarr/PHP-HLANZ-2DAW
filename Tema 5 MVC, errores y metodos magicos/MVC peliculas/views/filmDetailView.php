<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>info de peli <?php echo $filmDetail['title'];?></title>
</head>
<body>
    <?php echo '<img src="views/'.$filmDetail['poster'].'" width="300px"/>' ?>
    <p>Año: <?php echo $filmDetail['year']; ?></p>
    <p>Like: <?php echo $filmDetail['likes']; ?></p>
</body>
</html>