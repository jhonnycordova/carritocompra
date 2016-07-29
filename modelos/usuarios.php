<?php

include_once('../core/models.php');
include_once('../core/tcpdf/config/tcpdf_config.php');
include_once('../core/tcpdf/tcpdf.php');

class Usuarios extends Models{


public function validarUsuario($datos = array()){
	$parametros = array('usuario' => $datos['usuario']);
	return $this->validar($parametros, 'usuarios');
}

public function validarUsuarioEditar($datos = array()){
	$parametros = array('usuario' => $datos['usuario']);
	$id = $datos['id'];
	return $this->validarEditar($parametros, 'usuarios', $id);
}

public function crear($datos = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	$clave = md5($clave);

	if(($this->validarUsuario($datos) == false) && ($usuario != '')){
		$this->consulta = "INSERT INTO usuarios (usuario, clave, status, tipo) VALUES ('$usuario', '$clave', '$status', '$tipo')";
		if($this->ejecutar_simple_query() == true){
			$_SESSION['mensaje'] = 'Registrado';
			$_SESSION['tipomsj'] = 'success';
		}else{
			$_SESSION['mensaje'] = 'Error en Base de Datos';
			$_SESSION['tipomsj'] = 'error';
		}
	}else{
		$_SESSION['mensaje'] = 'Error en Base de Datos';
		$_SESSION['tipomsj'] = 'error';
	}
}

public function editar($datos = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if(($this->validarUsuarioEditar($datos) == false) && ($usuario != '')){
		$this->consulta = "UPDATE usuarios SET usuario = '$usuario', status = '$status', tipo = '$tipo' WHERE id = '$id'";
		if($this->ejecutar_simple_query() == true){
			$_SESSION['mensaje'] = 'Modificado';
			$_SESSION['tipomsj'] = 'info';
		}else{
			$_SESSION['mensaje'] = 'Error en Base de Datos';
			$_SESSION['tipomsj'] = 'error';
		}
	}else{
		$_SESSION['mensaje'] = 'Error en Base de Datos';
		$_SESSION['tipomsj'] = 'error';
	}
}

public function buscarTodos(){
	$this->buscarDatos('usuarios');
}

public function eliminar($data = array()){
	$this->delete('usuarios', $data['id']);
}

public function buscar($data = array()){
	$this->buscarDatosId('usuarios', $data['id']);
}


}

 ?>