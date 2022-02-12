tecnicos y jefes
jefe: ver tareas baiertas o terminadas
tecnicos: crear tareas, ver las no completadas y completarlas

tarea:fecha entrada, fecha salida, cliente, tecnico que la termino, desc y coste

clientes: nombre, dni, telefono

Cuando completa una tarea se ve una vista resumen de la tarea

Tablas
usuario
    id    
    rol
    nombre
    pass
tareas
    id
    fechaIn
    fechaOut
    idCliente
    idTecnico
    estado
    desc
    coste
cliente
    id
    dni
    nombre
    telefono

primero hacer las db, tres modelos, el sistema de login. Crear traeas de ej y mostrarlas
crear vista jefe (solo muestra)
crear vista tarea, para crear la atrea, hay que seleccionar el cliente, o escribiendo el dni y buscarlo, 
o una lista de ususarios para seleccionarlo, en el select de html, en value se pone el id o el dni,al elegirlo se quedara seleccionado
