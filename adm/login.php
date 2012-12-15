<?php 
require_once("librerias/biblioteca.php");
require_once("../librerias/clase_sql.php");
function login($texto="")
{
?>

<html>
<head>
	<title>Acceso a el Panel de Control</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel='shortcut icon' type='image/x-icon' href='../img/favicon/logo.ico' />
</head>
<body>
	<div id='cont-login'>
		<div id='img-login'><img src='../img/logo2.png' alt='logo' /></div>
		<?php
			if(!empty($texto))
			{
				echo "<div id='error'>".$texto."</div>";
			}
		?>
		<form id='login_form' name='frm' method='post' action='login.php' />
			<p>
				<label class='label'>
					<span>Nombre de usuario: </span><br />
					<input type='text' class='caja' name='usuario' value='' />
				</label>
			</p>
			<p>
				<label class='label'>
					<span>Contraseña: </span><br />
					<input type='password' class='caja' name='clave' value='' />
				</label>
			</p>
			<p>
				<div id='boton'><input type='submit' class='entrar' name='entrar' value='Acceder' /></div>
			</p>
		</form>
		<p class='volver'><a href='../index.php'>&laquo; Volver a Programando Online</a></p>
	</div>
</body>
</html>

<?php
}
function procesa()
{
	//print_r($_POST);
	
	$login = $_POST["usuario"];
	$clave = $_POST["clave"];
	
	if(strlen($login)==0 || strlen($clave)==0)
	{
		$texto = "¡El <b>nombre</b> y/o la <b>contraseña</b> están vacios!";
		die(login($texto));
	}
	
	$sql_login = "SELECT id FROM po_usuario WHERE login='".$login."' AND clave='".$clave."'";
	//echo $sql_login;
	$x = new sql($sql_login);
	$result_login = $x->result();
	if($x->numrows()==1)
	{
		$fila=mysql_fetch_array($result_login);
		$_SESSION["idusuario"]=$fila["id"];
		header("location:index.php");
	}
	else
	{
		$texto="¡<b>Usuario</b> y/o <b>Contraseña</b> son inválidos!";
		login($texto);
	}
	
	

}

$haydatos = count($_POST);
if(!$haydatos)
	login();
else
	procesa();
?>



















