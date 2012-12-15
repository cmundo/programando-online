<?php

// include("clase_sql.php");
class meta
{
	protected $title;
	protected $keywords;
	protected $description;
	
	public function __construct()
	{
		$this->title="";
		$this->keywords="";
		$this->description="";
		$this->set_meta();
	}
	
	public function get_title()
	{
		$titulo  = ucwords($this->title);
		if(isset($_GET["categoria"]))
		{
			if($_GET["categoria"]=="error")
				$titulo = "Error 404";
			else if($_GET["categoria"]=="inicio")
				$titulo = "Programando Online";
			else if(isset($_GET["subcategoria"]) || isset($_GET["id"]))
				$titulo = $titulo." - Programando Online";
			else
				$titulo = "Programando Online - ".$titulo;
		}
		else
			$titulo = "Programando Online";	
		return $titulo;
	}	
	
	public function get_keywords()
	{
		return $this->keywords;
	}	
	
	public function get_description()
	{
		return $this->description;
	}
		
	public function set_meta()
	{
		$sql = "";
		$bi = new biblioteca();
		if(isset($_GET["categoria"]))
		{
			if(isset($_GET["subcategoria"]))
			{
				if(isset($_GET["id"]))
				{
					//echo "Esto es para el contenido de programacion,linux,windows,";
					$id = $bi->get_id_amigable($_GET["id"]);
					$sql = sprintf("SELECT titulo,po_contenido.keywords AS keywords,po_contenido.description AS description FROM po_contenido 
					INNER JOIN po_categoria ON po_contenido.idtipo=po_categoria.id WHERE nom<>'noticias' AND po_contenido.id=%d",$id);
				}
				else
				{
					//echo "Esto es para la subcategoria de programaci�n,linux,windows,....";
					$sql = sprintf("SELECT nom AS titulo,keywords,description FROM po_subcategoria  WHERE nom='%s'",$_GET["subcategoria"]);
				}
			}
			else if(isset($_GET["id"]))
			{
				$id = $bi->get_id_amigable($_GET["id"]);
				$sql = sprintf("SELECT titulo,po_contenido.keywords AS keywords,po_contenido.description AS description FROM po_contenido INNER JOIN po_categoria
				ON po_contenido.idtipo = po_categoria.id WHERE nom='noticias' AND po_contenido.id=%d",$id);
			}
			else
			{
				//echo "Esto es para la categorias inicio,contacto,etc";
				$sql = sprintf("SELECT nom AS titulo,keywords,description FROM po_categoria WHERE nom='%s'",$_GET["categoria"]);
			}
		}
		else
		{
			//echo "Esto solo es para inicio.....";
			$sql = "SELECT nom AS titulo,keywords,description FROM po_categoria WHERE nom='inicio'";
		}
		
		$x = new sql($sql);
		$result = $x->result();
		
		//echo $sql."<br /><br />";
		$fila=mysql_fetch_array($result);
		//echo "Titulo: ".$fila["titulo"]."<br />";
		//echo "Keywords: ".$fila["keywords"]."<br />";
		//echo "Description: ".$fila["description"]."<br />";
			
		$this->title = $fila["titulo"];
		$this->keywords = $fila["keywords"];
		$this->description = $fila["description"];
		
		//$x->destruir();
	}
	
	public function listar_metas()
	{	
		//<meta name='robots' content='index,follow' />
		return
		'<title>'.$this->get_title().'</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content="'.$this->get_description().'" />
		<meta name="keywords" content="'.$this->get_keywords().'" />
		<meta name="copyright" content="Copyright (C) Programando Online" />
		<meta name="author" content="Rubén González Juan" />
		<meta name="reply-to" content="programandoonline@gmail.com" />
		<meta name="language" content="es" />
		<meta name="charset" content="UTF-8" />
		<meta name="distribution" content="global" />
		<meta name="rating" content="general" />
		<meta name="robots" content="index,follow" />
		<meta name="revisit-after" content="7 days" />
		<meta name="expires" content="never" />';
	}
}
?>