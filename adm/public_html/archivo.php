<?php

function listar($html="") //Implementado.
{
	$l = new listado("ARCHIVOS");
	if(!empty($html))
		$l->leyenda($html);
	$l->listado("SELECT id,nom AS nombre,ruta,tipo,orden,fecha FROM po_archivo ORDER BY fecha DESC");
	echo $l->html();
}

function edit($id) //Falta por Implementar.
{
	$bi = new biblioteca();
	$x = new sql("SELECT * FROM po_archivo WHERE id=".$id);
	$result = $x->result();
	$fila = mysql_fetch_array($result);
	$e = new elemento("Editar archivos");
	$e->elem_text("Nombre","nombre",$fila["nom"]);
	
	//Html Libre
	$ruta="../archivos/".$fila["ruta"];
	if($bi->is_img($ruta))
	{
		$html = 
		"<div>
			<a href='".$ruta."' class='fancybox'><img class='img_archivo' src='".$ruta."' alt='' /></a>
		</div>";
		$e->html_libre($html);
	}
	else
		echo "¡¡ Por implementar !!";
	
	$e->elem_file("Archivo","archivo",10485760);
	$e->elem_text("Tipo","tipo",$fila["tipo"]);
	$e->elem_text("Orden","orden",$fila["orden"]);
	$e->elem_text("Fecha","fecha",$bi->fecha($fila["fecha"]));
	$e->elem_select_sql("IdQuien","idquien","SELECT id AS campo1,titulo AS campo2 FROM po_contenido",$fila["idquien"]);
	$e->elem_select_sql("Sección","seccion","SELECT id AS campo1,nom AS campo2 FROM po_seccion",$fila["idseccion"]);
	$e->boton("edit");
	
	//Necesito esto para borrar la antigua imagen.
	$e->elem_hidden("ruta",$fila["ruta"]);
	
	echo $e->html();
}

function edit_procesa()  //Implementado.
{
	//echo "<pre>"; print_r($_FILES["archivo"]); echo "</pre>";
	//echo "<pre>"; print_r($_POST); echo "</pre>";
	
	$bi = new biblioteca();
	$e = new elemento();
	$fecha = $bi->fecha_sql($_POST["fecha"]);
	$tipo="";
	
	$nombre=$_POST["nombre"];
	$ruta = $_POST["ruta"];
	$uploaddir = "../archivos/";
	
	$sw = true; //S.Inicial es que se va a cambiar todo correctamente.
	if($_FILES["archivo"]["name"]!="") //Si entra es que se ha subido un archivo
	{
		if($e->drop_file($uploaddir.$ruta))
		{
			$ruta = $_FILES["archivo"]["name"];	
			$trozos = explode(".",$_FILES["archivo"]["name"]);
			$tipo=$trozos[count($trozos)-1];
			$e->upload_file_simple($_FILES["archivo"],$uploaddir,10485760);
		}
		else
		{
			$html = "<span class='error'>Error, no ha borrado el antiguo archivo</span>";
			$sw=false;
		}
	}
	else
		$tipo=$_POST["tipo"];
	
	if($sw)
	{
		$sql = sprintf("UPDATE po_archivo SET nom='%s',ruta='%s',tipo='%s',orden=%d,fecha='%s',idseccion=%d,idquien=%d WHERE id=%d"
		,$nombre,$ruta,$tipo,$_POST["orden"],$fecha,$_POST["seccion"],$_POST["idquien"],$_GET["edit"]);
		
		$x = new sql($sql);
		if($x->affected()==-1)
			$html = "<span class='error'>Error, no ha modificado el campo</span>";
		else
			$html = "<span class='ok'>Ok, se ha modificado el archivo</span>";
	}
	listar($html);
}

function add() //Implementado.
{
	$e = new elemento("AÑADIR ARCHIVOS");
	$e->elem_text("Nombre","nombre");
	$e->elem_file("Archivo","archivo",10485760); //El tamaño maximo para subir un archivo son 10 MB
	$e->elem_select_sql("IdQuién","idquien","SELECT id AS campo1,titulo AS campo2 FROM po_contenido",$id=0,false,true);
	$e->elem_select_sql("Sección","seccion","SELECT id AS campo1,nom AS campo2 FROM po_seccion",$id=0,false,true);
	$e->elem_text("Orden (Nº)","orden",0);
	echo $e->html();
}

function add_procesa() //Implementado.
{
	//echo "<pre>"; print_r($_FILES["archivo"]); echo "</pre>";
	//echo "<pre>"; print_r($_POST); echo "</pre>";
	
	$bi = new biblioteca();
	if($bi->buscar_nombre($_FILES["archivo"]["name"],"SELECT ruta AS nom FROM po_archivo"))
		$html = "<span class='error'>Error, el archivo ya está en la lista</span>";
	else
	{
		//Obtengo el tipo del archivo
		$explode = explode(".",$_FILES["archivo"]["name"]);
		$tipo = $explode[count($explode)-1];
		
		$e = new elemento();
		$ruta = "../archivos/";
		if($e->upload_file_simple($_FILES["archivo"],$ruta,10485760))
		{
			$sql = sprintf("INSERT INTO po_archivo(nom,ruta,tipo,orden,fecha,idseccion,idquien)VALUES('%s','%s','%s',%d,'%s',%d,%d)"
			,$_POST["nombre"],$_FILES["archivo"]["name"],$tipo,$_POST["orden"],date("Y/m/d"),$_POST["seccion"],$_POST["idquien"]);
			//echo $sql;
			$x = new sql($sql);
			if($x->affected()==-1)
				$html = "<span class='error'>Error al añadir un nuevo elemento</span>";
			else
				$html = "<span class='ok'>Ok,se añadio el archivo correctamente</span>";
		}
		else
			$html = "<span class='error'>Error al añadir un nuevo elemento</span>";
	}
	
	listar($html);
}

function drop($id) //Implementado.
{
	$sql_lista = "SELECT ruta FROM po_archivo WHERE id=".$id;
	$x = new sql($sql_lista);
	$fila =mysql_fetch_array($x->result());

	$ruta = "../archivos/".$fila["ruta"]; //Ruta del archivo a borrar
	
	$e = new elemento();
	if($e->drop_file($ruta))
	{
		$sql_drop = sprintf("DELETE FROM po_archivo WHERE id=".$id);
		$x->query($sql_drop);
		if($x->affected()==-1)
			$html = "<span class='error'>Error al eliminar el archivo</span>";
		else
			$html = "<span class='ok'>Ok,se borro el archivo correctamente</span>";
	}
	else
		$html = "<span class='error'>Error al eliminar el archivo</span>";
	listar($html);
	
}

$haydatos = count($_POST);
if(!$haydatos)
{	
	if(isset($_GET["add"]))
		add();
	else if(isset($_GET["edit"]))
		edit($_GET["edit"]);
	else if(isset($_GET["drop"]))
		drop($_GET["drop"]);
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