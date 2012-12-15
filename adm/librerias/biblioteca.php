<?php
session_start();

class elemento
{
	private $html;
	private $boton;
	
	//Metodos internos
	private function getTexto($texto)
	{
		return "<div class='elem-texto'>".$texto.":</div>";
	}
	private function atras()
	{
		return "<div class='elem-atras'><a href='index.php?zona=".$_GET["zona"]."'>Atrás</a></div>";
	}
	// Fin de metodos internos
	
	public function html_libre($html)
	{
		$this->html.=$html;
	}
	
	public function boton($name="add")
	{
		if($name=="add")
			$id="add_bottom";
		else
			$id="update_bottom"; //Cambiar el selector --> id
			
		$this->boton = "<div id='center-bottom'><input type='submit' id='".$id."' name='".$name."' value='' /></div>";
	}
	
	public function __construct($titulo="")
	{
		$this->boton(); //Lo llamo para que por defecto sea add.
		$this->html="";
		$this->html.="<div id='cont-elementos'>";
		$this->html.="<h3 class='cabecera'>".$titulo."</h3>";
		$this->html.="<form name='frm' enctype='multipart/form-data' method='post' action='".$_SERVER["REQUEST_URI"]."'>";
	}
	
	public function elem_text($texto,$name,$value="",$type="text") //Type es opcional
	{
		$this->html.="
		<div class='elem-fila'>
			".$this->getTexto($texto)."
			<div class='elem'><input type='".$type."' name='".$name."' value='".$value."' /></div>
		</div>";	
	}
	
	public function elem_hidden($name,$value)
	{
		$this->html.="<div class='elem'><input type='hidden' name='".$name."' value='".$value."' /></div>";
	}
	
	public function elem_pass($texto,$name,$value="")
	{
		$this->elem_text($texto,$name,$value,"password");
	}
	
	public function elem_textarea($texto,$name,$value="",$return=false,$style="")
	{
		if(!$return)
		{
			$this->html.="
			<div class='elem-fila'>
				".$this->getTexto($texto)."
				<div class='elem'>
					<textarea name='".$name."' ".$style.">".$value."</textarea>
				</div>
			</div>";
		}
		else
		{
			return "
			<div class='elem-fila'>
				".$this->getTexto($texto)."
				<div class='elem'>
					<textarea name='".$name."'>".$value."</textarea>
				</div>
			</div>";

		}
	}
	
	public function elem_tinymce($texto,$name,$value="",$id='elm1')
	{
		$this->html.="
		<div class='elem-fila'>
			".$this->getTexto($texto)."
			<div class='elem'>
				<textarea id='elm1' name='".$name."'>".$value."</textarea>
			</div>
		</div>";
	}
	
	//$e->elem_select("BreadCrumb","breadcrumb","1=ON,0=OFF");
	public function elem_select($texto,$name,$option,$idselecionar=0)
	{
		$option = explode(",",$option);
		//1=ON
		//2=OFF
		//echo $option[0];
		//echo $option[1];
		
		$this->html.="
		<div class='elem-fila'>
			".$this->getTexto($texto)."
			<div class='elem'>
				<select name='".$name."'>";
					$n = count($option);
					for($i=0;$i<$n;$i++)
					{
						$valores = explode("=",$option[$i]);
						if($valores[0]==$idselecionar)
							$selected = "selected='selected'";
						else
							$selected = "";
						$this->html.=sprintf("<option value='%d' ".$selected.">%s</option>",$valores[0],$valores[1]);
					}
		$this->html.="
				</select>
			</div>
		</div>";
	}
	
	public function elem_select_sql($texto,$name,$sql="SELECT id AS campo1,nom AS campo2 FROM po_categoria",$id=0,$swOnchange=false,$option_ninguna=false) //id -->sirve para selecionar el elemento que tengo esa id
	{
		$sql=new sql($sql);
		$result = $sql->result();
		if($sql->numrows()==0)
			$this->html.="<input type='hidden' name='".$name."' value='0' />";
		else
		{
			$this->html.="<div class='elem-fila'>".$this->getTexto($texto)."
				<div class='elem'>";
			if($swOnchange)
				$this->html.="<select name='".$name."' onChange='submit();'>";
			else
				$this->html.="<select name='".$name."'>";
				
			if($option_ninguna)
			{
				if($id==0)
					$this->html.= "<option value='0' selected='selected'>Ninguna</option>";
				else
					$this->html.= "<option value='0'>Ninguna</option>";
			}
			
			while($fila=mysql_fetch_array($result))
			{
				if($id==$fila["campo1"])
					$this->html.=sprintf("<option value='%d' selected='selected'>%s</option>",$fila["campo1"],substr(ucwords($fila["campo2"]),0,55));
				else
					$this->html.=sprintf("<option value='%d'>%s</option>",$fila["campo1"],substr(ucwords($fila["campo2"]),0,55));
			}
			$this->html.="
					</select>
				</div>
			</div>";
		}
		
	}
	
	function elem_select_onchange($texto,$name,$sql,$idSelecionar=0)
	{
		$this->elem_select_sql($texto,$name,$sql,$idSelecionar,true); //True es para que pongo en el combo OnChange='submit();'
	}
	
	public function elem_file($texto,$name,$tam=500000)
	{
		$this->html.="
			<div class='elem-fila'>
				".$this->getTexto($texto)."
				<div class='elem'>
					<input type='hidden' name='MAX_FILE_SIZE' value='".$tam."' />
					<input name='".$name."' type='file' class='file'/>
				</div>
			</div>";
	}
	
	public function upload_file_simple($file,$uploaddir="../img/iconos/",$tam="500000") //Devuleve un true si se ha subido la imagen
	{
		//echo "<pre>".print_r($file,true)."</pre>";
		$size=$file["size"];
		if($size>=$tam)
			return false;
		else
		{
			$uploadfile = $uploaddir.basename($file['name']);   // ./imagen.png
			if (move_uploaded_file($file['tmp_name'],$uploadfile))    
				return true;
			else  
				return false;
		}
	}
	
	public function drop_file($ruta)
	{
		return unlink($ruta);
	}
	
	public function html()
	{
		$this->html.= $this->boton;
		$this->html.="</form></div>"; //Cierro el form y la div del cont-elementos
		$this->html.= $this->atras();
		return $this->html;
	}
}


/********************************************************************************************************************************************************/

class listado
{
	private $html;
	private $nombres; //Estan los nombre de las tablas y de los input
	public $sql; //Esto es el Objeto de la Clase clase_sql.php
	public $pag; //Paginación del listado
	public $libre;
	
	public function __construct($texto="")
	{
		$this->html="";
		$this->libre="";
		$this->pag="";
		$this->titulo($texto);
	}
	public function titulo($texto)
	{
		$this->html.="<h3 class='cabecera'>".$texto."</h3>";
	}
	
	//Método Interno
	public function paginacion($consulta)
	{
		$tampag = 10;
		
		$x = new sql($consulta);
		$result = $x->result();
		$totalregistros = $x->numrows();
		$totalpag = ceil($totalregistros/$tampag);
		
		if(isset($_GET["pag"]))
		{
			if($_GET["pag"]>=1 && $_GET["pag"]<=$totalpag)
				$pagina = $_GET["pag"];
			else
				$pagina = 1;
		}
		else
			$pagina = 1;
			
		$pag = ($pagina*$tampag)-$tampag;
		
		$consulta = $consulta." LIMIT ".$pag.",".$tampag;
		$this->pag.="<div class='paginacion'>";
		if($totalregistros > $tampag)
		{
			
			
			if($pagina>1)
			{
				$this->pag.="<a class='pag' href='index.php?zona=".$_GET["zona"]."&pag=".($pagina-1)."'> &laquo; </a>";
				$this->pag.="<a class='pag' href='index.php?zona=".$_GET["zona"]."&pag=1'> 1 </a>";
			}
			else
				$this->pag.="<a class='pag-actual' href='index.php?zona=".$_GET["zona"]."&pag=1'> 1 </a>";
			
			for($i=$pagina-3;$i<$pagina+3;$i++)
			{
				if($i>1 && $i<$totalpag)
				{
					if($pagina==$i)
						$this->pag.="<a class='pag-actual' href='index.php?zona=".$_GET["zona"]."&pag=".$i."'> ".$i." </a>";
					else
						$this->pag.="<a class='pag' href='index.php?zona=".$_GET["zona"]."&pag=".$i."'> ".$i." </a>";
				}
			}
			if($totalpag!=1)
			{
				if($pagina<$totalpag)
				{
					$this->pag.="<a class='pag' href='index.php?zona=".$_GET["zona"]."&pag=".$totalpag."'> ".$totalpag." </a>";
					$this->pag.="<a class='pag' href='index.php?zona=".$_GET["zona"]."&pag=".($pagina+1)."'> &raquo; </a>";
				}
				else
					$this->pag.="<a class='pag-actual' href='index.php?zona=".$_GET["zona"]."&pag=".$totalpag."'> ".$totalpag." </a>";
			}
		}
		$this->pag.="</div>";
		
		return $consulta;
	}
	
	public function libre($html="") //Por implementar
	{
		$this->libre=$html;
	}
	
	public function getVideo($ruta,$width=180,$height=100)
	{
		return "<iframe width='".$width."' height='".$height."' src='http://www.youtube.com/embed/".$ruta."' frameborder='0' allowfullscreen></iframe>";
	}
	
	public function leyenda($html)
	{
		$this->html.="<div class='leyenda'>".$html."</div>";
	}
	
	public function boton()
	{
		return "<a href='index.php?zona=".$_GET["zona"]."&add=".$_GET["zona"]."'><div class='add'></div></a>";
	}
	
	public function listado($consulta) //Por implementar...
	{	
		$consulta = $this->paginacion($consulta);
		$bi = new biblioteca();
		$this->consulta($consulta); //Lanzo consulta para obtener el nombre de los campos
		if($this->sql->numrows()==0)
		{
			$this->html.= "<p class='sin_datos'>!! No hay ningún ".$_GET["zona"]." !!</p>";
		}
		else
		{
			$this->html.= "
			<table class='tabla'>
			<tr class='tabla_titulo'>";
			
			$n_nombres = count($this->nombres);
			for($i=0;$i<$n_nombres;$i++)
			{
				$this->html.=sprintf("<td>%s</td>",ucwords($this->nombres[$i]));
			}
			$this->html.= "<td colspan='2'>Tools</td>"; //Añado está a lo ultimo
			$this->html.= "</tr>";
			
			
			$cont=0;
			$result = $this->sql->result();
			while($fila=mysql_fetch_array($result))
			{
				if($cont%2==0)
					$this->html.=  "<tr class='even' >";
				else
					$this->html.=  "<tr class='odd' style='vertical-align:text-top;'>";
				
				for($i=0;$i<$n_nombres;$i++)
				{
					//Comprobaciones para añadir cosas en la lista
					if($this->nombres[$i] == "video")
						$this->html.= sprintf("<td>%s</td>",$this->getVideo($fila[$this->nombres[$i]]));
					else if($this->nombres[$i] == "imagen")
						$this->html.= sprintf("<td><img src='../img/iconos/%s' alt='' style='width:28px;height:28px' /></td>",$fila[$this->nombres[$i]]);
					else if($this->nombres[$i] == "logo")
						$this->html.= sprintf("<td><img src='../img/iconos/subcategoria/%s' alt='' style='width:100px;height:70px' /></td>",$fila[$this->nombres[$i]]);
					else if($this->nombres[$i] == "breadcrumb")
					{
						if($fila[$this->nombres[$i]]==0)
							$this->html.= sprintf("<td>%s</td>","<span style='color:red'>OFF</span>");
						else
							$this->html.= sprintf("<td>%s</td>","<span style='color:green'>ON</span>");
					}
					else if($this->nombres[$i] == "ruta")
					{
						$html="";
						$ruta = $fila[$this->nombres[$i]];
						$trozos = explode(".",$fila[$this->nombres[$i]]);
						$ext = $trozos[count($trozos)-1];
						if($bi->is_img("../archivos/".$ruta))
							$html="<a href='../archivos/".$ruta."' class='fancybox'><img style='width:60px;' src='../archivos/".$ruta."' alt='' /></a>";
						else
						{
							if($ext == "pdf")
								$html="<a href='../archivos/".$ruta."' class='iframe'><img style='width:60px;' src='../img/extensiones/pdf.png' alt='' /></a>";
							else if($ext == "7z" || $ext == "rar" || $ext == "zip")
								$html="<img style='width:60px' src='../img/extensiones/7zip.png' alt='' />";
							else if($ext == "txt")
								$html="<a href='../archivos/".$ruta."' class='iframe'><img style='width:60px' src='../img/extensiones/txt.png' alt='' /></a>";
							else
								$html=$ruta;
						}
						$this->html.=sprintf("<td>%s</td>",$html);
					}
					else if($this->nombres[$i] == "enlace")
					{
						$this->html.= sprintf("<td><a href='http://%s' target='_black'>%s</a></td>",$fila[$this->nombres[$i]],$fila[$this->nombres[$i]]);
					}
					else if($this->nombres[$i] == "clave")
					{
						$this->html.= sprintf("<td>%s</td>",$bi->codificar($fila[$this->nombres[$i]]));
					}
					else if($this->nombres[$i] == "descripcion")
					{
						$this->html.= sprintf("<td><span style='font-size:10px'>%s</span></td>",$fila[$this->nombres[$i]]);
					}
					else if($this->nombres[$i] == "texto")
					{
						$texto = strip_tags($fila[$this->nombres[$i]]);
						$this->html.= sprintf("<td><span style='font-size:10px'>%s</span></td>",substr($texto,0,500)." ...");
					}
					else
						$this->html.= "<td>".$fila[$this->nombres[$i]]."</td>";
				}
				
				$this->html.="	
					<td><a href='".$_SERVER["SCRIPT_NAME"]."?zona=".$_GET["zona"]."&edit=".$fila["id"]."'><img src='../img/tools/b_edit.png' alt='editar' /></a></td>
					<td><a href='".$_SERVER["SCRIPT_NAME"]."?zona=".$_GET["zona"]."&drop=".$fila["id"]."'><img src='../img/tools/b_drop.png' alt='editar' /></a></td>
				</tr>";
				$cont++;
			}
			$this->html.= "</table>";
		}
	}
	
	public function consulta($consulta) //Se añaden los nombres a $this->nombres por el orden en que nombras los campos en las consultas
	{
		$consulta = strtolower($consulta); //Lo pongo en minusculas para que no haya fallos con minusculas y mayusculas.
		$sql = new sql($consulta);
		$this->sql = $sql;
		$result = $sql->result();
		
		//Paso 1
		$n = strpos($consulta,"from"); //Busco la posición donde se encuentra FROM.
		$consulta = substr($consulta,0,$n); //Quito de la consulta desde el FROM hasta el final.
 		$consulta = substr($consulta,6); //Quito de la consulta SELECT.
		//echo $consulta; //el resultado es este: nom AS nombre,ape AS apellidos,correo AS correo,clave AS clave .
		
		$trozos = explode(",",$consulta); //Creo una array con los trozos de la consulta 1) nom AS nombre || 2) ape AS apellidos.
		$n_trozos = count($trozos);
		//echo "<pre>".print_r($trozos,true)."</pre>";
		
		
		//Paso 2, meter los nombres en un array.
		$nom = array(); //Aqui van a ir los nombres de los campos.
		for($i=0;$i<$n_trozos;$i++)
		{
			$campo = $trozos[$i]; //Meto por ejemplo "nom AS nombre"
			$pos = strpos($campo,"as");
			if($pos===false)
				$nom[]=trim($campo); 
			else
			{
				$temp = explode("as",$campo);
				$nom[] = trim($temp[1]); //Meto $temp[1] porque lo que me llega aqui es: nom as nombre.Y lo que me interesa es el nombre.
			}
		}
		//echo "<pre>".print_r($nom,true)."</pre>";
		$this->nombres = $nom;
	}
	
	public function html()
	{
		$this->html.= $this->pag;
		$this->html.= $this->boton();
		$this->html.=$this->libre;
		return $this->html;
	}
}

class biblioteca
{
	public function is_img($ruta)
	{
		if(!is_file($ruta))
			return false;
		
		$trozo = explode(".",$ruta);
		$ext = $trozo[count($trozo)-1];
		//echo $ext;
		
		switch($ext)
		{
			case "jpg":
			case "jpeg":
			case "png":
			case "gif":
			case "bmp":
				return true;
			default:
				return false;
		}
	}
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
	
	public function codificar($clave) //Se utilizar en usuario.php
	{
		$n = strlen($clave);
		$html="";
		for($i=1;$i<=$n;$i++)
		{
			$html.="*";
		}
		return $html;
	}
		
	public function contenido() //esta de pruebas...
	{
		if(isset($_GET["zona"]))
		{
			$ruta = "public_html/".$_GET["zona"].".php";
			if(file_exists($ruta))
			{
				include($ruta);
			}
			else
				include("public_html/error.php");
		}
	}
	
	public function buscar_nombre($nombre,$sql) //Si está el nombre en la BBDD devulve true
	{
		$x = new sql($sql);
		$result = $x->result();
		while($fila=mysql_fetch_array($result))
		{
			if($nombre==$fila["nom"])
				return true;
		}
		return false;
	}
}

?>