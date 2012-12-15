<?php

//sleep(1);
include("clase_sql.php");

$id = $_GET["idcontenido"];
$nombre = $_GET["nombre"];
$email = $_GET["email"];
$texto = $_GET["texto"];

$fecha = date("Y/m/d");
$hora = date("h:i:s");

$sql = sprintf("INSERT INTO po_comentario(nom,correo,fecha,hora,texto,activo,idcontenido)VALUES('%s','%s','%s','%s','%s',%d,%d)",
$nombre,$email,$fecha,$hora,$texto,0,$id);

//echo $sql;

$x=new sql($sql);
if($x->affected()==-1)
	echo "error";
else
	echo "ok";

?>