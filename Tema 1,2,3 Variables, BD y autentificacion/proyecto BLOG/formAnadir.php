<section class="seccionFormulario">
    <form action="index.php" method="POST" class="formularioAnadir">
        <h2>Añadir libros</h2>
        
        <label for="tituloLibro">Título:</label>
        <input type="text" name="tituloLibro" id="tituloLibro" required/>

        <label for="imgLibro">Imágen:</label>
        <input type="text" name="imgLibro" id="imgLibro" required/>

        <label for="autorLibro">Autor:</label>
        <input type="text" name="autorLibro" id="autorLibro" required/>

        <label for="textoLibro">Descripción:</label>
        <input type="text" name="textoLibro" id="textoLibro" required/>

        <input type="submit" value="Añadir"/>
    </form>
    <?php
    /*formulario con titulo,texto, img y autor. Comprobar y luego insertar los datos*/
            
    /*INSERT INTO `libros` (`id`, `titulo`, `texto`, `autor`, `fecha`, `img`) 
    VALUES (NULL, 'El libro de los Sith', 'Cras sed nisi nec turpis venenatis lobortis. 
    Fusce interdum accumsan sem ac placerat. Duis quis orci id massa rutrum tristique et vel ante. 
    Ut a volutpat lacus.', 'Darth Bane', '2021-09-06', 'img/libro_sith.jpg');
    */
    if(isset($_POST["tituloLibro"]) && isset($_POST["imgLibro"]) && isset($_POST["autorLibro"]) && isset($_POST["textoLibro"])){
        mysqli_query($mysqli, "insert into `libros` (`id`,`titulo`,`texto`,`autor`,`fecha`,`img`)
            values (NULL, '".$_POST["tituloLibro"]."','".$_POST["textoLibro"]."','".$_POST["autorLibro"]."','".
            date("Y-m-d")."','".$_POST["imgLibro"]."')");
                
        }


    ?>

</section>