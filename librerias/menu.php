<?php
class menu
{	
	public function listar_menu()
	{
		echo "<ul class='sf-menu menu-estilo'>";
	
		//1. Aqui añado la categoria a el menu
		$sql_categoria='SELECT id AS idcategoria,nom AS nombre,imagen FROM po_categoria ORDER BY po_categoria.orden ASC';
		$x = new sql($sql_categoria);
		$result_categoria = $x->result();
		
		$cont=1;
		$html="";
		$bi = new biblioteca();
		while($row_categoria=mysql_fetch_array($result_categoria))
		{
			$idcategoria=$row_categoria["idcategoria"];
			$categoria = $bi->quitar_formato($row_categoria["nombre"]);
			if($cont==1)
				$html.="\t<li class='current'>\n"; 
			else 
				$html.="\t\t<li>\n";
			
			if($categoria=="noticias")
				$enlace="noticias";
			else if($categoria=="programacion")
				$enlace="programacion";
			else if($categoria=="linux")
				$enlace="linux";
			else if($categoria=="windows")
				$enlace = "windows";
			else if($categoria=="contacto")
				$enlace = "contacto";
			else
				$enlace = "inicio";
				
			$html.="\t\t\t<a style='background:url(img/iconos/".$row_categoria["imagen"].") no-repeat left 5px;' href='./".$enlace."'>".ucwords($row_categoria["nombre"])."</a>\n";
			
			//2. Aqui añado la subcategoria al menu
			$sql_subcategoria='SELECT id AS idsubcategoria,nom AS subcategoria FROM po_subcategoria WHERE idcategoria='.$idcategoria.' ORDER BY po_subcategoria.orden ASC';
			
			$result_subcategoria=$x->query($sql_subcategoria);
			$num_subcategoria=$x->numrows();
			if($num_subcategoria>=1)
			{
				
				$html.="\t\t\t<ul>\n";
				$html.="\t\t\t\t<li>\n";
				while($row_subcategoria=mysql_fetch_array($result_subcategoria))
				{
					$subcategoria = $bi->quitar_formato($row_subcategoria["subcategoria"]);
					$html.="\t\t\t\t<a href='".$enlace."/".$subcategoria."'>".$row_subcategoria["subcategoria"]."</a>";
				}
				$html.="\n\t\t</li>\n";
				$html.="\n\n\t\t\t</ul>\n";
				
			}
			$html.="\t\t</li>\n";
			$cont++;
		}
		echo $html;
		echo "\t</ul>\n";
	}
}
?>