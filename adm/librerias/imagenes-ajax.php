<?php

include("../../librerias/clase_sql.php");

$sql="SELECT nom,ruta FROM po_archivo WHERE (tipo='jpg' OR tipo='png')";
//echo $sql;
$x = new sql($sql);
$result = $x->result();

if($x->numrows()==0)
	echo "<ul><li>No hay ninguna imagen para mostrar</li></ul>";
else
{
	while($fila=mysql_fetch_array($result))
	{
		printf('<img class="imagen-por-ajax" src="../archivos/%s" alt="" style="width:120px;height:100px;float:left;padding:2px;margin:5px;border:1px solid black" 
		title="%s" data-ruta="%s"/>',$fila["ruta"],$fila["nom"],$fila["ruta"]);
	}
}
$x->destruir();

?>