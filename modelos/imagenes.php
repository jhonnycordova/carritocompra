<?php

include_once('../core/models.php');

class Imagenes extends Models{

public function validarCodigo($datos = array()){
	$parametros = array('codigo' => $datos['codigo']);
	return $this->validar($parametros, 'imagenes');
}

public function validarCodigoEditar($datos = array()){
	$parametros = array('codigo' => $datos['codigo']);
	$id = $datos['id'];
	return $this->validarEditar($parametros, 'imagenes', $id);
}

public function crear($datos = array(), $datosImagen = array()){
	foreach ($datos as $campo => $valor) {
		$$campo = $valor;
	}

	$ruta = $datosImagen['ruta']['name'];

	$target = "../publico/galeria/";
	$target = $target . basename($datosImagen['ruta']['name']);
	$ext = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG', 'gif', 'GIF');
	$extimg = explode('.', $datosImagen['ruta']['name']);
	if(in_array($extimg[1], $ext)) {
		if(move_uploaded_file($datosImagen['ruta']['tmp_name'], $target)){
			$this->consulta = "INSERT INTO imagenes (ruta, codigo, nombre, descripcion, status) VALUES ('$ruta', '$codigo', '$nombre', '$descripcion', '$status')";
			if($this->ejecutar_simple_query() == true){
				$this->mensaje = 'Registrado producto';
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

public function editar($datos = array(), $datosImagen = array()){
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
	$this->buscarDatos('imagenes');
}

public function buscarImagenesActivas(){
	$this->consulta = "SELECT * FROM imagenes where status = 'Visible' ";
	$this->traer_resultados_query_general();
}

public function eliminar($data = array()){
	$this->delete('imagenes', $data['id']);
}

public function buscar($data = array()){
	$this->buscarDatosId('imagenes', $data['id']);
}


}

 ?>