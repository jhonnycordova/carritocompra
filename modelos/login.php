<?php

include_once('../core/db_conexion.php');

class Login extends DBConexion{

#METODOS

public function validarUsuario($datos = array()){
	foreach ($datos as $campo => $valor) {
			if($campo == 'clave'){
				$valor = md5($valor);
			}
			$$campo = $valor;
		}
	$this->consulta = "SELECT * FROM usuarios WHERE usuario = '$usuario' and clave = '$clave'";
	$this->traer_resultados_query();
}

}


 ?>