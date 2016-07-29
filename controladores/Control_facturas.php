<?php

error_reporting(0);
include('seguridad.php');
include('seguridadAdmin.php');
include('../vistas/facturas/logicavista.php');
include('../modelos/facturas.php');
include('../modelos/carrito.php');
include('../modelos/ventas.php');
include('../core/controller.php');

function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'crear', 'verdatos', 'eliminar', 'buscar', 'editar', 'buscarCodigo', 'buscarCodigoEditar');

$evento = control($evento, $peticiones, 'facturas');

$datos = FormDatos();

$facturas = new Facturas();
$carrito = new Carrito();
$ventas = new Ventas();

switch ($evento) {
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'buscarCodigo':
		$resp = $facturas->validarCodigo($datos);
		$row[0] = array('resp' => $resp);
		echo json_encode($row);
		break;

	case 'buscarCodigoEditar':
		$resp = $facturas->validarCodigoEditar($datos);
		$row[0] = array('resp' => $resp);
		echo json_encode($row);
		break;

	case 'crear':
		$carrito->buscarProductos();
		$data = $carrito->filas;
		$resultados = $facturas->crear($data);
		$ventas->crear($resultados);
		/*$parametros = array('mensaje' => $facturas->mensaje, 'tipomsj' => $facturas->tipomsj);
		retornar_vista('registrar', $data = array(), $parametros);*/
		index($ventas, 'inicio/index/');
		break;

	case 'editar':
		$facturas->editar($datos, $datosImagen);
		/*$parametros = array('mensaje' => $facturas->mensaje, 'tipomsj' => $facturas->tipomsj);
		retornar_vista('registrar', $data = array(), $parametros);*/
		index($facturas, 'facturas/verdatos/');
		break;

	case 'verdatos':
		verdatos($facturas);
		break;

	case 'eliminar':
		eliminar($facturas, $datos['id']);
		index($facturas, 'facturas/verdatos/');
		break;

	case 'buscar':
		$facturas->buscar($datos['id']);
		$data = $facturas->filas;
		retornar_vista('modificar', $data, $parametros = array());
		break;
}

}

controlador();


 ?>