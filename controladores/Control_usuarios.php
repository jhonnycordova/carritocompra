<?php

error_reporting(0);
include('seguridad.php');
include('seguridadAdmin.php');
include('../vistas/usuarios/logicavista.php');
include('../modelos/usuarios.php');
include('../core/controller.php');

function controlador(){

$evento = 'registrar';
$peticiones = array('registrar', 'buscarUsuario', 'buscarUsuarioEditar', 'crear', 'verdatos', 'eliminar', 'buscar', 'editar');

$evento = control($evento, $peticiones, 'usuarios');

$datos = FormDatos();

$usuarios = new Usuarios();

switch ($evento) {
	case 'registrar':
		retornar_vista($evento, $data = array(), $parametros = array());
		break;

	case 'buscarUsuario':
		$resp = $usuarios->validarUsuario($datos);
		$row[0] = array('resp' => $resp);
		echo json_encode($row);
		break;

	case 'buscarUsuarioEditar':
		$resp = $usuarios->validarUsuarioEditar($datos);
		$row[0] = array('resp' => $resp);
		echo json_encode($row);
		break;

	case 'crear':
		$usuarios->crear($datos);
		/*$parametros = array('mensaje' => $usuarios->mensaje, 'tipomsj' => $usuarios->tipomsj);
		retornar_vista('registrar', $data = array(), $parametros);*/
		index($usuarios, 'usuarios/verdatos/');
		break;

	case 'editar':
		$usuarios->editar($datos);
		/*$parametros = array('mensaje' => $usuarios->mensaje, 'tipomsj' => $usuarios->tipomsj);
		retornar_vista('registrar', $data = array(), $parametros);*/
		index($usuarios, 'usuarios/verdatos/');
		break;

	case 'verdatos':
		verdatos($usuarios);
		break;

	case 'eliminar':
		eliminar($usuarios, $datos['id']);
		index($usuarios, 'usuarios/verdatos/');
		break;

	case 'buscar':
		$usuarios->buscar($datos['id']);
		$data = $usuarios->filas;
		retornar_vista('modificar', $data, $parametros = array());
		break;
}

}

controlador();


 ?>