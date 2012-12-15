<?php

function listar_categoria()
{
	$bi = new biblioteca();
	$sql = "SELECT po_subcategoria.nom AS nombre,descripcion,po_subcategoria.imagen AS imagen FROM po_subcategoria INNER JOIN po_categoria ON po_categoria.id = po_subcategoria.idcategoria WHERE po_categoria.nom='".$_GET["categoria"]."'"; 
	$x = new sql($sql);
	$result = $x->result();
	
	//1. Publicidad
	echo "<div id='sidebar-top'>";
		echo '
		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-2969828403799030";
		/* Skycraper Horizontal */
		google_ad_slot = "2771336333";
		google_ad_width = 728;
		google_ad_height = 90;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>';
	echo "</div>";
	
	if($x->numrows()==0)
	{
		echo "
		<div class='sin-datos'>
			<p>Lo siento no hay ningún manual de <span>".$bi->formato($_GET["categoria"])."</span> en este momento, disculpen las molestias.</p>
		</div>
		";
	}
	else
	{
		echo "<h3 class='cabecera-general'>Manuales de la sección <span style='font-weight:bold'>".ucwords(str_replace("on","ón",$_GET["categoria"]))."</span></h3>";
		while($fila=mysql_fetch_array($result))
		{
			//Slider Programación
			echo '	<div class="view view-seventh">
				<img src="img/iconos/subcategoria/'.$fila["imagen"].'" />
				<div class="mask">
					<h2>'.$fila["nombre"].'</h2>
					<p>'.$fila["descripcion"].'</p>
					<a href="/'.$_GET["categoria"].'/'.$bi->quitar_formato($fila["nombre"]).'" class="info">Ver Manual</a>
				</div>
			</div>';
			//fin de Slider Programación
		}
	}
	echo "<div id='sidebar-bottom'>";
		echo '<script type="text/javascript"><!--
		google_ad_client = "ca-pub-2969828403799030";
		/* MedioBanner */
		google_ad_slot = "3952271033";
		google_ad_width = 234;
		google_ad_height = 60;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>';
	echo "</div>";

}

function listar_subcategoria()
{
	$bi = new biblioteca();
	
	$sql = "SELECT po_contenido.id AS idcontenido,titulo,po_contenido.descripcion AS descripcion FROM po_contenido INNER JOIN po_subcategoria ON 
	po_contenido.idsubcategoria=po_subcategoria.id WHERE nom='".$bi->formato($_GET["subcategoria"])."' and activo=1 ORDER BY po_contenido.orden ASC";
	//echo $sql;
	
	$cont=1;
	$x = new sql($sql);
	$result = $x->result();
	
	echo '<div id="cont-general" style="width:794px">';
	if($x->numrows()==0)
	{
		echo "
		<div class='sin-datos'>
			<p>Lo siento no hay ningún manual de <span>".$bi->formato($_GET["subcategoria"])."</span> en este momento, disculpen las molestias.</p>
		</div>
		";
	}
	else
	{
	
		$sqlimg = "SELECT imagen FROM po_subcategoria WHERE nom='".$_GET["subcategoria"]."'";
		$x->query($sqlimg);
		
		$fila_img=mysql_fetch_array($x->result());
		echo '
		<div class="listado-titulo">
			<div class="listado-imagen">
				<img src="./img/iconos/subcategoria/'.$fila_img["imagen"].'" alt="'.$fila_img["imagen"].'" id="img-jquery"/>
			</div>
			<h3 class="listado-cabecera">Manual de <span>'.strtoupper($bi->formato($_GET["subcategoria"])).'</span></h3>
		</div>
		<div style="clear:both"></div>
		<div id="cont-acordeon">
			<div id="accordion">
		';
		
		
		while($fila=mysql_fetch_array($result))
		{
			printf("<h3>%d. %s</h3>",$cont,$fila["titulo"]);
			printf("<div>
				<p>%s</p>
				<a href='".$_GET["categoria"]."/".$_GET["subcategoria"]."/".$bi->get_url_amigables($fila["idcontenido"])."' class='ver-contenido'>Ver Contenido</a>
			</div>",$fila["descripcion"]);
			$cont++;
		}
		echo '
			</div>
		</div>';	
		
	}
	//Volver a la Categoria
	echo "<div class='atras-noticias'><a href='".$_GET["categoria"]."'>Atrás</a></div>";
	echo '</div>';
	echo '<div id="sidebar-left" style="padding-left:10px;padding-top:10px;">';
		echo '
			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-2969828403799030";
			/* VerticalMediano */
			google_ad_slot = "9337582014";
			google_ad_width = 160;
			google_ad_height = 90;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		';
		echo '
			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-2969828403799030";
			/* VerticalMediano */
			google_ad_slot = "9337582014";
			google_ad_width = 160;
			google_ad_height = 90;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		';
		echo '
			<script type="text/javascript"><!--
			google_ad_client = "ca-pub-2969828403799030";
			/* VerticalMediano */
			google_ad_slot = "9337582014";
			google_ad_width = 160;
			google_ad_height = 90;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		';
	echo '</div>';
}

function contenido($idcontenido)
{
	$sql = "SELECT titulo,texto,fecha FROM po_contenido WHERE activo=1 and id='".$idcontenido."'";
	$x=new sql($sql);
	$result = $x->result();
	$bi = new biblioteca();
	
	if($x->numrows()==0)
	{
		echo "No hay ninguna noticia, id erronea";
	}
	else
	{
		$fila_cont=mysql_fetch_array($result);
		echo "
		<div id='cont-general'>
			<div class='titulo-general'>
				<div class='titulo'>".$fila_cont["titulo"]."</div>
				<div class='compartir-redes-sociales'>";
				
					$enlace_redes = "www.programandoonline.com/".$_GET["categoria"]."/".$_GET["subcategoria"]."/".$_GET["id"];
					//1. widget de facebook
					echo '<div class="facebook-contenido">
					
					<div class="fb-like" data-href="http://'.$enlace_redes.'" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="verdana"></div>
					
					</div>';
					//2. widget de google+
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
					
					//3. widget de twitter
					echo "
					<div class='twitter-contenido'>
						<a href='https://twitter.com/share' class='twitter-share-button' data-url='http://".$enlace_redes."' data-text='".$fila_cont["titulo"]."' data-via='programandoO' data-lang='es'>Twittear</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='//platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>
					</div>";
					
					//4. widget de tuenti
					echo "<div class='tuenti-contenido'>";
						echo '<script type="text/javascript" src="http://widgets.tuenti.com/widgets.js"></script>
						<a href="http://www.tuenti.com/share" class="tuenti-share-button"
						icon-style="light" share-url="http://'.$enlace_redes.'" suggested-text="'.$fila_cont["titulo"].'"></a>';
					echo "</div>";
					
					$c = new comentario($idcontenido);
					echo "
					<div class='comentarios-noticia2'>
						<img src='img/iconos/comentarios.png' alt='comentarios' style='float:left;'/>
						<div class='num-comentarios'><b>".$c->nComentarios()."</b> comentarios</div>
					</div>";
				
		echo "
				<div style='clear:both'></div>
				</div>
			</div>";
		echo "
			<div id='contenido-bbdd'>
				".$bi->verCodigo($fila_cont["texto"])."
			</div>";
			//Seguir en Twitter
			echo '<div class="seguir-redes-sociales">';
				echo '
				<a href="https://twitter.com/ProgramandoO" class="twitter-follow-button" data-show-count="false" data-lang="es">Seguir a @ProgramandoO</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				';
			echo '</div>';
			
			//Comentarios
			echo "<div id='comentarios-mostrar' data-idcontenido=".$idcontenido.">comentarios</div>";
			//Volver a Subcategoria ...
			echo "<div class='atras-noticias'><a href='".$_GET["categoria"]."/".$_GET["subcategoria"]."'>Atrás</a></div>";
			
		echo "</div>";
	
	}
	
	//División de publicidad
	echo "<div id='sidebar-left'>";
		echo '
		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-2969828403799030";
		/* ContProLinuxWin */
		google_ad_slot = "2304589578";
		google_ad_width = 160;
		google_ad_height = 600;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
		';	
	echo "</div>";
}

$bi = new biblioteca();
if(isset($_GET["subcategoria"]))
{
	if(isset($_GET["id"]))
	{
		$idcontenido = $bi->get_id_amigable($_GET["id"]);
		contenido($idcontenido);
	}
	else
		listar_subcategoria();
	
}
else
	listar_categoria();
?> 
 