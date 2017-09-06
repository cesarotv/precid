<?php
	session_start();
	$e="eo";
	if (!empty($_POST["USR"])){
		
		if (!empty($_POST["PASS"])){
			include_once("lib/conector.php");
			$access=new ConectorDB;
			$tUsr=$access->access($_POST["USR"],$_POST["PASS"]);
			if($tUsr[0]==true){
				$_SESSION["USR"] = $tUsr;
				header("Location:home.php");
				//echo "<script>alert('hola ".utf8_encode ($_SESSION["USR"][3])." te logeaste!!!!!')</script>";

			}else{
				$e="em";
				$msj= "Al parecer algún dato ingresado no es correcto, revisalo e intenta de nuevo";}
		
		}else{$e="em";$msj= "Te falta ingresar la contraseña para que puedas ingresar !!!";}	
	}
		
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Inventario CID</title>
<link media="screen" href="index.css" type="text/css" rel="stylesheet"></link>
<script type="text/javascript">
	window.onload = function() {document.onkeyup = fsubmit;}
	function fsubmit(e) {
		var tcl = window.Event ? e.which : e.keyCode;
		if (e.keyCode==13) {
			document.getElementById('acess').submit()
		}
		
	}

</script>
</head>
<body>
	<div id="cp">
		<div id="cTit">
			<span><img src="img/logo.jpg"></span>
			<span>INVENTARIO</span>
		</div>
		<form ID="acess" method="POST" action="index.php">
			<div id="cDat">
				<input name="USR" placeholder="Usuario" autocomplete="off"></input>
				<input name="PASS" type="password" placeholder="Clave de Acceso" autocomplete="off"></input>
			</div>
			<a onclick="document.getElementById('acess').submit();" >ACCESO</a>
		</form>
		<div id="msj" class="<?php echo $e;?>">
			<span><img src="img/alert.png"></span>
			<span>
				<div id="titmsj">Oooops!!!!</div>
				<div id="contmsj"><?php echo $msj;?></div>
			</span>
			
		</div>
	</div>
	
</body>

</html>