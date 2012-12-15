<?php

function listar($html="")
{
	$l = new listado("COMENTARIOS");
	if(!empty($html))
		$l->leyenda($html);
		
	$l->listado("SELECT nom AS nombre,correo,fecha,hora,texto,activo,id FROM po_comentario");
	echo $l->html();
}

function add() //nombre //apellidos //correo //clave
{
	$e = new elemento("AÑADIR COMENTARIO");
	$e->elem_text("Nombre","nom");
	$e->elem_text("Correo","correo");
	$e->elem_text("Fecha","fecha");
	$e->elem_text("Hora","hora");
	$e->elem_textarea("Texto","texto");
	$e->elem_select("Activo","activo","0=OFF,1=ON");
	$e->elem_select_sql("IdContenido","idcontenido","SELECT id AS campo1,titulo AS campo2 FROM po_contenido");
	
	echo $e->html();
}


function edit($id)
{
	$e = new elemento("Editar Comentarios");
	$x = new sql("SELECT * FROM po_comentario WHERE id=".$id);
	$result = $x->result();
	
	$fila=mysql_fetch_array($result);
	
	$e->elem_text("Nombre","nom",$fila["nom"]);
	$e->elem_text("Correo","correo",$fila["correo"]);
	$e->elem_text("Fecha","fecha",$fila["fecha"]);
	$e->elem_text("Hora","hora",$fila["hora"]);
	$e->elem_textarea("Texto","texto",$fila["texto"]);
	$e->elem_select("Activo","activo","0=OFF,1=ON",$fila["activo"]);
	$e->elem_select_sql("IdContenido","idcontenido","SELECT id AS campo1,titulo AS campo2 FROM po_contenido",$fila["idcontenido"]);
	
	$e->boton("edit");
	$x->destruir();
	echo $e->html();
}

function edit_procesa()
{
	$sql = sprintf("UPDATE po_comentario SET nom='%s',correo='%s',fecha='%s',hora='%s',texto='%s',activo=%d,idcontenido=%d WHERE id=%d"
	,$_POST["nom"],$_POST["correo"],$_POST["fecha"],$_POST["hora"],$_POST["texto"],$_POST["activo"],$_POST["idcontenido"],$_GET["edit"]);
	//echo $sql;
	$x = new sql($sql);
	if($x->affected()==-1)
		$html = "<span style='color:red'>Error, no se ha podido editar</span>";
	else
		$html = "<span style='color:green'>OK, se ha modificado correctamente</span>";
		
	listar($html);
}

function drop($id)
{
	$sql = sprintf("DELETE FROM po_comentario WHERE id=%d",$id);
	//echo $sql_usuario;
	$x = new sql($sql);
	
	if($x->affected()==-1)
		$html = "<span style='color:red'>Error, no se ha podido borrar</span>";
	else
		$html = "<span style='color:green'>OK, se ha borrado correctamente</span>";
	
	listar($html);
}

function add_procesa()
{
	//echo "<pre>".print_r($_POST,true)."</pre>";
	$sql = sprintf("INSERT INTO po_comentario(nom,correo,fecha,hora,texto,activo,idcontenido) values('%s','%s','%s','%s','%s',%d,%d)"
	,$_POST["nom"],$_POST["correo"],$_POST["fecha"],$_POST["hora"],$_POST["texto"],$_POST["activo"],$_POST["idcontenido"]);
	//echo $sql;
	$x=new sql($sql);
	
	if($x->affected()==-1)
		$html = "<span style='color:red'>Error, no se ha añadido el Comentario</span>";
	else
		$html = "<span style='color:green'>OK, Se ha añadido correctamente</span>";
	
	listar($html);
}

$haydatos=count($_POST);
if(!$haydatos)
{
	if(isset($_GET["edit"]))
		edit($_GET["edit"]);
	else if(isset($_GET["drop"]))
		drop($_GET["drop"]);
	else if(isset($_GET["add"]))
		add();
	else
		listar();
}
else
{
	if(isset($_POST["add"]))
		add_procesa();
	else if(isset($_POST["edit"]))
		edit_procesa();
}
?>
