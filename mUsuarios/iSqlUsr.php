<?php
	include_once("../lib/objUsuario.php");
	$iUsuario=new classUsuario();

	if (!empty($_POST["saveUsr"])){
		$datsUsr= array();
		$datsUsr ["idUsr"]=$_POST["usr_id"];
		$datsUsr ["nombres"]=$_POST["usr_nombres"];
		$datsUsr ["apellidos"]=$_POST["usr_apellidos"];
		$datsUsr ["estado"]=$_POST["usr_estado"];
		$datsUsr ["idProceso"]=$_POST["usr_pro_id"];
		//$datsUsr ["username"]=$_POST["usr_username"];

		echo $iUsuario->saveUsr($datsUsr);
	}


?>