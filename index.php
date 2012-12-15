<?php
	//error_reporting(0);
	include("librerias/clase_sql.php");
	include("librerias/biblioteca.php");
	include("librerias/metas.php");
	include("librerias/menu.php");
	include("librerias/comentarios.php");
	
	$x = new biblioteca();
	$x->seguridad();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head>
	<?php
		$meta = new meta();
		echo $meta->listar_metas();
	?>
	
	<link rel='stylesheet' type='text/css' href='/css/busqueda.css' />
	<link rel='stylesheet' type='text/css' href='/css/comentario.css' />
	<link rel='stylesheet' type='text/css' href='/css/layout.css' />
	
	<!-- Ultima versión de jQuery -->
	<script type="text/javascript" src="/scripts/jquery-1.8.2.min.js"></script>
	
	<!-- Menu despegable superfish -->
	<link rel="stylesheet" type="text/css" href="/css/menu/superfish.css" media="screen">
	<!-- <script type="text/javascript" src="scripts/menu/jquery-1.2.6.min.js"></script> No es necesario -->
	<script type="text/javascript" src="/scripts/menu/hoverIntent.js"></script>
	<script type="text/javascript" src="/scripts/menu/superfish.js"></script>
	<script type="text/javascript">
	// Inicializo los plugins
	jQuery(function(){
		jQuery('ul.sf-menu').superfish();
	});
	</script>
	<!-- / menu Superfish -->
	
	<!-- Fancybox -->
	<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script>
		!window.jQuery && document.write('<script src="./scripts/jquery-1.4.3.min.js"><\/script>');
	</script>-->
	<script type="text/javascript" src="/scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="/scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="/scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
 	<!-- <link rel="stylesheet" href="style.css" /> -->
	<script type="text/javascript">
		$(document).ready(function() {
			$("a.fancybox").fancybox({
				'transitionIn'	: 'none',
				'transitionOut'	: 'none'
			});
		});
	</script>
	<!-- /Fancybox -->
	
	<?php
	if(isset($_GET["categoria"]))
	{
		if($_GET["categoria"]=="contacto")
		{
			echo '
			<!-- Script y CSS para el formulario -->
			<link rel="stylesheet" type="text/css" href="/css/formulario/estilos.css">
			<script type="text/javascript" src="/scripts/formulario/funciones.js"></script>
			<!-- Fin del Script y CSS del formulario -->';
		}
	}
	?>
	
	
	<!-- SCRIPT DE GOOGLE -->
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-34249409-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
	<!-- FIN DE SCRIPT DE GOOGLE -->
	
	<!-- Script Slider -->
	<!-- <script type="text/javascript" src="scripts/jquery-1.4.1.min.js"></script> Lo quito porque sino no me funciona el fancybox-->
	<script type="text/javascript" src="/scripts/slider/jquery.jcarousel.pack.js"></script>
	<script type="text/javascript" src="/scripts/slider/jquery.jcarousel.setup.js"></script>
	<link rel="stylesheet" href="/css/slider/featured_slide.css" type="text/css" />
	<!-- / Script Slider -->

	<!-- jQueryUI -->
	<link rel="stylesheet" href="/css/jquery-ui.css" />
    <!-- <script src="http://code.jquery.com/jquery-1.8.2.js"></script> -->
    <script src="/scripts/jqueryui/js/jquery-ui-1.9.0.custom.min.js"></script>
	<!-- /jQueryUI -->
	
	<!-- Script syntaxhighlighter -->
	<script type="text/javascript" src="/scripts/syntaxhighlighter/scripts/shCore.js"></script>
	<script type="text/javascript" src="/scripts/syntaxhighlighter/scripts/shBrushJScript.js"></script>
	<script type="text/javascript" src="/scripts/syntaxhighlighter/scripts/shBrushBash.js"></script>
	<script type="text/javascript" src="/scripts/syntaxhighlighter/scripts/shBrushPhp.js"></script>
	<script type="text/javascript" src="/scripts/syntaxhighlighter/scripts/shBrushXml.js"></script>
	<link type="text/css" rel="stylesheet" href="/scripts/syntaxhighlighter/styles/shCoreDefault.css"/>
	<script type="text/javascript">SyntaxHighlighter.all();</script>
	<!-- /Fin del Script syntaxhighlighter -->
	
	<!-- jQuery de Programando Online -->
    <script type="text/javascript" src='/scripts/jquery-programandoonline.js'></script>
	<!-- Fin de jQuery de Programando Online -->
	
	<link rel='shortcut icon' type='image/x-icon' href='/img/favicon/logo.ico' />
	<link rel="stylesheet" type="text/css" href="/css/slider_square/style_common.css" />
    <link rel="stylesheet" type="text/css" href="/css/slider_square/style7.css" />
	<base href="/"/> <!-- Sirve para poner / en los href de html, para que sean rutas absolutas-->
</head>

<body>
	<!-- Facebook(Like) -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- /Facebook(Like) -->
	
	<div id='container'>
		<div id='header'>
			<div class='logo'>
				<a href='index.php'><img style='border:none' src='img/logo-de-programando-online.png' alt='logo de programando online' /></a>
			</div>
			<div id='content-header-right'>
				<div class='zona1-right'>
					<div id='navi'>
						<?php
							$menu = new menu();
							$menu->listar_menu();
						?>
					</div>
				</div>
				<div class='zona2-right'>
					<div class='redes_sociales'>
						<a href='https://plus.google.com/100516697320157244982/posts' target='_blank'><div id='rs_google'></div></a>
						<a href='https://www.facebook.com/ProgramandoOnline' target='_blank'><div id='rs_facebook'></div></a>
						<a href='https://twitter.com/ProgramandoO' target='_blank'><div id='rs_twitter'></div></a>
						<a href='http://www.youtube.com/user/ProgramandoOnline/videos' target='_blank'><div id='rs_youtube'></div></a>
					</div>
					<div class='buscador'>
						<!-- <form id='form-busqueda' name='frm' method='get' action='index.php?categoria=busqueda'>
							<input type='hidden' name='categoria' value='busqueda' />
							<div style='float:left'><input id='buscador-icon' type='text' name='buscar' placeholder='Buscar...' /></div>
							<div id='buscador-image'><input id='buscador-botton' type='submit' name='' value='' /></div>
						</form>-->
						
						<!-- Buscador de Google -->
						<form action="http://www.google.es" id="cse-search-box" target="_blank">
						  <div>
							<input type="hidden" name="cx" value="partner-pub-2969828403799030:6630726675" />
							<input type="hidden" name="ie" value="UTF-8" />
							<div style='float:left'><input type="text" id='buscador-icon' name="q" size="55" /></div>
							<div id='buscador-image'><input type="submit" name="sa" id='buscador-botton' value="" /></div>
						  </div>
						</form>
						<script type="text/javascript" src="http://www.google.es/coop/cse/brand?form=cse-search-box&amp;lang=es"></script>

						
						<script type="text/javascript" src="http://www.google.com/cse/query_renderer.js"></script>
						<div id="queries"></div>
						<script src="http://www.google.com/cse/api/partner-pub-2969828403799030/cse/6630726675/queries/js?oe=UTF-8&amp;callback=(new+PopularQueryRenderer(document.getElementById(%22queries%22))).render"></script>
						<!-- Fin de Buscador de Google -->

						
					</div>
				</div>
			</div>
		</div>
		
		<div id='shadow'>
			<?php 
			if($x->mostrar_breadcrumb())
			{ 
				echo "<div id='breadcrumb'>"; // Miga de pan
					 echo $x->listar_breadcrumb();
				echo "</div>";
			} 
			?>
			<div id='content'>
				<?php
					
					echo $x->contenido();
					echo "<div style='clear:both'></div>";
				?>
			</div>
			<div id='content2'>
				<div class='box-center'>
					<div class='box'>
						<h3 class='box-imagen-otros-enlace'>Otros enlaces</h3>
						<hr />
						<div id='otros-enlaces'>
							<script type="text/javascript"><!--
								google_ad_client = "ca-pub-2969828403799030";
								/* Principal */
								google_ad_slot = "3111514074";
								google_ad_width = 125;
								google_ad_height = 125;
								//-->
							</script>
							<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
							
							<script type="text/javascript"><!--
								google_ad_client = "ca-pub-2969828403799030";
								/* Principal */
								google_ad_slot = "3111514074";
								google_ad_width = 125;
								google_ad_height = 125;
								//-->
							</script>
							<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
						</div>
					</div>
					<div class='box'>
						<h3 class='box-imagen-paypal'>Donaciones</h3>
						<hr />
						<p id='parrafo-paypal'>Si nuestro contenido te ayudo y quieres ayudarnos económicamente.</p>
						<div id='pagos-paypal'>
							<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
								<input type="hidden" name="cmd" value="_s-xclick">
								<input type="hidden" name="hosted_button_id" value="5DBUKMQZTDSVY">
								<input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal. La forma rápida y segura de pagar en Internet.">
								<img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
							</form>
						</div>
					</div>
					
					<div class='box'>
						<h3 class='box-imagen-recomendadas'>Páginas Recomendadas</h3>
						<hr />
						<?php
							$sql_enlaces = "SELECT titulo,ruta FROM po_enlace INNER JOIN po_seccion ON po_enlace.idseccion = po_seccion.id WHERE po_seccion.nom='inicio'
							ORDER BY orden LIMIT 0,4";
							$x = new sql($sql_enlaces);
							$result = $x->result();
							echo "<ul style='margin:0px'>";
							while($fila=mysql_fetch_array($result))
							{
								printf ("<li class='enlaces-inicio'><a href='http://%s' target='_black'>%s</a></li>",$fila["ruta"],$fila["titulo"]);
							}
							
							echo "</ul>";
						?>
					</div>
					<div style='clear:both'></div>
				</div>
				<div id='menu-enlaces'>
					<script type="text/javascript"><!--
					google_ad_client = "ca-pub-2969828403799030";
					/* Menu-enlaces */
					google_ad_slot = "3092543199";
					google_ad_width = 728;
					google_ad_height = 15;
					//-->
					</script>
					<script type="text/javascript"
					src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
					</script>
				</div>
			</div>
		</div>
		
		<div id='footer'>
			<div id='copyright'>
				Copyright &copy; 2012 by <a href='index.php'>Programando Online</a>
			</div>
		</div>
		<div id='cargando'><div id='cargando-text'>cargando ...</div></div>
	</div>
</body>
</html>