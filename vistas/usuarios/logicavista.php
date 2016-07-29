<?php
session_start();

require('../core/logica.php');

$diccionario = array('titulos'=>array('registrar'=>'Crear Usuario',
	                                  'verdatos' => 'Tabla Usuarios'));

function llenar_tabla($html, $data){
	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) {
		$html2 .= "<tr>
					<td>
					    <div class='btn-group'>
					    <a class='btn btn-mini btn-inverse dropdown-toggle' data-toggle='dropdown' href='#'>
					    Accion
					    <span class='caret'></span>
					    </a>
					    <ul class='dropdown-menu'>
					    <li>
					    <a href='/proyecto/usuarios/eliminar/?id=".$data[$i]['id']."' onclick=\"return confirmar('Desea eliminar usuario')\">
						<i class='icon-trash'></i> Eliminar</a>
					    </li>

					    <li>
					    <a href='/proyecto/usuarios/buscar/?id=".$data[$i]['id']."' data-toggle='modal' data-target='#myModal'>
						<i class='icon-edit'></i> Editar</a>
					    </li>

					    </ul>
					    </div>

					</td>
					<td><span class='label label-inverse'>{usuario}</span></td>";
					if($data[$i]['tipo'] == 'A'){
						$html2 .= "<td><span class='label label-success'>{tipo}</span></td>";
					}else{
						$html2 .= "<td><span class='label label-important'>{tipo}</span></td>";
					}
					if($data[$i]['status'] == 'A'){
						$html2 .= "<td><span class='label label-info'>{status}</span></td>";
					}else{
						$html2 .= "<td><span class='label label-important'>{status}</span></td>";
					}
		$html2 .= "</tr>";

		foreach ($data[$i] as $clave=>$valor) {
			if($clave == 'tipo' && $valor == 'A'){
				$valor = 'Administrador';
			}else if($clave == 'tipo' && $valor == 'B'){
				$valor = 'Basico';
			}
			if($clave == 'status' && $valor == 'A'){
				$valor = 'Activo';
			}else if($clave == 'status' && $valor == 'I'){
				$valor = 'Inactivo';
			}
			$html2 = str_replace('{'.$clave.'}', $valor, $html2);
		}
	}

	$html = str_replace('{datosTabla}', $html2, $html);

	return $html;

}

function hacer_datos_dinamicos($html, $data) {
	foreach ($data as $clave=>$valor) {
		$html = str_replace('{'.$clave.'}', $valor, $html);
		if($clave == 'tipo' && $valor == 'A'){
			$html = str_replace('{A}', 'selected', $html);
		}else if($clave == 'tipo' && $valor == 'B'){
			$html = str_replace('{B}', 'selected', $html);
		}
		if($clave == 'status' && $valor == 'A'){
			$html = str_replace('{Ac}', 'selected', $html);
		}else if($clave == 'status' && $valor == 'I'){
			$html = str_replace('{In}', 'selected', $html);
		}
	}
	return $html;
}


function retornar_vista($vista, $data, $parametros) {

foreach ($parametros as $campo => $valor) {
	$$campo = $valor;
}

global $diccionario;

if($vista != 'modificar'){

	$html = buscar_plantilla_main();

	$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);

	$html = str_replace('{menu}', buscar_menu(), $html);

	$html = menu_dinamico('usuarios', $html);

	$html = str_replace('{Username}', $_SESSION['usuario'], $html);

	$html = str_replace('{sidebar}', buscar_sidebar(), $html);

	$html = sidebar_dinamico($vista, 'usuarios', $html);

	$html = str_replace('{contenido}', buscar_plantilla($vista, 'usuarios'), $html);

	if($vista == 'verdatos'){
		$html = llenar_tabla($html, $data);
	}

	if($mensaje != ''){
		$html = str_replace('{mensaje}', buscar_mensajes(), $html);
		$html =mensajes_dinamico($mensaje, $tipomsj, $html);
	}else{
		$html = str_replace('{mensaje}', '', $html);
	}

	$html = str_replace('{fecha}', date('Y'), $html);

}else{
	$html = buscar_plantilla('modificar', 'usuarios', $html);
	$html = hacer_datos_dinamicos($html, $data);
}

print $html;

}


 ?>