<?php
//include("clase_sql.php");
class biblioteca
{
	public function fecha($fecha)
	{
		$ano = substr($fecha,0,4);
		$mes = substr($fecha,5,2);
		$dia = substr($fecha,8,2);
		
		return $dia."/".$mes."/".$ano;
	}
	
	public function fecha_sql($fecha)
	{
		$dia = substr($fecha,0,2);
		$mes = substr($fecha,3,2);
		$ano = substr($fecha,6,4);
		
		return $ano."/".$mes."/".$dia;
	}
		
	public function reducir_texto($texto,$size_min=300) //Comprobar funcionamiento...
	{
		$corte_texto = substr($texto,$size_min);
		if(is_integer(strpos($corte_texto," ")))
			$pos = strpos($corte_texto," ");
		else
			return substr($texto,0,$size_min);
				
		if($pos>100)
			$texto = substr($texto,0,$size_min);
		else
		{
			$texto = substr($texto,0,$size_min+$pos);
			$texto = $texto."<span style='font-weight:bold'> . . .</span>";
		}
		
		return $texto;
	}
	
	public function reducir_texto_sin_elem($texto,$tam=300)
	{
		
		$textoa = strip_tags($texto,"<p>");
		
		$texto2 = substr($textoa,$tam);
		
		$pos = strpos($texto2,"</p>")+4;
		
		if($pos>=100)
		{
			//echo "hola";
			$pos_nbsp = strpos($texto2," ");
			
			$textoa = substr($textoa,0,$tam+$pos_nbsp);
			$textoa.= " . . .</p>";
		}
		else
		{
			$textoa = substr($textoa,0,$tam+$pos);
			$textoa.= " . . .";
		}
		
		//echo "posicion:" . $pos;
		
		return $textoa;
	}
	
	/*BREADCRUMB*/
	public function mostrar_breadcrumb() //Esta function devuelve true o false
	{
		if(!isset($_GET["categoria"]))
			$categoria = "inicio";
		else
			$categoria = $_GET["categoria"];
			
		$x=new sql("SELECT mostrar_breadcrumb as mostrar FROM po_categoria WHERE nom='".$categoria."'");
		$result_breadcrumb = $x->result();
		$fila=mysql_fetch_array($result_breadcrumb);
		
		if($fila["mostrar"]==1)
			return true;
		else
			return false;
	}

	public function listar_breadcrumb() //Implementado.
	{
		$html = "<span><a class='breadcrumb-enlaces' href='index.php'>Inicio</a> &raquo; ";
		if(isset($_GET["categoria"]))
		{
			if(isset($_GET["subcategoria"]))
			{
				if(isset($_GET["id"]))
				{
					$html.= "<a class='breadcrumb-enlaces' href='".$_GET["categoria"]."'>".ucwords($this->formato($_GET["categoria"]))."</a>";
					$html.=" &raquo; ";
					$html.= "<a class='breadcrumb-enlaces' href='".$_GET["categoria"]."/".$_GET["subcategoria"]."'>".ucwords($this->formato($_GET["subcategoria"]))."</a>";
					$html.=" &raquo; ";
					
					$id = $this->get_id_amigable($_GET["id"]);
					//echo "Id de la noticia: ".$id;
					$html.= $this->buscar_titulo_por_id($id);
				}
				else
				{
					$html.= "<a class='breadcrumb-enlaces' href='".$_GET["categoria"]."'>".ucwords($this->formato($_GET["categoria"]))."</a>";
					$html.=" &raquo; ";
					$html.= ucwords($this->formato($_GET["subcategoria"]));
				}
			}
			else if(isset($_GET["id"]))
			{
				$html.= "<a class='breadcrumb-enlaces' href='".$_GET["categoria"]."'>".ucwords($this->formato($_GET["categoria"]))."</a>";
				$html.=" &raquo; ";	
				$id = $this->get_id_amigable($_GET["id"]);
				$html.= $this->buscar_titulo_por_id($id);
			}
			else
			{
				$html.= ucwords($this->formato($_GET["categoria"]));
			}
		}	
		else
		{
			$html="<span>Error, página no encontrada";
		}
		$html.= "</span>";
			
		return $html;
	}
	/*FIN DE BREADCRUMB*/
	
	/* CONTENIDO GENERAL */
	// public function contenido() //Esta función evita que falle la pagina si cambiamos el GET --> sin acabar
	// {
		//echo "<pre>".print_r($_GET,true)."</pre>";
		// if(!isset($_GET["categoria"]))
			// $categoria="inicio";
		// else
			// $categoria = $_GET["categoria"];
		// $zona=$this->quitar_formato($categoria);
		
		// if(file_exists("public_html/".$zona.".php"))
			// include("./public_html/".$zona.".php");
		// else
			// include("./public_html/error.php");
	//}
	
	/*************************SEGURIDAD*************************************/
	public function existe_subcategoria($subcategoria)
	{
		$sql = "SELECT nom FROM po_subcategoria WHERE nom='".$subcategoria."'";
		$x = new sql($sql);
		$n = $x->numrows();
		if($n<=0)
			return false;
		else
			return true;
	}
	
	public function existe_titulo_id($titulo_id)
	{
		$id = $this->get_id_amigable($titulo_id);
		if($id>0)
			return true;
		else
			return false;
	}
	
	public function seguridad()
	{
		if(isset($_GET["categoria"]))
		{
			if(isset($_GET["subcategoria"]))
			{
				if(isset($_GET["id"]))
				{
					$titulo_id = $_GET["id"];
					if(!$this->existe_titulo_id($titulo_id))
						header('location: /error');
				}
				else
				{
					$subcategoria = $_GET["subcategoria"];
					if(!$this->existe_subcategoria($subcategoria))
						header('location: /error');
				}
			}
			else if(isset($_GET["id"]))
			{
				$titulo_id = $_GET["id"];
				if(!$this->existe_titulo_id($titulo_id))
					header('location: /error');
			}
		}
	}
	/******************FIN DE SEGURIDAD***************************************/
	
	public function contenido()
	{
		//echo "<pre>".print_r($_GET,true)."</pre>";
		if(isset($_GET["categoria"]))
			$categoria = $_GET["categoria"];
		else
			$categoria = "inicio";
		
		if(file_exists("public_html/".$categoria.".php"))
			include("./public_html/".$categoria.".php");
		else
			include("./public_html/error.php");
	}
	
	/* FIN DE CONTENIDO GENERAL */
	
	public function buscar_titulo_por_id($id)
	{
		$sql = "SELECT titulo FROM po_contenido WHERE id=".$id;
		$x = new sql($sql);
		$result = $x->result();
		$fila=mysql_fetch_array($result);
		return $fila["titulo"];
		$x->destruir();
	}
	
	public function buscar_categoria_por_nom($nom,$tabla="po_categoria") //Devuelve el nombre de la categoria
	{
		$sql = "SELECT id FROM ".$tabla." WHERE nom=".$nom;
		$x = new sql($sql);
		$result = $x->result();
		$fila=mysql_fetch_array($result);
		return $fila["id"];
	}
	
	public function get_nom_subcategoria($idcontenido)
	{
		if($idcontenido==0)
			return false;
		
		$sql = "SELECT idsubcategoria FROM po_contenido WHERE id=".$idcontenido;
		$x=new sql($sql);
		$fila=mysql_fetch_array($x->result());
		$idsubcategoria = $fila["idsubcategoria"];
		
		$sql = "SELECT nom FROM po_subcategoria WHERE id=".$idsubcategoria;
		$x->query($sql);
		$fila = mysql_fetch_array($x->result());
		return $this->quitar_formato($fila["nom"]);
	}
	
	public function quitar_formato($palabra)
	{
		//$palabra = strtolower($palabra); //Me daba un error de codificación mirar mas adelante.
		$palabra = str_replace("ón","on",$palabra);
		$palabra = str_replace("ía","ia",$palabra);
		$palabra = strtolower($palabra);
		
		return $palabra;
	}
	
	public function formato($palabra)
	{
		$palabra = str_replace("on","ón",$palabra);
		//$palabra = ucwords(str_replace("ia","ía",$palabra));
		$palabra = str_replace("ia","ía",$palabra);
		return $palabra;
	}
	
	public function verCodigo($texto)
	{
		$texto = str_replace("((","&lt;",$texto);
		$texto = str_replace("))","&gt;",$texto);
		return $texto;
	}
	
	public function quitar_acentos($nom)
	{
		return str_replace(array("á","é","ó","í","ú"),array("a","e","o","i","u"),$nom);
	}
	
	public function get_url_amigables($id)
	{
		$sql = "SELECT titulo FROM po_contenido WHERE id=".$id;
		$x = new sql($sql);
		$fila = mysql_fetch_array($x->result());
		$titulo = $fila["titulo"];
		$titulo = $this->quitar_acentos($titulo);
		$titulo = str_replace("-","*",$titulo);
		$titulo = str_replace(" ","-",$titulo);
		
		$titulo = str_replace(".","_",$titulo);
		$titulo = str_replace("ñ","n",$titulo);
		$titulo = strtolower($titulo);
		return $titulo;
	}
	
	public function get_id_amigable($nom)
	{
		$nom = str_replace("-"," ",$nom);
		$nom = str_replace("*","-",$nom);
		$nom = str_replace("_",".",$nom);
		$nom = str_replace("n","ñ",$nom);
		$sql = "SELECT id FROM po_contenido WHERE titulo='".$nom."'";
		$x = new sql($sql);
		$fila = mysql_fetch_array($x->result());
		return $fila["id"];
	}
}
?>