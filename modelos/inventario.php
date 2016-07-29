<?php

include_once('../core/models.php');

class Inventario extends Models{

public function crear($datos = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	$this->consulta = "INSERT INTO inventarios (producto_id, cantidad, precio) VALUES ('$producto_id', '$cantidad', '$precio')";
	if($this->ejecutar_simple_query() == true){
		$this->mensaje = 'Registrado producto al inventario';
		$this->tipomsj = 'success';
	}else{
		$this->mensaje = 'Error en base de datos';
		$this->tipomsj = 'error';
	}
}

public function editar($datos = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	if($datosImagen['ruta']['name'] == ''){

	$this->consulta = "UPDATE imagenes SET nombre = '$nombre', codigo = '$codigo', descripcion = '$descripcion', status = '$status' where id = '$id' ";

		if($this->ejecutar_simple_query() == true){
			$this->mensaje = 'Modificado';
			$this->tipomsj = 'success';
		}else{
			$this->mensaje = 'Error en base de datos';
			$this->tipomsj = 'error';
		}


	}else{

	$ruta = $datosImagen['ruta']['name'];

	$target = "../publico/galeria/";
	$target = $target . basename($datosImagen['ruta']['name']);
	$ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
	$extimg = explode('.', $datosImagen['ruta']['name']);
	if(in_array($extimg[1], $ext)) {
		if(move_uploaded_file($datosImagen['ruta']['tmp_name'], $target)){
			$this->consulta = "UPDATE imagenes SET ruta = '$ruta', descripcion = '$descripcion', status = '$status' where id = '$id' ";
			if($this->ejecutar_simple_query() == true){
				unlink('../publico/galeria/'.$imagen);
				$this->mensaje = 'Modificada y subida imagen a galeria';
				$this->tipomsj = 'success';
			}else{
				$this->mensaje = 'Error en base de datos';
				$this->tipomsj = 'error';
			}
		}else{
			$this->mensaje = 'Error subiendo imagen a galeria';
			$this->tipomsj = 'error';
		}
	}else{
		$this->mensaje = 'Error extencion no permitida';
		$this->tipomsj = 'error';
	}
	}

}


public function buscarTodos(){
	$this->consulta = "SELECT * FROM imagenes as t1 inner join inventarios as t2 on (t1.id = t2.producto_id)";
	$this->traer_resultados_query_general();
}

public function buscarinventariosActivas(){
	$this->consulta = "SELECT * FROM inventarios as t1 inner join imagenes as t2 on (t1.producto_id = t2.id) where t2.status = 'Visible' and t1.cantidad > 0 ";
	$this->traer_resultados_query_general();
}

public function eliminar($data = array()){
	$this->delete('inventarios', $data['id']);
}

public function buscar($data = array()){
	$this->buscarDatosId('inventarios', $data['id']);
}


}

 ?>