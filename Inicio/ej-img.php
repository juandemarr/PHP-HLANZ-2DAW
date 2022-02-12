<html>
    <head>
        <style>
            main{
                display:flex;
                width:80%;
                margin:2% auto;
            }
            img{
                width:48%;
                margin:0 1% 1% 0;
            }
        </style>
    </head>
    <body>
    <section id="main">
    <?php

        $imagenes[]="1.jpg";
        $imagenes[]="2.jpg";
        $imagenes[]="3.jpg";

        /* foreach($imagenes as $img){
            echo '<img src="ej-img/'.$img.'"/>';
        } */

        /*Dos arrays*/
        $eventos[0]['img']="1.jpg";
        $eventos[0]['url']="www.google.es";
        $eventos[1]['img']="2.jpg";
        $eventos[1]['url']="www.google.es";
        $eventos[2]['img']="3.jpg";
        $eventos[2]['url']="www.google.es";

        foreach($eventos as $evento)
            echo '<a href="'.$evento['url'].'"><img src="ej-img/'.$evento['img'].'"/>';

    ?>
    </section>

    </body>
</html>