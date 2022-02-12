Asignar roles a usuarios. En la tabla usuarios añadimos el campo rol y damos valores 1, 2 o 0 por ejemplo
Ej: si rol vale 2 == admin  /*añadir articulos, añadir comentarios, borrar comentarios*/
rol -> 1 == client /*para comentar*/

rol -> 0 not_logged

se guarda en $_SESSION["rol"] == 1
