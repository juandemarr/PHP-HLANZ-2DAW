<html>
    <head>
        <title>Enlaces</title>
    </head>
    <body>
        <?php

            $usuarios[0]['username']="admin";
            $usuarios[0]['password']="1234";
            $usuarios[1]['username']="user1";
            $usuarios[1]['password']="asdfg";
            $usuarios[2]['username']="user2";
            $usuarios[2]['password']="qwerty";
        ?>

        <h3>Autentificación</h3>
        <form method="POST" action="auth.php">
            <label for="username">Nombre de usuario:</label>
            <input type="text" id="username" name="username"/><br/><br/>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password"/><br/><br/>

            <input type="submit"/>
        </form>

        <?php
        //CODIGO AUTENTIFICACION
            /* if(isset($_POST['username']) && $_POST['username'] != '')
                for($i = 0 ; $i < count($usuarios) ; $i++){
                    if($_POST['username'] == $usuarios[$i]['username']){
                        echo '<p>Usuario encontrado</p>';
                        if(isset($_POST['password']) && $_POST['password'] != '')
                            if($_POST['password'] == $usuarios[$i]['password']){
                                echo '<p>Usuario autentificado</p>';
                                break;//para que al terminar el bucle no aparezca tbn usuario no encontrado, ya que $i al final
                                    //valdria 3, aunque parase en el 1. Con esto se sale del bucle en 1 tbn
                            }else
                                echo '<p>Contraseña incorrecta</p>';
                    }
                   
                    if ($i >= count($usuarios)) //la variable $i sigue existiendo fuera del bucle, por lo que se compara 
                                                //con el total del array, de ser igual no existiria ningun usuario y al estar 
                                                //fuera del bucle muestra el mensaje una sola vez.
                        echo '<p>Usuario no encontrado</p>';
                } */
            

            //COMPROBACION EN EL MISMO IF
            if(isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != ''){
                for($i = 0 ; $i < count($usuarios) ; $i++)
                    if($_POST['username'] == $usuarios[$i]['username'] && $_POST['password'] == $usuarios[$i]['password']){
                        echo '<p>Usuario autentificado</p>';
                        break;
                    }
                if($i >= count($usuarios))
                    echo '<p>Usuario o contraseña incorrectos</p>';        
                    
            }/* else
                echo '<p>Introduce los datos</p>'; //mas adelante veremos como ver si es la primera vez que entra el usuario*/

            //////////////////////////////
            ?>
    </body>
</html>