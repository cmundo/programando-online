<?php

function listar($html="")
{
	$l = new listado("ENLACES");
	if(!empty($html))
		$l->leyenda($html);
		
	$l->listado("SELECT titulo,ruta AS enlace,id,idquien,idseccion,orden FROM po_enlace");
	echo $l->html();
}

function add()
{
	$e = new elemento("AÑADIR ENLACE");
	$e->elem_text("Titulo","titulo");
	$e->elem_text("Ruta","ruta");
	$e->elem_text("Orden","orden");
	$e->elem_select_sql("IdQuien","idquien","SELECT id AS campo1,titulo AS campo2 FROM po_contenido",0,false,true);
	$e->elem_select_sql("IdSección","idseccion","SELECT id AS campo1,nom AS campo2 FROM po_seccion",0,false,true);
	echo $e->html();
}


function edit($id)
{
	$e = new elemento("Editar enlaces");
	$x = new sql("SELECT * FROM po_enlace WHERE id=".$id);
	$result = $x->result();
	
	$fila=mysql_fetch_array($result);
	$e->elem_text("Titulo","titulo",$fila["titulo"]);
	$e->elem_text("Ruta","ruta",$fila["ruta"]);
	$e->elem_text("Orden","orden",$fila["orden"]);
	$e->elem_select_sql("IdQuien","idquien","SELECT id AS campo1,titulo AS campo2 FROM po_contenido",$fila["idquien"],false,true);
	$e->elem_select_sql("IdSección","idseccion","SELECT id AS campo1,nom AS campo2 FROM po_seccion",$fila["idseccion"],false,true);
	$e->boton("edit");
	$x->destruir();
	echo $e->html();
}

function edit_procesa()
{
	$sql = sprintf("UPDATE po_enlace SET titulo='%s',ruta='%s',orden=%d,idquien=%d,idseccion=%d WHERE id=%d",$_POST["titulo"],$_POST["ruta"],$_POST["orden"],$_POST["idquien"],$_POST["idseccion"],$_GET["edit"]);
	//echo $sql;
	$x = new sql($sql);
	if($x->affected()==-1)
		$html = "<span class='error'>Error, no se ha podido editar</span>";
	else
		$html = "<span class='ok'>OK, se ha modificado correctamente</span>";
		
	listar($html);
}

function drop($id)
{
	$sql = sprintf("DELETE FROM po_enlace WHERE id=%d",$id);
	//echo $sql_usuario;
	$x = new sql($sql);
	
	if($x->affected()==-1)
		$html = "<span class='error'>Error, no se ha podido borrar</span>";
	else
		$html = "<span class='ok'>OK, se ha borrado correctamente</span>";
	
	listar($html);
}

function add_procesa()
{
	//echo "<pre>".print_r($_POST,true)."</pre>";
	$sql = sprintf("INSERT INTO po_enlace(titulo,ruta,orden,idquien,idseccion) values('%s','%s',%d,%d,%d)",$_POST["titulo"],$_POST["ruta"],$_POST["orden"],$_POST["idquien"],$_POST["idseccion"]);
	//echo $sql;
	$x=new sql($sql);
	
	if($x->affected()==-1)
		$html = "<span class='error'>Error, no se ha añadido el Usuario</span>";
	else
		$html = "<span class='ok'>OK, Se ha añadido correctamente</span>";
	
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