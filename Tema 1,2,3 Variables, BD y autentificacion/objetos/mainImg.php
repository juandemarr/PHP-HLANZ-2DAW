<html>
<head>
    <title>Enlaces</title>
    <style>
        img{
            width:100px;
        }
    </style>
</head>
<body>
    <?php    
    include('classEnlaceImg.php');
    
    $enlace1 = new Enlace('https://www.google.es','2.jpg');//Con costructor
    /*Sin constructor
    $enlace1->url = "https://www.google.es";
    $enlace1->img = "2.jpg";
    */
            
    /*
    $urls[0]['url'] = "https://www.google.es";
    $urls[1]['url'] = "https://www.facebook.com";
    $urls[2]['url'] = "https://www.instagram.com";
    $urls[3]['url'] = "https://www.twitter.com";
            
    $urls[0]['img'] = "2.jpg";
    $urls[1]['img'] = "2.jpg";
    $urls[2]['img'] = "2.jpg";
    $urls[3]['img'] = "2.jpg";
    */

    echo $enlace1->url; //no cogeremos las propiedades directamente del objeto, sino creando el metodo get (y set).
    echo '<br/>';
    echo $enlace1->img;    
            
    ?>
    </body>
</html>