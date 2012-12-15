<?php
class sql
{
	private $con,$base,$res,$sql;

	public function __construct($que="")
	{
		$this->res=false;
		$this->sql="";
		$this->con=mysql_connect("localhost","root","");
		if (!$this->con) 
			die("Error conectando con la Base de Datos, disculpen las molestias, intentelo en 5 minutos");
		mysql_set_charset("utf8",$this->con);
		$this->base=mysql_select_db("po_online");
		if (!$this->base) 
			die("Error usando la BD de Programando Online");
		if ($que) 
			$this->query($que);  //si hay sentencia llamar a query
	}
	
	public function destruir()
	{
		$comando = trim(strtolower(substr($this->sql,0,6)));
		if ($comando=="select") 
			mysql_free_result($this->res);//liberar mem si la hay
		mysql_close($this->con);
	}
	public function query($sentencia)
	{
		$this->sql=$sentencia;
		$this->res=mysql_query($sentencia);
		return $this->res;
	}
	public function numrows()
	{
		return mysql_num_rows($this->res);
	}

	public function affected()
	{
		return mysql_affected_rows();
	}

	public function errno()
	{
		return mysql_errno();
	}

	public function error()
	{
		return (mysql_errno()!=0);
	}

	public function result() 
	{
		return $this->res;
	}
	
}