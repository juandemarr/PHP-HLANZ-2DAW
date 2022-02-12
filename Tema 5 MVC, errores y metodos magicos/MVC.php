Modelo = Clases, entidades que lo definen
Vista = lo que genera el servidor y va al cliente, lo que ve (HTML, CSS, JS). Cada cosa que hace la app es una vista diferente
Controlador = parte de la app que gestiona, controla y calcula datos

Carpeta del proyecto: Carpeta model
                      Carpeta View. No podemos calcular cosas, solo mostrar, se pueden incluir if para mostrar unas cosas u otras
                      Carpeta Controller. Aqui van las consultas a bd, no en la vista
                      index.php  Siempre se llama a este archivo. Lo unico que hace es llamar al controlador. Ve que variable se recibe por GET, si es login lo carga
                                 ej: index.php?login
                      db.php





                      