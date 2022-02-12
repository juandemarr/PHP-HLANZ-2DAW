<html>
    <head>

        <style>
            /* .tipo1{
                color:red;
            }
            .tipo2{
                color:green;
            } */
            /* de tener el estilo (la clase) definida en otro documento*/
            <?php 
              if(rand()%2) 
                    include('tipo1.html');
                else
                    include('tipo2.html');
            
            ?> 
            

        </style>
    </head>
    <body>
    <?php
        $nombres[]="Irene";
        $nombres[]="Juan";
        $nombres[]="Eli";

        /* for($i=0; $i<count($nombres); $i++)
            echo "<p>Hola ".$nombres[$i]."</p>" */

        /*Ahora con foreach */

        foreach($nombres as $nombre){
            echo '<p class="tipo';
            if($nombre=="Juan")
                echo '1';
            else
                echo '2';

            echo '">Hola '.$nombre.'</p>';
        }

        $otroArray = array("1","2","3");
        var_dump($otroArray);
    ?>

    </body>
</html>
