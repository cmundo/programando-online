<?php

//Esto lo pongo para que funcione Ajax-listar-comentarios.php
if(isset($_GET["idcontenido"]))
{
	include("clase_sql.php");
	include("biblioteca.php");
}

class comentario{

	protected $idquien;
	protected $objetoSql; //Objeto SQL.
	protected $numrows;
	
	public function __construct($id)
	{
		$this->idquien = $id;
		$this->result = 0;
		$this->numrows = 0;
		$this->lanzarConsulta();
	}
	
	public function setId($id)
	{
		$this->idquien = $id;
		$this->lanzarConsulta();
	}
	
	public function nComentarios()
	{
		$this->lanzarConsulta();
		return $this->numrows;
	}
	
	public function lanzarConsulta()
	{
		$sql = "SELECT nom,texto,fecha,hora FROM po_comentario WHERE idcontenido=".$this->idquien;
		//echo $sql;
		$x = new sql($sql);
		$this->numrows = $x->numrows();
		$this->objetoSql = $x;
	}
	
	public function comentario_existe()
	{
		if($this->numrows==0)
			return false;
		else
			return true;
	}
	
	public function setComentario()
	{
		echo "
		<form id='c-form' name='frm' method='get' action='librerias/ajax-enviar-comentario.php' data-idcontenido='".$this->idquien."'>
			<h3 class='comentario-titulo'>Escribir un Comentario</h3>
			<hr class='comentario-hr' />
			<div class='comentario-contenido'>
				<input type='text' name='nombre' value='' id='c-nombre' /><span class='comentario-text' id='c-nombre-text'>Nombre (Obligatorio)</span><br />
				<input type='text' name='email' value='' id='c-email' /><span class='comentario-text' id='c-email-text'>E-mail (Obligatorio)</span><br />
				<span class='comentario-text' id='c-textarea-text'>Comentario:</span><br />
				<textarea name='texto' id='c-textarea'></textarea>
				<div>
					<input type='submit' class='submit' name='enviar-comentario' value='Enviar' />
					<input type='reset' class='submit' name='reset' value='Restablecer' />
				</div>
			</div>
		</form>";
	}
	
	public function getComentarios()
	{
		$x = $this->objetoSql;
		$result = $x->result();
		
		echo "<div id='comentarios'><h3 class='comentario-titulo'>Comentarios</h3><hr class='comentario-hr' />";
			
		$cont=1;
		$bi = new biblioteca();
		while($fila=mysql_fetch_array($result))
		{
			if($cont % 2 == 0)
				echo"<div class='comentario-even'>";
			else
				echo"<div class='comentario-odd'>";
			
			echo "	
					<div class='comentario-top'>
						<div class='comentario-numero'>".$cont."</div>
						<div class='comentario-nombre'>
								<span class='coment-nombre1'><b>".$fila["nom"]."</b> dice:</span><br />
								<span class='coment-nombre2'>".$bi->fecha($fila["fecha"])." a las ".$fila["hora"]."</span>
						</div>
						<div class='comentario-img'>
								<img src='img/avatar.gif' alt='autor desconocido' />
						</div>
					</div>
					<div class='comentario-bottom'>".$fila["texto"]."</div>
				</div>";
			$cont++;
		}
		
		echo "</div>";
	}

}

?>