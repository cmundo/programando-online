<?php
require_once("librerias/biblioteca.php");
require_once("../librerias/clase_sql.php");

$x = new biblioteca();

if(!isset($_SESSION["idusuario"]))
	header("location: login.php");
else
{
?>

<html>
<head>
	<title>Panel de Administración</title>
	
	<!-- Meta -->
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<meta name='robots' content='noindex,nofollow' />
	<!-- /Meta -->
	
	<!-- Fancybox -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script>
		!window.jQuery && document.write('<script src="../scripts/jquery-1.4.3.min.js"><\/script>');
	</script>
	<script type="text/javascript" src="../scripts/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="../scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="../scripts/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
 	<!-- <link rel="stylesheet" href="style.css" /> -->
	<script type="text/javascript">
		$(document).ready(function() {
			$("a.fancybox").fancybox({
				'transitionIn'	: 'none',
				'transitionOut'	: 'none'
			});
			
			$(".iframe").fancybox({
			'width'				: '75%',
			'height'			: '95%',
			'autoScale'			: false,
			'transitionIn'		: 'none',
			'transitionOut'		: 'none',
			'type'				: 'iframe'
			});
		});
	</script>
	<!-- /Fancybox -->
	
	<!-- jQueryIU -->
	<!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" /> -->
    <!-- <script src="../scripts/jqueryui/js/jquery-ui-1.9.0.custom.min.js"></script> -->
	<!-- /jQueryIU -->
	
	<!-- Script syntaxhighlighter -->
	<script type="text/javascript" src="../scripts/syntaxhighlighter/scripts/shCore.js"></script>
	<script type="text/javascript" src="../scripts/syntaxhighlighter/scripts/shBrushJScript.js"></script>
	<script type="text/javascript" src="../scripts/syntaxhighlighter/scripts/shBrushBash.js"></script>
	<script type="text/javascript" src="../scripts/syntaxhighlighter/scripts/shBrushPhp.js"></script>
	<link type="text/css" rel="stylesheet" href="scripts/syntaxhighlighter/styles/shCoreDefault.css"/>
	<script type="text/javascript">SyntaxHighlighter.all();</script>
	<!-- /Fin del Script syntaxhighlighter -->
	
	<!-- Funciones jQuery personalizadas -->
	<!-- <script type='text/javascript' src='./scripts/jquery-1.8.1.min.js'></script> -->
	<script type='text/javascript' src='./scripts/funciones-adm.js'></script>
	<!-- /Funciones jQuery personalizadas -->
	
	<!-- TinyMCE -->
	<script type="text/javascript" src="scripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
		
			mode : "exact",
			elements : "elm1,elm2",
			
			// General options
			//mode : "textareas",
			language : "es",
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Style formats
			style_formats : [
				{title : 'Bold text', inline : 'b'},
				{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
				{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
				{title : 'Example 1', inline : 'span', classes : 'example1'},
				{title : 'Example 2', inline : 'span', classes : 'example2'},
				{title : 'Table styles'},
				{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
			],

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	</script>
	<!-- /TinyMCE -->
	
	<link rel='shortcut icon' type='image/x-icon' href='../img/favicon/logo.ico' />
	<link rel='stylesheet' type='text/css' href='css/layout.css' />
</head>
<body>
	<div id='wrapper'>
		<div id='header'>
			<div id='header-img'><img src='../img/logo_small.png' alt='logotipo' /></div>
			<div id='header-titulo'>
				<h2>Panel de Control</h2>
				<h3>Programando Online</h3>
			</div>
		</div>
		
		<div id='navigation'>
			<ul id='menu'>
				<li id='titulo'>Panel de Control</li>
				<li><a href='#'>&nbsp;&raquo; Incio</a></li>
				<li><a href='index.php?zona=contenido'>&nbsp;&raquo; Contenido</a></li>
				<li><a href='index.php?zona=archivo'>&nbsp;&raquo; Archivos</a></li>
				<li><a href='index.php?zona=usuario'>&nbsp;&raquo; Usuario</a></li>
				<li><a href='index.php?zona=comentarios'>&nbsp;&raquo; Comentarios</a></li>
				<li><a href='index.php?zona=enlace'>&nbsp;&raquo; Enlaces</a></li>
				<li><a href='index.php?zona=video'>&nbsp;&raquo; Videos</a></li>
				<li><a href='index.php?zona=seccion'>&nbsp;&raquo; Sección</a></li>
				<li><a href='index.php?zona=categoria'>&nbsp;&raquo; Categoria<span style='font-size:12px'> (Menu)</span></a></li>
				<li><a href='index.php?zona=subcategoria'>&nbsp;&raquo; Subcategoria<span style='font-size:12px'> (Menu)</span></a></li>
				<li><a href='salir.php'>&nbsp;&raquo; Salir</a></li>
			</ul>
		</div>
		
		<div id='content'>
			<?php $x->contenido(); ?>
		</div>
		
		<div id='footer'>
			&copy; Rubén González Juan
		</div>
	</div>
</body>
</html>

<?php
}
?>