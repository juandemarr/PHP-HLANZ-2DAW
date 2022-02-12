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
            
            /* $_GET['elegido']=1; */ //en caso de declararla en el codigo
            //para definirla en la URL del navegador => ?id=3&color=red

            $urls[0]['url'] = "https://www.google.es";
            $urls[1]['url'] = "https://www.facebook.com";
            $urls[2]['url'] = "https://www.instagram.com";
            $urls[3]['url'] = "https://www.twitter.com";
            
            $urls[0]['img'] = "2.jpg";
            $urls[1]['img'] = "2.jpg";
            $urls[2]['img'] = "2.jpg";
            $urls[3]['img'] = "2.jpg";
            
            /*MUESTRE NUMEROS 
            foreach($urls as $indice => $valor){
                echo '<a href="'.$valor.'">'.$indice.'</a><br>';
            } */

            /*MUESTRE EL NUMERO DE LA IMAGEN PASADA POR URL */
            if(isset($_GET['id']) && $_GET['id'] < count($urls) && $_GET['id'] > -1)//existe y no esta vacio.
                echo '<a href="'.$urls[$_GET['id']]['url'].'"><img src="'.$urls[$_GET['id']]['img'].'"/></a><br>';
            else foreach($urls as $indice => $valor)
                //if($_GET['id'] == $indice)//al hacerlo dentro del foreach y leer todo el array, es mas lento
                    echo '<a href="'.$valor['url'].'"><img src="'.$valor['img'].'"/></a><br>';
            
        ?>
    </body>
</html>