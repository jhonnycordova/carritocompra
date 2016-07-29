<?php

error_reporting(0);
include('../core/controller.php');
include('../modelos/login.php');
include('../vistas/login/logicavista.php');

function controlador(){

//El Evento por defecto es iniciosesion (lo primero que se ejecutara)
$evento = 'iniciosesion';

//son laspeticiones o eventos que puede hacer este módulo 
$peticiones = array('iniciosesion', 'validar', 'cerrarsesion');

//Llamamos a la funcion Control que esta en controller.php para asiganar el evento
$evento = control($evento, $peticiones, 'login');

$datos = FormDatosPost();

$login = new Login();

switch ($evento) {
	case 'iniciosesion':
	retornar_vista('iniciosesion', $data = array(), 'Ingrese sus datos de usuario', 'info');
	break;

	case 'cerrarsesion':
	session_start();
	session_unset(); // Borrar las variables de sesión
	setcookie(session_name(), 0, 1 , ini_get("session.cookie_path")); // Eliminar la cookie
	session_destroy(); // Destruye el resto de información sobre la sesión
	retornar_vista('iniciosesion', $data = array(), 'Salio de forma segura del sistema', 'success');
	break;

	case 'validar':
	if($datos['usuario'] == ''){
		retornar_vista('iniciosesion', $data = array(), 'Debe Ingresar un Usuario', 'error');
	}else if($datos['clave'] == ''){
		retornar_vista('iniciosesion', $data = array(), 'Debe Ingresar clave de Usuario', 'error');
	}else{
		$login->validarUsuario($datos);
		$data = $login->filas;
		if($data['id'] > 0){
			if($data['status'] == 'A'){
				session_start();
				if(isset($datos['recordar'])){
					setcookie(session_name(), 'recordar', time()+3600); //expira en 1 hora
				}
				$_SESSION['autentificado'] = 'yes';
				$_SESSION['idUsuario'] = $data['id'];
				$_SESSION['usuario'] = $data['usuario'];
				$_SESSION['tipo'] = $data['tipo'];
				header('Location: /proyecto/inicio/index/');
			}else{
				retornar_vista('iniciosesion', $data = array(), 'Usuario Sin permisos, Comunicar al Administrador del Sistema', 'error');
			}
		}else{
			retornar_vista('iniciosesion', $data = array(), 'Datos no validos', 'error');
		}
	}
	break;
}

}

controlador();

 ?>