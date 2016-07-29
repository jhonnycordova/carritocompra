<?php

$diccionario = array('titulos'=>array('iniciosesion'=>'Inicio de Sesion'));

function buscar_plantilla() {
	$archivo = '../vistas/login.html';

	$plantilla = file_get_contents($archivo);
	return $plantilla;
}


function mensajes_dinamico($msj, $tipo, $html){
	$html = str_replace('{tipo}', $tipo, $html);
	$html = str_replace('{msj}', $msj, $html);
	return $html;
}

function retornar_vista($vista, $data=array(), $mensaje, $tipomsj) {

global $diccionario;

$html = buscar_plantilla();

$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);

$html =mensajes_dinamico($mensaje, $tipomsj, $html);

print $html;

}


 ?>