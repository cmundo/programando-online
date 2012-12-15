<?php

function listar($html="")
{
	$l = new listado("CATEGORIA");
	if(!empty($html))
		$l->leyenda($html);
		
	$l->listado("SELECT id,nom AS categoria,imagen,orden,mostrar_breadcrumb AS breadcrumb FROM po_categoria");
	echo $l->html();
}

function add()
{
	$e = new elemento("AÑADIR CATEGORIA");
	$e->elem_text("Categoria","categoria");
	$e->elem_file("Imagen","imagen","500000");
	$e->elem_text("Orden","orden");
	$e->elem_select("BreadCrumb","breadcrumb","1=ON,0=OFF");
	//Técnicas-seo
	$html = 
	"<div id='tecnicas-seo'>
		<div>
			<img src='../img/iconos/seo.png' alt='seo' />
			<div class='titulo-seo'>Técnicas SEO</div>
			<div>".
			$e->elem_textarea("Keywords","keywords","",true).
			$e->elem_textarea("Description","description","",true)
			."</div>
		</div>
	</div>";
	$e->html_libre($html);
	echo $e->html();
}


function edit($id)
{
	$e = new elemento("Editar categoria");
	$x = new sql("SELECT * FROM po_categoria WHERE id=".$id);
	$result = $x->result();
	
	$fila=mysql_fetch_array($result);
	$e->elem_text("Categoria","categoria",$fila["nom"]);
	$e->elem_text("Imagen","imagen",$fila["imagen"]);
	$e->elem_text("Orden","orden",$fila["orden"]);
	$e->elem_select("BreadCrumb","breadcrumb","1=ON,0=OFF");
	//Técnicas-seo
	$html = 
	"<div id='tecnicas-seo'>
		<div>
			<img src='../img/iconos/seo.png' alt='seo' />
			<div class='titulo-seo'>Técnicas SEO</div>
			<div>".
			$e->elem_textarea("Keywords","keywords",$fila["keywords"],true).
			$e->elem_textarea("Description","description",$fila["description"],true)
			."</div>
		</div>
	</div>";
	$e->html_libre($html);
	$e->boton("edit");
	$x->destruir();
	echo $e->html();
}

function edit_procesa() //Falta por implementar el editar no sube la img
{
	$sql = sprintf("UPDATE po_categoria SET nom='%s',imagen='%s',orden=%d,mostrar_breadcrumb=%d,keywords='%s',description='%s' WHERE id=%d"
	,$_POST["categoria"],$_POST["imagen"],$_POST["orden"],$_POST["breadcrumb"],$_POST["keywords"],$_POST["description"],$_GET["edit"]);
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
	$sql = sprintf("DELETE FROM po_categoria WHERE id=%d",$id);
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
	
	$e = new elemento();
	if($e->upload_file_simple($_FILES["imagen"]))
	{
		$sql = sprintf("INSERT INTO po_categoria(nom,imagen,orden,mostrar_breadcrumb,keywords,description) values('%s','%s',%d,%d,'%s','%s')",$_POST["categoria"],$_FILES["imagen"]["name"],$_POST["orden"],$_POST["breadcrumb"],$_POST["keywords"],$_POST["description"]);
		//echo $sql;
		$x=new sql($sql);
		
		if($x->affected()==-1)
			$html = "<span style='color:red'>Error, no se ha añadido el Usuario</span>";
		else
			$html = "<span style='color:green'>OK, Se ha añadido correctamente</span>";
	}
	else
		$html = "<span style='color:red'>Error, no se ha añadido el Usuario</span>";
	
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