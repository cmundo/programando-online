<?php

function listar($html="")
{
	$l = new listado("USUARIOS");
	if(!empty($html))
		$l->leyenda($html);
		
	$l->listado("SELECT nom AS nombre,ape AS apellidos,login,clave,id FROM po_usuario");
	echo $l->html();
}

function add() //nombre //apellidos //correo //clave
{
	$e = new elemento("AÑADIR USUARIO");
	$e->elem_text("Nombre","nom");
	$e->elem_text("Apellidos","ape");
	$e->elem_text("Login","login");
	$e->elem_pass("Clave","clave");
	
	echo $e->html();
}


function edit($id)
{
	$e = new elemento("Editar Usuario");
	$x = new sql("SELECT * FROM po_usuario WHERE id=".$id);
	$result = $x->result();
	
	$fila=mysql_fetch_array($result);
	$e->elem_text("nombre","nom",$fila["nom"]);
	$e->elem_text("apellidos","ape",$fila["ape"]);
	$e->elem_text("login","login",$fila["login"]);
	$e->elem_pass("clave","clave",$fila["clave"]);
	$e->boton("edit");
	$x->destruir();
	echo $e->html();
}

function edit_procesa()
{
	$sql = sprintf("UPDATE po_usuario SET nom='%s',ape='%s',login='%s',clave='%s' WHERE id=%d",$_POST["nom"],$_POST["ape"],$_POST["login"],$_POST["clave"],$_GET["edit"]);
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
	$sql = sprintf("DELETE FROM po_usuario WHERE id=%d",$id);
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
	$sql = sprintf("INSERT INTO po_usuario(nom,ape,login,clave) values('%s','%s','%s','%s')",$_POST["nom"],$_POST["ape"],$_POST["login"],$_POST["clave"]);
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
