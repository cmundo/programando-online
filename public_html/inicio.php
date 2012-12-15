<!-- JQUERY SLIDER -->
<div class="wrapper col2">
  <div id="featured_slide">
		<div id="featured_content">
		  <ul>
			<?php
			$bi = new biblioteca();
			$sql_contenido = "SELECT po_contenido.id AS id,titulo,texto,idtipo FROM po_contenido INNER JOIN po_categoria ON 
			po_contenido.idtipo=po_categoria.id WHERE activo=1 and nom='noticias' ORDER BY fecha DESC LIMIT 0,3";
			//echo $sql_contenido;
			$x = new sql($sql_contenido);
			$result_contenido=$x->result();
				
			while($row_cont=mysql_fetch_array($result_contenido))
			{
				
				$sql_img = "SELECT ruta FROM po_archivo WHERE idquien=".$row_cont["id"]." ORDER BY orden ASC LIMIT 0,1";
				$x->query($sql_img);
				$row_img = mysql_fetch_array($x->result());
				
				if($x->numrows()==0)
					echo "<li><img src='./img/defecto/sinfoto.jpg' alt='' style='width:380px;height:250px' />";
				else
					echo "<li><img src='./archivos/".$row_img["ruta"]."' alt='' style='width:380px;height:250px' />";
			
					echo "
					<div class='floater'>
						<div class='slider-texto'> 
							<h2 class='reducir-titulo'>".$row_cont["titulo"]."</h2>
							<p>".$bi->reducir_texto($row_cont["texto"])."</p>
						</div>
						<div class='div-readmore'>
							<p class='readmore'><a href='noticias/".$bi->get_url_amigables($row_cont["id"])."'>Continuar leyendo &raquo;</a></p>
						</div>
					</div>
				</li>";
			}
			?>
		  </ul>
		</div>
		<a href="javascript:void(0);" id="featured-item-prev"><div id='prev-slider'></div></a> <a href="javascript:void(0);" id="featured-item-next"><div id='next-slider'></div></a> 
	</div>
</div>
 <!-- FIN JQUERY SLIDER -->

<div id='resumen-inicio'>
		<?php
	
		$sql_noticias2 = "SELECT po_categoria.nom AS nomcategoria,po_contenido.id AS id,titulo,texto,idtipo FROM po_contenido INNER JOIN po_categoria ON 
		po_contenido.idtipo=po_categoria.id WHERE activo=1 ORDER BY fecha DESC LIMIT 0,3";
		$x = new sql($sql_noticias2);
		$result_noticias2 = $x->result();
		
		$cont=1;
		while($row_noticia2=mysql_fetch_array($result_noticias2))
		{
			if($cont%2==0)
				$estilos = "style='margin-left:20px;margin-right:20px;'";
			else
				$estilos = "";
			
			$sql_img2 = "SELECT ruta FROM po_archivo WHERE idquien=".$row_noticia2["id"]." ORDER BY orden LIMIT 0,1";
			$x->query($sql_img2);
			$row_img2 = mysql_fetch_array($x->result());
			
			if($x->numrows()==0)
			{
				$ruta_img = "img/defecto/sinfoto_small.jpg";
				$img = "<img class='img-inicio' src='".$ruta_img."' alt='' style='width:60px;height:60px' />";
			}
			else
			{
				$ruta_img = "archivos/".$row_img2["ruta"];
				$img = "<a class='fancybox' href='".$ruta_img."'><img class='img-inicio' src='".$ruta_img."' alt='' style='width:60px;height:60px' /></a>";
			}
			echo "<div class='resumen-inicio' ".$estilos.">";
			echo "
						<div class='cabecera-inicio'>
							".$img."
							<p class='titulo-inicio'>".$row_noticia2["titulo"]."</p>
							<div class='linea-inicio'></div>
						</div>
						<div class='texto-inicio'>".$bi->reducir_texto_sin_elem($row_noticia2["texto"],179)."</div>
						<div class='leer-inicio'>";
						$nomcategoria = $bi->quitar_formato($row_noticia2["nomcategoria"]);
						
						if($nomcategoria=="noticias")
							echo "<a class='leer' href='noticias/".$bi->get_url_amigables($row_noticia2["id"])."'>Continuar leyendo &raquo;</a>";
						else
						{
							$nomsubcategoria = $bi->get_nom_subcategoria($row_noticia2["id"]);
							//echo $nomsubcategoria;
							echo "<a class='leer' href='".$nomcategoria."/".$nomsubcategoria."/".$bi->get_url_amigables($row_noticia2["id"])."'>Continuar leyendo &raquo;</a>";
						}
					echo "</div>
				</div>";
			$cont++;
		}
		
		?>
</div>











