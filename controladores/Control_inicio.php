<?php

error_reporting(0);
include('../core/controller.php');
include('seguridad.php');
include('../vistas/inicio/logicavista.php');
include('../modelos/inventario.php');
include('../modelos/carrito.php');

function controlador(){

$evento = 'index';
$peticiones = array('index');

$evento = control($evento, $peticiones, 'inicio');

$inventario = new Inventario();
$carrito = new Carrito();

session_start();

$inventario->buscarinventariosActivas();
$data = $inventario->filas;
unset($inventario->filas);
$carrito->buscarProductos();
$datosCarrito = $carrito->filas;
$parametros = array('mensaje' => $_SESSION['mensaje'], 'tipomsj' => $_SESSION['tipomsj']);
retornar_vista('index', $data, $parametros, $datosCarrito);

}

controlador();

 ?>