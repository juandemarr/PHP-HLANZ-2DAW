<?php
/*
Nos piden una aplicación web para gestionar la pokedex de maestros pokemon.

Permitirá el registro de usuarios. Habrá un rol de administrador y otro de maestro pokemon. 
De los usuarios solo necesitamos saber su nombre, ademas de contraseña y rol, por supuesto.

Los maestros pokemon pueden añadir pokemon al sistema. de cada pokemon queremos saber su nombre, 
tipo {electrico, fuego, tierra, lucha, agua} y foto.

Al añadir un pokemon al sistema, el maestro pokemon ya lo tiene en su poder. Al resto de maestros 
pokemon le aparecerá como disponible para añadir a su pokedex.

Los maestros pokemon pueden añadir a su pokedex a todos los pokemon que quieran, pero no pueden tener 
repetidos.

Los maestros pokemon pueden crear equipos de pokemon, todos los que quieran. A cada equipo le pueden 
dar un nombre y asignar 5 pokemon.

El administrador podra crear pokemon y ver qué maestro ha creado mas pokemon y qué maestro tiene más 
equipos creados.

El usuario visitante solo puede ver la lista de pokemon que hay en el sistema.
*/
    require_once("db.php");
    require_once("controllers/mainController.php");
?>

