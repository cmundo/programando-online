<?php

function listar($idnoticia=0) //$sw = Si es true si muestra una noticia a el completo
{
	echo "<div id='noticia-left'>";
		echo '<script type="text/javascript"><!--
		google_ad_client = "ca-pub-2969828403799030";
		/* Noticias */
		google_ad_slot = "1762134351";
		google_ad_width = 160;
		google_ad_height = 600;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>';
	echo "</div>";
	
	$bi = new biblioteca();
	$c = new comentario(0);
	
	if(!empty($idnoticia)) //Mirar SQL optimizar
	{	
		$sql_cont = "SELECT po_contenido.id AS idcontenido,po_categoria.id AS idcategoria,titulo,descripcion,texto,fecha
		FROM po_contenido INNER JOIN po_categoria ON po_contenido.idtipo=po_categoria.id WHERE po_categoria.nom='noticias' AND activo=1 AND po_contenido.id=".$idnoticia;
	}
	else
	{
		$sql_cont = "SELECT po_contenido.id AS idcontenido,po_categoria.id AS idcategoria,titulo,descripcion,texto,fecha
		FROM po_contenido INNER JOIN po_categoria ON po_contenido.idtipo=po_categoria.id WHERE po_categoria.nom='noticias' AND activo=1 ORDER BY fecha DESC";
	}
	$x = new sql($sql_cont);
	$result_cont = $x->result();
	
	echo "<div id='noticia-right'>";//Div para mostrar el contenido de la noticia
	
	if($x->numrows()==0)
	{
		echo "<p style='margin-top:40px'>¡¡ No hay ninguna <b>noticia</b> disponible !!</p>";
	}
	else
	{
		while($fila_cont=mysql_fetch_array($result_cont))
		{
			$c->setId($fila_cont["idcontenido"]);
			$url_amigable = $bi->get_url_amigables($fila_cont["idcontenido"]);
			$enlace_redes = "www.programandoonline.com/".$_GET["categoria"]."/".$url_amigable;
			//echo $enlace_redes;
			echo "
			<div id='titulo-noticia'>
				<div><h3 class='h3-noticia'>".$fila_cont["titulo"]."</h3></div>
				<div class='tool-noticias'>
					<div class='fecha-noticia'><span>Fecha:</span> ".$bi->fecha($fila_cont["fecha"])."</div>
					<div class='redes-sociales'>";
						//widget de facebook
						echo '<div class="facebook-contenido">
						
						<div class="fb-like" data-href="http://'.$enlace_redes.'" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="verdana"></div>
						
						</div>';
						//widget de google+
						echo "<div class='google-contenido'>
							<script type='text/javascript'>
							  window.___gcfg = {lang: 'es'};

							  (function() {
								var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
								po.src = 'https://apis.google.com/js/plusone.js';
								var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
							  })();
							</script>
							<div class='g-plusone' data-size='medium' data-href='http://".$enlace_redes."'></div>
						</div>";
						
						//widget de twitter
						echo "
						<div class='twitter-contenido'>
							<a href='https://twitter.com/share' class='twitter-share-button' data-url='http://".$enlace_redes."' data-text='".$fila_cont["titulo"]."' data-via='programandoO' data-lang='es'>Twittear</a>
							<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='//platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>
						</div>";
						
						//widget de tuenti
						echo "<div class='tuenti-contenido'>";
							echo '<script type="text/javascript" src="http://widgets.tuenti.com/widgets.js"></script>
							<a href="http://www.tuenti.com/share" class="tuenti-share-button"
							icon-style="light" share-url="http://'.$enlace_redes.'" suggested-text="'.$fila_cont["titulo"].'"></a>';
						echo "</div>";
						
					echo"</div>
					<div class='comentarios-noticia'>
						<img src='img/iconos/comentarios.png' alt='comentarios' />
						<div class='num-comentarios'><b>".$c->nComentarios()."</b> comentarios</div>
					</div>
				</div>";
			echo "</div>";
			
			/******Imagen de noticia solo jpg y png*******/
			$sql_img = "SELECT ruta FROM po_archivo WHERE (tipo='jpg' OR tipo='png') AND idquien=".$fila_cont["idcontenido"]." ORDER BY orden ASC LIMIT 0,1";
			$x->query($sql_img);
			$result_img = $x->result();
			$fila_img = mysql_fetch_array($result_img);
			
			if($x->numrows()!=0)
				printf("<div class='imagen-noticia'><a class='fancybox' href='./archivos/%s'><img src='./archivos/%s' alt='' style='height:300px;border:1px solid black' /></a></div>",$fila_img["ruta"],$fila_img["ruta"]);
			
			/******Fin de Imagen de noticia****/
			
			
			echo "<div class='texto-noticia'>";
			
			if(!empty($idnoticia))
				$texto = $fila_cont["texto"];
			else
				$texto = $bi->reducir_texto($fila_cont["texto"],400);
			
			echo $texto;
			echo "</div>";
			
			if(empty($idnoticia))
			{
				echo "<div class='leer-noticias'><a href='/noticias/".$url_amigable."'>Leer más</a></div>";
				echo "<hr class='hr-noticia' />";
			}
			else
			{
				$sql_enlaces = "SELECT titulo,ruta FROM po_enlace WHERE idquien=".$idnoticia;
				$x->query($sql_enlaces);
				$result = $x->result();
				
				if($x->numrows()!=0)
				{
					echo "<div class='enlaces-noticias'><div class='nombre'>Enlaces:</div>";				
						while($row_enlace=mysql_fetch_array($result))
						{
							printf("<div class='site'><a href='http://%s' target='_black'>%s</a></div>",$row_enlace["ruta"],ucwords($row_enlace["titulo"]));
						}
					echo "</div>";
				}
				
				//Comentarios
				echo '<div class="seguir-redes-sociales">';
					echo '
					<a href="https://twitter.com/ProgramandoO" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @ProgramandoO</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					';
				echo '</div>';
				echo "<div id='comentarios-mostrar' data-idcontenido=".$idnoticia.">comentarios</div>";
				
				
				//Atrás Noticias...
				echo "<div class='atras-noticias'><a href='/noticias'>Atrás</a></div>";
			}
		}
	}
	echo "</div>";
	$x->destruir();
}

$bi = new biblioteca();
if(isset($_GET["id"]))
{
	$idnoticia = $bi->get_id_amigable($_GET["id"]);
	if($idnoticia=="")
		listar();
	else
		listar($idnoticia);
}
else
	listar();
?>