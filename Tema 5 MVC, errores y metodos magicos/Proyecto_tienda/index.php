<?php
/*
Enunciado:
*Realizar una aplicación web que permita a usuarios registrarse.
*Los usuarios administradores podrán crear productos de los que queremos saber nombre, descripción, imagen,
precio y cantidad. Y podrán administrar los usuarios, asi como cualquier tarea que pueda hacer un usuario 
cliente.
*Los usuarios clientes podrán añadir productos al carrito y confirmar pedidos. Al confirmar el pedido 
la cantidad de cada producto vendido tendrá que reducirse como corresponda.
*El usuario podrá ver un listado de sus pedidos realizados.

Planteamiento inicial:
Admin: crear productos, admin usuarios. Extra: ver los pedidos de cada usuario
Cliente: añadir producto carrito, terminar pedido (al darle a comprar desde el carrito, se guardara en la tabla pedidos)
para cada producto: imagen texto y precio
Vistas: loginView, registerView, para admin => createProductView, adminUsersView
        para user => productsView, cartView
controllers: mainController (require modelos y session_start()), loginController (login y register), productController, orderController
models: userModel, productModel, orderModel, repositorio para cada uno
index.php (require db y mainController);
db.php

en carrito idUsuario, IdProducto, cantidad
pedido: idpedido, cantidad, idusuario, total,fecha. Un pedido contienen muchas lineas de pedido (productos), 
        los cuales se desglosan en la tabla pedido-producto
pedido-producto: idpedido, idproducto, cantidad
Borrar el carrito al convertirlo en pedido
el producto puede estar en varios pedidos por la cantidad

*/
require_once("db.php");
require_once("controllers/mainController.php");
?>