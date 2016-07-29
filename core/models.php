<?php

include('db_conexion.php');

class Models extends DBConexion{

//parametros array[campo] = valor;

public function validar($parametros = array(), $tabla){
	foreach ($parametros as $k => $v) {
			$campo = $k;
			$valor = $v;
		}
	$this->consulta = "SELECT * FROM ".$tabla." WHERE ".$campo." = '$valor'";
	return $this->traer_resultados_query_simple();
}

public function validarEditar($parametros = array(), $tabla, $id){
	foreach ($parametros as $k => $v) {
			$campo = $k;
			$valor = $v;
		}
	$this->consulta = "SELECT * FROM ".$tabla." WHERE ".$campo." = '$valor' and id != '$id' ";
	return $this->traer_resultados_query_simple();
}

public function buscarDatos($tabla){
	$this->consulta = "SELECT * FROM ".$tabla." ";
	$this->traer_resultados_query_general();
}

public function delete($tabla, $id){
	$this->consulta = "DELETE FROM ".$tabla." where id = '$id' ";
	if($this->ejecutar_simple_query() == true){
		$this->mensaje = 'Eliminado';
		$this->tipomsj = 'success';
	}else{
		$this->mensaje = 'Error base de datos';
		$this->tipomsj = 'error';
	}
}


public function buscarDatosId($tabla, $id){
	$this->consulta = "SELECT * FROM ".$tabla." where id = '$id' ";
	$this->traer_resultados_query();
}

}


 ?>