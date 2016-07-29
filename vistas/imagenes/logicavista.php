<?php
session_start();

require('../core/logica.php');

$diccionario = array('titulos'=>array('registrar'=>'Subir Imagenes',
	                                  'verdatos' => 'Tabla Imagenes'));

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
					    <a href='/proyecto/imagenes/eliminar/?id=".$data[$i]['id']."' onclick=\"return confirmar('Desea eliminar imagen')\">
						<i class='icon-trash'></i> Eliminar</a>
					    </li>

					    <li>
					    <a href='/proyecto/imagenes/buscar/?id=".$data[$i]['id']."' data-toggle='modal' data-target='#myModal'>
						<i class='icon-edit'></i> Editar</a>
					    </li>

					    </ul>
					    </div>

					</td>
					<td style='text-align:center;'><img width='100px' src='/proyecto/publico/galeria/{ruta}' class='img-rounded'></td>
					<td>{codigo}</td>
					<td>{nombre}</td>
					<td>{descripcion}</td>";
				if($data[$i]['status'] == 'Visible'){
				$html2 .= "<td><span class='label label-success'>{status}</span></td>";
				}else{
				$html2 .= "<td><span class='label label-important'>{status}</span></td>";
				}
		$html2 .= "</tr>";

		foreach ($data[$i] as $clave=>$valor) {
			$html2 = str_replace('{'.$clave.'}', $valor, $html2);
		}
	}

	$html = str_replace('{datosTabla}', $html2, $html);

	return $html;

}

function hacer_datos_dinamicos($html, $data) {
	foreach ($data as $clave=>$valor) {
		$html = str_replace('{'.$clave.'}', $valor, $html);
		if($clave == 'status' && $valor == 'Visible'){
			$html = str_replace('{Visible}', 'selected', $html);
		}else if($clave == 'status' && $valor == 'No Visible'){
			$html = str_replace('{No Visible}', 'selected', $html);
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

$html = menu_dinamico('imagenes', $html);

$html = str_replace('{Username}', $_SESSION['usuario'], $html);

$html = str_replace('{sidebar}', buscar_sidebar(), $html);

$html = sidebar_dinamico($vista, 'imagenes', $html);

$html = str_replace('{contenido}', buscar_plantilla($vista, 'imagenes'), $html);

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
	$html = buscar_plantilla('modificar', 'imagenes', $html);
	$html = hacer_datos_dinamicos($html, $data);
}

print $html;

}


 ?>