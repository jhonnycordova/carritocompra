<?php


function buscar_plantilla_main() {
	$archivo = '../vistas/main.html';

	$plantilla = file_get_contents($archivo);
	return $plantilla;
}


function buscar_plantilla($formulario, $modelo) {
	$archivo = '../vistas/'.$modelo.'/'.$formulario.'.html';

	$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function buscar_menu(){
	$archivo = '../vistas/menu.html';

	$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function buscar_sidebar(){
	$archivo = '../vistas/sidebar.html';

	$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function buscar_sidebar2(){
	$archivo = '../vistas/sidebar2.html';

	$plantilla = file_get_contents($archivo);
	return $plantilla;
}

function buscar_mensajes(){
	$archivo = '../vistas/mensajes.html';

	$plantilla = file_get_contents($archivo);
	return $plantilla;
}


function mensajes_dinamico($msj, $tipo, $html){
	$html = str_replace('{tipo}', $tipo, $html);
	$html = str_replace('{msj}', $msj, $html);
	return $html;
}

function menu_dinamico($modelo, $html){
	$html = str_replace('{'.$modelo.'}', 'active', $html);
	if($_SESSION['tipo'] != 'A'){
		$html = str_replace('{usuarios}', 'hidden', $html);
	}
	return $html;
}

function sidebar_dinamico($vista, $modelo, $html){
	$html = str_replace('{Modulo}', $modelo, $html);
	$html = str_replace('{'.$vista.'}', 'active', $html);
	return $html;
}



 ?>