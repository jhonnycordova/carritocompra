<?php

error_reporting(0);
include('seguridad.php');
include('seguridadAdmin.php');
include('../vistas/inventario/logicavista.php');
include('../modelos/inventario.php');
include('../modelos/imagenes.php');
include('../core/controller.php');

function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'crear', 'verdatos', 'eliminar', 'buscar', 'editar');

$evento = control($evento, $peticiones, 'inventario');

$datos = FormDatos();

$inventario = new Inventario();
$imagenes = new Imagenes();

switch ($evento) {
	case 'registrar':
		$imagenes->buscarTodos();
		$dataProductos = $imagenes->filas;
		retornar_vista($evento, $data = array(), $parametros = array(), $dataProductos);
		break;

	case 'crear':
		$inventario->crear($datos);
		/*$parametros = array('mensaje' => $inventario->mensaje, 'tipomsj' => $inventario->tipomsj);
		retornar_vista('registrar', $data = array(), $parametros);*/
		index($inventario, 'inventario');
		break;

	case 'editar':
		$inventario->editar($datos);
		/*$parametros = array('mensaje' => $inventario->mensaje, 'tipomsj' => $inventario->tipomsj);
		retornar_vista('registrar', $data = array(), $parametros);*/
		index($inventario, 'inventario');
		break;

	case 'verdatos':
		verdatos($inventario);
		break;

	case 'eliminar':
		eliminar($inventario, $datos['id']);
		index($inventario, 'inventario');
		break;

	case 'buscar':
		$inventario->buscar($datos['id']);
		$data = $inventario->filas;
		retornar_vista('modificar', $data, $parametros = array());
		break;
}

}

controlador();


 ?>