<?php

function control($evento, $peticiones, $modelo){

$uri = $_SERVER['REQUEST_URI'];

foreach ($peticiones as $peticion) {
	$uri_peticion = $modelo.'/'.$peticion.'/';
	if( strpos($uri, $uri_peticion) == true ) {
		$evento = $peticion;
	}
}

return $evento;
}


function FormDatosPost() {
	$datos = array();
	foreach ($_POST as $campo => $valor) {
		$datos[$campo] = $valor;
	}
	return $datos;
}

function FormFiles() {
	$datos = array();
	$datos = $_FILES;
	return $datos;
}

function FormDatos() {
	$datos = array();
	if($_POST){
		foreach ($_POST as $campo => $valor) {
			$datos[$campo] = $valor;
		}
	}else if($_GET){
		foreach ($_GET as $campo => $valor) {
			$datos[$campo] = $valor;
		}
	}
	return $datos;
}

function verdatos($modelo){
	$modelo->buscarTodos();
	$data = $modelo->filas;
	$parametros = array('mensaje' => $_SESSION['mensaje'], 'tipomsj' => $_SESSION['tipomsj']);
	retornar_vista('verdatos', $data, $parametros);
}

function index($modelo, $modelourl){
	$_SESSION['mensaje'] = $modelo->mensaje;
	$_SESSION['tipomsj'] = $modelo->tipomsj;
	header('Location: /proyecto/'.$modelourl);
}


function eliminar($modelo, $id){
	$modelo->eliminar($id);
	verdatos($modelo);
}


 ?>