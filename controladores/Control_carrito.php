<?php

error_reporting(0);
include('seguridad.php');
include('../modelos/carrito.php');
include('../core/controller.php');

function controlador(){

$evento = 'index';
$peticiones = array('index', 'crear', 'eliminar');

$evento = control($evento, $peticiones, 'carrito');

$datos = FormDatos();

$carrito = new Carrito();

switch ($evento) {
	case 'index':
		//header('Location: /proyecto/inicio/index/');
		break;

	case 'crear':
		$carrito->crear($datos);
		/*$parametros = array('mensaje' => $carrito->mensaje, 'tipomsj' => $carrito->tipomsj);
		retornar_vista('registrar', $data = array(), $parametros);*/
		index($carrito, 'inicio/index/');
		break;

	case 'eliminar':
		$carrito->eliminar($datos['producto_id']);
		index($carrito, 'inicio/index/');
		break;
}

}

controlador();


 ?>
