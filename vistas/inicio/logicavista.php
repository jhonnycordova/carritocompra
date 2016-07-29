<?php
session_start();

require('../core/logica.php');

$diccionario = array('titulos'=>array('index'=>'Bienvenidos'));

function llenar_carouselItems($html, $data){
	$num_filas = count($data);

	for ($i=0; $i < $num_filas ; $i++) {

		$html2 .= "<div class='{activo} item' data-slide-number='{num}'>
                    <img width='100%' src='/proyecto/publico/galeria/{ruta}'>
                   </div>";

		foreach ($data[$i] as $clave=>$valor) {
			if($i == 0){
				$html2 = str_replace('{activo}', 'active', $html2);
			}else{
				$html2 = str_replace('{activo}', '', $html2);
			}
			$html2 = str_replace('{num}', $i, $html2);
			$html2 = str_replace('{'.$clave.'}', $valor, $html2);
		}
	}

	$html = str_replace('{carouselItems}', $html2, $html);

	$html2 = "";

	for ($i=0; $i < $num_filas ; $i++) {

		$html2 .= "<div id='slide-content-{num}'>
	                <h2>{nombre}</h2>
	                <p>{descripcion}</p>
	                <h5>Cantidad Existente:
	                <span class='badge badge-success'><h4>{cantidad}</h4></span>
	                </h5>
	                <h5>Precio:
	                <span class='badge badge-important'><h4>{precio}</h4></span>
	                </h5>

	                <form action='/proyecto/carrito/crear/' method='POST'>
	                <input type='hidden' name='producto_id' id='producto_id' value='{producto_id}'>
	                <input type='hidden' name='precio' id='precio' value='{precio}'>
	                <select name='cantidad' id='cantidad'>";
	    for ($j=1; $j <= $data[$i]['cantidad'] ; $j++) {
	    	$html2 .= "<option value='$j'>$j</option>";
	    }

	    $html2 .= "</select>
	   				<br>
	   				<br>
	                <button type='submit' class='btn btn-primary'>
	                  <i class='icon-shopping-cart icon-white'></i> Agregar al Carro
	                </button>
	                </form>
	            </div>";

		foreach ($data[$i] as $clave=>$valor) {
			$html2 = str_replace('{num}', $i, $html2);
			$html2 = str_replace('{'.$clave.'}', $valor, $html2);
		}
	}

	$html = str_replace('{carouselText}', $html2, $html);

	$html2 = "";

	for ($i=0; $i < $num_filas ; $i++) {

		$html2 .= "<li class='span2'>
	                <a class='thumbnail' id='carousel-selector-{num}'>
	                <img src='/proyecto/publico/galeria/{ruta}'></a>
	            	</li>";

		foreach ($data[$i] as $clave=>$valor) {
			$html2 = str_replace('{num}', $i, $html2);
			$html2 = str_replace('{'.$clave.'}', $valor, $html2);
		}
	}

	$html = str_replace('{listaImagenes}', $html2, $html);

	return $html;
}

function llenar_carro($html, $dataCarrito){
	$num_filas = count($dataCarrito);
	$total = 0;
	for ($i=0; $i < $num_filas ; $i++) {
		$total = $total + $dataCarrito[$i]['monto'];
		$html2 .= "<table class='table table-hover'>";
            $html2 .= "<tr>
            		   <td>
	                   <img width='40px' src='/proyecto/publico/galeria/{ruta}'>
	                   {nombre}
	                   </td>
	                   <td>
	                   cantidad: <span class='badge badge-success'>{cantidad}</span>
	                   <br><span class='badge badge-success'>{monto} Bs</span>
	                   </td>
	                   <td>
	                   <a href='/proyecto/carrito/eliminar/?producto_id=".$dataCarrito[$i]['producto_id']."' class='btn btn-mini btn-danger'><i class='icon-remove icon-white'></i></a>
	                   </td>
	                   </tr>
	                   </table>";

		foreach ($dataCarrito[$i] as $clave=>$valor) {
			$html2 = str_replace('{'.$clave.'}', $valor, $html2);
		}
	}

	$html2 .= "<table class='table'>
	           <tr>
	           <td>Total a pagar</td>
	           <td><span class='badge badge-inverse'>".$total." Bs</span></td>
	           <td>
	           <a href='/proyecto/facturas/crear/' class='btn btn-mini btn-primary'><i class='icon-gift icon-white'></i> Comprar</span>
	           </td>
	           </tr>
	           </table>";

	$html = str_replace('{carrito}', $html2, $html);

	return $html;
}

function retornar_vista($vista, $data = array(), $parametros = array(), $dataCarrito) {


foreach ($parametros as $campo => $value) {
	$$campo = $value;
}

global $diccionario;

$html = buscar_plantilla_main();

$html = str_replace('{titulo}', $diccionario['titulos'][$vista], $html);

$html = str_replace('{menu}', buscar_menu(), $html);

$html = llenar_carro($html, $dataCarrito);

$html = str_replace('{Username}', $_SESSION['usuario'], $html);

$html = str_replace('{sidebar}', buscar_sidebar2(), $html);

$html = menu_dinamico('inicio', $html);

$html = str_replace('{contenido}', buscar_plantilla($vista, 'inicio'), $html);

$html = llenar_carouselItems($html, $data);

if($mensaje != ''){
	$html = str_replace('{mensaje}', buscar_mensajes(), $html);
	$html =mensajes_dinamico($mensaje, $tipomsj, $html);
}else{
	$html = str_replace('{mensaje}', '', $html);
}

$html = str_replace('{fecha}', date('Y'), $html);

print $html;

}


 ?>