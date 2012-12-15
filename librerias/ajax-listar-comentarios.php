<?php
include("comentarios.php");

$c = new comentario($_GET["idcontenido"]);

if($c->comentario_existe())
{
	$c->getComentarios();
	$c->setComentario();
}
else
	$c->setComentario();





?>