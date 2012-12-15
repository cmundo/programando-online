<?php

function listar($html="")
{
	$l = new listado("CONTENIDO");
	if(!empty($html))
		$l->leyenda($html);
	$l->listado("SELECT id,titulo,descripcion,texto,activo,fecha FROM po_contenido ORDER BY fecha DESC"); 
	echo $l->html();
}

function add($idselecionar=4) // Por defecto pongo el idseleccionar a 4 para que salga selecionada el tipo noticias.
{
	$e = new elemento("AÑADIR CONTENIDO");
	
	if($idselecionar==0)
		$e->elem_select_onchange("Categoria","onchange-categoria","SELECT id AS campo1,nom AS campo2 FROM po_categoria WHERE nom<>'inicio' && nom<>'contacto' ORDER BY nom ASC");
	else
		$e->elem_select_onchange("Categoria","onchange-categoria","SELECT id AS campo1,nom AS campo2 FROM po_categoria WHERE nom<>'inicio' && nom<>'contacto' ORDER BY nom ASC",$idselecionar);
	
	$e->elem_select_sql("Subcategoria","subcategoria","SELECT id AS campo1,nom AS campo2 FROM po_subcategoria WHERE idcategoria=".$idselecionar." ORDER BY nom ASC");
	$e->elem_text("Titulo","titulo");
	$e->elem_textarea("Descripción","descripcion");
	$e->elem_text("Fecha","fecha",date("d/m/Y"));
	$e->elem_text("Orden","orden");
	$e->elem_select("Activo","activo","1=ON,2=OFF");
	
	//1.Añado el botón que insertar el codigo
	$codigo='
		<div id="formato-codigo">
			<p>Insertar Script para mostrar código:</p>
			<div id="js-codigo" data-codigo="js"></div>
			<div id="php-codigo" data-codigo="php"></div>
			<div id="resultado-codigo"></div>
		</div>
	';
	$e->html_libre($codigo);
	
	//2.Añado la fotos que tienen asignada la noticia
	$img="
		<div id='enlace-imagenes'></div>
		<div id='slider-imagenes'>
		
		</div>
		<div id='resultado-imagen'></div>
	";
	$e->html_libre($img);
	
	if($idselecionar==4) //id -->4 es igual a selecionar
		$e->elem_tinymce("Texto","texto");
	else
		$e->elem_textarea("Texto","texto","",false,"style='height:500px;width:750px'");
	
	//3.Técnicas-seo
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

function procesa_add() //Implementado.
{
	//echo "<pre>".print_r($_POST,true)."</pre>";
	$bi = new biblioteca();
	$fechasql = $bi->fecha_sql($_POST["fecha"]);
	
	$sql = sprintf("INSERT INTO po_contenido(titulo,descripcion,texto,activo,fecha,idsubcategoria,idtipo,description,keywords,orden) VALUES ('%s','%s','%s',%d,'%s',%d,%d,'%s','%s',%d)",
	$_POST["titulo"],$_POST["descripcion"],$_POST["texto"],$_POST["activo"],$fechasql,$_POST["subcategoria"],$_POST["onchange-categoria"],$_POST["description"],$_POST["keywords"],$_POST["orden"]);
	
	$x = new sql($sql);
	
	if($x->affected()==-1)
		$html = "<span class='error'>Error, no se ha insertado el contenido</span>";
	else
		$html = "<span class='ok'>Ok, se ha insertado el contenido</span>";
		
	listar($html);
}
function drop($id) //Falta por implementar..!
{
	$sql = sprintf("DELETE FROM po_contenido WHERE id=%d",$id);
	$x = new sql($sql);
	
	if($x->affected()==-1)
		$html = "<span class='error'>Error, no se ha podido borrar</span>";
	else
		$html = "<span class='ok'>OK, se ha borrado correctamente</span>";
	
	listar($html);
}

function edit($id,$idselecionar=0) //Implementado.
{
	$e = new elemento("Editar noticias");
	$bi = new biblioteca();
	
	$sql = new sql("SELECT * FROM po_contenido WHERE id=".$id);
	$fila = mysql_fetch_array($sql->result());
	
	if($idselecionar==0)
		$e->elem_select_onchange("Categoria","edit-onchange-categoria","SELECT id AS campo1,nom AS campo2 FROM po_categoria WHERE nom<>'inicio' && nom<>'contacto' ORDER BY nom ASC",$fila["idtipo"]);
	else
		$e->elem_select_onchange("Categoria","edit-onchange-categoria","SELECT id AS campo1,nom AS campo2 FROM po_categoria WHERE nom<>'inicio' && nom<>'contacto' ORDER BY nom ASC",$idselecionar);
	
	if($idselecionar>0)
		$e->elem_select_sql("Subcategoria","subcategoria","SELECT id AS campo1,nom AS campo2 FROM po_subcategoria WHERE idcategoria=".$idselecionar." ORDER BY nom ASC");
	else
		$e->elem_select_sql("Subcategoria","subcategoria","SELECT id AS campo1,nom AS campo2 FROM po_subcategoria WHERE id=".$fila["idsubcategoria"]." ORDER BY nom ASC");
		
	$e->elem_text("Titulo","titulo",$fila["titulo"]);
	$e->elem_textarea("Descripción","descripcion",$fila["descripcion"]);
	$e->elem_text("Fecha","fecha",$bi->fecha($fila["fecha"]));
	$e->boton("edit");
	$e->elem_select("Activo","activo","1=ON,0=OFF",$fila["activo"]);
	$e->elem_text("Orden","orden",$fila["orden"]);
	
	//1.Añado el botón que insertar el codigo
	$codigo='
		<div id="formato-codigo">
			<p>Insertar Script para mostrar código:</p>
			<div id="js-codigo" data-codigo="js"></div>
			<div id="php-codigo" data-codigo="php"></div>
			<div id="resultado-codigo"></div>
		</div>
	';
	$e->html_libre($codigo);
	
	//2.Añado la fotos que tienen asignada la noticia
	$img="
		<div id='enlace-imagenes'></div>
		<div id='slider-imagenes'>
		
		</div>
		<div id='resultado-imagen'></div>
	";
	$e->html_libre($img);
	
	if($idselecionar!=199) //id -->4 es igual a selecionar
		$e->elem_tinymce("Texto","texto",$fila["texto"]);
	else
		$e->elem_textarea("Texto","texto",$fila["texto"],false,"style='height:500px;width:750px'");
		
	//3.Técnicas-seo
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
	
	echo $e->html();
}

function procesa_edit() //Implementado.
{
	//secho "<pre>".print_r($_POST,true)."</pre>";
	$bi = new biblioteca();
	$fechasql = $bi->fecha_sql($_POST["fecha"]);
	$idtipo = $_POST["edit-onchange-categoria"]; //La idtipo es la idcategoria porque asi sabemos el tipo de noticia que es.
	
	$sqlcont = sprintf("UPDATE po_contenido SET titulo='%s',descripcion='%s',texto='%s',activo=%d,fecha='%s',idsubcategoria=%d,idtipo=%d,orden=%d,keywords='%s',description='%s' WHERE id=%d",
	$_POST["titulo"],$_POST["descripcion"],$_POST["texto"],$_POST["activo"],$fechasql,$_POST["subcategoria"],$idtipo,$_POST["orden"],$_POST["keywords"],$_POST["description"],$_GET["edit"]);
	
	//echo $sqlcont;
	$x = new sql($sqlcont);
	
	if($x->affected()==-1)
		$html = "<span class='error'>Error, no se ha modificado el contenido</span>";
	else
		$html = "<span class='ok'>Ok, se ha modificado el contenido</span>";
	listar($html);
}


//Comprobaciones básicas
$haydatos = count($_POST);
if(!$haydatos)
{
	if(isset($_GET["add"]))
		add();
	else if(isset($_GET["drop"]))
		drop($_GET["drop"]);
	else if(isset($_GET["edit"]))
		edit($_GET["edit"]);
	else
		listar();
}
else if(isset($_POST["add"]))
{
	procesa_add();
}
else if(isset($_POST["edit"]))
{
	procesa_edit();
}
else if(isset($_POST["edit-onchange-categoria"]))
{
	edit($_GET["edit"],$_POST["edit-onchange-categoria"]); // Es la id de la noticia a modificar y la id para selecionar la categoria en la zona noticia
}
else if(isset($_POST["onchange-categoria"])) // Es la id, para que se selecione el combo de categoria en la zona noticia
{
	add($_POST["onchange-categoria"]);
}	
?>