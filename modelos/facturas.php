<?php

include_once('../core/models.php');

class Facturas extends Models{

public function validarCodigo($codigo){
	$parametros = array('codigo' => $codigo);
	return $this->validar($parametros, 'facturas');
}

public function generarCodigo(){
	$str = "1234567890";
	$cad = "";
	for($i=0;$i < 6;$i++) {
		$cad .=  substr($str,rand(0,10),1);
	}
	return $cad;
}

public function crear($datos = array()){
	$num = count($datos);
	$codigoPro = $this->generarCodigo();
	$total = 0;
	$usuario_id = $_SESSION['idUsuario'];
	while ($this->validarCodigo($codigo) == true) {
		$codigo = $this->generarCodigo();
	}

	for ($i=0; $i < $num ; $i++) {
		foreach ($datos[$i] as $campo => $valor) {
			$$campo = $valor;
		}

		$total = $total + $monto;
		$this->consulta = "INSERT INTO facturas (codigo, producto_id, cantidad, precio) VALUES ('$codigoPro', '$producto_id', '$cantidad', '$monto')";
		$this->ejecutar_simple_query();

		$this->consulta = "UPDATE inventarios SET cantidad = (cantidad-'$cantidad') WHERE producto_id = '$producto_id'";
		$this->ejecutar_simple_query();

	}

	$this->consulta = "DELETE FROM carrito WHERE usuario_id = '$usuario_id'";
	$this->ejecutar_simple_query();



	return $result = array('codigo' => $codigoPro, 'total' => $total);

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
