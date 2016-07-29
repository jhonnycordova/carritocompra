<?php

include_once('../core/models.php');

class Ventas extends Models{

public function crear($datos = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	$usuario_id = $_SESSION['idUsuario'];
	$this->consulta = "INSERT INTO ventas (usuario_id, codigo_factura, total) VALUES ('$usuario_id', '$codigo', '$total')";
	if($this->ejecutar_simple_query() == true){
		$this->mensaje = 'Compra realizada con exito';
		$this->tipomsj = 'success';
	}else{
		$this->mensaje = 'No se realizo la compra';
		$this->tipomsj = 'error';
	}

}


public function buscarProductos(){
	$usuario_id = $_SESSION['idUsuario'];
	$this->consulta = "SELECT * FROM carrito as t1 inner join imagenes as t2 on (t1.producto_id = t2.id)";
	$this->traer_resultados_query_general();
}

public function eliminar($producto_id){
	$usuario_id = $_SESSION['idUsuario'];
	$this->consulta = "DELETE FROM carrito WHERE usuario_id = '$usuario_id' and producto_id = '$producto_id'";
	if($this->ejecutar_simple_query() == true){
		$this->mensaje = 'Eliminado del carrito';
		$this->tipomsj = 'success';
	}else{
		$this->mensaje = 'No se elimino del carrito';
		$this->tipomsj = 'error';
	}
}


}

 ?>
