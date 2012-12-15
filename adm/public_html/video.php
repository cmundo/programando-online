<?php

//http://www.youtube.com/watch?v=
function youtube_url($ruta) //Implementar mejor...
{
	$n =  strpos($ruta,"?v=")+3; //Le sumo 3 para que no aperezca esto ?v=
	$ruta = substr($ruta,$n);
	$n2 = strpos($ruta,"&"); //Posición de &
	$ruta = substr($ruta,0,$n2);
	return $ruta;
}

function listar($html="")
{
	$l = new listado("VIDEOS");
	if(!empty($html))
		$l->leyenda($html);
		
	$l->listado("SELECT id,nom AS nombre,ruta AS video,orden FROM po_video");
	$l->libre();
	echo $l->html();
}

function add()
{
	$e = new elemento("AÑADIR VIDEO");
	$e->elem_text("Nombre","nombre");
	$e->elem_text("Ruta","ruta");
	$e->elem_text("Orden","orden");
	echo $e->html();
}


function edit($id)
{
	$e = new elemento("Editar video");
	$x = new sql("SELECT * FROM po_video WHERE id=".$id);
	$result = $x->result();
	
	$fila=mysql_fetch_array($result);
	$e->elem_text("Nombre","nombre",$fila["nom"]);
	
	$l = new listado();
	$video = $l->getVideo($fila["ruta"],$width=500,$height=250);
	$e->html_libre("<div class='video'>".$video."</div>");
	
	$e->elem_text("Ruta","ruta",$fila["ruta"]);
	$e->elem_text("Orden","orden",$fila["orden"]);
	$e->boton("edit");
	$x->destruir();
	echo $e->html();
}

function edit_procesa()
{
	$sql = sprintf("UPDATE po_video SET nom='%s',ruta='%s',orden=%d WHERE id=%d",$_POST["nombre"],youtube_url($_POST["ruta"]),$_POST["orden"],$_GET["edit"]);
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
	$sql = sprintf("DELETE FROM po_video WHERE id=%d",$id);
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
	//echo $ruta = $_POST["ruta"];

	$sql = sprintf("INSERT INTO po_video(nom,ruta,orden) values('%s','%s',%d)",$_POST["nombre"],youtube_url($_POST["ruta"]),$_POST["orden"]);
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
