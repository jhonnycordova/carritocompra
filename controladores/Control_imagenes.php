<?php

error_reporting(0);
include('seguridad.php');
include('seguridadAdmin.php');
include('../vistas/imagenes/logicavista.php');
include('../modelos/imagenes.php');
include('../core/controller.php');

function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'crear', 'verdatos', 'eliminar', 'buscar', 'editar', 'buscarCodigo', 'buscarCodigoEditar');

$evento = control($evento, $peticiones, 'imagenes');

$datos = FormDatos();

$datosImagen = FormFiles();

$imagenes = new Imagenes();

switch ($evento) {
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'buscarCodigo':
		$resp = $imagenes->validarCodigo($datos);
		$row[0] = array('resp' => $resp);
		echo json_encode($row);
		break;

	case 'buscarCodigoEditar':
		$resp = $imagenes->validarCodigoEditar($datos);
		$row[0] = array('resp' => $resp);
		echo json_encode($row);
		break;

	case 'crear':
		$imagenes->crear($datos, $datosImagen);
		/*$parametros = array('mensaje' => $imagenes->mensaje, 'tipomsj' => $imagenes->tipomsj);
		retornar_vista('registrar', $data = array(), $parametros);*/
		index($imagenes, 'imagenes/verdatos/');
		break;

	case 'editar':
		$imagenes->editar($datos, $datosImagen);
		/*$parametros = array('mensaje' => $imagenes->mensaje, 'tipomsj' => $imagenes->tipomsj);
		retornar_vista('registrar', $data = array(), $parametros);*/
		index($imagenes, 'imagenes/verdatos/');
		break;

	case 'verdatos':
		verdatos($imagenes);
		break;

	case 'eliminar':
		eliminar($imagenes, $datos['id']);
		index($imagenes, 'imagenes/verdatos/');
		break;

	case 'buscar':
		$imagenes->buscar($datos['id']);
		$data = $imagenes->filas;
		retornar_vista('modificar', $data, $parametros = array());
		break;
}

}

controlador();


 ?>