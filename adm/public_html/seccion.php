<?php

function listar($html="")
{
	$l = new listado("SECCION");
	if(!empty($html))
		$l->leyenda($html);
		
	$l->listado("SELECT id,nom AS seccion FROM po_seccion");
	echo $l->html();
}

function add()
{
	$e = new elemento("AÑADIR SECCION");
	$e->elem_text("Sección","seccion");
	echo $e->html();
}


function edit($id)
{
	$e = new elemento("Editar Usuario");
	$x = new sql("SELECT nom FROM po_seccion WHERE id=".$id);
	$result = $x->result();
	
	$fila=mysql_fetch_array($result);
	$e->elem_text("Sección","seccion",$fila["nom"]);
	$e->boton("edit");
	$x->destruir();
	echo $e->html();
}

function edit_procesa()
{
	$sql = sprintf("UPDATE po_seccion SET nom='%s' WHERE id=%d",$_POST["seccion"],$_GET["edit"]);
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
	$sql = sprintf("DELETE FROM po_seccion WHERE id=%d",$id);
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
	$sql = sprintf("INSERT INTO po_seccion(nom) values('%s')",$_POST["seccion"]);
	//echo $sql;
	$x=new sql($sql);
	
	if($x->affected()==-1)
		$html = "<span style='color:red'>Error, no se ha añadido el Usuario</span>";
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
