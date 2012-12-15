<?php
function validaLongitud($valor, $permiteVacio, $minimo, $maximo)
{
	$cantCar=strlen($valor);
	if(empty($valor))
	{
		if($permiteVacio) return TRUE;
		else return FALSE;
	}
	else
	{
		if($cantCar>=$minimo && $cantCar<=$maximo) return TRUE;
		else return FALSE;
	}
}

function validaCorreo($valor)
{
	if(eregi("([a-zA-Z0-9._-]{1,30})@([a-zA-Z0-9.-]{1,30})", $valor)) return TRUE;
	else return FALSE;
}

// MAIN	

if($_POST)
{
	foreach($_POST as $clave => $valor) $$clave=addslashes(trim(utf8_decode($valor)));
	sleep(5);
	if(!validaLongitud($nombre, 0, 4, 50)) $error=1;
	if(!validaCorreo($correo)) $error=1;
	if(!validaLongitud($comentarios, 0, 5, 500)) $error=1;
	
	if($error==1) 
		echo "Error";
	else
	{
		// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Cabeceras adicionales
		//$cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
		$cabeceras .= 'From: Programando Online <programandoonline@gmail.com>' . "\r\n";
		//$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
		//$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";
		
		$asunto = "Comentario en la Web Programando Online";
		
		$fecha=date("d/m/y");
		$hora=date("H:i:s");

		$mensaje="<p style='font-weight:bold;font-size:15px;font-family:Verdana'>Tienés un nuevo mensaje desde el formulario de contacto de 
		<a href='http://www.programandoonline.com' target='_black'><span style='font-weight:bold'><span style='color:#B2C629;text-decoration:underline'>Programando</span> <span style='color:#007095;text-decoration:underline'>Online:</span></span></p></a>
		<ul>
		<li><span style='font-weight:bold'>Nombre: </span>".ucwords($nombre)."</li>
		<li><span style='font-weight:bold'>Fecha: </span>".$fecha."</li>
		<li><span style='font-weight:bold'>Hora: </span>".$hora."</li>
		<li><span style='font-weight:bold'>E-mail: </span><a href='mailto:".$correo."'>".$correo."</a></li>
		</ul>
		<p><span style='font-weight:bold'>Comentario: </span>".$comentarios."</p>";

		mail("programandoonline@gmail.com",$asunto,$mensaje,$cabeceras);
		echo "OK";
	}
}
?>