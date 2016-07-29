<?php

class DBConexion{

private $db_host = 'localhost';
private $db_user = 'root';
private $db_pass = '1234';
private $db_name = 'proyecto';
private $conectado = false;
public $conexion;
public $consulta;
public $mensaje;
public $mensaje2;
public $tipomsj;
public $filas = array();


# Conectar a mysql
public function abrir_conexion() {
  $this->conexion = mysql_connect($this->db_host, $this->db_user, $this->db_pass);
  if(!$this->conexion){
  	echo "No se ha podido conectar a Mysql.";
  }else{
    if(mysql_select_db($this->db_name, $this->conexion)){
      $this->conectado = true;
    }else{
    	echo "No se ha encontrado la Base de datos.";
    }
  }

}



# Desconectar la base de datos
public function cerrar_conexion() {
  if($this->conectado == true){
    mysql_close($this->conexion);
  }
}


public function ejecutar_simple_query() {
  $this->abrir_conexion();
  if(mysql_query($this->consulta)){
      return true;
  }else{
      return false;
  }
  $this->cerrar_conexion();
}

# Traer resultados de una consulta en una variable $this->cedula
public function traer_resultados_query_simple() {
$this->abrir_conexion();
$result = mysql_query($this->consulta);
$num = mysql_num_rows($result);
if($num > 0){
  return true;
}else{
  return false;
}
$this->cerrar_conexion();
}

# Traer resultados de una consulta en un Array(campo => valor)
public function traer_resultados_query() {
$this->abrir_conexion();
$result = mysql_query($this->consulta);
while($row = mysql_fetch_assoc($result)) {
  foreach ($row as $campo => $valor) {
    $this->filas[$campo] = $valor;
  }
}
$this->cerrar_conexion();
}

# Traer resultados de una consulta en un Array[0](campo => valor)
public function traer_resultados_query_general() {
$this->abrir_conexion();
$result = mysql_query($this->consulta);
while ($row = mysql_fetch_assoc($result)) {
  $this->filas[] = $row;
}
$this->cerrar_conexion();
}

public function ultimoId(){
  $this->abrir_conexion();
  $result = mysql_insert_id();
  return $result;
  $this->cerrar_conexion();
}

}
?>

















